<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Team;
use App\Models\Event;
use App\Models\Bet;
use App\User;
use App\Models\Odd;
use App\Models\EventMaster;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Sentinel;


class BetController extends Controller
{

    // user side Bet History
    public function getBetHistory() {
         $user_id=Sentinel::getUser()->id;
        $bet=Bet::with('user','event.Master','team')->where('user_id', $user_id)->where('win','<>', 0)->orderBy('id','desc')->get();
        // $bet=Bet::with('user','event.Master','team')->where('status','>',0)->get();
        $balance = (Sentinel::check()) ? User::where('id',Sentinel::getUser()->id)->pluck('mbtc')->first() : 0;
        $bets = (Sentinel::check()) ? Bet::where('user_id',Sentinel::check()->id)->where('status',0)->get() : 0;
        return view('frontend.bets.bet-history',compact('bet','balance','bets'));
    }

    // user side Bet History
    public function getAdminBetHistory() {
    	$bet=Bet::with('user','event.Master','team')->get();
        //return $bet;
    	return view('superadmin.bet.index',compact('bet'));
    }
    
    public function checkodd(Request $request){
        $request->all();
        $result = array();
        $check = $request->checkodd;
        
        for($i=0;$i<count($check);$i++){
            $checkodd = str_replace("bet_","", $check[$i]);
            $checkodd = explode("-",$checkodd);
            if($checkodd[2] > 0){
                $odds = Odd::find($checkodd[2]);
                $result[$check[$i]] = $odds->odd;
            }else{
                $event = Event::find($checkodd[0]);
                if($checkodd[1] == 1)
                    $result[$check[$i]] = $event->odds;
                else if($checkodd[1] == 2)
                    $result[$check[$i]] = $event->draw;
                else
                    $result[$check[$i]] = $event->odds2;
            }
        }
        return $result;
    }
    // user side Bet Active
    public function getBetActive() {
        $user_id=Sentinel::getUser()->id;
    	$bet=Bet::with('user','event.Master','team')->where('user_id', $user_id)->where('status',1)->where('win', 0)->orderBy('id','desc')->get();
        $balance = (Sentinel::check()) ? User::where('id',Sentinel::getUser()->id)->pluck('mbtc')->first() : 0;
        $bets = (Sentinel::check()) ? Bet::where('user_id',Sentinel::check()->id)->where('status',0)->get() : 0;
    	return view('frontend.bets.bet-active',compact('bet','balance','bets'));
    }

    // Admin side  User Bets
    public function usersBets() {
       $bet=Bet::with('user','event.Master','team')->orderBy('id','desc')->get();
       // $bet=Bet::with('user','event.Master','team')->where('status','>',0)->get();
        return view('admin.bets.index',compact('bet'));
    }

    public function checkbal(){
        if(!Sentinel::check())
            return -1;
        else
            return Sentinel::check()->mbtc;
    }
    public function addMyBets(Request $request){

        if(!Sentinel::check())
            return 0;
        $event_id = $request->odd_id;
        $event_id = str_replace("bet_","",$event_id);
        $event_id = explode('-', $event_id);
        $mid = $request->more_id;
        if(!$request->more_id){
            $mid = $event_id[2];
        }
        $event = Event::find($event_id[0]);
        if($event){
            if($mid == 0)
                $check_bet = Bet::where('user_id',Sentinel::check()->id)->where('event_id',$event_id[0])->where('bet_on',$event_id[1])->where('status',0)->first();
            else
                $check_bet = Bet::where('user_id',Sentinel::check()->id)->where('event_id',$event_id[0])->where('team_id',$mid)->where('bet_on',$event_id[1])->where('status',0)->first();
            if($check_bet){
                Bet::destroy($check_bet->id);
                return -1;
            }else if($request->odd_select){
                $id = Sentinel::check()->id;
                $bet = new Bet;
                $bet->odd_title = $request->odd_title;
                $bet->user_id = $id;
                $bet->event_id = $event_id[0];
                if($request->odd_name)
                    $bet->odd_name = $request->odd_name;
                if($request->more_id)
                    $bet->team_id = $request->more_id;
                if($request->odd_select == 1)
                    $bet->odds = $event->odds;
                else if($request->odd_select == 3)
                    $bet->odds = $event->odds2;
                else
                    $bet->odds = $event->draw;
                $bet->date_time = date("Y-m-d H:i:s");
                $bet->bet_type = 0;
                $bet->team_1_name = $request->odd_name1;
                $bet->team_2_name = $request->odd_name2;
                $bet->bet_on = $request->odd_select;
                $bet->status = 0;
                $bet->save();
                return $bet->id;
            }    
        }
        return 0;
    }

}
