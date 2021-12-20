<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'google2fa_secret', 'password', 'remember_token',
    ];


    public function ref()
    {
        return $this->hasMany('App\Referral', 'user_id', 'id');
    }

    public function followingEvents()
    {
        return $this->belongsToMany('App\Models\Event', 'follow_events');
    }
}
