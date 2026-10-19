@extends('layouts.app')

@section('title', $product->name . ' | Aroma')

@section('meta_description', $product->description ?? 'Discover ' . $product->name . ' from Aroma luxury perfumes.')

@section('content')

<!-- Product Details -->
<section class="section-padding bg-cream">
    <div class="container">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="{{ route('perfumes.index') }}">
                        Perfumes
                    </a>
                </li>

                <li class="breadcrumb-item active">
                    {{ $product->name }}
                </li>
            </ol>
        </nav>


        <div class="row g-5 align-items-start">

            <!-- Product Image -->
            <div class="col-lg-6">

                <div class="product-detail-image">

                    @if($product->discount_price)
                        <span class="product-sale-badge">
                            SALE
                        </span>
                    @endif

                    @if($product->image)

                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="img-fluid"
                        >

                    @else

                        <div class="product-image-placeholder">
                            <i class="bi bi-droplet"></i>
                            <span>Aroma</span>
                        </div>

                    @endif

                </div>

            </div>


            <!-- Product Information -->
            <div class="col-lg-6">

                <span class="product-category">
                    {{ $product->category->name ?? 'Aroma Collection' }}
                </span>

                <h1 class="product-detail-title">
                    {{ $product->name }}
                </h1>


                <!-- Rating -->
                <div class="product-rating mb-3">

                    @php
                        $averageRating = $product->reviews->avg('rating') ?? 0;
                    @endphp

                    <x-stars :rating="$averageRating" :count="$product->reviews->count()" />

                </div>


                <!-- Price -->
                <div class="product-detail-price mb-4">

                    @if($product->discount_price)

                        <span class="current-price">
                            ₹{{ number_format($product->discount_price, 2) }}
                        </span>

                        <span class="old-price">
                            ₹{{ number_format($product->price, 2) }}
                        </span>

                        @php
                            $discountPercentage = round(
                                (($product->price - $product->discount_price)
                                / $product->price) * 100
                            );
                        @endphp

                        <span class="discount-text">
                            {{ $discountPercentage }}% OFF
                        </span>

                    @else

                        <span class="current-price">
                            ₹{{ number_format($product->price, 2) }}
                        </span>

                    @endif

                </div>


                <!-- Description -->
                <div class="product-description mb-4">

                    <p>
                        {{ $product->description }}
                    </p>

                </div>


                <!-- Product Info -->
                <div class="product-info-list mb-4">

                    <div>
                        <strong>Gender:</strong>
                        <span>{{ $product->gender }}</span>
                    </div>

                    <div>
                        <strong>Category:</strong>
                        <span>{{ $product->category->name ?? '-' }}</span>
                    </div>

                    <div>
                        <strong>Availability:</strong>

                        @if($product->stock > 0)

                            <span class="text-success">
                                In Stock ({{ $product->stock }})
                            </span>

                        @else

                            <span class="text-danger">
                                Out of Stock
                            </span>

                        @endif

                    </div>

                </div>


                <!-- Add To Cart -->
                @auth

                    @if($product->stock > 0)

                        <form
                            action="{{ route('cart.add', $product) }}"
                            method="POST"
                            class="mb-4"
                        >

                            @csrf

                            <div class="row g-2">

                                <div class="col-sm-3">

                                    <label class="form-label" for="quantity">
                                        Quantity
                                    </label>

                                    <input
                                        type="number"
                                        id="quantity"
                                        name="quantity"
                                        class="form-control"
                                        value="1"
                                        min="1"
                                        max="{{ $product->stock }}"
                                        required
                                    >

                                </div>

                                <div class="col-sm-9">

                                    <label class="form-label d-block">
                                        &nbsp;
                                    </label>

                                    <button
                                        type="submit"
                                        class="btn btn-aroma btn-lg w-100"
                                    >
                                        <i class="bi bi-bag-plus me-2"></i>
                                        Add to Cart
                                    </button>

                                </div>

                            </div>

                        </form>

                    @else

                        <button
                            class="btn btn-secondary btn-lg w-100 mb-4"
                            disabled
                        >
                            Out of Stock
                        </button>

                    @endif

                @else

                    <a
                        href="{{ route('login') }}"
                        class="btn btn-aroma btn-lg w-100 mb-4"
                    >
                        Login to Purchase
                    </a>

                @endauth


                <!-- Fragrance Notes -->
                <div class="fragrance-notes">

                    <h2>Fragrance Notes</h2>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <div class="note-card">
                                <span>TOP NOTES</span>
                                <p>
                                    {{ $product->top_notes ?? 'Elegant opening notes' }}
                                </p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="note-card">
                                <span>HEART NOTES</span>
                                <p>
                                    {{ $product->heart_notes ?? 'Beautiful heart notes' }}
                                </p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="note-card">
                                <span>BASE NOTES</span>
                                <p>
                                    {{ $product->base_notes ?? 'Warm lasting notes' }}
                                </p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>


