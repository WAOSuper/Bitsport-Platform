<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowEvent extends Model
{
    public function follower()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function following()
    {
        return $this->belongsTo('App\Models\Event', 'event_id', 'id');
    }
}
