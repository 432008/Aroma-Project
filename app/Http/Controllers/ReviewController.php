<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['required', 'string', 'max:1000'],
        ]);

        $existingReview = Review::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->exists();

        if ($existingReview) {
            return back()->with(
                'error',
                'You have already reviewed this perfume.'
            );
        }

        Review::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'status' => 'pending',
        ]);

        return back()->with(
            'success',
            'Thank you! Your review has been submitted for approval.'
        );
    }
}