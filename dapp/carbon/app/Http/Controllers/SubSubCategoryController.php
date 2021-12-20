<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;


class SubSubCategoryController extends Controller
{
     /*Redirect to admin sub sub category page*/
    public function index()
    {
        $subsubcategory=SubSubCategory::with('subsubcat')->get();
        return view('admin.sub_sub_category.index',compact('subsubcategory'));    
    }


     /*Redirect to admin create sub sub category page*/
    public function create()
    {
    	$category=Category::where('status','0')->get();
        $subcategory=SubCategory::where('status','0')->get();
        return view('admin.sub_sub_category.create',compact('category','subcategory'));    
    }


 /*Redirect to admin store sub subcategory page*/
    public function store(Request $request)
    {
        $this->validate($request,[
            'catid' =>'required',
            'scatid' =>'required',
            'slug' =>'required',
            'name' =>'required'
        ]);

        $subsubcategory = new  SubSubCategory;
        $subsubcategory->parent_id=$request->scatid;
        $subsubcategory->name=$request->name; 
        $subsubcategory->slug=$request->slug;
        $subsubcategory->save();
        return redirect()->route('admin-subsubcategory.index')->with(['success'=>'Sub Sub Category added successfully']);
    }

    /*Redirecting to admin edit sub  sub category page*/
    public function edit($id)
    {
    	$category=Category::where('status','0')->get();
        $subcategory=SubCategory::with('subcat')->where('status','0')->get();
        $subsubcategory=SubSubCategory::with('subsubcat.subcat')->where('id',$id)->first();
        return view('admin.sub_sub_category.edit',compact('category','subcategory','subsubcategory'));
    }



    /*Redirecting to admin update sub category page*/
    public function update(Request $request , $id)
    {
        $this->validate($request,[
            'catid' =>'required',
            'scatid' =>'required',
            'name' =>'required',
            'slug' =>'required'
        ]);

        $subsubcategory = SubSubCategory::find($id);
        $subsubcategory->parent_id=$request->scatid;
        $subsubcategory->name=$request->name;
         $subsubcategory->slug=$request->slug;
        $subsubcategory->save();
        return redirect()->route('admin-subsubcategory.index')->with(['success'=>'Sub Category Updated successfully']);
    }

    /*Destroying  sub sub Category data*/
    public function destroy($id)
    {
        $scat = SubSubCategory::find($id);
        $scat->delete();
        return redirect()->back()->with(['success'=>'SubCategory deleted successfully.' ]);
    }

     public function getFromCategory(Request $request)
    {
        $cat_id = $request->category;
        $returnArr = array();
        $returnArr['status'] = 1;
        $returnArr['html'] = '<option value="">Select SubCategory</option>';
         if ($request->category) {
       $returnArr['status'] = 0;
       $subcatList = SubCategory::where(['status' => 0, 'parent_id' => $request->category])->orderBy('id', 'name')->get();
         }
         if ($subcatList->isEmpty()) {
                $returnArr['html'] = '<option value="">Subcategory not found!</option>';
            } else {
                $html = '<option value="">Select Subcategory</option>';
                foreach ($subcatList as $key => $val) {
                    $html .= '<option value="' . $val['id'] . '">' . $val['name'] . '</option>';
                }
                $returnArr['html'] = $html;
            }
        echo json_encode($returnArr);
    }


    public function activestatus($id) {

        $subsubcategory = SubSubCategory::find($id);
        $subsubcategory->status = '0';
        $subsubcategory->save();

        return redirect()->route('admin-subsubcategory.index')->with('success', 'Sub Sub Category Active');
    }

    public function deactivestatus($id) {

        $subsubcategory = SubSubCategory::find($id);
        $subsubcategory->status = '1';
        $subsubcategory->save();

        return redirect()->route('admin-subsubcategory.index')->with('success', 'Sub Sub Category Deactivate');
    }

    public function getSubSubcategoryFromSubCategory(Request $request)
    {
        
        $html = '';
         if ($request->subcategory) {
               $returnArr['status'] = 0;
               $subcatList = SubSubCategory::where(['status' => 0, 'parent_id' => $request->subcategory])->orderBy('id', 'name')->get();
         }
         if ($subcatList->isEmpty()) {
                $html .=  '<option value="">SubSubcategory not found!</option>';
            } else {
                $html .= '<option value="0">Select SubSubcategory</option>';
                foreach ($subcatList as $key => $val) {
                    $html .= '<option value="' . $val['id'] . '">' . $val['name'] . '</option>';
                }
            }
        echo $html;
    }

    // Add Sub Sub Category Via ajax
    public function addSubSubCategory(Request $request){

        $this->validate($request,[
            'CategoryName' =>'required',
            'SubCategoryName' =>'required',
            'SubSubCategoryName' =>'required',
            'slug' =>'required'

        ]);

        $subsubcategory = new  SubSubCategory;
        $subsubcategory->parent_id=$request->SubCategoryName;
        $subsubcategory->name=$request->SubSubCategoryName;
        $subsubcategory->slug=$request->slug;
        $subsubcategory->save();
    
        $sscat ="";
        $sscat .= '<option value="' . $subsubcategory['id'] . '">' . $subsubcategory['name'] . '</option>';
        echo $sscat;
    }
}
