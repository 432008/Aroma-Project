<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('products')
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('collections.index', compact('categories'));
    }

    public function show(string $slug): View
    {
        $category = Category::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        $products = Product::with('category')
            ->withRating()
            ->where('category_id', $category->id)
            ->where('status', 'active')
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = Category::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('perfumes.index', compact(
            'products',
            'category',
            'categories'
        ));
    }
}