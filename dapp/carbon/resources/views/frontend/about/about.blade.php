@extends('frontend.layouts.cms-master')
@section('title') BitSport &trade; | Peer to Peer competitive eSports platform @endsection
@section('head')
    <link href="{{ URL::asset('assets/css/about.css') }}" rel="stylesheet" id="style_components" type="text/css" />
@endsection
@section('content')
<div class="center-content">

        <div class="row">
            <div class="col-12  col-md-4 col-lg-3 nopadding">
                  @include('frontend.about.sidebar')  <!--sidebar-->
            </div>
            <div class="col-12  col-md-8 col-lg-9 nopadding">
                <div class="container inner-page">
                   <!--content-->
                   {!! $about->content !!}

                </div>
              <!--   <div class="link-boxes">
                    @include('frontend.about.footer') 
                </div> -->
            </div>
        </div>
    </div>
    @endsection