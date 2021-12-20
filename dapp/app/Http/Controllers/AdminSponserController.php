<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sponser;
class AdminSponserController extends Controller
{
    /*Redirect to admin category page*/  
    public function index()
    {
        $sponser=Sponser::get();
        return view('admin.sponser.index',compact('sponser'));    
    }
 
    /*Redirect to admin create category page*/
    public function create()
    {
        return view('admin.sponser.create');
    }

    public function show($id)
    {
        //return view('admin.category.create'); 
    }
    
    /*Redirect to admin store category page*/
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' =>'required',
            'link' =>'required',
        ]);

        $sponser = new  Sponser;
        $sponser->name=$request->name;
        $sponser->link=$request->link;
        $sponser->save();
        return redirect()->route('admin-sponser.index')->with(['success'=>'Sponser added successfully']);
    }

    /*Redirecting to admin edit category page*/
    public function edit($id)
    {
        $sponser=Sponser::where('id',$id)->first();
        return view('admin.sponser.edit',compact('sponser'));
    }

    /*Redirecting to admin update category page*/
    public function update(Request $request , $id)
    {

         $this->validate($request,[
            'name' =>'required',
            'link' =>'required',
        ]);

        $sponser = Sponser::find($id);
        $sponser->name=$request->name;
        $sponser->link=$request->link;
        $sponser->save();
        return redirect()->route('admin-sponser.index')->with(['success'=>'Sponser Updated successfully']);
    }

    /*Destroying Category data*/
    public function destroy($id)
    {
        $cat = Sponser::find($id);
        $cat->delete();
        return redirect()->back()->with(['success'=>'Sponser deleted successfully.' ]);
    }
    
	  
    public function activestatus($id) {

        $sponser = Sponser::find($id);
        $sponser->status = '0';
        $sponser->save();
        return redirect()->route('admin-sponser.index')->with('success', 'Sponser Active');
    }

    public function deactivestatus($id) {

        $sponser = Sponser::find($id);
        $sponser->status = '1';
        $sponser->save();
        return redirect()->route('admin-sponser.index')->with('success', 'Sponser Deactivate');
    }


    // Add Category Via ajax

    public function addSponser(Request $request){

        $this->validate($request,[
            'cname' =>'required',
            'link' =>'required',
         ]);

        $sponser = new  Sponser;
        $sponser->name=$request->cname;
        $sponser->link=$request->link;
        $sponser->save();
    
        $cat ="";
        $cat .= '<option value="' . $sponser['id'] . '">' . $sponser['name'] . '</option>';
        echo $cat;
    }   
}
