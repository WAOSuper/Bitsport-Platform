<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InviteCodeUsed extends Model
{
	protected $table = 'invite_code_used';

    protected $fillable = ['invite_code_id', 'user_id'];

    public function user()
    {
       return $this->hasOne('App\User', 'id', 'user_id');
    }
}
