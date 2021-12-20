<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;
use App\Models\GetCoin;
use App\Models\Deposit;
use App\Models\RoleUser;
use App\Models\Coupon;
use App\Models\CouponRedeemed;
use App\Models\Follow;
use App\Models\BuyCoin;
use App\Models\CoinAddress;
use App\User;
use App\Models\Event;
use App\Referral;
use Google2FA;
use Sentinel;
use Hash;
use App\Models\FollowEvent;
use Stripe;
use App\CoinPaymentsAPI;
use App\Models\Blocked;
use App\Models\Challenge;
use App\Models\Console;
use Pusher\Pusher;

class UserController extends Controller
{
    public function dashboard()
    {
		
		//$user_id=Sentinel::getUser()->id;
        return redirect('profile');
        return view('user.dashboard');
    }

    public function getEvents()
    {
        $user_id=Sentinel::getUser()->id;
        $events = User::find($user_id)->followingEvents()->with('Cat', 'SubCat', 'SubSubCat', 'Master', 'Team1', 'Team2', 'Odd.oddMasterName', 'Odd.oddBet')
        ->where('is_deleted', 0)->where('live', 0)->where('winloss', 0)->get();

        return view('user.event.index', compact('events'));
    }

    public function getCoins()
    {
        $coins=GetCoin::get();
        return view('user.coins', compact('coins'));
    }

