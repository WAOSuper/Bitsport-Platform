<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Event;
use App\Models\Bet;
use App\Models\Odd;
use App\User;
use App\Models\EventMaster;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\EventOddMaster;
use App\Models\Participant;
use App\Models\Tournament;
use Sentinel;
use Illuminate\Support\Facades\DB;

class AdminEventController extends Controller
{
     	/*Redirect to admin list Event page*/
    public function index()
    {
        $route = request()->segment(count(request()->segments()));

        // Check and update Ended event have after 48hours.

        $data = Event::where('is_deleted', 0)->get();
        foreach ($data as $key => $value) {
            $after_forty_eight_hours =  date('Y-m-d H:i:s', strtotime($value->end_date . " +48 hours"));
            if(date('Y-m-d H:i:s') >= $value->end_date)
            {
                Event::where('id',$value->id)->update(['live'=>2]);
                Event::where('id',$value->id)->update(['featured'=>2]);
            }
            if(date('Y-m-d H:i:s') >= $after_forty_eight_hours)
            {
                Event::where('id',$value->id)->update(['is_deleted'=>1]);
            }
        }

	   //$events=Event::with('Cat','SubCat','SubSubCat','Master','Team1','Team2','Odd.oddMasterName')->where('is_deleted', 0)->get();
       // $ev =Event::with('Team1', 'Team2', 'Odd.oddMasterName')->whereIn('winner', [1,2,3])->get(); 
       // $team_1=Event::with('Team1', 'Team2', 'Odd.oddMasterName')->where(['winner' => 1])->select('team_1_id')->get();


        $user = Sentinel::getUser();
        $role = $user->roles()->first()->slug;
        $eventObject = Event::with('Cat','SubCat','SubSubCat','Master','Team1','Team2','Odd.oddMasterName', 'Odd.oddBet')->where('is_deleted', 0);
        if($route !== "admin-event" && $route !== "creator-event" && $role !== "creator") {
            $eventObject->where('is_approve', 0);
        }
        if($role == "creator") {
            $eventObject->where('created_by', $user->id);
        }
        $events=$eventObject->get();
        // foreach ($events as $key => $value) {
        //     $master = $value->Odd->groupBy('odd_id');
        //     foreach ($master as $val) {
        //         foreach ($value->Odd->where('odd_id', $val[0]->odd_id) as $data) {
        //             echo $data->name;
        //         }
        //     }
        // }
        // die;
        return view('admin.event.index',compact('events', 'role', 'route'));
    }

    /*Redirect to admin create Event page*/
    public function create()
    {
        $user = Sentinel::getUser();
        $role = $user->roles()->first()->slug;
        $categoryObject=category::where('status',0);
        $subcategoryObject=SubCategory::where('status',0);
        $subsubcategoryObject=SubSubCategory::where('status',0);
    	$teamsObject=Team::where('status',0);
        if($role == "creator") {
            $teamsObject->where('created_by', $user->id);
        }
        $eventmaster=EventMaster::where('status',0)->get();
        $category=$categoryObject->get();
        $subcategory=$subcategoryObject->get();
        $subsubcategory=$subsubcategoryObject->get();
        $teams=$teamsObject->get();
        $eventOdds = EventOddMaster::where('status',0)->get();
    	return view('admin.event.create',compact('eventmaster','category','subcategory','subsubcategory','teams', 'role', 'eventOdds'));
    }

    public function show($id)
    {
		//return view('admin.blog.create');
    }
    
    public function winloss($id){
        $event = Event::find($id);
        if($event){
            if($event->winloss > 0 || $event->status == 1 ) {
                return redirect()->back()->with("error","Event is already win or disabled.");
            }
            $bets = Bet::with('odd')->where('event_id',$id)->where('status',1)->limit(1)->where('win',0)->get();
            return view('admin.event.windloss',compact('bets','id'));
        }
        return redirect()->back()->with("error","Something went wrong.");
    }

    public function winlossUpdate(Request $request)
    {
        $user = Sentinel::getUser();
        $role = $user->roles()->first()->slug;
        $event_id = $request->event_id;
        $odd = Odd::where('event_id',$event_id)->get();
        $extraOdds = Bet::where('event_id', $event_id)->where('win',0)->where('team_id','<>',0)->get();
        $eid = $request->event_id;
        $win = $request->winner;
        if($role !== "creator") {
            $route = '/admin-event';
        } else {
            $route = '/creator-event';
        }
        // return var_dump($betSet);
        if(!$odd->isEmpty()){
            // return "data avilable";
            if ($extraOdds->isEmpty()) {
                    $this->setWinnerEvent($eid,$win);
                    return redirect($route)->with("success","Winner selected successfully.");
            }else{
                return redirect($route)->with("error","Please set winner first event odds.");
            }
        }else{
            $this->setWinnerEvent($eid,$win);
             return redirect($route)->with("success","Winner selected successfully.");
        }
    }

