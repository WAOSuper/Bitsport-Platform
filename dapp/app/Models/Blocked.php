<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blocked extends Model
{
    protected $table = 'blocked';

    protected $fillable = [
        'blocked_user_id',
        'user_id',
    ];

}
