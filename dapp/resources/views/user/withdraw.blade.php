@extends('layouts.master')
<!-- head -->
@section('title')
    BitSport | Withdrawal
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
                            <span class="caption-subject bold uppercase"> Withdraw - {{$coin_name}}</span>
                        </div>                      
                    </div>
                    <div class="portlet-body">
                        <div class="caption font-blue-sunglo">                    
                            <span class="caption-subject bold uppercase"> Send {{$coin_type}} Withdrawal</span>
                        </div>
                       <br>
                        <span>Your {{$coin_name}} wallet balance: <b>  (@if($coin_type=='BTC')  {{number_format(Sentinel::getUser()->total_btc_bal,8)}} @elseif($coin_type=='ETH')   {{number_format(Sentinel::getUser()->total_eth_bal,8)}}@elseif($coin_type=='LTC')   {{number_format(Sentinel::getUser()->total_ltc_bal,8)}}@elseif($coin_type=='DASH')   {{number_format(Sentinel::getUser()->total_dash_bal,8)}}@elseif($coin_type=='EPAY')   {{number_format(
                        Sentinel::getUser()->total_epay_bal,2)}}@elseif($coin_type=='paypal')   {{number_format(Sentinel::getUser()->total_paypal_bal,2)}}@elseif($coin_type=='BTP')   {{number_format(Sentinel::getUser()->mbtc,8)}} @endif  {{$coin_type}})</b></span><br>
                        <br>
                        @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
                        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
                        <form  action="{{ url('withdraw') }}" method="post" >
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="user_id" value="{{Sentinel::getUser()->id}}">
                            <input type="hidden" name="coin_name" value="{{$coin_type}}">
                            
                            <div id="alert-msg"></div>                                  
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="input-icon">
                                            <i class="fa fa-chain"></i>
                                            <input class="form-control placeholder-no-fix" type="text" required autocomplete="off" placeholder="Withdrawal Address" name="coin_address" id="addres">
                                            <span class="text-danger">{{ $errors->first('address_withdraw') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="input-icon">
                                            <i class="fa fa-btc"></i>
                                            <input class="form-control placeholder-no-fix" type="number" required autocomplete="off" id="amount-withdraw" name="amount_withdraw" placeholder="0.00" value="" step="any" onkeyup="checkBalance()"> 
                                            <span class="text-danger">{{ $errors->first('amount_withdraw') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success" id="Withdraw-btn"><i class="fa fa-btc"></i>&nbsp;WithDraw From {{$coin_type}} Wallet</button>
                        </form>
                        <hr>

                        <div class="panel panel-default">
                            <div class="panel-heading">List Withdraw Transactions</div>
                            <div class="panel-body table-responsive">
                                <table class="table table-bordered table-hover table-checkable" id="data-table">
                                    <thead>
                                    <th>Date andTime</th>
                                    <th>ToAddress</th>
                                    <th>Transaction ID</th>
                                    <th>{{$coin_name}} Amount</th>
                                    <th>Admin Status</th>
                                    <th>Coin Type</th>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; ?>
                                    @foreach($withdraw as $withdraw)
                                    <tr>
                                        <td>{{ $withdraw->created_at }}</td>
                                        <td>{{ $withdraw->address }}</td>
                                        <td>{{ $withdraw->txid }}</td>
                                        <td>{{ number_format($withdraw->amount,8)}}</td>
                                        <td>@if($withdraw->admin_status == 0) 
                                                <span class="badge badge-primary"> Pending </span>
                                            @elseif($withdraw->admin_status == 1)
                                                <span class="badge badge-success"> Approved </span>
                                            @elseif($withdraw->admin_status == 2)
                                                <span class="badge badge-danger"> Reject </span>
                                            @endif 
                                        </td>
                                        <td>
                                            @if($withdraw->coin == 'BTC')
                                                <span class="badge badge-warning"> BTC </span>
                                            @elseif($withdraw->coin == 'ETH')
                                                <span class="badge badge-danger"> ETH </span>
                                            @elseif($withdraw->coin == 'LTC')
                                                <span class="badge badge-primary"> LTC </span>
                                            @elseif($withdraw->coin == 'DASH')
                                                <span class="badge badge-success"> DASH </span>
                                            @elseif($withdraw->coin == 'EPAY')
                                                <span class="badge badge-success"> EPAY </span>
                                             @elseif($withdraw->coin == 'paypal')
                                                <span class="badge badge-success"> PayPal </span>
                                                @elseif($withdraw->coin == 'BTP')
                                                <span class="badge badge-success"> BTP </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="panel-footer">No Pending {{$coin_name}} Withdrawal transactions found.</div>
                        </div>
                        <span>After request, your transaction is sent to our AI screening system for a brief check and deposited to your selected wallet or account.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="get_transaction" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Input Your Transaction ID</h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="text" class="form-control" name="tx_id" placeholder="Tx ID">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Submit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancle</button>
            </div>
        </div>

    </div>
</div>
<!-- END CONTENT -->

@endsection
<!-- content -->


@section('script')
<script>
$(document).ready(function() {
  $('#data-table').DataTable();
});

function checkBalance()
{
  var coin='<?php echo $coin_type ?>';

  if(coin=='BTC'){  var balance= <?php echo Sentinel::getUser()->total_btc_bal ?>; }
  else if(coin=='ETH') { var balance= <?php echo Sentinel::getUser()->total_eth_bal ?>;  }
  else if(coin=='LTC') { var balance= <?php echo Sentinel::getUser()->total_ltc_bal ?>;  }
  else if(coin=='DASH') { var balance= <?php echo Sentinel::getUser()->total_dash_bal ?>; }
  else if(coin=='EPAY') { var balance= <?php echo Sentinel::getUser()->total_epay_bal ?>; }
  else if(coin=='paypal') { var balance= <?php echo Sentinel::getUser()->total_paypal_bal ?>; }
  else if(coin=='BTP') { var balance= <?php echo Sentinel::getUser()->mbtc ?>; }
  else {  var balance=0; }


  var amount= $("#amount-withdraw").val();

  if(amount<=balance && amount>0)
  {
     $("#Withdraw-btn").prop('disabled', false); 
      $("#alert-msg").html("");
  }
  else
  {
    $("#Withdraw-btn").prop('disabled', true); 
    $("#alert-msg").html("<p class='alert alert-danger'>Insuficient balance.</p>")
  }
}
</script>

@endsection
@section('script')
    <script src="{{ asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
@endsection

@section('script_bottom')
    <script src="{{ asset('assets/pages/scripts/table-datatables-managed.min.js') }}" type="text/javascript"></script>
@endsection
<!-- script -->
