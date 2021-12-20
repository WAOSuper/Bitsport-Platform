<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Tournament;
use App\Models\Region;
use Sentinel;

class AdminTournamentController extends Controller
{
    public function index()
    {
    	$tournaments=Tournament::with('user')->where('is_deleted', 0)->get();
    	return view('admin.tournament.index',compact('tournaments'));
    }

    /*Redirect to admin create Tournament page*/
    public function create()
    {
        $user = Sentinel::getUser();
        $categoryObject=category::where('status',0);
        $subcategoryObject=SubCategory::where('status',0);
        $subsubcategoryObject=SubSubCategory::where('status',0);
        $category=$categoryObject->get();
        $subcategory=$subcategoryObject->get();
        $subsubcategory=$subsubcategoryObject->get();
        $regions=Region::get();
    	return view('admin.tournament.create',compact('category','subcategory','subsubcategory','regions'));
    }

    public function store(Request $request)
    {
        $user = Sentinel::getUser();

        $this->validate($request,[
            'tournamentname' =>'required',
            'startdatetime' =>'required',
            'enddatetime' =>'required',
            'headerbanner' =>'required',
            'header_banner_thumbnail' =>'required',
            'about' =>'required',
            'stats' =>'required',
            'contactdetails' =>'required',
            'criticalrules' =>'required',
            'rules' =>'required',
            'prizes' => 'required',
            'schedule' => 'required',
            'curatorreward' => 'required',
            'betpercent' => 'required',
            'playerlimit' => 'required',
            'catid' => 'required',
            'platform' => 'required',
            'validators' => 'required',
            'region_id' => 'required',
            'fees' => 'required'
        ]);
        
        $image = $request->file('headerbanner');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/storage/galeryImages/');
        $image->move($destinationPath, $name);

        $imageThumbnail = $request->file('header_banner_thumbnail');
        $thumbnailName = time().'.'.$image->getClientOriginalExtension();
        $thumbnailDestinationPath = public_path('/storage/galeryImages/thumbnail/');
        $imageThumbnail->move($thumbnailDestinationPath, $thumbnailName);
        // Image::make(public_path('/storage/galeryImages/').$name)->resize(320, 240)->insert(public_path('/storage/galeryImages/thumbnail/').$name);

        $tournament = new Tournament;
        $tournament->name            = $request->tournamentname;
        $tournament->start_date_time = $request->startdatetime;
        $tournament->end_date_time   = $request->enddatetime;
        $tournament->header_banner   = $name;
        $tournament->header_banner_thumbnail   = $thumbnailName;
        $tournament->about           = $request->about;
        $tournament->stats           = $request->stats;
        $tournament->contact_details = $request->contactdetails;
        $tournament->critical_rules  = $request->criticalrules;
        $tournament->rules           = $request->rules;
        $tournament->prizes          = $request->prizes;
        $tournament->schedule        = $request->schedule;
        $tournament->curator_rewards = $request->curatorreward;
        $tournament->bet_percentage  = $request->betpercent;
        $tournament->player_limit    = $request->playerlimit;
        $tournament->cat_id          = $request->catid;
        $tournament->sub_cat_id      = $request->scatid;
        $tournament->created_by      = $user->id;
        $tournament->platform        = $request->platform;
        $tournament->validators      = $request->validators;
        $tournament->fees            = $request->fees;
        $tournament->region_id       = $request->region_id;
        $tournament->save();
        return redirect('create-tournament')->with(['success'=>'Tournament added successfully']);
    }

    /*Redirecting to admin edit Tournament page*/
    public function edit($id)
    {
        $user = Sentinel::getUser();
        $tournament = Tournament::where('id',$id)->first();
        $category=category::where('status',0)->get();
        $subcategory=SubCategory::with('subcat')->where('status','0')->get();
        $subsubcategory=SubSubCategory::with('subsubcat.subcat')->where('status',0)->get();
        $regions=Region::get();

        return view('admin.tournament.edit',compact('tournament','category','subcategory','subsubcategory','id','regions'));
    }

    /*Redirecting to admin change Tournament status page*/
    public function changeStatus($id, $status)
    {
        $user = Sentinel::getUser();
        $tournament = Tournament::where('id',$id)->first();
        $tournament->status = $status;
        $tournament->save();

        return redirect('admin-tournament');
    }

    /*Redirecting to admin update Tournament page*/
    public function update(Request $request , $id)
    {
        $this->validate($request,[
            'tournamentname' =>'required',
            'startdatetime' =>'required',
            'enddatetime' =>'required',
            'about' =>'required',
            'stats' =>'required',
            'contactdetails' =>'required',
            'criticalrules' =>'required',
            'rules' =>'required',
            'prizes' => 'required',
            'schedule' => 'required',
            'curatorreward' => 'required',
            'betpercent' => 'required',
            'playerlimit' => 'required',
            'catid' => 'required',
            'platform' => 'required',
            'validators' => 'required',
            'region_id' => 'required',
            'fees' => 'required'
        ]);

        if($request->file('headerbanner'))
        {
            $image = $request->file('headerbanner');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/galeryImages/');
            $image->move($destinationPath, $name);
        }

        if($request->file('header_banner_thumbnail'))
        {
            $imageThumbnail = $request->file('header_banner_thumbnail');
            $thumbnailName = time().'.'.$image->getClientOriginalExtension();
            $thumbnailDestinationPath = public_path('/storage/galeryImages/thumbnail/');
            $imageThumbnail->move($thumbnailDestinationPath, $thumbnailName);
        }

        $tournament = Tournament::find($id);
        $tournament->name            = $request->tournamentname;
        $tournament->start_date_time = $request->startdatetime;
        $tournament->end_date_time   = $request->enddatetime;
        if($request->file('headerbanner'))
        {
            $tournament->header_banner   = $name;
        }
        if($request->file('header_banner_thumbnail'))
        {
            $tournament->header_banner_thumbnail   = $thumbnailName;
        }
        $tournament->about           = $request->about;
        $tournament->stats           = $request->stats;
        $tournament->contact_details = $request->contactdetails;
        $tournament->critical_rules  = $request->criticalrules;
        $tournament->rules           = $request->rules;
        $tournament->prizes          = $request->prizes;
        $tournament->schedule        = $request->schedule;
        $tournament->curator_rewards = $request->curatorreward;
        $tournament->bet_percentage  = $request->betpercent;
        $tournament->player_limit    = $request->playerlimit;
        $tournament->cat_id          = $request->catid;
        $tournament->sub_cat_id      = $request->scatid;
        $tournament->platform        = $request->platform;
        $tournament->validators      = $request->validators;
        $tournament->fees            = $request->fees;
        $tournament->region_id       = $request->region_id;
        $tournament->save();

        return redirect()->route('admin-tournament.edit',$id)->with(['success'=>'Tournament Updated successfully']);
    }
}
