<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
     'name', 'slug', 'logo', 'league', 'country'
    ];

    public function news() {
        return $this->hasMany(News::class);
    }
    public function players() {
    return $this->hasMany(Player::class);
}
}
