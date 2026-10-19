<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfumeController extends Controller
{
    private $perfumes = [
        1 => [
            'name' => 'AROMA Noir',
            'category' => 'Men',
            'price' => '₹2,499',
            'image' => 'noir.png',
            'description' => 'A deep and mysterious woody fragrance created for confident personalities. A sophisticated scent that leaves a memorable impression.',
            'notes' => [
                'Top Notes: Bergamot, Black Pepper',
                'Heart Notes: Cedarwood, Lavender',
                'Base Notes: Amber, Musk, Sandalwood'
            ]
        ],

        2 => [
            'name' => 'AROMA Bloom',
            'category' => 'Women',
            'price' => '₹2,299',
            'image' => 'bloom.png',
            'description' => 'A soft floral fragrance with fresh and romantic character. Perfect for adding elegance and freshness to your everyday moments.',
            'notes' => [
                'Top Notes: Citrus, Pear',
                'Heart Notes: Rose, Jasmine',
                'Base Notes: Vanilla, Musk, Amber'
            ]
        ],

        3 => [
            'name' => 'AROMA Oud',
            'category' => 'Unisex',
            'price' => '₹2,999',
            'image' => 'oud.png',
            'description' => 'A rich oud fragrance with warm oriental character. A bold and luxurious composition designed for unforgettable evenings.',
            'notes' => [
                'Top Notes: Saffron, Cardamom',
                'Heart Notes: Oud, Rose',
                'Base Notes: Amber, Leather, Musk'
            ]
        ],

        4 => [
            'name' => 'AROMA Velvet',
            'category' => 'Women',
            'price' => '₹2,699',
            'image' => 'velvet.png',
            'description' => 'A luxurious floral and vanilla fragrance with a soft, warm and elegant personality.',
            'notes' => [
                'Top Notes: Peach, Bergamot',
                'Heart Notes: Jasmine, Rose',
                'Base Notes: Vanilla, Sandalwood, Musk'
            ]
        ],

        5 => [
            'name' => 'AROMA Elite',
            'category' => 'Men',
            'price' => '₹3,199',
            'image' => 'elite.png',
            'description' => 'A sophisticated citrus and woody fragrance with a refined character. Designed for modern confidence.',
            'notes' => [
                'Top Notes: Lemon, Bergamot',
                'Heart Notes: Vetiver, Lavender',
                'Base Notes: Cedarwood, Amber, Musk'
            ]
        ],

        6 => [
            'name' => 'AROMA Essence',
            'category' => 'Unisex',
            'price' => '₹2,799',
            'image' => 'essence.png',
            'description' => 'A fresh, warm and elegant fragrance designed for every occasion. A balanced scent that works beautifully from day to night.',
            'notes' => [
                'Top Notes: Lemon, Green Apple',
                'Heart Notes: Jasmine, Rose',
                'Base Notes: Amber, Sandalwood, Musk'
            ]
        ]
    ];

    public function index()
    {
        $perfumes = $this->perfumes;

        return view('perfumes', compact('perfumes'));
    }

    public function show($id)
    {
        $perfume = $this->perfumes[$id] ?? null;

        if (!$perfume) {
            abort(404);
        }

        return view('perfume-details', compact('perfume'));
    }
}