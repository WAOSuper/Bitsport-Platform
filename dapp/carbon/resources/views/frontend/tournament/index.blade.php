@extends('frontend.layouts.master')
@section('title') BitSport &trade; | Peer to Peer competitive eSports Platform @endsection
@section('head')
  <meta name="csrf_token"  content="{{ csrf_token() }}" />
  @endsection
@section('content')
<link href="{{ URL::asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />

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

    .main-tab .tab-pane {
        padding: 15px 0;
    }

    .tab-content>.tab-pane {
      background: transparent;
    }

    .custom-tab.nav-tabs > li > a{
      border:none !important;
      border-bottom: 2px solid transparent !important;
    }

    .custom-tab li a {
      margin-right:0;
      line-height: 1.42857143;
      border-bottom: 2px solid transparent !important;
      border-radius: 0;
      color:#7e838c;
    }
    .custom-tab li.active a {
      background: none;
      border: none;
      color:#fff;
      border-bottom: 2px solid #f92552 !important;
    }

    .custom-tab li.active>a:focus{
      background:none;
      color:#fff;
    }

    .custom-tab li.active a:hover {
      background: none;
      border: none;
    }
    .custom-tab li a:hover {
      background: none;
      border: none;
      border-bottom: 2px solid #f92552 !important;
      margin: 0;
      color:#fff;
    }
    .banner-widget ~ .divider {
      margin-bottom: 0px;
      border-top: 1px solid #44454c;
    }

    .folder-tabs .tab-content>.tab-pane {
      padding: 15px 20px 1px !important;

    }

    .folder-tabs .nav-tabs {
       border-bottom: none;
     }

    .folder-tabs .nav-tabs li a {
      margin-right:0;
      line-height: 1.42857143;
      color: #7e838c;
      padding: 15px 30px;
    }
    .folder-tabs .nav-tabs li.active a {
      background: none;
      border: 1px solid #44454c;
      border-bottom:1px solid #1e202f;
      color:#fff;
    }

    .folder-tabs .nav-tabs li.active a:hover {
      background: none;
      border: 1px solid #44454c;
      border-bottom:1px solid #1e202f;
    }
    .folder-tabs .nav-tabs li a:hover {
      background: none;
      border: 1px solid transparent;
      margin: 0;
      color:#fff;
    }
    .tabs.folder-tabs .tab-content {
      border: 1px solid #44454c;
    }

    .detail-attribute h6 {
      font-size: 12px;
      font-weight: 300;
      color: #7e838c;
      margin: 0;
    }

    .detail-attribute h2 {
      font-size: 20px;
      font-weight: 300;
      margin-bottom: 8px;
    }

    .detail-attribute h4 {
      font-size: 13px;
      font-style: normal;
    }
    .detail-attribute ~ .divider {
      border-top: 1px solid #44454c;
      margin: 10px 0;
      display: block;
    }

     /* right-side -penal*/
    .right-panel {
      border-left: 1px solid #44454c;
      padding: 15px;
      height: 65vh;
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
      font-size: 16px;
    }
    .btn-card p {
      border-bottom: 1px solid #44454c;
      padding-bottom: 5px;
      margin-bottom: 10px;
    }
    p.registration-close {
      font-size:14px;
      color: #fff;
      text-transform: uppercase;
    }

    .counter {
        margin-bottom: 15px;
        color: #fff;
    }

      /* participants - Tab*/

    .participants-section-title {
        margin-bottom: 15px;
    }
    .participants-inner {
        vertical-align: middle;
        background: #323150;
        margin-bottom: 10px;
        position: relative;
    }

    .participants-inner:after {
        position: absolute;
        right: 0px;
        top: 0;
        content: "";
        height: 100%;
        width: 5px;
        background: #f92552;
    }

    .participants-icon {
        background: #fff;
        width: 35px;
        height: 35px;
        display: inline-block;
        vertical-align: middle;
    }

    .participant-info {
        display: inline-block;
        width: 240px;
        vertical-align: middle;
        padding-left: 10px;
    }

    /* BRACKETS */

    .ladder-header {
        padding: 15px 0;
    }

    .ladder-header h3 {
        margin-bottom: 0;
        font-style: normal;
    }

    .empty-message {
        border: 1px dashed #7e838c;
        padding: 20px;
    }

    .ladder-standings-table table tr td span:first-child {
        width: 25px;
        height: 25px;
        background: #fff;
        display: inline-block;
        border-radius: 30px;
        vertical-align: middle;
        margin-right: 5px;
    }
    .ladder-standings-table table tr td{
      font-size: 16px;
      color: #fff;
    }

    tr.bg-navy-400 {
        background: #323150;
    }

     /* States */

     .social-continer {
       text-align: right;
       padding: 15px 0;
     }

    .social-continer a {
      color: #f92552;
      padding: 0 5px;
    }

    .game-banner{
      background-size: cover;
      background-repeat: no-repeat;
      background-position: 50%;
      margin-bottom: 40px;
      min-height: 320px;
      padding: 20px 75px;
    }

    .banner-content {
      display: flex;
      justify-content: center;
      flex-flow: column;
      min-height: 269px;

  }

    .primary-header {
      font-size: 28px;
      color: #fff;
      line-height: 37px;
    }
    .secondry-header {
      text-transform: uppercase;
      font-size: 20px;
      color: #fff;
      margin-top: 15px;
    }


    .gpg-container {
        background: #323150;
        margin-top: 15px;
        border-radius: 4px;
        overflow: hidden;
    }

    .gpg-container .gpg-title {
        padding: 15px;
        text-align: center;
        color: #fff;
        font-size: 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
        background: #282840;
    }

    .gpg-avatar {
        background: #282840;
        width: 50px;
        height: 50px;
        margin: 5px;
        border-radius: 50px;
        line-height:50px;
    }

    .gpg-user {
        display: flex;
    }

    .gpg-user p {
      margin: 0;
      font-size: 16px;
      color: #fff;
      padding: 15px 0 15px 15px;
      flex: 1;
    }

    .gpg-user p .fa {
        vertical-align: middle;
        padding: 8px;
    }

    .gpg-title a {
        color: #fff;
        display: block;
    }
    .font-400 {
    font-weight: 400;
}
    .text-28px {
      font-size: 28px !important;
      text-transform: capitalize;
    }
    .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
  margin: 5px 10px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #ec2a52;
}

