@extends('layouts.app')

@section('title', 'Category Details - Aroma Admin')

@section('content')

<section class="admin-page-section py-5">
    <div class="container-fluid px-lg-5">

        {{-- Header --}}
        <div class="admin-header mb-4">

            <div>
                <span class="admin-label">AROMA ADMINISTRATION</span>
                <h1>Category Details</h1>
                <p class="text-muted mb-0">
                    View complete information about this category.
                </p>
            </div>

            <div class="d-flex gap-2">

                <a
                    href="{{ route('admin.categories.edit', $category) }}"
                    class="btn btn-aroma"
                >
                    <i class="bi bi-pencil me-2"></i>
                    Edit Category
                </a>

                <a
                    href="{{ route('admin.categories.index') }}"
                    class="btn btn-outline-aroma"
                >
                    <i class="bi bi-arrow-left me-2"></i>
                    Back
                </a>

            </div>

        </div>

        <div class="row g-4">

            {{-- Image --}}
            <div class="col-lg-4">

                <div class="admin-section-card h-100">

                    <div class="admin-section-header">

                        <div>
                            <span class="admin-label">VISUAL</span>
                            <h2>Category Image</h2>
                        </div>

                        <span class="profile-icon">
                            <i class="bi bi-image"></i>
                        </span>

                    </div>

                    <div class="product-detail-admin-image">

                        @if($category->image && file_exists(storage_path('app/public/' . $category->image)))

                            <img
                                src="{{ asset('storage/' . $category->image) }}"
                                alt="{{ $category->name }}"
                            >

                        @else

                            <div class="product-placeholder">
                                <i class="bi bi-flower1"></i>
                            </div>

                        @endif

                    </div>

                </div>

            </div>

            {{-- Details --}}
            <div class="col-lg-8">

                <div class="admin-section-card h-100">

                    <div class="admin-section-header">

                        <div>
                            <span class="admin-label">CATEGORY</span>
                            <h2>{{ $category->name }}</h2>
                        </div>

                        <span class="profile-icon">
                            <i class="bi bi-grid"></i>
                        </span>

                    </div>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <div class="admin-info-box">
                                <span>Slug</span>
                                <strong>{{ $category->slug }}</strong>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-info-box">
                                <span>Status</span>
                                <strong>
                                    @if($category->status === 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </strong>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-info-box">
                                <span>Products</span>
                                <strong>
                                    {{ $category->products_count }}
                                    {{ $category->products_count == 1 ? 'Product' : 'Products' }}
                                </strong>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-info-box">
                                <span>Created</span>
                                <strong>{{ $category->created_at->format('d M Y, h:i A') }}</strong>
                            </div>
                        </div>

                        @if($category->description)
                            <div class="col-12">
                                <div class="admin-info-box">
                                    <span>Description</span>
                                    <strong>{{ $category->description }}</strong>
                                </div>
                            </div>
                        @endif

                    </div>

                    <hr class="my-4">

                    <form
                        action="{{ route('admin.categories.destroy', $category) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this category?');"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-outline-danger"
                        >
                            <i class="bi bi-trash me-2"></i>
                            Delete Category
                        </button>

                    </form>

                </div>

            </div>

        </div>

        {{-- Products --}}
        <div class="admin-section-card mt-4">

            <div class="admin-section-header">

                <div>
                    <span class="admin-label">CATALOGUE</span>
                    <h2>Products In This Category</h2>
                </div>

                <span class="profile-icon">
                    <i class="bi bi-bag"></i>
                </span>

            </div>

            @if($products->count())

                <div class="table-responsive">

                    <table class="table admin-table align-middle">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($products as $product)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>

                                        <div class="d-flex align-items-center gap-3">

                                            <div class="admin-table-image">

                                                @if($product->image && file_exists(storage_path('app/public/' . $product->image)))

                                                    <img
                                                        src="{{ asset('storage/' . $product->image) }}"
                                                        alt="{{ $product->name }}"
                                                    >

                                                @else

                                                    <div class="product-placeholder">
                                                        <i class="bi bi-flower1"></i>
                                                    </div>

                                                @endif

                                            </div>

                                            <strong>{{ $product->name }}</strong>

                                        </div>

                                    </td>

                                    <td>
                                        ₹{{ number_format($product->final_price, 2) }}
                                    </td>

                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            {{ $product->stock }}
                                        </span>
                                    </td>

                                    <td>

                                        @if($product->status === 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif

                                    </td>

                                    <td>

                                        <div class="d-flex justify-content-end">

                                            <a
                                                href="{{ route('admin.products.show', $product) }}"
                                                class="btn btn-sm btn-outline-aroma"
                                            >
                                                <i class="bi bi-eye me-1"></i>
                                                View
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                @if($category->products_count > $products->count())

                    <div class="mt-3 text-end">
                        <a
                            href="{{ route('admin.products.index') }}"
                            class="btn btn-outline-aroma btn-sm"
                        >
                            Manage All Products
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>

                @endif

            @else

                <div class="text-center py-5">

                    <div class="empty-state-icon mb-3">
                        <i class="bi bi-bag"></i>
                    </div>

                    <h3>No Products Yet</h3>

                    <p class="text-muted mb-0">
                        There are no products assigned to this category.
                    </p>

                </div>

            @endif

        </div>

    </div>
</section>

@endsection
