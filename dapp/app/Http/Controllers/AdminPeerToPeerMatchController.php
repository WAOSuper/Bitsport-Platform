<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Match;
use App\User;
use App\Notifications\FinalWinnerOfMatchByAdmin;


class AdminPeerToPeerMatchController extends Controller
{
    public function index(Request $request)
    {
        $heading = "Matches";

        // $matches = Match::with(['owner' => function($query)
        //                 {
        //                     $query->select('trust_score', 'id');
        //                 }
        //             ]);
        $matches = Match::all();
        // $matches = $matches->get();
        // return $matches;
        // OR return view
        return view('admin.p2pMatch/index', compact('matches', 'heading'));
    }

    /**
     *  ShoW match
     */
    public function show(Request $request, $match_id)
    {
        
        $match = Match::find($match_id);

        $heading = "Match Of ".$match->owner->username;


        return view('admin.p2pMatch/showMatch', \compact('match', 'heading'));
    }

    public function setWinnerOfMatch(Request $request)
    {
        $match = Match::find($request->match_id);

        if ($match->status != \config('match.match_status.pending')) {
            return \back()->with('error', 'Match result is not pending..!');
        }
        $winner = User::find($request->winner_user_id);            
        $match->status = \config('match.match_status.completed');
        $match->winner = $winner->id;
        $match->save();
        $match->giveRewardToGivenUser($winner);
        $match->updateTrustScoreOfBothPlayers();

        $match->owner->notify(new FinalWinnerOfMatchByAdmin($match));
        $match->opponent->notify(new FinalWinnerOfMatchByAdmin($match));


        return \back()->with('success', 'Match Winner is set..!');
    }
}