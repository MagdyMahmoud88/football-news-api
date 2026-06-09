<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;

class TeamController extends Controller
{
    public function index()
    {
        return response()->json(Team::all());
    }

    public function show($slug)
    {
        $team = Team::with('players')->where('slug', $slug)->firstOrFail();
        return response()->json($team);
    }

    public function news($slug)
    {
        $team = Team::where('slug', $slug)->firstOrFail();
        $news = $team->news()
            ->with(['category'])
            ->where('is_published', true)
            ->latest()
            ->paginate(10);

        return response()->json($news);
    }
}
