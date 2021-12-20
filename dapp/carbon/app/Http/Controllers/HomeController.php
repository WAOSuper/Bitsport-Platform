<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;
use App\Models\Category;
use App\Models\Odd;
use App\User;
use App\Models\OddMaster;
use App\Models\Event;
use App\Models\Bet;
use App\Models\Banner;
use App\Models\EventMaster;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Setting;
use App\Models\Team;
use App\Models\Follow;
use App\Models\Tournament;
use App\Models\FollowTournament;
use App\Models\Score;
use Sentinel;
use TwitchApi;
use App\Http\Controllers\Controller;
use DB;
class HomeController extends Controller
{
    public function index(Request $request)
    { 
        $eventmaster = $this->getEvent('');
        $day_arr = $this->getLastNDays(7, 'Y-m-d');
        $balance = (Sentinel::check()) ? User::where('id',Sentinel::getUser()->id)->pluck('mbtc')->first() : 0;
        $bets = (Sentinel::check()) ? Bet::where('user_id',Sentinel::check()->id)->where('status',0)->get() : 0;
        $banner = Banner::find(1);
        $setting = Setting::find(1);
        // $setting = Setting::dbplus_find(relation, constraints, tuple)(1);
        $user = Sentinel::getuser();
        // return $code= file_get_contents('https://api.coinmarketcap.com/v2/ticker/?limit=10;');   

        $code= json_decode($code =file_get_contents('https://api.coinmarketcap.com/v2/ticker/?limit=10;'),true) ;      
        $btc_coin = $code['data'][1]['name'];
        $eth_coin = $code['data'][1027]['name'];
        $ltc_coin = $code['data'][2]['name'];
        $dash_coin = $code['data'][131]['name'];

        $btc_price =$code['data'][1]['quotes']['USD']['price'];
        $eth_price =$code['data'][1027]['quotes']['USD']['price'];
        $ltc_price =$code['data'][2]['quotes']['USD']['price'];
        $dash_price = $code['data'][131]['quotes']['USD']['price'];

        $setting->btc_price = $btc_price;
        $setting->eth_price = $eth_price;
        $setting->ltc_price = $ltc_price;
        $setting->dash_price = $dash_price;
        $setting->save();

        $referral = $request->r;
        if ($referral) {
          Cookie::queue('referral', $referral);
        }

         // $priceOfYourItemBTC = get_file_contents("https://blockchain.info/tobtc?currency=USD&value=".$balance);
          $team_data=Event::where('live',1)->where('featured',1)->with('Odd')->orderBy('id','desc')->first();
  
          $video=array();
            
            // if(!empty($team_data->channel_id))
            // {
            //   if((time()-(60*60*24)) >= strtotime($team_data->start_date) || (time()-(60*60*24)) < strtotime($team_data->end_date))
            //   {
            //      $video=TwitchApi::channel($team_data->channel_id);
            //   }
            // }
            //         $code1 = json_decode(file_get_contents('https://api.coinmarketcap.com/v1/ticker/<Currency ID>/?convert=Dollar'))
            
            $tournaments=Tournament::with('category')->with('subcategory')->with('user')->get();

    	return view('frontend.home.home', compact('balance', 'bets','banner', 'setting','code', 'btc_coin', 'eth_coin', 'ltc_coin', 'dash_coin', 'btc_price', 'eth_price', 'ltc_price', 'dash_price', 'video', 'oddMaster','team_data', 'tournaments', 'user'));
    }
    public function events($category)
    {
       // $event = Event::with('subcat','subsubcat','team1','team2','Cat','oddcount')->where('end_date', '>', date('Y-m-d H:i:s'))->get(); 
       // $eventmaster = EventMaster::with('events.cat','events.subcat','events.subsubcat','events.team1','events.team2','events.oddcount')->where('id', $event[0]['event_master_id'])->get();  
        $eventmaster = $this->getEvent($category);
        $day_arr = $this->getLastNDays(7, 'Y-m-d');
        $balance = (Sentinel::check()) ? User::where('id',Sentinel::getUser()->id)->pluck('mbtc')->first() : 0;
    	  $bets = (Sentinel::check()) ? Bet::where('user_id',Sentinel::check()->id)->where('status',0)->get() : 0;
        $banner = Banner::find(1);
        return view('frontend.home.sport',compact('eventmaster','day_arr','balance','bets','banner'));
    }
    public function subEvents($category,$subcate)
    {
        $day_arr = $this->getLastNDays(7, 'Y-m-d');
        $eventmaster = $this->getSubEvent($subcate);
        $balance = (Sentinel::check()) ? User::where('id',Sentinel::getUser()->id)->pluck('mbtc')->first() : 0;
        $bets = (Sentinel::check()) ? Bet::where('user_id',Sentinel::check()->id)->where('status',0)->get() : 0;
    	  $banner = Banner::find(1);
        return view('frontend.home.sport',compact('eventmaster','day_arr','balance','bets','banner'));
    }
    public function subsubEvents($category, $subcate, $subsubcate)
    {
        $day_arr = $this->getLastNDays(7, 'Y-m-d');
    	  $eventmaster = $this->getSubSubEvent($subsubcate);
        $bets = (Sentinel::check()) ? Bet::where('user_id',Sentinel::check()->id)->where('status',0)->get() : 0;
        $balance = (Sentinel::check()) ? User::where('id',Sentinel::getUser()->id)->pluck('mbtc')->first() : 0;
        $banner = Banner::find(1);
    	  return view('frontend.home.sport',compact('eventmaster','day_arr','balance','bets','banner'));
    }
    public function clearbet(){
      $bets = Bet::where('user_id',Sentinel::getUser()->id)->where('status',0)->get();
      foreach ($bets as $bet) {
        Bet::destroy($bet->id);
      }
      return 0;
    }

