<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OddMaster;

class AdminOddMasterController extends Controller
{
   	/*Redirect to admin list Event page*/
    public function index()
    {
    	$odd_masters=OddMaster::get();
    	return view('admin.odd-masters.index',compact('odd_masters'));
    }

     /*Redirect to admin create Event page*/
    public function create()
    {
      return view('admin.odd-masters.create');
    }

    public function show($id)
    {
		//return view('admin.blog.create');
    }
    
    /*Redirect to admin store Event page*/
    public function store(Request $request)
    {
    	$this->validate($request,[
            'title' =>'required',
        ]);

    	$odd_master = new  OddMaster;
    	$odd_master->odd_title=$request->title;
    	$odd_master->save();
    	return redirect()->route('admin-odd-master.index')->with(['success'=>'Odd Master added successfully']);
    }

    /*Redirecting to admin edit Event page*/
    public function edit($id)
    {
    	$odd_master=OddMaster::where('id',$id)->first();
    	return view('admin.odd-masters.edit',compact('odd_master'));
    }

    /*Redirecting to admin update Event page*/
    public function update(Request $request , $id)
    {
		$this->validate($request,[
           'title' =>'required',
        ]);

    	$odd_master = OddMaster::find($id);
    	$odd_master->odd_title=$request->title;
    	$odd_master->save();
    	return redirect()->route('admin-odd-master.index')->with(['success'=>'Odd Master Updated successfully']);
    }
    
    /*Destroying Event data*/
    public function destroy($id)
    {
    	$odd_master = OddMaster::find($id);
		$odd_master->delete();
		return redirect()->back()->with(['success'=>'Odd Master deleted successfully.' ]);
    }

    /*Change Event status*/
    public function changeOddMasterStatus($id,$status)
    {
    	OddMaster::where('id',$id)->update(['status'=>$status]);
    	return redirect()->back()->with(['success' => 'Odd Master status updated successfully.']);
    }


    // Add Odd Via ajax
    public function addOddMaster(Request $request){


        $this->validate($request,[
            'oddtitle' =>'required'
        ]);

       

        $odd = new  OddMaster;
        $odd->odd_title=$request->oddtitle;
        $odd->save();
    
        $od ="";
        $od .= '<option value="' . $odd['id'] . '">' . $odd['odd_title'] . '</option>';
        echo $od;
    }
}
