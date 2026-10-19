<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $floral = Category::where('slug', 'floral')->first();
        $woody = Category::where('slug', 'woody')->first();
        $fresh = Category::where('slug', 'fresh')->first();
        $oriental = Category::where('slug', 'oriental')->first();
        $luxury = Category::where('slug', 'luxury')->first();
        $everyday = Category::where('slug', 'everyday')->first();

        Product::create([
            'category_id' => $woody->id,
            'name' => 'Aroma Noir',
            'slug' => 'aroma-noir',
            'gender' => 'Men',
            'price' => 2999,
            'discount_price' => 2499,
            'description' => 'A deep and sophisticated fragrance designed for the modern gentleman.',
            'top_notes' => 'Bergamot, Black Pepper',
            'heart_notes' => 'Cedarwood, Lavender',
            'base_notes' => 'Sandalwood, Amber, Musk',
            'stock' => 50,
            'image' => 'perfumes/aroma-noir.jpg',
            'status' => 'active',
        ]);

        Product::create([
            'category_id' => $floral->id,
            'name' => 'Aroma Bloom',
            'slug' => 'aroma-bloom',
            'gender' => 'Women',
            'price' => 2599,
            'discount_price' => 2199,
            'description' => 'A graceful floral fragrance created for elegant and confident women.',
            'top_notes' => 'Pear, Bergamot',
            'heart_notes' => 'Rose, Jasmine, Peony',
            'base_notes' => 'Vanilla, Musk',
            'stock' => 45,
            'image' => 'perfumes/aroma-bloom.jpg',
            'status' => 'active',
        ]);

        Product::create([
            'category_id' => $oriental->id,
            'name' => 'Aroma Royale',
            'slug' => 'aroma-royale',
            'gender' => 'Unisex',
            'price' => 3999,
            'discount_price' => 3499,
            'description' => 'An opulent oriental fragrance with a warm and unforgettable character.',
            'top_notes' => 'Saffron, Bergamot',
            'heart_notes' => 'Rose, Amber',
            'base_notes' => 'Oud, Vanilla, Musk',
            'stock' => 30,
            'image' => 'perfumes/aroma-royale.jpg',
            'status' => 'active',
        ]);

        Product::create([
            'category_id' => $fresh->id,
            'name' => 'Aroma Fresh',
            'slug' => 'aroma-fresh',
            'gender' => 'Unisex',
            'price' => 2199,
            'discount_price' => 1899,
            'description' => 'A clean and refreshing fragrance perfect for everyday adventures.',
            'top_notes' => 'Lemon, Mint',
            'heart_notes' => 'Lavender, Green Tea',
            'base_notes' => 'Cedarwood, Musk',
            'stock' => 60,
            'image' => 'perfumes/aroma-fresh.jpg',
            'status' => 'active',
        ]);

        Product::create([
            'category_id' => $luxury->id,
            'name' => 'Aroma Gold',
            'slug' => 'aroma-gold',
            'gender' => 'Unisex',
            'price' => 4499,
            'discount_price' => 3999,
            'description' => 'A luxurious signature scent crafted for memorable occasions.',
            'top_notes' => 'Citrus, Saffron',
            'heart_notes' => 'Jasmine, Rose',
            'base_notes' => 'Oud, Amber, Vanilla',
            'stock' => 25,
            'image' => 'perfumes/aroma-gold.jpg',
            'status' => 'active',
        ]);

        Product::create([
            'category_id' => $woody->id,
            'name' => 'Aroma Elite',
            'slug' => 'aroma-elite',
            'gender' => 'Men',
            'price' => 3299,
            'discount_price' => 2899,
            'description' => 'A bold woody fragrance that expresses confidence and strength.',
            'top_notes' => 'Grapefruit, Pepper',
            'heart_notes' => 'Vetiver, Cedarwood',
            'base_notes' => 'Patchouli, Amber',
            'stock' => 40,
            'image' => 'perfumes/aroma-elite.jpg',
            'status' => 'active',
        ]);

        Product::create([
            'category_id' => $floral->id,
            'name' => 'Aroma Rose',
            'slug' => 'aroma-rose',
            'gender' => 'Women',
            'price' => 2399,
            'discount_price' => 1999,
            'description' => 'A delicate rose fragrance blended with soft and elegant floral notes.',
            'top_notes' => 'Raspberry, Bergamot',
            'heart_notes' => 'Rose, Jasmine',
            'base_notes' => 'Musk, Vanilla',
            'stock' => 55,
            'image' => 'perfumes/aroma-rose.jpg',
            'status' => 'active',
        ]);

        Product::create([
            'category_id' => $everyday->id,
            'name' => 'Aroma Essence',
            'slug' => 'aroma-essence',
            'gender' => 'Unisex',
            'price' => 1999,
            'discount_price' => 1699,
            'description' => 'A versatile fragrance made for simple, fresh and elegant everyday moments.',
            'top_notes' => 'Lemon, Apple',
            'heart_notes' => 'Jasmine, Lavender',
            'base_notes' => 'Musk, Cedarwood',
            'stock' => 70,
            'image' => 'perfumes/aroma-essence.jpg',
            'status' => 'active',
        ]);
    }
}