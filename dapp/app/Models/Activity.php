<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Activity extends Model
{
    protected $table = 'activities';

    protected $fillable = [
        'user_id',
        'challenge_id',
        'type',
        'read_status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function challenge()
    {
        return $this->belongsTo('App\Models\Challenge');
    }
}
