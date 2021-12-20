<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cms;
class AdminCMSController extends Controller
{
    /*Redirect to admin blog list page*/
    public function index()
    {
    	$cms=Cms::get();
    	return view('admin.cms.index',compact('cms'));	
    }

    /*Redirect to admin create blog page*/
    public function create()
    {
		return view('admin.cms.create');
    }

    public function show($id)
    {
		//return view('admin.blog.create');
    }
    
    /*Redirect to admin store blog page*/
    public function store(Request $request)
    {
    	$this->validate($request,[
            'title' =>'required',
        	'content' =>'required',
       		'slug' =>'required' 
        ]);

    	$cms = new  Cms;
    	$cms->title=$request->title;
    	$cms->slug=$request->slug;
    	$cms->content=$request->content;
    	$cms->save();
    	return redirect()->route('admin-cms.index')->with(['success'=>'CMS  added successfully']);
    }

    /*Redirecting to admin edit blog page*/
    public function edit($id)
    {
    	$cms=Cms::where('id',$id)->first();
    	return view('admin.cms.edit',compact('cms'));
    }

    /*Redirecting to admin update blog page*/
    public function update(Request $request , $id)
    {
		$this->validate($request,[
             'title' =>'required',
        	'content' =>'required',
       		'slug' =>'required' 
       		
        ]);

    	$cms = Cms::find($id);
    	$cms->title=$request->title;
    	$cms->slug=$request->slug;
    	$cms->content=$request->content;
    	$cms->save();
    	return redirect()->route('admin-cms.index')->with(['success'=>'CMS Updated successfully']);
    }

    public function destroy($id)
    {
    	$cms = Cms::find($id);

		$cms->delete();
		return redirect()->back()->with(['success'=>'CMS deleted successfully.' ]);
    }
}
