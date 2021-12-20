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
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Bet;
use App\Models\Cms;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use App\Models\Tournament;
use App\Models\Participant;
use App\Models\Setting;
use App\Models\InviteCode;
use App\Models\InviteCodeUsed;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use PayPal\Auth\OAuthTokenCredential as AuthOAuthTokenCredential;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\TournamentController;

use Sentinel;
use Mail;

class PaymentController extends Controller
{
    public function stripePayment(Request $request)
    {
      try {
            $user = Sentinel::getUser();
            $tournamentId = $request->input('_tournament_id');
            $tournament = Tournament::where('id', $tournamentId)->first();
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            $customer = Customer::create(
              [
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
              ]
            );

            $charge = Charge::create(
              [
                'customer' => $customer->id,
                'amount' => $tournament->fees * 10,
                'currency' => 'usd'
              ]
            );

            $this->createParticipant($user->id, $tournamentId, 'Stripe', $tournament->fees, $_POST);
            session(['success' => "You successfully joined the tournament"]);
            return redirect('tournament/'.$tournamentId)->with('success', 'You successfully joined the tournament');
        } catch (\Exception $ex) {
          return redirect('tournament/'.$tournamentId)->with('error', 'Payment Unsuccessful');
        }
    }

    public function btpPayment(Request $request)
    {
       try {
            $user = Sentinel::getUser();
            $tournamentId = $request->input('_tournament_id');
            $tournament = Tournament::where('id', $tournamentId)->first();
            $setting =Setting::first();

            $btpValue= $tournament->fees;

            $btpValue = round($btpValue, 2);

            if ($user->mbtc < $btpValue) {
                return redirect()->action(
                'TournamentController@getTournament',
                  [$tournament]
              )->with('error', 'Insufficient Balance');
            }

            $this->createParticipant($user->id, $tournamentId, 'BTP', $tournament->fees, $_POST);
            $user->mbtc = $user->mbtc - $btpValue;
            $user->save();
            return redirect()->action(
              'TournamentController@getTournament',
                [$tournament]
            )->with('success', 'You successfully joined the tournament');
        } catch (\Exception $ex) {
          return redirect()->action(
            'TournamentController@getTournament',
              [$tournament]
              )->with('error', 'Payment Unsuccessful');
        }
    }
    
  public function MobileMoney(Request $request)
    {
             try {
            $user = Sentinel::getUser();
            $tournamentId = $request->input('_tournament_id');
            $tournament = Tournament::where('id', $tournamentId)->first();
            $setting =Setting::first();

            $this->createParticipant($user->id, $tournamentId, 'MobileMoney', $tournament->fees, $_POST);
            $user->save();
            return redirect()->action(
              'TournamentController@getTournament',
                [$tournament]
            )->with('success', 'Your registrations is now awaiting payment confirmation');
        } catch (\Exception $ex) {
          return redirect()->action(
            'TournamentController@getTournament',
              [$tournament]
              )->with('error', 'Payment Unsuccessful');
        }
    }

    public function index($id, Request $request) {
      $user = Sentinel::getuser();
      $tournament = Tournament::where('id', $id)->first();
      $balance = (Sentinel::check()) ? User::where('id', Sentinel::getUser()->id)->pluck('mbtc')->first() : 0;
      $bets = (Sentinel::check()) ? Bet::where('user_id', Sentinel::check()->id)->where('status', 0)->get() : 0;
      $code = $request->query('code');
      $invitationCodeMsg = "";

      $tour = new TournamentController();
      $marketprice = $tour->getPrice();

      if($code) {
        $invitecode = InviteCode::where('code', $code)->where('status',1)->first();
        if($invitecode) {
          $user = Sentinel::getuser();
          $inviteCodeused = new InviteCodeUsed();
          $inviteCodeused->user_id = $user->id;
          $inviteCodeused->invite_code_id = $invitecode->id;
          if($inviteCodeused->save()) {
            $invitecode->total_usage = $invitecode->total_usage + 1;
            if($invitecode->total_usage >= $invitecode->usage_limit)
              $invitecode->status = 0;
            $invitecode->save();
            $this->createParticipant($user->id, $id, 'Invite', $tournament->fees, $_POST);
            return redirect('tournament/'.$id)->with('success', 'You successfully joined the tournament');
          }
        } else {
          $invitationCodeMsg = "Oops, this invite code has reached its limit but GOAT’s are never limited! Buy an Entry token below.";
        }
      }
      return view('frontend.tournament.payment', compact('user', 'tournament', 'balance', 'bets', 'invitationCodeMsg', 'marketprice'));
    }

