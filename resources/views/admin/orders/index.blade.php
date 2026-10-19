@extends('layouts.app')

@section('title', 'Manage Orders - Aroma Admin')

@section('content')

<section class="admin-page-section py-5">
    <div class="container-fluid px-lg-5">

        {{-- Header --}}
        <div class="admin-header mb-4">

            <div>
                <span class="admin-label">AROMA ADMINISTRATION</span>
                <h1>Orders</h1>
                <p class="text-muted mb-0">
                    Manage and track customer orders.
                </p>
            </div>

        </div>

        {{-- Success Message --}}

        {{-- Error Message --}}

        {{-- Filter --}}
        <div class="admin-section-card mb-4">

            <div class="admin-section-header">

                <div>

                    <span class="admin-label">
                        ORDER MANAGEMENT
                    </span>

                    <h2>
                        Filter Orders
                    </h2>

                </div>

                <span class="profile-icon">
                    <i class="bi bi-funnel"></i>
                </span>

            </div>

            <form
                action="{{ route('admin.orders.index') }}"
                method="GET"
            >

                <div class="row g-3 align-items-end">

                    <div class="col-md-5">

                        <label
                            for="search"
                            class="form-label"
                        >
                            Search
                        </label>

                        <input
                            type="text"
                            id="search"
                            name="search"
                            class="form-control"
                            value="{{ request('search') }}"
                            placeholder="Order number, name or email"
                        >

                    </div>

                    <div class="col-md-4">

                        <label
                            for="status"
                            class="form-label"
                        >
                            Status
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="form-select"
                        >

                            <option value="">
                                All Statuses
                            </option>

                            <option
                                value="Pending"
                                {{ request('status') === 'Pending' ? 'selected' : '' }}
                            >
                                Pending
                            </option>

                            <option
                                value="Confirmed"
                                {{ request('status') === 'Confirmed' ? 'selected' : '' }}
                            >
                                Confirmed
                            </option>

                            <option
                                value="Shipped"
                                {{ request('status') === 'Shipped' ? 'selected' : '' }}
                            >
                                Shipped
                            </option>

                            <option
                                value="Delivered"
                                {{ request('status') === 'Delivered' ? 'selected' : '' }}
                            >
                                Delivered
                            </option>

                            <option
                                value="Cancelled"
                                {{ request('status') === 'Cancelled' ? 'selected' : '' }}
                            >
                                Cancelled
                            </option>

                        </select>

                    </div>

                    <div class="col-md-3 d-flex gap-2">

                        <button
                            type="submit"
                            class="btn btn-aroma flex-grow-1"
                        >
                            <i class="bi bi-search me-2"></i>
                            Filter
                        </button>

                        <a
                            href="{{ route('admin.orders.index') }}"
                            class="btn btn-outline-aroma"
                            title="Clear Filters"
                        >
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>

                    </div>

                </div>

            </form>

        </div>

        {{-- Orders Table --}}
        <div class="admin-section-card">

            <div class="admin-section-header">

                <div>

                    <span class="admin-label">
                        ORDERS
                    </span>

                    <h2>
                        All Orders
                    </h2>

                </div>

                <span class="profile-icon">
                    <i class="bi bi-bag-check"></i>
                </span>

            </div>

            @if($orders->count())

                <div class="table-responsive">

                    <table class="table admin-table align-middle">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>Order</th>

                                <th>Customer</th>

                                <th>Date</th>

                                <th>Items</th>

                                <th>Total</th>

                                <th>Status</th>

                                <th class="text-end">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($orders as $order)

                                <tr>

                                    {{-- Number --}}
                                    <td>
                                        {{ $orders->firstItem() + $loop->index }}
                                    </td>

                                    {{-- Order --}}
                                    <td>

                                        <strong>
                                            {{ $order->order_number }}
                                        </strong>

                                        <small class="text-muted d-block">
                                            #{{ $order->id }}
                                        </small>

                                    </td>

                                    {{-- Customer --}}
                                    <td>

                                        <strong>
                                            {{ $order->name }}
                                        </strong>

                                        <small class="text-muted d-block">
                                            {{ $order->email }}
                                        </small>

                                    </td>

                                    {{-- Date --}}
                                    <td>

                                        {{ $order->created_at->format('d M Y') }}

                                        <small class="text-muted d-block">
                                            {{ $order->created_at->format('h:i A') }}
                                        </small>

                                    </td>

                                    {{-- Items --}}
                                    <td>

                                        <span class="badge bg-light text-dark border">
                                            {{ $order->orderItems->sum('quantity') }}
                                            {{ $order->orderItems->sum('quantity') == 1 ? 'Item' : 'Items' }}
                                        </span>

                                    </td>

                                    {{-- Total --}}
                                    <td>

                                        <strong>
                                            ₹{{ number_format($order->total, 2) }}
                                        </strong>

                                    </td>

                                    {{-- Status --}}
                                    <td>

                                        @if($order->status === 'Pending')

                                            <span class="badge bg-warning text-dark">
                                                Pending
                                            </span>

                                        @elseif($order->status === 'Confirmed')

                                            <span class="badge bg-info text-dark">
                                                Confirmed
                                            </span>

                                        @elseif($order->status === 'Shipped')

                                            <span class="badge bg-primary">
                                                Shipped
                                            </span>

                                        @elseif($order->status === 'Delivered')

                                            <span class="badge bg-success">
                                                Delivered
                                            </span>

                                        @elseif($order->status === 'Cancelled')

                                            <span class="badge bg-danger">
                                                Cancelled
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                {{ $order->status }}
                                            </span>

                                        @endif

                                    </td>

                                    {{-- Action --}}
                                    <td>

                                        <div class="d-flex justify-content-end">

                                            <a
                                                href="{{ route('admin.orders.show', $order) }}"
                                                class="btn btn-sm btn-outline-aroma"
                                            >

                                                <i class="bi bi-eye me-1"></i>

                                                View

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                {{-- Pagination --}}
                @if($orders->hasPages())

                    <div class="mt-4">

                        {{ $orders->links() }}

                    </div>

                @endif

            @else

                {{-- Empty State --}}
                <div class="text-center py-5">

                    <div class="empty-state-icon mb-3">

                        <i class="bi bi-bag-x"></i>

                    </div>

                    <h3>
                        No Orders Found
                    </h3>

                    <p class="text-muted mb-0">
                        There are no orders matching your current filters.
                    </p>

                </div>

            @endif

        </div>

    </div>
</section>

@endsection