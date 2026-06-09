<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::all());
    }

    public function news($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $news = $category->news()
            ->with(['team', 'player'])
            ->where('is_published', true)
            ->latest()
            ->paginate(10);

        return response()->json($news);
    }
}
