<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Odd;
use App\Models\OddMaster;
use App\Models\Event;
use App\Models\Team;
use Sentinel;

class AdminOddController extends Controller
{
    	/*Redirect to admin list Event page*/
    public function index()
    {
      return	$odds=Odd::get();
    	return view('admin.odds.index',compact('odds'));
    }
    
    public function create($id)
    {
    	$odd_masters=OddMaster::where('status',0)->get();
    	$event=Event::with('Master')->where('id',$id)->first();
      $teams=Team::where('id',$event->team_1_id)->orWhere('id',$event->team_2_id)->get();
      return view('admin.odds.create',compact('odd_masters','event', 'teams'));
    }

    public function show($id)
    {
		//return view('admin.blog.create');
    }

    /*Redirect to admin store Event page*/
    public function store(Request $request)
    {
      $user = Sentinel::getUser();
      $role = $user->roles()->first()->slug;
    	$this->validate($request,[
            'event_id' =>'required',
        ]);

    	  $odd = $request->odd;
        foreach ($odd as $key => $value) {
          $odd = new Odd;
          $odd->event_id = $request->event_id;
          $odd->team_id = $value['team'];
          $odd->odd_id = $value['odd_master'];
          $odd->name = $value['title'];
          $odd->odd = $value['odd_val'];
          $odd->save();
      }
      if($role == "creator") {
        $route = "creator-event.index";
      } else {
        $route = "admin-event.index";
      }
    	return redirect()->route($route)->with(['success'=>'Odds added successfully']);
    }

    /*Redirecting to admin edit Event page*/
    public function edit($id)
    {
      $user = Sentinel::getUser();
      $role = $user->roles()->first()->slug;
    	$odd_masters=OddMaster::where('status',0)->get();
    	$odds=Odd::where('event_id',$id)->where('status',0)->get();
      $event=Event::with('Master')->where('id',$id)->first();
    	$teams=Team::where('id',$event->team_1_id)->orWhere('id',$event->team_2_id)->get();
    	return view('admin.odds.edit',compact('odds','event','odd_masters', 'teams', 'role'));
    }

    /*Redirecting to admin update Event page*/
    public function update(Request $request , $id)
    {
        $user = Sentinel::getUser();
        $role = $user->roles()->first()->slug;
    	  $old_odds = Odd::where('event_id',$id)->where('status',0)->get();
        $new_odd = $request->odd;

          foreach ($new_odd as $nw_od) {
              if (array_key_exists("odd_id",$nw_od))
              {
                  $odd = Odd::find($nw_od['odd_id']);
                  $odd->event_id = $id;
                  $odd->team_id = $nw_od['team'];
                  $odd->odd_id = $nw_od['odd_master'];
                  $odd->name = $nw_od['title'];
                  $odd->odd = $nw_od['odd_val'];
                  $odd->update();
              }else{
                  $odd = new Odd;
                  $odd->event_id = $id;
                  $odd->team_id = $nw_od['team'];
                  $odd->odd_id = $nw_od['odd_master'];
                  $odd->name = $nw_od['title'];
                  $odd->odd = $nw_od['odd_val'];
                  $odd->save();
              }
            }
          if($role == "creator") {
            $route = 'creator-event.index';
          } else {
            $route = 'admin-event.index';
          }
          return redirect()->route($route)->with(['success'=>'Odds updated successfully']);
          
    }
    public function remove(Request $request)
    {
      Odd::where('id',$request->odd_id)->where('status',0)->delete();
      return 1;
    }
    
    /*Destroying Event data*/
    public function destroy($id)
    {
    	$odd_master = OddMaster::find($id);
  		$odd_master->delete();
  		return redirect()->back()->with(['success'=>'Odd Master deleted successfully.' ]);
    }

    /*Change Event status*/
    public function changeOddStatus($id,$status)
    {
    	Odd::where('id',$id)->update(['status'=>$status]);
    	return redirect()->back()->with(['success' => 'Odd Master status updated successfully.']);
    }
}
