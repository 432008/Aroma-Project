@extends('layouts.app')

@section('title', 'Shopping Cart - Aroma')

@section('content')

<section class="page-header">
    <div class="container text-center">
        <p class="text-uppercase small mb-2">Your Selection</p>
        <h1>Shopping Cart</h1>
        <p>Review your fragrances before completing your order.</p>
    </div>
</section>

<section class="cart-section py-5">
    <div class="container">

        @if($cartItems->count() > 0)

            <div class="row g-4">

                {{-- Cart Items --}}
                <div class="col-lg-8">

                    <div class="cart-card">

                        <div class="cart-card-header">
                            <h2 class="mb-0">
                                <i class="bi bi-bag me-2" aria-hidden="true"></i>
                                Your Cart
                            </h2>

                            <span data-cart-header-count>
                                {{ $cartItems->sum('quantity') }}
                                {{ $cartItems->sum('quantity') === 1 ? 'Item' : 'Items' }}
                            </span>
                        </div>

                        @foreach($cartItems as $item)

                            @php
                                $product = $item->product;
                                $price = $product->final_price;
                                $lineSubtotal = $price * $item->quantity;
                            @endphp

                            <div class="cart-item" data-cart-item>

                                {{-- Product Image --}}
                                <div class="cart-product-image">

                                    @if($product->image && file_exists(storage_path('app/public/' . $product->image)))
                                        <img
                                            src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->name }}"
                                            loading="lazy"
                                        >
                                    @else
                                        <div class="product-placeholder">
                                            <i class="bi bi-droplet" aria-hidden="true"></i>
                                        </div>
                                    @endif

                                </div>

                                {{-- Product Information --}}
                                <div class="cart-product-info">

                                    <span class="product-category">
                                        {{ $product->category->name ?? 'Perfume' }}
                                    </span>

                                    <h3>
                                        <a href="{{ route('perfumes.show', $product->slug) }}">
                                            {{ $product->name }}
                                        </a>
                                    </h3>

                                    <p class="cart-price">
                                        ₹{{ number_format($price, 2) }}
                                    </p>

                                    @if($product->discount_price)
                                        <small class="text-muted text-decoration-line-through">
                                            ₹{{ number_format($product->price, 2) }}
                                        </small>
                                    @endif

                                </div>

                                {{-- Quantity --}}
                                <div class="cart-quantity">

                                    <form
                                        action="{{ route('cart.update', $item) }}"
                                        method="POST"
                                        class="cart-update-form"
                                        data-cart-update
                                    >
                                        @csrf
                                        @method('PUT')

                                        <label class="small d-block mb-1" for="quantity-{{ $item->id }}">
                                            Quantity
                                        </label>

                                        <div class="quantity-control">

                                            <button
                                                type="button"
                                                class="quantity-btn"
                                                data-step="-1"
                                                aria-label="Decrease quantity for {{ $product->name }}"
                                            >
                                                −
                                            </button>

                                            <input
                                                type="number"
                                                id="quantity-{{ $item->id }}"
                                                name="quantity"
                                                value="{{ $item->quantity }}"
                                                min="1"
                                                max="{{ $product->stock }}"
                                                class="quantity-input"
                                            >

                                            <button
                                                type="button"
                                                class="quantity-btn"
                                                data-step="1"
                                                aria-label="Increase quantity for {{ $product->name }}"
                                            >
                                                +
                                            </button>

                                        </div>

                                        <span class="visually-hidden" data-cart-status role="status"></span>

                                    </form>

                                </div>

                                {{-- Subtotal --}}
                                <div class="cart-item-total">

                                    <strong data-line-subtotal>
                                        ₹{{ number_format($lineSubtotal, 2) }}
                                    </strong>

                                    <form
                                        action="{{ route('cart.remove', $item) }}"
                                        method="POST"
                                        class="mt-2"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="remove-cart-btn"
                                            title="Remove item"
                                            aria-label="Remove {{ $product->name }} from cart"
                                        >
                                            <i class="bi bi-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>

                                </div>

                            </div>

                        @endforeach

                    </div>

                    <div class="mt-4">
                        <a
                            href="{{ route('perfumes.index') }}"
                            class="btn btn-outline-aroma"
                        >
                            <i class="bi bi-arrow-left me-2" aria-hidden="true"></i>
                            Continue Shopping
                        </a>
                    </div>

                </div>

                {{-- Cart Summary --}}
                <div class="col-lg-4">

                    <div class="cart-summary">

                        <h2>Order Summary</h2>

                        <div class="summary-line">
                            <span>Subtotal</span>
                            <strong data-cart-subtotal>
                                ₹{{ number_format($subtotal, 2) }}
                            </strong>
                        </div>

                        <div class="summary-line">
                            <span>Shipping</span>

                            <strong
                                data-cart-shipping
                                @class(['text-success' => $shipping <= 0])
                            >
                                @if($shipping > 0)
                                    ₹{{ number_format($shipping, 2) }}
                                @else
                                    FREE
                                @endif
                            </strong>
                        </div>

                        <hr>

                        <div class="summary-total">
                            <span>Total</span>
                            <strong data-cart-total>
                                ₹{{ number_format($total, 2) }}
                            </strong>
                        </div>

                        <a
                            href="{{ route('checkout.index') }}"
                            class="btn btn-aroma w-100 mt-4"
                        >
                            Proceed to Checkout
                            <i class="bi bi-arrow-right ms-2" aria-hidden="true"></i>
                        </a>

                        <div class="cart-security mt-4">

                            <div>
                                <i class="bi bi-shield-check" aria-hidden="true"></i>
                                <span>Secure Checkout</span>
                            </div>

                            <div>
                                <i class="bi bi-truck" aria-hidden="true"></i>
                                <span>Fast Delivery</span>
                            </div>

                            <div>
                                <i class="bi bi-credit-card" aria-hidden="true"></i>
                                <span>Cash on Delivery</span>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        @else

            {{-- Empty Cart --}}
            <div class="empty-cart text-center">

                <div class="empty-cart-icon">
                    <i class="bi bi-bag-x" aria-hidden="true"></i>
                </div>

                <h2>Your Cart is Empty</h2>

                <p class="text-muted">
                    Your perfect fragrance is waiting for you.
                    Explore our collection and find your signature scent.
                </p>

                <a
                    href="{{ route('perfumes.index') }}"
                    class="btn btn-aroma mt-3"
                >
                    <i class="bi bi-stars me-2" aria-hidden="true"></i>
                    Explore Perfumes
                </a>

            </div>

        @endif

    </div>
</section>

@endsection
