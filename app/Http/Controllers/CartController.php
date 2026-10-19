<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cartItems = Cart::with('product.category')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        $summary = $this->summary(auth()->id());

        $subtotal = $summary['subtotal'];
        $shipping = $summary['shipping'];
        $total = $summary['total'];

        return view('cart.index', compact(
            'cartItems',
            'subtotal',
            'shipping',
            'total'
        ));
    }

    public function add(Request $request, Product $product): RedirectResponse
    {
        if ($product->status !== 'active') {
            return back()->with('error', 'This product is currently unavailable.');
        }

        if ($product->stock <= 0) {
            return back()->with('error', 'This product is out of stock.');
        }

        $quantity = max((int) $request->input('quantity', 1), 1);

        if ($quantity > $product->stock) {
            return back()->with(
                'error',
                'Only ' . $product->stock . ' item(s) are available.'
            );
        }

        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {

            $newQuantity = $cartItem->quantity + $quantity;

            if ($newQuantity > $product->stock) {
                return back()->with(
                    'error',
                    'You cannot add more than the available stock.'
                );
            }

            $cartItem->update([
                'quantity' => $newQuantity,
            ]);

        } else {

            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        return back()->with(
            'success',
            $product->name . ' added to your cart.'
        );
    }

    public function update(Request $request, Cart $cart): JsonResponse|RedirectResponse
    {
        $this->authorizeCart($cart);

        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        if ($request->quantity > $cart->product->stock) {

            $message = 'Only ' . $cart->product->stock . ' item(s) are available.';

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $message,
                ], 422);
            }

            return back()->with('error', $message);
        }

        $cart->update([
            'quantity' => $request->quantity,
        ]);

        if ($request->expectsJson()) {

            $summary = $this->summary(auth()->id());

            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully.',
                'line' => [
                    'subtotal' => round(
                        (float) $cart->product->final_price * $cart->quantity,
                        2
                    ),
                ],
                'summary' => $summary,
            ]);
        }

        return back()->with(
            'success',
            'Cart updated successfully.'
        );
    }

    public function remove(Cart $cart): RedirectResponse
    {
        $this->authorizeCart($cart);

        $cart->delete();

        return back()->with(
            'success',
            'Product removed from your cart.'
        );
    }

    /**
     * Shared totals for the cart sidebar.
     *
     * @return array{items: int, subtotal: float, shipping: float, total: float, cartCount: int}
     */
    private function summary(int $userId): array
    {
        $items = Cart::with('product')
            ->where('user_id', $userId)
            ->get();

        $subtotal = (float) $items->sum(function ($item) {
            return $item->product->final_price * $item->quantity;
        });

        $shipping = $subtotal > 0 ? 100 : 0;

        return [
            'items' => (int) $items->sum('quantity'),
            'subtotal' => $subtotal,
            'shipping' => (float) $shipping,
            'total' => $subtotal + $shipping,
            'cartCount' => (int) $items->sum('quantity'),
        ];
    }

    private function authorizeCart(Cart $cart): void
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
