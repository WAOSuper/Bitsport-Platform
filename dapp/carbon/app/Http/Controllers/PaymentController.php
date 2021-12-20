<?php

namespace App\Http\Controllers;

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
      return view('frontend.tournament.payment', compact('user', 'tournament', 'balance', 'bets', 'invitationCodeMsg'));
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
          $message->subject("You have successfully joined tournament");
      });

    }
}
