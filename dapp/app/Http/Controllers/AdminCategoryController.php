<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
class AdminCategoryController extends Controller
{
    /*Redirect to admin category page*/
    public function index()
    {
        $category=Category::get();
        return view('admin.category.index',compact('category'));    
    }

    /*Redirect to admin create category page*/
    public function create()
    {
        return view('admin.category.create'); 
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
            'slug' =>'required',
            'icon'=>'required'
        ]);

        $category = new  Category;
        $category->name=$request->name;
        $category->slug=$request->slug;
        $category->icon=$request->icon;
        $category->save();
        return redirect()->route('admin-category.index')->with(['success'=>'Category added successfully']);
    }

    /*Redirecting to admin edit category page*/
    public function edit($id)
    {
        $category=Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    /*Redirecting to admin update category page*/
    public function update(Request $request , $id)
    {

         $this->validate($request,[
            'name' =>'required',
            'slug' =>'required',
            'icon'=>'required'
        ]);

        $category = category::find($id);
        $category->name=$request->name;
        $category->slug=$request->slug;
        $category->icon=$request->icon;
        $category->image=$request->image;
        $category->save();
        return redirect()->route('admin-category.index')->with(['success'=>'Category Updated successfully']);
    }

    /*Destroying Category data*/
    public function destroy($id)
    {
        $cat = Category::find($id);
        $cat->delete();
        return redirect()->back()->with(['success'=>'Category deleted successfully.' ]);
    }
    
    public function activestatus($id) {

        $category = Category::find($id);
        $category->status = '0';
        $category->save();
        return redirect()->route('admin-category.index')->with('success', 'Category Active');
    }

    public function deactivestatus($id) {

        $category = Category::find($id);
        $category->status = '1';
        $category->save();
        return redirect()->route('admin-category.index')->with('success', 'Category Deactivate');
    }



    // Add Category Via ajax

    public function addCategory(Request $request){

        $this->validate($request,[
            'cname' =>'required',
            'slug' =>'required',
            'icon' =>'required'
        ]);

        $category = new  Category;
        $category->name=$request->cname;
        $category->slug=$request->slug;
        $category->icon=$request->icon;
        $category->image=$request->image;
        $category->save();
    
        $cat ="";
        $cat .= '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
        echo $cat;
    }

    

   
}
