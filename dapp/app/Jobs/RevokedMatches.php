<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Models\Match;
use Carbon\Carbon;
use File;


class RevokedMatches implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $cronLog = storage_path('logs/cron.log');
        if (!File::exists($cronLog)) {
            File::put($cronLog, '');
        }
        $matches = Match::revoked()->get();
        foreach ($matches as $match ) {

            switch ($match->status) {
                case config('match.match_status.empty'):
                {
                    $match->status = config('match.match_status.revoked');
                    $match->save();
                    
                    $user = $match->owner;
                    $user->craditMbtc($match->stake_amount);

                    break;
                }

                case config('match.match_status.confirmed'):
                {
                    if ($match->isEmptyByOpp() && !$match->isEmptyByOwn()) {
                        $match->giveRewardToGivenUser($match->owner);
                        $match->status = \config('match.match_status.completed');
                        $match->winner = $match->owner->id;
                        $match->save();
                        $match->updateTrustScoreOfBothPlayers();


                    }elseif($match->isEmptyByOwn() && !$match->isEmptyByOpp()){  
                        $match->giveRewardToGivenUser($match->opponent);
                        $match->status = \config('match.match_status.completed');
                        $match->winner = $match->opponent->id;
                        $match->save();
                        $match->updateTrustScoreOfBothPlayers();


                    }elseif($match->isEmptyByBoth()){
                        $match->status = config('match.match_status.revoked');
                        $match->save();
                    
                        $user_own = $match->owner;
                        $user_own->craditMbtc($match->stake_amount);

                        $user_opp = $match->opponent;
                        $user_opp->craditMbtc($match->stake_amount);
                    }
                    break;
                }
                
                case config('match.match_status.streamSetUpDone'):
                {
                    if ($match->isEmptyByOpp() && !$match->isEmptyByOwn()) {
                        $match->giveRewardToGivenUser($match->owner);
                        $match->status = \config('match.match_status.completed');
                        $match->winner = $match->owner->id;
                        $match->save();
                        $match->updateTrustScoreOfBothPlayers();


                    }elseif($match->isEmptyByOwn() && !$match->isEmptyByOpp()){  
                        $match->giveRewardToGivenUser($match->opponent);
                        $match->status = \config('match.match_status.completed');
                        $match->winner = $match->opponent->id;
                        $match->save();
                        $match->updateTrustScoreOfBothPlayers();


                    }elseif($match->isEmptyByBoth()){
                        $match->status = config('match.match_status.revoked');
                        $match->save();
                    
                        $user_own = $match->owner;
                        $user_own->craditMbtc($match->stake_amount);

                        $user_opp = $match->opponent;
                        $user_opp->craditMbtc($match->stake_amount);
                    }
                    
                    break;
                }
                case config('match.match_status.expire'):
                {
                        $match->status = config('match.match_status.revoked');
                        $match->save();
                    
                        $user_own = $match->owner;
                        $user_own->craditMbtc($match->stake_amount);

                        $user_opp = $match->opponent;
                        $user_opp->craditMbtc($match->stake_amount);
                    break;
                }
                case config('match.match_status.ScreenSetUpPassed'):
                {
                        $match->status = config('match.match_status.revoked');
                        $match->save();
                    
                        $user_own = $match->owner;
                        $user_own->craditMbtc($match->stake_amount);

                        $user_opp = $match->opponent;
                        $user_opp->craditMbtc($match->stake_amount);
                    break;
                }
                case config('match.match_status.drawMatch'):
                    {

                        // user with total high score...
                        // if till now is same then then owner is wone.... 

                        $total_score_of_owner = Match::where('status', \config('match.match_status.completed'))->where('score_of_own_by_own', '!=', null)->count('score_of_own_by_own');
                        $total_score_of_opp = Match::where('status', \config('match.match_status.completed'))->where('score_of_opp_by_opp', '!=', null)->count('score_of_opp_by_opp');
                        $match->status = \config('match.match_status.completed');

                        if ($total_score_of_owner >= $total_score_of_opp) {
                            $match->winner = $match->owner->id;
                            $match->save();
                        }else{
                            $match->winner = $match->opponent->id;
                            $match->save();
                        }
                        $match->updateTrustScoreOfBothPlayers();
                        break;
                    }
            }
        }
    }
}
