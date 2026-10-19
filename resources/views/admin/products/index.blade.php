@extends('layouts.app')

@section('title', 'Manage Products - Aroma Admin')

@section('content')

<section class="admin-page-section py-5">
    <div class="container-fluid px-lg-5">

        <div class="admin-header mb-4">

            <div>
                <span class="admin-label">AROMA ADMINISTRATION</span>
                <h1>Products</h1>
                <p class="text-muted mb-0">
                    Manage your Aroma perfume collection.
                </p>
            </div>

            <div>
                <a
                    href="{{ route('admin.products.create') }}"
                    class="btn btn-aroma"
                >
                    <i class="bi bi-plus-lg me-2"></i>
                    Add Product
                </a>
            </div>

        </div>



        <div class="admin-section-card">

            <div class="admin-section-header">

                <div>
                    <span class="admin-label">INVENTORY</span>
                    <h2>All Products</h2>
                </div>

                <span class="admin-number-badge">
                    {{ $products->total() }}
                </span>

            </div>

            <div class="table-responsive">

                <table class="table admin-table align-middle">

                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Gender</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($products as $product)

                            <tr>

                                {{-- Product --}}
                                <td>
                                    <div class="admin-product-info">

                                        <div class="admin-product-image">

                                            @if($product->image && file_exists(storage_path('app/public/' . $product->image)))

                                                <img
                                                    src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}"
                                                >

                                            @else

                                                <i class="bi bi-droplet"></i>

                                            @endif

                                        </div>

                                        <div>
                                            <strong>
                                                {{ $product->name }}
                                            </strong>

                                            <small>
                                                {{ $product->slug }}
                                            </small>
                                        </div>

                                    </div>
                                </td>

                                {{-- Category --}}
                                <td>
                                    {{ $product->category->name ?? '—' }}
                                </td>

                                {{-- Gender --}}
                                <td>
                                    {{ $product->gender }}
                                </td>

                                {{-- Price --}}
                                <td>

                                    @if($product->discount_price)

                                        <strong>
                                            ₹{{ number_format($product->discount_price, 2) }}
                                        </strong>

                                        <small class="d-block text-muted text-decoration-line-through">
                                            ₹{{ number_format($product->price, 2) }}
                                        </small>

                                    @else

                                        <strong>
                                            ₹{{ number_format($product->price, 2) }}
                                        </strong>

                                    @endif

                                </td>

                                {{-- Stock --}}
                                <td>

                                    @if($product->stock <= 5)

                                        <span class="stock-low">
                                            {{ $product->stock }}
                                        </span>

                                    @elseif($product->stock <= 10)

                                        <span class="stock-medium">
                                            {{ $product->stock }}
                                        </span>

                                    @else

                                        <span class="stock-good">
                                            {{ $product->stock }}
                                        </span>

                                    @endif

                                </td>

                                {{-- Status --}}
                                <td>

                                    @if($product->status === 'active')

                                        <span class="admin-status active">
                                            Active
                                        </span>

                                    @else

                                        <span class="admin-status inactive">
                                            Inactive
                                        </span>

                                    @endif

                                </td>

                                {{-- Actions --}}
                                <td>

                                    <div class="admin-actions justify-content-end">

                                        <a
                                            href="{{ route('admin.products.show', $product) }}"
                                            class="admin-action-btn"
                                            title="View"
                                        >
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a
                                            href="{{ route('admin.products.edit', $product) }}"
                                            class="admin-action-btn"
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form
                                            action="{{ route('admin.products.destroy', $product) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this product?');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="admin-action-btn delete"
                                                title="Delete"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7">

                                    <div class="admin-empty-state py-5">

                                        <i class="bi bi-droplet"></i>

                                        <h3>No Products Found</h3>

                                        <p>
                                            Start building your Aroma collection
                                            by adding your first perfume.
                                        </p>

                                        <a
                                            href="{{ route('admin.products.create') }}"
                                            class="btn btn-aroma"
                                        >
                                            <i class="bi bi-plus-lg me-2"></i>
                                            Add Product
                                        </a>

                                    </div>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            @if($products->hasPages())
                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            @endif

        </div>

    </div>
</section>

@endsection