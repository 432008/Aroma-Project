@extends('layouts.app')

@section('title', 'Aroma | Luxury Perfumes')

@section('meta_description', 'Discover Aroma luxury perfumes crafted to express your personality, mood and unforgettable moments.')

@section('content')

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center min-vh-75">

            <div class="col-lg-6">
                <span class="hero-subtitle">
                    LUXURY FRAGRANCE HOUSE
                </span>

                <h1 class="hero-title">
                    Discover Your
                    <span>Signature Scent</span>
                </h1>

                <p class="hero-text">
                    Explore timeless fragrances crafted to express your
                    personality, mood and unforgettable moments.
                </p>

                <div class="hero-buttons">
                    <a href="{{ route('perfumes.index') }}" class="btn btn-aroma">
                        Shop Perfumes
                        <i class="bi bi-arrow-right ms-2"></i>
                    </a>

                    <a href="{{ route('collections.index') }}" class="btn btn-outline-aroma">
                        Explore Collections
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="hero-image-wrapper">
                    <div class="hero-image-circle"></div>

                    <img
                        src="{{ asset('images/banner/perfume-hero.jpg') }}"
                        alt="Aroma Luxury Perfume"
                        class="hero-image"
                    >
                </div>
            </div>

        </div>
    </div>
</section>


<!-- Featured Perfumes -->
<section class="section-padding bg-cream">
    <div class="container">

        <div class="section-heading text-center">
            <span class="section-subtitle">
                OUR SIGNATURE COLLECTION
            </span>

            <h2>Featured Perfumes</h2>

            <p>
                Discover fragrances carefully selected from the world of Aroma.
            </p>
        </div>

        <div class="row g-4">

            @forelse($featuredProducts as $product)

                <div class="col-lg-3 col-md-6">
                    <x-product-card :product="$product" />
                </div>

            @empty

                <div class="col-12">
                    <div class="empty-state text-center">
                        <i class="bi bi-droplet"></i>
                        <h3>No perfumes available</h3>
                        <p>Please check back soon for our latest fragrances.</p>
                    </div>
                </div>

            @endforelse

        </div>

        <div class="text-center mt-5">
            <a href="{{ route('perfumes.index') }}" class="btn btn-aroma">
                View All Perfumes
                <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>

    </div>
</section>


<!-- Why Choose Aroma -->
<section class="section-padding">
    <div class="container">

        <div class="section-heading text-center">
            <span class="section-subtitle">
                THE AROMA EXPERIENCE
            </span>

            <h2>Why Choose Aroma?</h2>

            <p>
                Every detail is created to make your fragrance experience
                unforgettable.
            </p>
        </div>

        <div class="row g-4">

            <div class="col-lg-3 col-md-6">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="bi bi-gem"></i>
                    </div>

                    <h3>Premium Quality</h3>

                    <p>
                        Carefully selected ingredients and premium fragrance
                        compositions.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="bi bi-stars"></i>
                    </div>

                    <h3>Long-Lasting Fragrance</h3>

                    <p>
                        Elegant scents designed to stay with you throughout
                        your day.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>

                    <h3>Elegant Packaging</h3>

                    <p>
                        Beautifully presented fragrances made for yourself
                        or someone special.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="bi bi-truck"></i>
                    </div>

                    <h3>Fast &amp; Secure Delivery</h3>

                    <p>
                        Your Aroma fragrance is carefully packed and delivered
                        safely to your doorstep.
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>


<!-- Collections -->
<section class="section-padding bg-dark-aroma">
    <div class="container">

        <div class="section-heading text-center text-white">
            <span class="section-subtitle">
                FIND YOUR FRAGRANCE
            </span>

            <h2>Explore Our Collections</h2>

            <p>
                From fresh everyday scents to luxurious evening fragrances,
                find the one that feels like you.
            </p>
        </div>

        <div class="row g-4">

            @forelse($categories as $category)

                <div class="col-lg-4 col-md-6">
                    <a
                        href="{{ route('collections.show', $category->slug) }}"
                        class="collection-card"
                    >

                        <div class="collection-image">

                            @if($category->image)
                                <img
                                    src="{{ asset('storage/' . $category->image) }}"
                                    alt="{{ $category->name }}"
                                >
                            @else
                                <div class="collection-placeholder">
                                    <i class="bi bi-flower1"></i>
                                </div>
                            @endif

                            <div class="collection-overlay"></div>

                            <div class="collection-content">
                                <h3>{{ $category->name }}</h3>

                                <p>
                                    {{ Str::limit($category->description, 80) }}
                                </p>

                                <span>
                                    Explore Collection
                                    <i class="bi bi-arrow-right"></i>
                                </span>
                            </div>

                        </div>

                    </a>
                </div>

            @empty

                <div class="col-12 text-center text-white">
                    <p>No collections available.</p>
                </div>

            @endforelse

        </div>

    </div>
</section>


<!-- Reviews -->
@if($testimonials->count())

<section class="section-padding bg-cream">
    <div class="container">

        <div class="section-heading text-center">
            <span class="section-subtitle">
                CUSTOMER LOVE
            </span>

            <h2>What Our Customers Say</h2>

            <p>
                Real experiences shared by the Aroma community.
            </p>
        </div>

        <div class="row g-4 justify-content-center">

            @foreach($testimonials as $testimonial)

                <div class="col-lg-4">
                    <div class="review-card">

                        <div class="review-stars">
                            <x-stars :rating="$testimonial->rating" :count="0" />
                        </div>

                        <p>
                            â€œ{{ $testimonial->comment }}â€
                        </p>

                        <h3>{{ $testimonial->user->name ?? 'Aroma Customer' }}</h3>

                        <span>
                            @if($testimonial->product)
                                {{ $testimonial->product->name }} &middot;
                            @endif
                            Verified Customer
                        </span>

                    </div>
                </div>

            @endforeach

        </div>

    </div>
</section>

@endif


<!-- Newsletter -->
<section class="newsletter-section">
    <div class="container">

        <div class="newsletter-box text-center">

            <span class="section-subtitle">
                JOIN THE AROMA WORLD
            </span>

            <h2>Stay in the World of Aroma</h2>

            <p>
                Subscribe for fragrance inspiration, new arrivals and
                exclusive offers.
            </p>

            <form class="newsletter-form"
                  action="{{ route('newsletter.subscribe') }}"
                  method="POST">

                @csrf

                <div class="input-group">
                    <label for="newsletterEmail" class="visually-hidden">
                        Email address
                    </label>

                    <input
                        type="email"
                        id="newsletterEmail"
                        name="email"
                        class="form-control"
                        placeholder="Enter your email"
                        value="{{ old('email') }}"
                        required
                    >

                    <button type="submit" class="btn btn-aroma">
                        Subscribe
                    </button>
                </div>

            </form>

        </div>

    </div>
</section>

@endsection