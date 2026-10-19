@extends('layouts.app')

@section('title', 'My Orders - Aroma')

@section('content')

<section class="page-header">
    <div class="container text-center">
        <p class="text-uppercase small mb-2">Your Aroma Journey</p>
        <h1>My Orders</h1>
        <p>View and track all your Aroma fragrance orders.</p>
    </div>
</section>

<section class="orders-section py-5">
    <div class="container">



        @if($orders->count() > 0)

            <div class="orders-card">

                <div class="orders-card-header">
                    <div>
                        <span class="orders-label">ORDER HISTORY</span>
                        <h3>My Orders</h3>
                    </div>

                    <span class="orders-count">
                        {{ $orders->total() }} Orders
                    </span>
                </div>

                @foreach($orders as $order)

                    <div class="order-row">

                        <div class="order-main-info">

                            <div class="order-icon">
                                <i class="bi bi-box-seam"></i>
                            </div>

                            <div>
                                <span class="order-label">
                                    ORDER NUMBER
                                </span>

                                <h5>
                                    {{ $order->order_number }}
                                </h5>

                                <small>
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $order->created_at->format('d M Y, h:i A') }}
                                </small>
                            </div>

                        </div>

                        <div class="order-items-count">

                            <span class="order-label">
                                ITEMS
                            </span>

                            <strong>
                                {{ $order->orderItems->sum('quantity') }}
                            </strong>

                        </div>

                        <div class="order-total">

                            <span class="order-label">
                                TOTAL
                            </span>

                            <strong>
                                ₹{{ number_format($order->total, 2) }}
                            </strong>

                        </div>

                        <div class="order-status">

                            <span class="order-label">
                                STATUS
                            </span>

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

                        <div class="order-action">

                            <a
                                href="{{ route('orders.show', $order) }}"
                                class="btn btn-sm btn-outline-aroma"
                            >
                                View Details
                                <i class="bi bi-arrow-right ms-1"></i>
                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>

        @else

            <div class="empty-orders text-center">

                <div class="empty-orders-icon">
                    <i class="bi bi-box-seam"></i>
                </div>

                <h2>No Orders Yet</h2>

                <p class="text-muted">
                    You haven't placed any orders yet.
                    Discover your signature scent and begin your Aroma journey.
                </p>

                <a
                    href="{{ route('perfumes.index') }}"
                    class="btn btn-aroma mt-3"
                >
                    <i class="bi bi-stars me-2"></i>
                    Explore Perfumes
                </a>

            </div>

        @endif

    </div>
</section>

@endsection