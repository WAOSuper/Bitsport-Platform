@extends('frontend.layouts.master')
@section('title') BitSport &trade; | Peer to Peer competitive eSports platform @endsection
@section('head')
  <meta name="csrf_token"  content="{{ csrf_token() }}" />
  @endsection
@section('content')
<style type="text/css">
    .badge-danger
    {
      color: white;
      background-color: Red;
    }
    img .live{
      width: 14%;
      height: auto;
    }

    /**/

    .tournaments-wrapper{ padding:15px;}

    .tournaments-wrapper .main-title{
      color:#fff;
      font-size:24px;
    }

    .box-title {
    font-size: 16px;
    padding: 15px 0;
}

    .game-choose-box ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    .game-box-inner {
        width: 65px;
        height: 65px;
        border: 2px solid #ccc;
        border-radius: 5px;
    }
    .game-choose-box ul li {
        display: inline-block;
        margin-right:14px;
        vertical-align: top;
    }

    .game-box-inner span {
        display: block;
        text-align: center;
        color: #fff;
        text-transform: uppercase;
        padding: 17px 0;
    }

    .top-tab-bar {
        margin: 15px 0;
        border-bottom: 1px solid #fff;
    }

    /*.tab-menu .nav-tabs {
       border: none;
    }*/

    .tab-dropdowns ul {
    margin: 0;
    }

    .tab-dropdowns ul li a {
        color: #fff;
        display: block;
        padding: 4px 5px;
    }

    .filter-menu {
      display: inline-block;
      float: right;
      margin-right: 95px;
      margin-bottom:0;
    }

    .custom-range {
        display: inline-block;
        float: right;
    }

    .custom-range a {
        display: block;
        text-align: center;
        padding: 6px;
        color: #fff;
    }

   .filter-menu li a, 
   .filter-menu li a:hover {
        background: none;
        border: none;
        color: #fff;
        padding: 3px 10px 9px 10px;
        display: block;
        position: relative;
    }

    .filter ul li.active a,
    .filter ul li.active a:hover,
    .filter ul li.active a:visited {
        background: none;
        border: none;
        color: #fff;
        /*border-bottom: 1px solid #f92552;*/
    }

    .filter ul li.active a:after {
        content: "";
        display: table;
        width: 100%;
        height: 1px;
        background: #f92552;
        position: absolute;
        left: 0;
        bottom:-1px;
        z-index: 999;
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

      .btn-follow {
          float: right;
          background: #f92552;
          padding: 6px 28px 6px 54px;
          display: table;
          color: #fff;
          clip-path: polygon(30% 0,100% 0,100% 100%,0 100%);
          text-align: center;
          position: absolute;
          top: 0;
          right: 0;
          text-transform: uppercase;
      }
  
      .btn-box {
        margin: 50px 0 10px;
      }

      .no-style {
        text-decoration: none;
        color: #fff;
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

            <div id="data" class="mobilelivebetting">
                <div class="tournaments-wrapper">
                   <div class="main-title"> Browse Tournaments </div>
                      <div class="top-bar">                          
                         <div class="game-choose-box">
                            <div class="box-title"> Choose your Game</div>
                            <ul>
                              @php
                                if(isset($categories)):
                                  foreach ($categories as $category) {
                              @endphp
                                <li>
                                  <a href="{{url('live-betting').'/'.$category->id}}"> 
                                    <div class="game-box-inner"> 
                                       <img src="{{url('storage/category').'/'.$category->image}}"> 
                                      <!-- <img src="http://localhost:8000/assets/images/no-image65.png"> -->
                                      
                                    </div>
                                  </a> 
                                </li>
                              @php
                                  }
                                endif;
                              @endphp
                            </ul>
                         </div>                    
                      </div>

                      <div class="top-tab-bar clearfix">                         
                             <div class="col-sm-3">
                                <div class="tab-dropdowns"> 
                                   {{-- <ul class="list-inline">
                                       <li> <a href=""> Gloabl <span class="caret"></span></a> </li>
                                       <li> <a href=""> Any Formate <span class="caret"></span></a></li>
                                   </ul> --}}
                                   &nbsp;
                                </div>
                             </div>
                             <div class="col-sm-9">
                                  {{-- <div class="custom-range">
                                   <a href=""> Custome Range</a>
                                 </div>
                                 <div class="filter">
                                    <ul class="filter-menu list-inline">
                                          <li class="active"><a href="#Today">Today</a></li>
                                          <li><a href="#Week">This Week</a></li>
                                          <li><a href="#Weekend">This Weekend</a></li>
                                    </ul>
                                 </div> --}}
                                 &nbsp;
                             </div>
                      </div>

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
            </div>
              <!-- secon main row end here -->
             
            </div>
           
            <div class="posts posts--cards post-grid post-grid--2cols post-grid--fitRows row"> 

            </div>
         </div>
@endsection

@section('script_bottom')
<script type="text/javascript" charset="utf-8" >
  
</script>
@endsection
@section('script')
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


  $('#live-event-data').on('click', '.bg-color', function(e) {
      console.log('cjeck');
      if($(this).hasClass("pink")){
          $(this).removeClass('pink')
      }else{
          $(this).addClass('pink');
      }
    });


  $(document).ready(function(){
    getLiveEvent()
     setInterval(function(){ getLiveEvent()},1000*10 );
      getUpcomingEvent()
     setInterval(function(){ getUpcomingEvent()},1000*10 );
  });

  function toggleFollow(id)
  {
    $.ajax({
      type:'get',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
      url: '/toggle-follow/'+id,
      success: function(data){
        if(data == 0)
        {
          $('#tf-'+id).html("Follow");
        }
        else
        {
          $('#tf-'+id).html("Following");
        }
      }
    });
  }

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
                          // console.log(liveevents.length);
                            for(var j=0;j<liveevents.length;j++)
                            {
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
                                              <div class="box bg-color" onclick="update_odd(this)" odd-select="1" odd-val="'+liveevents[j]['odds']+'" odd-id="'+liveevents[j]['id']+'" odd-name1="'+liveevents[j]['team1']['name']+'" odd-name2="'+liveevents[j]['team2']['name']+'" odd_title="Match Winner">\
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
    var events='';
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
                              events+='<div  class="container headercontainer"><div class="eventnamehome displyrow">'+responseData[i]['event_name']+'</div> <div class="firstlatterhome displyrow">  <center> 1 </center> </div> <div class="secondlatterhome displyrow"> <center>X</center></div>  <div class="thirdlatterhome displyrow"> <center> 2</center> </div>  </div>';
                             events+='<div class="container" style="background:white; width: 100%; padding-top: 8px;padding-bottom: 8px; border-top:1px solid #1e202f;">  <div class="livenumber displyrow">  <span class="ptexdtinnerlive">3<br>5</span> </div><div class="event-timelive displyrow"> <span class="ptexdtinnerlive">  '+upcomingevents[j]['team1']['name']+'<br>'+upcomingevents[j]['team2']['name']+' </span> </div>';
                             events+=' <div class="firstlatter displyrow livebetbutton">  <div class="btn-group margin-20" data-toggle="buttons">  <label class="btn btn-primary customlabel"  onclick="update_odd(this)" odd-select="1" odd-val="'+upcomingevents[j]['odds']+'" odd-id="'+upcomingevents[j]['id']+'" odd-name1="'+upcomingevents[j]['team1']['name']+'" odd-name2="'+upcomingevents[j]['team2']['name']+'"> <input type="checkbox"> '+upcomingevents[j]['odds']+' </label> <label class="btn btn-primary customlabel" onclick="update_odd(this)" odd-select="1" odd-val="'+upcomingevents[j]['draw']+'" odd-id="'+upcomingevents[j]['id']+'" odd-name1="'+upcomingevents[j]['team1']['name']+'" odd-name2="'+upcomingevents[j]['team2']['name']+'" >   <input type="checkbox"> '+upcomingevents[j]['draw']+'</label><label class="btn btn-primary customlabel" onclick="update_odd(this)" odd-select="1" odd-val="'+upcomingevents[j]['odds2']+'" odd-id="'+upcomingevents[j]['id']+'" odd-name1="'+upcomingevents[j]['team1']['name']+'" odd-name2="'+upcomingevents[j]['team2']['name']+'"> <input type="checkbox">'+upcomingevents[j]['odds2']+'</label></div></div>';
                             events+=' <div class="displyrow lastbutton1"><div class="btn-group" data-toggle="buttons">  <label class="btn btn-primary customlabel" ><input type="checkbox"> +'+upcomingevents[j]['oddcount'].length+' </label></div></div></div>';
                            }
                          }
                        }
                    }
                    else
                    {
                        events="<div>No upcoming event found.</div>";
                    }
                    $("#upcoming-event-data").html(events);
                   
                }
            });
  }
</script>
@endsection