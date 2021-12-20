<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;


class SubCategoryController extends Controller
{
   
    /*Redirect to admin category page*/
    public function index()
    {
        $subcategory=SubCategory::with('subcat')->get();
        return view('admin.subcategory.index',compact('subcategory'));    
    }


    /*Redirect to admin create subcategory page*/
    public function create()
    {
        $category=Category::where('status','0')->get();
        return view('admin.subcategory.create',compact('category'));    
    }

    /*Redirect to admin store subcategory page*/
    public function store(Request $request)
    {
        $this->validate($request,[
            'catid' =>'required',
            'name' =>'required',
            'slug' =>'required'
        ]);

        $subcategory = new  SubCategory;
        $subcategory->parent_id=$request->catid;
        $subcategory->name=$request->name;
         $subcategory->slug=$request->slug;
        $subcategory->save();
        return redirect()->route('admin-subcategory.index')->with(['success'=>'Sub Category added successfully']);
    }

    /*Redirecting to admin edit sub  category page*/
    public function edit($id)
    {
    	$category=Category::where('status','0')->get();
        $subcategory=SubCategory::where('id',$id)->first();
        return view('admin.subcategory.edit',compact('category','subcategory'));
    }

    /*Redirecting to admin update sub category page*/
    public function update(Request $request , $id)
    {
        $this->validate($request,[
            'catid' =>'required',
            'slug' =>'required',
            'name' =>'required'
        ]);

        $subcategory = SubCategory::find($id);
        $subcategory->parent_id=$request->catid;
        $subcategory->name=$request->name;
        $subcategory->slug=$request->slug;
        $subcategory->save();
        return redirect()->route('admin-subcategory.index')->with(['success'=>'Sub Category Updated successfully']);
    }


     public function activestatus($id) {

        $subcategory = SubCategory::find($id);
        $subcategory->status = '0';
        $subcategory->save();
        return redirect()->route('admin-subcategory.index')->with('success', 'Sub Category Active');
    }

    public function deactivestatus($id) {

        $subcategory = SubCategory::find($id);
        $subcategory->status = '1';
        $subcategory->save();

        return redirect()->route('admin-subcategory.index')->with('success', 'Sub Category Deactivate');
    }

    /*Destroying sub Category data*/
    public function destroy($id)
    {
        $scat = SubCategory::find($id);
        $scat->delete();
        return redirect()->back()->with(['success'=>'SubCategory deleted successfully.' ]);
    }

    public function getSubcategoryFromCategory(Request $request)
    {
       
        $cat_id = $request->category;     
        $html = '';
        if ($request->category) {
               $returnArr['status'] = 0;
               $subcatList = SubCategory::where(['status' => 0, 'parent_id' => $request->category])->orderBy('id', 'name')->get();
         }
         if ($subcatList->isEmpty()) {
                $html .=  '<option value="">Subcategory not found!</option>';
            } else {
                $html .= '<option value="0">Select SubCategory</option>';
                foreach ($subcatList as $key => $val) {
                    $html .= '<option value="' . $val['id'] . '" >' . $val['name'] . '</option>';
                }
               
            }
        echo $html;
    }

    // Add Sub Category Via ajax
    public function addSubCategory(Request $request){

         $this->validate($request,[
             'CategoryName' =>'required',
             'SubCategoryName' =>'required',
             'slug' =>'required'

         ]);

        $subcategory = new  SubCategory;
        $subcategory->parent_id=$request->CategoryName;
        $subcategory->name=$request->SubCategoryName;
        $subcategory->slug=$request->slug;
        $subcategory->save();
    
        $scat ="";
        $scat .= '<option value="' . $subcategory['id'] . '">' . $subcategory['name'] . '</option>';
        echo $scat;
    }

}
