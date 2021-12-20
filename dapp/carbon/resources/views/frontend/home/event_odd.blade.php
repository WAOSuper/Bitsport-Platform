@extends('frontend.layouts.master')
@section('title') {{ @$team_data->Master->event_name }} @endsection
@section('content')

<style type="text/css"> .active1 .selection{ background-color: #f92552 !important; color:white !important; } .selectlable{ display: inline; }.selection-name{display: inline-block;}.selection{float: right;} 
    .customlabel{
        min-width:100%;
        max-height: 15px;
    }

    .small-pic {
        width: 35px;
        height: 35px;
        display: inline-block;
    }

    .small-pic img {
        max-width: 100%;
    }

    .event-creator h4 {
        font-size: 14px;
        display: inline-block;
        font-style: normal;
    }

    .event-creator {
        padding-right: 9px;
        margin-bottom: 15px;
    }

    .score-handler .input-group {
        width:80%;
    }

    button.qtyplus {
        position: absolute;
        background: #1e202f;
        border: none;
        color: #fff;
        padding:10px 24px;
        border-bottom-right-radius: 4px;
        border-top-right-radius: 4px;
    }
    .score-handler:first-child {
        padding: 0 15px 0 30px;
    }
    .score-handler:last-child {
        padding: 0 30px 0 15px;
    }

    .score-handler .input-group .form-control {
        height: 35px;
    }

  button.qtyplus1 {
        position: absolute;
        background: #1e202f;
        border: none;
        color: #fff;
        padding:10px 24px;
        border-bottom-right-radius: 4px;
        border-top-right-radius: 4px;
    }

    .score-handler-section .btn-submit {
        margin-top:18px;
        background: #f92552;
        color: #fff;
        font-size: 14px;
    }

    .btn-card {
      background: #323150;
      padding: 10px;
      border-radius: 3px;
    }
    a.btn-join {
      background: #f92552;
      display: block;
      border-radius: 5px;
      text-align: center;
      color: #fff;
      padding: 6px 2px;
      font-size: 14px;
    }

</style>
<input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">
<div class="col-12  col-md-8 col-lg-9 nopadding">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="inner-page">
        <div class="card card--clean mb-0 mainsectionbg">
            <div class="event-toggle">
                <div class="event-third">
                    <div class="match_img" style="display: none">
                        <img src="{{url('/')}}/assets1/skysports-romelu-lukaku-joe-root-lewis-hamilton-owen-farrell-britt-assombalonga_4136046.jpg" width="100%">
                    </div>
                    <div class="bottom-btn">
                    <button class="show_img">
                        <i class="fa fa-angle-down" aria-hidden="true"></i> </button> &nbsp;<span>Watch Live</span>
                    </div>
                    <div class="bottom-img">
                       <!--  <img src="https://www.nassm.com/sites/default/files/randomslide/15.jpg" width="100%"> -->
                         <?php   //if (array_key_exists('url', $video)) {
                          if($team_data->twitch_url) {
                                $whatIWant = substr($team_data['twitch_url'], strpos($team_data['twitch_url'], "tv/") + 3); 
                         ?>
                             <iframe width="100%" height="315" src="https://player.twitch.tv/?channel=<?php echo $whatIWant; ?>" frameborder="0" allowfullscreen> </iframe>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!--  -->
            <div class="event-details">
                <div class="clearfix event-creator">
                    <div class="pull-left">
                        <h3>{{ @$team_data->Master->event_name }}</h3>
                        @if($user && ($team_data->team1->name === $user->username || $team_data->team2->name === $user->username))
                            @if($team_data->team1->name === $user->username && $event->team_1_check_in === 1)
                                <span>You are already Checked in for this event</span>
                            @elseif($team_data->team2->name === $user->username && $event->team_2_check_in === 1)
                                <span>You are already Checked in for this event</span>
                            @else
                            <div class="btn-card">
                                <a href="javascript:void(0)"id="checkIn" class="btn-join" data-id="{{$event->id}}" >Check In</a>
                            </div>
                            @endif
                        @endif
                    </div>
                <div class="pull-right">
                    <h4>{{ @$team_data->User->first_name." ".@$team_data->User->last_name }}</h4>
                     <span class="small-pic">
                        @if(@$team_data->User->profile)
                        <img alt="" class="img-circle" src="{{url('/')}}/assets/images/profile/{{@$team_data->User->profile}}" /> </a>
                    @else
                        <img alt="" class="img-circle" src="{{url('/')}}/assets/images/profile/default.png" /> </a>
                    @endif
                     </span>
                    @if($role == "moderator")
                    <button data-id="{{@$team_data->User->id}}" id=follow>{{@$followLabel}}</button>
                    @endif
                </div>
                </div>
                <div class="accordion" id="accordionExample">
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h5 class="mb-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" >
                        <a class="parentClass " type="button" >
                          Match Winner
                          <i class="fa fa-chevron-right" aria-hidden="true"></i> 
                        </a>
                      </h5>
                    </div>
                    <div id="collapseOne" class="collapse in" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">1x2</h5>
                        </div>
                      <div class="card-body row">
                        <div class="col-md-4">
                          <input type="checkbox" class="hidden">
                            <div class="bg-color" onclick="update_odd(this)" odd-select="1" odd-val="{{$team_data->odds}}" odd-id="{{$team_data->id}}" odd-name1="{{ $team_data->team1->name }}" odd-name2="{{ $team_data->team2->name }}" odd_title="Match Winner"">
                                <a href="#" class="box-collapse"> {{ @$team_data->Team1->name }}</a>
                                <span class="odd1">{{ number_format($team_data->odds,2) }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <input type="checkbox" class="hidden">
                            <div class="bg-color"   onclick="update_odd(this)" odd-select="2" odd-val="{{$team_data->draw}}" odd-id="{{$team_data->id}}" odd-name1="{{ $team_data->team1->name }}" odd-name2="{{ $team_data->team2->name }}" odd_title="Match Winner">
                                <a href="#" class="box-collapse"> Draw</a>
                                <span class="draw">{{ number_format($team_data->draw,2) }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                           <input type="checkbox" class="hidden"> 
                           <div class="bg-color"   onclick="update_odd(this)" odd-select="3" odd-val="{{$team_data->odds2}}" odd-id="{{$team_data->id}}" odd-name1="{{ $team_data->team1->name }}" odd-name2="{{ $team_data->team2->name }}" odd_title="Match Winner">
                                <a href="#" class="box-collapse"> {{ @$team_data->Team2->name }}</a>
                                <span class="odd2">{{ number_format($team_data->odds2,2) }}</span>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="odds_event">
                    <?php $i=1; $j=1; ?>
                    @foreach($oddMaster as $master)
                      <div class="card">
                          <div class="card-header" id="{{$master->odd_title}}">
                            <h5 class="mb-0" data-toggle="collapse" data-target="#{{$master->id}}" aria-expanded="true" aria-controls="{{$master->id}}" >
                              <a class="parentClass" type="button" >
                                {{$master->odd_title}} 
                                <i class="fa fa-chevron-right" aria-hidden="true"></i> 
                              </a>
                            </h5>
                          </div>
                          <div id="{{$master->id}}" class="collapse" aria-labelledby="{{$master->odd_title}}" data-parent="#accordionExample">
                            <div class="card-body">
                              <div class="card-body row">
                                @foreach ($odds as $key) 
                                      <?php  $cond = ($key->event->team_1_id == $key->team_id) ? 1 : 3; ?>
                                    @if($master->id == $key->odd_id)
                                      <div class="col-md-6">
                                          <input type="checkbox" class="hidden">
                                          <div class="bg-color" onclick="update_odd(this)" odd-select="{{$cond}}" odd-val="{{$key->odd}}" odd-id="{{$key->event->id}}" odd-name1="{{$key->event->team1->name}}" odd-name2="{{$key->event->team2->name}}" odd-name="{{$key->name}}" more-id="{{$key->id}}" odd_title="{{$master->odd_title}}">
                                              <a href="#" class="box-collapse team_name" style="display: none;"> {{$key->teamName->name}}</a>
                                              <span>{{ $key->name }} &nbsp;</span> <span  id="id-{{$i}}-{{$j}}">{{ number_format($key->odd,2)}}</span>
                                          </div><br>
                                      </div>
                                      <?php $j++; ?>
                                    @endif
                                  @endforeach
                             </div>
                            </div>
                          </div>
                      </div>
                      <?php $i++; ?>
                  @endforeach

                  @if($user && ($user->is_curator || $user->curating_now))
                   <form id='myform' method='POST' action="{{url('score')}}">
                     <input type="hidden" name="_token" value="{{csrf_token()}}">
                       <div class="row score-handler-section">
                           <div class="col-sm-4 score-handler">
                            <div> Team 1 score </div>
                              <div class="input-group">
                                 <input class="form-control" type='text' name='score' value='{{$event->team_1_score}}' class='qty' readonly="readonly" />
                                 <button type='button' value='+' class='qtyplus' field='score'><i class="fa fa-plus"> </i> </button>
                                 <input type="hidden" name="event_id" value="{{$id}}">
                                  @if(isset($user->id))
                                   <input type="hidden" name="user_id" value="{{$user->id}}">
                                   @endif
                                <input type="hidden" name="team_id" value="{{$team_data->team1->id}}">
                              </div>
                           </div>
                           <div class="col-sm-4 text-center">
                              <button class="btn btn-submit" type='submit' value="submit"> Submit </button>
                           </div>
                           <div class="col-sm-4 score-handler">
                            <div>Team 2 score</div>
                              <div class="input-group">
                                <input class="form-control" type='text' name='score1' value='{{$event->team_2_score}}' class='qty1' readonly="readonly" />
                                <button type='button' value='+' class='qtyplus1' field11='score1'><i class="fa fa-plus"> </i> </button>
                                <input type="hidden" name="team_id1" value="{{$team_data->team2->id}}">
                                  <input type="hidden" name="event_id1" value="{{$id}}">
                                  @if(isset($user->id))
                                  <input type="hidden" name="user_id1" value="{{$user->id}}">
                                  @endif
                              </div>
                           </div>
                       </div>
                    </form>
                     @endif
                </div>
                <hr>

            </div>
           <!--  <div  <div class="container" style="width: 100%; padding-top: 20px;"></div>
            <div id="show_more">
            </div>
            <button class="btn btn-success" style="float:right;" id="moreodds" onclick="show_more({{@$team_data->id }})">Show More Odds    
                &nbsp;&nbsp; <span class="badge badge-info" style="display: inline-block;">+ {{ $team_data->oddcount->count() }} </span>
            </button>   
            <div class="clearfix"></div> -->
        </div>
    </div>
</div>

@endsection

@section('script_bottom')

<script>
    $(".show_img").click(function(){
        $(".match_img").toggle("slow");
    })
</script>

<script type="text/javascript">

    $(document).ready(function(){

      setInterval(function(){ event_odd()},1000 );
      setInterval(function(){ odds_ajax() }, 1000 );
        $("#follow").click(function(){
            var userid = $(this).attr("data-id");
            $.ajax({
            url: "/follow/"+ userid,
            type:'get',
            data: {},
            success: function(result)
            {
                console.log(result);
                $("#follow").html(result);
            }
         });
        });
       //odds_ajax();

 /* score plus method*/
    $('.qtyplus').click(function(e){
        e.preventDefault();
    
        fieldName = $(this).attr('field');
       
        var currentVal = parseInt($('input[name='+fieldName+']').val());
      
        if (!isNaN(currentVal)) {
  
            $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
            $('input[name='+fieldName+']').val(0);
        }
    });

    $('.qtyplus1').click(function(e){
        e.preventDefault();
        fieldName = $(this).attr('field11');
       
        var currentVal = parseInt($('input[name='+fieldName+']').val());
      
        if (!isNaN(currentVal)) {
  
            $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
            $('input[name='+fieldName+']').val(0);
        }
    });

    $('#checkIn').click(function(e){
        var eventId = $(this).data('id');
        e.preventDefault();
        $.ajax({
            url: "/check-in/"+ eventId,
            type:'get',
            data: {},
            success: function(result)
            {
                $('#checkIn').html(result)
                $('#checkIn').after('<span>'+ result +'</span>')
                $('#checkIn').remove()
            }
        });
    });

    });

  function event_odd(){
    // console.log("odd update<br>");
    var event_id = parseInt(({{ $team_data->id }}));
    var _token=$("#_token").val();
      var url = '{{ url("event-odd") }}';

         $.ajax({
            url: url,
            type:'post',
            data: { '_token' : _token, 'event_id':event_id },
            success: function(result)
            {
                // console.log(result);
                $('.odd1').empty();
                $('.draw').empty();
                $('.odd2').empty();
                $('.odd1').append((result['odds']).toFixed(2));
                $('.draw').append((result['draw']).toFixed(2));
                $('.odd2').append((result['odds2']).toFixed(2));
                // $('.odd1').attr("odd-val",(result['odds']).toFixed(2));
                // $('.draw').attr("odd-val",(result['draw']).toFixed(2));
                // $('.odd2').attr("odd-val",(result['odds2']).toFixed(2));
             }
         });
  }

  function odds_ajax()
  {
    var event_id = parseInt(({{ $team_data->id }}));
    var _token=$("#_token").val();
      var url = '{{ url("odd-price") }}/{{ $team_data->id }}';
      var odds = '';
         $.ajax({   
            url: url,   
            type:'post',
            data: { '_token' : _token, 'event_id':event_id },
            success: function(result)
            { 
              // console.log(result);
              var odds = result['odds'];
              var oddsMaster = result['oddsMaster'];
              var i=1;
              var j=1;
              $.each(oddsMaster, function( index, master ) {
                $.each(odds, function( ind, key ) {
                  if(master['id'] == key['odd_id']){
                    // console.log('id-'+i+'-'+j+' val:'+key['odd']);
                    $('#id-'+i+'-'+j).empty();
                    $('#id-'+i+'-'+j).append((key['odd']).toFixed(2));
                    j++;
                  }
                });
                //$('.odd_title').attr('id',value.id);
                i++;
              });
                // $('.odds_event').html(result);          
            } 
         }); 
  }
  
    // var callvalue = 1;
    //   function show_more(id) 
    //   {
    //     var _token=$("#_token").val();
    //       var url = '{{ url("more_show") }}';

    //         $.ajax({
    //             url: url,   
    //             type:'post',
    //             data: { '_token' : _token, 'event_id':id },
    //             success: function(result)
    //             { 
    //               // console.log(result);
    //                 $('#show_more').html('');
    //                 $('#moreodds').hide();
    //                 $('#show_more').html(result);
    //             } 
    //         });
    //         // console.log(callvalue+' cheking');
    //     if(callvalue==1){
    //         setInterval(function(){ show_more(id) }, 6000);
    //          callvalue = 0;                      
    //     }
    //   }
      
    $('.enabled').on('click', function(e) {
        //alert();
      //$('.enabled').toggleClass('active');
    });

</script>
<script type="text/javascript">
    $('#myCollapsible').collapse({
      toggle: false
    })

    $(document).ready(function(){
        if($('.collapse').hasClass( "in" )){
            $(this).parent().addClass('bord-top');
        }
        $('.bg-color').click(function(e){
            // if($(this).hasClass("pink")){
            //     $(this).removeClass('pink')
            // }else{
            //     $(this).addClass('pink');
            // }
        });
        $('.mb-0').click(function(e){
            if($(this).hasClass( "collapsed" )){
                $(this).parent().parent().addClass('bord-top');
            }else{
                $(this).parent().parent().removeClass('bord-top');
            }
        });
    });
</script>
@endsection



