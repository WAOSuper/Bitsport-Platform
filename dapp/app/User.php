<?php

namespace App;

use App\Models\Challenge;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'trust_score',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'google2fa_secret', 'password', 'remember_token',
    ];

    public function follower()
    {
        return $this->hasMany('App\Models\Follow', 'follower_id', 'id');
    }

    public function following()
    {
        return $this->hasMany('App\Models\Follow', 'following_id', 'id');
    }

    public function blocked()
    {
        return $this->hasMany('App\Models\Blocked');
    }

    public function blocked_by()
    {
        return $this->hasMany('App\Models\Blocked','blocked_user_id','id');
    }

    public function ref()
    {
        return $this->hasMany('App\Referral', 'user_id', 'id');
    }

    public function followingEvents()
    {
        return $this->belongsToMany('App\Models\Event', 'follow_events');
    }

    public function preferred_console()
    {
        return $this->hasOne('App\Models\Console', 'id', 'preferred_console_id');
    }

    public function preferred_game()
    {
        return $this->hasOne('App\Models\Game', 'id', 'preferred_game_id');
    }

    // p2p matches
    public function OwneMatches()
    {
        return $this->hasMany('App\Models\Match', 'user_id', 'id');
    }

    public function OwneChallenges()
    {
        return $this->hasMany('App\Models\Challenge', 'user_id', 'id');
    }

    public function OpponentMatches()
    {
        return $this->hasMany('App\Models\Match', 'opponent_id', 'id');
    }

    public function OpponentChallenges()
    {
        return $this->hasMany('App\Models\Challenge', 'opponent_id', 'id');
    }

    public function WinnerOfMatches()
    {
        return $this->hasMany('App\Models\Match', 'winner', 'id');
    }

    public function WinnerOfChallenges()
    {
        return $this->hasMany('App\Models\Challenge', 'winner_id', 'id');
    }

    public function ChallengeResults()
    {
        return $this->hasMany('App\Models\ChallengeResult', 'user_id', 'id');
    }

    public function ChallengeFeedbacks()
    {
        return $this->hasMany('App\Models\ChallengeResult', 'opponent_id', 'id');
    }

    public function activities()
    {
        return $this->hasMany('App\Models\Activity', 'user_id', 'id');
    }

    public function craditMbtc($amount)
    {
        $mbtc = $this->mbtc;
        $mbtc += $amount;
        $this->mbtc = $mbtc;
        $this->save();
    }

    public function getTotalNumberOfMatchesPlayedBy()
    {
        return $this->OwneMatches->count() + $this->OpponentMatches->count();
    }

    public function getTotalNumberOfChallengesPlayedBy()
    {
        return $this->OwneChallenges->count() + $this->OpponentChallenges->count();
    }

    public function getNumberOfMatchesWinBy()
    {
        return $this->WinnerOfMatches->count();
    }

    public function getNumberOfChallengesWinBy()
    {
        return $this->WinnerOfChallenges->count();
    }

    public function number_of_winnings()
    {
        return $this->WinnerOfChallenges->count() + $this->WinnerOfMatches->count();
    }

    public function getDrawMatches()
    {
        return $this->OwneMatches()->where('winner', 0)->count();
    }

    public function getDrawChallenges()
    {
        return $this->OwneChallenges()->where('winner_id', 0)->count();
    }

    public function number_of_losses()
    {
        // losses = total-won-draw
        $drawMatches = $this->getDrawChallenges() + $this->getDrawMatches();
        $totalMatches = $this->OwneChallenges()->count() + $this->OwneMatches()->count();
        $this->number_of_winnings();
        return ($totalMatches - $this->number_of_winnings() - $drawMatches);
    }

    public function getOverAllRating()
    {
        $result = $this->ChallengeFeedbacks;
        $total = count($result);
        $skill_rating = 0;
        if($total){
            foreach ($result as $key => $value) {
                $skill_rating += $value->skill_rating;
            }
            $rating_by = 5;
            return (($total * $rating_by) / $skill_rating);
        }
        return $skill_rating;
    }

    public function getWinRatio()
    {
        // (win*100)/total
        $win = $this->getNumberOfMatchesWinBy() + $this->getNumberOfChallengesWinBy();
        $total = $this->getTotalNumberOfMatchesPlayedBy() + $this->getTotalNumberOfChallengesPlayedBy();
        return round(($win * 100) / $total);
    }

    public function getPlayedGames()
    {        
        $groupdByGames = DB::table('challenges')->join('games', 'challenges.game_id', '=', 'games.id')->select('games.*')
        ->where(function ($q) {
            return $q->where('user_id',$this->id)->orWhere('opponent_id',$this->id);
        })
        ->groupBy('challenges.game_id')->get();
        $games = [];
        foreach ($groupdByGames as $key => $game) {
            $games[$key] = (object)[];
            $games[$key]->game_name = $game->name;
            $games[$key]->console_name = DB::select('SELECT name FROM `consoles` where id = ? ',[$game->console_id])[0]->name;
            $games[$key]->losses = DB::select('SELECT COUNT(id) as losses FROM `challenges` WHERE (winner_id = 0 OR winner_id = null) and (user_id = ? OR opponent_id = ?) and game_id = ?',[$this->id, $this->id,$game->id])[0]->losses;
            $games[$key]->wins = DB::select('SELECT COUNT(id) as wins FROM `challenges` WHERE winner_id = ? and game_id = ?',[$this->id,$game->id])[0]->wins;
            $games[$key]->skill_rating = $this->getAverageRating(DB::select('SELECT `challenge_results`.skill_rating FROM `challenges` LEFT JOIN `challenge_results` ON `challenge_results`.`challenge_id` =  `challenges`.`id` WHERE `challenges`.`status` = 5  and `challenge_results`.`opponent_id` = ? and `challenges`.`game_id` = ?',[$this->id,$game->id]));
        }
        return $games;
    }

    public function getRecentFeedbacks()
    {      
        $feedbacks = $this->ChallengeFeedbacks;
        foreach ($feedbacks as $key => $feedback) {
            $feedbacks[$key]->challenge = Challenge::find($feedback->challenge_id)->with('winner','opponent','creator','game','console')->first();
            $feedbacks[$key]->isOpponent = ($feedbacks[$key]->challenge->opponent_id == $this->id);
        }
        return $feedbacks;
    }

    public function getAverageRating($result)
    {
        $total = count($result);
        $skill_rating = 0;
        if($total){
            foreach ($result as $value) {
                $skill_rating += $value->skill_rating;
            }
            $rating_by = 5;
            return (($total * $rating_by) / $skill_rating);
        }
        return $skill_rating;
    }
}
