<?php

namespace App\Http\Controllers\Auth;

use Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Http\Requests\ValidateSecretRequest;
use App\User;
use TwitchApi;


class AuthController extends Controller
{

    protected $redirectTo = '/dashboard';
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function getValidateToken()
    {
        if (session('2fa:user:id')) {
            return view('auth/validate');
        }
        return redirect('login');
    }
    /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function postValidateToken(ValidateSecretRequest $request)
    {
        //get user id and create cache key
        $userId = $request->session()->pull('2fa:user:id');
        $key    = $userId . ':' . $request->totp;

        //use cache to store token to blacklist
        Cache::add($key, true, 4);

        //login and redirect user
        $sentinel = app('sentinel');
        $user = $sentinel->findById($userId);
        $sentinel->login($user);

        return redirect()->intended($this->redirectTo);
    }

    // public function redirectToTwitchAuthentication()
    // {
    //     return redirect(TwitchApi::getAuthenticationUrl());
    // }

    // public function handleTwitchCallback(Request $request)
    // {

    //     // Request Twitch token from Twitch
    //     $code = $request->input('code');
    //     $response = TwitchApi::getAccessObject($code);
    //     TwitchApi::setToken($response['access_token']);

    //     // Get user object from Twitch
    //     $twitchUser = Twitch::authUser();

    //     /**
    //      * Find or create user (this expects a twitch_id column in your users table).
    //      *
    //      * It's recommended to identify Twitch users by twitch_id, rather than by name.
    //      * Names may be changed by Twitch staff, however, the twitch_id remains the same.
    //      */
    //     $user = User::findOrNew(['twitch_id' => $twitchUser['_id']]);

    //     // Authenticate user
    //     Auth::login($user);
    // }
}
