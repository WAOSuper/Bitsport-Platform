<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
class PromotionController extends Controller
{
    public function getPromotion()
    { 
    	$promotions=Blog::get();
    	return view('frontend.promotions.promotions',compact('promotions'));
    }

    public function getSinglePromotion($id)
    {
    	$promotion=Blog::where('id',$id)->first();
    	return view('frontend.promotions.single_promotions',compact('promotion'));
    }
}
