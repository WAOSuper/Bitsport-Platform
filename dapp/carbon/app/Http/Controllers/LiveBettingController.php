<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LiveBettingController extends Controller
{
    public function index()
    {
    	return view('frontend.live_betting.live-betting');
    }
}
