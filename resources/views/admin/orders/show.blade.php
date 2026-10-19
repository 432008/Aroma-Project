@extends('layouts.app')

@section('title', 'Order Details - Aroma Admin')

@section('content')

<section class="admin-page-section py-5">
    <div class="container-fluid px-lg-5">

        {{-- Header --}}
        <div class="admin-header mb-4">

            <div>
                <span class="admin-label">AROMA ADMINISTRATION</span>

                <h1>Order Details</h1>

                <p class="text-muted mb-0">
                    Order {{ $order->order_number }}
                </p>
            </div>

            <div>

                <a
                    href="{{ route('admin.orders.index') }}"
                    class="btn btn-outline-aroma"
                >
                    <i class="bi bi-arrow-left me-2"></i>
                    Back to Orders
                </a>

            </div>

        </div>

        {{-- Messages --}}


        <div class="row g-4">

            {{-- Order Information --}}
            <div class="col-lg-8">

                <div class="admin-section-card mb-4">

                    <div class="admin-section-header">

                        <div>

                            <span class="admin-label">
                                ORDER
                            </span>

                            <h2>
                                {{ $order->order_number }}
                            </h2>

                        </div>

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

                    </div>

                    <div class="row g-3">

                        <div class="col-md-4">

                            <div class="admin-info-box">

                                <span>Order Date</span>

                                <strong>
                                    {{ $order->created_at->format('d M Y') }}
                                </strong>

                                <small>
                                    {{ $order->created_at->format('h:i A') }}
                                </small>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="admin-info-box">

                                <span>Payment Method</span>

                                <strong>
                                    {{ $order->payment_method }}
                                </strong>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="admin-info-box">

                                <span>Total Amount</span>

                                <strong>
                                    ₹{{ number_format($order->total, 2) }}
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- Order Items --}}
                <div class="admin-section-card mb-4">

                    <div class="admin-section-header">

                        <div>

                            <span class="admin-label">
                                PRODUCTS
                            </span>

                            <h2>
                                Ordered Items
                            </h2>

                        </div>

                        <span class="profile-icon">
                            <i class="bi bi-bag"></i>
                        </span>

                    </div>

                    <div class="table-responsive">

                        <table class="table admin-table align-middle">

                            <thead>

                                <tr>

                                    <th>Product</th>

                                    <th>Price</th>

                                    <th>Quantity</th>

                                    <th class="text-end">
                                        Subtotal
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach($order->orderItems as $item)

                                    <tr>

                                        <td>

                                            <strong>
                                                {{ $item->product_name }}
                                            </strong>

                                        </td>

                                        <td>
                                            ₹{{ number_format($item->price, 2) }}
                                        </td>

                                        <td>
                                            {{ $item->quantity }}
                                        </td>

                                        <td class="text-end">

                                            <strong>
                                                ₹{{ number_format($item->subtotal, 2) }}
                                            </strong>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

                {{-- Customer Information --}}
                <div class="admin-section-card">

                    <div class="admin-section-header">

                        <div>

                            <span class="admin-label">
                                CUSTOMER
                            </span>

                            <h2>
                                Customer Information
                            </h2>

                        </div>

                        <span class="profile-icon">
                            <i class="bi bi-person"></i>
                        </span>

                    </div>

                    <div class="row g-3">

                        <div class="col-md-6">

                            <div class="admin-info-box">

                                <span>Name</span>

                                <strong>
                                    {{ $order->name }}
                                </strong>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="admin-info-box">

                                <span>Email</span>

                                <strong>
                                    {{ $order->email }}
                                </strong>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="admin-info-box">

                                <span>Phone</span>

                                <strong>
                                    {{ $order->phone }}
                                </strong>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="admin-info-box">

                                <span>User ID</span>

                                <strong>
                                    #{{ $order->user_id }}
                                </strong>

                            </div>

                        </div>

                        <div class="col-12">

                            <div class="admin-info-box">

                                <span>Delivery Address</span>

                                <strong>
                                    {{ $order->address }}
                                </strong>

                                <small>
                                    {{ $order->city }},
                                    {{ $order->state }}
                                    - {{ $order->pincode }}
                                </small>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Order Sidebar --}}
            <div class="col-lg-4">

                {{-- Update Status --}}
                <div class="admin-section-card mb-4">

                    <div class="admin-section-header">

                        <div>

                            <span class="admin-label">
                                MANAGEMENT
                            </span>

                            <h2>
                                Update Status
                            </h2>

                        </div>

                    </div>

                    @if($order->status === 'Cancelled')

                        <div class="alert alert-warning mb-0">

                            <i class="bi bi-info-circle me-2"></i>

                            This order has been cancelled and cannot be
                            reopened.

                        </div>

                    @else

                        <form
                            action="{{ route('admin.orders.status', $order) }}"
                            method="POST"
                        >

                            @csrf
                            @method('PATCH')

                            <div class="mb-3">

                                <label
                                    for="status"
                                    class="form-label"
                                >
                                    Order Status
                                </label>

                                <select
                                    id="status"
                                    name="status"
                                    class="form-select"
                                    required
                                >

                                    <option
                                        value="Pending"
                                        {{ $order->status === 'Pending' ? 'selected' : '' }}
                                    >
                                        Pending
                                    </option>

                                    <option
                                        value="Confirmed"
                                        {{ $order->status === 'Confirmed' ? 'selected' : '' }}
                                    >
                                        Confirmed
                                    </option>

                                    <option
                                        value="Shipped"
                                        {{ $order->status === 'Shipped' ? 'selected' : '' }}
                                    >
                                        Shipped
                                    </option>

                                    <option
                                        value="Delivered"
                                        {{ $order->status === 'Delivered' ? 'selected' : '' }}
                                    >
                                        Delivered
                                    </option>

                                    <option
                                        value="Cancelled"
                                        {{ $order->status === 'Cancelled' ? 'selected' : '' }}
                                    >
                                        Cancelled
                                    </option>

                                </select>

                            </div>

                            <button
                                type="submit"
                                class="btn btn-aroma w-100"
                            >

                                <i class="bi bi-arrow-repeat me-2"></i>

                                Update Status

                            </button>

                        </form>

                    @endif

                </div>

                {{-- Order Summary --}}
                <div class="admin-section-card">

                    <div class="admin-section-header">

                        <div>

                            <span class="admin-label">
                                SUMMARY
                            </span>

                            <h2>
                                Order Summary
                            </h2>

                        </div>

                    </div>

                    <div class="order-summary-line">

                        <span>
                            Subtotal
                        </span>

                        <strong>
                            ₹{{ number_format($order->subtotal, 2) }}
                        </strong>

                    </div>

                    <div class="order-summary-line">

                        <span>
                            Shipping
                        </span>

                        <strong>
                            @if($order->shipping > 0)
                                ₹{{ number_format($order->shipping, 2) }}
                            @else
                                Free
                            @endif
                        </strong>

                    </div>

                    <hr>

                    <div class="order-summary-total">

                        <span>
                            Total
                        </span>

                        <strong>
                            ₹{{ number_format($order->total, 2) }}
                        </strong>

                    </div>

                    <div class="mt-3">

                        <small class="text-muted">
                            Payment:
                            <strong>
                                {{ $order->payment_method }}
                            </strong>
                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection