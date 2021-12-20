<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoleUser;
use App\User;
use Activation;
use Sentinel;
use Hash;

class AdminManageController extends Controller
{
    //redirect to admin manage list page
    public function index()
    {
    	$users=RoleUser::with('user')->where('role_id',2)->get();
    	return view('superadmin.admin.index',compact('users'));
    }
    //create new sub admin
    public function create()
    {
    	return view('superadmin.admin.create');
    }
    
    //store new sub admin
    public function store(Request $request)
    {
    	 $this->validate($request,[
            'email'=>'required|email|unique:users,email',
            'firstname'=>'required',
            'lastname'=>'required|max:255',
            'password' =>'required',
			'rpassword' =>'required|same:password',

        ]);

        $user =  Sentinel::register(array(
            'first_name'   => $request->firstname,
            'last_name'    => $request->lastname,
            'email'        => $request->email,
            'password'     => $request->password,

        ));

        $activation = Activation::create($user);
        Activation::where('user_id',$user->id)->update(['completed'=>1,'completed_at'=>date('Y-m-d')]);
        $role = Sentinel::findRoleBySlug('admin');
        $role->users()->attach($user);
        return redirect('sub-admin')->with('success','Sub-admin added successfully.');
    }

    //show 
    public function show($id)
    {

    }

    //Edit sub admin
    public function edit($id)
    {
    	$user=User::where('id',$id)->first();
		return view('superadmin.admin.edit',compact('user'));
    }

    //Update sub admin
    public function update(Request $request,$id)
    {
    	 $this->validate($request,[
            'email'=>'required|email',
            'firstname'=>'required',
            'lastname'=>'required|max:255',
        ]);	
    	 $check=User::where('email',$request->email)->first();

    	$user=User::find($id);
    	 if( !empty($check) && $check->email!=$user->email)
    	 {
    	 	return redirect()->back()->with('error','Email already exist.');
    	 }

    	$user->first_name=$request->firstname;
    	$user->last_name=$request->lastname;
    	$user->email=$request->email;
    	$user->save();
    	return redirect('sub-admin')->with('success','Sub-admin updated successfully.');
    }

    //Updating sub admin status
    public function changeAdminStatus($user_id,$status)
    {
   		 User::where('id',$user_id)->update(['status'=>$status]);
    	return redirect()->back()->with(['success' => 'Sub-Admin status updated successfully.']);
    }

}
