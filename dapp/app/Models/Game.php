<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

    protected $table = 'games';

    protected $fillable = [
        'name'
    ];

    public function mode()
    {
        return $this->hasMany('App\Models\Mode', 'game_id');
    }
}
