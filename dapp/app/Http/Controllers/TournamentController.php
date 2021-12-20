<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Models\Bet;
use App\Models\Tournament;
use App\Models\FollowTournament;
use App\Models\Participant;
use App\Models\Event;
use App\Models\Odd;
use App\Models\Team;
use App\Models\EventMaster;
use App\Models\TimezoneMaster;
use App\Models\PreferredSlot;
use Illuminate\Support\Facades\Redirect;
use Sentinel;
use Mail;
use Illuminate\Support\Facades\DB;

class TournamentController extends Controller
{
    public function getTournament($id)
    {
        $user = Sentinel::getuser();
        $tournament = Tournament::where('id', $id)->first();
        $balance = (Sentinel::check()) ? User::where('id', Sentinel::getUser()->id)->pluck('mbtc')->first() : 0;
        $bets = (Sentinel::check()) ? Bet::where('user_id', Sentinel::check()->id)->where('status', 0)->get() : 0;
        $participants = Participant::with('user')->where('tournament_id', $id)->get();
        if($user) {
          $already_participant = Participant::with('user')->where('tournament_id', $id)->where('user_id', $user->id)->first();
        } else {
          $already_participant = false;
        }
        $participant_count = $participants->count();
		    $sponsers = DB::table('sponsers')->get();
        
        $marketprice = $this->getPrice();

        return view('frontend.tournament.index', compact('user', 'tournament', 'balance', 'bets', 'participants', 'participant_count', 'already_participant','sponsers', 'marketprice'));
    }

    public function joinTournament($id, Request $request)
    {
        $user = Sentinel::getuser();
        $tournament = Tournament::where('id', $id)->first();
        $balance = (Sentinel::check()) ? User::where('id', Sentinel::getUser()->id)->pluck('mbtc')->first() : 0;
        $bets = (Sentinel::check()) ? Bet::where('user_id', Sentinel::check()->id)->where('status', 0)->get() : 0;
        $code = $request->query('code');
        $queryStringValue = ($code != "") ? "?code=".$code : '';
        return view('frontend.tournament.joinTournament', compact('user', 'tournament', 'balance', 'bets', 'queryStringValue'));
    }

    public function joinProcess($id, Request $request)
    {
      $user = Sentinel::getuser();
      $tournament = Tournament::where('id',$id)->first();
      $balance = (Sentinel::check()) ? User::where('id',Sentinel::getUser()->id)->pluck('mbtc')->first() : 0;
      $bets = (Sentinel::check()) ? Bet::where('user_id',Sentinel::check()->id)->where('status',0)->get() : 0;
      $timezones = TimezoneMaster::get();
      $slots = PreferredSlot::get();
      $code = $request->query('code');
      $queryStringValue = ($code != "") ? "?code=".$code : '';

      return view('frontend.tournament.process', compact('user', 'tournament', 'balance', 'bets', 'timezones','slots', 'queryStringValue'));
    }

    public function matchMaking($id)
    {
      $tournament         = Tournament::where('id',$id)->first();
      if($tournament->status != 3)
      {
        $participants       = Participant::with('user')->where('tournament_id',$id)->get();
        $participant_count  = $participants->count();

        $user_id = Sentinel::getUser()->id;

        $matches = array();
        $users_data = array();
        if($participants)
        {
          foreach($participants as $participant)
          {
            if($participant->preffered_time) {
              $timezoneOffset = $participant->user->timezone_offset + $participant->preffered_time;
            } else {
              $timezoneOffset = $participant->user->timezone_offset;
            }
            $matches[] = array($participant->user->id => $timezoneOffset);
            $users_data[$participant->user->id] = $participant->user;
          }
          $matches = array_chunk($matches,2);

          if($matches)
          {
            $i = 1;
            foreach($matches as $match)
            {
              $odd = Odd::inRandomOrder()->select('odd')->whereNotNull('odd')->first();
              if(isset($match[0]) && isset($match[1])) {
                $user_1 = array_keys($match[0])[0];
                $user_2 = array_keys($match[1])[0];
                $team_1 = Team::where('name',$users_data[$user_1]->username)->where('created_by',$user_1)->first();
                $team_2 = Team::where('name',$users_data[$user_2]->username)->where('created_by',$user_2)->first();

                $team_1_id = 0;
                $team_2_id = 0;

                if($team_1)
                {
                  $team_1_id = $team_1->id;
                }
                else
                {
                  $team_one = new Team;
                  $team_one->name       = $users_data[$user_1]->username;
                  $team_one->created_by = $user_1;
                  $team_one->save();
                  $team_1_id = $team_one->id;
                }

                if($team_2)
                {
                  $team_2_id = $team_2->id;
                }
                else
                {
                  $team_two = new Team;
                  $team_two->name       = $users_data[$user_2]->username;
                  $team_two->created_by = $user_2;
                  $team_two->save();
                  $team_2_id = $team_two->id;
                }

                $event_master = new EventMaster;
                $event_master->event_name = $tournament->name." #".$i;
                $event_master->save();
                $event_master_id = $event_master->id;

                $event = new Event;
                $event->event_master_id = $event_master_id;
                $event->team_1_id       = $team_1_id;
                $event->team_2_id       = $team_2_id;
                $event->tournament_id   = $id;
                $event->start_date      = $tournament->start_date_time;
                $event->end_date        = $tournament->end_date_time;
                $event->odds            = $odd->odd;
                $event->odds2           = $odd->odd;
                $event->draw            = $odd->odd;
                $event->cat_id          = $tournament->cat_id;
                $event->sub_cat_id      = $tournament->sub_cat_id;
                $event->live            = 0;
                $event->created_by      = $user_id;
                $event->is_approve      = 1;
                $event->is_deleted      = 0;
                $event->save();
  
                // Send notification to participants
  
                $data1 = $users_data[$user_1];
                $data2 = $users_data[$user_2];
  
                Mail::send('emails.participant',[
                  'user' => $data1,
                  'user2' => $data2,
                  'tournament' => $tournament,
                 ], function ($message) use ($data1) {
                     $message->to($data1->email);
                     $message->subject("Congrats! You have been Matched");
                 });
  
                  Mail::send('emails.participant', [
                  'user' => $data2,
                  'user2' => $data1,
                  'tournament' => $tournament,
                 ], function ($message) use ($data2) {
                     $message->to($data2->email);
                     $message->subject("Congrats! You have been Matched");
                 });
                $i++;
              }
            }
          }
        }
      }
    }

    public function getPrice()
    {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://deep-index.moralis.io/api/v2/erc20/0xd7eed0fcde8d805b6798cda396968c25335cd379/price?chain=bsc',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_POSTFIELDS =>'{"query":"","variables":{}}',
        CURLOPT_HTTPHEADER => array(
          'accept: application/json',
          'X-API-Key: 6COLwVBJiv8ATOpdPXAanhmE3IqQKkfriIh0LnBc0o75xquzILcJiX8kX9f60Mrg',
          'Content-Type: application/json'
        ),
      ));

      $response = curl_exec($curl);
      $jsonVal = json_decode($response, true); 
      curl_close($curl); 

      $marketprice = round($jsonVal['usdPrice'], 2);
      
      return $marketprice;

    }

}
