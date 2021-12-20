<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Bet;
use Sentinel;
use App\Models\Match;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;



class MatchController extends Controller
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
    public function index()
    {
        $balance = $this->balance;
        $bets = $this->bets;
        return view('frontend.match.index', compact('balance', 'bets'));
    }

    public function getLatestMatches()
    {
        $current_time = Carbon::now()->tz('UTC');
        
        $matches = Match::where('end_time', '>', $current_time)->where('stake_amount', '>','0')->where('status', '0')
            ->with(['owner' => function($query)
                                {
                                    $query->select('trust_score', 'id');
                                }
                    ]);

        if (Sentinel::check()) {
           
            $matches = $matches->where('user_id', '!=', Sentinel::check()->id);
        }

        $matches = $matches->get();

        // dd($matches);

        return $matches;
    }


    public function information()
    {
        $balance = $this->balance;
        $bets = $this->bets;
        return view('frontend.match.information', compact('balance', 'bets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $balance = $this->balance;
        $bets = $this->bets;
        return view('frontend.match.create', compact('balance', 'bets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $endDate = Carbon::now()->addMinutes($request->match_making_duration * 60);
        $endDate = $endDate->tz('UTC');
        // $url = ($request->has('host')) ? "https://www.twitch.tv/".$request->username : '';
        $match =  Match::create([
            'user_id' => Sentinel::check()->id,
            'timezone_offset' => $request->timezone,
            'psn_id' => $request->psn_id,
            'match_making_duration' => $request->match_making_duration * 60,
            'username' => $request->has('host') ? $request->username : '',
            'ckeck_in_duration' => $request->ckeck_in_duration,
            'platform' => $request->platform,
            'host' => $request->has('host') ? $request->host : 0,
            'game_mode' => $request->game_mode,
            'phone' => $request->phone,
            'end_time' => $endDate,
            'status' => config('match.match_status.empty'),
            // 'twitch_url' => $url,
        ]);
        $match_id = $match->id;

        // need to redirect to confirm page where user will confirm stack amount
        $balance = $this->balance;
        $bets = $this->bets;
        return view('frontend.match.confirm', compact('balance', 'bets', 'match_id'));
    }

    public function confirmMatch(Request $request)
    {
        $user = Sentinel::getUser();
        if(!$request->match_id) {
            return redirect()->back()->with(['error' => "Something wrong please try again!"]);
        }
        if ($user->mbtc >= floatval($request->staking)) {
            $match = Match::find($request->match_id);
            $match->stake_amount = floatval($request->staking);
            $match->save();

            $user->mbtc -= floatval($request->staking);
            $user->save();
            return 1;
        }
        return 0;
    }

    public function matchConfirmationSuccess(Request $request)
    {
        $balance = $this->balance;
        $bets = $this->bets;
        return view('frontend.match.success', compact('balance', 'bets'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $balance = $this->balance;
        $bets = $this->bets;
        return view('frontend.match.create', compact('balance', 'bets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
