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
    
.circle-icon {
    box-shadow: 0px 9px 32px 0px rgba(0, 0, 0, 0.07);
    padding: 10px;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-bottom: 1.5rem;
    background-color: #FFF;
    color: #f5378e;
    font-size: 48px;
    text-align: center;
    line-height: 80px;
    font-weight: 300;
    transition: all 0.3s ease;
    margin-right:1.5rem!important;
    float:left;
}

@media (max-width:992px) {
    .circle-icon {
        width: 70px;
        height: 70px;
        font-size: 28px;
        line-height: 50px;
    }
}

.ui-steps li:hover .circle-icon {
    background-image: -moz-linear-gradient( 122deg, #e6388e 0%, #fb378e 100%);
    background-image: -webkit-linear-gradient( 122deg, #e6388e 0%, #fb378e 100%);
    background-image: -ms-linear-gradient( 122deg, #e6388e 0%, #fb378e 100%);
    background-image: linear-gradient( 122deg, #e6388e 0%, #fb378e 100%);
    box-shadow: 0px 9px 32px 0px rgba(0, 0, 0, 0.09);
    color: #FFF;
}
.ui-steps li {
  border-bottom: 1px solid #424454;
}
.media-body-custom {
  -ms-flex: 1;
  flex:1;
}
</style>

          <div class="content col-md-9">
            <!-- Posts Area 1 -->
            <!-- Latest News -->
    @include('frontend.layouts.messagess')    

            <div class="card card--clean mb-0 mainsectionbg">

            <div id="data" class="mobilelivebetting">
                  <h5 class="headertexttop">What you should know</h5>
              <hr>
              <div id="live-event-data">
                <div class="row">
                    <div class="col-md-12">
                    <ul class="list-unstyled ui-steps">
                        <li class="media">
                            <div class="circle-icon mr-4">1</div>
                            <div class="media-body-custom">
                                <h5>Starting a P2P Match</h5>
                                <p>P2P Matches are a great way to spice up your gaming life, by going on a head to head challenge against an opponent with real money on the line.</p>
                            </div>
                        </li>
                        <li class="media my-4">
                            <div class="circle-icon mr-4">2</div>
                            <div class="media-body-custom">
                                <h5>Share the experience</h5>
                                <p>To make things fair, you are required to stream the game via Twitch so it can be curated by the community. We advice you not to start a P2P match if you do not have enough internet capacity to power a stream alongside your gameplay.</p>
                            </div>
                        </li>
                        <li class="media">
                            <div class="circle-icon mr-4">3</div>
                            <div class="media-body-custom">
                                <h5>Earn extra via Backers</h5>
                                <p>Backers are users who stake or bet on your win, so get that extra boost, win your game and earn 10% on your backers earning when you win a Game. </p>
                            </div>
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input type="checkbox" id="read">​ I have read the above information carefully
                    </div>
                    <div class="col-md-12 text-right">
                        <a href="#" id="next" class="btn btn-primary">Next</a>
                    </div>
                </div> 

              </div>
              

            </div>
              <!-- secon main row end here -->
             
            </div>
          </div>
@endsection

@section('script_bottom')
<script type="text/javascript" charset="utf-8" >
  
</script>
@endsection
@section('script')
<script type="text/javascript">

    var nextUrl = "{{url('/')}}/match/new";
    $("#read").on('click', function() {
        $('#next').attr("href", nextUrl);
    });

</script>
@endsection