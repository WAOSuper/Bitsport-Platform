<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EventOddMaster;
use Sentinel;

class AdminEventOddMasterController extends Controller
{
    	/*Redirect to admin event odds list */
    public function index()
    {
      $eventOdds=EventOddMaster::get();
    	return view('admin.event-odd-master.index',compact('eventOdds'));
    }

    public function create()
    {
      return view('admin.event-odd-master.create');
    }

    /*Redirect to admin store Event odd page*/
    public function store(Request $request)
    {
    	$this->validate($request,[
            'title' =>'required',
      ]);

      $odd = new EventOddMaster;
      $odd->title = $request->title;
      $odd->save();
    	return redirect()->route('admin-event-odd-master.index')->with(['success'=>'Event Odds added successfully']);
    }

    /*Redirecting to admin edit Event Odd page*/
    public function edit($id)
    {
      $event_odd_master=EventOddMaster::where('id',$id)->first();
      return view('admin.event-odd-master.edit',compact('event_odd_master'));
    }

    /*Redirecting to admin update Event odd page*/
    public function update(Request $request , $id)
    {
    	$this->validate($request,[
        'title' =>'required',
      ]);
      $odd = EventOddMaster::where('id',$id)->first();
      $odd->title = $request->title;
      $odd->save();
      return redirect()->route('admin-event-odd-master.index')->with(['success'=>'Odds updated successfully']);
    }

    public function remove(Request $request)
    {
      EventOddMaster::where('id',$request->id)->delete();
      return 1;
    }

    /*Destroying Event odd data*/
    public function destroy($id)
    {
    	$event_odd_master = EventOddMaster::find($id);
  		$event_odd_master->delete();
  		return redirect()->back()->with(['success'=>'Odd Master deleted successfully.' ]);
    }

    /*Change Event Odd status*/
    public function changeOddStatus($id,$status)
    {
    	EventOddMaster::where('id',$id)->update(['status'=>$status]);
    	return redirect()->back()->with(['success' => 'Event Odd Master status updated successfully.']);
    }
}
