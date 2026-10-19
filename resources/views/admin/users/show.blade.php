@extends('layouts.app')

@section('title', 'User Details - Aroma Admin')

@section('content')

<section class="admin-page-section py-5">
    <div class="container-fluid px-lg-5">

        {{-- Header --}}
        <div class="admin-header mb-4">

            <div>
                <span class="admin-label">AROMA ADMINISTRATION</span>
                <h1>User Details</h1>
                <p class="text-muted mb-0">
                    View this customer's profile and order history.
                </p>
            </div>

            <div>
                <a
                    href="{{ route('admin.users.index') }}"
                    class="btn btn-outline-aroma"
                >
                    <i class="bi bi-arrow-left me-2"></i>
                    Back to Users
                </a>
            </div>

        </div>

        <div class="row g-4">

            {{-- Profile --}}
            <div class="col-lg-4">

                <div class="admin-section-card h-100 text-center">

                    <div class="admin-user-avatar mx-auto mb-3">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    <h2 class="mb-1">{{ $user->name }}</h2>

                    <p class="text-muted mb-3">{{ $user->email }}</p>

                    @if($user->role === 'admin')
                        <span class="badge bg-dark">
                            <i class="bi bi-shield-check me-1"></i>
                            Admin
                        </span>
                    @else
                        <span class="badge bg-light text-dark border">User</span>
                    @endif

                </div>

            </div>

            {{-- Details --}}
            <div class="col-lg-8">

                <div class="admin-section-card h-100">

                    <div class="admin-section-header">

                        <div>
                            <span class="admin-label">ACCOUNT</span>
                            <h2>Account Information</h2>
                        </div>

                        <span class="profile-icon">
                            <i class="bi bi-person"></i>
                        </span>

                    </div>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <div class="admin-info-box">
                                <span>Phone</span>
                                <strong>{{ $user->phone ?: 'N/A' }}</strong>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-info-box">
                                <span>Joined</span>
                                <strong>{{ $user->created_at->format('d M Y, h:i A') }}</strong>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-info-box">
                                <span>Total Orders</span>
                                <strong>
                                    {{ $user->orders_count }}
                                    {{ $user->orders_count == 1 ? 'Order' : 'Orders' }}
                                </strong>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="admin-info-box">
                                <span>Role</span>
                                <strong>{{ ucfirst($user->role) }}</strong>
                            </div>
                        </div>

                        @if($user->address)
                            <div class="col-12">
                                <div class="admin-info-box">
                                    <span>Address</span>
                                    <strong>{{ $user->address }}</strong>
                                </div>
                            </div>
                        @endif

                    </div>

                    @if($user->id !== auth()->id())

                        <hr class="my-4">

                        <div class="d-flex flex-wrap gap-2 align-items-center">

                            <form
                                action="{{ route('admin.users.role', $user) }}"
                                method="POST"
                                class="d-flex gap-2 align-items-center"
                            >

                                @csrf
                                @method('PATCH')

                                <label for="role" class="form-label mb-0 me-1">
                                    Change Role
                                </label>

                                <select
                                    id="role"
                                    name="role"
                                    class="form-select form-select-sm"
                                    style="width: auto;"
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

                                <button type="submit" class="btn btn-sm btn-aroma">
                                    Update
                                </button>

                            </form>

                            @if($user->orders_count == 0)

                                <form
                                    action="{{ route('admin.users.destroy', $user) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this user?');"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash me-1"></i>
                                        Delete User
                                    </button>

                                </form>

                            @endif

                        </div>

                    @else

                        <hr class="my-4">

                        <span class="badge bg-light text-dark border">This is your account</span>

                    @endif

                </div>

            </div>

        </div>

        {{-- Orders --}}
        <div class="admin-section-card mt-4">

            <div class="admin-section-header">

                <div>
                    <span class="admin-label">HISTORY</span>
                    <h2>Recent Orders</h2>
                </div>

                <span class="profile-icon">
                    <i class="bi bi-bag-check"></i>
                </span>

            </div>

            @if($orders->count())

                <div class="table-responsive">

                    <table class="table admin-table align-middle">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order</th>
                                <th>Date</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($orders as $order)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        <strong>{{ $order->order_number }}</strong>
                                        <small class="text-muted d-block">
                                            #{{ $order->id }}
                                        </small>
                                    </td>

                                    <td>
                                        {{ $order->created_at->format('d M Y') }}
                                        <small class="text-muted d-block">
                                            {{ $order->created_at->format('h:i A') }}
                                        </small>
                                    </td>

                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            {{ $order->order_items_count }}
                                            {{ $order->order_items_count == 1 ? 'Item' : 'Items' }}
                                        </span>
                                    </td>

                                    <td>
                                        <strong>₹{{ number_format($order->total, 2) }}</strong>
                                    </td>

                                    <td>

                                        @if($order->status === 'Pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($order->status === 'Confirmed')
                                            <span class="badge bg-info text-dark">Confirmed</span>
                                        @elseif($order->status === 'Shipped')
                                            <span class="badge bg-primary">Shipped</span>
                                        @elseif($order->status === 'Delivered')
                                            <span class="badge bg-success">Delivered</span>
                                        @elseif($order->status === 'Cancelled')
                                            <span class="badge bg-danger">Cancelled</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $order->status }}</span>
                                        @endif

                                    </td>

                                    <td>

                                        <div class="d-flex justify-content-end">
                                            <a
                                                href="{{ route('admin.orders.show', $order) }}"
                                                class="btn btn-sm btn-outline-aroma"
                                            >
                                                <i class="bi bi-eye me-1"></i>
                                                View
                                            </a>
                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center py-5">

                    <div class="empty-state-icon mb-3">
                        <i class="bi bi-bag"></i>
                    </div>

                    <h3>No Orders Yet</h3>

                    <p class="text-muted mb-0">
                        This customer hasn't placed any orders.
                    </p>

                </div>

            @endif

        </div>

    </div>
</section>

@endsection
