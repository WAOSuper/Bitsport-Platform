<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bet;
use App\Models\Odd;
use App\Models\Event;
use App\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function dashboard()
    {
        $bets = array();
        $bets = Bet::get();        
        $bets_count=  count($bets);   
                // Count Total Bets
                // New Users Registration in 24 hours before 
        $user = array();
        $user =User::get();
        $created_at = date('Y-m-d H:i:s', strtotime($user[0]['created_at'] . " -24 hours"));    
        $new_user_list = User::whereNotIn('id', array(1, 2))->where('created_at', '>', $created_at)->get();        
        $users_count = count($new_user_list);

        return view('admin.dashboard', compact('bets_count', 'users_count'));
    }
    public function wallet()
    {
        return view('admin.wallet');
    }
     public function referral()
    {
        return view('admin.referral');
    }
    
    // Demo Betting Forms

    public function category()
    {
        return view('admin.form.category');
    }
    public function subcategory()
    {
        return view('admin.form.subcategory');
    }
    public function team()
    {
        return view('admin.form.team');
    }
    public function event()
    {
        return view('admin.form.event');
    }
}