    private function setWinnerEvent($eid,$win)
    {
        $event = Event::with('tournament')->where('id', $eid)->first();
        $bets = Bet::where('event_id',$eid)->where('win',0)->where('status',1)->get();
        $betReward = 0;
        if($event ){
            foreach ($bets as $bet) {
                $uid = $bet->user_id;
                $user = User::find($uid);
                if($event->tournament && $event->tournament->bet_percentage > 0) {
                    $betReward = $bet->bet_odds * ($event->tournament->bet_percentage /100);
                }
                if($bet->bet_on == $win){
                    $bet->win = 1;
                    $bet->update();
                    $earn = $bet->odds*$bet->bet_odds;
                    if($earn > 0 || $betReward > 0){
                        $user->mbtc = $user->mbtc + $earn + $betReward;
                        $user->update();
                    }
                }else{
                    if($betReward > 0) {
                        $user->mbtc = $user->mbtc + $betReward;
                        $user->update();
                    }
                    $bet->win = 2;
                    $bet->update();
                }
            }
            $event->winloss = 1;
            $event->winner = $win;
            $event->update();
            $this->createParticipentNextRound($event, $win);
            $this->sendCuratorAmount($event);
        }
    }

    public function sendCuratorAmount($event) {
        $tournament = Tournament::where('id',$event->tournament_id)->first();
        $curatorInfo = DB::table('scores')
            ->select('user_id')
            ->where('event_id', $event->id)
            ->groupBy('user_id')
            ->first();
        if($curatorInfo && $tournament) {
            $user = User::where('id',$curatorInfo->user_id)->first();
            if($user) {
                $user->mbtc = $user->mbtc + $tournament->curator_rewards;
                $user->save();
            }
        }
    }

    public function createParticipentNextRound($event, $winnerNo) {
        $teamId = ($winnerNo == 1) ? $event->team_1_id : (($winnerNo == 3) ? $event->team_2_id : null);
        if($teamId) {
            $winnerTeam = Team::where('id',$teamId)->first();
            if(!empty($winnerTeam) && $winnerTeam->name){
            $winnerUser =  User::where('username',$winnerTeam->name)->first();
            if($winnerUser) {
                $participantData = Participant::where('tournament_id', $event->tournament_id)->where('user_id',$winnerUser->id)->first();
                $participentsInfo = DB::table('participants')
                     ->select('round',DB::raw('count(*) as total'))
                     ->where('tournament_id', $participantData->tournament_id)
                     ->groupBy('round')
                     ->orderBy('total', 'desc')
                     ->first();
                if($participentsInfo->total > 2) {
                    $participant = new Participant;
                    $participant->user_id = $participantData->user_id;
                    $participant->tournament_id = $participantData->tournament_id;
                    $participant->payment_source = $participantData->payment_source;
                    $participant->currency = $participantData->currency;
                    $participant->round = $participantData->round + 1;
                    $participant->amount = $participantData->amount;
                    $participant->save();
                } else {
                    $winnerUser->mbtc = $winnerUser->mbtc + $event->tournament->prizes;
                    $winnerUser->save();
                    Tournament::where('id', $event->tournament_id)->update(["status" => 3]);
                }
            }
        }
        }
    }
    public function oddWinLossUpdate(Request $request)
    {
        $odds = $request->odds;

        if($odds) {
           $betSet = Bet::where('event_id', $request->event_id)->where('team_id','<>',0)->whereIn('team_id',$odds)->update(['win' => 1]);
            foreach ($odds as $odd) {
                $bets = Bet::where('team_id', $odd)->get();
                foreach ($bets as $b) {
                    $user = User::find($b->user_id);
                    $earn = $b->odds*$b->bet_odds;
                    if($earn>0){
                        $user->mbtc = $user->mbtc + $earn;
                        $user->save();
                    }
                }
            }
        }

        $betSet = Bet::where('event_id', $request->event_id)->where('win',0)->where('team_id','<>',0)->update(['win' => 2]);
        return redirect()->back()->with('success','Successfully updated Odds.');
    }

