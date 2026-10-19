@extends('layouts.app')

@section('title', 'Contact Messages - Aroma Admin')

@section('content')

<section class="admin-page-section py-5">
    <div class="container-fluid px-lg-5">

        {{-- Header --}}
        <div class="admin-header mb-4">

            <div>
                <span class="admin-label">AROMA ADMINISTRATION</span>
                <h1>Contact Messages</h1>
                <p class="text-muted mb-0">
                    View and manage messages received from customers.
                </p>
            </div>

        </div>

        {{-- Messages --}}


        {{-- Filter --}}
        <div class="admin-section-card mb-4">

            <div class="admin-section-header">

                <div>

                    <span class="admin-label">
                        MESSAGE MANAGEMENT
                    </span>

                    <h2>
                        Filter Messages
                    </h2>

                </div>

                <span class="profile-icon">
                    <i class="bi bi-funnel"></i>
                </span>

            </div>

            <form
                action="{{ route('admin.messages.index') }}"
                method="GET"
            >

                <div class="row g-3 align-items-end">

                    <div class="col-md-9">

                        <label
                            for="status"
                            class="form-label"
                        >
                            Message Status
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="form-select"
                        >

                            <option value="">
                                All Messages
                            </option>

                            <option
                                value="unread"
                                {{ request('status') === 'unread' ? 'selected' : '' }}
                            >
                                Unread
                            </option>

                            <option
                                value="read"
                                {{ request('status') === 'read' ? 'selected' : '' }}
                            >
                                Read
                            </option>

                        </select>

                    </div>

                    <div class="col-md-3 d-flex gap-2">

                        <button
                            type="submit"
                            class="btn btn-aroma flex-grow-1"
                        >

                            <i class="bi bi-funnel me-2"></i>

                            Filter

                        </button>

                        <a
                            href="{{ route('admin.messages.index') }}"
                            class="btn btn-outline-aroma"
                            title="Clear Filter"
                        >

                            <i class="bi bi-arrow-counterclockwise"></i>

                        </a>

                    </div>

                </div>

            </form>

        </div>

        {{-- Messages Table --}}
        <div class="admin-section-card">

            <div class="admin-section-header">

                <div>

                    <span class="admin-label">
                        CUSTOMER COMMUNICATION
                    </span>

                    <h2>
                        All Messages
                    </h2>

                </div>

                <span class="profile-icon">
                    <i class="bi bi-envelope"></i>
                </span>

            </div>

            @if($messages->count())

                <div class="table-responsive">

                    <table class="table admin-table align-middle">

                        <thead>

                            <tr>

                                <th>#</th>
                                <th>Customer</th>
                                <th>Subject</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Received</th>
                                <th class="text-end">Actions</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($messages as $message)

                                <tr
                                    class="{{ $message->status === 'unread' ? 'table-warning' : '' }}"
                                >

                                    {{-- Number --}}
                                    <td>
                                        {{ $messages->firstItem() + $loop->index }}
                                    </td>

                                    {{-- Customer --}}
                                    <td>

                                        <strong>
                                            {{ $message->name }}
                                        </strong>

                                        <small class="text-muted d-block">
                                            {{ $message->email }}
                                        </small>

                                    </td>

                                    {{-- Subject --}}
                                    <td>

                                        <strong>
                                            {{ Str::limit($message->subject, 45) }}
                                        </strong>

                                        <small class="text-muted d-block">
                                            {{ Str::limit($message->message, 60) }}
                                        </small>

                                    </td>

                                    {{-- Phone --}}
                                    <td>

                                        {{ $message->phone ?: 'N/A' }}

                                    </td>

                                    {{-- Status --}}
                                    <td>

                                        @if($message->status === 'unread')

                                            <span class="badge bg-warning text-dark">

                                                <i class="bi bi-envelope me-1"></i>

                                                Unread

                                            </span>

                                        @else

                                            <span class="badge bg-success">

                                                <i class="bi bi-envelope-open me-1"></i>

                                                Read

                                            </span>

                                        @endif

                                    </td>

                                    {{-- Date --}}
                                    <td>

                                        {{ $message->created_at->format('d M Y') }}

                                        <small class="text-muted d-block">
                                            {{ $message->created_at->format('h:i A') }}
                                        </small>

                                    </td>

                                    {{-- Actions --}}
                                    <td>

                                        <div class="d-flex justify-content-end gap-2">

                                            {{-- View --}}
                                            <a
                                                href="{{ route('admin.messages.show', $message) }}"
                                                class="btn btn-sm btn-outline-aroma"
                                                title="View Message"
                                            >

                                                <i class="bi bi-eye"></i>

                                            </a>

                                            {{-- Delete --}}
                                            <form
                                                action="{{ route('admin.messages.destroy', $message) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this message?');"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Delete Message"
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
                @if($messages->hasPages())

                    <div class="mt-4">

                        {{ $messages->links() }}

                    </div>

                @endif

            @else

                <div class="text-center py-5">

                    <div class="empty-state-icon mb-3">

                        <i class="bi bi-envelope-open"></i>

                    </div>

                    <h3>
                        No Messages Found
                    </h3>

                    <p class="text-muted mb-0">
                        There are no contact messages matching your filter.
                    </p>

                </div>

            @endif

        </div>

    </div>
</section>

@endsection