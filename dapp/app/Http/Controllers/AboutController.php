<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cms;
class AboutController extends Controller
{
    public function getAbout($slug)
    {
    	$menus=Cms::get();
    	$about=Cms::where('slug',$slug)->first();
    	return view('frontend.about.about',compact('about','menus'));
    }
}
