@extends('layouts.app')

@section('title', 'My Profile - Aroma')

@section('content')

<section class="page-header">
    <div class="container text-center">
        <p class="text-uppercase small mb-2">My Account</p>
        <h1>My Profile</h1>
        <p>Manage your personal information and Aroma account.</p>
    </div>
</section>

<section class="profile-section py-5">
    <div class="container">



        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Please correct the following errors:</strong>

                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row g-4">

            {{-- Profile Information --}}
            <div class="col-lg-8">

                <div class="profile-card">

                    <div class="profile-card-header">
                        <div>
                            <span class="profile-label">ACCOUNT</span>
                            <h2>Personal Information</h2>
                        </div>

                        <span class="profile-icon">
                            <i class="bi bi-person"></i>
                        </span>
                    </div>

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">
                                    Full Name
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control"
                                    value="{{ old('name', $user->name) }}"
                                    required
                                >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">
                                    Email Address
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control"
                                    value="{{ old('email', $user->email) }}"
                                    required
                                >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">
                                    Phone Number
                                </label>

                                <input
                                    type="text"
                                    id="phone"
                                    name="phone"
                                    class="form-control"
                                    value="{{ old('phone', $user->phone) }}"
                                    placeholder="Enter phone number"
                                >
                            </div>

                            <div class="col-12 mb-3">
                                <label for="address" class="form-label">
                                    Address
                                </label>

                                <textarea
                                    id="address"
                                    name="address"
                                    class="form-control"
                                    rows="4"
                                    placeholder="Enter your complete address"
                                >{{ old('address', $user->address) }}</textarea>
                            </div>

                            <div class="col-12">
                                <button
                                    type="submit"
                                    class="btn btn-aroma"
                                >
                                    <i class="bi bi-save me-2"></i>
                                    Save Changes
                                </button>
                            </div>

                        </div>
                    </form>

                </div>

                {{-- Change Password --}}
                <div class="profile-card mt-4">

                    <div class="profile-card-header">
                        <div>
                            <span class="profile-label">SECURITY</span>
                            <h2>Change Password</h2>
                        </div>

                        <span class="profile-icon">
                            <i class="bi bi-shield-lock"></i>
                        </span>
                    </div>

                    <form action="{{ route('profile.password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-12 mb-3">
                                <label for="current_password" class="form-label">
                                    Current Password
                                </label>

                                <input
                                    type="password"
                                    id="current_password"
                                    name="current_password"
                                    class="form-control"
                                    placeholder="Enter current password"
                                    required
                                >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">
                                    New Password
                                </label>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Enter new password"
                                    required
                                >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">
                                    Confirm New Password
                                </label>

                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    class="form-control"
                                    placeholder="Confirm new password"
                                    required
                                >
                            </div>

                            <div class="col-12">
                                <button
                                    type="submit"
                                    class="btn btn-outline-aroma"
                                >
                                    <i class="bi bi-key me-2"></i>
                                    Update Password
                                </button>
                            </div>

                        </div>
                    </form>

                </div>

            </div>

            {{-- Account Sidebar --}}
            <div class="col-lg-4">

                <div class="profile-sidebar">

                    <div class="profile-avatar">
                        <i class="bi bi-person"></i>
                    </div>

                    <h2>{{ $user->name }}</h2>

                    <p>{{ $user->email }}</p>

                    <span class="account-badge">
                        {{ ucfirst($user->role ?? 'user') }} Account
                    </span>

                    <hr>

                    <div class="profile-links">

                        <a
                            href="{{ route('profile.index') }}"
                            class="active"
                        >
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                            <i class="bi bi-chevron-right"></i>
                        </a>

                        <a href="{{ route('orders.index') }}">
                            <i class="bi bi-box-seam"></i>
                            <span>My Orders</span>
                            <i class="bi bi-chevron-right"></i>
                        </a>

                        <a href="{{ route('cart.index') }}">
                            <i class="bi bi-bag"></i>
                            <span>Shopping Cart</span>
                            <i class="bi bi-chevron-right"></i>
                        </a>

                        <form
                            action="{{ route('logout') }}"
                            method="POST"
                        >
                            @csrf

                            <button type="submit" class="profile-logout">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </form>

                    </div>

                </div>

                <div class="profile-help mt-4">

                    <i class="bi bi-headset"></i>

                    <h3>Need Help?</h3>

                    <p>
                        Our Aroma support team is here to help you
                        with your orders and account.
                    </p>

                    <a href="{{ route('contact.index') }}">
                        Contact Us
                        <i class="bi bi-arrow-right ms-1"></i>
                    </a>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection