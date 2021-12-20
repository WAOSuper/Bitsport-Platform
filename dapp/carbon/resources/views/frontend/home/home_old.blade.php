@extends('frontend.layouts.master')
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

    .btcTR .ccConvert{
    display: table-row;
    vertical-align: inherit;
    border-color: inherit;
  }
  .tokensSection .btp_currency {
    max-width: 52px;
    position: absolute;
    right: 7px;
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
                      <button type="button" class="btn btn-primary active"> {{$banner->button}} </button>
                    </div>
                </div>
                <div class="col-md-6">
                  <img src="{{url('/')}}/{{$banner->banner}}" alt="banner" class="img-thumbnail img_banner"> <!-- assets1/images/partner/banner.jpg -->
                </div>

                <div class="col-md-6">
                  <?php   if (array_key_exists('url', $video)) { 
                          $whatIWant = substr($video['url'], strpos($video['url'], "tv/") + 3); 
                   ?>
                       <iframe class="img-thumbnail img_banner" src="http://player.twitch.tv/?channel=<?php echo $whatIWant; ?>" frameborder="0" allowfullscreen> </iframe>
                  <?php } ?>
                </div>
              </div>
              </div>
              @endif
              <div class="" >
                  <span class="headertexttop">RIGHT NOW</span>
              </div>
              </div>
              <hr>
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
              
           <!–– <div class="" >
            <div class="tokensSection">
                <div class="tokens__outer__header text-center">
                    <div class="tokens__outer__header_bg">
                        Buy Tokens
                        <h2>Buy Tokens</h2>
                    </div>
                </div>
                <div class="tokens__outer__list">
                  <table class="table">
                    <thead>
                        <tr>
                            <td class="currencies" align="center"><h5> Currency </h5></td>
                            <td align="center"><h5> BTP </h5></td>
                        </tr>
                    </thead>                    
                    <tbody>
                      <tr id="btcTR" class="ccConvert">  
                        <td class="tocken-img" >
                          <img class="imgcoin" src="{{url('/')}}/assets/images/coins/btc1.png" alt="btc">
                          <input type="number" step="0.00000001" min="0" name="" class="form-control text" id="btcbtp" value="{{number_format($setting->rate,8)}}" oninput="btpbtcConverter(this.value)" onchange="btpbtcConverter(this.value)" class="btpText">
                          
                        </td>
                        <td class="tocken-img">
                          <img class="btp_currency" class="btp_currency" src="{{url('/')}}/assets/images/coins/btpcoin.png" alt="">
                          <input type="number" step="0.00000001" min="0" class="form-control text" placeholder="BTC Amount" name="btc_price" id="btpbtc" value="{{number_format($btc_price,8)}}" oninput="btcConverter(this.value)" onchange="btcConverter(this.value)" class="ccText" >
                        </td>
                      </tr>
                      <tr  id="ethTR" class="ccConvert">  
                        <td class="tocken-img">
                          <img class="imgcoin" src="{{url('/')}}/assets/images/coins/eth1.png" alt="eth">
                          <input type="number" step="0.00000001" min="0" name="" id="ethbtp" class="form-control text" value="{{number_format($setting->rate,8)}}" oninput="btpethConverter(this.value)" onchange="btpethConverter(this.value)" class="btpText">
                          
                        </td>
                        <td class="tocken-img">
                            <img class="btp_currency" src="{{url('/')}}/assets/images/coins/btpcoin.png" alt="">
                            <input type="number" step="0.00000001" min="0" class="form-control text" placeholder="ETH Amount" name="eth_price" id="btpeth" value="{{number_format($eth_price,8)}}" oninput="ethConverter(this.value)" onchange="ethConverter(this.value)" class="ccText" >

                        </td>
                      </tr>
                      <tr id="ltcTR" class="ccConvert">  
                        <td class="tocken-img">
                          <img class="imgcoin" src="{{url('/')}}/assets/images/coins/ltc1.png" alt="ltc">
                          <input type="number" step="0.00000001" min="0" name="" class="form-control text" id="ltcbtp" value="{{number_format($setting->rate,8)}}" oninput="btpltcConverter(this.value)" onchange="btpltcConverter(this.value)" class="btpText">
                        </td>
                        <td class="tocken-img">
                          <img class="btp_currency" src="{{url('/')}}/assets/images/coins/btpcoin.png" alt="">
                          <input type="number" step="0.00000001" min="0" class="form-control text" placeholder="LTC Amount" name="ltc_price" id="btpltc" value="{{number_format($ltc_price,8)}}" oninput="ltcConverter(this.value)" onchange="ltcConverter(this.value)" class="ccText">
                        </td>
                      </tr>
                      <tr id="dashTR" class="ccConvert">  
                        <td class="tocken-img">
                          <img class="imgcoin" src="{{url('/')}}/assets/images/coins/dash1.png" alt="dash">
                          <input type="number" step="0.00000001" min="0" name="" class="form-control text" id="dashbtp" value="{{number_format($setting->rate,8)}}" oninput="btpdashConverter(this.value)" onchange="btpdashConverter(this.value)" class="btpText">
                        </td>
                        <td class="tocken-img">
                            <img class="btp_currency" src="{{url('/')}}/assets/images/coins/btpcoin.png" alt="">
                            <input type="number" step="0.00000001" min="0" class="form-control text" placeholder="DASH Amount" name="dash_price" id="btpdash" value="{{number_format($dash_price,8)}}" oninput="dashConverter(this.value)" onchange="dashConverter(this.value)" class="ccText">
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="buyTokens" align="center">
                        <a href="{{ url('wallet') }}" class="btn btn-grad"><img class="btp_button_img" src="{{url('/')}}/assets/images/coins/btp_mono_white.png" style=" max-width: 35px;padding-right: 10px; margin-top: -2px; border-right: 0.5px solid #fff; margin-right: 10px;" alt="">Buy Tokens</a>
                  </div>
                </div> 
            </div> 
             </br>
            </div>-->
               <!--   <input id="inputStones" type="text" placeholder="Stones" oninput="currencyConverter(this.value)" onchange="currencyConverter(this.value)"> -->
            </div>
      </div>
  </div>

@endsection

@section('script_bottom')
  <script src="{{ asset('assets/js/script.js') }}" type="text/javascript"></script>
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
      var data = valNum*{{$btc_price}}*{{$setting->rate}};      
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
      var data = valNum*{{$eth_price}}*{{$setting->rate}};
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
      var data = valNum*{{$ltc_price}}*{{$setting->rate}};
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
      var data = valNum*{{$dash_price}}*{{$setting->rate}};
      $('#btpdash').val(data.toFixed(8));
    }
  </script>
