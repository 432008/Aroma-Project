@extends('layouts.app')

@section('title', 'Manage Categories - Aroma Admin')

@section('content')

<section class="admin-page-section py-5">
    <div class="container-fluid px-lg-5">

        {{-- Header --}}
        <div class="admin-header mb-4">

            <div>
                <span class="admin-label">AROMA ADMINISTRATION</span>
                <h1>Categories</h1>
                <p class="text-muted mb-0">
                    Manage perfume categories for your Aroma store.
                </p>
            </div>

            <div>
                <a
                    href="{{ route('admin.categories.create') }}"
                    class="btn btn-aroma"
                >
                    <i class="bi bi-plus-lg me-2"></i>
                    Add Category
                </a>
            </div>

        </div>

        {{-- Messages --}}


        {{-- Categories --}}
        <div class="admin-section-card">

            <div class="admin-section-header">

                <div>
                    <span class="admin-label">CATEGORY MANAGEMENT</span>
                    <h2>All Categories</h2>
                </div>

                <span class="profile-icon">
                    <i class="bi bi-grid"></i>
                </span>

            </div>

            @if($categories->count())

                <div class="table-responsive">

                    <table class="table admin-table align-middle">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Slug</th>
                                <th>Products</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($categories as $category)

                                <tr>

                                    <td>
                                        {{ $categories->firstItem() + $loop->index }}
                                    </td>

                                    {{-- Image --}}
                                    <td>

                                        <div class="admin-table-image">

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

                                    </td>

                                    {{-- Name --}}
                                    <td>

                                        <strong>
                                            {{ $category->name }}
                                        </strong>

                                        @if($category->description)

                                            <small class="text-muted d-block">
                                                {{ Str::limit($category->description, 45) }}
                                            </small>

                                        @endif

                                    </td>

                                    {{-- Slug --}}
                                    <td>
                                        <span class="text-muted">
                                            {{ $category->slug }}
                                        </span>
                                    </td>

                                    {{-- Products --}}
                                    <td>

                                        <span class="badge bg-light text-dark border">
                                            {{ $category->products_count }}
                                            {{ $category->products_count == 1 ? 'Product' : 'Products' }}
                                        </span>

                                    </td>

                                    {{-- Status --}}
                                    <td>

                                        @if($category->status === 'active')

                                            <span class="badge bg-success">
                                                Active
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                Inactive
                                            </span>

                                        @endif

                                    </td>

                                    {{-- Date --}}
                                    <td>
                                        {{ $category->created_at->format('d M Y') }}
                                    </td>

                                    {{-- Actions --}}
                                    <td>

                                        <div class="d-flex justify-content-end gap-2">

                                            <a
                                                href="{{ route('admin.categories.show', $category) }}"
                                                class="btn btn-sm btn-outline-aroma"
                                                title="View Category"
                                            >
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <a
                                                href="{{ route('admin.categories.edit', $category) }}"
                                                class="btn btn-sm btn-outline-aroma"
                                                title="Edit Category"
                                            >
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form
                                                action="{{ route('admin.categories.destroy', $category) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this category?');"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Delete Category"
                                                >
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                {{-- Pagination --}}
                @if($categories->hasPages())

                    <div class="mt-4">
                        {{ $categories->links() }}
                    </div>

                @endif

            @else

                {{-- Empty State --}}
                <div class="text-center py-5">

                    <div class="empty-state-icon mb-3">
                        <i class="bi bi-grid"></i>
                    </div>

                    <h3>No Categories Found</h3>

                    <p class="text-muted">
                        You haven't created any perfume categories yet.
                    </p>

                    <a
                        href="{{ route('admin.categories.create') }}"
                        class="btn btn-aroma mt-2"
                    >
                        <i class="bi bi-plus-lg me-2"></i>
                        Create First Category
                    </a>

                </div>

            @endif

        </div>

    </div>
</section>

@endsection