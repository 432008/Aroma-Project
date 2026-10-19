<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminOrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        $order->load([
            'user',
            'orderItems.product',
        ]);

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(
        Request $request,
        Order $order
    ): RedirectResponse {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:Pending,Confirmed,Shipped,Delivered,Cancelled',
            ],
        ]);

        $oldStatus = $order->status;
        $newStatus = $validated['status'];

        if ($oldStatus === 'Cancelled' && $newStatus !== 'Cancelled') {
            return back()->with(
                'error',
                'A cancelled order cannot be reopened.'
            );
        }

        if ($oldStatus !== 'Cancelled' && $newStatus === 'Cancelled') {
            foreach ($order->orderItems as $item) {
                if ($item->product) {
                    $item->product->increment(
                        'stock',
                        $item->quantity
                    );
                }
            }
        }

        $order->update([
            'status' => $newStatus,
        ]);

        return back()->with(
            'success',
            'Order status updated successfully.'
        );
    }
}