<!---   dash--->
 


<script type="text/javascript">

  $(document).ready(function(){
    getLiveEvent()
     setInterval(function(){ getLiveEvent()},1000*10 );
      getUpcomingEvent()
     setInterval(function(){ getUpcomingEvent()},1000*10 );
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
                        for(var i=0;i<responseData.length;i++)
                        {
                          
                          if(responseData[i]['liveevents']!='')
                          {
                           var liveevents=responseData[i]['liveevents'];
                            //console.log(liveevents);
                            for(var j=0;j<liveevents.length;j++)
                            {
                              events+='<div class="row">\
                                        <div class="col-md-7">\
                                          <div class="features-sports">\
                                            <p class="badge badge-secondary">No Markets availble</p>\
                                            <p>'+liveevents[j]['team1']['name']+'-'+liveevents[j]['team2']['name']+'</p>\
                                            <a href="event-odds/'+liveevents[j]['id']+'" class="team-section">'+responseData[i]['event_name']+'</a>\
                                            <div>\
                                              <span class="badge badge-live">live</span>\
                                              <a href="#" class="watch"><i class="fa fa-play-circle" aria-hidden="true"></i> Watch live</a>\
                                              <p class="country">'+liveevents[j]['start_date']+'</p>\
                                            </div>\
                                          </div>\
                                          <a href="event-odds/'+liveevents[j]['id']+'" class="total-mark">+'+liveevents[j]['oddcount'].length+'</a>\
                                        </div>\
                                        <div class="col-md-5">\
                                          <div class="row winr-list">\
                                            <div class="col-md-4">\
                                              <div class="box" onclick="update_odd(this)" odd-select="1" odd-val="'+liveevents[j]['odds']+'" odd-id="'+liveevents[j]['id']+'" odd-name1="'+liveevents[j]['team1']['name']+'" odd-name2="'+liveevents[j]['team2']['name']+'" odd_title="Match Winner">\
                                                <span >'+liveevents[j]['team1']['name']+'</span>\
                                                <span class="list-one d-inline-block">'+liveevents[j]['odds']+'</span></i>\
                                              </div>\
                                            </div>\
                                            <div class="col-md-4">\
                                              <div class="box" onclick="update_odd(this)" odd-select="2" odd-val="'+liveevents[j]['draw']+'" odd-id="'+liveevents[j]['id']+'" odd-name1="'+liveevents[j]['team1']['name']+'" odd-name2="'+liveevents[j]['team2']['name']+'" odd_title="Match Winner">\
                                                <span >Draw</span>\
                                                <span class="list-one">'+liveevents[j]['draw']+'</span>\
                                              </div>\
                                            </div>\
                                            <div class="col-md-4">\
                                              <div class="box" onclick="update_odd(this)" odd-select="3" odd-val="'+liveevents[j]['odds2']+'" odd-id="'+liveevents[j]['id']+'" odd-name1="'+liveevents[j]['team1']['name']+'" odd-name2="'+liveevents[j]['team2']['name']+'" odd_title="Match Winner">\
                                                <span >'+liveevents[j]['team2']['name']+'</span>\
                                                <span class="list-one">'+liveevents[j]['odds2']+'</span>\
                                              </div>\
                                            </div>\
                                          </div>\
                                        </div>\
                                      </div>\
                                    </div>';
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
                              var date2 = new Date(upcomingevents[j]['start_date']);
                              var date1 = new Date();   

                              var diff = (date2 - date1)/1000;
                              var diff = Math.abs(Math.floor(diff));

                              var days = Math.floor(diff/(24*60*60));
                              var leftSec = diff - days * 24*60*60;

                              var hrs = Math.floor(leftSec/(60*60));
                              var leftSec = leftSec - hrs * 60*60;

                              var min = Math.floor(leftSec/(60));
                              var leftSec = leftSec - min * 60;


                            htmldata += '<div class="row">\
                                    <div class="col-md-7">\
                                      <div class="features-sports">\
                                        <p>'+upcomingevents[j]['start_date']+' Start In : '+hrs+' hrs'+min+' mints</p>\
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
                                </div>';
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

  $(document).ready(function(){

        $('.bg-color').click(function(e){
          console.log('bgcolor');
            if($(this).hasClass("pink")){
                $(this).removeClass('pink')
            }else{
                $(this).addClass('pink');
            }
        });
  });
</script>

@endsection