    /*Redirect to admin store Event page*/
    public function store(Request $request)
    {
        $user = Sentinel::getUser();
        $role = $user->roles()->first()->slug;

    	$this->validate($request,[
            'eventname' =>'required',
            'catid' =>'required',
            'team_1' =>'required',
       		'odds_1' =>'required',
       		'team_2' =>'required',
            'odds_2' =>'required',
            'start_date' =>'required',
            'end_date' =>'required',
            'video_url' => 'required',
        ]);

        if($request->live == 'on'){
            $live = 1;
        } else {
            $live = 0;
        }
        if($request->featured == 'on'){
            $featur = 1;
        } else {
            $featur = 0;
        }

    	$event = new Event;
    	$event->event_master_id=$request->eventname;
    	$event->cat_id=$request->catid;
        $event->sub_cat_id=$request->scatid;
        $event->sub_sub_cat_id=$request->sscatid;
        $event->twitch_url=$request->video_url;
        $event->team_1_id=$request->team_1;
        $event->odds=$request->odds_1;
        $event->team_2_id=$request->team_2;
        $event->odds2=$request->odds_2;
        $event->draw=$request->draw;
       // $event->scroll=$request->scroll;
        $event->start_date=$request->start_date;
        $event->end_date=$request->end_date;
        $event->live=$live;
        $event->featured=$featur;
        $event->created_by=Sentinel::getUser()->id;
        $event->is_approve = ($role == "creator") ? 0 : 1;
        $event->is_deleted = 0;
        $event->save();
        if($role == "creator") {
            return redirect('creator-odd-create/'.$event['id'])->with(['success'=>'Event added successfully']);
        } else {
            return redirect('admin-odd-create/'.$event['id'])->with(['success'=>'Event added successfully']);
        }
    }

    /*Redirecting to admin edit Event page*/
    public function edit($id)
    {
        $user = Sentinel::getUser();
        $role = $user->roles()->first()->slug;
        $eventmaster=EventMaster::where('status',0)->get();
        $category=category::where('status',0)->get();
        $subcategory=SubCategory::with('subcat')->where('status','0')->get();
        $subsubcategory=SubSubCategory::with('subsubcat.subcat')->where('status',0)->get();
        $teams=Team::where('status',0)->get();
        $event=Event::with('subcatEvent.subcat','subsubcatEvent','Team1Event')->where('id',$id)->first();
        $eventOdds = EventOddMaster::where('status',0)->get();
        // echo "<pre>";
        // print_r($event);
        // die;
    	return view('admin.event.edit',compact('event','eventmaster','category','subcategory','subsubcategory','teams', 'role', 'eventOdds'));
    }

    /*Redirecting to admin update Event page*/
    public function update(Request $request , $id)
    {
        $user = Sentinel::getUser();
        $role = $user->roles()->first()->slug;
		$this->validate($request,[
            'EventName' =>'required',
            'catid' =>'required',
            'team_1' =>'required',
            'odds_1' =>'required',
            'team_2' =>'required',
            'odds_2' =>'required',
            'draw' =>'required',
            'start_date' =>'required',
            'end_date' =>'required',
            'video_url' => 'required',
        ]);

    	if($request->live == 'on'){
            $live = 1;
        } else {
            $live = 0;
        }
        if($request->featured == 'on'){
            $featured = 1;
        } else {
            $featured = 0;
        }
    	$event = Event::find($id);
        $event->event_master_id=$request->EventName;
        $event->cat_id=$request->catid;
        $event->sub_cat_id=$request->scatid;
        $event->sub_sub_cat_id=$request->sscatid;
        $event->twitch_url=$request->video_url;
        $event->team_1_id=$request->team_1;
        $event->odds=$request->odds_1;
        $event->team_2_id=$request->team_2;
        $event->odds2=$request->odds_2;
        $event->draw=$request->draw;
        $event->scroll=$request->scroll;
        $event->start_date=$request->start_date;
        $event->end_date=$request->end_date;
        $event->live=$live;
        $event->featured=$featured;
        $event->is_deleted = 0;
        $event->save();
        if($role == "creator") {
            return redirect()->route('creator-event.index')->with(['success'=>'Event Updated successfully']);
        } else {
            return redirect()->route('admin-event.index')->with(['success'=>'Event Updated successfully']);
        }
    }

    /*Destroying Event data*/
    public function destroy($id)
    {
    	$team = Event::find($id);
		$team->delete();
		return redirect()->back()->with(['success'=>'Event deleted successfully.' ]);
    }

    /*Change Event status*/
    public function changeEventStatus($event_id,$status)
    {
    	Event::where('id',$event_id)->update(['status'=>$status]);
    	return redirect()->back()->with(['success' => 'Event status updated successfully.']);
    }

    public function changeEventPermission($event_id,$status)
    {
    	Event::where('id',$event_id)->update(['is_approve'=>$status]);
    	return redirect()->back()->with(['success' => 'Event permission updated successfully.']);
    }

    public function checkIn($event_id) {
        $user = Sentinel::getUser();
        $team = Team::where('name',$user->username)->first();
        $event = Event::where('id',$event_id)->first();
        if($team && $event) {
            if($event->team_1_id === $team->id) {
                $event->team_1_check_in = 1;
            }
            if($event->team_2_id === $team->id) {
                $event->team_2_check_in = 1;
            }
            if($event->team_1_check_in === $event->team_2_check_in) {
                $event->live = 1;
                $event->featured = 1;
            }
            $event->save();
        }
        echo "You have successfully checked in for this event";
    }
}
