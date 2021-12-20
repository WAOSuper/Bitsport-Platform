@extends('frontend.layouts.master')
@section('content')
  <style type="text/css">
.active1 .selection{
    background-color: #f92552 !important;
    color:white !important;
}
.selectlable{
 display: inline;   
}
.selection-name{display: inline-block;}.selection{float: right;}</style>
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
                            <button class="show_img"><i class="fa fa-angle-down" aria-hidden="true"></i> </button> &nbsp;<span>Watch Live</span>
                            </div>
                            <div class="bottom-img">
                               <!--  <img src="https://www.nassm.com/sites/default/files/randomslide/15.jpg" width="100%"> -->
                                 <?php   if (array_key_exists('url', $video)) { 
                                        $whatIWant = substr($video['url'], strpos($video['url'], "tv/") + 3); 
                                 ?>
                                     <iframe width="100%" height="315" src="http://player.twitch.tv/?channel=<?php echo $whatIWant; ?>" frameborder="0" allowfullscreen> </iframe>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <div class="container" style=" width: 100%;">
                        <div class="container" style="margin-top: 24px;">
                           <span class="headertexttop">{{ @$team_data->Team1->name }} vs {{ @$team_data->Team2->name }}</span>
                        </div>
                        <hr>
                    </div>

                        <!--  -->
                    <div class="container" style="width: 100%; padding-top: 8px;">
                        <div class="content">
                            <div class="event-details-market">
                                <div class="ttl-event-detail headertexttop"><h1>{{@$oddMaster->odd_title}}</h1></div>
                            </div>
                        </div>
                    </div>
                    <div class="container" style="background:white; width: 100%;">
                        <div class="content">
                            
                            <div class="event-details-market">
                                <div class="selections-container">

                                    <div class="cell col-md-4 enabled" for="radio1">
                                   
                                        <div class="selection-name">{{ @$team_data->Team1->name }}</div>  <label class="selectlable"> <input type="checkbox" name="radio1" value="radio2" class="eventoddcheckbox">
                                        <span class="selection odds odd1" onclick="update_odd(this)" odd-select="1" odd-val="{{$team_data->odds}}" odd-id="{{$team_data->id}}" odd-name1="{{ $team_data->team1->name }}" odd-name2="{{ $team_data->team2->name }}"  odd_title="{{@$oddMaster->odd_title}}"> 

                                            <div id="odd1">{{ number_format($team_data->odds,2) }}</div>

                                        </span>
                                          </label>
                                    </div>
                                    @if($team_data->draw)
                                    <div class="cell col-md-4 enabled"> 
                                        <div class="selection-name">draw</div><label class="selectlable"><input type="checkbox" name="radio1" value="radio2" class="eventoddcheckbox">
                                        <span class="selection odds draw" onclick="update_odd(this)" odd-select="2" odd-val="{{$team_data->draw}}" odd-id="{{$team_data->id}}" odd-name1="{{ $team_data->team1->name }}" odd-name2="{{ $team_data->team2->name }}" odd_title="{{@$oddMaster->odd_title}}">

                                            <div id="draw">{{ number_format($team_data->draw,2) }}</div>
                                        </span>
                                         </label>
                                    </div>
                                    @else
                                    <div class="cell col-md-4 enabled">
                                        <label class="selectlable"><input type="checkbox" name="radio1" value="radio2" class="eventoddcheckbox">
                                        <div class="selection-name">draw</div>
                                        <span class="selection">
                                            <div> - </div>
                                        </span>
                                          </label>
                                    </div>
                                    @endif
                                    <div class="cell col-md-4 enabled">
                                         
                                        <div class="selection-name">{{ @$team_data->Team2->name }}</div> <label class="selectlable"><input type="checkbox" name="radio1" value="radio2" class="eventoddcheckbox">
                                        <span class="selection odds odd2" onclick="update_odd(this)" odd-select="3" odd-val="{{$team_data->odds2}}" odd-id="{{$team_data->id}}" odd-name1="{{ $team_data->team1->name }}" odd-name2="{{ $team_data->team2->name }}" odd_title="{{@$oddMaster->odd_title}}">
                                            <div id="odd2">{{ number_format($team_data->odds2,2) }}</div>
                                        </span>
                                        </label>
                                    </div>
                                    
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                <div id="show_more">                   
                </div>
                
                <br>
                <button class="btn btn-success" style="float:right;" id="moreodds" onclick="show_more({{@$team_data->id }})">Show More Odds</button>   
                <div class="clearfix"></div>
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
      //  setInterval(function(){ event_odd() }, 6000 );
    });
  
  function event_odd(){
    var event_id = parseInt({{ $team_data->id }});
    var _token=$("#_token").val();
      var url = '{{ url("event-odd") }}';

         $.ajax({   
            url: url,   
            type:'post',
            data: { '_token' : _token, 'event_id':event_id },
            success: function(result)
            { 
                console.log(result);
                $('#odd1').empty();
                $('#draw').empty();
                $('#odd2').empty();
                $('#odd1').append((result['odds']).toFixed(2));
                $('#draw').append((result['draw']).toFixed(2));
                $('#odd2').append((result['odds2']).toFixed(2));
                $('.odd1').attr("odd-val",(result['odds']).toFixed(2));
                $('.draw').attr("odd-val",(result['draw']).toFixed(2));
                $('.odd2').attr("odd-val",(result['odds2']).toFixed(2));
             } 
         });
  }
  
    var callvalue = 1;
      function show_more(id) 
      {
        var _token=$("#_token").val();
          var url = '{{ url("more_show") }}';

            $.ajax({
                url: url,   
                type:'post',
                data: { '_token' : _token, 'event_id':id },
                success: function(result)
                { 
                    $('#show_more').html('');
                    $('#moreodds').hide();
                    $('#show_more').html(result);
                } 
            });
            console.log(callvalue+' cheking');
        if(callvalue==1){
            setInterval(function(){ show_more(id) }, 6000);
             callvalue = 0;                      
        }
      }
      
    $('.enabled').on('click', function(e) {
        //alert();
      //$('.enabled').toggleClass('active');
    });

</script>
@endsection



