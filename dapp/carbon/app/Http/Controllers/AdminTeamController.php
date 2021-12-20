<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Sentinel;

class AdminTeamController extends Controller
{
    /*Redirect to admin list Team page*/
    public function index()
    {
    	$teams=Team::with('user','category','subcategory','subsubcategory')->where('is_deleted', 0)->get();
    	return view('admin.team.index',compact('teams'));
    }

     /*Redirect to admin create Team page*/
    public function create()
    {
    	$categories=Category::where('status',0)->get();    	
    	return view('admin.team.create',compact('categories'));
    }

    public function show($id)
    {
		//return view('admin.blog.create');
    }
    
    /*Redirect to admin store Team page*/
    public function store(Request $request)
    {
    	$this->validate($request,[
            'name' =>'required',
        	// 'category' =>'required'
        ]);

    	$team = new  Team;
    	$team->name=$request->name;
        $team->created_by=Sentinel::getUser()->id;
    	$team->save();
    	return redirect()->route('admin-team.index')->with(['success'=>'Team added successfully']);
    }

    /*Redirecting to admin edit Team page*/
    public function edit($id)
    {
    	// $categories=Category::where('status',0)->get();
    	$team=Team::where('id',$id)->first();
    	// $subcategories=SubCategory::where('parent_id',$team->cate_id)->where('status',0)->get();
    	// $subsubcategories=SubSubCategory::where('parent_id',$team->sub_cate)->where('status',0)->get();
    	return view('admin.team.edit',compact('team'));
    }

    /*Redirecting to admin update Team page*/
    public function update(Request $request , $id)
    {
		$this->validate($request,[
            'name' =>'required',
        	// 'category' =>'required',
         //    'sub_category' =>'required',
       		// 'sub_sub_category' =>'required' 
        ]);

    	$team = Team::find($id);
    	$team->name=$request->name;
    	// $team->cate_id=$request->category;
     //    $team->sub_cate=$request->sub_category;
     //    $team->sub_sub_cate=$request->sub_sub_category;
    	$team->save();
    	return redirect()->route('admin-team.index')->with(['success'=>'Team updated successfully']);
    }
    
    /*Destroying Team data*/
    public function destroy($id)
    {
    	$team = Team::find($id);
		$team->is_deleted = 1;
        $team->save();
		return redirect()->back()->with(['success'=>'Team deleted successfully.' ]);
    }

    /*Change team status*/
    public function changeTeamStatus($team_id,$status)
    {
    	Team::where('id',$team_id)->update(['status'=>$status]);
    	return redirect()->back()->with(['success' => 'Team status updated successfully.']);
    }

    // Get Team from category id
    public function getTeamCat(Request $request){
        $returnArr = array();
        $returnArr['status'] = 1;
        $returnArr['html'] = '<option value="">Select Team</option>';
         if ($request->category) {
       $returnArr['status'] = 0;
       $teamList = Team::where(['status' => 0, 'cate_id' => $request->category])->orderBy('id', 'name')->get();
         }
         if ($teamList->isEmpty()) {
                $returnArr['html'] = '<option value="">Team not found!</option>';
            } else {
                $html = '<option value="0">Select Team</option>';
                foreach ($teamList as $key => $val) {
                    $html .= '<option value="' . $val['id'] . '">' . $val['name'] . '</option>';
                }
                $returnArr['html'] = $html;
            }
        echo json_encode($returnArr);
    }

    // Get Team from Sub category id
    public function getTeamSubCat(Request $request){
        $returnArr = array();
        $returnArr['status'] = 1;
        $returnArr['html'] = '<option value="0">Select Team</option>';
         if ($request->subcategory) {
       $returnArr['status'] = 0;
       $Listsubcat = Team::where(['status' => 0,'cate_id' => $request->category, 'sub_cate' => $request->subcategory])->orderBy('id', 'name')->get();
         }
         if ($Listsubcat->isEmpty()) {
                $returnArr['html'] = '<option value="">Team not found!</option>';
            } else {
                $html = '<option value="0">Select Team</option>';
                foreach ($Listsubcat as $key => $val) {
                    $html .= '<option value="' . $val['id'] . '">' . $val['name'] . '</option>';
                }
                $returnArr['html'] = $html;
            }
        echo json_encode($returnArr);
    }

    // Get Team from Sub category id
    public function getTeamSubSubCat(Request $request){
        $returnArr = array();
        $returnArr['status'] = 1;
        $returnArr['html'] = '<option value="">Select Team</option>';
         if ($request->subsubcategory) {
       $returnArr['status'] = 0;
       $Listsubsubcat = Team::where(['status' => 0, 'cate_id' => $request->category, 'sub_cate' => $request->subcategory,'sub_sub_cate' => $request->subsubcategory])->orderBy('id', 'name')->get();
         }
         if ($Listsubsubcat->isEmpty()) {
                $returnArr['html'] = '<option value="">Team not found!</option>';
            } else {
                $html = '<option value="0">Select Team</option>';
                foreach ($Listsubsubcat as $key => $val) {
                    $html .= '<option value="' . $val['id'] . '">' . $val['name'] . '</option>';
                }
                $returnArr['html'] = $html;
            }
        echo json_encode($returnArr);
    }

    //  Team Member is not equal
    public function getTeamMember(Request $request){
        $returnArr = array();
        $returnArr['status'] = 1;
        $returnArr['html'] = '<option value="0">Select Team</option>';
            if ($request->team1 ) {
            $returnArr['status'] = 0;
                // if($request->category != "" && $request->subcategory == "0" && $request->subsubcategory == "0"){
                //    $team = Team::where(['status' => 0, 'cate_id' => $request->category])->orderBy('id', 'name')->get();    
                // }
                // else if($request->category != "" && $request->subcategory != "" && $request->subsubcategory == "0"){
                //    $team = Team::where(['status' => 0, 'cate_id' => $request->category, 'sub_cate' => $request->subcategory])->orderBy('id', 'name')->get();    
                // }else{
                //     $team = Team::where(['status' => 0, 'cate_id' => $request->category, 'sub_cate' => $request->subcategory,'sub_sub_cate' => $request->subsubcategory])->orderBy('id', 'name')->get();
                // }
                $user = Sentinel::getUser();
                $role = $user->roles()->first()->slug;
                $teamObject = Team::where(['status' => 0])->orderBy('id', 'name');
                if($role == "creator") {
                    $teamObject->where('created_by', $user->id);
                }
                $team = $teamObject->get();
            }
            if ($team->isEmpty()) {
                $returnArr['html'] = '<option value="">Team not found!</option>';
            } else {
                $html = '<option value="0">Select Team</option>';
                foreach ($team as $key => $val) {
                    if($val['id'] != $request->team1) {
                    $html .= '<option value="' . $val['id'] . '">' . $val['name'] . '</option>';
                   }
                }
                $returnArr['html'] = $html;
            }
        echo json_encode($returnArr);
    }
    


    // Add Team Via ajax
    public function addTeam(Request $request){

        $this->validate($request,[
            'TeamName' =>'required'
        ]);

        $team = new  Team;
        $team->name=$request->TeamName;
        $team->created_by=Sentinel::getUser()->id;
        $team->save();
    
        $tm ="";
        $tm .= '<option value="' . $team['id'] . '">' . $team['name'] . '</option>';
        echo $tm;
    }
}