    // Helpful Function for above Categories
    public function getEvent($category=null,$day=null)
    {
        $cat = Category::where('slug',$category)->first();

        if($category != null){
          $eventmaster = EventMaster::with('events.cat','events.subcat','events.subsubcat','events.team1','events.team2','events.oddcount')
                        ->whereHas('events', function ($q) use ($cat) {
                            $q->where('cat_id', $cat->id)->where('live','!=', 2);
                        });

          $event = Event::with('subcat','subsubcat','team1','team2','Cat','oddcount')->where('cat_id', $cat->id);
        }else{
          $eventmaster = EventMaster::with('events.cat','events.subcat','events.subsubcat','events.team1','events.team2','events.oddcount');
          $event = Event::with('subcat','subsubcat','team1','team2','Cat','oddcount'); 
                         
        }

          if($day!=null)
          {
              $eventmaster->whereHas('events', function ($query) use ($day) {
                  $query->whereDate('start_date', '=', $day);
              });
              $event->whereDate('start_date', '=', $day);
          }
       $master =  $eventmaster->get(); 
       $event = $event->get();
        
        return array('event'=>$event, 'master'=>$master);
    } 
    public function getSubEvent($subcate,$day=null)
    {
        $subcat = SubCategory::where('slug',$subcate)->first();
          $eventmaster = EventMaster::with('events')
                ->whereHas('events', function($q) use($subcat){
                    $q->where('sub_cat_id',$subcat->id);
                });
          $event = Event::with('subcat','subsubcat','team1','team2')->where('sub_cat_id', $subcat->id);
          if($day!=null)
          {
              $eventmaster->whereHas('events', function ($query) use ($day) {
                  $query->whereDate('start_date', '=', $day);
              });
              $event->whereDate('start_date', '=', $day);
          }
        $master =  $eventmaster->get(); 
        $event = $event->get();
        
        return array('event'=>$event, 'master'=>$master);
    }

   public function getSubSubEvent($subsubcate,$day=null)
    {
        $subsubcat = SubSubCategory::where('slug',$subsubcate)->first();
        $eventmaster = EventMaster::with('events')
                        ->whereHas('events', function ($q) use ($subsubcat) {
                            $q->where('sub_sub_cat_id', $subsubcat->id);
                        });
        $event = Event::with('subcat','subsubcat','team1','team2','Cat')->where('sub_sub_cat_id', $subsubcat->id);
            if($day!=null)
            {
                $eventmaster->whereHas('events', function ($query) use ($day) {
                    $query->whereDate('start_date', '=', $day);
                });
                $event->whereDate('start_date', '=', $day);
            }
        $master =  $eventmaster->get(); 
        $event = $event->get();
        
        return array('event'=>$event, 'master'=>$master); 
    }
   

   public function getLastNDays($days, $format = 'Y-m-d'){
            $m = date("m"); $de= date("d"); $y= date("Y");
            $dateArray = array();
            for($i=0; $i<=$days-1; $i++){
                $dateArray =   date($format, mktime(0,0,0,$m,($de+$i),$y)) ; 
            $arr[]=$dateArray;
            }
            return $arr;
        }


