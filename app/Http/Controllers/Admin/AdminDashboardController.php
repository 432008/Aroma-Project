<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $totalProducts = Product::count();

        $totalOrders = Order::count();

        $totalUsers = User::where('role', 'user')->count();

        $totalRevenue = Order::where('status', '!=', 'Cancelled')
            ->sum('total');

        $pendingOrders = Order::where('status', 'Pending')
            ->count();

        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        $lowStockProducts = Product::where('stock', '<=', 5)
            ->where('status', 'active')
            ->orderBy('stock')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalUsers',
            'totalRevenue',
            'pendingOrders',
            'recentOrders',
            'lowStockProducts'
        ));
    }
}