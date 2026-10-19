@extends('layouts.app')

@section('title', 'Login - Aroma')

@section('content')

<section class="page-header">
    <div class="container text-center">
        <p class="text-uppercase small mb-2">Welcome Back</p>
        <h1>Login to Aroma</h1>
        <p>Continue your journey into the world of luxury fragrances.</p>
    </div>
</section>

<section class="auth-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">

                <div class="auth-card">

                    <div class="text-center mb-4">
                        <span class="auth-icon">
                            <i class="bi bi-person"></i>
                        </span>

                        <h2 class="mt-3">Welcome Back</h2>
                        <p class="text-muted">
                            Login to access your Aroma account.
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

                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="mb-3">
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

                        <div class="mb-3">
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
                                    placeholder="Enter your password"
                                    required
                                >
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="remember"
                                    id="remember"
                                >

                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>

                            <a href="{{ route('password.request') }}" class="auth-link">
                                Forgot Password?
                            </a>
                        </div>

                        <button type="submit" class="btn btn-aroma w-100">
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            Login
                        </button>
                    </form>

                    <div class="auth-divider">
                        <span>OR</span>
                    </div>

                    <p class="text-center mb-0">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="auth-link">
                            Create Account
                        </a>
                    </p>

                </div>

            </div>
        </div>
    </div>
</section>

@endsection