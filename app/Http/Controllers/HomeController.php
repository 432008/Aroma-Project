<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredProducts = Product::with('category')
            ->withRating()
            ->where('status', 'active')
            ->latest()
            ->take(4)
            ->get();

        $categories = Category::where('status', 'active')
            ->latest()
            ->take(6)
            ->get();

        $testimonials = Review::with(['user', 'product'])
            ->where('status', 'approved')
            ->whereNotNull('comment')
            ->latest()
            ->take(3)
            ->get();

        return view('home', compact(
            'featuredProducts',
            'categories',
            'testimonials'
        ));
    }

    public function subscribe(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        return back()->with(
            'success',
            'Thank you for subscribing to Aroma. Watch your inbox for new arrivals and offers.'
        );
    }

    public function about(): View
    {
        return view('about');
    }
}
