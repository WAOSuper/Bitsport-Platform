<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowTournament extends Model
{
    public function following()
    {
        return $this->hasOne('App\Models\Tournament', 'tournament_id', 'id');
    }
}