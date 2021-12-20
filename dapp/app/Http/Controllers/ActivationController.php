<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Activation;
use Sentinel;
use Mail;

class ActivationController extends Controller
{
    public function activate($email, $activationCode){
        $user = User::whereEmail($email)->first();
        $sentinelUser = Sentinel::findById($user->id);

        if(Activation::complete($sentinelUser, $activationCode)){

            $user->status = 1;
            //$user->mbtc = 10;
            $user->save();
          // return view('emails.welcome', compact('user')) ;
 
          Mail::send('emails.welcome',[
                'user' => $user,
            ],function($message) use ($user) {
                $message->to($user->email);
                $message->subject("Welcome to BitSport");
            });
          
            return redirect('/login')->with(['success'=>" Your account is successfully Activated !!!"]);
        }
        else{
            return redirect('/login')->with(['error'=>" This link is expires. please try to login !!!"]);
        }
    }
}
