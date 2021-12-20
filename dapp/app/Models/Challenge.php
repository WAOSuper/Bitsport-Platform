<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{

    protected $table = 'challenges';

    protected $fillable = [
        'psn_id',
        'game_id',
        'amount',
        'console',
        'team_size',
        'rules_c',
        'rules_o',
        'winner_id',
        'xbox_id',
        'status',
        'skill_rating_c',
        'feedback_c',
        'skill_rating_o',
        'feedback_o',
        'game_mode',
        'opponent_id',
        'console_id',
        'game_id',
        'mode',
        'user_id',
        'timezone_offset'
    ];

    public function creator()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function opponent()
    {
        return $this->hasOne('App\User', 'id', 'opponent_id');
    }

    public function winner()
    {
        return $this->hasOne('App\User', 'id', 'winner_id');
    }

    public function console()
    {
        return $this->hasOne('App\Models\Console', 'id', 'console_id');
    }

    public function game()
    {
        return $this->hasOne('App\Models\Game', 'id', 'game_id');
    }

    public function mode()
    {
        return $this->hasOne('App\Models\Mode', 'id', 'mode_id');
    }

    public function challenge_results()
    {
        return $this->hasMany('App\Models\ChallengeResult');
    }
    
    public function dispute_evidences()
    {
        return $this->hasMany('App\Models\DisputeEvidences');
    }


    public function updateTrustScoreOfBothPlayers()
    {
        $this->creator->trust_score = $this->creator->getWinRatio();
        $this->creator->save();
        $this->opponent->trust_score = $this->opponent->getWinRatio();
        $this->opponent->save();
    }
}
