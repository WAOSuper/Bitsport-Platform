<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class SponserController extends Controller
{
    public function dashboard()
    {
       
		echo"success"; die;
		return redirect('profile');
        return view('user.dashboard');
    }
}
