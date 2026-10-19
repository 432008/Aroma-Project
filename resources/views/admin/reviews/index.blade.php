@extends('layouts.app')

@section('title', 'Manage Reviews | Aroma Admin')

@section('content')
<section class="section-padding bg-cream">
    <div class="container">

        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
            <div>
                <span class="section-subtitle">AROMA ADMINISTRATION</span>
                <h1 class="mb-2">Manage Reviews</h1>
                <p class="text-muted mb-0">
                    Review customer feedback and approve reviews before publication.
                </p>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark">
                <i class="bi bi-arrow-left me-2"></i>Dashboard
            </a>
        </div>

        {{-- Success and error messages --}}


        @if($reviews->count())
            <div class="card border-0 shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Customer</th>
                                <th>Perfume</th>
                                <th>Rating</th>
                                <th>Comment</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th style="min-width: 230px;">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($reviews as $review)
                                <tr>
                                    <td>
                                        <strong>
                                            {{ $review->user->name ?? 'Deleted User' }}
                                        </strong>
                                        <br>
                                        <small class="text-muted">
                                            {{ $review->user->email ?? '—' }}
                                        </small>
                                    </td>

                                    <td>
                                        {{ $review->product->name ?? 'Deleted Product' }}
                                    </td>

                                    <td class="text-warning text-nowrap">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi {{ $i <= $review->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                        @endfor
                                        <br>
                                        <small class="text-dark">
                                            {{ $review->rating }}/5
                                        </small>
                                    </td>

                                    <td style="min-width: 200px; max-width: 320px;">
                                        {{ $review->comment }}
                                    </td>

                                    <td>
                                        @if($review->status === 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($review->status === 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>

                                    <td class="text-nowrap">
                                        {{ $review->created_at->format('d M Y') }}
                                    </td>

                                    <td>
                                        <div class="d-flex flex-wrap gap-2">

                                            @if($review->status !== 'approved')
                                                <form action="{{ route('admin.reviews.approve', $review) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="btn btn-sm btn-success">
                                                        <i class="bi bi-check-circle me-1"></i>
                                                        Approve
                                                    </button>
                                                </form>
                                            @endif

                                            @if($review->status !== 'rejected')
                                                <form action="{{ route('admin.reviews.reject', $review) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="btn btn-sm btn-outline-danger">
                                                        Reject
                                                    </button>
                                                </form>
                                            @endif

                                            <form action="{{ route('admin.reviews.destroy', $review) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this review?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-dark">
                                                    <i class="bi bi-trash me-1"></i>
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                {{ $reviews->links() }}
            </div>
        @else
            <div class="empty-state text-center py-5">
                <i class="bi bi-chat-heart display-4"></i>
                <h2 class="mt-3">No Reviews Yet</h2>
                <p class="text-muted">
                    Customer reviews will appear here when submitted.
                </p>
            </div>
        @endif

    </div>
</section>
@endsection