    public function dayWiseData(Request $request)
    {
       $day=$request->day;
       $path=explode("/", $request->path);
       
       if(isset($path[4]))
       {
           $eventmaster =  $this->getSubSubEvent($path[4], $day);
       }
       else if(isset($path[3]))
       {
            $eventmaster = $this->getSubEvent($path[3], $day);
       }
       else if(isset($path[2]))
       {
            $eventmaster =  $this->getEvent($path[2],$day);
       }
       else{
          $eventmaster=EventMaster::with('events', 'Master')->where('status',0)->get();  
        }
       return  $eventmaster;
    }

    public function event_odds_post(Request $request){
       // return $request->all();
      $single_value = $request->single_value;
      $single_bet = $request->single_bet;
      $select_odds = $request->select_odds;
      $id = Sentinel::check()->id;
      $mbtc = 0;
      for($i=0;$i<count($single_bet);$i++){
        $sb = str_replace("bet_","",$single_bet[$i]);
        $sb = explode("-",$sb);
        $e_id = $sb[0];
        $stakes = number_format($single_value[$i],2);
        $select_id = str_replace("odd_","",$select_odds[$i]);
        $event = Event::find($e_id);
        $bet = Bet::where('event_id',$e_id)->where('bet_on',$select_id)->where('user_id',$id)->where('status',0)->first();
        if($event && $bet){
          if($sb[2] == 0){
            if($select_id == 1)
              $odds = $event->odds;
            else if($select_id == 3)
              $odds = $event->odds2;
            else
              $odds = $event->draw;
          }else{
              $oddd = Odd::find($sb[2]);
              $odds = $oddd->odd;
          }
          $bet->status = 1;
          $bet->bet_odds = $stakes;
          $bet->odds = $odds;
          $bet->save();
          $mbtc = $mbtc+$bet->bet_odds;
        }
      }
      $user = User::find($id);
      $user->mbtc = $user->mbtc - $mbtc;
      $user->save();
      return  redirect()->back()->with("success","Your bet placed successfully !");
    }
    public function event_odds_M_post(Request $request){
     // return $request->all();
      $single_value = $request->single_value;
      $single_bet = $request->multi_bet;
      $select_odds = $request->select_odds;
      $id = Sentinel::check()->id;
      $mbtc = 0;
      for($i=0;$i<count($single_bet);$i++){
        $sb = str_replace("mbet_","",$single_bet[$i]);
        $sb = explode("-",$sb);
        $e_id = $sb[0];
        $stakes = $single_value[$i];
        $select_id = str_replace("odd_","",$select_odds[$i]);
        $event = Event::find($e_id);
        $bet = Bet::where('event_id',$e_id)->where('bet_on',$select_id)->where('user_id',$id)->where('status',0)->first();
        if($event && $bet){
          if($sb[2] == 0){
            if($select_id == 1)
              $odds = $event->odds;
            else if($select_id == 3)
              $odds = $event->odds2;
            else
              $odds = $event->draw;
          }else{
              $oddd = Odd::find($sb[2]);
              $odds = $oddd->odd;
          }
          $bet->status = 1;
          $bet->bet_type = 1;
          $bet->bet_odds = $odds*$stakes;
          $bet->odds = $odds;
          $bet->update();
          $mbtc = $mbtc+$bet->bet_odds;
        }
      }
      $user = User::find($id);
      $user->mbtc = $user->mbtc - $mbtc;
      $user->save();
      return  redirect()->back()->with("success","Your bet placed successfully !");
    }

