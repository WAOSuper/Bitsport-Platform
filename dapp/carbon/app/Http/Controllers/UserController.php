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
use App\User;
use App\Models\Event;
use App\Referral;
use Google2FA;
use Sentinel;
use Hash;
use App\Models\FollowEvent;

class UserController extends Controller
{
    public function dashboard()
    {
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
        return view('auth.profile', compact('user'));
    }

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

            $code= json_decode($code =file_get_contents('https://api.coinmarketcap.com/v2/ticker/?limit=10;'), true) ;
            $btc_coin = $code['data'][1]['name'];
            $eth_coin = $code['data'][1027]['name'];
            $ltc_coin = $code['data'][2]['name'];
            $dash_coin = $code['data'][131]['name'];

            $btc_price =$code['data'][1]['quotes']['USD']['price'];
            $eth_price =$code['data'][1027]['quotes']['USD']['price'];
            $ltc_price =$code['data'][2]['quotes']['USD']['price'];
            $dash_price = $code['data'][131]['quotes']['USD']['price'];

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
}
