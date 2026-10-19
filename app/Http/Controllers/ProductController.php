<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::with('category')
            ->withRating()
            ->where('status', 'active');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Category Filter
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Gender Filter
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // Price Filter
        if ($request->filled('min_price')) {
            $query->whereRaw(
                'COALESCE(discount_price, price) >= ?',
                [$request->min_price]
            );
        }

        if ($request->filled('max_price')) {
            $query->whereRaw(
                'COALESCE(discount_price, price) <= ?',
                [$request->max_price]
            );
        }

        // Sorting
        switch ($request->get('sort')) {

            case 'price_low':
                $query->orderByRaw(
                    'COALESCE(discount_price, price) ASC'
                );
                break;

            case 'price_high':
                $query->orderByRaw(
                    'COALESCE(discount_price, price) DESC'
                );
                break;

            case 'newest':
                $query->latest();
                break;

            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(12)->withQueryString();

        $categories = Category::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('perfumes.index', compact(
            'products',
            'categories'
        ));
    }

    public function show(string $slug): View
    {
        $product = Product::with([
            'category',
            'reviews' => function ($query) {
                $query->where('status', 'approved')
                     ->with('user')
                     ->latest();
            }
        ])
        ->where('slug', $slug)
        ->where('status', 'active')
        ->firstOrFail();

        $relatedProducts = Product::with('category')
            ->withRating()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->latest()
            ->take(4)
            ->get();

        return view('perfumes.show', compact(
            'product',
            'relatedProducts'
        ));
    }
}