    public function event_odds($id)
    {
      // if(Sentinel::check())
      // {
        $user =  Sentinel::getUser();
        $event = Event::where("id",$id)->first();

        if(isset($user->id))
        {
          $role = $user->roles()->first()->slug;
        }
        else
        {
          $role = 0;
        }
        $team_data=Event::where('id',$id)->with('user','Master','Team1', 'Team2', 'Odd')->first();
        if(isset($user->id))
        {
          $follow = Follow::where('follower_id',$user->id)->where('following_id',$team_data->user->id)->first();
        }
        else
        {
          $follow = array();
        }
        $followLabel = ($follow) ? "Unfollow":"Follow";
        $odds = Odd::with('event.Team1', 'event.Team2')->where('event_id',$id)->orderBy('created_at', 'desc')->get();
        $oddMaster = OddMaster::whereHas('odds',function($q) use($id){
                  $q->where('event_id', $id);
              })->orderBy('created_at', 'desc')->get();

        // $oddMaster= OddMaster::where('id', $odd->odd_id)->select('odd_title')->first();
        // $odds = Odd::with('event.Team1')->where('event_id',$id)->where('team_id', $odd[0]['event']->team1->id)->get();
            $video=array();
            // if($team_data->channel_id!='')
            // {
            //   if((time()-(60*60*24)) >= strtotime($team_data->start_date) || (time()-(60*60*24)) < strtotime($team_data->end_date))
            //   {
            //      $video=TwitchApi::channel($team_data->channel_id);
            //   }
            // }
            $balance = (Sentinel::check()) ? User::where('id',Sentinel::getUser()->id)->pluck('mbtc')->first() : 0;
            $bets = (Sentinel::check()) ? Bet::where('user_id',Sentinel::check()->id)->where('status',0)->get() : 0;
            return view('frontend.home.event_odd',compact('team_data','balance','bets','video', 'odd', 'oddMaster', 'odds', 'role', 'followLabel', 'id', 'user', 'event'));
        // }
        // else
        // {
        //   return redirect('login')->with('error','Your are not Login. Please first Login Bitsport!');
        // }
    }
    // Show More Odds for even-odd Page
    public function ajaxEventOdd(Request $request)
    {
       return $data=Event::where('id',$request->event_id)->first();
    }
    public function ajaxOdd(Request $request,$id)
    {
      $odds = Odd::with('event.Team1', 'event.Team2')->where('event_id',$id)->orderBy('created_at', 'desc')->get();
      $oddMaster = OddMaster::whereHas('odds',function($q) use($id){
                  $q->where('event_id', $id);
              })->orderBy('created_at', 'desc')->get();

       $data = array('odds' => $odds, 'oddsMaster' => $oddMaster);
       return $data;
    }

    // Show More Odds for even-odd Page
    public function more_show(Request $request)
    {
       $oddMaster = OddMaster::whereHas('odds',function($q) use($request){
                  $q->where('event_id', $request->event_id);
              })->get();
        $odds = Odd::with('event.Team1', 'event.Team2')->where('event_id',$request->event_id)->get();

           $html='';
           // $html.='<div class="container" style="width: 100%; padding-top: 8px;"><div class="event-details-market">';

            foreach ($oddMaster as $master) 
            {
                $html.='<div class="card">                    
                            <div class="card-header" id="'.$master->odd_title.'">
                              <h5 class="mb-0" data-toggle="collapsed" data-target="#'.$master->id.'" aria-expanded="true" aria-controls="'.$master->id.'" >
                                <a class="parentClass" type="button" >
                                  '.$master->odd_title.' 
                                  <i class="fa fa-chevron-right" aria-hidden="true"></i> 
                                </a>
                              </h5>
                            </div>
                            <div id="'.$master->id.'" class="collapsed" aria-labelledby="'.$master->odd_title.'" data-parent="#accordionExample">
                              <div class="card-body">
                                <div class="card-body row">';
                          foreach ($odds as $key) 
                          {
                            $cond = ($key->event->team_1_id == $key->team_id) ? 1 : 3;
                              if($master->id == $key->odd_id){
                            $html.='<div class="col-md-6">
                                      <input type="checkbox" class="hidden">
                                      <div class="bg-color" onclick="update_odd(this)" odd-select="'.$cond.'" odd-val="'.$key->odd.'" odd-id="'.$key->event->id.'" odd-name1="'.$key->event->team1->name.'" odd-name2="'.$key->event->team2->name.'" odd-name="'.$key->name.'" more-id="'.$key->id.'" odd_title="'.$master->odd_title.'">
                                          <a href="#" class="box-collapsed" style="display: none;"> '.$key->teamName->name.' </a>
                                          <span>'.$key->name.' &nbsp; <span>'.$key->odd.'</span>
                                      </div><br>
                                  </div>';
                            }
                          }

                  $html.='</div></div></div></div>
                        <div class="clearfix"></div>
                    </div>';

            }
            return $html;
    }

