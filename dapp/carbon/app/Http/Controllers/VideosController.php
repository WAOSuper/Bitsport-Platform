<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use TwitchApi;

class VideosController extends Controller
{
     public function topList()
    {
        $options = [
            'limit' => 10,
        ]; 
        $videos= TwitchApi::topVideos($options);
      return   $vid=$videos['vods'];
        return view('frontend.api_data.video',compact('vid'));
    }
     
}
