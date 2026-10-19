@extends('layouts.app')

@section('title', 'Message Details - Aroma Admin')

@section('content')

<section class="admin-page-section py-5">
    <div class="container-fluid px-lg-5">

        {{-- Header --}}
        <div class="admin-header mb-4">

            <div>
                <span class="admin-label">AROMA ADMINISTRATION</span>

                <h1>Message Details</h1>

                <p class="text-muted mb-0">
                    Customer contact message
                </p>
            </div>

            <div>

                <a
                    href="{{ route('admin.messages.index') }}"
                    class="btn btn-outline-aroma"
                >
                    <i class="bi bi-arrow-left me-2"></i>
                    Back to Messages
                </a>

            </div>

        </div>

        {{-- Success --}}

        {{-- Error --}}

        <div class="row g-4">

            {{-- Message --}}
            <div class="col-lg-8">

                <div class="admin-section-card">

                    <div class="admin-section-header">

                        <div>

                            <span class="admin-label">
                                CUSTOMER MESSAGE
                            </span>

                            <h2>
                                {{ $message->subject }}
                            </h2>

                        </div>

                        @if($message->status === 'unread')

                            <span class="badge bg-warning text-dark">
                                Unread
                            </span>

                        @else

                            <span class="badge bg-success">
                                Read
                            </span>

                        @endif

                    </div>

                    <div class="message-content">

                        <p>
                            {{ $message->message }}
                        </p>

                    </div>

                </div>

            </div>

            {{-- Customer Information --}}
            <div class="col-lg-4">

                <div class="admin-section-card">

                    <div class="admin-section-header">

                        <div>

                            <span class="admin-label">
                                CUSTOMER
                            </span>

                            <h2>
                                Contact Information
                            </h2>

                        </div>

                        <span class="profile-icon">
                            <i class="bi bi-person"></i>
                        </span>

                    </div>

                    <div class="admin-info-box mb-3">

                        <span>Name</span>

                        <strong>
                            {{ $message->name }}
                        </strong>

                    </div>

                    <div class="admin-info-box mb-3">

                        <span>Email</span>

                        <strong>
                            {{ $message->email }}
                        </strong>

                    </div>

                    <div class="admin-info-box mb-3">

                        <span>Phone</span>

                        <strong>
                            {{ $message->phone ?: 'Not provided' }}
                        </strong>

                    </div>

                    <div class="admin-info-box">

                        <span>Received</span>

                        <strong>
                            {{ $message->created_at->format('d M Y') }}
                        </strong>

                        <small>
                            {{ $message->created_at->format('h:i A') }}
                        </small>

                    </div>

                </div>

            </div>

        </div>

        {{-- Message Actions --}}
        <div class="admin-section-card mt-4">

            <div class="admin-section-header">

                <div>

                    <span class="admin-label">
                        MESSAGE MANAGEMENT
                    </span>

                    <h2>
                        Actions
                    </h2>

                </div>

            </div>

            <div class="d-flex flex-wrap gap-2">

                @if($message->status === 'unread')

                    <form
                        action="{{ route('admin.messages.read', $message) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="btn btn-aroma"
                        >
                            <i class="bi bi-envelope-open me-2"></i>
                            Mark as Read
                        </button>

                    </form>

                @else

                    <form
                        action="{{ route('admin.messages.unread', $message) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="btn btn-outline-aroma"
                        >
                            <i class="bi bi-envelope me-2"></i>
                            Mark as Unread
                        </button>

                    </form>

                @endif

                <form
                    action="{{ route('admin.messages.destroy', $message) }}"
                    method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this message?');"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-outline-danger"
                    >
                        <i class="bi bi-trash me-2"></i>
                        Delete Message
                    </button>

                </form>

            </div>

        </div>

    </div>
</section>

@endsection