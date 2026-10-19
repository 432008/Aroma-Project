@extends('layouts.app')

@section('title', 'Manage Users - Aroma Admin')

@section('content')

<section class="admin-page-section py-5">
    <div class="container-fluid px-lg-5">

        {{-- Header --}}
        <div class="admin-header mb-4">

            <div>
                <span class="admin-label">AROMA ADMINISTRATION</span>
                <h1>Users</h1>
                <p class="text-muted mb-0">
                    Manage registered Aroma customers and administrators.
                </p>
            </div>

        </div>

        {{-- Messages --}}


        {{-- Filters --}}
        <div class="admin-section-card mb-4">

            <div class="admin-section-header">

                <div>
                    <span class="admin-label">USER MANAGEMENT</span>
                    <h2>Search &amp; Filter</h2>
                </div>

                <span class="profile-icon">
                    <i class="bi bi-funnel"></i>
                </span>

            </div>

            <form
                action="{{ route('admin.users.index') }}"
                method="GET"
            >

                <div class="row g-3 align-items-end">

                    <div class="col-md-6">

                        <label
                            for="search"
                            class="form-label"
                        >
                            Search User
                        </label>

                        <input
                            type="text"
                            id="search"
                            name="search"
                            class="form-control"
                            value="{{ request('search') }}"
                            placeholder="Search by name, email or phone"
                        >

                    </div>

                    <div class="col-md-3">

                        <label
                            for="role"
                            class="form-label"
                        >
                            Role
                        </label>

                        <select
                            id="role"
                            name="role"
                            class="form-select"
                        >

                            <option value="">
                                All Roles
                            </option>

                            <option
                                value="user"
                                {{ request('role') === 'user' ? 'selected' : '' }}
                            >
                                User
                            </option>

                            <option
                                value="admin"
                                {{ request('role') === 'admin' ? 'selected' : '' }}
                            >
                                Admin
                            </option>

                        </select>

                    </div>

                    <div class="col-md-3 d-flex gap-2">

                        <button
                            type="submit"
                            class="btn btn-aroma flex-grow-1"
                        >
                            <i class="bi bi-search me-2"></i>
                            Search
                        </button>

                        <a
                            href="{{ route('admin.users.index') }}"
                            class="btn btn-outline-aroma"
                            title="Clear Filters"
                        >
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>

                    </div>

                </div>

            </form>

        </div>

        {{-- Users Table --}}
        <div class="admin-section-card">

            <div class="admin-section-header">

                <div>
                    <span class="admin-label">REGISTERED USERS</span>
                    <h2>All Users</h2>
                </div>

                <span class="profile-icon">
                    <i class="bi bi-people"></i>
                </span>

            </div>

            @if($users->count())

                <div class="table-responsive">

                    <table class="table admin-table align-middle">

                        <thead>

                            <tr>

                                <th>#</th>
                                <th>User</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Orders</th>
                                <th>Joined</th>
                                <th class="text-end">Actions</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($users as $user)

                                <tr>

                                    {{-- Number --}}
                                    <td>
                                        {{ $users->firstItem() + $loop->index }}
                                    </td>

                                    {{-- User --}}
                                    <td>

                                        <div class="d-flex align-items-center gap-3">

                                            <div class="admin-user-avatar">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>

                                            <div>

                                                <strong>
                                                    {{ $user->name }}
                                                </strong>

                                                <small class="text-muted d-block">
                                                    {{ $user->email }}
                                                </small>

                                            </div>

                                        </div>

                                    </td>

                                    {{-- Phone --}}
                                    <td>

                                        {{ $user->phone ?: 'N/A' }}

                                    </td>

                                    {{-- Role --}}
                                    <td>

                                        @if($user->role === 'admin')

                                            <span class="badge bg-dark">
                                                <i class="bi bi-shield-check me-1"></i>
                                                Admin
                                            </span>

                                        @else

                                            <span class="badge bg-light text-dark border">
                                                User
                                            </span>

                                        @endif

                                    </td>

                                    {{-- Orders --}}
                                    <td>

                                        <span class="badge bg-light text-dark border">

                                            {{ $user->orders_count }}

                                            {{ $user->orders_count == 1 ? 'Order' : 'Orders' }}

                                        </span>

                                    </td>

                                    {{-- Joined --}}
                                    <td>

                                        {{ $user->created_at->format('d M Y') }}

                                    </td>

                                    {{-- Actions --}}
                                    <td>

                                        <div class="d-flex justify-content-end gap-2">

                                            <a
                                                href="{{ route('admin.users.show', $user) }}"
                                                class="btn btn-sm btn-outline-aroma"
                                                title="View User"
                                            >
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            {{-- Role Update --}}
                                            @if($user->id !== auth()->id())

                                                <form
                                                    action="{{ route('admin.users.role', $user) }}"
                                                    method="POST"
                                                >

                                                    @csrf
                                                    @method('PATCH')

                                                    <select
                                                        name="role"
                                                        class="form-select form-select-sm"
                                                        onchange="this.form.submit()"
                                                        title="Change Role"
                                                    >

                                                        <option
                                                            value="user"
                                                            {{ $user->role === 'user' ? 'selected' : '' }}
                                                        >
                                                            User
                                                        </option>

                                                        <option
                                                            value="admin"
                                                            {{ $user->role === 'admin' ? 'selected' : '' }}
                                                        >
                                                            Admin
                                                        </option>

                                                    </select>

                                                </form>

                                                {{-- Delete --}}
                                                @if($user->orders_count == 0)

                                                    <form
                                                        action="{{ route('admin.users.destroy', $user) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this user?');"
                                                    >

                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            class="btn btn-sm btn-outline-danger"
                                                            title="Delete User"
                                                        >
                                                            <i class="bi bi-trash"></i>
                                                        </button>

                                                    </form>

                                                @endif

                                            @else

                                                <span class="badge bg-light text-dark border">
                                                    You
                                                </span>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                {{-- Pagination --}}
                @if($users->hasPages())

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>

                @endif

            @else

                <div class="text-center py-5">

                    <div class="empty-state-icon mb-3">
                        <i class="bi bi-people"></i>
                    </div>

                    <h3>
                        No Users Found
                    </h3>

                    <p class="text-muted mb-0">
                        No users match your current search or filter.
                    </p>

                </div>

            @endif

        </div>

    </div>
</section>

@endsection