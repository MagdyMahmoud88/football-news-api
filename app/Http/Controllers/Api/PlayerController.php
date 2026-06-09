<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Player;

class PlayerController extends Controller
{
    public function index()
    {
        return response()->json(Player::with('team')->get());
    }

    public function show($slug)
    {
        $player = Player::with(['team', 'news'])->where('slug', $slug)->firstOrFail();
        return response()->json($player);
    }
}