    public function getLiveEvent()
    {
         // $cat = Category::where('slug',$category)->first();
        return $eventmaster = EventMaster::with('liveevents.cat','liveevents.subcat','liveevents.subsubcat','liveevents.team1','liveevents.team2','liveevents.oddcount.oddMasterName')->get();
    } 
    public function getLiveFeatured()
    {
         // $cat = Category::where('slug',$category)->first();
       return $eventFeatured = Event::with('cat','subcat','subsubcat','team1','team2','eventMaster','oddcount.oddMasterName')->where('featured',1)->where('live',1)->where('winloss', 0)->where('is_deleted', 0)->orderBy('created_at','desc')->first();

    }
    public function getUpcomingEvent()
    {
      // $cat = Category::where('slug',$category)->first();
        return $eventmaster = EventMaster::with('upcomingevents.cat','upcomingevents.subcat','upcomingevents.subsubcat','upcomingevents.team1','upcomingevents.team2','upcomingevents.oddcount.oddMasterName')->get();
    }
    public function getLiveBetting($cat_id=0)
    {
        $user = Sentinel::getuser();

        $eventmaster = $this->getEvent();
        $day_arr = $this->getLastNDays(7, 'Y-m-d');
        $balance = (Sentinel::check()) ? User::where('id',Sentinel::getUser()->id)->pluck('mbtc')->first() : 0;
        $bets = (Sentinel::check()) ? Bet::where('user_id',Sentinel::check()->id)->where('status',0)->get() : 0;
        $categories=Category::get();
        if($cat_id)
        {
          $tournaments=Tournament::with('category')->with('subcategory')->with('user')->where('cat_id',$cat_id)->get();
        }
        else
        {
          $tournaments=Tournament::with('category')->with('subcategory')->with('user')->get();

        }
        
        $data = array();
        if($tournaments)
        {
          foreach($tournaments as $tournament)
          {
            $d = $tournament;
            $d->is_following = 0;
            $d->is_loggedin = 0;
            if($user && $user->id)
            {
              $d->is_loggedin = 1;
              $result = DB::select(DB::raw("SELECT * FROM follow_tournaments WHERE user_id='".$user->id."' AND tournament_id='".$tournament->id."'"));
              if($result)
              {
                $d->is_following = 1;
              }
            }
            $data[] = $d;
          }
        }

        $tournaments = $data;
      return view('frontend.live_betting.live-betting', compact('balance', 'bets', 'categories', 'tournaments', 'user'));
    }

    public function updateCryptoCurrencies()
    {
      $json = file_get_contents('https://api.coinmarketcap.com/v2/ticker/?limit');
        $coinrates = (array)json_decode($json);
        $setting = Setting::find(1);
        foreach($coinrates['data'] as $coin)
        {
            if($coin->id == 1)
            {
                $setting->btc_price = $coin->quotes->USD->price;
            }
            elseif($coin->id == 2)
            {
                $setting->ltc_price = $coin->quotes->USD->price;
            }
            elseif($coin->id == 131)
            {
                $setting->dash_price = $coin->quotes->USD->price;
            }
            elseif($coin->id == 1027)
            {
                $setting->eth_price = $coin->quotes->USD->price;
            }
        }
        $setting->save();
    }

    public function toggleFollow($id)
    {
      $user = Sentinel::getuser();
      $is_exists = FollowTournament::where('user_id',$user->id)->where('tournament_id',$id)->get()->count();
      if($is_exists)
      {
        FollowTournament::where('user_id',$user->id)->where('tournament_id',$id)->delete();
        return 0;
      }
      else
      {
        $ftournament = new FollowTournament;
        $ftournament->user_id            = $user->id;
        $ftournament->tournament_id      = $id;
        $ftournament->save(); 
        return 1;
      }
    }

 
    public function score(Request $request)
    {
      $user = Sentinel::getuser();
         
        $scoredata = new Score;
        $scoredata1 = new Score;
            
        $scoredata->user_id      = $request->user_id;
        $scoredata->event_id     = $request->event_id;
        $scoredata->user_id      = $request->user_id;
        $scoredata->team_id      = $request->team_id;
        $scoredata->score        = $request->score;
        $scoredata->save(); 
 
        $scoredata1->score       = $request->score1;
        $scoredata1->team_id     = $request->team_id1;
        $scoredata1->event_id    = $request->event_id1;
        $scoredata1->user_id     = $request->user_id1;
        $scoredata1->save(); 

        Event::where('id',$request->event_id)->update(['team_1_score'=>$request->score,'team_2_score'=>$request->score1]);

       return  redirect()->back()->with("success","Your Scores Added successfully !");
    
    }

    
}