    public function buyBtp()
    {
        $transactions = BuyCoin::where('user_id', Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();
        $rate = Setting::first()->rate;
        $setting = Setting::find(1);
        $code = json_decode(file_get_contents('https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,ETH,DASH,LTC,USDT&tsyms=USD,EUR&api_key=1c03bfa9804fa1df5a4832dcad5b5ee816f9f44d63686a259607a09ef2914e2f'), true);
        if($code){
            $setting->btc_price = $code['BTC']["USD"];
            $setting->eth_price = $code['ETH']["USD"];
            $setting->ltc_price = $code['LTC']["USD"];
            $setting->dash_price = $code['DASH']["USD"];
            $setting->save();
        }
        return view('user.buyBtp', compact('transactions', 'rate', 'setting'));
    }

    public function postBuyBtp(Request $request)
    {
        //dd($request); die;
        $user_id = Sentinel::getUser()->id;
        if ($request->input('type') == 0) { // buy only
            $buy = new BuyCoin;
            $buy->user_id = $user_id;

                $buy->usd =  $request->input('amount_usd');
                $buy->btp = $request->input('amount_btp');
                $buy->buy_from = $request->input('from_type');
                
            if($request->input('from_type') == 1){ // buy with coin
                $buy->status = 0;
                
                $coin =  $request->input('coin_name'); 
                    $coin_point = 0;
                    if($coin == 'BTC'){
                       $coin_point = $request->input('bit_point_price');
                    }
                    elseif($coin == 'ETH'){
                        $coin_point = $request->input('eth_point_price');
                    }
                    elseif($coin == 'LTC'){
                        $coin_point = $request->input('ltc_point_price');
                    }
                    elseif($coin == 'DASH'){
                        $coin_point = $request->input('dash_point_price');
                    }
                    $buy->coin_value = number_format($coin_point, 8);
                    $buy->save();
                    //echo $coin_point; die;
                return redirect('coin-deposit/'.$coin.'/'.$buy->btp.'/'.$coin_point);
                //$this->addusdp($coin,$buy->usd,$user_id);
                //return $this->deposite_coin($coin);
            }
            else { // buy with credit card
                
                $buy->status = 0;
                $buy->buy_from = $request->input('from_type');
                $buy->save();

                $id = $buy->id;
                return redirect('stripe/' . $id.'/btp');
            }
        } else {
            return redirect()->back()->with(['error' => 'Something went wrong please try again!']);
        }
    }
    public function deposite_coin($coin,$usdp,$coin_point)
    {
        $user_id=Sentinel::getUser()->id;
        $private_key= Setting::find(1)->private_key;
        $public_key= Setting::find(1)->public_key;

        if($coin == 'BTC'){
            $coinType = 'BTC';
            $used_price = Setting::find(1)->btc_price;
        }
        elseif($coin == 'ETH'){
             $coinType = 'ETH';
            $used_price = Setting::find(1)->eth_price;
        }
        elseif($coin == 'LTC'){
             $coinType = 'LTC';
            $used_price = Setting::find(1)->ltc_price;
        }
        elseif($coin == 'DASH'){
             $coinType = 'DASH';
            $used_price = Setting::find(1)->dash_price;
        }
        /*elseif($coin == 'EPAY'){
             $coinType = 'EPAY';
            $used_price = Setting::find(1)->dash_price;
        }*/

        // print_r($coinType);

       $coin_address = CoinAddress::where('user_id', Sentinel::check()->id)->where('coin', $coin)->first();
       if(!$coin_address)
       {
            $cps = new CoinPaymentsAPI();
            $cps->Setup($private_key, $public_key);

            $req = array(
            'currency' => $coin,
            'ipn_url' => url('/ipn-handler-btp'),
            );

            $ipn_url=url('/ipn-handler-btp');
            $result = $cps->GetCallbackAddress($coin,$ipn_url);
                
            if ($result['error'] == 'ok') {
               $coin_address= new CoinAddress;
               $coin_address->user_id = Sentinel::getUser()->id;
               $coin_address->coin = $coin;
               $coin_address->address=$result['result']['address'];
               if(isset($result['result']['dest_tag']))
               {
                  $coin_address->destination_tag=$result['result']['dest_tag'];
               }
               $coin_address->save();
             //  return 'success'."|".$result['result']['address']."|".$result['result']['dest_tag'];
                 $coin_address = $result['result']['address'];
             }
            else
             {
                $errorMsg = $result['error'];
               return view('errors.404', compact('errorMsg'));
             }  
        }
        else{
            $coin_address=$coin_address->address;
        }
        
            $user=User::where('id',$user_id)->first();

            $add= CoinAddress::where('coin', $coin)->where('user_id', Sentinel::getUser()->id)->get();
            $deposit= Deposit::where('coin_type', $coin)->where('user_id', Sentinel::getUser()->id)->orderBy('created_at', 'Desc')->get();
            $allcoin = CoinAddress::get(); 

         return view('user.coin-deposit',compact('deposit','coinType','coin_address', 'add', 'allcoin', 'coin','user_id','user','usdp','coin_point'));
    }
    /*Admin user index code*/
    public function index()
    {
        $users=RoleUser::with('user')->where('role_id', 3)->get();
        $heading = "Users";
        return view('admin.user.index', compact('users', 'heading'));
    }

    public function creator()
    {
        $users=RoleUser::with('user')->where('role_id', 4)->get();
        $heading = "Creators";
        return view('admin.user.index', compact('users', 'heading'));
    }

    public function changeUserStatus($user_id, $status)
    {
        User::where('id', $user_id)->update(['status'=>$status]);
        return redirect()->back()->with(['success' => 'User status updated successfully.']);
    }

    public function getProfile()
    {
        $user=Sentinel::getUser();
        $consoleRows = Console::select('id', 'name')->get();
        $console = array();
        foreach ($consoleRows as $row) {
            $console[$row->id] = $row->name;
        }
		
		if($user->is_sponser == 'yes'){
			///echo"sucess";die;
			return redirect('sponser_profile'.'/'.$user->id);
		}else{
			return view('auth.profile', compact('user','console'));
		}
    }
	
	public function editSponserProfile(){
		
		$user=Sentinel::getUser();
        $consoleRows = Console::select('id', 'name')->get();
        $console = array();
        foreach ($consoleRows as $row) {
            $console[$row->id] = $row->name;
        }
		return view('auth.sponser-profile', compact('user','console'));
	}
	
	public function getSponserProfile()
    {
        $user=Sentinel::getUser();
        
        $consoleRows = Console::select('id', 'name')->get();
        $console = array();
        foreach ($consoleRows as $row) {
            $console[$row->id] = $row->name;
        }
        return view('auth.sponser', compact('user','console'));
    }
	
	

    public function profile($user_id)
    {
        $user = User::with(['following'])->find($user_id);
        $logged_in_user_id = Sentinel::getUser()->id;
        $following = false;
        foreach ($user->following as $row) {
            if ($logged_in_user_id == $row->follower_id) {
                $following = true;
                break;
            }
        } 
        $user->following = $following;

        $logged_in_user =  User::with(['blocked'])->find($logged_in_user_id);
        $blocked = false;
        foreach ($logged_in_user->blocked as $row) {
            if ($user_id == $row->blocked_user_id) {
                $blocked = true;
                break;
            }
        }
        $user->blocked = $blocked;
        
        $open_challenges = Challenge::with(['creator', 'game', 'console'])->where('game_mode', 'open')->where('status', 0)->where('user_id', $user->id)->get();
        $played_games = $user->getPlayedGames();
        $feedbacks = $user->getRecentFeedbacks();
        return view('user.profile', ['user' => $user, 'open_challenges' => $open_challenges, 'played_games' => $played_games, 'feedbacks' => $feedbacks]);
    }
	
	/*CODE by RRG*/
	public function public_profile($user_id="")
    {
	      $balance = 0;
    	  $bets =  0;
			
		  $status = null;
		  return view('frontend.challenge.index', compact('balance', 'bets','status'));
		
       
	  
      /*  $consoleRows = Console::select('id', 'name')->get();
        $console = array();
        foreach ($consoleRows as $row) {
            $console[$row->id] = $row->name;
        }
        return view('user.profile', compact('user','console')); */
    }
	
	public function public_profile_follow($user_id="")
    {
        User::where('id', $user_id)->update(['follow'=>'yes']);
        return redirect()->back()->with(['success' => 'successfully.']);
    }
	public function public_profile_report($user_id="")
    {
        User::where('id', $user_id)->update(['reprot'=>'yes']);
        return redirect()->back()->with(['success' => 'successfully.']);
    }
	public function public_profile_block($user_id="")
    {
        User::where('id', $user_id)->update(['block'=>'yes']);
        return redirect()->back()->with(['success' => 'successfully.']);
    }
	
	/*CODE by RRG*/
	
	

    public function setProfile(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' =>'required',
            'last_name' =>'required'
        ]);
        $user=User::find($id);
        $user->first_name=$request->first_name;
        $user->last_name=$request->last_name;
        $user->mobile=$request->mobile_number;
        $user->is_curator=($request->is_curator) ? $request->is_curator : 0 ;
        if ($request->hasFile('profile')) {
            $files = $request->profile ;
            $destinationPath = 'assets/images/profile';
            $filename1 = $request->first_name . '_' . time() . $files->getClientOriginalName();
            $files->move(public_path($destinationPath), $filename1);
            $user->profile=$filename1;


            if ($request->old_profile) {
                if (file_exists(public_path($destinationPath)."/".$request->old_profile)) {
                    unlink(public_path($destinationPath)."/".$request->old_profile);
                }
            }
        }
        $user->save();
        return redirect('profile')->with(['success'=>'Profile updated successfully.']);
    }

    public function updatePassword(Request $request, $id)
    {
        if (Sentinel::check()) {
            $id=Sentinel::getUser()->id;
            $this->validate($request, [
                'old_password'      =>'required|string|min:6',
                'new_password'      => 'required|string|min:6',
                'confirm_password'  => 'required|string|min:6|same:new_password',
            ]);

            $old_password=$request->old_password;
            $current_password = Sentinel::getUser()->password;
            // return $current_password;
            if (Hash::check($old_password, $current_password)) {
                $user=User::find($id);
                $user->password=bcrypt($request->new_password);
                $user->save();
                return redirect('/profile')->with('successpass', "Password updated successfully");
            } else {
                return redirect('/profile')->with('errorpass', "Invalid  Old password. Please try again");
            }
        } else {
            return redirect('login')->with('errorpass', "login to change password ");
        }
    }

    public function wallet()
    {
        if (Sentinel::check()) {
            $user = Sentinel::getUser();
            $setting =Setting::first();

        //     $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
        // $parameters = [
        //   'start' => '1',
        //   'limit' => '5000',
        //   'convert' => 'USD'
        // ];
        
        // $headers = [
        //   'Accepts: application/json',
        //   'X-CMC_PRO_API_KEY: 0094c8e8-0eaf-4ba9-80fa-15488cceb539'
        // ];
        // $qs = http_build_query($parameters); // query string encode the parameters
        // $requestData = "{$url}?{$qs}"; // create the request URL
        
        
        // $curl = curl_init(); // Get cURL resource
        // // Set cURL options
        // curl_setopt_array($curl, array(
        //   CURLOPT_URL => $requestData,            // set the request URL
        //   CURLOPT_HTTPHEADER => $headers,     // set the headers 
        //   CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
        // ));
        
        // $response = curl_exec($curl); // Send the request, save the response
        
        // $code = json_decode($response); // print json decoded response
        // curl_close($curl); // Close request

        //     $btc_coin = ($code) ? $code->data[0]->name : null;
        //     $eth_coin = ($code) ? $code->data[1]->name : null;
        //     $ltc_coin = ($code) ? $code->data[6]->name : null;
        //     $dash_coin = ($code) ? $code->data[19]->name : null;

        //     $btc_price = ($code) ?$code->data[0]->quote->USD->price : null;
        //     $eth_price = ($code) ?$code->data[1]->quote->USD->price : null;
        //     $ltc_price = ($code) ?$code->data[6]->quote->USD->price : null;
        //     $dash_price = ($code) ? $code->data[19]->quote->USD->price : null;
        $code = json_decode(file_get_contents('https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,ETH,DASH,LTC,USDT&tsyms=USD,EUR&api_key=1c03bfa9804fa1df5a4832dcad5b5ee816f9f44d63686a259607a09ef2914e2f'), true);
        if($code){
            $setting->btc_price = $code['BTC']["USD"];
            $setting->eth_price = $code['ETH']["USD"];
            $setting->ltc_price = $code['LTC']["USD"];
            $setting->dash_price = $code['DASH']["USD"];
            $setting->save();
        }
        $btc_price = $setting->btc_price;
        $eth_price = $setting->eth_price;
        $ltc_price = $setting->ltc_price;
        $dash_price = $setting->dash_price;
            $withdrawal=Setting::select('withdrawal')->first();

            return  view('user.wallet', compact('withdrawal', 'setting', 'user', 'btc_price', 'eth_price', 'ltc_price', 'dash_price'));
        } else {
            return redirect('login')->back()->with(['error' => 'Your are not a login. Please first login.']);
        }
    }

    public function convert($coin)
    {
        $setting =Setting::first();
        $user = Sentinel::getUser();

        if ($coin == 'BTC') {
            $coin == 'BTC';
            $bal = $user->total_btc_bal;
            $convertedUsd =  $setting->btc_price*$bal;
            $btpValue= $convertedUsd / $setting->rate;
            $user->total_btc_bal = 0;
        } elseif ($coin == 'ETH') {
            $coin == 'ETH';
            $bal = $user->total_eth_bal;
            $convertedUsd =  $bal*$setting->eth_price;
            $btpValue= $convertedUsd / $setting->rate;
            $user->total_eth_bal = 0;
        } elseif ($coin == 'LTC') {
            $coin == 'LTC';
            $bal = $user->total_ltc_bal;
            $convertedUsd =  $bal*$setting->ltc_price;
            $btpValue= $convertedUsd / $setting->rate;
            $user->total_ltc_bal = 0;
        } elseif ($coin == 'DASH') {
            $coin == 'LTC';
            $bal = $user->total_dash_bal;
            $convertedUsd =  $bal*$setting->dash_price;
            $btpValue= $convertedUsd / $setting->rate;
            $user->total_dash_bal = 0;
        } elseif ($coin == 'EPAY') {
            $coin == 'EPAY';
            $bal = $user->total_epay_bal;
            $convertedUsd =  $bal*$setting->epay_price;
            $btpValue= $convertedUsd / $setting->rate;
            $user->total_epay_bal = 0;
        } elseif ($coin == 'paypal') {
            $coin == 'paypal';
            $bal = $user->total_paypal_bal;
            $convertedUsd =  $bal*$setting->paypal_price;
            $btpValue= $convertedUsd / $setting->rate;
            $user->total_paypal_bal = 0;
        }

        $user->mbtc = $user->mbtc+$btpValue;
        $user->save();

        return redirect()->back()->with(['success' => "Successful $coin convert to BTP."]);
    }

    public function addbal(Request $request, $id)
    {
        // return $request->all();
        $coin=$request->coin_name;
        $user=Sentinel::getUser($id);
        $bal=strtolower('total_'.$coin.'_bal');
        $user->$bal = $user->$bal - $request->bal;
        $user->mbtc = $user->mbtc + $request->BTP;
        $user->save();
        return redirect()->back()->with(['success' => "Successful $coin convert to BTP."]);
    }

    public function baladd(Request $request, $id)
    {
        // return $request->all();
        $coin=$request->coin_name;
        $user=Sentinel::getUser($id);
        $bal='total_'.$coin.'_bal';
        $user->mbtc = $user->mbtc - $request->BTP;
        $user->$bal = $user->$bal + $request->add_bal;
        $user->save();
        return redirect()->back()->with(['success' => "Successful BTP convert to $coin."]);
    }

    public function referralList()
    {
        $user_id = Sentinel::getUser()->id;
        $referr_list = User::with('ref')->where('refferral_id', $user_id)->get();
        $total_ref_bonus = Referral::where('ref_user_id', $user_id)->sum('earn_amount');

        return view('user.referr', compact('referr_list', 'total_ref_bonus'));
    }

    public function history()
    {
        $user_id = Sentinel::getUser()->id;
        $deposit = Deposit::where('status', '<>', 0)->where('user_id', $user_id)->get();
        return view('user.history', compact('deposit'));
    }

    public function rewards()
    {
        $user_id = Sentinel::getUser()->id;
        return view('user.rewards');
    }

    public function redeemCoupon(Request $request)
    {
        $user_id    = Sentinel::getUser()->id;
        $total_btp  = Sentinel::getUser()->mbtc;
        $data       = $request->all();
        $coupon = Coupon::where('coupon', $data['coupon'])->first();
        $coupon_redeemed = CouponRedeemed::where('coupon_id', $coupon['id'])->where('user_id', $user_id)->first();

        if ($coupon['total_usage'] < $coupon['usage_limit'] && !$coupon_redeemed) {
            Coupon::where('coupon', $data['coupon'])->increment('total_usage', '1');
            CouponRedeemed::create(['coupon_id' => $coupon['id'], 'user_id' => $user_id, 'amount' => $coupon['amount']]);
            $new_btp_balance = $total_btp + $coupon['amount'];
            User::where('id', $user_id)->update(['mbtc' => $new_btp_balance]);
            return redirect()->back()->with(['success' => $coupon['amount']." BTP Claimed"]);
        } else {
            return redirect()->back()->with(['error' => "Coupon is incorrect or expired."]);
        }
    }

    public function editPreference(Request $request, $id)
    {
        $user = User::find($id);
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'followers'=>'required',
            ]);
            $user->followers = $request->followers;
            $user->save();
            return redirect('admin-creator')->with(['success' => "preference updated successfully"]);
        }
        return view('admin.user.edit-preference', compact('user'));
    }

    public function follow($user_id)
    {
        $follow = Follow::where('following_id', $user_id)->first();
        if ($follow) {
            $follow->delete();
            echo "Follow";
        } else {
            $follow = new Follow;
            $follow->follower_id = Sentinel::getUser()->id;
            $follow->following_id = $user_id;
            $follow->save();
            echo "Unfollow";
        }
    }

    public function block($user_id)
    {
        $blocked = Blocked::where('blocked_user_id', $user_id)->first();
        if ($blocked) {
            $blocked->delete();
            echo "Block";
        } else {
            $blocked = new Blocked;
            $blocked->user_id = Sentinel::getUser()->id;
            $blocked->blocked_user_id = $user_id;
            $blocked->save();
            echo "Unblock";
        }
    }

    public function pusherAuth()
    {
        $user = Sentinel::check();
        if ($user) {
            $pusher = new Pusher(config('broadcasting.connections.pusher.key'), config('broadcasting.connections.pusher.secret'), config('broadcasting.connections.pusher.app_id'));
            echo $pusher->socket_auth(request()->input('channel_name'), request()->input('socket_id'));
            return;
        }else {
            header('', true, 403);
            echo "Forbidden";
            return;
        }
    }

    public function loggedIn()
    {
        return Sentinel::check() ? 'true' : 'false' ;
    }
}
