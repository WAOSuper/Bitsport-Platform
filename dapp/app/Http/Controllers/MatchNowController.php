<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bet;
use Sentinel;
use App\Models\Match;
use App\Models\Event;
use Carbon\Carbon;
use App\Notifications\SendHashUrl;
use App\Notifications\DiscrepancyWithMatchScore;
use App\Jobs\RewardToMatches;


class MatchNowController extends Controller
{
    private $balance;
    private $bets;

    public function __construct()
    {
        $this->balance = (Sentinel::check()) ? User::where('id', Sentinel::getUser()->id)->pluck('mbtc')->first() : 0;
        $this->bets = (Sentinel::check()) ? Bet::where('user_id', Sentinel::check()->id)->where('status', 0)->get() : 0;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($match_id)
    {
        $balance = $this->balance;
        $bets = $this->bets;
        
        // Opposite Persons username, platform, staked amount
        $match = Match::where('id', $match_id)->first();

        if (empty($match)) {
            return redirect()->back()->with(['error' => "Match not found!"]);
        }

        if ($match->status == \config('match.match_status.expired')) {
            return redirect(\route('match.index'))->with(['error' => "Match is expired!"]);
        }

        if ($match->status == \config('match.match_status.completed')) {
            return redirect(\route('match.index'))->with(['error' => "Match is completed!"]);
        }

        if ($match->status == \config('match.match_status.pending')) {
            return redirect(\route('match.index'))->with(['error' => "Match result is pending!"]);
        }

        if ($match->status > \config('match.match_status.empty')) {
            return redirect()->back()->with(['error' => "Match is already confirm!"]);
        }
        $endDate = Carbon::parse($match->end_time); //($match->end_time * 60);
        if (Carbon::now('UTC')->timestamp > $endDate->timestamp) {
            return redirect()->back()->with(['error' => "Match making time is over!"]);
        }

        return view('frontend.match-now.information', compact('balance', 'bets', 'match'));
    }
    public function confirm($match_id)
    {
        $balance = $this->balance;
        $bets = $this->bets;

        $user = Sentinel::getUser();

        // Opposite Persons username, platform, staked amount
        $match = Match::where('id', $match_id)->first();
            
        if (empty($match)) {
            return redirect()->back()->with(['error' => "Match not found!"]);
        }

        if ($match->status == \config('match.match_status.expired')) {
            return redirect(\route('match.index'))->with(['error' => "Match is expired!"]);
        }
        
        if ($match->status == \config('match.match_status.completed')) {
            return redirect(\route('match.index'))->with(['error' => "Match is completed!"]);
        }

        if ($match->status == \config('match.match_status.pending')) {
            return redirect(\route('match.index'))->with(['error' => "Match result is pending!"]);
        }

        if ($match->owner->id != $user->id) {
            
            if ($match->status > \config('match.match_status.empty')) {
                return redirect()->back()->with(['error' => "Match is already confirm!"]);
            }
            $endDate = Carbon::parse($match->end_time); //($match->end_time * 60);
            if (Carbon::now('UTC')->timestamp > $endDate->timestamp) {
                return redirect()->back()->with(['error' => "Match making time is over!"]);
            }

            return view('frontend.match-now.confirm', compact('balance', 'bets', 'match'));
        }

    }

    // Confirm Match
    public function confirmMatch(Request $request)
    {
        $user = User::find(Sentinel::getUser()->id);

        if ($user->mbtc >= floatval($request->staking)) {

            $match = Match::find($request->match_id);
            if (empty($match)) {
                return redirect('/match')->with(['error' => "Match not found!"]);
            }
            
            if ($match->owner->id != $user->id) {
                if ($match->status > \config('match.match_status.empty')) {
                    return redirect('/match')->with(['error' => "Match is already confirm!"]);
                }
                $endDate = Carbon::parse($match->end_time);
                if (Carbon::now('UTC')->timestamp > $endDate->timestamp) {
                    return redirect('/match')->with(['error' => "Match making time is over!"]);
                }

                $match->status = \config('match.match_status.confirmed');
                $match->opponent_id = $user->id;

                // End Checking Date
                $endDate = Carbon::now('UTC')->addMinutes($match->ckeck_in_duration);
                $endDate = $endDate->tz('UTC');

                $match->end_checking_time = $endDate;
                $match->url_hash = sha1(time()) . '-' . str_random(10);
                $match->save();

                $user->mbtc -= floatval($request->staking);
                $user->save();

                // send email notification to host 
                $host_user = $match->owner;
                $host_user->notify(new SendHashUrl($match->url_hash));

                $opp_user = $match->opponent;
                $opp_user->notify(new SendHashUrl($match->url_hash));
        
                return 1;
            }
            return 0;
        } else {
            return 0;
        }
    }

    public function updateTwitchUsername(Request $request){
        $username = $request->username;
        $id = $request->matchId;
        $match = Match::find($id);
        if(!empty($match)) {
            $match->twitch_url = "https://www.twitch.tv/".$username;
            $match->save();
            return 1;
        }
        return 0;
    }

    public function matchConfirmSuccess(Request $request, $match_id)
    {
        $balance = $this->balance;
        $bets = $this->bets;
        $match = Match::find($match_id);


        if (empty($match)) {
            return redirect('/match')->with(['error' => "Match not found!"]);
        }

        if ($match->status == \config('match.match_status.expired')) {
            return redirect(\route('match.index'))->with(['error' => "Match is expired!"]);
        }

        if ($match->status == \config('match.match_status.completed')) {
            return redirect(\route('match.index'))->with(['error' => "Match is completed!"]);
        }

        if ($match->status == \config('match.match_status.pending')) {
            return redirect(\route('match.index'))->with(['error' => "Match result is pending!"]);
        }

        $url_hash = $match->url_hash;
        return view('frontend.match-now.success', compact('balance', 'bets', 'url_hash'));
    }


    // After confirmation
    public function startCheckIn(Request $request, $url_hash)
    {
        $balance = $this->balance;
        $bets = $this->bets;

        // Opposite Persons username, platform, staked amount
        $match = Match::where('url_hash', $url_hash)->first();
        if (empty($match)) {
            return redirect('/match')->with(['error' => "Match not found!"]);
        }

        if ($match->status == \config('match.match_status.expired')) {
            return redirect(\route('match.index'))->with(['error' => "Match is expired!"]);
        }

        if ($match->status == \config('match.match_status.completed')) {
            return redirect(\route('match.index'))->with(['error' => "Match is completed!"]);
        }

        if ($match->status == \config('match.match_status.pending')) {
            return redirect(\route('match.index'))->with(['error' => "Match result is pending!"]);
        }
        
        if ($match->status == \config('match.match_status.confirmed')) {

            if ($match->owner->id === Sentinel::getUser()->id || $match->opponent->id === Sentinel::getUser()->id) {
                if ($match->status == \config('match.match_status.empty')) {
                    return redirect('/match')->with(['error' => "Something went wrong!"]);
                }
                return view('frontend.match-now.startCheckIn', compact('balance', 'bets', 'match'));
            }
        }else{
            \abort(404);
        }
    }

    // After confirmation
    public function cancelMatch(Request $request)
    {
        $balance = $this->balance;
        $bets = $this->bets;

        $opponent_id = $request->match_id;

        $match = Match::where('id', $opponent_id)->first();

        // check that match is already cancelled or not
        if ($match->status == \config('match.match_status.cancelled')) {
            // Already Cancelled
            return \redirect(\route('match.index'))->with('success', 'Match successfully cancelled');
        } else {
            $stake_amount = $match->stake_amount;

            // get both Users Id
            $user_id = $match->opponent_id;
            $opposit_user_id = $match->user_id;

            // User Balance return
            $user =  User::find($user_id);
            $user->mbtc += $stake_amount;
            $user->save();

            // Opposit User Balance return
            $optuser =  User::find($opposit_user_id);
            $optuser->mbtc += $stake_amount;
            $optuser->save();

            // Make perticular Match ID is cancel
            $match->status = \config('match.match_status.cancelled');
            $match->save();
            return \redirect(\route('match.index'))->with('success', 'Match successfully cancelled');
        }
    }

    // After confirmation
    public function setUpMatch(Request $request)
    {
        $balance = $this->balance;
        $bets = $this->bets;

        $user = User::find(Sentinel::getUser()->id);

        $match = Match::where('id', $request->match_id)->first();

        if ($match->status == \config('match.match_status.expired')) {
            return redirect(\route('match.index'))->with(['error' => "Match is expired!"]);
        }

        if ($match->status == \config('match.match_status.completed')) {
            return redirect(\route('match.index'))->with(['error' => "Match is completed!"]);
        }

        if ($match->status == \config('match.match_status.pending')) {
            return redirect(\route('match.index'))->with(['error' => "Match result is pending!"]);
        }
        
        // show setuup match view to host user of match and waiting view to guest user of match

        // if ($user->id === $match->owner->id) {
        if ($match->isHost($user)) {
            return view('frontend.match-now.setupMatch', compact('balance', 'bets', 'match'));
        }else{
            // if ($user->id === $match->opponent->id){
            if ($match->isGuest($user)){
                return view('frontend.match-now.waitingScreen', compact('balance', 'bets', 'match'));
            }
        }
    }
    
    public function setUpStreamTutorial(Request $request)
    {
        $balance = $this->balance;
        $bets = $this->bets;

        $user = User::find(Sentinel::getUser()->id);

        $match = Match::where('id', $request->match_id)->first();

        if ($match->status == \config('match.match_status.expired')) {
            return redirect(\route('match.index'))->with(['error' => "Match is expired!"]);
        }

        if ($match->status == \config('match.match_status.completed')) {
            return redirect(\route('match.index'))->with(['error' => "Match is completed!"]);
        }

        if ($match->status == \config('match.match_status.pending')) {
            return redirect(\route('match.index'))->with(['error' => "Match result is pending!"]);
        }

        // if current user is host
        //  - if strema_setup_by is host then return stream setup view Tutorial else return waiting screen with match status as ScreenSetUpPassed
        
        // if ($user->id === $match->owner->id) {
        if ($match->isHost($user)) {

            if ($request->strema_setup_by == 'host') {
                return view('frontend.match-now.setUpStreamTutorial', compact('balance', 'bets', 'match'));
            }elseif($request->strema_setup_by == 'guest'){

                $match->status = \config('match.match_status.ScreenSetUpPassed');
                $match->save();
                return view('frontend.match-now.waitingScreen', compact('balance', 'bets', 'match'));
            }
        // }elseif($user->id === $match->opponent->id){
        }elseif($match->isGuest($user)){
                return view('frontend.match-now.waitingScreen', compact('balance', 'bets', 'match'));
        }
    }

    public function streamSetUpDone(Request $request)
    {

        $user = User::find(Sentinel::getUser()->id);

        $match = Match::where('id', $request->match_id)->first();

        // if current user is guest of match and status is equal to ScreenSetUpPassed then return stream setup Tutorial view

        // if ($user->id === $match->opponent->id) {
        if ($match->isGuest($user)){
            if ($match->status == \config('match.match_status.ScreenSetUpPassed')) {
                return 2;
            }
        }
        if ($match->status == \config('match.match_status.streamSetUpDone')) {
            return 1;
        }
        return 0;
    }


    public function setUpStreamTutorialGuest(Request $request)
    {
        $balance = $this->balance;
        $bets = $this->bets;

        $user = User::find(Sentinel::getUser()->id);

        $match = Match::where('id', $request->match_id)->first();

        if ($match->status == \config('match.match_status.expired')) {
            return redirect(\route('match.index'))->with(['error' => "Match is expired!"]);
        }

        if ($match->status == \config('match.match_status.completed')) {
            return redirect(\route('match.index'))->with(['error' => "Match is completed!"]);
        }

        if ($match->status == \config('match.match_status.pending')) {
            return redirect(\route('match.index'))->with(['error' => "Match result is pending!"]);
        }
        // if current user is guest        
        // if($user->id === $match->opponent->id && $match->status == \config('match.match_status.ScreenSetUpPassed')){
        if($match->isGuest($user) && $match->status == \config('match.match_status.ScreenSetUpPassed')){
            return view('frontend.match-now.setUpStreamTutorial', compact('balance', 'bets', 'match'));
        }else {
            \abort(404);
        }
    }


    public function twitchScreen(Request $request)
    {
        $balance = $this->balance;
        $bets = $this->bets;
        
        $user = User::find(Sentinel::getUser()->id);

        $match = Match::where('id', $request->match_id)->first();

        if ($match->status == \config('match.match_status.completed')) {
            return redirect(\route('match.index'))->with(['error' => "Match is completed!"]);
        }

        if ($match->status == \config('match.match_status.pending')) {
            return redirect(\route('match.index'))->with(['error' => "Match result is pending!"]);
        }
        
        if ($request->has('setup-completed-ckeck')) {
            $match->status = \config('match.match_status.streamSetUpDone');
            $match->save();
        }

        // if ($user->id === $match->owner->id || $user->id === $match->opponent->id) {
        if ($match->isHost($user) || $match->isGuest($user)) {
            if ($match->status == \config('match.match_status.streamSetUpDone')) {
                if ($match->isHost($user)) {
                    $this->createliveEvent($match);
                }
                return view('frontend.match-now.twitchStreaming', compact('balance', 'bets', 'match'));                
            }else{
                return view('frontend.match-now.waitingScreen', compact('balance', 'bets', 'match'))->with('error', 'Stream setup is not done yet, please wait for a few seconds and then try again.');
            }
        }else{
            return \redirect(route('match.index'));
        }

    }

    protected function createliveEvent(Match $match)
    {
        Event::create(
            [
                'cat_id' => 2,
                'event_master_id' => 97,
                'twitch_url' => 'https://player.twitch.tv/?channel='.substr($match->twitch_url, strpos($match->twitch_url, "tv/") + 3),
                'team_1_id' => $match->owner->id,
                'odds' => rand (0.5*10, 2.9*10) / 10,
                'team_2_id' => $match->opponent->id,
                'odds2' => rand (0.5*10, 2.9*10) / 10,
                'draw' => rand (0.5*10, 2.9*10) / 10,
                'start_date' => $match->created_at,
                'end_date' => $match->end_time,
                'live' => 1,
                'status' => 0,
                'winloss' => 0,
                'winner' => 0,
                'is_deleted' => 0,
                'is_approve' => 1,
                'created_by' => $match->owner->id,
                'team_1_score' => $match->getOwnScore(),
                'team_2_score' => $match->getOppScore(),
                'match_id' => $match->id,
            ]
        );
    }

    protected function updateEvent(Match $match)
    {
        $event = Event::where('match_id', $match->id)->first();

        $event->live = 2;
        $event->winner = $match->getWinnerUser()?($match->isOwner($match->getWinnerUser()) ? 1 : ($match->isOpponent($match->getWinnerUser())? 3 : 0)) : ($match->isMatchDraw()? 2 : 0);
        $event->team_1_score = $match->getOwnScore();
        $event->team_2_score = $match->getOppScore();
        $event->save();
    }

    public function matchReporting(Request $request)
    {
        $balance = $this->balance;
        $bets = $this->bets;

        $user = User::find(Sentinel::getUser()->id);

        $match = Match::where('id', $request->match_id)->first();

        if ($match->status == \config('match.match_status.completed')) {
            return redirect(\route('match.index'))->with(['error' => "Match is completed!"]);
        }

        if ($match->status == \config('match.match_status.pending')) {
            return redirect(\route('match.index'))->with(['error' => "Match result is pending!"]);
        }

        // if ($user->id === $match->owner->id || $user->id === $match->opponent->id) {
        if ($match->isHost($user) || $match->isGuest($user)) {
            return view('frontend.match-now.matchReporting', compact('balance', 'bets', 'match'));
        }else{
            \abort(404);
        }

    }

    public function checkMatchReporting(Request $request)
    {
        $balance = $this->balance;
        $bets = $this->bets;

        $user = User::find(Sentinel::getUser()->id);

        $match = Match::where('id', $request->match_id)->first();

        if ($match->status == \config('match.match_status.completed')) {
            return redirect(\route('match.index'))->with(['error' => "Match is completed!"]);
        }

        if ($match->status == \config('match.match_status.pending')) {
            return redirect(\route('match.index'))->with(['error' => "Match result is pending!"]);
        }

        if ($user->id === $match->owner->id) {
            $match->score_of_opp_by_own = $request->score_of_my_opp;
            $match->score_of_own_by_own = $request->score_of_my;
        }else{
            if ($user->id === $match->opponent->id) {
                $match->score_of_own_by_opp = $request->score_of_my_opp;
                $match->score_of_opp_by_opp = $request->score_of_my;
            }
        }
        $match->save();

        // if ($user->id === $match->owner->id || $user->id === $match->opponent->id) {
        if ($match->isHost($user) || $match->isGuest($user)) {
            return view('frontend.match-now.finalAnnouncement', compact('balance', 'bets', 'match'));
        }else{
            \abort(404);
        }

    }


    public function announceResult(Request $request)
    {
        $user = User::find(Sentinel::getUser()->id);

        $match = Match::where('id', $request->match_id)->first();

        // if ($match->score_of_opp_by_opp != null && $match->score_of_own_by_opp != null && $match->score_of_opp_by_own != null && $match->score_of_own_by_own != null ) {
        if (!empty($match->score_of_opp_by_opp) && !empty($match->score_of_opp_by_own) && !empty($match->score_of_own_by_opp) && !empty($match->score_of_own_by_own)) {
        // if (!$match->isEmptyByBoth()) {

            if ($match->score_of_opp_by_opp === $match->score_of_opp_by_own && $match->score_of_own_by_opp === $match->score_of_own_by_own) {
                
                if ($match->score_of_own_by_opp == $match->score_of_opp_by_own) {
                    $match->status = \config('match.match_status.drawMatch');
                    $match->save();
                    return 2;
                }
                if ($match->score_of_own_by_opp > $match->score_of_opp_by_own) {
                    $winner = $match->owner;                    
                }else{
                    $winner = $match->opponent;
                }
                if ($match->isHost($user)) {
                    $match->status = \config('match.match_status.completed');
                    $match->winner = $winner->id;
                    $match->save();
                    $match->updateTrustScoreOfBothPlayers();
                    $this->updateEvent($match);
                }
                // RewardToMatches
                if ($user->id === $winner->id) {
                    dispatch(new RewardToMatches($match));
                }
                return \response()->json(['winner_name' => $winner->username]);
            }else{
                //discrepancy notification to admin
                $admin_user = User::find(1);
                $admin_user->notify(new DiscrepancyWithMatchScore($match));
                $match->status = \config('match.match_status.pending');
                $match->save();
                return 0;
            }             
        }else{
            return 1;
        }
    }

    public function expiredMatch(Request $request)
    {
        $match = Match::where('id', $request->match_id)->first();
        if ($match->status == \config('match.match_status.confirmed')) {
            $match->status = \config('match.match_status.expired');
            $match->save();
            return 1;
        }   
        return 0;
    }    

}

