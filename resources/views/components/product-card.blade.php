@props(['product'])

@php
    $isOutOfStock = (int) $product->stock <= 0;
    $discount = $product->discount_percentage;
    $rating = (float) ($product->reviews_avg_rating ?? 0);
    $reviewCount = (int) ($product->reviews_count ?? 0);
@endphp

<div class="product-card h-100">

    <!-- Product Image -->
    <div class="product-image-wrapper">

        @if($discount)
            <span class="product-discount">
                -{{ $discount }}% OFF
            </span>
        @elseif($isOutOfStock)
            <span class="product-discount">
                Sold Out
            </span>
        @endif

        <a href="{{ url('/perfumes/' . $product->slug) }}" tabindex="-1" aria-hidden="true">

            @if($product->image)
                <img
                    src="{{ asset('storage/' . $product->image) }}"
                    alt="{{ $product->name }}"
                    class="product-image"
                    loading="lazy"
                >
            @else
                <div class="product-image-placeholder">
                    <i class="bi bi-droplet"></i>
                </div>
            @endif

        </a>

        <!-- Quick Actions -->
        <div class="product-actions">

            <a href="{{ url('/perfumes/' . $product->slug) }}"
               class="product-action-btn"
               title="View details"
               aria-label="View details for {{ $product->name }}">

                <i class="bi bi-eye" aria-hidden="true"></i>

            </a>

            @if(!$isOutOfStock)

                @auth

                    <form action="{{ route('cart.add', $product) }}"
                          method="POST"
                          class="d-inline">

                        @csrf

                        <button type="submit"
                                class="product-action-btn"
                                title="Add to cart"
                                aria-label="Add {{ $product->name }} to cart">

                            <i class="bi bi-bag-plus" aria-hidden="true"></i>

                        </button>

                    </form>

                @else

                    <a href="{{ url('/login') }}"
                       class="product-action-btn"
                       title="Login to add to cart"
                       aria-label="Login to add {{ $product->name }} to cart">

                        <i class="bi bi-bag-plus" aria-hidden="true"></i>

                    </a>

                @endauth

            @endif

        </div>

    </div>


    <!-- Product Information -->
    <div class="product-info">

        <p class="product-category">
            {{ $product->category->name ?? 'Perfume' }}
        </p>

        <h3 class="product-name">

            <a href="{{ url('/perfumes/' . $product->slug) }}">
                {{ $product->name }}
            </a>

        </h3>


        <!-- Rating -->
        <div class="product-rating">

            @if($reviewCount > 0)

                <x-stars :rating="$rating" :count="$reviewCount" />

            @else

                <span class="stars stars--empty" aria-label="No reviews yet">

                    @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star" aria-hidden="true"></i>
                    @endfor

                    <span class="count">No reviews yet</span>

                </span>

            @endif

        </div>


        <!-- Price -->
        <div class="product-price">

            @if($product->discount_price)

                <span class="current-price">
                    â‚¹{{ number_format($product->discount_price, 2) }}
                </span>

                <span class="old-price">
                    â‚¹{{ number_format($product->price, 2) }}
                </span>

            @else

                <span class="current-price">
                    â‚¹{{ number_format($product->price, 2) }}
                </span>

            @endif

        </div>


        <!-- Add To Cart -->
        @if($isOutOfStock)

            <span class="aroma-add-cart is-out">
                <i class="bi bi-x-circle me-2" aria-hidden="true"></i>
                Out of Stock
            </span>

        @elseif(auth()->check())

            <form action="{{ route('cart.add', $product) }}"
                  method="POST">

                @csrf

                <input type="hidden" name="quantity" value="1">

                <button type="submit"
                        class="aroma-add-cart w-100">

                    <i class="bi bi-bag-plus me-2" aria-hidden="true"></i>
                    Add to Cart

                </button>

            </form>

        @else

            <a href="{{ url('/login') }}"
               class="aroma-add-cart w-100">

                <i class="bi bi-person me-2" aria-hidden="true"></i>
                Login to Purchase

            </a>

        @endif

    </div>

</div>
