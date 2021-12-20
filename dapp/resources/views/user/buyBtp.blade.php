@extends('layouts.master')
<!-- head -->
@section('title')
    Buy BTP Coin
@endsection
<!-- title -->
@section('head')
<link href="{{ URL::asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
               <!--  <h1> Wallet  </h1> --> 
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12 col-sm-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-blue-sunglo">
                            <i class="icon-settings font-blue-sunglo"></i>
                            <span class="caption-subject bold uppercase"> Buy - BTP</span>
                        </div>                      
                    </div>
                    <div class="portlet-body">
                        <div class="caption font-blue-sunglo">                    
                            <span class="caption-subject bold uppercase"> Buy BTP Instantly.</span>
                        </div>
                        <br>
                        @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
                        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
                        <form  action="{{ url('buy-btp') }}" method="post" >
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="bit_point_price" id="bit_point"> 
                            <input type="hidden" name="eth_point_price" id="eth_point">
                            <input type="hidden" name="ltc_point_price" id="ltc_point">
                            <input type="hidden" name="dash_point_price" id="dash_point">
                            <div id="alert-msg"></div>                                  
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                            <label>Amount (USD)</label>
                                            <input class="form-control placeholder-no-fix" type="number" required autocomplete="off" id="amount-usd" name="amount_usd" placeholder="0.00" value="" step="any" onkeypress="return isNotNumberKey(event);" onkeyup="checkBalance(this.value)"> 
                                            <span class="text-danger">{{ $errors->first('amount_usd') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                            <label>BTP</label>
                                            <input class="form-control placeholder-no-fix" type="number" required autocomplete="off" id="amount-btp" name="amount_btp" placeholder="0.00" value="" step="any" readonly=""> 
                                            <span class="text-danger">{{ $errors->first('amount_btp') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <label class="radio radio--success" name="radio5">
                                                <input type="radio" class="buy_form" name="from_type" value="0" checked> <b>Credit or Debit Card <img src="http://i76.imgup.net/accepted_c22e0.png"></b>
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-md-12">
                                                <label class="radio radio--success" name="radio5">
                                                    <input type="radio" class="buy_form" name="from_type" value="1"> <b>CryptoCurrencies</b>
                                                    <span></span>
                                                </label>
                                                <div class="row" id="crypto_coin" style="display: none;">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-11">
                                                        <label class="radio radio--success" name="radio5">
                                                            <input type="radio" class="buy_form1" name="coin_name" value="BTC" checked="checked"><img class="coinimg" src="{{ asset('assets/images/coins/bitcoin.png')}}">
                                                            <span></span> 
                                                        </label>
                                                        <div class="lbl-name">
                                                            <span class="wall_price bit_price">
                                                                
                                                             </span>
                                                        </div>
                                                        <label class="radio radio--success" name="radio5">
                                                            <input type="radio" class="buy_form1" name="coin_name" value="ETH"> <img class="coinimg" src="{{ asset('assets/images/coins/eth.png')}}">
                                                            <span></span>  
                                                        </label>
                                                        <div class="lbl-name">
                                                            <span class="wall_price eth_price">
                                                                   
                                                             </span>
                                                        </div>
                                                        <label class="radio radio--success" name="radio5">
                                                            <input type="radio" class="buy_form1" name="coin_name" value="LTC"> <img class="coinimg" src="{{ asset('assets/images/coins/ltc.png')}}">
                                                            <span></span>  
                                                        </label>
                                                        <div class="lbl-name">
                                                          <span class="wall_price ltc_price">
                                                                
                                                             </span>
                                                        </div>
                                                        <label class="radio radio--success" name="radio5">
                                                            <input type="radio" class="buy_form1" name="coin_name" value="DASH"> <img class="coinimg" src="{{ asset('assets/images/coins/dash.png')}}" width="40px">
                                                            <span></span>  
                                                        </label>
                                                        <div class="lbl-name"><span class="wall_price dash_price">
                                                                   
                                                             </span>
                                                         </div>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                                </div>
                            </div>

                            <button class="btn btn-success" id="Withdraw-btn"><i class="fa fa-btc"></i>&nbsp;Submit</button>
                        </form>
                        <hr>

                        <div class="panel panel-default">
                            <div class="panel-heading">Transactions List</div>
                            <div class="panel-body">
                                <table class="table table-bordered table-hover table-checkable" id="data-table">
                                    <thead>
                                        <th>Sr</th>
                                        <th>Payment Methods</th>
                                        <th>BTP Amount</th>
                                        <th>USD Amount</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; ?>
                                    @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>@if($transaction->buy_from == 0) Credit Card @else Coin @endif</td>
                                        <td>{{ number_format($transaction->btp, 2) }}</td>
                                        <td>{{ number_format($transaction->amount, 2)}}</td>
                                        <td>@if($transaction->admin_status == 0)
                                                <span class="badge badge-primary"> Pending </span>
                                            @elseif($transaction->admin_status == 1)
                                                <span class="badge badge-success"> Approved </span>
                                            @elseif($transaction->admin_status == 2)
                                                <span class="badge badge-danger"> Reject </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <input type="hidden" id="coin_price" value="<?php echo $setting->btc_price;  ?>">
    <input type="hidden" id="eth_price" value="<?php echo $setting->eth_price;  ?>">
    <input type="hidden" id="LTC_price" value="<?php echo $setting->ltc_price;  ?>">
    <input type="hidden" id="dash_price" value="<?php echo $setting->dash_price;  ?>">
    <input type="hidden" id="setting_rate" value="<?php echo ($setting->rate);  ?>">

@endsection
<!-- content -->

@section('script')
    <script src="{{ asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
@endsection

@section('script_bottom')
<script src="{{ asset('assets/pages/scripts/table-datatables-managed.min.js') }}" type="text/javascript"></script>
<script>
$(document).ready(function() {
  $('#data-table').DataTable();
});
function isNotNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
        return false;
    return true;
}
var rate = $("#setting_rate").val();
function checkBalance(id)
{
    if(id) {
        var balance = (id / rate).toFixed(2);
        $("#amount-btp").val(balance);
        var bit = $("#coin_price").val();
        var eth = $("#eth_price").val();
        var ltc = $("#LTC_price").val();
        var dash = $("#dash_price").val();
        var dp =  parseFloat(id) / parseFloat(dash);
           var bp =  parseFloat(id) / parseFloat(bit);
           var ep =  parseFloat(id) / parseFloat(eth);
           var lp =  parseFloat(id) / parseFloat(ltc);
               var dp_round = Math.round(dp) * 0.11;
               var new_dp = dp + dp_round;
               
               var bp_round = Math.round(bp) * 0.11;
               var new_bp = bp + bp_round;

               var ep_round = Math.round(ep) * 0.11;
               var new_ep = ep + ep_round;

               var lp_round = Math.round(lp) * 0.11;
               var new_lp = lp + lp_round;
               
              $(".dash_price").html(parseFloat(new_dp).toFixed(4));
              $(".bit_price").html(parseFloat(new_bp).toFixed(4));
              $(".eth_price").html(parseFloat(new_ep).toFixed(4));
              $(".ltc_price").html(parseFloat(new_lp).toFixed(4));

              $("#dash_point").val(parseFloat(new_dp).toFixed(4));
              $("#bit_point").val(parseFloat(new_bp).toFixed(4));
              $("#eth_point").val(parseFloat(new_ep).toFixed(4));
              $("#ltc_point").val(parseFloat(new_lp).toFixed(4));
    } else {
        $("#amount-usd").val("");
    }
}
$(document).on("click",".buy_form",function(){
    var radioValue = $(this).val();
    if(radioValue == 1){
        $("#crypto_coin").show();
    }
    else{
        $("#crypto_coin").hide();
    }
});
</script>
@endsection

