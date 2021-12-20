<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Reminder;
use Mail;
use Sentinel;
use Carbon\Carbon;

class ForgotController extends Controller
{
    public function forgotPassword(){
        if(Sentinel::check())
            return redirect('/');
        return view('auth.forgot_password');
    }
    public function postForgotPassword(Request $request){
        if(Sentinel::check())
            return redirect('/');
        $user = User::whereEmail($request->email)->first();
        if(count($user)>0){
            $sentinelUser = Sentinel::findById($user->id);
            if(count($user)==0)
                return redirect()->back()->with(['success'=>'Reset code is already sent to your email.']);

            $alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            $reset_string = substr(str_shuffle(str_repeat($alpha_numeric, 8)), 0, 8);

            $reminder = Reminder::exists($sentinelUser) ? : Reminder::create($sentinelUser);
            $credentials = [
                'reset_code' => $reset_string
            ];
            Reminder::where('id', $reminder->id)->update($credentials);

            $this->sendResetPasswordEmail($user,$reminder->code,$reset_string);

            return redirect()->back()->with(['success'=>"Reset Code is sent to your email." ]);
        }
        else{
            return redirect()->back()->with(['error'=>'This email is not found please enter a registered email.']);
        }
    }


    public function resetPassword($email, $resetCode){
        $user = User::where('email',$email)->first();
        if(count($user)==0)
            abort(404);

        $sentinelUser = Sentinel::findById($user->id);
        if($reminder = Reminder::exists($sentinelUser) ? : Reminder::create($sentinelUser)){
            $now = Carbon::now();
            $date = $reminder->created_at;
            $created = new Carbon($date);
            $totalDuration = $now->diffInSeconds($created);
            if($totalDuration>12000){

                $credentials = [
                        'completed' => '1',
                        'reset_code' => $request->token
                ];
                $update = Reminder::where('id', $reminder->id)->update($credentials);
                return view('auth.reset-password', compact('user'));
                return redirect('login')->with(['error'=>'Your reset password link has expired !!!']);
            }
            if($reminder->completed==0)
                return view('auth.forgot-token', compact('email', 'resetCode'));
            if($resetCode==$reminder->code){
                return view('auth.reset-password');
            }
            else
                return redirect('/login')->with(['error'=>'Your reset password link has expired !!!']);
        }
        else{
            return redirect('/login')->with(['error'=>'Something went wrong !!!']);
        }
    }

    public function postResetPassword(Request $request,$email,$resetCode){
        // dd($request->all());

            $this->validate($request,[
                'token' => 'required|min:6|max:12',
            ]);
            $cur=1;

        $user = User::where('email',$email)->first();
        if(count($user)==0)
            abort(404);

        $sentinelUser = Sentinel::findById($user->id);
        if($reminder = Reminder::exists($sentinelUser) ? : Reminder::create($sentinelUser)){
            if($cur==1 && $reminder->token==0 && $resetCode==$reminder->code){
                if($request->token==$reminder->reset_code){
                    $credentials = [
                        'completed' => '1'
                    ];
                    $update = Reminder::where('id', $reminder->id)->update($credentials);
                    return redirect('change/reset-password/'.$user->email)->with('success','Successfully Reset your password.');
                    //$url=url('/').'/reset/'.$email.'/'.$reminder->code;
                    //return redirect($url)->with(['success'=>"Please set your new password !!!"]);
                }
                else{
                    return redirect()->back()->with(['error'=>'Token mistmath please try again !!!']);
                }
            }
            if($reminder->token==1 && $resetCode==$reminder->code){
                Reminder::complete($sentinelUser,$resetCode,$request->password);

                return redirect('/login')->with(['success'=>"Please login with your new password."]);
            }
            else{
                return redirect('/login')->with(['error'=>'Link has been expired !!!']);
            }
        }
        else{
            return redirect('/login')->with(['error'=>'Link has been expired !!!']);
        }
    }

    public function NewResetPassword($email){
      $user = User::where('email',$email)->first();
        return view('auth.reset-password', compact('user'));
    }
    
    public function postNewResetPassword(Request $request, $email){
    
        $this->validate($request,[
            // 'password' => array('confirmed','required','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/','min:8','max:32'),
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);
        
        $data = User::where('email',$request->email)->first();
        $user = Sentinel::findById($data->id);
        Sentinel::update($user, array('password' => $request->password));
        session(['new' => '']);

        Mail::send('emails.replace_password',[
                'user' => $user,
        ],function($message) use ($user) {
            $message->to($user->email);
            $message->subject("Hello $user->first_name, Congratulations");
        });

        return redirect('/login')->with(['success'=>"Please login with your new password."]);
    }
    // Forgot & Reset Passowrd Code Mail Function
    private function sendResetPasswordEmail($user, $code, $reset_string){
        Mail::send('emails.forgot-password',[
            'user' => $user,
            'code' => $code,
            'reset_code' => $reset_string
        ],function ($message) use ($user) {
            $message->to($user->email);
            $message->subject("Hello $user->first_name, Password reset request recieved ");
        });
    }
}
