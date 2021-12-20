<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\BuyCoin;
use App\Models\CoinAddress;
use App\Models\Setting;
use Sentinel;
use Stripe;
use Hash;
use Session;
use Storage;

class StripePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function get_current_date()
    {
        return date('M d, Y h:i:s');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function stripe($id, $status=null)
    {
        $type = $status;
        $user_id = Sentinel::getUser()->id;
        $buysell_data = BuyCoin::where('id', $id)->first();
        if(empty($buysell_data) || $buysell_data->user_id != $user_id){
            return redirect('/buy')->withErrors(['Something went wrong please try again!']);
        }
        $userdata = User::where('id', $buysell_data->user_id)->first();
        $setting = Setting::where('id', 1)->first();

        if ($buysell_data->status == 0) {
            $transaction_date = $buysell_data->created_at;

            $new_t_date = date('Y-m-d H:i:s', strtotime('+' . 3 . ' minutes', strtotime($transaction_date)));
            $now_t_date = date('Y-m-d H:i:s');

            if ($new_t_date > $now_t_date) {
                return view('stripe', compact('buysell_data', 'userdata', 'setting','type'));
            } else {
                $edit = BuyCoin::find($id);
                $edit->status = 2;
                $edit->save();

                $buysell_data = '';
                $buysell_data = BuyCoin::where('id', $id)->first();
                return view('stripe', compact('buysell_data', 'userdata', 'setting','type'));
            }
        } else {
            if($buysell_data->status == 2){
                return redirect('/buy')->withErrors(['Time expired pleas try again!']);
            }
            return view('stripe', compact('buysell_data', 'userdata', 'setting','type'));
        }

        // $buysell_data = BuyCoin::where('id', $id)->first();
        // $userdata = User::where('id', $buysell_data->user_id)->first();
        // $setting = Setting::where('id', 1)->first();
        // return view('stripe', compact('buysell_data', 'userdata', 'setting'));
    }

    public function stripePost(Request $request)
    {
        // test key = sk_test_hZk8fuLmhTXUI1s9tN6Cw3Bz00fBVLd8mU // live key = sk_live_TWkOCnoOfBk0hR7QTsEMgALX

        Stripe\Stripe::setApiKey('sk_live_0nvOCguGeAXAZM5AyfDByyPM00o2kwiITz');
        $amountCharge = $request->final_insert_usd * 100;
        $success = 0;
        $user_id_1 = $request->user_id;
        $userDetail = User::find($user_id_1);
        try {
            Stripe\Charge::create([
                "amount" => round($amountCharge),
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Green Blossom Care and Support Donation",
                "metadata" => ["Name" => $userDetail->first_name . ' ' . $userDetail->last_name, "email" => $userDetail->email],
            ]);
            $success = 1;
        } catch (\Exception $e) {
            $error = $e->getMessage();
            dd($error);
        }

        if ($success != 1) {
            Session::flash('error', $error);
            return back();
        } else {

            $transaction_id = $request->transaction_id;
            $type = $request->type;
            $user_id = $request->user_id;
            $from_type = $request->from_type;
            $tran = BuyCoin::find($transaction_id);
            $user = User::find($user_id);
            $user->mbtc = $user->mbtc + $tran->btp;
            $user->save();
            $tran->status = 1;
            $tran->admin_status = 1;
            $tran->save();
            Session::flash('success', 'Payment successful!');
            return back();
        }
    }

    public function ipnHandlerUsdp(Request $request){
        Storage::disk('local')->put($request->txn_id."-".$request->ipn_type.'  - new -.txt', json_encode($request->all()));

      if($request->confirms)
       {
           $confirms=$request->confirms;
       }
       else if($request->confirms){
            $confirms=$request->confirms;
       }
       else{ $confirms=0; }
       if($confirms == 0){

            $buysell = BuyCoin::where('user_id',Sentinel::getUser()->id)->where('buy_from',1)->where('status',0)->first();
                $usd = $buysell->usd;
                $id = $buysell->id;

                $user = User::find(Sentinel::getUser()->id);
                $user->mbtc = $user->mbtc + $buysell->btp;
                $user->save();
                $buysell = BuyCoin::find($id);
                $buysell->status = 1;
                $buysell->admin_status = 1;
                $buysell->save();

        } 
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
                $coin_bal_data = $user->mbtc;
                $coin_name = "mbtc";
                if($deposit->status==0 || $deposit->status==3 )
                {
                    $amt = number_format($request->amount,8);
                    $buycoin = BuyCoin::where('coin_value', $amt)->where('user_id',$deposit->user_id)->orderBy('created_at', 'desc')->first();
                    if(!empty($buycoin)){
                        $total_amount=$coin_bal_data + $buycoin->btp;
                    }else {
                        $total_amount=$coin_bal_data + $request->amount;
                    }
                    
                    User::where('id',$deposit->user_id)->update([$coin_name => $total_amount]);
                    $deposit1 = Deposit::where('id',$deposit->id)->update(['status' => 100,'confirms'=>$confirms]);

                    // if($user->refferral_id)
                    // {

                    //     $coin = strtolower($deposit->coin_type);
                    //     $coin = $coin.'_price';
                    //     $setting = Setting::first();
                    //     $coin_price = $setting->$coin; 
                    //     $per = Setting::find(1)->per;
                    //     $ref_per = $request->amount * $per / 100;
                    //     $ref_bonus = $ref_per * $coin_price;
                    //     $referal_bonus = $ref_bonus * $setting->rate;

                    //     $reffer = new Referral;
                    //     $reffer->user_id = $user->id;
                    //     $reffer->ref_user_id = $user->refferral_id;
                    //     $reffer->earn_amount = $referal_bonus;
                    //     $reffer->deposit_id = $deposit->id;
                    //     $reffer->save();

                    //     $reffer_user = User::where('id',$user->refferral_id)->first();
                    //     $reffer_user->mbtc = $reffer_user->mbtc +  $referal_bonus;
                    //     $reffer_user->save();
                    // }

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
