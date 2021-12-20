<?php

namespace App\Http\Controllers;

// use Request;
use Illuminate\Http\Request;
use App\Models\Bet;
use App\Models\Setting;
use App\Models\Coupon;
use App\Models\CouponRedeemed;
use App\Models\InviteCode;
use App\Models\InviteCodeUsed;
use App\Models\Participant;
use App\Models\Tournament;
use App\Models\EventMaster;
use App\Models\Event;
use App\Models\Odd;
use App\Models\Team;
use Sentinel;
use App\User;
use Mail;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
    	$date = strtotime("-7 day");
		$last = date('Y-m-d', $date);
        $today = date('Y-m-d');

    	$bet = Bet::where('status',1)->get();
    	$weekbet = Bet::whereBetween('date_time', array($last, $today))->where('win', 0)->get();
    	$user = User::where('status',0)->get();
		$weekuser = User::whereBetween('created_at', array($last, $today))->where('status', 0)->get();

        $user = array();
        $user =User::get();

        $created_at = date('Y-m-d H:i:s', strtotime($user[0]['created_at'] . " -168 hours"));
        $new_user_list = User::whereNotIn('id', array(1, 2))->where('created_at', '>', $created_at)->get();
        $week_users = count($new_user_list);

        $newlist = User::whereNotIn('id', array(1, 2))->get();
        $new_users =count($newlist);

        return view('superadmin.dashboard', compact('bet', 'weekbet', 'user', 'weekuser', 'week_users', 'new_users'));
    }

    public function setting()
    {
        $setting=Setting::find(1);
        return view('superadmin.setting', compact('setting'));
    }

    public function settingUpdate(Request $request)
    {
        $this->validate($request,[
            'rate' => 'required'
        ]);

        $setting = Setting::find(1);
        $setting->rate = $request->rate;
        $setting->per = $request->per;
        $setting->update();
        return redirect()->back()->with(['success' => "Successfully Rate Updated."]);
    }

    function generateCouponCode()
    {
        $coupon_code = substr(md5(uniqid(mt_rand(), true)), 0, 8);
        $coupon = Coupon::where('coupon',$coupon_code)->first();
        if(!$coupon)
        {
            return $coupon_code;
        }
        return $this->generateCouponCode();
    }

    function generateInviteCode()
    {
        $invite_code = substr(md5(uniqid(mt_rand(), true)), 0, 8);

        $code = InviteCode::where('code',$invite_code)->first();
        if(!$code)
        {
            return $invite_code;
        }
        return $this->generateInviteCode();
    }

    public function rewards()
    {
        $coupon = $this->generateCouponCode();
        $coupons = Coupon::get();
        return view('superadmin.rewards',compact('coupon','coupons'));
    }

    public function inviteCode()
    {
        $code = $this->generateInviteCode();
        $invite_codes = InviteCode::get();
        return view('superadmin.invite-codes',compact('code','invite_codes'));
    }

    public function addCoupon(Request $request)
    {
        $data = $request->all();
        $coupon = $data['coupon'];
        $amount = $data['amount'];
        $usage  = $data['usage'];

        Coupon::create(['coupon' => $coupon, 'amount' => $amount, 'usage_limit' => $usage]);
        return redirect()->back()->with(['success' => "Successfully Coupon Added."]);
    }

    public function addInviteCode(Request $request)
    {
        $data = $request->all();
        $code = $data['code'];
        $usage  = $data['usage'];
        InviteCode::create(['code' => $code, 'usage_limit' => $usage]);
        return redirect()->back()->with(['success' => "Successfully Invite code Added."]);
    }

    public function redeemCoupon($coupon_code)
    {
        $coupon = Coupon::where('coupon',$coupon_code)->first();
        $user_list = CouponRedeemed::with('user')->where('coupon_id',$coupon['id'])->get();
        return view('superadmin.redeem-list',compact('coupon','user_list'));
    }

    public function inviteCodeUsed($invite_code)
    {
        $code = InviteCode::where('code',$invite_code)->first();
        $user_list = InviteCodeUsed::with('user')->where('invite_code_id',$code['id'])->get();
        return view('superadmin.invite-code-used-list',compact('code','user_list'));
    }

    public function participantList()
    {
        $participants = Participant::with('user')->get();
        return view('superadmin.participant-list',compact('participants'));
    }

    public function participantMatch($participantId, Request $request)
    {
        $participant = Participant::where('id',$participantId)->first();
        $participants = Participant::where('tournament_id',$participant->tournament_id)->where('match',0)->get();
        $tournament = Tournament::where('id', $participant->tournament_id)->first();

        if ($request->isMethod('post')) {

            $this->validate($request,[
                'participant_id' =>'required',
                'startdatetime' =>'required',
                'enddatetime' =>'required'
            ]);

            $odd = Odd::inRandomOrder()->select('odd')->whereNotNull('odd')->first();
            $user = Sentinel::getuser();
            $team_1 = Team::where('name',$participant->user->username)->first();

            if($request->participant_id) {
                $participant2 = Participant::where('id',$request->participant_id)->first();
                if($participant2)
                    $team_2 = Team::where('name',$participant2->user->username)->first();
            }

            $team_1_id = 0;
            $team_2_id = 0;
            if($team_1)
            {
                $team_1_id = $team_1->id;
            }
            else
            {
                $team_one = new Team;
                $team_one->name       = $participant->user->username;
                $team_one->created_by = $participant->user->id;
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
                $team_two->name       = $participant2->user->username;
                $team_two->created_by = $participant2->user->id;
                $team_two->save();
                $team_2_id = $team_two->id;
            }

            $event_master = EventMaster::where('event_name',$tournament->name)->first();
            if(!$event_master) {
                $event_master = new EventMaster;
                $event_master->event_name = $tournament->name;
                $event_master->save();
            }
            $event_master_id = $event_master->id;

            $event = new Event;
            $event->event_master_id = $event_master_id;
            $event->team_1_id       = $team_1_id;
            $event->team_2_id       = $team_2_id;
            $event->tournament_id   = $participant->tournament_id;
            $event->start_date      = $request->startdatetime;
            $event->end_date        = $request->enddatetime;

            $event->odds            = $odd->odd;
            $event->odds2           = $odd->odd;
            $event->draw            = $odd->odd;
            $event->cat_id          = $tournament->cat_id;
            $event->sub_cat_id      = $tournament->sub_cat_id;
            $event->live            = 0;
            $event->created_by      = $user->id;
            $event->is_approve      = 1;
            $event->is_deleted      = 0;
            $event->save();
            $participant->match = 1;
            $participant->save();
            $participant2->match = 1;
            $participant2->save();
            $mailData = [
                'user' => $participant->user,
                'user2' => $participant2->user,
                'tournament' => $tournament,
                'participant' => $participant,
                'event' => $event,
            ];
            Mail::send('emails.participant', $mailData, function ($message) use ($mailData) {
                  $message->to($mailData['user']->email);
                  $message->subject("Congrats! You have been Matched");
            });
            $mailData = [
                'user' => $participant2->user,
                'user2' => $participant->user,
                'tournament' => $tournament,
                'participant' => $participant2,
                'event' => $event,
            ];
            Mail::send('emails.participant', $mailData, function ($message) use ($mailData) {
                  $message->to($mailData['user']->email);
                  $message->subject("Congrats! You have been Matched");
            });
            return redirect('/participants')->with(['success' => "Participant match successfully."]);
        }
        return view('superadmin.participant-match',compact('participants', 'participantId'));
    }

}
