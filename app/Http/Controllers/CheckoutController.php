<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect('/cart')
                ->with('error', 'Your cart is empty.');
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->final_price * $item->quantity;
        });

        $shipping = 100;
        $total = $subtotal + $shipping;

        return view('checkout.index', compact(
            'cartItems',
            'subtotal',
            'shipping',
            'total'
        ));
    }

    public function placeOrder(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:500'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'pincode' => ['required', 'string', 'max:10'],
        ]);

        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect('/cart')
                ->with('error', 'Your cart is empty.');
        }

        foreach ($cartItems as $item) {
            if ($item->product->status !== 'active') {
                return back()->with(
                    'error',
                    $item->product->name . ' is no longer available.'
                );
            }

            if ($item->quantity > $item->product->stock) {
                return back()->with(
                    'error',
                    'Insufficient stock for ' . $item->product->name . '.'
                );
            }
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->final_price * $item->quantity;
        });

        $shipping = 100;
        $total = $subtotal + $shipping;

        $order = DB::transaction(function () use (
            $request,
            $cartItems,
            $subtotal,
            $shipping,
            $total
        ) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'ARO-' . date('Y') . '-' . str_pad(
                    (string) (Order::count() + 1),
                    5,
                    '0',
                    STR_PAD_LEFT
                ),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'pincode' => $request->pincode,
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'total' => $total,
                'payment_method' => 'Cash on Delivery',
                'status' => 'Pending',
            ]);

            foreach ($cartItems as $item) {

                $price = $item->product->final_price;
                $itemSubtotal = $price * $item->quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'product_name' => $item->product->name,
                    'price' => $price,
                    'quantity' => $item->quantity,
                    'subtotal' => $itemSubtotal,
                ]);

                $item->product->decrement(
                    'stock',
                    $item->quantity
                );
            }

            Cart::where('user_id', auth()->id())->delete();

            return $order;
        });

        return redirect('/orders/' . $order->id)
            ->with(
                'success',
                'Your order has been placed successfully.'
            );
    }
}