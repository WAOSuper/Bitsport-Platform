<?php

namespace App\Http\Controllers;

use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Amount;

use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\Withdraw;
use App\Models\Setting;
use App\Models\CoinAddress;
use App\Models\Transaction;
use App\CoinPaymentsAPI;
use App\Models\Console;
use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Sentinel;
use App\Referral;
use Illuminate\Support\Facades\URL;
use PayPal\Auth\OAuthTokenCredential as AuthOAuthTokenCredential;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


class DepositController extends Controller
{

    public function index()
    {
        $deposit = Deposit::where('user_id',Sentinel::getUser()->id)->get();
        return view('user.deposit', compact('deposit'));
    }

    // public function CreateAddress()
    // {
    //     $secret = 'DSA15jU1uqTjXasdhDB145PMo152cp4Ng75ShQ5e582caP54Z';
    //     $my_xpub = 'xpub6BhZTevoTqCj4HtGz6Gy9zq8pQG4yQbn4b3eh3VqEJmk2cYQ2V7rtzjqHtzkcyinWJhvy394RaZcwHszhMD2RhyDcAzj3fqeon7FpAGbtYx';
    //     $my_api_key = '76575e78-ccd4-466d-a58e-efb4c27a7a00';
    //     $user_id = Sentinel::getUser()->id;
    //     $my_callback_url = 'https://betting.dsss.in/btc/callback?userid='.$user_id.'secret='.$secret;

    //     $root_url = 'https://api.blockchain.info/v2/receive';

    //     $parameters='xpub='.$my_xpub.'&callback='.urlencode($my_callback_url).'&key='.$my_api_key.'&gap_limit=5000';

    //     $response = file_get_contents($root_url.'?'.$parameters);

    //     $object = json_decode($response);

    //     $user = User::find($user_id);
    //     $user->btc_address = $object->address;
    //     $user->save();

    //     return redirect('deposit');
    // }

    // public function btcCallback(Request $request){
    //     $secret = 'DSA15jU1uqTjXasdhDB145PMo152cp4Ng75ShQ5e582caP54Z';
    //     if($request->secret != $secret){
    //         echo  "Failed";
    //         die;
    //     }

    //     $deposit = new Deposit;
    //     $deposit->user_id = $request->userid;
    //     $deposit->txid = $request->transaction_hash;
    //     $deposit->btc = $request->value/100000000;
    //     $deposit->save();

    //        // send mail
    //        $text = 'Thank you for Your Investment';
    //        $user = Auth::user();

    //        Mail::send('emails.investor',[
    //            'user' => $user->name,
    //            'text' => $text,
    //        ],function($message) use ($user,$text) {
    //            $message->to($user->email);
    //            $message->subject("Hello $user->name, $text");
    //        });
    // }

    // SuperAdmin View
    public function DepositRequest()
    {
        $deposit = Deposit::get();
        return view('superadmin.deposit', compact('deposit'));
    }
    // public function depositApprove($id)
    // {
    //     $deposit = Deposit::find($id);
    //     $deposit->status = 1;
    //     $deposit->save();

    //     return redirect()->back()->with('success', 'Successfully Approved Deposit Request');
    // } 

    public function deposite_coin($coin)
    {
        $user_id=Sentinel::getUser()->id;
        $address= Deposit::where('user_id', $user_id)->orderBy('created_at', 'Desc')->get();
        $user_address = User::where('id', $user_id)->orderBy('created_at', 'Desc')->first();
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
        elseif ($coin == 'paypal') {
            $coinType = 'paypal';
            $used_price = Setting::find(1)->btc_price;
            
            //return view('user.deposit',compact('coinType', 'coin'));
        }

        if ($coin == "BTP") {
            $coinType = 'BTP';
            $coin_address = CoinAddress::where('user_id', Sentinel::check()->id)->where('coin', 'BTP')->first();
            if(!$coin_address)
            {

                $cps = new CoinPaymentsAPI();
                $cps->Setup($private_key, $public_key);

                $result = $cps->GetCallbackAddress("ETH");
                    
                if ($result['error'] == 'ok') {
                    $coin_address= new CoinAddress;
                    $coin_address->user_id = Sentinel::getUser()->id;
                    $coin_address->coin = 'BTP';
                    $coin_address->address=$result['result']['address'];
                    if(isset($result['result']['dest_tag']))
                    {
                        $coin_address->destination_tag=$result['result']['dest_tag'];
                    }
                    $coin_address->save();
                    $coin_address = $result['result']['address'];
                }
                else
                {
                    $errorMsg = $result['error'];
                    return view('errors.404', compact('errorMsg'));
                }  
            }
            else {
                $coin_address=$coin_address->address;
            }
        } else {
            $coin_address = CoinAddress::where('user_id', Sentinel::check()->id)->where('coin', $coin)->first();
            if(!$coin_address && $coin != 'paypal')
            {
                $cps = new CoinPaymentsAPI();
                $cps->Setup($private_key, $public_key);

                $req = array(
                'currency' => $coin,
                'ipn_url' => url('/ipn-handler'),
                );

                $ipn_url=url('/ipn-handler');
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
                        $coin_address = $result['result']['address'];
                    }
                else
                {
                    $errorMsg = $result['error'];
                    return view('errors.404', compact('errorMsg'));
                }  
            } else if ($coin != 'paypal'){
                $coin_address=$coin_address->address;
            }
        }
        
