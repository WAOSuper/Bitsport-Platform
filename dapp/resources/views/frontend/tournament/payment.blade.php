@extends('frontend.layouts.master')
@section('title') BitSport &trade; | Peer to Peer competitive eSports platform @endsection
@section('head')
<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<style type="text/css">
  .main-div {
    display: flex;
    width: 100%;
    float: right;
    text-align: right;
    justify-content: flex-end;
    flex-direction: row-reverse;
  }

  .back-button {
    style=display: flex;
    justify-content: flex-start;
    width: 50%;
  }

  .payment-div {
    display: flex;
    justify-content: flex-end;
    width: 100%;
  }


  ul.nav.custom-tab.nav-tabs li a {
    background: none;
    color: #fff;
}

ul.nav.custom-tab.nav-tabs li.active a {
    border-color: #fff;
}

  .checkbox input[type="checkbox"] {
      display: block;
      top:4px;
  }

  .tab-content>.tab-pane {
    background: transparent;
}

.btn-action {
    background: #323150;
    border: none;
    display: inline-block;
    padding: 4px 20px;
    color: #fff;
    border-radius: 4px;
    margin-right: 5px;
}

.btn-action:hover {
    background: #f92552;
    color: #fff;
}

.custom-tab.nav-tabs > li > a span {
    display: block;
    margin: 0 0 5px 0;
    text-align: center;
}

.by-card {
    padding: 15px 0;
}
button.stripe-button-el span, button.stripe-button-el {
    background: #323150 !important;
    background-image: none !important;
    border: none !important;
    box-shadow: none !important;
    vertical-align: top;
    line-height: 35px;
    height: 38px;
    font-family: inherit !important;
    font-size:13px;
    font-weight: 400;
}
button.stripe-button-el span:hover{
  background: #f92552 !important;
  color: #fff;
}

</style>

