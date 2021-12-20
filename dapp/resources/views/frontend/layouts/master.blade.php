<!DOCTYPE html>
<html lang="en">
  @include('frontend.layouts.head')
  <style>
    .goog-logo-link {
   display:none !important;
}
.goog-te-gadget{
   color: transparent !important;
}

.google-translate .goog-te-combo {
  float: right;
  margin: 4px 0 10px 0 !important;
  border-radius: 50px;
  background: #fff;
  border: 0;
  color: #1e202f;
  font-size: 12px;
  padding: 4px 10px !important;
}

.google-translate select:focus {
    outline: none;
}


  </style>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

  <body class="template-football" data="bharat" style="display: block;">
    <div class="site-wrapper clearfix">
      @include('frontend.layouts.header')
      <div class="site-content">
        <div class="row" style="background:#1e202f;">
          <div class="container">
            <div class="google-translate"  id="google_translate_element"></div>
            <ul class="info-block info-block--header" style="clear:both;float: right;">
              @if(Sentinel::check())
                @if(in_array(request()->segment(count(request()->segments()) - 1),['live-betting','event-odds'], true) || Request::is('/') )
                <li class="info-block__item info-block__item--contact-secondary" style="padding: 0;">
                  <a href="{{url('/')}}/bet-active" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Active Stake </a>
                </li>
                <li class="info-block__item info-block__item--contact-secondary" style="padding: 0;">
                  <a href="{{url('/')}}/bethistory" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Staking History </a>
                </li>
                @endif
              @endif
              <!-- <li class="info-block__item info-block__item--contact-secondary">
                <div class="form-group">
                  <label class="radio radio-inline" style="font-size: 16px;
                  color: #f92552;">Odds : -</label>
                  <label class="radio radio-inline">
                    <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked="checked"> Decimal
                    <span class="radio-indicator"></span>
                  </label>
                  <label class="radio radio-inline">
                    <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> American
                    <span class="radio-indicator"></span>
                  </label>
                  <label class="radio radio-inline">
                    <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" > Fractional
                    <span class="radio-indicator"></span>
                  </label>
                </div>
              </li> -->
              @if(in_array(request()->segment(count(request()->segments()) - 1),['live-betting','event-odds'], true) || Request::is('/'))

              <li class="info-block__item info-block__item--shopping-cart" style="margin-bottom:15px;float: right;">
                <a class="info-block__link-wrapper header-maindropdown" style="" onclick="showmenu();">
                <img src="{{url('/')}}/assets1/images/betslip.png" style="margin-left: -33px;height: 29px;">
                <span class="" style="font-size: 22px;color:#fff;vertical-align: middle;"> Slip </span>
                <span class="badge badge-primary animatiom-eff"> 0 </span>
              </a>
              <!-- Dropdown Shopping Cart -->
                <ul class="header-cart" id="notification12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="tab" role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist" style="background: #1e202f;">
                          <li role="presentation" class="active" style="width:50%;"><a href="#Section1"  aria-controls="home" role="tab" data-toggle="tab" style="
                          text-align: center;border-radius: 0;">Single</a></li>
                          <li role="presentation" style="width:50%;"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab" style="
                          text-align: center;border-radius: 0;">Multibet</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabs" style="margin-top: 7px;">
                          <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                            <div id="senction1single">
                            </div>
                            <div>
                              <li class="header-cart__item header-cart__item--subtotal" style="border: none;">
                                <div class="form-group selectboxcart" style="margin-bottom: 1px;">
                                <label class="checkbox checkbox-inline" style="font-size: 13px;font-weight: 100;">
                                  <input type="checkbox" class="checkboxes" id="inlineCheckbox1" value="option1"> Accept all odds changes
                                  <span class="checkbox-indicator"></span>
                                </label>
                              </div>
                              <div class="form-group selectboxcart" style="margin-bottom: 5px;">
                                <label class="checkbox checkbox-inline" style="font-size: 13px;
                                  font-weight: 100;">
                                  <input type="checkbox" class="checkboxes" id="inlineCheckbox2" value="option2"> Quick bet
                                  <span class="checkbox-indicator"></span>
                                </label>
                              </div>
                                <div class="alert-success alert1" style="background:#f92552;color:white;padding: 20px;border-radius: 4px;">
                                  <strong>You dont have enough balance</strong>
                                </div>
                                <div class="row" style="background:#1e202f;background: #1e202f;padding: 14px 26px 14px;margin-top: 6px;text-transform: capitalize;
                                  font-size: 14px;font-weight: 100;">
                                  <span>Potential win</span>
                                  <span style="float: right; font-weight: bold; text-transform: none;"><span id="Spotential_win">0.00</span> <span style="font-weight: 100;">BTP</span></span>
                                </div>
                              </li>
                              <li class="header-cart__item header-cart__item--action">
                                <button class="btn btn-default btn-block placeBtn" id="singleBet" type="button" > Place Bet </button>
                                <button class="btn btn-default btn-block clear_bets" type="button" > Clear </button>
                              </li>
                            </div>
                          </div>

                          <!-- section 2 -->
                          <div role="tabpanel" class="tab-pane fade" id="Section2">
                            <div id="senction2Multiple">
                              
                            </div>
                            <div class="row" style="margin-top: 9px; margin-bottom: 9px;">
                              <center>
                              <form id='myform' method='POST' action='#'>
                                <input type='button' value='- 50' onlick="check_oddMultiple(-50)" class='qtyminus itemsaddbutton' field='quantity' />
                                <input type='button' value='- 10' onclick="check_oddMultiple(-10)" class='qtyminus itemsaddbutton' field='quantity' />
                                <input type='text' name='quantity' onkeyup="isNotNumberKeyMul(this.value)" id="multi_stake" value='' placeholder="Stake" class='qty itrmaddinput' />
                                <input type='button' value='+ 10' onclick="check_oddMultiple(10)" class='qtyplus itemsaddbutton' field='quantity' />
                                <input type='button' value='+ 50' onlick="check_oddMultiple(50)" class='qtyminus itemsaddbutton' field='quantity' />
                              </form>
                              </center>
                            </div>
                            <li class="header-cart__item header-cart__item--subtotal" style="border: none;">
                              <div class="form-group selectboxcart" style="margin-bottom: 1px;">
                                <label class="checkbox checkbox-inline" style="font-size: 13px;font-weight: 100;">
                                  <input type="checkbox" class="checkboxes" id="inlineCheckbox3" value="option1"> Accept all odds changes
                                  <span class="checkbox-indicator"></span>
                                </label>
                              </div>
                              <div class="form-group selectboxcart" style="margin-bottom: 5px;">
                                <label class="checkbox checkbox-inline" style="font-size: 13px;
                                  font-weight: 100;">
                                  <input type="checkbox" class="checkboxes" id="inlineCheckbox4" value="option2"> Quick bet
                                  <span class="checkbox-indicator"></span>
                                </label>
                              </div>
                              <div class="alert-success alert2" style="background:#f92552;color:white;padding: 20px;border-radius: 4px;">
                                <strong>You have not sufficient balance to stake.</strong>
                              </div>
                              <div class="alert-success alert3" style="background:#f92552;color:white;padding: 20px;border-radius: 4px;">
                                <strong>You have not sufficient balance to stake.</strong>
                              </div>
                              <div class="row" style="background:#1e202f;background: #1e202f;padding: 14px 26px 14px;margin-top: 6px;text-transform: capitalize;
                                font-size: 14px;font-weight: 100;">
                                <span>Potential win</span>
                                <span style="float: right; font-weight: bold; text-transform: none;"><span id="Spotential_mul_win">0.00</span> <span style="font-weight: 100;">BTP</span></span>
                              </div>
                            </li>
                            <li class="header-cart__item header-cart__item--action">
                              <button type="button" class="btn btn-default btn-block placeBtnMul" id="multipleBet">Place MultiBet</button>
                              <button type="button" class="btn btn-default btn-block clear_bets">Clear</button>
                            </li>
                            
                          </div>
                          
                        </div>
                      </div>
                    </div>
                  </div>
               
                </ul>
                <!-- Dropdown Shopping Cart / End -->
              </li>
              @endif
            </ul>
            <!-- Banner 420x60 -->
            <div class="header-banner">
            </div>
            <!-- Banner 420x60 / End -->
          </div>
        </div>
        <div class="container">
          <div class="row">
            @include('frontend.layouts.sidebar')
            @yield('content')
          </div>
        </div>
      </div>
      @include('frontend.layouts.footer')
      @include('frontend.layouts.footer-script')
      @include('frontend.layouts.script')
    </div>
  </body>
</html>