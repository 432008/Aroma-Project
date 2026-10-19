@extends('layouts.app')

@section('title', 'Add Category - Aroma Admin')

@section('content')

<section class="admin-page-section py-5">
    <div class="container-fluid px-lg-5">

        {{-- Header --}}
        <div class="admin-header mb-4">

            <div>
                <span class="admin-label">AROMA ADMINISTRATION</span>
                <h1>Add Category</h1>
                <p class="text-muted mb-0">
                    Create a new perfume category for your Aroma store.
                </p>
            </div>

            <div>
                <a
                    href="{{ route('admin.categories.index') }}"
                    class="btn btn-outline-aroma"
                >
                    <i class="bi bi-arrow-left me-2"></i>
                    Back to Categories
                </a>
            </div>

        </div>

        {{-- Validation Errors --}}
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
            action="{{ route('admin.categories.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            <div class="row g-4">

                {{-- Category Information --}}
                <div class="col-lg-8">

                    <div class="admin-section-card">

                        <div class="admin-section-header">

                            <div>
                                <span class="admin-label">CATEGORY</span>
                                <h2>Category Information</h2>
                            </div>

                            <span class="profile-icon">
                                <i class="bi bi-grid"></i>
                            </span>

                        </div>

                        <div class="row">

                            {{-- Name --}}
                            <div class="col-md-8 mb-3">

                                <label
                                    for="name"
                                    class="form-label"
                                >
                                    Category Name
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control"
                                    value="{{ old('name') }}"
                                    placeholder="Example: Floral"
                                    required
                                >

                            </div>

                            {{-- Status --}}
                            <div class="col-md-4 mb-3">

                                <label
                                    for="status"
                                    class="form-label"
                                >
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

                            {{-- Description --}}
                            <div class="col-12 mb-3">

                                <label
                                    for="description"
                                    class="form-label"
                                >
                                    Description
                                </label>

                                <textarea
                                    id="description"
                                    name="description"
                                    class="form-control"
                                    rows="6"
                                    placeholder="Write a short description about this perfume category..."
                                >{{ old('description') }}</textarea>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- Category Image --}}
                <div class="col-lg-4">

                    <div class="admin-section-card">

                        <div class="admin-section-header">

                            <div>
                                <span class="admin-label">VISUAL</span>
                                <h2>Category Image</h2>
                            </div>

                            <span class="profile-icon">
                                <i class="bi bi-image"></i>
                            </span>

                        </div>

                        <div class="mb-4">

                            <label
                                for="image"
                                class="form-label"
                            >
                                Upload Image
                            </label>

                            <input
                                type="file"
                                id="image"
                                name="image"
                                class="form-control"
                                accept=".jpg,.jpeg,.png,.webp"
                            >

                            <small class="text-muted d-block mt-2">
                                JPG, JPEG, PNG or WEBP.
                                Maximum 2 MB.
                            </small>

                        </div>

                        <div class="category-image-upload-info text-center py-4">

                            <div class="empty-state-icon mb-3">
                                <i class="bi bi-image"></i>
                            </div>

                            <h3>
                                Category Image
                            </h3>

                            <p class="text-muted mb-0">
                                Use a high-quality image that represents
                                the fragrance category.
                            </p>

                        </div>

                        <hr class="my-4">

                        <button
                            type="submit"
                            class="btn btn-aroma w-100"
                        >
                            <i class="bi bi-plus-lg me-2"></i>
                            Create Category
                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>
</section>

@endsection