input:focus + .slider {
  box-shadow: 0 0 1px #ec2a52;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

.code-container {
  margin-bottom: 10px;
}

.invitation_code_div {
  margin-bottom: 10px;
}

#invitation_code {
  width: 100% !important;
  margin-top: 5px;
}

.code-container  {
  margin: 10px 0;
  padding: 10px ;
  background: #282840;
}

.code-container .gpg-title { 
    display: table;
    float: left;
    vertical-align: middle;
    margin-top: 10px;
    font-size: 16px;
    }

</style>

          <div class="content col-md-6">
          <h2 class="font-400 text-28px">{{$tournament->name}}</h2>
            <!-- Posts Area 1 -->
            <!-- Latest News -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div><br>@endif
              <div class="tabs main-tab">
                <ul class="nav custom-tab nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#overview">Overview</a></li>
                  <li><a data-toggle="tab" href="#participants">Participants</a></li>
                  <li><a data-toggle="tab" href="#brackets">Brackets</a></li>
                  <li><a data-toggle="tab" href="#media">Media</a></li>
                  <li><a data-toggle="tab" href="#stats">Stats</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane fade in active" id="overview">

                   <div class="banner-widget">
                    <!-- <img src="https://firebasestorage.googleapis.com/v0/b/battlefy-2f59d.appspot.com/o/user-imgs%2F58eb7da64162bb0342550b58%2F1544477764443.jpg?alt=media&token=60ca87d0-2122-478d-9025-161999f2a3c1"> -->
                     <img src="{{url('storage/galeryImages').'/'.$tournament->header_banner}}" />
                    <!-- <img src="http://localhost:8000/assets/images/no-image618.png"> -->

                    <img src="">
                   </div>
                     <hr class="divider">
                    <div class="tournament-about">About This Tournament</div>
                    <?php echo $tournament->about ?>
                    <div class="tabs folder-tabs">
                      <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#details">Details</a></li>
                        <li><a data-toggle="tab" href="#rules">Rules</a></li>
                        <li><a data-toggle="tab" href="#prizes">Prizes</a></li>
                        <li><a data-toggle="tab" href="#schedule">Schedule</a></li>
                        <li><a data-toggle="tab" href="#contact">Contact</a></li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane fade in active" id="details">
                          <div class="tournament-detail">
                            <div class="detail-attribute">
                              <h6> Tournament starts</h6>
                              <h2>{{$tournament->start_date_time->format('D, M d Y')}}</h2>
                              <h4>{{$tournament->start_date_time->format('H:i A')}}</h4>
                            </div>
                             <div class="divider"></div>
                            <div class="detail-attribute">
                              <h6> Format</h6>
                              <h2>1V1</h2>
                              <h4> @if($tournament->status == 0) <span>Player registration is allowed</span> @else
                                  <span>Registration is enabled</span>@endif
                              </h4>
                            </div>

                              <div class="divider"></div>
                            <div class="detail-attribute">
                              <h6>Platform</h6>
                              <h4>PlayStation 4 and Xbox</h4>
                            </div>
                          </div>
                         </div>
                        <div class="tab-pane fade" id="rules">
                          <?php echo $tournament->rules ?>
                        </div>
                        <div class="tab-pane fade" id="prizes">
                          <?php echo $tournament->prizes ?>
                        </div>
                        <div class="tab-pane fade" id="schedule">
                          {{$tournament->schedule}}
                        </div>
                        <div class="tab-pane fade" id="contact">
                          <?php echo $tournament->contact_details ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="participants">

                    @if($participant_count == 0)
                      <div class="empty-message">
                        Sorry, There's no participants joined yet.
                      </div>
                    @else
                      <div class="participants-section-title">
                         Players <span> {{$participant_count}} </span>
                      </div>
                      <div class="row">
                      @php
                        foreach($participants as $participant):
                      @endphp
                        <div class="col-md-6 participants">
                          <div class="participants-inner">
                            <div class="participants-icon">
                              @if($participant->user && $participant->user->profile)
                                <img alt="" class="img-circle" src="{{url('/')}}/assets/images/profile/{{$participant->user->profile}}" /> </a>
                              @else
                                  <img alt="" class="img-circle" src="{{url('/')}}/assets/images/profile/default.png" /> </a>
                              @endif
                            </div>
                            <div class="participant-info">{{($participant->user->username != "") ? $participant->user->username : $participant->user->first_name.' '.$participant->user->last_name}}</div>
                          </div>
                        </div>
                      @php
                        endforeach;
                      @endphp
                      </div>
                    @endif
                  </div>
                  <div class="tab-pane fade" id="brackets">
                      @if($tournament->status == 1)
                       <div class="empty-message">
                          Tournament hasn't started yet.
                           <p>Please standby!</p>
                       </div>
                    @else
                    @endif
                    @if($participant_count == 0)
                     <div class="empty-message">
                      There's no participants joined yet.
                     </div>
                     @else
                     <div class="ladder-standings">
                         <div class="ladder-header clearfix">
                           <h3> Standings</h3>
                         </div>
                         <div class="ladder-standings-table">
                              <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th> Rank</th>
                                        <th> Player</th>
                                        <th> MP</th>
                                        <th> W</th>
                                        <th> L</th>
                                        <th> T</th>
                                        <th> GP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @php
                                 foreach($participants as $participant):
                                  @endphp
                                  <tr class="bg-navy-400">
                                    <td> 1</td>
                                    <td>
                                      <span>
                                                                               @if($participant->user && $participant->user->profile)
                                          <img alt="" class="img-circle" src="{{url('/')}}/assets/images/profile/{{$participant->user->profile}}" /> </a>
                                        @else
                                          <img alt="" class="img-circle" src="{{url('/')}}/assets/images/profile/default.png" /> </a>
                                        @endif

                                      </span>
                                                                            <span>{{($participant->user->username != "") ? $participant->user->username : $participant->user->first_name.' '.$participant->user->last_name}}</span>

                                    </td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                  </tr>
                                   @php
                                endforeach;
                              @endphp
                                </tbody>
                              </table>
                         </div>
                     </div>
                     @endif
                  </div>
                  <div class="tab-pane fade" id="media">
                    @if($tournament->status == 1)
                      <div class="empty-message">
                        There is currently no media available.
                      </div>
                    @else
                      {{-- Show Media --}}
                    @endif
                  </div>
                  <div class="tab-pane fade" id="stats">
                   <!--  <div class="stats-section-title">
                       DURI STATS
                    </div> -->
                 <!--    <div class="social-continer">
                        <span> Share states :</span>
                        <a href="#"> <i class="fa fa-link"></i></a>
                        <a href="#"> <i class="fa fa-facebook"></i></a>
                        <a href="#"> <i class="fa fa-google-plus"></i></a>
                        <a href="#"> <i class="fa fa-reddit"></i></a>
                    </div> -->
