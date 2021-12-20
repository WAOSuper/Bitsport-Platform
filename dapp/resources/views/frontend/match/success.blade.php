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
                  <h5 class="headertexttop">Match confirmed</h5>
              <hr>
              <div id="live-event-data">
                    <p>Your P2P Match has been successfully created.</p>
                    Click here to <a href="{{url('/')}}">return to homepage</a>.
              </div>

            </div>
              <!-- second main row end here -->
            </div>
          </div>
@endsection

@section('script_bottom')

@endsection
@section('script')

@endsection