@extends('layouts.app')

@section('title', 'Collections | Aroma')

@section('meta_description', 'Explore Aroma perfume collections including Floral, Woody, Fresh, Oriental, Luxury and Everyday fragrances.')

@section('content')

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="text-center">
            <span class="section-subtitle">THE WORLD OF AROMA</span>

            <h1>Our Collections</h1>

            <p>
                Discover a fragrance collection created for every personality,
                mood and unforgettable moment.
            </p>
        </div>
    </div>
</section>


<!-- Collections -->
<section class="section-padding bg-cream">

    <div class="container">

        <div class="row g-4">

            @forelse($categories as $category)

                <div class="col-lg-4 col-md-6">

                    <a
                        href="{{ route('collections.show', $category->slug) }}"
                        class="collection-card collection-card-large"
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

                                <span class="collection-number">
                                    {{ sprintf('%02d', $loop->iteration) }}
                                </span>

                                <h2>{{ $category->name }}</h2>

                                <p>
                                    {{ $category->description }}
                                </p>

                                <span class="collection-products">
                                    {{ $category->products_count }}
                                    {{ Str::plural('Perfume', $category->products_count) }}
                                </span>

                                <div class="collection-link">
                                    Explore Collection
                                    <i class="bi bi-arrow-right"></i>
                                </div>

                            </div>

                        </div>

                    </a>

                </div>

            @empty

                <div class="col-12">

                    <div class="empty-state text-center">

                        <div class="empty-icon">
                            <i class="bi bi-flower1"></i>
                        </div>

                        <h3>No Collections Available</h3>

                        <p>
                            Our fragrance collections will be available soon.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</section>


<!-- Collection Philosophy -->
<section class="section-padding">

    <div class="container">

        <div class="row align-items-center g-5">

            <div class="col-lg-6">

                <div class="collection-philosophy-image">

                    @if(file_exists(public_path('images/collections/collection-story.jpg')))

                        <img
                            src="{{ asset('images/collections/collection-story.jpg') }}"
                            alt="Aroma Fragrance Collection"
                            class="img-fluid"
                        >

                    @else

                        <div class="editorial-placeholder">
                            <i class="bi bi-flower1" aria-hidden="true"></i>
                            <span>The Aroma Collection</span>
                        </div>

                    @endif

                </div>

            </div>


            <div class="col-lg-6">

                <span class="section-subtitle">
                    FIND YOUR AROMA
                </span>

                <h2 class="display-heading">
                    A Fragrance For Every Chapter
                </h2>

                <p>
                    Every Aroma collection tells a different story. From the
                    delicate beauty of floral fragrances to the rich character
                    of woody and oriental scents, each composition is designed
                    to create a lasting impression.
                </p>

                <p>
                    Whether you are looking for an everyday fragrance or a
                    luxurious scent for a special evening, there is an Aroma
                    waiting to become part of your story.
                </p>

                <a
                    href="{{ route('perfumes.index') }}"
                    class="btn btn-aroma mt-3"
                >
                    Discover All Perfumes
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>

            </div>

        </div>

    </div>

</section>


<!-- CTA -->
<section class="cta-section">

    <div class="container">

        <div class="cta-box text-center">

            <span class="section-subtitle">
                YOUR SIGNATURE AWAITS
            </span>

            <h2>Find The Scent That Feels Like You</h2>

            <p>
                Explore our complete fragrance collection and discover your
                next signature scent.
            </p>

            <a
                href="{{ route('perfumes.index') }}"
                class="btn btn-aroma"
            >
                Shop Aroma
                <i class="bi bi-arrow-right ms-2"></i>
            </a>

        </div>

    </div>

</section>

@endsection