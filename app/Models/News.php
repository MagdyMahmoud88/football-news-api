<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
protected $fillable = [
    'user_id', 'category_id', 'team_id', 'player_id',
    'title', 'slug', 'body', 'image', 'is_breaking', 'is_published'
];

public function user() {
    return $this->belongsTo(User::class);
}
public function category() {
    return $this->belongsTo(Category::class);
}
public function team() {
    return $this->belongsTo(Team::class);
}
public function player() {
    return $this->belongsTo(Player::class);
}
public function comments() {
    return $this->hasMany(Comment::class);
}
public function bookmarks() {
    return $this->hasMany(Bookmark::class);
}}
