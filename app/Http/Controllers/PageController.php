<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    public function show(string $slug): View
    {
        $pages = config('pages', []);

        abort_unless(
            is_array($pages) && array_key_exists($slug, $pages),
            404
        );

        return view('pages.show', [
            'slug' => $slug,
            'page' => $pages[$slug],
        ]);
    }
}