    public function createParticipant($userId, $tournamentId, $paymentSource, $fees, $post) {
       
      $participant = new Participant;
      $participant->user_id = $userId;
      $participant->tournament_id = $tournamentId;
      $participant->payment_source = $paymentSource;
      $participant->currency = 'USD';
      $participant->amount = $fees;
      $participant->timezone = isset($post['timezone']) ? $post['timezone'] : '';
      $participant->twitch_url = isset($post['twitch_url']) ? $post['twitch_url'] : '';
      $participant->gamer_id = isset($post['gamer_id']) ? $post['gamer_id'] : '';
      $participant->host_event = $post['host_event'] != "" ? $post['host_event'] : 0;
      $participant->preffered_time = isset($post['preffered_time']) ? $post['preffered_time'] : '';
      $participant->platform = isset($post['platform']) ? $post['platform'] : '';
      $participant->status = isset($post['']);
        if($paymentSource == 'MobileMoney') {
            $participant->status = 'May Be';

       }
      $participant->save();
      $user = Sentinel::getuser();
      $tournament = Tournament::where('id', $tournamentId)->first();
      Mail::send('emails.join_tournament',[
        'user' => $user,
        'tournament' => $tournament,
      ],function($message) use ($user, $tournament) {
          $message->to($user->email);
          $message->subject("Participation Confirmation");
      });

    }


    public function CreatePaypalPayment(Request $request)
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
        $item_1 -> setName('Tournament Payment')
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
                    ->setDescription('Tournament Payment');


        $paypal_amt = $request->get('amount');
        $redirect_urls = new RedirectUrls();

        Session::put('timezone', $request->input('timezone'));
        Session::put('twitch_url', $request->input('twitch_url'));
        Session::put('gamer_id', $request->input('gamer_id'));
        Session::put('host_event', $request->input('host_event'));
        Session::put('preffered_time', $request->input('preffered_time'));
        Session::put('platform', $request->input('platform'));
        Session::put('_tournament_id', $request->input('_tournament_id'));

        $redirect_urls ->setReturnUrl(URL::to('paypal-payment-status'))
                        ->setCancelUrl(URL::to('paypal-payment-cancel'));

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
        
        Session::forget('timezone');
        Session::forget('twitch_url');
        Session::forget('gamer_id');
        Session::forget('host_event');
        Session::forget('preffered_time');
        Session::forget('platform');
        Session::forget('_tournament_id');

        return Redirect::to('/');

    }

    public function PaypalPaymentStatus()
    {

        $post_data = array();
        $tournamentId = Session::get('_tournament_id');

        $post_data['_tournament_id'] = $tournamentId;
        $post_data['timezone'] = Session::get('timezone');
        $post_data['twitch_url'] = Session::get('twitch_url');
        $post_data['gamer_id'] = Session::get('gamer_id');
        $post_data['host_event'] = Session::get('host_event');
        $post_data['preffered_time'] = Session::get('preffered_time');
        $post_data['platform'] = Session::get('platform');
        $post_data['_tournament_id'] = Session::get('_tournament_id');

        Session::forget('timezone');
        Session::forget('twitch_url');
        Session::forget('gamer_id');
        Session::forget('host_event');
        Session::forget('preffered_time');
        Session::forget('platform');
        Session::forget('_tournament_id');
        
        $paypal_conf = Config::get('paypal');
        $api_context = new ApiContext(new AuthOAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $api_context->setConfig($paypal_conf['settings']);

        $user = Sentinel::getUser();
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

                $tournament = Tournament::where('id', $tournamentId)->first();

                
                $this->createParticipant($user->id, $tournamentId, 'Paypal', $tournament->fees, $post_data);
                session(['success' => "You successfully joined the tournament"]);
                return redirect('tournament/'.$tournamentId)->with('success', 'You successfully joined the tournament');

            }

        }catch(\PayPal\Exception\PayPalConnectionException $e){

        }

        Session::put('error', 'Payment failed');
        return redirect('tournament/'.$tournamentId)->with('error', 'Payment Unsuccessful');
    }

    public function PaypalPaymentCancel()
    {
      $tournamentId = Session::get('_tournament_id');

      Session::forget('timezone');
      Session::forget('twitch_url');
      Session::forget('gamer_id');
      Session::forget('host_event');
      Session::forget('preffered_time');
      Session::forget('platform');
      Session::forget('_tournament_id');

      return redirect('tournament/'.$tournamentId);

    }

}
