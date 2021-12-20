@extends('frontend.layouts.master')
@section('title') BitSport &trade; | Peer to Peer competitive eSports Platform @endsection
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
    margin-top: 15px;
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

  .btp-button-el {
    overflow: hidden;
    display: inline-block;
    visibility: visible !important;
    background-image: -webkit-linear-gradient(#28a0e5, #015e94);
    background-image: -moz-linear-gradient(#28a0e5, #015e94);
    background-image: -ms-linear-gradient(#28a0e5, #015e94);
    background-image: -o-linear-gradient(#28a0e5, #015e94);
    background-image: -webkit-linear-gradient(#28a0e5, #015e94);
    background-image: -moz-linear-gradient(#28a0e5, #015e94);
    background-image: -ms-linear-gradient(#28a0e5, #015e94);
    background-image: -o-linear-gradient(#28a0e5, #015e94);
    background-image: linear-gradient(#28a0e5, #015e94);
    -webkit-font-smoothing: antialiased;
    border: 0;
    padding: 1px;
    text-decoration: none;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    -ms-border-radius: 5px;
    -o-border-radius: 5px;
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 0 rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0 1px 0 rgba(0, 0, 0, 0.2);
    -ms-box-shadow: 0 1px 0 rgba(0, 0, 0, 0.2);
    -o-box-shadow: 0 1px 0 rgba(0, 0, 0, 0.2);
    box-shadow: 0 1px 0 rgba(0, 0, 0, 0.2);
    -webkit-touch-callout: none;
    -webkit-tap-highlight-color: transparent;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    -o-user-select: none;
    user-select: none;
    cursor: pointer
  }

  .btp-button-el::-moz-focus-inner {
    border: 0;
    padding: 0
  }
/* 
  .btp-button-el span {
    display: block;
    position: relative;
    padding: 0 12px;
    height: 30px;
    line-height: 30px;
    background: #1275ff;
    background-image: -webkit-linear-gradient(#7dc5ee, #008cdd 85%, #30a2e4);
    background-image: -moz-linear-gradient(#7dc5ee, #008cdd 85%, #30a2e4);
    background-image: -ms-linear-gradient(#7dc5ee, #008cdd 85%, #30a2e4);
    background-image: -o-linear-gradient(#7dc5ee, #008cdd 85%, #30a2e4);
    background-image: -webkit-linear-gradient(#7dc5ee, #008cdd 85%, #30a2e4);
    background-image: -moz-linear-gradient(#7dc5ee, #008cdd 85%, #30a2e4);
    background-image: -ms-linear-gradient(#7dc5ee, #008cdd 85%, #30a2e4);
    background-image: -o-linear-gradient(#7dc5ee, #008cdd 85%, #30a2e4);
    background-image: linear-gradient(#7dc5ee, #008cdd 85%, #30a2e4);
    font-size: 14px;
    color: #fff;
    font-weight: bold;
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
    -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25);
    -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25);
    -ms-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25);
    -o-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.25);
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    -ms-border-radius: 4px;
    -o-border-radius: 4px;
    border-radius: 4px
  }

  .btp-button-el:not(:disabled):active,
  .btp-button-el.active {
    background: #005d93
  }

  .btp-button-el:not(:disabled):active span,
  .btp-button-el.active span {
    color: #eee;
    background: #008cdd;
    background-image: -webkit-linear-gradient(#008cdd, #008cdd 85%, #239adf);
    background-image: -moz-linear-gradient(#008cdd, #008cdd 85%, #239adf);
    background-image: -ms-linear-gradient(#008cdd, #008cdd 85%, #239adf);
    background-image: -o-linear-gradient(#008cdd, #008cdd 85%, #239adf);
    background-image: -webkit-linear-gradient(#008cdd, #008cdd 85%, #239adf);
    background-image: -moz-linear-gradient(#008cdd, #008cdd 85%, #239adf);
    background-image: -ms-linear-gradient(#008cdd, #008cdd 85%, #239adf);
    background-image: -o-linear-gradient(#008cdd, #008cdd 85%, #239adf);
    background-image: linear-gradient(#008cdd, #008cdd 85%, #239adf);
    -webkit-box-shadow: inset 0 1px 0 rgba(0, 0, 0, 0.1);
    -moz-box-shadow: inset 0 1px 0 rgba(0, 0, 0, 0.1);
    -ms-box-shadow: inset 0 1px 0 rgba(0, 0, 0, 0.1);
    -o-box-shadow: inset 0 1px 0 rgba(0, 0, 0, 0.1);
    box-shadow: inset 0 1px 0 rgba(0, 0, 0, 0.1)
  }

  .btp-button-el:disabled,
  .btp-button-el.disabled {
    background: rgba(0, 0, 0, 0.2);
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    -ms-box-shadow: none;
    -o-box-shadow: none;
    box-shadow: none
  }

  .btp-button-el:disabled span,
  .btp-button-el.disabled span {
    color: #999;
    background: #f8f9fa;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5)
  } */

  
  button.btp-button-el span, button.btp-button-el,
  a.btp-button-el span, a.btp-button-el {
    background: #f92552 !important;
    background-image: none !important;
    border: none !important;
    box-shadow: none !important;
    padding: 0 5px;
    color: #fff;
}

  .ch-in{ margin-left:15px; }

  .ch-in.checkbox input[type="checkbox"] {
      display: block;
      left: 1px;
      top: 3px;
  }


</style>

<div class="content col-md-9">
  <h2>Critical Rules</h2>
  <p><?php echo $tournament->critical_rules ?></p>
  </b>
  <div class="checkbox ch-in">
  <input id="terms-and-condition" type="checkbox" value="0"
      name="agree">I have read and agree to all the rules: </div>
  <div class="main-div">
    <div class="payment-div">
      <form id="stripe-form" action="/stripe-payment" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="_tournament_id" value="{{$tournament->id}}">
        {{-- <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="{{env('STRIPE_PUB_KEY')}}"
          data-name="BitSport" data-amount="{{$tournament->fees * 100}}" data-name="Stripe Demo" data-description="Tournament joining fees"
          data-image="/assets1/images/football/logo.png" data-locale="auto" data-currency="usd">
        </script> --}}
        <input type="hidden" name="twitch_url" value="<?php echo isset($_POST['twitch_url']) ? $_POST['twitch_url'] : '';?>">
        <input type="hidden" name="timezone" value="<?php echo isset($_POST['timezone']) ? $_POST['timezone'] : ''; ?>">
        <input type="hidden" name="host_event" value="<?php echo (isset($_POST['host_event'])) ? $_POST['host_event'] : '';?>">
        <input type="hidden" name="preffered_time" value="<?php echo isset($_POST['preffered_time']) ? $_POST['preffered_time'] : '';?>">
        <input type="hidden" name="gamer_id" value="<?php echo isset($_POST['gamer_id']) ? $_POST['gamer_id'] : '';?>">
        <input type="hidden" name="platform" value="<?php echo isset($_POST['platform']) ? $_POST['platform'] : '';?>">
      </form>

     <form id="btp-form" action="/tournament/{{$tournament->id}}/payment{{$queryStringValue}}" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="_tournament_id" value="{{$tournament->id}}">
        <input type="hidden" name="twitch_url" value="<?php echo isset($_POST['twitch_url']) ? $_POST['twitch_url'] : '';?>">
        <input type="hidden" name="timezone" value="<?php echo isset($_POST['timezone']) ? $_POST['timezone'] : ''; ?>">
        <input type="hidden" name="host_event" value="<?php echo (isset($_POST['host_event'])) ? $_POST['host_event'] : '';?>">
        <input type="hidden" name="preffered_time" value="<?php echo isset($_POST['preffered_time']) ? $_POST['preffered_time'] : '';?>">
        <input type="hidden" name="gamer_id" value="<?php echo isset($_POST['gamer_id']) ? $_POST['gamer_id'] : '';?>">
        <input type="hidden" name="platform" value="<?php echo isset($_POST['platform']) ? $_POST['platform'] : '';?>">
        {{-- <button type="submit" id='btp' class="btp-button-el">
          <span style="display: block; min-height: 30px;">Pay with BTP</span>
        </button> --}}
        @if($queryStringValue == "")
          <button type="submit" id='btp' class="btp-button-el">
              <span style="display: block; min-height: 30px;">Continue to payment</span>
          </button>
        @else
          <button type="submit" id='btp' class="btp-button-el">
            <span style="display: block; min-height: 30px;">Submit</span>
          </button>
        @endif
        </form>
    </div>
    <div class="text-left back-button">
      <a class="btp-button-el" href='{{url("/tournament/{$tournament->id}")}}'>
        <span style="display: block; min-height: 30px;">Back To Tournament</span>
      </a>
    </div>
  </div>
</div>

@section('script')
<script>
  const stripeButton = $('#stripe-form button[type="submit"]')
  const btpButton = $('#btp-form button[type="submit"]')
  stripeButton.attr("disabled", !$('#terms-and-condition').checked);
  btpButton.attr("disabled", !$('#terms-and-condition').checked);
  $('#terms-and-condition').change(function() {
    stripeButton.attr("disabled", !this.checked);
    btpButton.attr("disabled", !this.checked);
  });
</script>
@endsection
@endsection
