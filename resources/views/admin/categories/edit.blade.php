@extends('layouts.app')

@section('title', 'Edit Category - Aroma Admin')

@section('content')

<section class="admin-page-section py-5">
    <div class="container-fluid px-lg-5">

        {{-- Header --}}
        <div class="admin-header mb-4">

            <div>
                <span class="admin-label">AROMA ADMINISTRATION</span>

                <h1>Edit Category</h1>

                <p class="text-muted mb-0">
                    Update {{ $category->name }} information.
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

        {{-- Success Message --}}

        <form
            action="{{ route('admin.categories.update', $category) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')

            <div class="row g-4">

                {{-- Category Information --}}
                <div class="col-lg-8">

                    <div class="admin-section-card">

                        <div class="admin-section-header">

                            <div>

                                <span class="admin-label">
                                    CATEGORY
                                </span>

                                <h2>
                                    Category Information
                                </h2>

                            </div>

                            <span class="profile-icon">

                                <i class="bi bi-grid"></i>

                            </span>

                        </div>

                        <div class="row">

                            {{-- Category Name --}}
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
                                    value="{{ old('name', $category->name) }}"
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
                                        {{ old('status', $category->status) === 'active' ? 'selected' : '' }}
                                    >
                                        Active
                                    </option>

                                    <option
                                        value="inactive"
                                        {{ old('status', $category->status) === 'inactive' ? 'selected' : '' }}
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
                                >{{ old('description', $category->description) }}</textarea>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- Image Settings --}}
                <div class="col-lg-4">

                    <div class="admin-section-card">

                        <div class="admin-section-header">

                            <div>

                                <span class="admin-label">
                                    VISUAL
                                </span>

                                <h2>
                                    Category Image
                                </h2>

                            </div>

                            <span class="profile-icon">

                                <i class="bi bi-image"></i>

                            </span>

                        </div>

                        {{-- Current Image --}}
                        <div class="mb-4">

                            <label class="form-label">
                                Current Image
                            </label>

                            <div class="admin-current-image">

                                @if(
                                    $category->image &&
                                    file_exists(
                                        storage_path(
                                            'app/public/' . $category->image
                                        )
                                    )
                                )

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

                        {{-- Replace Image --}}
                        <div class="mb-4">

                            <label
                                for="image"
                                class="form-label"
                            >
                                Replace Image
                            </label>

                            <input
                                type="file"
                                id="image"
                                name="image"
                                class="form-control"
                                accept=".jpg,.jpeg,.png,.webp"
                            >

                            <small class="text-muted d-block mt-2">
                                Leave empty to keep the current image.
                                JPG, JPEG, PNG or WEBP.
                                Maximum 2 MB.
                            </small>

                        </div>

                        <hr class="my-4">

                        <button
                            type="submit"
                            class="btn btn-aroma w-100"
                        >

                            <i class="bi bi-save me-2"></i>

                            Update Category

                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>
</section>

@endsection