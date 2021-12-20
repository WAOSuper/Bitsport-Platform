<?php

namespace App\Http\Controllers;

use TwitchApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class ChannelController extends Controller
{
    public function channel()
    {
        return TwitchApi::channel('pgl_dota');
    }

    public function runCommercial()
    {
        TwitchApi::setToken('xxxxxxxxxxxxxx');

        return TwitchApi::runCommercial('zarlach', 30);
    }
    public function getChannel($GameName)
    {
        return TwitchApi::streams(['game' => $GameName]);
    }
    public function topGames(Request $request)
    {
        TwitchApi::setToken('xxxxxxxxxxxxxx');
        
        $channels = TwitchApi::streams(['stream_type'=>'all']);
         if(!empty($channels['streams'])){
           foreach($channels['streams'] as $key){
             if($request->video_url == $key['channel']['url']){
              return $key['channel']['_id'];
            }
          }
          return 2;
         }
          else{
              return 0;
          }
    }
}