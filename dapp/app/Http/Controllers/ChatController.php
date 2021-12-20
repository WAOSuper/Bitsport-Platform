<?php

namespace App\Http\Controllers;

use Sentinel;
use App\User;
use App\Models\Bet;
use App\Models\Chat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ChatController extends Controller
{
    private $balance;
    private $bets;

    public function __construct()
    {
        $this->balance = (Sentinel::check()) ? User::where('id', Sentinel::getUser()->id)->pluck('mbtc')->first() : 0;
        $this->bets = (Sentinel::check()) ? Bet::where('user_id', Sentinel::check()->id)->where('status', 0)->get() : 0;
    }

    public function single($to_user_id)
    {
        $balance = $this->balance;
        $bets = $this->bets;
        $user_id = Sentinel::getUser()->id;
        $logged_in_user =  User::with(['blocked_by'])->find($user_id);
        $blocked = false;
        foreach ($logged_in_user->blocked_by as $row) {
            if ($to_user_id == $row->user_id) {
                $blocked = true;
                break;
            }
        }
        if($blocked){
            return redirect()->back()->with("error", "You are blocked by this user");;
        }
        $touser = User::find($to_user_id);
        $to_user_name = $touser->username;
        $chat = View::make('frontend.chat.index');
		$challenge = "";
        return view('frontend.chat.messages', compact('chat', 'bets', 'balance', 'user_id', 'challenge', 'to_user_id', 'to_user_name'));
    }

    public function readMessage($id)
    {
        Chat::where('id',$id)->update(['read_status'=>1]);
    }

    public function getMessages()
    {
        $userId = $_GET['userId'];
        $toUserId = $_GET['toUserId'];
        $chats = DB::select("SELECT id,from_user_id as fromUserId,to_user_id as toUserId,message,sent_timestamp FROM chats WHERE (from_user_id = ? AND to_user_id = ? ) OR (from_user_id = ? AND to_user_id = ? ) ORDER BY id ASC", [$userId, $toUserId, $toUserId, $userId]);
        echo json_encode($chats);
    }

    public function getOnline()
    {
        extract($_GET);
        $users = User::join('role_users','role_users.user_id','=','users.id')->where('role_users.role_id', 3)->select('id','trust_score','username')->where('id', '!=',Sentinel::getUser()->id)->where('online','Y')->where('status','1');        
        $total = $users->count();
        if(isset($current) && isset($length)){
            $users  = $users->offset($current-1)->limit($length);
        }
        $data = $users->get();
        die(json_encode(compact('total','data')));
    }

    public function getAllMessages()
    {
        $user_id = Sentinel::getUser()->id;
        $chats = DB::select("SELECT t1.*, CONCAT(u1.first_name,' ',u1.last_name) as fromUserName, CONCAT(u2.first_name,' ',u2.last_name) as toUserName
                FROM chats AS t1
                INNER JOIN
                (
                    SELECT
                        LEAST(from_user_id, to_user_id) AS from_user_id,
                        GREATEST(from_user_id, to_user_id) AS to_user_id,
                        MAX(id) AS max_id
                    FROM chats
                    GROUP BY
                        LEAST(from_user_id, to_user_id),
                        GREATEST(from_user_id, to_user_id)
                ) AS t2
                    ON LEAST(t1.from_user_id, t1.to_user_id) = t2.from_user_id AND
                        GREATEST(t1.from_user_id, t1.to_user_id) = t2.to_user_id AND
                        t1.id = t2.max_id LEFT JOIN users u1 ON u1.id=t1.from_user_id LEFT JOIN users u2 ON u2.id=t1.to_user_id
                    WHERE t1.from_user_id = ? OR t1.to_user_id = ? ORDER BY sent_timestamp DESC", [$user_id, $user_id]);
        echo json_encode(compact('chats', 'user_id'));
    }
}
