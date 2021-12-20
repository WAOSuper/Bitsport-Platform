  @extends('frontend.layouts.master')
  @section('title') BitSport &trade; | Peer to Peer competitive eSports Platform @endsection
  @section('head')
    <meta name="csrf_token"  content="{{ csrf_token() }}" />
  @endsection
  @section('content')
  <style type="text/css">

      .btp_currency{
      max-width: 7%;
      height: auto;
      }
      .tokensSection .imgcoin{
          max-width: 85px;
        position: absolute;
        margin-top: -17px;
        left: -9px;  
      }
  @media(max-width: 480px){
    .tokensSection .imgcoin{
      margin-top: -9px;
      left: -2px;
      height: 52px;
  }
 
  .tokensSection .btp_currency {
    height: 27px;
    left: 7px;
    margin-top: 3px;
  }
  .tokens__outer__list .form-control{
      height: 35px;
  }
  }
      .btcTR .ccConvert{
      display: table-row;
      vertical-align: inherit;
      border-color: inherit;
    }
    .tokensSection .btp_currency {
      max-width: 52px;
      position: absolute;
      right:  7px;
    }
    .tokensSection input.btpText {     
      padding: 0 60px 0 20px;    
    } #btpbtc{
      border-radius: 22px;
    } #btpeth{
      border-radius: 22px;
    } #btpltc{
      border-radius: 22px;
    } #btpdash
    {
      border-radius: 22px;
    } #btcbtp
    {
      border-radius: 22px;
    } #ethbtp
    {
      border-radius: 22px;
    } #ltcbtp{
      border-radius: 22px;
    } #dashbtp{
      border-radius: 22px;
    } #ethbtp{
      border-radius: 22px;
    }
      .text{
      text-align:center;
      border-radius: 20px;
      }
      
      .tokensSection .tokens__outer__header {
        position: relative;
        justify-content: center;
        align-items: center;
        min-height: 100px;
        margin-bottom: 50px;
        margin-top: 50px;
        font-size: 75px;
        color: rgba(255,119,33,0.2);
      }
   
      a.btn-grad:hover, a.btn-grad:focus, a.btn-grad:active {
          background-size: 200% auto;
          -webkit-background-clip: border-box;
          -webkit-text-fill-color: #fff;
          background-position: right center !important;
          background-image: linear-gradient(to right, #ff1b2f 0%, #ff7721 51%, #ff1b2f 100%) !important;
          color: #fff !important;
      }
      
      .btn-grad {
      background-image: linear-gradient(to right, #ff1b2f 0%, #ff7721 51%, #ff1b2f 100%);
      background-size: 100% auto;
      transition: all 0.5s ease 0s;
      border-radius: 23px;
      }

      .btn:not([disabled]):not(.disabled) {
      cursor: pointer;
      }
      .btp_button_img{
        max-width: 25px;
        padding: auto;
      }
 @media(max-width: 360px){
    .tokensSection .imgcoin{
        margin-top: 3px;
        left: 5px;
        height: 30px;
    }
    .tokensSection .btp_currency{
      right: 0;
      height: 20px;
      top: 14px;
      margin-top: 0;
      max-width: 30px;
    }
  }

  .tournaments-wrapper{ padding:15px;}

.tournaments-wrapper .main-title{
  color:#fff;
  font-size:24px;
}

.box-title {
  font-size: 16px;
  padding: 15px 0;
}

.tournaments-card-inner {
        border: 1px solid #9e9caa;
        border-radius: 5px;
        overflow: hidden;
        margin-bottom: 15px;
    }

    .tournaments-thumb {
        height: 154px;
         background:#9e9caa;
         position: relative;
         background-size: 100%;
      }

     .tournaments-thumb .caption {
        color: #fff;
        position: absolute;
        background: #f92552;
        padding: 0 13px;
        border-radius: 30px;
        top: 10px;
        left: 10px;
        text-transform: uppercase;
}

      .detail-header {
          padding:10px 10px 0 10px;
      }

      .detail-header h4 {
          font-size: 16px;
          font-style: normal;
          margin-top: 5px;
          line-height: 24px;
      }
      .detail-content {
          padding: 0 10px;
      }

      .detail-content table {
          width:100%;
      }

      .detail-content table tr td {
        width: 50%;
      }

      .detail-footre {
          background: #9e9caa;
          padding: 5px 10px 5px 10px;
          margin-top: 10px;
          color:#fff;
          position: relative;
      }



  </style>
            <div class="content col-md-9">
              <!-- Posts Area 1 -->
              <!-- Latest News -->
              @if(session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
              @endif

              <div class="card card--clean mb-0 mainsectionbg">

              </br>
              <div id="data" class="mobilelivebetting">
                @if($banner->banner)
                <div id="top_banner">
                  <div class="row">
                    <div class="col-md-6">
                        <div class="banner_left">
                          <h5>{{$banner->head}}</h5>
                          <p> {{$banner->text}} </p>
                          <a href="{{ url('register') }}" title=""><button type="button" class="btn btn-primary active"> {{$banner->button}} </button></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <img src="{{url('/')}}/{{$banner->banner}}" alt="banner" class="img-thumbnail img_banner"> <!-- assets1/images/partner/banner.jpg -->
                    </div>
                    <!-- <div id="live-event-data">
                      </div> -->
                    </div>
                      <div class="row">
                    <div class="col-md-6">
                      <div id="select-featured-odd" >
                        <div id="live-featured-data">
                        </div>
                      </div>
                    </div>
                      <div class="col-md-6">
                        @if(isset($team_data->twitch_url) ) 
                        <?php  // if (array_key_exists('url', $video)) { 
                              $whatIWant = substr($team_data['twitch_url'], strpos($team_data['twitch_url'], "tv/") + 3); 
                      ?>
                      <br>
                          <iframe class="img-thumbnail img_banner" src="https://player.twitch.tv/?channel=<?php echo $whatIWant; ?>" frameborder="0" allowfullscreen> </iframe>
                      @else
                      <br>
                        <iframe class="img-thumbnail img_banner" src="https://player.twitch.tv/?channel=bitsport" frameborder="0" allowfullscreen> </iframe>
                      
                      @endif
                    </div>
                  </div>
                </div>
                @endif
              <div class="" style="margin-bottom: 20px;" >
                  <span class="headertexttop">BROWSE TOURNAMENTS</span>
              </div>
              <hr>

              <div class="tournaments-card-wrapper row">
                  @php
                    $per_page = 9;
                    $i = 0;
                    if($tournaments):
                      foreach($tournaments as $tournament):
                      $i++;
                  @endphp
                    <div onclick="location.href='{{url('tournament').'/'.$tournament->id}}'" style="cursor: pointer;" @if($i>$per_page) style="display: none;" @endif  class="col-sm-4 tournament">

                        <div class="tournaments-card-inner">
                          <div style="background-image: url({{url('storage/galeryImages/thumbnail').'/'.$tournament->header_banner_thumbnail}})" class="tournaments-thumb">
                              <div class="caption"> {{$tournament->platform}}</div>
                          </div>
                          <div class="detail-header">
                            <a href=""> {{$tournament->category->name}}</a>
                            <h4><a class="no-style" href="{{url('tournament').'/'.$tournament->id}}">{{$tournament->name}}</a></h4>
                          </div>
                          <div class="detail-content">
                              <table>
                                  <tbody>
                                      <tr>
                                            <td translate=""><span>Date</span></td>
                                            <td class="text-right">{{$tournament->start_date_time->format('D, M d')}}</td>
                                        </tr>
                                        <tr>
                                            <td translate=""><span>Time</span></td>
                                            <td class="text-right">{{$tournament->start_date_time->format('H:i A')}}</td>
                                      </tr>
                                  </tbody>
                                </table>
                                <table>
                                  <tbody>
                                        <tr>
                                            <td translate=""><span>Type</span></td>
                                            <td class="text-right">1V1</td>
                                      </tr>
                                  </tbody>
                                </table>
                          </div>
                          <div class="detail-footre">
                              @if(isset($tournament->user))
                              <span> {{$tournament->user->first_name.' '.$tournament->user->last_name}}</span>
                              @endif
                              @if($user && $user->is_curator)
                                @if($tournament->is_following)
                                  <a id="tf-{{$tournament->id}}" onclick="toggleFollow({{$tournament->id}})" class="btn-follow" href="javascript:void(0);"> Following </a>
                                @else
                                  <a id="tf-{{$tournament->id}}" onclick="toggleFollow({{$tournament->id}})" class="btn-follow" href="javascript:void(0);"> Follow </a>
                                @endif
                              @endif
                          </div>
                        </div>
                     
                    </div>
                  @php
                      endforeach;
                    endif;
                  @endphp

                  @if(count($tournaments)>$per_page)
                    <div class="col-sm-12">
                       <div class="text-center">
                         <a href="javascript:void(0);" onclick="loadMoreTournaments()" class="btn btn-load btn-primary viewMore"> Load More</a>
                       </div> 
                    </div>
                  @endif                       
             </div>

              <div class="" >
                <span class="headertexttop">RIGHT NOW</span>
              </div>
              </div>
                <hr>
              <div id="select-odd" >
                <div id="live-event-data">
                </div>
                <!-- secon main row end here -->
                <br><br>
                 <div id="data" class="mobilelivebetting">
                  <div class="container" >
                      <span class="headertexttop">UPCOMING EVENTS</span>
                  </div>
                  <hr>
                   <div id="upcoming-event-data">
                   </div>
                 </div>
              </div>
              <div class="posts posts--cards post-grid post-grid--2cols post-grid--fitRows row">
              </div>
              <br>
              
               </br>
              </div>
                 <!--   <input id="inputStones" type="text" placeholder="Stones" oninput="currencyConverter(this.value)" onchange="currencyConverter(this.value)"> -->
              </div>
        </div>
    </div>

  @endsection

  @section('script_bottom')
    
  @endsection
  @section('script')
      <!--- BTC  Start -->
    <script>
      function btcConverter(valNum){
        var data = valNum*{{$setting->rate}}/{{$btc_price}};
        $('#btcbtp').val(data.toFixed(8));
      }
    </script>
    <script>
      function btpbtcConverter(valNum){
        var dd = valNum*{{$btc_price}};
        var data = dd/{{$setting->rate}};      
        $('#btpbtc').val(data.toFixed(8));
      }
    </script>
        <!--- btc end -->
        <!--  ETH start -->
    <script>
      function ethConverter(valNum){
        var data = valNum*{{$setting->rate}}/{{$eth_price}};
        $('#ethbtp').val(data.toFixed(8));
      }
    </script>
    <script>
      function btpethConverter(valNum){
        var dd = valNum*{{$eth_price}};
        var data = dd/{{$setting->rate}};
        $('#btpeth').val(data.toFixed(8));
      }
    </script>
      <!---   eth end--->
      <!--  LTC Start   -->
    <script>
      function ltcConverter(valNum){      
        var data = valNum*{{$setting->rate}}/{{$ltc_price}};
        $('#ltcbtp').val(data.toFixed(8));
      }
    </script>
    <script>
      function btpltcConverter(valNum){      
        var dd = valNum*{{$ltc_price}};
        var data = dd/{{$setting->rate}};
        $('#btpltc').val(data.toFixed(8));
      }
    </script>
      <!----  LTC  end-->
      <!--   DASH  Start -->
    <script>
      function dashConverter(valNum){
        var data = valNum*{{$setting->rate}}/{{$dash_price}};
        $('#dashbtp').val(data.toFixed(8));
      }
    </script>
    <script>
      function btpdashConverter(valNum){
        var dd = valNum*{{$dash_price}};
        var data = dd/{{$setting->rate}};
        $('#btpdash').val(data.toFixed(8));
      }
    </script>
  <!---   dash--->
   


  <script type="text/javascript">

var tournamentPerPage = "{{$per_page}}";
  var totalTournament = "{{count($tournaments)}}";
  var currentlyShowing = tournamentPerPage;
  function loadMoreTournaments()
  {
    currentlyShowing = currentlyShowing+tournamentPerPage;
    var i=0;
    $('.tournament').each(function(){
      $('.tournament:eq('+i+')').show();
      if(i==currentlyShowing)
      {
        return;
      }
      i++;
    });
    if(totalTournament>=currentlyShowing)
    {
      $('.viewMore').hide();
    }
  }

    $('input.float').on('input', function() {
    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
    });

    $(document).ready(function(){
      getLiveEvent()
       setInterval(function(){ getLiveEvent()},8000 );
        getUpcomingEvent()
       setInterval(function(){ getUpcomingEvent()},8000 );
       getLiveFeaturedEvent()

      // $('#select-odd').on('click', '.box', function(e) {
      //   // console.log('cjeck');
      //   if($(this).hasClass("pink")){
      //       $(this).removeClass('pink')
      //   }else{
      //       $(this).addClass('pink');
      //   }
      // });
      // $('#select-featured-odd').on('click', '.box', function(e) {
      //   // console.log('cjeck');
      //   if($(this).hasClass("pink")){
      //       $(this).removeClass('pink')
      //   }else{
      //       $(this).addClass('pink');
      //   }
      // });
    });
    function getLiveEvent()
    {
      var events='';
       $.ajax({
                  type:'get',
                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                  url:"/get-live-event",
                 // data: {'coin':coin},
                  success: function (responseData) {
                      if(responseData.length>0)
                      {
                        // console.log(responseData.length);
                          for(var i=0;i<responseData.length;i++)
                          {
                            if(responseData[i]['liveevents']!='')
                            {
                             var liveevents=responseData[i]['liveevents'];
                              //console.log(liveevents);
                              for(var j=0;j<liveevents.length;j++)
                              {
                                if(liveevents[j]['is_approve'] == 1) {
                                  events+='<div class="row">\
                                          <div class="col-md-7">\
                                            <div class="features-sports">\
                                              <p>'+liveevents[j]['team1']['name']+'-'+liveevents[j]['team2']['name']+'</p>\
                                              <a href="event-odds/'+liveevents[j]['id']+'" class="team-section">'+responseData[i]['event_name']+'</a>\
                                              <div>\
                                                <span class="badge badge-live">live</span>\
                                                <a href="event-odds/'+liveevents[j]['id']+'" class="watch"><i class="fa fa-play-circle" aria-hidden="true"></i> Watch live</a>\
                                                <p class="country">'+liveevents[j]['start_date']+'</p>\
                                              </div>\
                                            </div>\
                                            <a href="event-odds/'+liveevents[j]['id']+'" class="total-mark">+'+liveevents[j]['oddcount'].length+'</a>\
                                          </div>\
                                          <div class="col-md-5">\
                                            <div class="row winr-list">\
                                              <div class="col-md-4">\
                                                <div class="bg-color box" onclick="update_odd(this)" odd-select="1" odd-val="'+liveevents[j]['odds']+'" odd-id="'+liveevents[j]['id']+'" odd-name1="'+liveevents[j]['team1']['name']+'" odd-name2="'+liveevents[j]['team2']['name']+'" odd_title="Match Winner">\
                                                  <span >'+liveevents[j]['team1']['name']+'</span>\
                                                  <span class="list-one d-inline-block">'+liveevents[j]['odds']+'</span></i>\
                                                </div>\
                                              </div>\
                                              <div class="col-md-4">\
                                                <div class="box bg-color" onclick="update_odd(this)" odd-select="2" odd-val="'+liveevents[j]['draw']+'" odd-id="'+liveevents[j]['id']+'" odd-name1="'+liveevents[j]['team1']['name']+'" odd-name2="'+liveevents[j]['team2']['name']+'" odd_title="Match Winner">\
                                                  <span >Draw</span>\
                                                  <span class="list-one">'+liveevents[j]['draw']+'</span>\
                                                </div>\
                                              </div>\
                                              <div class="col-md-4">\
                                                <div class="box bg-color" onclick="update_odd(this)" odd-select="3" odd-val="'+liveevents[j]['odds2']+'" odd-id="'+liveevents[j]['id']+'" odd-name1="'+liveevents[j]['team1']['name']+'" odd-name2="'+liveevents[j]['team2']['name']+'" odd_title="Match Winner">\
                                                  <span >'+liveevents[j]['team2']['name']+'</span>\
                                                  <span class="list-one">'+liveevents[j]['odds2']+'</span>\
                                                </div>\
                                              </div>\
                                            </div>\
                                          </div>\
                                        </div>\
                                      </div>\
                                      <hr>';
                                }
                              }
                            }
                          }
                      }
                      else
                      {
                            events="<div>No live events found.</div>"; 
                      }
                      $("#live-event-data").html(events);
                     
                  }
              });
    }

    function getUpcomingEvent()
    {
      var htmldata='';
       $.ajax({
                  type:'get',
                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                  url:"/get-upcoming-event",
                 // data: {'coin':coin},
                  success: function (responseData) {
                      if(responseData.length>0)
                      {
                          for(var i=0;i<responseData.length;i++)
                          {
                            
                            if(responseData[i]['upcomingevents']!='')
                            {
                             var upcomingevents=responseData[i]['upcomingevents'];
                            // console.log(upcomingevents.length);
                              for(var j=0;j<upcomingevents.length;j++)
                              {
                                var elem = "#timer_ekey"+upcomingevents[j]['id'];
                                var date2 = new Date(upcomingevents[j]['start_date'].replace(' ', 'T'));
                                var date1 = new Date();   

                                var diff = (date2 - date1)/1000;
                                var diff = Math.abs(Math.floor(diff));

                                var days = Math.floor(diff/(24*60*60));
                                var leftSec = diff - days * 24*60*60;

                                var hrs = Math.floor(leftSec/(60*60));
                                var leftSec = leftSec - hrs * 60*60;

                                var min = Math.floor(leftSec/(60));
                                var leftSec = leftSec - min * 60;
                                if(upcomingevents[j]['is_approve'] == 1) {
                                  htmldata += '<div class="row">\
                                      <div class="col-md-7">\
                                        <div class="features-sports">\
                                          <p>'+upcomingevents[j]['start_date']+' Start In : '+days+'d '+hrs+'hrs '+min+'mints</p>\
                                          <a href="event-odds/'+upcomingevents[j]['id']+'" class="team-section">'+responseData[i]['event_name']+'</a>\
                                          <div>\
                                            <a href="#" class="watch"></i>Not started</a>\
                                            <p class="country">'+upcomingevents[j]['team1']['name']+'-'+upcomingevents[j]['team2']['name']+'</p>\
                                          </div>\
                                        </div>\
                                        <a href="event-odds/'+upcomingevents[j]['id']+'" class="total-mark">+'+upcomingevents[j]['oddcount'].length+'</a>\
                                      </div>\
                                      <div class="col-md-5">\
                                        <div class="row winr-list">\
                                          <div class="col-md-4">\
                                            <div class="box bg-color" onclick="update_odd(this)" odd-select="1" odd-val="'+upcomingevents[j]['odds']+'" odd-id="'+upcomingevents[j]['id']+'" odd-name1="'+upcomingevents[j]['team1']['name']+'" odd-name2="'+upcomingevents[j]['team2']['name']+'" odd_title="Match Winner">\
                                              <span >'+upcomingevents[j]['team1']['name']+'</span>\
                                              <span class="list-one d-inline-block">'+upcomingevents[j]['odds']+'</span></i>\
                                            </div>\
                                          </div>\
                                          <div class="col-md-4">\
                                            <div class="box bg-color" onclick="update_odd(this)" odd-select="2" odd-val="'+upcomingevents[j]['draw']+'" odd-id="'+upcomingevents[j]['id']+'" odd-name1="'+upcomingevents[j]['team1']['name']+'" odd-name2="'+upcomingevents[j]['team2']['name']+'" odd_title="Match Winner">\
                                              <span >Draw</span>\
                                              <span class="list-one">'+upcomingevents[j]['draw']+'</span>\
                                            </div>\
                                          </div>\
                                          <div class="col-md-4">\
                                            <div class="box bg-color" onclick="update_odd(this)" odd-select="3" odd-val="'+upcomingevents[j]['odds2']+'" odd-id="'+upcomingevents[j]['id']+'" odd-name1="'+upcomingevents[j]['team1']['name']+'" odd-name2="'+upcomingevents[j]['team2']['name']+'" odd_title="Match Winner">\
                                              <span >'+upcomingevents[j]['team2']['name']+'</span>\
                                              <span class="list-one">'+upcomingevents[j]['odds2']+'</span>\
                                            </div>\
                                          </div>\
                                        </div>\
                                      </div>\
                                    </div>\
                                  </div>\
                                  <hr>';
                              }
                            }

                                }

                          }
                      }
                      else
                      {
                          htmldata="<div>No upcoming event found.</div>";
                      }
                      $("#upcoming-event-data").html(htmldata);
                     
                  }
              });
    }

    function getLiveFeaturedEvent()
    {
      var events='';
       $.ajax({
                type:'get',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url:"/get-live-featured",
               // data: {'coin':coin},
                success: function (responseData) {
                     // console.log(responseData);
                    // if(responseData.length>0)
                    //   {
                            if(responseData!='')
                            {
                             var liveevents=responseData;
                               // console.log(liveevents);
                              
                                events+='<div class="row">\
                                          <div class="col-md-12">\
                                            <div class="features-sports">\
                                              <p>'+liveevents['team1']['name']+'-'+liveevents['team2']['name']+'</p>\
                                              <a href="event-odds/'+liveevents['id']+'" class="team-section">'+liveevents['event_master']['event_name']+'</a>\
                                              <div>\
                                                <span class="badge badge-live">live</span>\
                                                <a href="event-odds/'+liveevents['id']+'" class="watch"><i class="fa fa-play-circle" aria-hidden="true"></i> Watch live</a>\
                                                <p class="country">'+liveevents['start_date']+'</p>\
                                              </div>\
                                            </div>\
                                            <a href="event-odds/'+liveevents['id']+'" class="total-mark">+'+liveevents['oddcount'].length+'</a>\
                                          </div>\
                                          <div class="col-md-12" style="margin-top: 10px;">\
                                            <div class="row winr-list">\
                                              <div class="col-md-4">\
                                                <div class="box bg-color" onclick="update_odd(this)" odd-select="1" odd-val="'+liveevents['odds']+'" odd-id="'+liveevents['id']+'" odd-name1="'+liveevents['team1']['name']+'" odd-name2="'+liveevents['team2']['name']+'" odd_title="Match Winner">\
                                                  <span >'+liveevents['team1']['name']+'</span>\
                                                  <span class="list-one d-inline-block">'+liveevents['odds']+'</span></i>\
                                                </div>\
                                              </div>\
                                              <div class="col-md-4">\
                                                <div class="box bg-color" onclick="update_odd(this)" odd-select="2" odd-val="'+liveevents['draw']+'" odd-id="'+liveevents['id']+'" odd-name1="'+liveevents['team1']['name']+'" odd-name2="'+liveevents['team2']['name']+'" odd_title="Match Winner">\
                                                  <span >Draw</span>\
                                                  <span class="list-one">'+liveevents['draw']+'</span>\
                                                </div>\
                                              </div>\
                                              <div class="col-md-4">\
                                                <div class="box bg-color" onclick="update_odd(this)" odd-select="3" odd-val="'+liveevents['odds2']+'" odd-id="'+liveevents['id']+'" odd-name1="'+liveevents['team1']['name']+'" odd-name2="'+liveevents['team2']['name']+'" odd_title="Match Winner">\
                                                  <span >'+liveevents['team2']['name']+'</span>\
                                                  <span class="list-one">'+liveevents['odds2']+'</span>\
                                                </div>\
                                              </div>\
                                            </div>\
                                          </div>\
                                        </div>\
                                      </div>\
                                      <hr>';
                            }
                          
                      // }
                      // else
                      // {
                      //       events="<div>No live events found.</div>"; 
                      // }
                    $("#live-featured-data").html(events);
                    // console.log(events);
                   
                }
              });
    }



  </script>
  @endsection