<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
class AdminBlogController extends Controller
{
	/*Redirect to admin blog list page*/
    public function index()
    {
    	$blogs=Blog::get();
    	return view('admin.blog.index',compact('blogs'));	
    }

    /*Redirect to admin create blog page*/
    public function create()
    {
		return view('admin.blog.create');
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
        	'description' =>'required',
            'long_description' =>'required',
       		'blog_img' =>'required' 
        ]);

    	$blog = new  Blog;
    	$blog->title=$request->title;
    	$blog->description=$request->description;
        $blog->long_description=$request->long_description;

    	 if ($request->hasFile('blog_img')) {
       	    $files = $request->blog_img ;
            $destinationPath = 'assets/images/blog';
            $filename1 = rand('1000','99999') . '_' . time() . $files->getClientOriginalName();
            $filename1=urlencode($filename1);
            $files->move(public_path($destinationPath), $filename1);
            $blog->image=$filename1;
        }
    	$blog->save();
    	return redirect()->route('admin-blog.index')->with(['success'=>'Blog added successfully']);
    }

    /*Redirecting to admin edit blog page*/
    public function edit($id)
    {
    	$blog=Blog::where('id',$id)->first();
    	return view('admin.blog.edit',compact('blog'));
    }

    /*Redirecting to admin update blog page*/
    public function update(Request $request , $id)
    {
		$this->validate($request,[
            'title' =>'required',
        	'description' =>'required',
              'long_description' =>'required',
       		
        ]);

    	$blog = Blog::find($id);
    	$blog->title=$request->title;
    	$blog->description=$request->description;
        $blog->long_description=$request->long_description;

    	 if ($request->hasFile('blog_img')) {
    	 	$destinationPath = 'assets/images/blog';
    	 	// If the user file already exists, delete it
    	 	if($request->old_blog_img){
    	 		if (file_exists(public_path($destinationPath)."/".$request->old_blog_img)) unlink(public_path($destinationPath)."/".$request->old_blog_img);
    	 	}

			// Update  New file with old one 
       	    $files = $request->blog_img ;
          	$filename1 = rand('1000','99999') . '_' . time() . $files->getClientOriginalName();
            $filename1=urlencode($filename1);
            $files->move(public_path($destinationPath), $filename1);
            $blog->image=$filename1;
        }
    	$blog->save();
    	return redirect()->route('admin-blog.index')->with(['success'=>'Blog Updated successfully']);
    }
/*Destroying data*/
    public function destroy($id)
    {
    	$blog = Blog::find($id);
		$blog->delete();
		return redirect()->back()->with(['success'=>'Blog deleted successfully.' ]);
    }
}
