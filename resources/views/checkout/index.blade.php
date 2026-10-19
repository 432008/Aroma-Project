@extends('layouts.app')

@section('title', 'Checkout - Aroma')

@section('content')

<section class="page-header">
    <div class="container text-center">
        <p class="text-uppercase small mb-2">Complete Your Order</p>
        <h1>Checkout</h1>
        <p>Enter your details and receive your Aroma fragrance at your doorstep.</p>
    </div>
</section>

<section class="checkout-section py-5">
    <div class="container">


        @if($errors->any())
            <div class="alert alert-danger mb-4">
                <strong>Please correct the following errors:</strong>

                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('checkout.place') }}" method="POST">
            @csrf

            <div class="row g-4">

                {{-- Customer Details --}}
                <div class="col-lg-7">

                    <div class="checkout-card">

                        <div class="checkout-card-header">
                            <span class="checkout-number">01</span>

                            <div>
                                <h2>Delivery Information</h2>
                                <p class="mb-0">
                                    Where should we deliver your order?
                                </p>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">
                                    Full Name
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control"
                                    value="{{ old('name', auth()->user()->name) }}"
                                    placeholder="Enter your full name"
                                    required
                                >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">
                                    Email Address
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control"
                                    value="{{ old('email', auth()->user()->email) }}"
                                    placeholder="Enter your email"
                                    required
                                >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">
                                    Phone Number
                                </label>

                                <input
                                    type="text"
                                    id="phone"
                                    name="phone"
                                    class="form-control"
                                    value="{{ old('phone', auth()->user()->phone) }}"
                                    placeholder="Enter your phone number"
                                    required
                                >
                            </div>

                            <div class="col-12 mb-3">
                                <label for="address" class="form-label">
                                    Address
                                </label>

                                <textarea
                                    id="address"
                                    name="address"
                                    class="form-control"
                                    rows="3"
                                    placeholder="House/Flat, Street, Area"
                                    required
                                >{{ old('address', auth()->user()->address) }}</textarea>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="city" class="form-label">
                                    City
                                </label>

                                <input
                                    type="text"
                                    id="city"
                                    name="city"
                                    class="form-control"
                                    value="{{ old('city') }}"
                                    placeholder="City"
                                    required
                                >
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="state" class="form-label">
                                    State
                                </label>

                                <input
                                    type="text"
                                    id="state"
                                    name="state"
                                    class="form-control"
                                    value="{{ old('state') }}"
                                    placeholder="State"
                                    required
                                >
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="pincode" class="form-label">
                                    Pincode
                                </label>

                                <input
                                    type="text"
                                    id="pincode"
                                    name="pincode"
                                    class="form-control"
                                    value="{{ old('pincode') }}"
                                    placeholder="Pincode"
                                    maxlength="6"
                                    required
                                >
                            </div>

                        </div>

                    </div>

                    {{-- Payment --}}
                    <div class="checkout-card mt-4">

                        <div class="checkout-card-header">
                            <span class="checkout-number">02</span>

                            <div>
                                <h2>Payment Method</h2>
                                <p class="mb-0">
                                    Choose your preferred payment option.
                                </p>
                            </div>
                        </div>

                        <div class="payment-option">

                            <input
                                type="radio"
                                name="payment_method"
                                value="COD"
                                id="cod"
                                checked
                            >

                            <label for="cod">

                                <span class="payment-icon">
                                    <i class="bi bi-cash-coin"></i>
                                </span>

                                <span class="payment-content">
                                    <strong>Cash on Delivery</strong>
                                    <small>
                                        Pay when your Aroma order arrives.
                                    </small>
                                </span>

                                <i class="bi bi-check-circle-fill payment-check"></i>

                            </label>

                        </div>

                    </div>

                    <div class="checkout-actions mt-4">

                        <a
                            href="{{ route('cart.index') }}"
                            class="btn btn-outline-aroma"
                        >
                            <i class="bi bi-arrow-left me-2"></i>
                            Back to Cart
                        </a>

                        <button
                            type="submit"
                            class="btn btn-aroma"
                        >
                            Place Order
                            <i class="bi bi-check2-circle ms-2"></i>
                        </button>

                    </div>

                </div>

                {{-- Order Summary --}}
                <div class="col-lg-5">

                    <div class="checkout-summary">

                        <div class="checkout-summary-header">
                            <h2>Your Order</h2>

                            <span>
                                {{ $cartItems->sum('quantity') }} Items
                            </span>
                        </div>

                        @foreach($cartItems as $item)

                            @php
                                $product = $item->product;
                                $price = $product->final_price;
                                $itemSubtotal = $price * $item->quantity;
                            @endphp

                            <div class="checkout-product">

                                <div class="checkout-product-image">

                                    @if($product->image && file_exists(storage_path('app/public/' . $product->image)))
                                        <img
                                            src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->name }}"
                                        >
                                    @else
                                        <div class="product-placeholder">
                                            <i class="bi bi-droplet"></i>
                                        </div>
                                    @endif

                                    <span class="checkout-quantity">
                                        {{ $item->quantity }}
                                    </span>

                                </div>

                                <div class="checkout-product-info">
                                    <h3>{{ $product->name }}</h3>

                                    <span>
                                        {{ $product->category->name ?? 'Perfume' }}
                                    </span>
                                </div>

                                <strong>
                                    ₹{{ number_format($itemSubtotal, 2) }}
                                </strong>

                            </div>

                        @endforeach

                        <hr>

                        <div class="summary-line">
                            <span>Subtotal</span>

                            <strong>
                                ₹{{ number_format($subtotal, 2) }}
                            </strong>
                        </div>

                        <div class="summary-line">
                            <span>Shipping</span>

                            @if($shipping > 0)
                                <strong>
                                    ₹{{ number_format($shipping, 2) }}
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
                                ₹{{ number_format($total, 2) }}
                            </strong>
                        </div>

                        <div class="checkout-note mt-4">
                            <i class="bi bi-shield-check"></i>

                            <div>
                                <strong>Secure Order</strong>

                                <p class="mb-0">
                                    Your order information is securely processed.
                                </p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>
</section>

@endsection