<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GetCoin;
class AdminCoinsController extends Controller
{
	/*Redirect to admin blog list page*/
    public function index()
    {
    	$coins=GetCoin::get();
    	return view('admin.coins.index',compact('coins'));	
    }

    /*Redirect to admin create blog page*/
    public function create()
    {
		return view('admin.coins.create');
    }

    public function show($id)
    {
		//return view('admin.blog.create');
    }
    
    /*Redirect to admin store blog page*/
    public function store(Request $request)
    {
    	$this->validate($request,[
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'title' =>'required',
        	'fees' =>'required',
            'delivery' =>'required',
       		'limits' =>'required', 
            'link' =>'required'

        ]);


    	$coins = new  GetCoin;
    	$coins->title=$request->title;
    	$coins->fees=$request->fees;
        $coins->delivery=$request->delivery;
        $coins->limits=$request->limits;
        $coins->link=$request->link;

    	 if ($request->hasFile('image')) {
       	    $files = $request->image ;
            $destinationPath = 'assets/images/coins';
            $filename1 = rand('1000','99999') . '_' . time() . $files->getClientOriginalName();
            $filename1=urlencode($filename1);
            $files->move(public_path($destinationPath), $filename1);
            $coins->image=$filename1;
        }
    	$coins->save();
    	return redirect()->route('admin-coins.index')->with(['success'=>'Added successfully']);
    }

    /*Redirecting to admin edit blog page*/
    public function edit($id)
    {
    	$coins=GetCoin::where('id',$id)->first();
    	return view('admin.coins.edit',compact('coins'));
    }

    /*Redirecting to admin update blog page*/
    public function update(Request $request , $id)
    {
		$this->validate($request,[
              'image' => 'required|image|mimes:jpeg,png,jpg',
            'title' =>'required',
            'fees' =>'required',
            'delivery' =>'required',
            'limits' =>'required', 
            'link' =>'required'
       		
        ]);

    	$coins = GetCoin::find($id);
        $coins->title=$request->title;
        $coins->fees=$request->fees;
        $coins->delivery=$request->delivery;
        $coins->limits=$request->limits;
        $coins->link=$request->links;

    	 if ($request->hasFile('image')) {
    	 	$destinationPath = 'assets/images/coins';
    	 	// If the user file already exists, delete it

			// Update  New file with old one
       	    $files = $request->image ;
          	$filename = rand('1000','99999') . '_' . time() . $files->getClientOriginalName();
            $filename1=urlencode($filename);
            $files->move(public_path($destinationPath), $filename1);
            $coins->image=$filename1;
        }
    	$coins->save();
    	return redirect()->route('admin-coins.index')->with(['success'=>'Updated successfully']);
    }

    public function destroy($id)
    {
    	$blog = GetCoin::find($id);

		$blog->delete();
		return redirect()->back()->with(['success'=>'Deleted successfully.' ]);
    }
}
