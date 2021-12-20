<?php

namespace App\Http\Controllers;

use TwitchApi;
use App\Http\Controllers\Controller;

class ClipsController extends Controller
{
    public function getClip()
    {
		// https://clips.twitch.tv/AgreeableOutstandingChickenStinkyCheese
		$slug = "AgreeableOutstandingChickenStinkyCheese";
		$vid= TwitchApi::clip($slug);
		 return view('frontend.api_data.video',compact('vid'));
    }
}