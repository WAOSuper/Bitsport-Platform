<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Match extends Model
{
    protected $fillable = [
        'user_id',
        'timezone_offset',
        'psn_id',
        'match_making_duration',
        'username',
        'ckeck_in_duration',
        'platform',
        'host',
        'game_mode',
        'phone',
        'stake_amount',
        'opponent_id',
        'end_time',
        'status',
        'twitch_url',
        'score_of_opp_by_opp',
        'score_of_own_by_opp',
        'score_of_opp_by_own',
        'score_of_own_by_own',
        'system_fees',
        'winner',
    ];

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function opponent()
    {
        return $this->belongsTo('App\User', 'opponent_id', 'id');
    }

    public function winnerUser()
    {
        return $this->belongsTo('App\User', 'winner', 'id');
    }

    public function getHost()
    {
        return $this->host? $this->owner : $this->opponent;
    }

    public function getGuest()
    {
        return $this->host? $this->opponent : $this->owner;
    }

    public function isHost($user)
    {
        return $user->id === $this->getHost()->id;
    }

    public function isGuest($user)
    {
        return $user->id === $this->getGuest()->id;
    }

    public function isOwner($user)
    {
        // dd($user->id);
        return $user->id === $this->owner->id;
    }

    public function isOpponent($user)
    {
        return $user->id === $this->opponent->id;
    }


    public function event()
    {
        return $this->hasOne('App\Models\Event', 'match_id', 'id');
    }

    public function scopeRevoked($query)
    {
        $ignore_status = [
            \config('match.match_status.revoked'),
            \config('match.match_status.cancelled'),
            \config('match.match_status.completed'),
        ];
        return $query->where('end_time', '<=', Carbon::now()->tz('UTC'))->whereNotIn('status', $ignore_status);
    }

    public function isMatchDraw()
    {
        if (!empty($this->score_of_opp_by_opp) && !empty($this->score_of_opp_by_own) && !empty($this->score_of_own_by_opp) && !empty($this->score_of_own_by_own)) {
    
            if ($this->score_of_opp_by_opp === $this->score_of_opp_by_own && $this->score_of_own_by_opp === $this->score_of_own_by_own) {
                
                if ($this->score_of_own_by_opp == $this->score_of_opp_by_own) {
                    return true;
                }
            }
        }
        return false;
    }









    public function getWinnerUser()
    {
        return $this->winnerUser;
    }

    public function getTotalStakeAmount()
    {
        return $this->stake_amount * 2;
    }

    public function countSystemFees()
    {
        return $this->getTotalStakeAmount()*0.05;
    }

    public function getRewardAmount()
    {
        return $this->getTotalStakeAmount()-$this->countSystemFees();
    }

    public function giveRewardToWinnerUser()
    {
        $winner = $this->getWinnerUser();
        if ($winner != null) {
            $this->giveRewardToGivenUser($winner);
        }
    }

    public function giveRewardToGivenUser($user)
    {
        $user->craditMbtc($this->getRewardAmount());
        $this->system_fees = $this->countSystemFees();
        $this->save();
    }


    public function updateTrustScoreOfBothPlayers()
    {
        $win_raio_own = $this->owner->getWinRatio();
        $win_raio_opp = $this->opponent->getWinRatio();

        $this->owner->trust_score = $win_raio_own;
        $this->owner->save();

        $this->opponent->trust_score = $win_raio_opp;
        $this->opponent->save();
    }








    public function isEmptyByOpp()
    {
        $result = $this->score_of_opp_by_opp == null && $this->score_of_own_by_opp == null;
        return $result;
    }

    public function isEmptyByOwn()
    {
        $result = $this->score_of_opp_by_own == null && $this->score_of_own_by_own == null;
        return $result;
    }

    public function isEmptyByBoth()
    {
        $result = !empty($this->score_of_opp_by_opp) && !empty($this->score_of_opp_by_own) && !empty($this->score_of_own_by_opp) && !empty($this->score_of_own_by_own);
        // $result = empty($this->score_of_opp_by_opp) && empty($this->score_of_opp_by_own) && empty($this->score_of_own_by_opp) && empty($this->score_of_own_by_own);
        return !$result;
    }

    public function getOwnScore()
    {
        return ($this->score_of_own_by_opp ?? $this->score_of_own_by_own) ?? 0;
    }

    public function getOppScore()
    {
        return ($this->score_of_opp_by_opp ?? $this->score_of_opp_by_own) ?? 0;
    }

}
