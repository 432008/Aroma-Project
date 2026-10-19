@extends('layouts.app')

@section('title', 'Admin Dashboard - Aroma')

@section('content')

<section class="admin-page-section py-5">
    <div class="container-fluid px-lg-5">

        {{-- Header --}}
        <div class="admin-header mb-4">

            <div>
                <span class="admin-label">AROMA ADMINISTRATION</span>

                <h1>Dashboard</h1>

                <p class="text-muted mb-0">
                    Welcome back, {{ auth()->user()->name }}.
                    Here's an overview of your Aroma store.
                </p>
            </div>

            <div class="admin-header-action">
                <a
                    href="{{ route('home') }}"
                    class="btn btn-outline-aroma"
                    target="_blank"
                >
                    <i class="bi bi-box-arrow-up-right me-2"></i>
                    View Store
                </a>
            </div>

        </div>

        {{-- Statistics --}}
        <div class="row g-4 mb-4">

            {{-- Products --}}
            <div class="col-xl-3 col-md-6">

                <div class="admin-stat-card">

                    <div class="admin-stat-icon">
                        <i class="bi bi-droplet"></i>
                    </div>

                    <div>
                        <span>Total Products</span>

                        <h2>{{ $totalProducts }}</h2>

                        <small>
                            <i class="bi bi-box-seam me-1"></i>
                            Active perfume products
                        </small>
                    </div>

                </div>

            </div>

            {{-- Orders --}}
            <div class="col-xl-3 col-md-6">

                <div class="admin-stat-card">

                    <div class="admin-stat-icon">
                        <i class="bi bi-bag-check"></i>
                    </div>

                    <div>
                        <span>Total Orders</span>

                        <h2>{{ $totalOrders }}</h2>

                        <small>
                            <i class="bi bi-cart-check me-1"></i>
                            Customer orders
                        </small>
                    </div>

                </div>

            </div>

            {{-- Users --}}
            <div class="col-xl-3 col-md-6">

                <div class="admin-stat-card">

                    <div class="admin-stat-icon">
                        <i class="bi bi-people"></i>
                    </div>

                    <div>
                        <span>Total Customers</span>

                        <h2>{{ $totalUsers }}</h2>

                        <small>
                            <i class="bi bi-person-check me-1"></i>
                            Registered customers
                        </small>
                    </div>

                </div>

            </div>

            {{-- Revenue --}}
            <div class="col-xl-3 col-md-6">

                <div class="admin-stat-card">

                    <div class="admin-stat-icon">
                        <i class="bi bi-currency-rupee"></i>
                    </div>

                    <div>
                        <span>Total Revenue</span>

                        <h2>
                            ₹{{ number_format($totalRevenue, 2) }}
                        </h2>

                        <small>
                            <i class="bi bi-graph-up me-1"></i>
                            Completed/active orders
                        </small>
                    </div>

                </div>

            </div>

        </div>

        {{-- Quick Actions --}}
        <div class="admin-section-card mb-4">

            <div class="admin-section-header">

                <div>
                    <span class="admin-label">MANAGEMENT</span>
                    <h3>Quick Actions</h3>
                </div>

            </div>

            <div class="row g-3">

                <div class="col-lg-3 col-md-6">

                    <a
                        href="{{ route('admin.products.create') }}"
                        class="admin-action-card"
                    >
                        <i class="bi bi-plus-circle"></i>

                        <div>
                            <strong>Add Product</strong>
                            <span>Create a new perfume</span>
                        </div>

                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

                <div class="col-lg-3 col-md-6">

                    <a
                        href="{{ route('admin.categories.create') }}"
                        class="admin-action-card"
                    >
                        <i class="bi bi-grid"></i>

                        <div>
                            <strong>Add Category</strong>
                            <span>Create a collection</span>
                        </div>

                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

                <div class="col-lg-3 col-md-6">

                    <a
                        href="{{ route('admin.orders.index') }}"
                        class="admin-action-card"
                    >
                        <i class="bi bi-bag"></i>

                        <div>
                            <strong>Manage Orders</strong>
                            <span>View customer orders</span>
                        </div>

                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

                <div class="col-lg-3 col-md-6">

                    <a
                        href="{{ route('admin.users.index') }}"
                        class="admin-action-card"
                    >
                        <i class="bi bi-people"></i>

                        <div>
                            <strong>Manage Users</strong>
                            <span>View customers</span>
                        </div>

                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>

            </div>

        </div>

        <div class="row g-4">

            {{-- Recent Orders --}}
            <div class="col-lg-8">

                <div class="admin-section-card h-100">

                    <div class="admin-section-header">

                        <div>
                            <span class="admin-label">LATEST</span>
                            <h3>Recent Orders</h3>
                        </div>

                        <a
                            href="{{ route('admin.orders.index') }}"
                            class="admin-view-link"
                        >
                            View All
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>

                    </div>

                    @if($recentOrders->count() > 0)

                        <div class="table-responsive">

                            <table class="table admin-table align-middle">

                                <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Customer</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($recentOrders as $order)

                                        <tr>

                                            <td>
                                                <strong>
                                                    {{ $order->order_number }}
                                                </strong>

                                                <small class="d-block text-muted">
                                                    {{ $order->created_at->format('d M Y') }}
                                                </small>
                                            </td>

                                            <td>
                                                {{ $order->name }}
                                            </td>

                                            <td>
                                                <strong>
                                                    ₹{{ number_format($order->total, 2) }}
                                                </strong>
                                            </td>

                                            <td>

                                                @php
                                                    $statusClass = match($order->status) {
                                                        'Pending' => 'status-pending',
                                                        'Confirmed' => 'status-confirmed',
                                                        'Shipped' => 'status-shipped',
                                                        'Delivered' => 'status-delivered',
                                                        'Cancelled' => 'status-cancelled',
                                                        default => 'status-pending',
                                                    };
                                                @endphp

                                                <span class="order-status-badge {{ $statusClass }}">
                                                    {{ $order->status }}
                                                </span>

                                            </td>

                                            <td class="text-end">

                                                <a
                                                    href="{{ route('admin.orders.show', $order) }}"
                                                    class="admin-table-action"
                                                    title="View Order"
                                                >
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    @else

                        <div class="admin-empty-state">
                            <i class="bi bi-bag-x"></i>
                            <p>No orders found.</p>
                        </div>

                    @endif

                </div>

            </div>

            {{-- Pending / Low Stock --}}
            <div class="col-lg-4">

                <div class="admin-section-card mb-4">

                    <div class="admin-section-header">

                        <div>
                            <span class="admin-label">ATTENTION</span>
                            <h3>Pending Orders</h3>
                        </div>

                        <span class="admin-number-badge">
                            {{ $pendingOrders }}
                        </span>

                    </div>

                    @if($pendingOrders > 0)

                        <div class="admin-notice">
                            <i class="bi bi-clock-history"></i>

                            <div>
                                <strong>
                                    Orders Awaiting Confirmation
                                </strong>

                                <p>
                                    Review and confirm pending customer orders.
                                </p>

                                <a href="{{ route('admin.orders.index') }}">
                                    Manage Orders
                                    <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>

                    @else

                        <div class="admin-success-notice">
                            <i class="bi bi-check-circle"></i>

                            <div>
                                <strong>All Caught Up</strong>

                                <p class="mb-0">
                                    There are no pending orders.
                                </p>
                            </div>
                        </div>

                    @endif

                </div>

                <div class="admin-section-card">

                    <div class="admin-section-header">

                        <div>
                            <span class="admin-label">INVENTORY</span>
                            <h3>Low Stock</h3>
                        </div>

                        <a
                            href="{{ route('admin.products.index') }}"
                            class="admin-view-link"
                        >
                            Products
                        </a>

                    </div>

                    @if($lowStockProducts->count() > 0)

                        @foreach($lowStockProducts as $product)

                            <div class="low-stock-item">

                                <div class="low-stock-image">

                                    @if($product->image && file_exists(storage_path('app/public/' . $product->image)))

                                        <img
                                            src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->name }}"
                                        >

                                    @else

                                        <i class="bi bi-droplet"></i>

                                    @endif

                                </div>

                                <div class="low-stock-info">

                                    <strong>
                                        {{ $product->name }}
                                    </strong>

                                    <span>
                                        {{ $product->stock }} left in stock
                                    </span>

                                </div>

                            </div>

                        @endforeach

                    @else

                        <div class="admin-empty-state">
                            <i class="bi bi-check2-circle"></i>
                            <p>Stock levels look good.</p>
                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>
</section>

@endsection