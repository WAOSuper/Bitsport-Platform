@extends('frontend.layouts.master')
@section('title') BitSport &trade; | Promotions @endsection
@section('head')
    <link href="{{ URL::asset('assets/css/header-footer.css') }}" rel="stylesheet" id="style_components" type="text/css" /> 
     <link href="{{ URL::asset('assets/css/offer.css') }}" rel="stylesheet" id="style_components" type="text/css" />
@endsection
@section('content')
 <div class="content-container">
        <div class="middle">
                    <div class="middle-content clearfix" style="padding-top: 0">

                        <article class="clearfix" style="border: none">

                            <div id="mainBlockDesign">
                                <section class="promotions">
                                    <div class="banner-image"><img src="//cdn.coingaming.io/sportsbet/images/Bitcoin-Sportsbook-Sportsbet-Promotions-Offer-Header-image-201610.jpg" width="100%"></div>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                    @foreach($promotions as $promotion)
                                    <div class="promotion">
                                      <div class="row">
                                        <div class="col-12 col-sm-12 col-lg-3">
                                        <div class="promotion-image"><img src="{{url('assets/images/blog/'.$promotion->image)}}"></div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-lg-9">
                                            <div class="promotion-body">
                                            <h1>{{$promotion->title}}</h1>{{$promotion->description}}<a class="promotion-link" href="{{route('single.promotions',$promotion->id)}}">Read more</a> </div>
                                        </div>
                                      </div>
                                    </div>

                                    @endforeach
                                  
                                </section>
                            </div>

                            <div id="loggedInDesign"></div>

                        </article>

                    </div>
        </div>
    </div>
@endsection