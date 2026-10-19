@extends('layouts.app')

@section('title', 'Reset Password - Aroma')

@section('content')

<section class="page-header">
    <div class="container text-center">
        <p class="text-uppercase small mb-2">Account Recovery</p>
        <h1>Reset Password</h1>
        <p>Choose a new password for your Aroma account.</p>
    </div>
</section>

<section class="auth-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">

                <div class="auth-card">

                    <div class="text-center mb-4">
                        <span class="auth-icon">
                            <i class="bi bi-shield-lock"></i>
                        </span>

                        <h2 class="mt-3">Set A New Password</h2>
                        <p class="text-muted">
                            Your new password must be at least 8 characters.
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

                    <form action="{{ route('password.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

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
                                    value="{{ old('email', $email) }}"
                                    placeholder="Enter your email"
                                    required
                                >
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                New Password
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
                                    placeholder="Enter a new password"
                                    required
                                >
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">
                                Confirm New Password
                            </label>

                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock-fill"></i>
                                </span>

                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    class="form-control"
                                    placeholder="Re-enter your new password"
                                    required
                                >
                            </div>
                        </div>

                        <button type="submit" class="btn btn-aroma w-100">
                            <i class="bi bi-check2-circle me-2"></i>
                            Reset Password
                        </button>
                    </form>

                    <div class="auth-divider">
                        <span>OR</span>
                    </div>

                    <p class="text-center mb-0">
                        <a href="{{ route('login') }}" class="auth-link">
                            Back to Login
                        </a>
                    </p>

                </div>

            </div>
        </div>
    </div>
</section>

@endsection
