<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChallengeResult extends Model
{
    protected $table = 'challenge_results';
   
    protected $fillable = [
        'user_id',
        'opponent_id',
        'challenge_id',
        'won',
        'experience',
        'skill_rating'
    ];

    public function challenge()
    {
        return $this->belongsTo('App\Models\Challenge');
    }
}
