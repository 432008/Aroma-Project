@extends('layouts.app')

@section('title', 'Add Product - Aroma Admin')

@section('content')

<section class="admin-page-section py-5">
    <div class="container-fluid px-lg-5">

        <div class="admin-header mb-4">

            <div>
                <span class="admin-label">AROMA ADMINISTRATION</span>
                <h1>Add Product</h1>
                <p class="text-muted mb-0">
                    Add a new perfume to your Aroma collection.
                </p>
            </div>

            <div>
                <a
                    href="{{ route('admin.products.index') }}"
                    class="btn btn-outline-aroma"
                >
                    <i class="bi bi-arrow-left me-2"></i>
                    Back to Products
                </a>
            </div>

        </div>

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

        <form
            action="{{ route('admin.products.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            <div class="row g-4">

                {{-- Product Information --}}
                <div class="col-lg-8">

                    <div class="admin-section-card">

                        <div class="admin-section-header">

                            <div>
                                <span class="admin-label">PRODUCT</span>
                                <h2>Product Information</h2>
                            </div>

                            <span class="profile-icon">
                                <i class="bi bi-droplet"></i>
                            </span>

                        </div>

                        <div class="row">

                            {{-- Name --}}
                            <div class="col-md-8 mb-3">

                                <label for="name" class="form-label">
                                    Product Name
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control"
                                    value="{{ old('name') }}"
                                    placeholder="Example: Aroma Noir"
                                    required
                                >

                            </div>

                            {{-- Category --}}
                            <div class="col-md-4 mb-3">

                                <label for="category_id" class="form-label">
                                    Category
                                    <span class="text-danger">*</span>
                                </label>

                                <select
                                    id="category_id"
                                    name="category_id"
                                    class="form-select"
                                    required
                                >

                                    <option value="">
                                        Select Category
                                    </option>

                                    @foreach($categories as $category)

                                        <option
                                            value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                                        >
                                            {{ $category->name }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            {{-- Gender --}}
                            <div class="col-md-4 mb-3">

                                <label for="gender" class="form-label">
                                    Gender
                                    <span class="text-danger">*</span>
                                </label>

                                <select
                                    id="gender"
                                    name="gender"
                                    class="form-select"
                                    required
                                >

                                    <option value="">
                                        Select Gender
                                    </option>

                                    <option
                                        value="Men"
                                        {{ old('gender') === 'Men' ? 'selected' : '' }}
                                    >
                                        Men
                                    </option>

                                    <option
                                        value="Women"
                                        {{ old('gender') === 'Women' ? 'selected' : '' }}
                                    >
                                        Women
                                    </option>

                                    <option
                                        value="Unisex"
                                        {{ old('gender') === 'Unisex' ? 'selected' : '' }}
                                    >
                                        Unisex
                                    </option>

                                </select>

                            </div>

                            {{-- Price --}}
                            <div class="col-md-4 mb-3">

                                <label for="price" class="form-label">
                                    Regular Price (₹)
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="number"
                                    id="price"
                                    name="price"
                                    class="form-control"
                                    value="{{ old('price') }}"
                                    placeholder="2499"
                                    min="0"
                                    step="0.01"
                                    required
                                >

                            </div>

                            {{-- Discount Price --}}
                            <div class="col-md-4 mb-3">

                                <label for="discount_price" class="form-label">
                                    Discount Price (₹)
                                </label>

                                <input
                                    type="number"
                                    id="discount_price"
                                    name="discount_price"
                                    class="form-control"
                                    value="{{ old('discount_price') }}"
                                    placeholder="2199"
                                    min="0"
                                    step="0.01"
                                >

                            </div>

                            {{-- Description --}}
                            <div class="col-12 mb-3">

                                <label for="description" class="form-label">
                                    Description
                                    <span class="text-danger">*</span>
                                </label>

                                <textarea
                                    id="description"
                                    name="description"
                                    class="form-control"
                                    rows="5"
                                    placeholder="Write a beautiful description for the perfume..."
                                    required
                                >{{ old('description') }}</textarea>

                            </div>

                        </div>

                    </div>

                    {{-- Fragrance Notes --}}
                    <div class="admin-section-card mt-4">

                        <div class="admin-section-header">

                            <div>
                                <span class="admin-label">FRAGRANCE</span>
                                <h2>Scent Notes</h2>
                            </div>

                            <span class="profile-icon">
                                <i class="bi bi-flower1"></i>
                            </span>

                        </div>

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label for="top_notes" class="form-label">
                                    Top Notes
                                </label>

                                <textarea
                                    id="top_notes"
                                    name="top_notes"
                                    class="form-control"
                                    rows="4"
                                    placeholder="Example: Bergamot, Lemon, Apple"
                                >{{ old('top_notes') }}</textarea>

                            </div>

                            <div class="col-md-4 mb-3">

                                <label for="heart_notes" class="form-label">
                                    Heart Notes
                                </label>

                                <textarea
                                    id="heart_notes"
                                    name="heart_notes"
                                    class="form-control"
                                    rows="4"
                                    placeholder="Example: Rose, Jasmine, Lavender"
                                >{{ old('heart_notes') }}</textarea>

                            </div>

                            <div class="col-md-4 mb-3">

                                <label for="base_notes" class="form-label">
                                    Base Notes
                                </label>

                                <textarea
                                    id="base_notes"
                                    name="base_notes"
                                    class="form-control"
                                    rows="4"
                                    placeholder="Example: Amber, Musk, Sandalwood"
                                >{{ old('base_notes') }}</textarea>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- Product Settings --}}
                <div class="col-lg-4">

                    <div class="admin-section-card">

                        <div class="admin-section-header">

                            <div>
                                <span class="admin-label">SETTINGS</span>
                                <h2>Product Settings</h2>
                            </div>

                        </div>

                        {{-- Stock --}}
                        <div class="mb-3">

                            <label for="stock" class="form-label">
                                Stock Quantity
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="number"
                                id="stock"
                                name="stock"
                                class="form-control"
                                value="{{ old('stock', 0) }}"
                                min="0"
                                required
                            >

                        </div>

                        {{-- Status --}}
                        <div class="mb-4">

                            <label for="status" class="form-label">
                                Status
                                <span class="text-danger">*</span>
                            </label>

                            <select
                                id="status"
                                name="status"
                                class="form-select"
                                required
                            >

                                <option
                                    value="active"
                                    {{ old('status', 'active') === 'active' ? 'selected' : '' }}
                                >
                                    Active
                                </option>

                                <option
                                    value="inactive"
                                    {{ old('status') === 'inactive' ? 'selected' : '' }}
                                >
                                    Inactive
                                </option>

                            </select>

                        </div>

                        {{-- Image --}}
                        <div class="mb-4">

                            <label for="image" class="form-label">
                                Product Image
                            </label>

                            <input
                                type="file"
                                id="image"
                                name="image"
                                class="form-control"
                                accept=".jpg,.jpeg,.png,.webp"
                            >

                            <small class="text-muted d-block mt-2">
                                JPG, JPEG, PNG or WEBP. Maximum 2 MB.
                            </small>

                        </div>

                        <div class="product-upload-note">

                            <i class="bi bi-image"></i>

                            <div>
                                <strong>Product Image</strong>

                                <p class="mb-0">
                                    Use a clear, high-quality perfume bottle
                                    image for the best presentation.
                                </p>
                            </div>

                        </div>

                        <hr class="my-4">

                        <button
                            type="submit"
                            class="btn btn-aroma w-100"
                        >
                            <i class="bi bi-plus-circle me-2"></i>
                            Create Product
                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>
</section>

@endsection