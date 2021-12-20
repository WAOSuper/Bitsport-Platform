<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Sentinel;
use Illuminate\Support\Facades\View;

class ActivityController extends Controller
{

    public function __construct()
    {
    }

    public function getAllActivies()
    {
        extract($_GET);
        $user_id = Sentinel::getUser()->id;
        if (isset($count)) {
            return Activity::where(['user_id' => $user_id, 'read_status' => 0])->count();
        }
        $activities = Activity::with(['challenge.creator', 'challenge.opponent'])->where('user_id', $user_id)->get();
        $message = [];

        foreach ($activities as $key => $activity) {
            switch ($activity->type) {
                case '1':
                    $url = route('events', 'challenges') . '#recieved-challenges';
                    $message = "{$activity->challenge->creator->username} has sent you an open challenge.";
                    break;
                case '2':
                    $url = route('challenge.confirm', $activity->challenge_id);
                    $message = "{$activity->challenge->opponent->username} has responded to your challenge.";
                    break;
                case '3':
                    $url = route('challenge.play', $activity->challenge_id);
                    $message = "{$activity->challenge->creator->username} has accepted your challenge request.";
                    break;
                case '4':
                    $url = route('events', 'challenges');
                    $message = "{$activity->challenge->creator->username} has rejected your challenge response.";
                    break;
                case '5':
                    $url = route('events', 'challenges');
                    $message = "{$activity->challenge->opponent->username} has rejected your challenge.";
                    break;
                case '6':
                    $url = route('events', 'challenges');
                    $message = "{$activity->challenge->creator->username} has cancelled challenge.";
                    break;
                case '7':
                    $url = route('challenge.play', $activity->challenge_id);
                    $message = "Challenge result is draw with " . ($activity->user_id == $activity->challenge->opponent->id ? $activity->challenge->creator->username : $activity->challenge->opponent->username) . ".";
                    break;
                case '8':
                    $url = route('challenge.play', $activity->challenge_id);
                    $message = "Congratulation you have won the challenge with " . ($activity->user_id == $activity->challenge->opponent->id ? $activity->challenge->creator->username : $activity->challenge->opponent->username) . ".";
                    break;
                case '9':
                    $url = route('challenge.play', $activity->challenge_id);
                    $message = "You have lost the challenge with " . ($activity->user_id == $activity->challenge->opponent->id ? $activity->challenge->creator->username : $activity->challenge->opponent->username) . ".";
                    break;
                case '10':
                    $url = route('challenge.play', $activity->challenge_id);
                    $message = "{$activity->challenge->opponent->username} has responded to your challenge.";
                    break;
                default:
                    $url = "";
                    $message = "";
                    break;
            }
            $activity->message = $message;
            $activity->url = $url;
        }

        return view('frontend.activity.index', compact('activities'));
    }

    public function read($id)
    {
        Activity::where('id', $id)->update(['read_status' => 1]);
    }
}
