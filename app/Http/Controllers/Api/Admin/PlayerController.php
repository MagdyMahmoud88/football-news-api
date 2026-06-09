<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlayerController extends Controller
{
    public function index()
    {
        return response()->json(Player::with('team')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string',
            'team_id'     => 'required|exists:teams,id',
            'position'    => 'nullable|string',
            'nationality' => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('players', 'public');
        }

        $data['slug'] = Str::slug($data['name']) . '-' . uniqid();
        return response()->json(Player::create($data), 201);
    }

    public function update(Request $request, Player $player)
    {
        $data = $request->validate([
            'name'        => 'sometimes|string',
            'team_id'     => 'sometimes|exists:teams,id',
            'position'    => 'nullable|string',
            'nationality' => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('players', 'public');
        }

        $player->update($data);
        return response()->json($player);
    }

    public function destroy(Player $player)
    {
        $player->delete();
        return response()->json(['message' => 'تم حذف اللاعب']);
    }
}
