<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;
use App\Notifications\FinalWinnerOfChallengeByAdmin;
use App\User;


class AdminChallengeController extends Controller
{
    public function index(Request $request)
    {
        $heading = "Challenge";
        $challenges = Challenge::with(['game', 'console'])->get();
        return view('admin.challenge/index', compact('challenges', 'heading'));
    }
    public function disputes(Request $request)
    {
        $heading = "Disputed Challenge";
        $challenges = Challenge::with(['game', 'console'])->where('status', 6)->get();
        return view('admin.challenge/index', compact('challenges', 'heading'));
    }

    /**
     *  ShoW match
     */
    public function show($challenge_id, Request $request)
    {
        $challenge = Challenge::with(['game', 'console', 'mode', 'challenge_results','dispute_evidences'])->find($challenge_id);
        $result =  (object) [];
        if ($challenge->challenge_results && count($challenge->challenge_results)) {
            foreach ($challenge->challenge_results as $key => $value) {
                if ($value->user_id == $challenge->user_id) { // creator
                    $result->ResultOfOpponentByCreator =  \config('challenge.winning')[$value->won];
                    $result->ExperienceOfOpponentByCreator = \config('challenge.experience')[$value->experience];
                    $result->SkillOfOpponentByCreator = \config('challenge.skill_rating')[$value->skill_rating];
                }
                if ($value->user_id == $challenge->opponent_id) { // opponent
                    $result->ResultOfCreatorByOpponent = \config('challenge.winning')[$value->won];
                    $result->ExperienceOfCreatorByOpponent = \config('challenge.experience')[$value->experience];
                    $result->SkillOfCreatorByOpponent = \config('challenge.skill_rating')[$value->skill_rating];
                }
            }
        }
        $heading = "Challenge Of " . $challenge->creator->username;
        return view('admin.challenge.showChallenge', \compact('challenge', 'heading', 'result'));
    }

    public function setWinnerOfChallenge(Request $request)
    {
        $challenge = Challenge::find($request->challenge_id);
        if ($challenge->status != \config('challenge.status.dispute')) {
            return \back()->with('error', 'Challenge result is not dispute..!');
        }
        if ($request->winner_user_id) {
            $winner = User::find($request->winner_user_id);
            $challenge->winner_id = $winner->id;
            $challenge_price = $challenge->amount;
            $percentage = \config('challenge.admin_profit_percentage');
            $admin_profit = $challenge_price / $percentage;
            $user = User::get();
            $this->creditBalance($user[0], $admin_profit); // Credit amount to admin
            $user_profit = $challenge_price - $admin_profit;
            $user = User::find($request->winner_user_id);
            $this->creditBalance($user, $user_profit);  // Credit amount to winner
            // Notification to user has won the match
        } else {
            $challenge->winner_id = 0;
            $this->creditBalance($challenge->creator, $challenge->amount); // Credit amount to admin
            $this->creditBalance($challenge->opponent, $challenge->amount); // Credit amount to admin
        }
        $challenge->status = \config('challenge.status.completed');
        $challenge->save();
        $challenge->updateTrustScoreOfBothPlayers();
        $challenge->creator->notify(new FinalWinnerOfChallengeByAdmin($challenge));
        $challenge->opponent->notify(new FinalWinnerOfChallengeByAdmin($challenge));
        return \back()->with('success', 'Challenge Winner is set..!');
    }

    public function creditBalance($user, $amount)
    {
        $user->mbtc += floatval($amount);
        $user->save();
    }

    public function debitBalance($user, $amount)
    {
        $user->mbtc -= floatval($amount);
        $user->save();
    }
}
