<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use App\Models\Withdrawal;
use App\Models\Withdraw;
use App\Models\Deposit;
use App\Models\Setting;
use App\CoinPaymentsAPI;
use App\User;
use View;
use Mail;
use Exception;
use Sentinel;

class WithdrawController extends Controller
{
    public function index($coin)
    {
        try{
            if($coin == 'BTC')
                $coin_name = 'Bitcoin';
            elseif($coin =='ETH')
                $coin_name = 'Ethereum';
            elseif ($coin == 'LTC')
                $coin_name = 'Litecoin';
            elseif ($coin == 'DASH')
                $coin_name = 'Dashcoin';
            elseif ($coin == 'EPAY')
                $coin_name = 'Epay';
            elseif ($coin == 'paypal')
                $coin_name = 'paypal';
            elseif ($coin == 'BTP')
                $coin_name = 'BTP';
            else
                return redirect();
            
            $coin_type=$coin;

            $withdraw = Withdraw::with('user')->where('user_id', Sentinel::getUser()->id)->where('coin',$coin_type)->orderBy('id','desc')->get();
            return view('user.withdraw', compact('withdraw', 'coin_type', 'coin_name'));
        } catch (Exception $e) 
        {
            return view('errors.404');
        }
    }

    public function withdrawRequest(Request $request)
    {
            // $this=validate($request,[
            //     'coin_address' => 'required',
            //     'amount_withdraw' => 'required',
            // ]);

        //     $address =  $this->addressValid($request->btc_address);
        //     if(!$address)
        //         return redirect()->back()->with('error', 'Invalid Address');
        // return $request->all();
        $wallet_address = $request->coin_address;
        $withdraw_amount = $request->amount_withdraw;

        $user_id = Sentinel::getUser()->id;
        $userdata=User::where('id',$user_id)->first();
        $coin=$request->coin_name;

        $deposit_amount = Deposit::where('user_id',$user_id)->where('status',100)->where('coin_type',$coin)->sum('amount');
        $coin_price = strtolower($coin.'_price');
        $setting = Setting::first();
        $coin_price = $setting[$coin_price];
        $amount = $deposit_amount * $coin_price; 

        //if ($amount > 5) {
           $with=new Withdraw;
            $with->user_id=$user_id;
            $with->coin=$request->coin_name;
            $with->address=$request->coin_address;
            $with->amount=$request->amount_withdraw;
            $with->save();
        //}
        //else{
        //   return redirect()->back()->with('error','Make a first deposit before withdrawal.');
       // }

        

       $userCoin = User::find($user_id);
           if($coin=='BTC')
           {    $userCoin->total_btc_bal = $userCoin->total_btc_bal - $request->amount_withdraw;   }
           else if($coin=='ETH')
           {   $userCoin->total_eth_bal = $userCoin->total_eth_bal  - $request->amount_withdraw;  }
           else if($coin=='LTC')
           {   $userCoin->total_ltc_bal = $userCoin->total_ltc_bal - $request->amount_withdraw;   }
           else if($coin=='DASH')
           {   $userCoin->total_dash_bal = $userCoin->total_dash_bal - $request->amount_withdraw;  }
            else if($coin=='EPAY')
           {   $userCoin->total_epay_bal = $userCoin->total_epay_bal - $request->amount_withdraw;  }
       else if($coin=='paypal')
           {   $userCoin->total_paypal_bal = $userCoin->total_paypal_bal - $request->amount_withdraw;  }
       else if($coin=='BTP')
           {   $userCoin->mbtc = $userCoin->mbtc - $request->amount_withdraw;  }
           else
           {   }
        $userCoin->save();

        $user=User::where('id',$user_id)->first();
        $text="Withdraw Request";

        Mail::send('emails.withdraw_request',[
            'user' => $user,
            'amount' => $withdraw_amount,
            'coin' => $coin,
            'text' => $text,
        ],function($message) use ($user, $text) 
        {
            $message->to($user->email);
            $message->subject("Hello $user->username, $text");
        });

       return redirect()->back()->with('success',' Withdrawal Request Sent Successfully.');
        
    }

    private function addressValid($address){

        $decoded = $this->decodeBase58($address);

        $d1 = hash("sha256", substr($decoded,0,21), true);
        $d2 = hash("sha256", $d1, true);

        if(substr_compare($decoded, $d2, 21, 4)){
            //throw new \Exception("bad digest");
            return false;
        }
        return true;
    }
    private function decodeBase58($input) {
        $alphabet = "123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";

        $out = array_fill(0, 25, 0);
        for($i=0;$i<strlen($input);$i++){
            if(($p=strpos($alphabet, $input[$i]))===false){
                throw new \Exception("invalid character found");
            }
            $c = $p;
            for ($j = 25; $j--; ) {
                $c += (int)(58 * $out[$j]);
                $out[$j] = (int)($c % 256);
                $c /= 256;
                $c = (int)$c;
            }
            if($c != 0){
                throw new \Exception("address too long");
            }
        }

        $result = "";
        foreach($out as $val){
            $result .= chr($val);
        }

        return $result;
    }

