<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventMaster;
use Sentinel;

class EventMasterController extends Controller
{

    /*Redirect to admin list Event page*/
    public function index()
    {
        $events=EventMaster::get();
        return view('admin.eventmaster.index',compact('events'));
    
    }

     /*Redirect to admin create Event page*/
    public function create()
    {
        return view('admin.eventmaster.create');
    }

    public function show($id)
    {
        //return view('admin.blog.create');
    }
    
    /*Redirect to admin store Event page*/
    public function store(Request $request)
    {
        
        $this->validate($request,[
            'name' =>'required'
        ]);

        $event = new  EventMaster;
        $event->event_name=$request->name;
        $event->save();
        return redirect()->route('admin-eventmaster.index')->with(['success'=>'Event Inserted successfully']);
    }
    
    /*Redirecting to admin edit Event page*/
    public function edit($id)
    {
        
        $event=EventMaster::where('id',$id)->first();
        return view('admin.eventmaster.edit',compact('event'));
    }

    /*Redirecting to admin update Event page*/
    public function update(Request $request , $id)
    {
        $this->validate($request,[
            'name' =>'required'
        ]);
        $event = EventMaster::find($id);
        $event->event_name=$request->name;
        $event->save();
        return redirect()->route('admin-eventmaster.index')->with(['success'=>'Event Updated successfully']);
    }
    
    /*Destroying Event data*/
    public function destroy($id)
    {
        $event = EventMaster::find($id);
        $event->delete();
        return redirect()->back()->with(['success'=>'Event deleted successfully.' ]);
    }

    /*Change Event status*/
    public function changeEventStatus($event_id,$status)
    {
        EventMaster::where('id',$event_id)->update(['status'=>$status]);
        return redirect()->back()->with(['success' => 'Event status updated successfully.']);
    }





    // Add Event Master Via ajax
    public function addEventMaster(Request $request){

        $this->validate($request,[
            'EventName' =>'required'

        ]);

        $eventmaster = new  EventMaster;
        $eventmaster->event_name=$request->EventName;
        // $eventmaster->cat_id=$request->CategoryName;
        // $eventmaster->sub_cat_id=$request->SubCategoryName;
        // $eventmaster->sub_sub_cat_id=$request->SubSubCategoryName;
        $eventmaster->save();
    
        $evm ="";
        $evm .= '<option value="' . $eventmaster['id'] . '">' . $eventmaster['event_name'] . '</option>';
        echo $evm;
    }
}
