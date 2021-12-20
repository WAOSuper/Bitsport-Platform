<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Cookie;
use Sentinel;
use Activation;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Session;

class RegisterController extends Controller
{
    public function register()
    {
        $urlSegment = request()->segment(count(request()->segments()));
        $role = ($urlSegment === 'register') ? 'user': $urlSegment;
        return view('auth.register', compact('role'));
    }
	
	public function sponser_register()
    {
        $urlSegment = request()->segment(count(request()->segments()));
        $role = ($urlSegment === 'sponser_register') ? 'sponser': $urlSegment;
        return view('auth.sponser-register', compact('role'));
    }
    public function registerPost(Request $request)
    {
        $value = $request->cookie('referral');
        $this->validate($request,[
            'email'=>'required|email|unique:users,email',
            'firstname'=>'required',
            'lastname'=>'required|max:255',
            'password' =>'required',
        ]);

        $user =  Sentinel::register(array(
            'first_name'   => $request->firstname,
            'last_name'    => $request->lastname,
            'username'     => $request->firstname.' '.$request->lastname,
            'email'        => $request->email,
            'password'     => $request->password,
            'referral_code' => str_random(16),
            'is_sponser' => $request->is_sponser,
        ));

        $referral_id = 0;
        $referral_code = Cookie::get('referral');

        if($referral_code){
            $referral_user = User::where('referral_code', $referral_code)->first();

            if ($referral_user) {
                $referral_id = $referral_user->id;
                User::where('email',$request->email)->update(array('refferral_id' => $referral_id));
            }
        }

        User::where('email',$request->email)->update(array('username' => $request->username));
		if($request->is_sponser == 'yes'){
			User::where('email',$request->email)->update(array('is_sponser' => 'yes'));
		}


        $activation = Activation::create($user);
        $role = Sentinel::findRoleBySlug($request->role);
        $role->users()->attach($user);

        $activation->completed = 1;
        $activation->save();

        $link = url('').'/activate/'.$request->email.'/'.$activation->code;
        $text = 'Welcome to BitSport';
        // return view('emails.activation',compact('user', 'link', 'text'));
        $this->sendActivationEmail($user, $text, $link);


        if(Sentinel::check())
            return redirect('/');
        try{
            $user = User::where('email', $request->email)->first(['id']);
            if($user){
                      $act = Activation::where('user_id', $user->id)->first(['completed']);
                      if($act){
                          if($act->completed == 0) {
                              return redirect()->back()->with(['error' => "Your account is not activated !!!"]);
                          }
                       }
                      else {
                         return redirect()->back()->with(['error' => "Incorrect email. Please try again."]);  
                     }
            }
            $rememberMe = false;

            $expires = time() + 60 * 60 * 24; // 24 hours
            Session::put('cookie_expires', $expires);

            User::where('email', $request->email)->update(['timezone_offset' => 0]);

            if(Sentinel::authenticateAndRemember($request->all())){
                $slug = Sentinel::getUser()->roles()->first()->slug;
                if($slug == 'superadmin'){
                    // return redirect('super-admin');
                    return redirect('/');
                }elseif($slug == 'admin'){
                    // return redirect('admin-dashboard');
                    return redirect('/');
                }elseif($slug == 'user'){
                    $status = Sentinel::check()->status;

                    $user = Sentinel::getuser();

                    if($request->remember == 1)
                     Sentinel::loginAndRemember($user);

                    if (Sentinel::getUser()->google2fa_secret) {

                        $request->session()->put('2fa:user:id', Sentinel::getUser()->id);
                        $this->logout();
                        return redirect('2fa/validate');
                    }
                }else
                    return redirect()->back()->with(['error'=>'Wrong email and password.']);
            }else
                return redirect()->back()->with(['error'=>'Wrong email and password.']);
        }catch(ThrottlingException $e){
            $delay = $e->getDelay();
            return redirect()->back()->with(['error'=>"You are Banned with $delay seconds"]);
        }catch(NotActivatedException $e){
            return redirect()->back()->with(['error'=>"You account is not activated!"]);
        }

        // $user = Sentinel::getuser();
        // $tournament = Tournament::where('id',$id)->first();
        // $balance = (Sentinel::check()) ? User::where('id',Sentinel::getUser()->id)->pluck('mbtc')->first() : 0;
        // $bets = (Sentinel::check()) ? Bet::where('user_id',Sentinel::check()->id)->where('status',0)->get() : 0;
        // $timezones = TimezoneMaster::get();
        // $slots = PreferredSlot::get();

        // return view('frontend.tournament.process', compact('user', 'tournament', 'balance', 'bets', 'timezones','slots'));
        $code = ($request->invite_code) ? '?code='.$request->invite_code : '';
        $tournamentId = $request->tournament_id;
        if($tournamentId != "") {
            return redirect('/tournament/'.$tournamentId.'/join-process'.$code);
        } else {
            return redirect('/');
        }
        //return Redirect::route('login.auto', ['email' => $request->email, 'password' => $request->password]);
        //return redirect('login')->with('success','Registration successful, check your email for verification.');
    }

    // User Activation Mail Function
    private function sendActivationEmail($user,$text,$link){
        Mail::send('emails.activation',[
            'user' => $user,
            'text' => $text,
            'link' => $link,
        ],function($message) use ($user, $text) {
            $message->to($user->email);
            $message->subject("Welcome to BitSport");
        });
    }
}
