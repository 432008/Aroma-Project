@extends('layouts.app')

@section('title', 'Product Details - Aroma Admin')

@section('content')

<section class="admin-page-section py-5">
    <div class="container-fluid px-lg-5">

        {{-- Header --}}
        <div class="admin-header mb-4">

            <div>
                <span class="admin-label">AROMA ADMINISTRATION</span>
                <h1>Product Details</h1>
                <p class="text-muted mb-0">
                    View complete information about this product.
                </p>
            </div>

            <div class="d-flex gap-2">

                <a
                    href="{{ route('admin.products.edit', $product) }}"
                    class="btn btn-aroma"
                >
                    <i class="bi bi-pencil me-2"></i>
                    Edit Product
                </a>

                <a
                    href="{{ route('admin.products.index') }}"
                    class="btn btn-outline-aroma"
                >
                    <i class="bi bi-arrow-left me-2"></i>
                    Back
                </a>

            </div>

        </div>

        <div class="row g-4">

            {{-- Product Image --}}
            <div class="col-lg-5">

                <div class="admin-section-card h-100">

                    <div class="product-detail-admin-image">

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

                    </div>

                </div>

            </div>

            {{-- Product Information --}}
            <div class="col-lg-7">

                <div class="admin-section-card h-100">

                    <div class="admin-section-header">

                        <div>
                            <span class="admin-label">PRODUCT INFORMATION</span>
                            <h2>{{ $product->name }}</h2>
                        </div>

                        @if($product->status === 'active')

                            <span class="badge bg-success">
                                Active
                            </span>

                        @else

                            <span class="badge bg-secondary">
                                Inactive
                            </span>

                        @endif

                    </div>

                    <div class="row g-3">

                        <div class="col-md-6">

                            <div class="admin-info-box">

                                <span>Category</span>

                                <strong>
                                    {{ $product->category->name ?? 'N/A' }}
                                </strong>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="admin-info-box">

                                <span>Gender</span>

                                <strong>
                                    {{ $product->gender }}
                                </strong>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="admin-info-box">

                                <span>Regular Price</span>

                                <strong>
                                    ₹{{ number_format($product->price, 2) }}
                                </strong>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="admin-info-box">

                                <span>Discount Price</span>

                                <strong>
                                    @if($product->discount_price)
                                        ₹{{ number_format($product->discount_price, 2) }}
                                    @else
                                        No Discount
                                    @endif
                                </strong>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="admin-info-box">

                                <span>Stock</span>

                                <strong>
                                    {{ $product->stock }} units
                                </strong>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="admin-info-box">

                                <span>Slug</span>

                                <strong>
                                    {{ $product->slug }}
                                </strong>

                            </div>

                        </div>

                    </div>

                    <hr class="my-4">

                    <div class="mb-4">

                        <p class="admin-subtitle">
                            Description
                        </p>

                        <p class="text-muted mb-0">
                            {{ $product->description }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

        {{-- Fragrance Notes --}}
        <div class="admin-section-card mt-4">

            <div class="admin-section-header">

                <div>
                    <span class="admin-label">FRAGRANCE</span>
                    <h3>Scent Notes</h3>
                </div>

                <span class="profile-icon">
                    <i class="bi bi-flower1"></i>
                </span>

            </div>

            <div class="row g-4">

                <div class="col-md-4">

                    <div class="scent-note-box">

                        <div class="scent-note-icon">
                            <i class="bi bi-stars"></i>
                        </div>

                        <h4>Top Notes</h4>

                        <p>
                            {{ $product->top_notes ?: 'No top notes added.' }}
                        </p>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="scent-note-box">

                        <div class="scent-note-icon">
                            <i class="bi bi-flower1"></i>
                        </div>

                        <h4>Heart Notes</h4>

                        <p>
                            {{ $product->heart_notes ?: 'No heart notes added.' }}
                        </p>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="scent-note-box">

                        <div class="scent-note-icon">
                            <i class="bi bi-tree"></i>
                        </div>

                        <h4>Base Notes</h4>

                        <p>
                            {{ $product->base_notes ?: 'No base notes added.' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

        {{-- Product Metadata --}}
        <div class="admin-section-card mt-4">

            <div class="admin-section-header">

                <div>
                    <span class="admin-label">SYSTEM INFORMATION</span>
                    <h3>Product Metadata</h3>
                </div>

            </div>

            <div class="row">

                <div class="col-md-4 mb-3 mb-md-0">

                    <span class="text-muted d-block small">
                        Product ID
                    </span>

                    <strong>
                        #{{ $product->id }}
                    </strong>

                </div>

                <div class="col-md-4 mb-3 mb-md-0">

                    <span class="text-muted d-block small">
                        Created At
                    </span>

                    <strong>
                        {{ $product->created_at->format('d M Y, h:i A') }}
                    </strong>

                </div>

                <div class="col-md-4">

                    <span class="text-muted d-block small">
                        Last Updated
                    </span>

                    <strong>
                        {{ $product->updated_at->format('d M Y, h:i A') }}
                    </strong>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection