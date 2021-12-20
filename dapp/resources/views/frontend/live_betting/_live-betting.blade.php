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
              <div class="container" >
                  <span class="headertexttop">RIGHT NOW</span>
              </div>
              <hr>
              <div id="live-event-data">
                      <!-- <div  class="container headercontainer">
                          <div class="eventnamehome displyrow">Tennis - ITF Women: Antalya, Singles W-WITF-TUR-43A</div>
                          
                          <div class="firstlatterhome displyrow">
                            <center> 1 </center>
                          </div>
                          <div class="secondlatterhome displyrow">
                            <center>X</center>
                          </div>
                          <div class="thirdlatterhome displyrow">
                         <center> 2</center>
                          </div>
                      </div>
                      <div class="container" style="background:white; width: 100%; padding-top: 8px;padding-bottom: 8px; border-top:1px solid #1e202f;">

                          <div class="livenumber displyrow">
                              <span class="ptexdtinnerlive">3<br>5</span>
                          </div>
                          <div class="event-timelive displyrow">
                            <span class="ptexdtinnerlive">Austria: Bundesliga<br>Lask Linz V Wolfsberger Ac</span>
                          </div>

                          <div class="firstlatter displyrow livebetbutton">
                              <div class="btn-group margin-20" data-toggle="buttons">
                                  <label class="btn btn-primary customlabel" >
                                    <input type="checkbox"> 1.21
                                  </label>
                                  <label class="btn btn-primary customlabel">
                                    <input type="checkbox"> 8.23
                                  </label>
                                  <label class="btn btn-primary customlabel">
                                    <input type="checkbox"> 4.12
                                  </label>
                              </div>
                          </div>


                          <div class="displyrow lastbutton1">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-primary customlabel">
                                  <input type="checkbox"> + 3
                                </label>
                            </div>
                          </div>
                          

                      </div>
 -->
                     
              
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