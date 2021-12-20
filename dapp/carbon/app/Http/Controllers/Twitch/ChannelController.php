<?php

namespace App\Http\Controllers\Twitch;

use TwitchApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChannelController extends Controller
{
    public function channel()
    {
        return TwitchApi::channel('zarlach');
    }

    public function runCommercial()
    {
        TwitchApi::setToken('xxxxxxxxxxxxxx');

        return TwitchApi::runCommercial('zarlach', 30);
    }
}
