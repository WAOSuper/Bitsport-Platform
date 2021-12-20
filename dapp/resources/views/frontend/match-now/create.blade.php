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
            @include('frontend.layouts.messagess')    

            <div class="card card--clean mb-0 mainsectionbg">

            <div id="data" class="mobilelivebetting">
                  <h5 class="headertexttop">Create New Match</h5>
              <hr>
              <div id="live-event-data">
                <form class="create-match-form" action="{{ route('match.store') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input class="form-control placeholder-no-fix" type="hidden" name="timezone" id="timezone" />
                    
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">PSN ID / Xbox GamerTag</label>
                        <input class="form-control placeholder-no-fix" type="text" placeholder="PSN ID / Xbox GamerTag" name="psn_id" />
                    </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Match Making Duration</label>
                        <select class="form-control placeholder-no-fix" name="match_making_duration" placeholder="Match Making Duration">
                            <option value="">Select Match Making Duration</option>
                            <option value="0.5">30 Mins</option>
                            <option value="1">1 hour</option>
                            <option value="2">2 hours</option>
                            <option value="3">3 hours</option>
                            <option value="1">4 hours</option>
                            <option value="5">5 hours</option>
                            <option value="6">6 hours</option>
                            <option value="8">8 hours</option>
                            <option value="9">9 hours</option>
                            <option value="10">10 hours</option>
                            <option value="12">12 hours</option>
                            <option value="13">13 hours</option>
                            <option value="14">14 hours</option>
                            <option value="15">15 hours</option>
                            <option value="16">16 hours</option>
                            <option value="17">17 hours</option>
                            <option value="18">18 hours</option>
                            <option value="19">19 hours</option>
                            <option value="20">20 hours</option>
                            <option value="21">21 hours</option>
                            <option value="22">22 hours</option>
                            <option value="23">23 hours</option>
                            <option value="24">24 hours</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Twitch Username</label>
                        <input class="form-control placeholder-no-fix" type="text" placeholder="Twitch Username" name="username" />
                    </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Check-in duration</label>
                        <select class="form-control placeholder-no-fix" name="ckeck_in_duration" placeholder="Check-in duration">
                            <option value="">Select Check-in duration</option>
                            <option value="1">1 Min</option>
                            @for ($i = 2; $i <= 60; $i++)
                                <option value="{{$i}}">{{$i}} Mins</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Platform </label>
                        <select class="form-control placeholder-no-fix" name="platform" placeholder="Platform ">
                            <option value="">Select Platform </option>
                            <option value="playstation">Playstation </option>
                            <option value="xbox">Xbox </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Host Match <input class="mt-1" type="checkbox" placeholder="Host Match" name="host" value=1 /></label>
                    </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Game mode </label>
                        <select class="form-control placeholder-no-fix" name="game_mode" placeholder="Game mode ">
                            <option value="">Game mode </option>
                            <option value="friendly">Friendly </option>
                            <option value="fut">FUT </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Phone number</label>
                        <input class="form-control placeholder-no-fix" type="text" placeholder="Phone number" name="phone" />
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary"> Submit </button>
                    </div>

                </form>
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
    var d = new Date()
    var n = d.getTimezoneOffset();
    $("#timezone").val(n/60);
</script>
@endsection