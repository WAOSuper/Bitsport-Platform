<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    public function follower()
    {
        return $this->hasOne('App\Models\User', 'follower_id', 'id');
    }

    public function following()
    {
        return $this->hasOne('App\Models\User', 'following_id', 'id');
    }
}
