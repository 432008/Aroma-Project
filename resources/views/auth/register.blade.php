@extends('layouts.app')

@section('title', 'Register - Aroma')

@section('content')

<section class="page-header">
    <div class="container text-center">
        <p class="text-uppercase small mb-2">Join Aroma</p>
        <h1>Create Your Account</h1>
        <p>Begin your journey into the world of luxury fragrances.</p>
    </div>
</section>

<section class="auth-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9">

                <div class="auth-card">

                    <div class="text-center mb-4">
                        <span class="auth-icon">
                            <i class="bi bi-person-plus"></i>
                        </span>

                        <h2 class="mt-3">Create Account</h2>

                        <p class="text-muted">
                            Register with Aroma and discover your signature scent.
                        </p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif



                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">
                                    Full Name
                                </label>

                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-person"></i>
                                    </span>

                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        class="form-control"
                                        value="{{ old('name') }}"
                                        placeholder="Enter your full name"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">
                                    Phone Number
                                </label>

                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-telephone"></i>
                                    </span>

                                    <input
                                        type="text"
                                        id="phone"
                                        name="phone"
                                        class="form-control"
                                        value="{{ old('phone') }}"
                                        placeholder="Enter your phone number"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="email" class="form-label">
                                    Email Address
                                </label>

                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </span>

                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        class="form-control"
                                        value="{{ old('email') }}"
                                        placeholder="Enter your email"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">
                                    Password
                                </label>

                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>

                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        class="form-control"
                                        placeholder="Create a password"
                                        required
                                    >
                                </div>

                                <small class="text-muted">
                                    Minimum 8 characters recommended.
                                </small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">
                                    Confirm Password
                                </label>

                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-shield-lock"></i>
                                    </span>

                                    <input
                                        type="password"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        class="form-control"
                                        placeholder="Confirm your password"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <label for="address" class="form-label">
                                    Address
                                </label>

                                <div class="input-group">
                                    <span class="input-group-text align-items-start pt-2">
                                        <i class="bi bi-geo-alt"></i>
                                    </span>

                                    <textarea
                                        id="address"
                                        name="address"
                                        class="form-control"
                                        rows="3"
                                        placeholder="Enter your address"
                                    >{{ old('address') }}</textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-aroma w-100">
                                    <i class="bi bi-person-plus me-2"></i>
                                    Create Account
                                </button>
                            </div>

                        </div>
                    </form>

                    <div class="auth-divider">
                        <span>OR</span>
                    </div>

                    <p class="text-center mb-0">
                        Already have an account?
                        <a href="{{ route('login') }}" class="auth-link">
                            Login Here
                        </a>
                    </p>

                </div>

            </div>
        </div>
    </div>
</section>

@endsection