<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminReviewController extends Controller
{
    public function index(): View
    {
        $reviews = Review::with(['user', 'product'])
            ->latest()
            ->paginate(15);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function approve(Review $review): RedirectResponse
    {
        $review->update([
            'status' => 'approved',
        ]);

        return back()->with(
            'success',
            'Review approved successfully.'
        );
    }

    public function reject(Review $review): RedirectResponse
    {
        $review->update([
            'status' => 'rejected',
        ]);

        return back()->with(
            'success',
            'Review rejected successfully.'
        );
    }

    public function destroy(Review $review): RedirectResponse
    {
        $review->delete();

        return back()->with(
            'success',
            'Review deleted successfully.'
        );
    }
}