@extends('layouts.app')

@section('title', 'Order Details - Aroma')

@section('content')

<section class="page-header">
    <div class="container text-center">
        <p class="text-uppercase small mb-2">Aroma Order</p>
        <h1>Order Details</h1>
        <p>Review your order information and fragrance items.</p>
    </div>
</section>

<section class="order-details-section py-5">
    <div class="container">


        <div class="row g-4">

            {{-- Main Order Information --}}
            <div class="col-lg-8">

                <div class="order-details-card">

                    <div class="order-details-header">

                        <div>
                            <span class="order-label">
                                ORDER NUMBER
                            </span>

                            <h3>
                                {{ $order->order_number }}
                            </h3>

                            <p class="mb-0 text-muted">
                                Placed on
                                {{ $order->created_at->format('d M Y, h:i A') }}
                            </p>
                        </div>

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

                    </div>

                    <hr>

                    <div class="order-items-title">
                        <h4>Ordered Items</h4>

                        <span>
                            {{ $order->orderItems->sum('quantity') }} Items
                        </span>
                    </div>

                    @foreach($order->orderItems as $item)

                        <div class="order-detail-item">

                            <div class="order-detail-image">

                                @if($item->product && $item->product->image && file_exists(storage_path('app/public/' . $item->product->image)))

                                    <img
                                        src="{{ asset('storage/' . $item->product->image) }}"
                                        alt="{{ $item->product_name }}"
                                    >

                                @else

                                    <div class="product-placeholder">
                                        <i class="bi bi-droplet"></i>
                                    </div>

                                @endif

                            </div>

                            <div class="order-detail-info">

                                <span class="product-category">
                                    {{ $item->product->category->name ?? 'Perfume' }}
                                </span>

                                <h5>
                                    {{ $item->product_name }}
                                </h5>

                                <p>
                                    ₹{{ number_format($item->price, 2) }}
                                    ×
                                    {{ $item->quantity }}
                                </p>

                            </div>

                            <div class="order-detail-subtotal">

                                <strong>
                                    ₹{{ number_format($item->subtotal, 2) }}
                                </strong>

                            </div>

                        </div>

                    @endforeach

                </div>

                {{-- Delivery Address --}}
                <div class="order-details-card mt-4">

                    <div class="order-section-heading">

                        <span class="section-icon">
                            <i class="bi bi-geo-alt"></i>
                        </span>

                        <div>
                            <h4>Delivery Address</h4>
                            <p class="mb-0">
                                Your order will be delivered here.
                            </p>
                        </div>

                    </div>

                    <div class="delivery-address">

                        <strong>{{ $order->name }}</strong>

                        <p>
                            {{ $order->address }}<br>
                            {{ $order->city }},
                            {{ $order->state }}
                            - {{ $order->pincode }}
                        </p>

                        <p class="mb-0">
                            <i class="bi bi-telephone me-2"></i>
                            {{ $order->phone }}
                            <br>

                            <i class="bi bi-envelope me-2"></i>
                            {{ $order->email }}
                        </p>

                    </div>

                </div>

            </div>

            {{-- Order Summary --}}
            <div class="col-lg-4">

                <div class="order-summary-card">

                    <h3>Order Summary</h3>

                    <div class="summary-line">
                        <span>Subtotal</span>

                        <strong>
                            ₹{{ number_format($order->subtotal, 2) }}
                        </strong>
                    </div>

                    <div class="summary-line">
                        <span>Shipping</span>

                        @if($order->shipping > 0)
                            <strong>
                                ₹{{ number_format($order->shipping, 2) }}
                            </strong>
                        @else
                            <strong class="text-success">
                                FREE
                            </strong>
                        @endif
                    </div>

                    <hr>

                    <div class="summary-total">
                        <span>Total</span>

                        <strong>
                            ₹{{ number_format($order->total, 2) }}
                        </strong>
                    </div>

                    <div class="payment-info mt-4">

                        <span class="section-icon">
                            <i class="bi bi-cash-coin"></i>
                        </span>

                        <div>
                            <strong>Payment Method</strong>

                            <p class="mb-0">
                                {{ $order->payment_method }}
                            </p>
                        </div>

                    </div>

                </div>

                {{-- Order Help --}}
                <div class="order-help-card mt-4">

                    <i class="bi bi-headset"></i>

                    <h4>Need Help?</h4>

                    <p>
                        Have a question about your order?
                        Our Aroma support team is happy to help.
                    </p>

                    <a href="{{ route('contact.index') }}">
                        Contact Support
                        <i class="bi bi-arrow-right ms-1"></i>
                    </a>

                </div>

                <a
                    href="{{ route('orders.index') }}"
                    class="btn btn-outline-aroma w-100 mt-3"
                >
                    <i class="bi bi-arrow-left me-2"></i>
                    Back to My Orders
                </a>

            </div>

        </div>

    </div>
</section>

@endsection