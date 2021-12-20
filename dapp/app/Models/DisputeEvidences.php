<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisputeEvidences extends Model
{
    protected $fillable = [
        'user_id',
        'challenge_id',
        'comments',
        'files'
    ];

    public function challenge()
    {
        return $this->belongsTo('App\Models\Challenge');
    }
}
