<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    public function index()
    {
        return response()->json(Team::withCount(['news', 'players'])->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|unique:teams',
            'league'  => 'nullable|string',
            'country' => 'nullable|string',
            'logo'    => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('teams', 'public');
        }

        $data['slug'] = Str::slug($data['name']);
        return response()->json(Team::create($data), 201);
    }

    public function update(Request $request, Team $team)
    {
        $data = $request->validate([
            'name'    => 'sometimes|string|unique:teams,name,' . $team->id,
            'league'  => 'nullable|string',
            'country' => 'nullable|string',
            'logo'    => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('teams', 'public');
        }

        if (isset($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $team->update($data);
        return response()->json($team);
    }

    public function destroy(Team $team)
    {
        $team->delete();
        return response()->json(['message' => 'تم حذف الفريق']);
    }
}