<div class="content col-md-9">
  <div class="main-div">
    <div class="payment-div">
    </div>
    <div class="text-left back-button">
      <a class="btp-button-el" href='{{url("/tournament/{$tournament->id}/join-tournament")}}'>
        <span style="display: block; min-height: 30px;">Back To Tournament</span>
      </a>
    </div>
  </div>
  @if($invitationCodeMsg != "")
    <div class="alert alert-danger">{{$invitationCodeMsg}}</div><br>
  @endif
  <div class="col-md-12">
      <p>Please select your payment method</p>
      <p>Entry Fees: {{$tournament->fees}} BTP | (${{$tournament->fees * $marketprice}})  </p>
      <ul class="nav custom-tab nav-tabs">
          <li class="active"><a data-toggle="tab" href="#paycard"><span> <img width="50" height="40" src="{{url('/')}}/assets/images/coins/paypal.png"></span> Pay by Paypal</a></li>
          <li><a data-toggle="tab" href="#paybtp"><span> <img width="50" height="40" src="{{url('/')}}/assets/images/coin_alpha.png"></span>BTP Coin</a></li>
          <!--<li><a data-toggle="tab" href="#mobile_money"><span> <img width="50" height="40" src="{{url('/')}}/assets/images/transfer.png"></span>Mobile Money</a></li> --->
      </ul>
      <div class="tab-content">
        <div id="payPaypal" class="tab-pane fade active in">
         
            <div class="by-card">
              <form id="paypalForm" name="paypalform" method="post" action="{{ url('/') }}/create-paypal-payment" >
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="_tournament_id" value="{{$tournament->id}}">
                    <input class="form-control" name="amount" type="hidden" value="{{ $tournament->fees * $marketprice }}"/>
                    <input name="submit" class="btn-action"  type="submit" value="Pay with Paypal" />
                    <a class="btn-action" href='{{url("/tournament")}}'>
                      <span style="display: block;">Cancel</span>
                    </a>
                    <input type="hidden" name="PAYMENT_UNITS" class="payment-units" id="PAYMENT_UNITS" value="USD"/>

                    <input type="hidden" name="twitch_url" value="<?php echo isset($_POST['twitch_url']) ? $_POST['twitch_url'] : '';?>">
                    <input type="hidden" name="timezone" value="<?php echo isset($_POST['timezone']) ? $_POST['timezone'] : ''; ?>">
                    <input type="hidden" name="host_event" value="<?php echo (isset($_POST['host_event'])) ? $_POST['host_event'] : '';?>">
                    <input type="hidden" name="preffered_time" value="<?php echo isset($_POST['preffered_time']) ? $_POST['preffered_time'] : '';?>">
                    <input type="hidden" name="gamer_id" value="<?php echo isset($_POST['gamer_id']) ? $_POST['gamer_id'] : '';?>">
                    <input type="hidden" name="platform" value="<?php echo isset($_POST['platform']) ? $_POST['platform'] : '';?>">
              </form>
            </div>
          
            <!--<div class="by-card">
                <form id="stripe-form" action="/stripe-payment" method="POST">
                  {{csrf_field()}}
                  
                  <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="{{env('STRIPE_PUB_KEY')}}"
                    data-name="BitSport" data-amount="{{$tournament->fees/0.1}}" data-name="Stripe Demo" data-description="Tournament joining fees"
                    data-image="/assets1/images/football/logo.png" data-locale="auto" data-currency="usd">
                  </script>
                  <a class="btn-action" href='{{url("/tournament")}}'>
                    <span style="display: block; min-height: 30px;">Cancel</span>
                  </a>
                  <input type="hidden" name="twitch_url" value="<?php echo isset($_POST['twitch_url']) ? $_POST['twitch_url'] : '';?>">
                  <input type="hidden" name="timezone" value="<?php echo isset($_POST['timezone']) ? $_POST['timezone'] : ''; ?>">
                  <input type="hidden" name="host_event" value="<?php echo (isset($_POST['host_event'])) ? $_POST['host_event'] : '';?>">
                  <input type="hidden" name="preffered_time" value="<?php echo isset($_POST['preffered_time']) ? $_POST['preffered_time'] : '';?>">
                  <input type="hidden" name="gamer_id" value="<?php echo isset($_POST['gamer_id']) ? $_POST['gamer_id'] : '';?>">
                  <input type="hidden" name="platform" value="<?php echo isset($_POST['platform']) ? $_POST['platform'] : '';?>">
                </form>
             </div>
             --->
        </div>
        <div id="paybtp" class="tab-pane fade">
            <div class="checkbox">
              <label>
                  <input type="checkbox" name="btp_value" value=""> Current BTP Balance:{{$user->mbtc}} BTP
              </label>
            </div>
          <p>You can add more BTP coins by using the <a target="_blank" href="{{url('wallet')}}">wallet</a> page and discover are various options of acquiring BTP coins.</p>
          <form id="btp-form" action="/btp-payment" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="_tournament_id" value="{{$tournament->id}}">
            <input type="hidden" name="twitch_url" value="<?php echo isset($_POST['twitch_url']) ? $_POST['twitch_url'] : '';?>">
            <input type="hidden" name="timezone" value="<?php echo isset($_POST['timezone']) ? $_POST['timezone'] : ''; ?>">
            <input type="hidden" name="host_event" value="<?php echo (isset($_POST['host_event'])) ? $_POST['host_event'] : '';?>">
            <input type="hidden" name="preffered_time" value="<?php echo isset($_POST['preffered_time']) ? $_POST['preffered_time'] : '';?>">
            <input type="hidden" name="gamer_id" value="<?php echo isset($_POST['gamer_id']) ? $_POST['gamer_id'] : '';?>">
            <input type="hidden" name="platform" value="<?php echo isset($_POST['platform']) ? $_POST['platform'] : '';?>">
            <button type="submit" id='btp' class="btn-action">
              <span style="display: block; min-height: 30px;">Continue</span>
            </button>
            <a class="btn-action" href='{{url("/tournament")}}'>
              <span style="display: block; min-height: 30px;">Cancel</span>
            </a>
          </form>
        </div>
        <!---
        <div id="mobile_money" class="tab-pane fade">
          <p>To complete registration, make a payment of 20 GHS to 024 859 6974 by Mobile Money.</p>
          <form id="btp-form" action="/mobile-money" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="_tournament_id" value="{{$tournament->id}}">
            <input type="hidden" name="twitch_url" value="<?php echo isset($_POST['twitch_url']) ? $_POST['twitch_url'] : '';?>">
            <input type="hidden" name="timezone" value="<?php echo isset($_POST['timezone']) ? $_POST['timezone'] : ''; ?>">
            <input type="hidden" name="host_event" value="<?php echo (isset($_POST['host_event'])) ? $_POST['host_event'] : '';?>">
            <input type="hidden" name="preffered_time" value="<?php echo isset($_POST['preffered_time']) ? $_POST['preffered_time'] : '';?>">
            <input type="hidden" name="gamer_id" value="<?php echo isset($_POST['gamer_id']) ? $_POST['gamer_id'] : '';?>">
            <input type="hidden" name="platform" value="<?php echo isset($_POST['platform']) ? $_POST['platform'] : '';?>">
            <button type="submit" id='btp' class="btn-action">
              <span style="display: block; min-height: 30px;">Continue</span>
            </button>
            <a class="btn-action" href='{{url("/tournament")}}'>
              <span style="display: block; min-height: 30px;">Cancel</span>
            </a>
          </form>
        </div>
      -->
      </div>
  </div>
</div><br>
<br>
<br>
<script>
</script>
@endsection