        $user=User::where('id',$user_id)->first();

        $add= CoinAddress::where('coin', $coin)->where('user_id', Sentinel::getUser()->id)->get();
        $deposit= Deposit::where('coin_type', $coin)->where('user_id', Sentinel::getUser()->id)->orderBy('created_at', 'Desc')->get();
        $allcoin = CoinAddress::get(); 

        return view('user.deposit',compact('address','deposit','user_address','coinType','coin_address', 'add', 'allcoin', 'coin','user_id','user'));
    }

    public function epaySuccessHandler(Request $request)
    {

        print_r('test page');

      $order_number   = $_REQUEST['ORDER_NUM'];
      $v2_hash        = $_REQUEST['V2_HASH'];
      $payment_id     = $_REQUEST['PAYMENT_ID'];
      $payment_amount = $_REQUEST['PAYMENT_AMOUNT'];
      $status         = $_REQUEST['STATUS'];
      $payment_units  = $_REQUEST['PAYMENT_UNITS'];

      $transaction = Transaction::where('payment_id',$payment_id)->first();
      if($transaction->amount == $payment_amount)
      {
        Transaction::where('payment_id',$payment_id)->update(['status' => $status, 'order_num' => $order_number]);
        if($status == 2)
        {
          $user=User::where('id',$transaction->user_id)->first();
          $total_amount=$user->total_epay_bal + $payment_amount;
          User::where('id',$transaction->user_id)->update(['total_epay_bal' => $total_amount]);

          Deposit::create(['user_id' => $transaction->user_id,'amount' => $payment_amount,'txid' => $order_number,'address' => $v2_hash,'coin_type' => $payment_units,'confirms' => 1]);
        }
      }
    }

    public function addTransaction(Request $request)
    {
      $data = $request->all();
      
      Transaction::create($data);
    }

    public function ipnHandler(Request $request){
        Storage::disk('local')->put($request->txn_id."-".$request->ipn_type.'  - new -.txt', json_encode($request->all()));

      if($request->confirms)
       {
           $confirms=$request->confirms;
       }
       else if($request->confirms){
            $confirms=$request->confirms;
       }
       else{ $confirms=0; } 
        if($request->ipn_type == 'withdrawal' ) //withdraw start
       {
           $withdraw=Withdraw::where('withdraw_id',$request->id)->first();
           if($withdraw)
           {
            $user=User::where('id',$withdraw->user_id)->first();
           
              if($withdraw->coin=='BTC') { $coin_bal_data=$user->total_btc_bal;  $coin_name='total_btc_bal' ;}
              elseif($withdraw->coin=='ETH') { $coin_bal_data=$user->total_eth_bal;  $coin_name='total_eth_bal' ; }
              elseif($withdraw->coin=='LTC') { $coin_bal_data=$user->total_ltc_bal; $coin_name='total_ltc_bal' ; }
              elseif($withdraw->coin=='DASH') { $coin_bal_data=$user->total_dash_bal;  $coin_name='total_dash_bal' ;  }
              elseif($withdraw->coin=='EPAY') { $coin_bal_data=$user->total_epay_bal;  $coin_name='total_epay_bal' ;  }
             else{ $coin_bal_data=0; }
             if($request->status==2 && $withdraw->status==0)
             {
                Withdraw::where('id',$withdraw->id)->update(['status'=>1]);
             }
             else if($request->status==-1)
             {
                $withdraw = Withdraw::find($withdraw->id);
                $amount = $withdraw->amount;
                $uid = $withdraw->user_id;
                $coin = $withdraw->coin;
                Withdraw::where('id',$withdraw->id)->update(['status'=>$request->status,'admin_status'=> 2 ]);
                $balance = $coin_bal_data + $amount;
                User::where('id',$uid)->update([$coin_bal_data => $balance]);
             }
            }
       }//withdraw end
       else{
        $deposit = Deposit::where('txid',$request->txn_id)->first();
         if($request->address)
         {
            $addressdata=CoinAddress::where('address',$request->address)->first();
             if(!empty($addressdata))
             {
                 $userdata=User::where('id',$addressdata->user_id)->first();
                 if(empty($deposit) && $userdata)
                 {
                      $deposit=new Deposit;
                      $deposit->user_id=$userdata->id;
                      $deposit->amount = $request->amount;
                      $deposit->txid = $request->txn_id; 
                      $deposit->address = $request->address;
                      $deposit->coin_type = $request->currency;
                      $deposit->confirms =$confirms;
                      $deposit->save(); 
                 }
             }
        
       
          if($request->status >= 100 ){
            if($deposit){
                 $user=User::where('id',$deposit->user_id)->first();
                if($deposit->coin_type=='BTC') { $coin_bal_data=$user->total_btc_bal;  $coin_name='total_btc_bal' ; }
                elseif($deposit->coin_type=='ETH') { $coin_bal_data=$user->total_eth_bal; $coin_name='total_eth_bal' ; }
                elseif($deposit->coin_type=='LTC') { $coin_bal_data=$user->total_ltc_bal;   $coin_name='total_ltc_bal' ; }
                elseif($deposit->coin_type=='DASH') { $coin_bal_data=$user->total_dash_bal;  $coin_name='total_dash_bal' ;  }

                if($deposit->status==0 || $deposit->status==3 )
                {
                    $total_amount=$coin_bal_data + $request->amount;
                    User::where('id',$deposit->user_id)->update([$coin_name => $total_amount]);
                    $deposit1 = Deposit::where('id',$deposit->id)->update(['status' => 100,'confirms'=>$confirms]);

                    if($user->refferral_id)
                    {

                        $coin = strtolower($deposit->coin_type);
                        $coin = $coin.'_price';
                        $setting = Setting::first();
                        $coin_price = $setting->$coin; 
                        $per = Setting::find(1)->per;
                        $ref_per = $request->amount * $per / 100;
                        $ref_bonus = $ref_per * $coin_price;
                        $referal_bonus = $ref_bonus * $setting->rate;

                        $reffer = new Referral;
                        $reffer->user_id = $user->id;
                        $reffer->ref_user_id = $user->refferral_id;
                        $reffer->earn_amount = $referal_bonus;
                        $reffer->deposit_id = $deposit->id;
                        $reffer->save();

                        $reffer_user = User::where('id',$user->refferral_id)->first();
                        $reffer_user->mbtc = $reffer_user->mbtc +  $referal_bonus;
                        $reffer_user->save();
                    }

                    $this->sendDepositEmail($user, $deposit);
                }
            }
          }
           else if($request->status < 0)
            {
                if($deposit){
                    if($deposit->status!=1 )
                    {
                         Deposit::where('id',$deposit->id)->update(['status' => 2,'confirms'=>$confirms]);
                     }
                }
            }
            else if($request->status >0 && $request->status <=99 )
            {
               
                if(!empty($deposit))
                {
                    if($deposit->status!=1 )
                      { 
                        Deposit::where('id',$deposit->id)->update(['status' => 0,'confirms'=>$confirms]); 
                      }
                }
            }
            else if($request->status ==0 ){ 
                 if(!empty($deposit))
                {
                    if($deposit->status!=1 )
                      { 
                        Deposit::where('id',$deposit->id)->update(['status' =>0,'confirms'=>$confirms]); 
                      }
                }
            }
        }
     }
    }

    public function transactionDetails(Request $request)
    {
      $private_key= Setting::find(1)->private_key;
      $public_key= Setting::find(1)->public_key;

        $cps = new CoinPaymentsAPI();
        $cps->Setup($private_key, $public_key);

        return $result = $cps->get_tx_info($request->txid);
    }

    // User Deposit Confirmation Mail Function
    private function sendDepositEmail($user,$deposit){
        Mail::send('emails.deposit',[
            'user' => $user,
            'deposit' => $deposit,
        ],function($message) use ($user) {
            $message->to($user->email);
            $message->subject("Deposit Confirmation");
        });
    }

    public function bouns()
    {
        $user = User::find(3);
       if($user->refferral_id)
            {
                
                $coin = strtolower('BTC');
                $coin = $coin.'_price';
                $setting = Setting::first();
                $coin_price = $setting->$coin; 
                $per = Setting::find(1)->per;
                $ref_per = 1 * $per / 100;
                $referal_bonus = $ref_per * $coin_price;
                $referal_bonus = $referal_bonus * $setting->rate;

                $reffer = new Referral;
                $reffer->user_id = $user->id;
                $reffer->ref_user_id = $user->refferral_id;
                $reffer->earn_amount = $referal_bonus;
                $reffer->deposit_id = 5;
                $reffer->save();
               
                $reffer_user = User::where('id',$user->refferral_id)->first();
                $reffer_user->mbtc = $reffer_user->mbtc +  $referal_bonus;
                $reffer_user->save();

            }
                return "error";

                $coin = strtolower($deposit->coin_type);
                        $coin = $coin.'_price';
                        $setting = Setting::first();
                        $coin_price = $setting->$coin; 
                        $per = Setting::find(1)->per;
                        $ref_per = $request->amount * $per / 100;
                        $ref_bonus = $ref_per * $coin_price;
                        $referal_bonus = $ref_bonus * $setting->rate;

                        $reffer = new Referral;
                        $reffer->user_id = $user->id;
                        $reffer->ref_user_id = $user->refferral_id;
                        $reffer->earn_amount = $referal_bonus;
                        $reffer->deposit_id = $deposit->id;
                        $reffer->save();

                        $reffer_user = User::where('id',$user->refferral_id)->first();
                        $reffer_user->mbtc = $reffer_user->mbtc +  $referal_bonus;
                        $reffer_user->save();
    }

    public function CreateDepositPaypal(Request $request)
    {

        $paypal_conf = Config::get('paypal');
        $api_context = new ApiContext(new AuthOAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $api_context->setConfig($paypal_conf['settings']);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1 -> setName('Buy BTP')
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($request->get('amount'));

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('amount'));

        $transaction = new \PayPal\Api\Transaction(); 
        $transaction ->setAmount($amount)
                    ->setItemList($item_list)
                    ->setDescription('Your buy BTP transaction');

        $paypal_amt = $request->get('amount');
        $redirect_urls = new RedirectUrls();
        $redirect_urls ->setReturnUrl(URL::to('paypal-status/'.$paypal_amt))
                        ->setCancelUrl(URL::to('paypal-cancel'));

        $payment = new Payment();
        $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));


        try{
            $payment->create($api_context);
        }
        catch(\PayPal\Exception\PayPalConfigurationException $ex)
        {

        }

        foreach($payment->getLinks() as $link) {
            
            if ($link->getRel() == 'approval_url') {

                $redirect_url = $link->getHref();
                break;
            }
        }

        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {

            return Redirect::away($redirect_url);

        }

        Session::put('error', 'Unknown error occurred');

        return Redirect::to('/');

    }

    public function DepositPaypalStatus($paypal_amount)
    {

        $paypal_conf = Config::get('paypal');
        $api_context = new ApiContext(new AuthOAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $api_context->setConfig($paypal_conf['settings']);

        try{
            /** Get the payment ID before session clear **/
            $payment_id = Session::get('paypal_payment_id');
            /** clear the session payment ID **/
            Session::forget('paypal_payment_id');
            if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
                Session::put('error', 'Payment failed');
                return redirect('wallet');
            }
            $payment = Payment::get($payment_id, $api_context);
            $execution = new PaymentExecution();
            $execution->setPayerId(Input::get('PayerID'));
            
            $result = $payment->execute($execution, $api_context);
            if ($result->getState() == 'approved') {
                Session::put('success', 'Payment success');
                $user_id = Sentinel::getUser()->id;

                $userCoin = User::find($user_id);

                $userCoin->total_paypal_bal = $userCoin->total_paypal_bal + $paypal_amount;

                $userCoin->save();

                
                return redirect('wallet');
            }

        }catch(\PayPal\Exception\PayPalConnectionException $e){

        }

        Session::put('error', 'Payment failed');
        return redirect('wallet');
    }

    public function DepositPaypalCancel()
    {        
        return redirect('wallet');
    }    
}