<!-- Reviews -->
<section class="section-padding">
    <div class="container">

        <div class="section-heading">
            <span class="section-subtitle">
                CUSTOMER REVIEWS
            </span>

            <h2>What Customers Say</h2>
        </div>


        @auth

            <div class="review-form-box mb-5">

                <h3>Write a Review</h3>

                <form
                    action="{{ route('reviews.store', $product) }}"
                    method="POST"
                >

                    @csrf

                    <div class="row g-3">

                        <div class="col-md-4">

                            <label class="form-label" for="rating">
                                Rating
                            </label>

                            <select
                                id="rating"
                                name="rating"
                                class="form-select"
                                required
                            >
                                <option value="">Select Rating</option>
                                <option value="5">★★★★★ - Excellent</option>
                                <option value="4">★★★★☆ - Very Good</option>
                                <option value="3">★★★☆☆ - Good</option>
                                <option value="2">★★☆☆☆ - Fair</option>
                                <option value="1">★☆☆☆☆ - Poor</option>
                            </select>

                        </div>

                        <div class="col-md-8">

                            <label class="form-label" for="comment">
                                Your Review
                            </label>

                            <textarea
                                id="comment"
                                name="comment"
                                class="form-control"
                                rows="3"
                                placeholder="Share your experience..."
                                required
                            ></textarea>

                        </div>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-aroma mt-3"
                    >
                        Submit Review
                    </button>

                </form>

            </div>

        @endauth


        <!-- Existing Reviews -->
        <div class="reviews-list">

            @forelse($product->reviews as $review)

                <div class="review-item">

                    <div class="d-flex justify-content-between">

                        <div>

                            <h4 class="mb-1">
                                {{ $review->user->name ?? 'Customer' }}
                            </h4>

                            <div class="review-stars">

                                <x-stars :rating="$review->rating" :count="0" />

                            </div>

                        </div>

                        <small class="text-muted">
                            {{ $review->created_at->format('d M Y') }}
                        </small>

                    </div>

                    <p class="mt-3 mb-0">
                        {{ $review->comment }}
                    </p>

                </div>

            @empty

                <div class="empty-state text-center">

                    <i class="bi bi-chat-heart"></i>

                    <h3>No reviews yet</h3>

                    <p>
                        Be the first customer to review this perfume.
                    </p>

                </div>

            @endforelse

        </div>

    </div>
</section>


<!-- Related Products -->
@if($relatedProducts->count())

<section class="section-padding bg-cream">

    <div class="container">

        <div class="section-heading text-center">

            <span class="section-subtitle">
                YOU MAY ALSO LIKE
            </span>

            <h2>Related Perfumes</h2>

        </div>


        <div class="row g-4">

            @foreach($relatedProducts as $relatedProduct)

                <div class="col-xl-3 col-lg-4 col-md-6">

                    <x-product-card
                        :product="$relatedProduct"
                    />

                </div>

            @endforeach

        </div>

    </div>

</section>

@endif

@endsection