@extends('layouts.app')

@section('title', 'Forgot Password - Aroma')

@section('content')

<section class="page-header">
    <div class="container text-center">
        <p class="text-uppercase small mb-2">Account Recovery</p>
        <h1>Forgot Password</h1>
        <p>Enter your email and we'll send you a secure reset link.</p>
    </div>
</section>

<section class="auth-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">

                <div class="auth-card">

                    <div class="text-center mb-4">
                        <span class="auth-icon">
                            <i class="bi bi-key"></i>
                        </span>

                        <h2 class="mt-3">Reset Your Password</h2>
                        <p class="text-muted">
                            We'll email you a link to choose a new password.
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

                    <form action="{{ route('password.email') }}" method="POST">
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

                        <button type="submit" class="btn btn-aroma w-100">
                            <i class="bi bi-send me-2"></i>
                            Send Reset Link
                        </button>
                    </form>

                    <div class="auth-divider">
                        <span>OR</span>
                    </div>

                    <p class="text-center mb-0">
                        Remembered your password?
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
