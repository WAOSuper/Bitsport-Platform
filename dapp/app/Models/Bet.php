<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    public function event()
    {
        return $this->hasOne('App\Models\Event', 'id', 'event_id');
    }

    public function team()
    {
        return $this->hasOne('App\Models\Team', 'id', 'team_id');
    }
    public function odd()
    {
        return $this->hasOne('App\Models\Odd', 'id', 'team_id');
    }
}