    // SuperAdmin Get Withdrawal Requests
    public function withdrawalRequest()
    {
        $withdraw = Withdraw::where('admin_status',0)->get();
        return view('superadmin.withdraw', compact('withdraw'));
    }
    public function withdrawalApprove($id)
    {

        $withdraw = Withdraw::find($id);

        $guid="GUID_HERE";
        $firstpassword="PASSWORD_HERE";
        $secondpassword="PASSWORD_HERE";
        $amounta = $withdraw->btc;
        $addressa = $withdraw->to_address;
        $recipients = urlencode('{
                  "'.$addressa.'": '.$amounta.'
               }');

        $json_url = "https://api.blockchain.info/merchant/$guid/sendmany?password=$firstpassword&second_password=$secondpassword&recipients=$recipients";

        $json_data = file_get_contents($json_url);

        $json_feed = json_decode($json_data);

        $message = $json_feed->message;
        $txid = $json_feed->tx_hash;

        if(!$txid)
            return redirect()->back()->with('error', '!! Something Wrong... <br>Payment Not Complete');


        $withdraw->txid = $txid;
        $withdraw->message = $message;
        $withdraw->status = 1;
        $withdraw->save();

        return redirect()->back()->with('success', 'Successfully Approved Withdrawal Request');
    }

    public function rejectStatus(Request $request)
    {

         $wid= $request->wid;

        $withdraw = Withdraw::find($wid);
        $amount = $withdraw->amount;
        $uid = $withdraw->user_id;
        $coin = $withdraw->coin;

        $user = User::where('id',$uid)->first();
        $btcbal = $user->total_btc_bal;
        $ethbal = $user->total_eth_bal;
        $ltcbal = $user->total_ltc_bal;
        $dashbal = $user->total_dash_bal;
        $epaybal = $user->total_epay_bal;
        $paypalbal = $user->total_paypal_bal;
        $btpbal = $user->mbtc;


        Withdraw::where('id',$wid)->update(['admin_status'=>$request->status]);

        if($coin == 'BTC') {

            $balance = $btcbal + $amount;

            User::where('id',$uid)->update(['total_btc_bal'=>$balance]);
        }

        else if($coin == 'ETH') {

            $balance = $ethbal + $amount;

            User::where('id',$uid)->update(['total_eth_bal'=>$balance]);

        }
        else if($coin == 'LTC') {

            $balance = $ltcbal + $amount;

            User::where('id',$uid)->update(['total_ltc_bal'=>$balance]);

        }
        else if($coin == 'DASH') {

            $balance = $dashbal + $amount;

            User::where('id',$uid)->update(['total_dash_bal'=>$balance]);

        }
        else if($coin == 'EPAY') {

            $balance = $epaybal + $amount;

            User::where('id',$uid)->update(['total_epay_bal'=>$balance]);

        }
        else if($coin == 'paypal') {

            $balance = $paypalbal + $amount;

            User::where('id',$uid)->update(['total_paypal_bal'=>$balance]);

        }
        else if($coin == 'BTP') {

            $balance = $btpbal + $amount;

            User::where('id',$uid)->update(['mbtc'=>$balance]);

        }
         $user = User::find($uid);

//        return View('emails.rejectwithdrawrequest',compact('user','amount','balance','coin'));
        $this->sendWithdrawalRejectEmail($user,$amount,$balance,$coin); //send email

        return 0;

    }

    public function confirmStatus($id)
    {
        //$wid= $request->wid;
        $withdraw = Withdraw::find($id);

        $amount_withdraw = $withdraw->amount;
        $coin_name = $withdraw->coin;
        $address_withdraw = $withdraw->address;
        $uid = $withdraw->user_id;
        $dest_tag = $withdraw->dest_tag;

        $setting = Setting::find(1);
        $cp_helper = new CoinPaymentsAPI();
        $setup = $cp_helper->Setup($setting->private_key,$setting->public_key);
        $result = $cp_helper->CreateWithdrawal($amount_withdraw, $coin_name, $address_withdraw,$dest_tag);

        if ($result['error'] == 'ok')
        {

            Withdraw::where('id',$wid)->update(['admin_status'=>$request->status,'status'=>$result['result']['status'],'withdraw_id'=>$result['result']['id']]);

            $user = User::find($uid);
            $this->sendWithdrawalApprovedEmail($user,$amount_withdraw,$coin_name); //send email
            //return 0;
            return redirect()->back()->with('success', 'Success!'); 

        } else {

            if($result['error'] == "That amount is larger than your balance!")
                //return "That amount is larger than your balance!";
                return redirect()->back()->with('error', 'That amount is larger than your balance!'); 
            else
                return redirect()->back()->with('error', 'Somthing went wrong !!'); 

        }
    }

    private function sendWithdrawalApprovedEmail($user,$amount_withdraw,$coin_name){
        Mail::send('emails.withdrawrequestapproved',[
            'user' => $user,
            'amount_withdraw' => $amount_withdraw,
            'coin_name' => $coin_name,
        ],function($message) use ($user, $amount_withdraw,$coin_name) {
            $message->to($user->email);
            $message->subject("Hello $user->username, Withdrawal Approved");
        });
    }

    private function sendWithdrawalRejectEmail($user,$amount,$balance,$coin){
        Mail::send('emails.rejectwithdrawrequest',[
            'user' => $user,
            'amount' => $amount,
            'balance' => $balance,
            'coin' => $coin,
        ],function($message) use ($user, $amount,$balance,$coin) {
            $message->to($user->email);
            $message->subject("Hello $user->username, Withdrawal Request Rejected");
        });
    }

}
