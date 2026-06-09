<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $news = News::with(['category', 'team', 'player'])
            ->where('is_published', true)
            ->when($request->category, fn($q) =>
                $q->whereHas('category', fn($q) => $q->where('slug', $request->category))
            )
            ->when($request->team, fn($q) =>
                $q->whereHas('team', fn($q) => $q->where('slug', $request->team))
            )
            ->when($request->search, fn($q) =>
                $q->where('title', 'like', "%{$request->search}%")
            )
            ->latest()
            ->paginate(10);

        return response()->json($news);
    }

    public function show($slug)
    {
        $news = News::with(['category', 'team', 'player', 'comments.user'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return response()->json($news);
    }

    public function breaking()
    {
        $news = News::with(['category', 'team'])
            ->where('is_published', true)
            ->where('is_breaking', true)
            ->latest()
            ->take(5)
            ->get();

        return response()->json($news);
    }
}