<!--
                    <div class="game-banner" style="background-image: url(https://d33jl3tgfli0fm.cloudfront.net/helix/images/games/league-of-legends/stats-header.jpg)">
                      <div class="banner-content">
                        <div class="organizer-badge">

                        </div>
                        <div class="primary-header">
                           ESG - LATIN AMERICA SOUTH / MINI LADDER
                        </div>
                        <div class="secondry-header">
                          STATISTICS BY BATTLEFY
                        </div>
                      </div>
                    </div> -->
                      @if($tournament->status == 1)
                      <div class="empty-message">
                    Stats will be available once the tournament starts or when matches get score reported.
                    </div>
                    @else
                    <div class="empty-message">
                    Stats will be available once the tournament starts or when matches get score reported.
                    </div>
                    @endif
                  </div>
                </div>
              </div>
          </div>

          <div class="col-md-3">
             <div class="right-panel">
              <div class="counter">
                @if($participant_count > 0)
                {{$participant_count}} Players Registered
                @else
                  No Players Registered Yet
                @endif
              </div>
              @if($tournament->status == 1 && $tournament->player_limit > $participant_count)
                 <div class="gpg-container">
                    <div class="gpg-title"> <a href="#"> Entry Token </a> </div>
                    <div class="gpg-user">
                       <div class="gpg-avatar">
                         <img src="{{url('/')}}/assets/images/coin_alpha.png" />
                       </div>
                       <p> ${{$tournament->fees * 0.18}} | {{$tournament->fees}} BTP <i class="fa fa-angle-right"></i> </p>
                    </div>
                </div>
                <div>
                  <div class="code-container" >
                    <div class="gpg-title"> Apply Entry Code </div>
                    <label class="switch">
                        <input type="checkbox" id="invite_code" name="invite_code" >
                        <span class="slider round"></span>
                      </label>
                      <div id="invitation_code_div" style="display:none">
                          <input type="text" onblur="addInvitationCode()" id="invitation_code" name="invitation_code" value="" >
                        </div>
                  </div>
                </div>
                {{-- <input type="checkbox" class="make-switch" name="invitation_code_button"  data-on-color="success" data-off-color="info"> --}}
               
                    <div class="btn-card">
                  @if(!$already_participant)
                    @if(Sentinel::check())
                        <a id="join_tournament" class="btn-join" href="{{url('tournament').'/'.$tournament->id.'/join-process'}}">Join Tournament</a>
                    @else
                        <a id="join_tournament" class="btn-join" href="{{url('register?tournament_id='.$tournament->id)}}">Join Tournament</a>
                    @endif
                  @else
                    <span>You have Already joined this tournament</span>
                  @endif
                </div>
              @else
                <div class="btn-card">
                  <p class="registration-close">Registration Closed</p>
                  <span>Registration to this tournament is closed. Please ask tournament organizer for details.</span>
                </div>
              @endif
            </div>
          </div>

        <!--   <div class="right-panel">

                <div class="btn-card">
                  <p>  {{$participant_count}} Players Registered</p>
                  <a class="btn-join" href="javascript:void(0);">Join Tournament</a>
                </div>

            </div> -->
          </div>
@endsection

@section('script_bottom')
<script type="text/javascript" charset="utf-8" >
</script>
@endsection
@section('script')
<script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function(){
  $("#invite_code").change(function(){
    $("#invitation_code_div").toggle()
  })
  // $('.make-switch')
  // .bootstrapSwitch()
  // .on('switchChange.bootstrapSwitch', function (e, state) {
  //     $("#invitation_code_div").toggle()
  // });
});

function addInvitationCode() {
  var url = $("#join_tournament").attr('href');
  var code = $("#invitation_code").val();
  if(url.indexOf('register') == -1) {
    url = url.concat("?code=" +  code);
  } else {
    url = url.concat("&code=" +  code);
  }
  $("#join_tournament").attr('href', url);
}

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
</script>
@endsection
