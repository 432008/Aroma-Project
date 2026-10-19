<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Floral',
            'slug' => 'floral',
            'description' => 'Elegant floral fragrances with beautiful and romantic notes.',
            'image' => 'collections/floral.jpg',
            'status' => 'active',
        ]);

        Category::create([
            'name' => 'Woody',
            'slug' => 'woody',
            'description' => 'Rich woody fragrances with warm and sophisticated aromas.',
            'image' => 'collections/woody.jpg',
            'status' => 'active',
        ]);

        Category::create([
            'name' => 'Fresh',
            'slug' => 'fresh',
            'description' => 'Fresh and refreshing fragrances perfect for everyday wear.',
            'image' => 'collections/fresh.jpg',
            'status' => 'active',
        ]);

        Category::create([
            'name' => 'Oriental',
            'slug' => 'oriental',
            'description' => 'Luxurious oriental fragrances with warm and mysterious notes.',
            'image' => 'collections/oriental.jpg',
            'status' => 'active',
        ]);

        Category::create([
            'name' => 'Luxury',
            'slug' => 'luxury',
            'description' => 'Premium fragrances created for unforgettable occasions.',
            'image' => 'collections/luxury.jpg',
            'status' => 'active',
        ]);

        Category::create([
            'name' => 'Everyday',
            'slug' => 'everyday',
            'description' => 'Comfortable and versatile fragrances for everyday moments.',
            'image' => 'collections/everyday.jpg',
            'status' => 'active',
        ]);
    }
}