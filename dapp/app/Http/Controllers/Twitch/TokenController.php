<?php

namespace App\Http\Controllers\Twitch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use TwitchApi;

class TokenController extends Controller
{
    public function setToken()
    {
        TwitchApi::setToken('xxxxxxxxxxxxxx');
    }

    public function getToken()
    {
        return TwitchApi::getToken();
    }

}
