<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
protected $fillable = ['team_id', 'name', 'slug', 'position', 'nationality', 'image'];

public function team() {
    return $this->belongsTo(Team::class);
}
public function news() {
    return $this->hasMany(News::class);
}}
