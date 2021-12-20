@extends('frontend.layouts.master')
@section('title') BitSport &trade; | Peer to Peer competitive eSports Platform @endsection
@section('head')
  <meta name="csrf_token"  content="{{ csrf_token() }}" />
  @endsection
@section('content')
<link rel="stylesheet" type="text/css" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.3/css/bootstrap-select.min.css">
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

   .joinprocess-form-section .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
       width: 100%;
    }

    .joinprocess-form-section .bootstrap-select .btn-default {
        background: #383759;
        height: 51px;
    }

    .cust-check input[type="checkbox"] {
        display: block !important;
        top: 12px;
        width: 35px;
        height: 35px;
        margin: 0;
    }
    .joinprocess-form-section .checkbox {
        margin-top: 30px;
    }

    .styled-checkbox {
      position: absolute;
      opacity: 0;
    }

    .styled-checkbox + label {
        position: relative;
        cursor: pointer;
        padding: 0;
        font-size: 14px;
    }


    .styled-checkbox + label:before {
      content: '';
      margin-right: 10px;
      display: inline-block;
      vertical-align: text-top;
      width:35px;
      height:35px;
      background:#383759;
      border-radius: 4px;
    }

    
    .styled-checkbox:hover + label:before {
      background: #f35429;
    }
    
    
    .styled-checkbox:focus + label:before {
      box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.12);
    }

   
    .styled-checkbox:checked + label:before {
      background: #383759;
        content: '\f00c';
        margin-right: 10px;
        display: inline-block;
        vertical-align: text-top;
        width:35px;
        height:35px;
        font-family:FontAwesome;
        border-radius: 4px;
        text-align:center;
        line-height:35px;
        font-size: 16px;
    }

    .styled-checkbox:checked + label:before {
        background: #f92552;
    }
    .styled-checkbox:hover + label:before {
        background: #383759;
    }

    .btn-submit {
        margin-top: 27px;
        background: #f92552;
        color: #fff;
        font-size: 14px;
    }

    .joinprocess-form-section .list-unstyled li:before {content: "\f0a4";font-family: FontAwesome;position: absolute;left: -22px;top: 1px;}

    .joinprocess-form-section .list-unstyled li {
        margin-left: 22px;
        position: relative;
    }



</style>
         <form class="" method="post" action="{{url('tournament').'/'.$tournament->id.'/join-tournament'.$queryStringValue}}">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="content col-md-9">
            <!-- Posts Area 1 -->
            <!-- Latest News -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
              <div class="joinprocess-form-section">
                  <ul class="list-unstyled">
                    <li> </i> <b>Timezone:<b> Your timezone is automatically been detected but double check to ensure you are on the correct time zone.</li><br>
                    <li> </i> <b>Twitch url<b>: As a culture all matches are needed to be streamed to Twitch by participants, you would need to have an active <a href="https://twitch.tv">Twitch</a> account and provide your Twitch username.</li> <br>
                    <li> </i> <b>Preferred Time:<b> Do you have specific play times? this tournament allows you the flexibility of choosing a desired and convenient play time for your match day.</li><br>
                    <li> </i> <b>PSN ID/Gamertag:<b> Please provide your PSN ID if you would be playing on a PlayStation or Provide your gamertag if you would be playing on an Xbox.</li>  
                  </ul>
                  <div class="row">
                    <div class="col-sm-6">
                       <div class="form-group">
                          <div>Timezone</div>
                            <select class="selectpicker" name="timezone" id="timezone">
                                @foreach($timezones as $timezone)
                                  <option @if($user->timezone_offset == $timezone->offset) selected="selected" @endif value="{{$timezone->offset}}">{{$timezone->name.' '.$timezone->tz_value}}</option>
                                @endforeach
                            </select>
                       </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <div>Twitch URL</div>
                        <input class="form-control" type="text" name="twitch_url" />
                      </div>
                    </div>
                </div>
                <div class="row">
                   <div class="col-sm-6">
                        <div class="form-group">
                          <div>PSN ID / Gamertag</div>
                          <input class="form-control" type="text" name="gamer_id" />
                        </div>
                   </div>
                   <div class="col-sm-6">
                     <div class="form-group">
                       <div>Preferred Time</div>
                       <select class="selectpicker" name="preffered_time" id="preferredslot">
                        @foreach($slots as $slot)
                       <option value="{{$slot->value}}">{{$slot->name}}</option>
                        @endforeach
                       </select>
                     </div>
                   </div>
               </div>
                   <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="checkbox cust-check">
                              <input class="styled-checkbox" type="checkbox" id="styled-checkbox-1" name="host_event" value="1">
                              <label for="styled-checkbox-1">Volunteer as Host</label>
                              <p>To make things fair, volunteering as host means you have a decent internet connection which is able to stream and play efficently. Hosts are rewarded with 3 BTP for every match.
                                PS: if you think your internet connection can't handle streaming and playing at the same time, it's better to not volunteer to host, disconnection issues might lead to disqualification. <p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <div>Platform</div>
                        <select class="selectpicker" name="platform" id="platform">
                          <option value="Play Station">Play Station</option>
                          <option value="Xbox">Xbox</option>
                        </select>
                      </div>
                    </div>
                   </div>
                </div>
                 <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-submit">Submit</button>
                 </div>
              </div>
          </div>
        </form>
@endsection

@section('script_bottom')
<script type="text/javascript" charset="utf-8" >
  
</script>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.3/js/bootstrap-select.min.js"></script>  
<script type="text/javascript">

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