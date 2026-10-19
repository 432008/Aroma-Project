@extends('layouts.app')

@section('title', 'Perfumes | Aroma')

@section('meta_description', 'Explore the complete Aroma luxury perfume collection.')

@section('content')

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="text-center">
            <span class="section-subtitle">AROMA COLLECTION</span>

            <h1>
                @isset($category)
                    {{ $category->name }} Perfumes
                @else
                    Discover Our Perfumes
                @endisset
            </h1>

            <p>
                @isset($category)
                    {{ $category->description }}
                @else
                    Find the perfect fragrance for every mood, moment and personality.
                @endisset
            </p>
        </div>
    </div>
</section>


<!-- Perfumes Section -->
<section class="section-padding bg-cream">
    <div class="container">

        <!-- Search & Filter -->
        <div class="filter-box mb-4">

            <form action="{{ route('perfumes.index') }}" method="GET">

                <div class="row g-3 align-items-end">

                    <!-- Search -->
                    <div class="col-lg-6 col-md-6">
                        <label class="form-label" for="searchPerfumes">Search Perfumes</label>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-search" aria-hidden="true"></i>
                            </span>

                            <input
                                type="text"
                                id="searchPerfumes"
                                name="search"
                                class="form-control"
                                value="{{ request('search') }}"
                                placeholder="Search fragrance..."
                            >
                        </div>
                    </div>


                    <!-- Category -->
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label" for="filterCategory">Category</label>

                        <select name="category" id="filterCategory" class="form-select auto-submit">

                            <option value="">All Categories</option>

                            @foreach($categories ?? [] as $item)
                                <option
                                    value="{{ $item->slug }}"
                                    @selected(request('category') == $item->slug || (isset($category) && $category->slug === $item->slug))
                                >
                                    {{ $item->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>


                    <!-- Gender -->
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label" for="filterGender">Gender</label>

                        <select name="gender" id="filterGender" class="form-select auto-submit">

                            <option value="">All</option>

                            <option
                                value="Men"
                                @selected(request('gender') == 'Men')
                            >
                                Men
                            </option>

                            <option
                                value="Women"
                                @selected(request('gender') == 'Women')
                            >
                                Women
                            </option>

                            <option
                                value="Unisex"
                                @selected(request('gender') == 'Unisex')
                            >
                                Unisex
                            </option>

                        </select>
                    </div>


                    <!-- Minimum Price -->
                    <div class="col-lg-2 col-md-4">
                        <label class="form-label" for="filterMinPrice">Min Price</label>

                        <input
                            type="number"
                            id="filterMinPrice"
                            name="min_price"
                            class="form-control"
                            value="{{ request('min_price') }}"
                            placeholder="₹ Min"
                            min="0"
                        >
                    </div>


                    <!-- Maximum Price -->
                    <div class="col-lg-2 col-md-4">
                        <label class="form-label" for="filterMaxPrice">Max Price</label>

                        <input
                            type="number"
                            id="filterMaxPrice"
                            name="max_price"
                            class="form-control"
                            value="{{ request('max_price') }}"
                            placeholder="₹ Max"
                            min="0"
                        >
                    </div>


                    <!-- Sort -->
                    <div class="col-lg-3 col-md-4">
                        <label class="form-label" for="filterSort">Sort By</label>

                        <select name="sort" id="filterSort" class="form-select auto-submit">

                            <option value="">Latest</option>

                            <option
                                value="price_low"
                                @selected(request('sort') == 'price_low')
                            >
                                Price: Low to High
                            </option>

                            <option
                                value="price_high"
                                @selected(request('sort') == 'price_high')
                            >
                                Price: High to Low
                            </option>

                            <option
                                value="newest"
                                @selected(request('sort') == 'newest')
                            >
                                Newest
                            </option>

                        </select>
                    </div>


                    <!-- Buttons -->
                    <div class="col-lg-3 col-md-6">

                        <button
                            type="submit"
                            class="btn btn-aroma w-100"
                        >
                            <i class="bi bi-funnel me-2" aria-hidden="true"></i>
                            Apply Filters
                        </button>

                    </div>

                    <div class="col-lg-2 col-md-6">

                        <a
                            href="{{ route('perfumes.index') }}"
                            class="btn btn-outline-aroma w-100"
                        >
                            Reset
                        </a>

                    </div>

                </div>

            </form>

        </div>


        <!-- Active Filters -->
        @php
            $activeFilters = collect([
                'search' => request('search'),
                'category' => request('category'),
                'gender' => request('gender'),
                'min_price' => request('min_price'),
                'max_price' => request('max_price'),
                'sort' => request('sort'),
            ])->filter();
        @endphp

        @if($activeFilters->isNotEmpty())

            <div class="filter-chips">

                <span class="small text-uppercase text-muted me-1">
                    Active:
                </span>

                @foreach($activeFilters as $key => $value)

                    <a
                        href="{{ route('perfumes.index', request()->except($key)) }}"
                        class="filter-chip"
                        title="Remove {{ str_replace('_', ' ', $key) }} filter"
                    >
                        {{ \Illuminate\Support\Str::headline($key) }}:

                        @if($key === 'category')
                            {{ ($categories ?? collect())->firstWhere('slug', $value)->name ?? $value }}
                        @else
                            {{ $value }}
                        @endif

                        <i class="bi bi-x-lg" aria-hidden="true"></i>
                    </a>

                @endforeach

                <a href="{{ route('perfumes.index') }}" class="filter-chip">
                    Clear all
                    <i class="bi bi-x-lg" aria-hidden="true"></i>
                </a>

            </div>

        @endif


        <!-- Result Information -->
        <div class="results-bar">

            <div>
                <p class="results-count">
                    @if($products->total() > 0)
                        Showing {{ $products->firstItem() }}
                        -
                        {{ $products->lastItem() }}
                        of {{ $products->total() }} perfumes
                    @else
                        No perfumes found
                    @endif
                </p>

                @if(request()->filled('search'))
                    <small class="text-muted">
                        Search results for:
                        <strong>{{ request('search') }}</strong>
                    </small>
                @endif
            </div>

            <a href="{{ route('perfumes.index') }}" class="small text-uppercase text-muted">
                View all
            </a>

        </div>


        <!-- Products -->
        <h2 class="visually-hidden">Perfume Results</h2>

        <div class="row g-4">

            @forelse($products as $product)

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <x-product-card :product="$product" />
                </div>

            @empty

                <div class="col-12">

                    <div class="empty-state text-center">

                        <div class="empty-icon">
                            <i class="bi bi-droplet"></i>
                        </div>

                        <h3>No Perfumes Found</h3>

                        <p>
                            We couldn't find any fragrances matching your
                            search or filters.
                        </p>

                        <a
                            href="{{ route('perfumes.index') }}"
                            class="btn btn-aroma"
                        >
                            View All Perfumes
                        </a>

                    </div>

                </div>

            @endforelse

        </div>


        <!-- Pagination -->
        @if($products->hasPages())

            <div class="pagination-wrapper mt-5">

                {{ $products->links() }}

            </div>

        @endif

    </div>
</section>

@endsection