<?php

namespace App\Http\Controllers;

use Cache;
use Illuminate\Http\Request;
use App\Http\Requests\ValidateSecretRequest;
use Sentinel;
use App\Models\Event;
use App\User;
use Activation;
use Validator;
use App\Models\Bet;
use Mail;
use Session;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $redirect = $request->query('redirect');
        if(Sentinel::check())
            return redirect('/');
        return view('auth.login', compact('redirect'));
    }
    public function LoginPost(Request $request)
    {
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
                        if(isset($request->remember_me)){
                          $rememberMe = true;
                        }

                if ($request->remember_me) {
                    echo 'month';
                   $expires = time() + 60 * 60 * 24 * 30; // one Month
                } else {
                    echo '24h';
                   $expires = time() + 60 * 60 * 24; // 24 hours
                }
                Session::put('cookie_expires', $expires);

                User::where('email', $request->email)->update(['timezone_offset' => $request->timezone_offset]);

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
                    }else {
                        if ($status == 1) {
                                $data = json_decode($request->old);
                                foreach ($data as  $value) {
                                    $odd_id =explode('|',  $value->odd_id);
                                    $odd_select = $odd_id[0];
                                    $odd_val = $odd_id[1];
                                    $e_id = $odd_id[2];
                                    $event = Event::find($e_id);
                                    $bet = new Bet;
                                    $bet->user_id = Sentinel::check()->id;
                                    $bet->event_id = $e_id;
                                    if(count($odd_id)>5)
                                        $bet->odd_name = $odd_id[6];
                                    $bet->team_id = $value->more_id;
                                    $bet->team_1_name = $odd_id[3];
                                    $odd_id4 = $odd_id[4];
                                    $bet->team_2_name = $odd_id4;
                                    if($value->more_id == 0){
                                        if($odd_select == 1)
                                            $bet->odds = $event->odds;
                                        else if($odd_select == 3)
                                            $bet->odds = $event->odds2;
                                        else
                                            $bet->odds = $event->draw;
                                    }else{

                                         $bet->odds = $event->draw;
                                    }
                                    $bet->date_time = date("Y-m-d H:i:s");
                                    $bet->bet_type = 0;
                                    $bet->bet_on = $odd_select;
                                    $bet->status = 0;
                                    $bet->save();
                                }
                            if($request->redirect)
                                return redirect($request->redirect);
                            return redirect('/');
                        } else {
                            $this->logout();
                            return redirect()->back()->with(['error' => 'Your Account is Blocked.']);
                        }
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
    }
    public function logout(){
        Sentinel::logout(null, true);
        return redirect('/');
    }
}
