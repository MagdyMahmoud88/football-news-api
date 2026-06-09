<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with(['category', 'team', 'player', 'user'])
            ->latest()
            ->paginate(10);

        return response()->json($news);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'body'        => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'team_id'     => 'nullable|exists:teams,id',
            'player_id'   => 'nullable|exists:players,id',
            'image'       => 'nullable|image|max:2048',
            'is_breaking' => 'boolean',
            'is_published'=> 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        $data['slug']    = Str::slug($data['title']) . '-' . uniqid();
        $data['user_id'] = $request->user()->id;

        $news = News::create($data);

        return response()->json($news->load(['category', 'team', 'player']), 201);
    }

    public function show(News $news)
    {
        return response()->json($news->load(['category', 'team', 'player', 'comments.user']));
    }

    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'title'        => 'sometimes|string|max:255',
            'body'         => 'sometimes|string',
            'category_id'  => 'sometimes|exists:categories,id',
            'team_id'      => 'nullable|exists:teams,id',
            'player_id'    => 'nullable|exists:players,id',
            'image'        => 'nullable|image|max:2048',
            'is_breaking'  => 'boolean',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        if (isset($data['title'])) {
            $data['slug'] = Str::slug($data['title']) . '-' . uniqid();
        }

        $news->update($data);

        return response()->json($news->load(['category', 'team', 'player']));
    }

    public function destroy(News $news)
    {
        $news->delete();
        return response()->json(['message' => 'تم حذف الخبر']);
    }

    public function toggleBreaking(News $news)
    {
        $news->update(['is_breaking' => !$news->is_breaking]);
        return response()->json(['is_breaking' => $news->is_breaking]);
    }

    public function togglePublished(News $news)
    {
        $news->update(['is_published' => !$news->is_published]);
        return response()->json(['is_published' => $news->is_published]);
    }
}
