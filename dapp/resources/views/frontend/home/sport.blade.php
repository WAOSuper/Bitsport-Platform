@extends('frontend.layouts.master')
@section('title') BitSport &trade; | Peer to Peer competitive eSports platform @endsection
  @section('head')
  <meta name="csrf_token"  content="{{ csrf_token() }}" />
  @endsection
@section('content')
<div class="content col-md-9">
            <!-- Posts Area 1 -->
            <!-- Latest News -->
            @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            <div class="card card--clean mb-0 mainsectionbg">
              
              <div class="center">
                <select name="sources" id="sources"  class="custom-select sources" placeholder="Select Date" onchange="getEventByDate(this,this.value)">
                @foreach($day_arr as $day)
                  <?php 
                      $nameOfDay = date('D', strtotime($day));
                  ?>
                  <option value="{{$day}}">{{ $nameOfDay}} {{$day}}</option>
                  @endforeach
                </select>
              </div>
            </br>

            <div id="eventdata">
            
            </div>
              <!-- secon main row end here -->
            </div>  
           
              <div class="posts posts--cards post-grid post-grid--2cols post-grid--fitRows row">
              </div>
          </div>

@endsection

@section('script_bottom')
<script type="text/javascript">
  $('#eventdata').on('click', '.bg-color', function(e) {
      console.log('cjeck');
      if($(this).hasClass("pink")){
          $(this).removeClass('pink')
      }else{
          $(this).addClass('pink');
      }
    });

  var interval = null;
  var baseurl = window.location.origin;
  console.log(baseurl);



$(document).ready(function(){
    var test = '<?php echo json_encode($eventmaster); ?>';
    var data = $.parseJSON(test,true);

    eventData(data);
    if(interval)
        clearInterval(interval);
    interval = setInterval(function(){ eventData(data) }, 6000);
  });
    function getEventByDate(elem,day)
    {
        $(".date-badge").removeClass('active');
       // $(elem).addClass('active');
        var path=window.location.pathname;

        $.ajax({
                type:'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            url:"{{url('getdata-day-wise')}}",
                data: {'day': day,'path': path},
                success: function (responseData) {
                    if(responseData)
                    {
                        eventData(responseData);
                        if(interval)
                            clearInterval(interval);
                        interval =setInterval(function(){ eventData(responseData) }, 6000);
                    }
                    else
                    {
                        $('#eventdata').html('');
                        $('#eventdata').html('<h1> Records Not Found !!</h1>');
                    }
                }
            });
    }
function eventData(responseData)
{
    $('#eventdata').html('');
        var htmldata = '';
        $.each(responseData['master'], function( key, value ) {

             $.each(responseData['event'], function( ekey,   evalue) {
                if(value['id'] == evalue['event_master_id']){
                    var elem = "#timer_ekey"+evalue['id'];
                    var date2 = new Date(evalue['start_date']);
                    var date1 = new Date();   
                    

                    var diff = (date2 - date1)/1000;
                    var diff = Math.abs(Math.floor(diff));

                    var days = Math.floor(diff/(24*60*60));
                    var leftSec = diff - days * 24*60*60;

                    var hrs = Math.floor(leftSec/(60*60));
                    var leftSec = leftSec - hrs * 60*60;

                    var min = Math.floor(leftSec/(60));
                    var leftSec = leftSec - min * 60;
                   
                    var oddcount=evalue['oddcount'].length;
                    var subcat  = (evalue['subsubcat'] != null) ? evalue['subsubcat']['name'] : 0 ;

                    if(date2 < date1){
                    htmldata += '<br><br><div class="row">\
                                    <div class="col-md-7">\
                                      <div class="features-sports">\
                                        <p>'+evalue['start_date']+'</p>\
                                        <a href="/event-odds/'+evalue['id']+'" class="team-section">'+value['event_name']+'</a>\
                                        <div>\
                                          <a href="/event-odds/'+evalue['id']+'" class="watch"></i><span class="badge badge-live" >Live</span></a>\
                                          <p class="country">'+evalue['team1']['name']+'-'+evalue['team2']['name']+'</p>\
                                        </div>\
                                      </div>\
                                      <a href="'+'/event-odds/'+evalue['id']+'" class="total-mark">+'+oddcount+'</a>\
                                    </div>';
                    }else{
                      htmldata += '<br><br><div class="row">\
                                    <div class="col-md-7">\
                                      <div class="features-sports">\
                                        <p>'+evalue['start_date']+' Start In : '+hrs+' hrs'+'  '+min+' mints</p>\
                                        <a href="/event-odds/'+evalue['id']+'" class="team-section">'+value['event_name']+'</a>\
                                        <div>\
                                          <a href="/event-odds/'+evalue['id']+'" class="watch"></i>Not started</a>\
                                          <p class="country">'+evalue['team1']['name']+'-'+evalue['team2']['name']+'</p>\
                                        </div>\
                                      </div>\
                                      <a href="'+'/event-odds/'+evalue['id']+'" class="total-mark">+'+oddcount+'</a>\
                                    </div>';
                    }

                        htmldata += '<div class="col-md-5">\
                                      <div class="row winr-list">\
                                        <div class="col-md-4">\
                                          <div class="box bg-color" onclick="update_odd(this)" odd-select="1" odd-val="'+evalue['odds']+'" odd-id="'+evalue['id']+'" odd-name1="'+evalue['team1']['name']+'" odd-name2="'+evalue['team2']['name']+'" odd_title="Match Winner">\
                                            <span >'+evalue['team1']['name']+'</span>\
                                            <span class="list-one d-inline-block">'+evalue['odds']+'</span></i>\
                                          </div>\
                                        </div>\
                                        <div class="col-md-4">';
                                        if(evalue['draw']){
                                          htmldata +='<div class="box bg-color" onclick="update_odd(this)" odd-select="2" odd-val="'+evalue['draw']+'" odd-id="'+evalue['id']+'" odd-name1="'+evalue['team1']['name']+'" odd-name2="'+evalue['team2']['name']+'" odd_title="Match Winner">\
                                            <span >Draw</span>\
                                            <span class="list-one">'+evalue['draw']+'</span>\
                                          </div>';
                                          }else{
                                            htmldata +='<div class="box bg-color">\
                                            </div>';
                                          }
                                        htmldata +='</div>\
                                        <div class="col-md-4">\
                                          <div class="box bg-color" onclick="update_odd(this)" odd-select="3" odd-val="'+evalue['odds2']+'" odd-id="'+evalue['id']+'" odd-name1="'+evalue['team1']['name']+'" odd-name2="'+evalue['team2']['name']+'" odd_title="Match Winner">\
                                            <span >'+evalue['team2']['name']+'</span>\
                                            <span class="list-one">'+evalue['odds2']+'</span>\
                                          </div>\
                                        </div>\
                                      </div>\
                                    </div>\
                                  </div>\
                                </div>';

                    }
                });
             htmldata +='</div>';
        });
        $('#eventdata').html(htmldata);
        $(".timer").trigger("click");
}
</script>
@endsection