@extends('layouts.master')
<!-- head -->
@section('title')
    Betting
@endsection
<!-- title -->
@section('head')

@endsection

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
            </div>
            <div class="row">
                <div class="col-lg-12 col-xs-12 col-sm-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-blue-sunglo">
                                <i class="icon-settings font-blue-sunglo"></i>
                                <span class="caption-subject bold uppercase"> Deposit Bitcoin</span>
                            </div>
                            <div>
                                <button class="btn btn-success pull-right" disabled="">m<i class="fa fa-btc"></i> :- {{Sentinel::check()->mbtc}} </button>
                            </div>
                        </div>
                        <div class="portlet-body">
                             <div class="caption font-blue-sunglo">        
                                <span class="caption-subject bold uppercase">Receive BitCoin (BTC)</span>
                             </div>

  @if(Sentinel::getUser()->btc_address)
                            <div class="col-lg-12 pull-left" >
                                <div style="float: left;" ><img  src="https://chart.googleapis.com/chart?chs=150x150&chld=L|2&cht=qr&chl=bitcoin:{{ Sentinel::getUser()->btc_address }}"></div>
                                <div style="float: left;width: 350px;" >
                                
                                  <br>  
                                <!-- <span><b>Your BitCoin Deposit Address Is: </b><br></span> -->
                                <input type="text" value="{{Sentinel::getUser()->btc_address}}" class="form-control" name="" style="height: 45px;"></div>
                                  <br> 
                            </div>
                                <br>
                                <span style="color: red;">
                            <ul>
                    <li> Remember: CHECK the FIRST 4 characters and the LAST 4 characters of the Bitcoin address when you PASTE it elsewhere</li>
                     <li>Important: This deposit address is for BitCoin (BTC) only. We will not refund an incorrect Deposit.          </li>
                                    <li>Don't worry. If you don't receive any transaction. Please click 'Refresh' or 'Don't Receive Your Deposit' or contact support</li>
                                    <li>You can deposit Bitcoin from anywhere. Include exchange market</li>
                            </ul>
                            </span>
                                <button type="button" class="btn btn-info pull-left" data-toggle="modal" data-target="#get_transaction">Don't Receive Your Deposite</button>
                                <a href="" class="btn btn-info pull-right"><i class="fa fa-refresh"></i>refresh</a>

                            @else
                            <div class="col-lg-12 pull-left" >
                                <br>
                                  <br> 
                                <span>Your BitCoin Deposit Address Is:</span><br><br>
                                <a href="{{ url('generate-address') }}" class="btn btn-success"><i class="fa fa-btc"></i>&nbsp;Get Deposit Bitcoin Address</a>
                             <br>
                             <br>
                            </div>
                            @endif






                            <br>
                            <br>
                            <hr>
                            <div class="panel panel-default">
                                <br>
                                <div class="panel-heading">Incoming Bitcoin Transactions</div>
                                <br>
                                <div class="panel-body">
                                    <table class="table">
                                        <thead>
                                        <th>TXID</th>
                                        <th>BTC</th>
                                        <th>Confirmation</th>
                                        <th>TX Date</th>
                                        </thead>
                                        <tbody>
                                        @foreach($address as $dpst)
                                        <tr>
                                            <td>{{ $dpst->txid }}</td>
                                            <td>{{ $dpst->btc }}</td>
                                            <td>@if($dpst->status == 0) Admin Confirmation Pending @else Admin Approved @endif</td>
                                            <td>{{ $dpst->created_at }}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="panel-footer">No Incoming Bitcoin transactions found.</div>
                            </div>
                            <span>We require minimum 3 confirmations to complete transaction. On average, each confirmation takes about 15 minutes. It can take more time depending on the Bitcoin network so do not worry and wait quietly.</span>
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

@endsection

@section('script_bottom')
    <script type="application/javascript" >
        $('#otpToggleButton').on('click', function () {
            $.ajax({
                type: 'get',
                url:"{{url('2fa/enable')}}",
                success: function (responseData) {
                    $('.qrcode').empty();
                    $('.secret').empty();
                    $('.qrcode').append('<img src="'+responseData['imgurl']+'">');
                    $('.secret').text(responseData['secret']);
                },
                error: function (responseData) {
                    console.log(responseData);
                    return false;
                }
            });
            $('#qrModal').modal('show');
        });

        $('#submitGauth').on('click', function () {
            var code = $('#otpCode').val();
            var token = $('#token').val();

            console.log(code);
            $.ajax({
                type: 'post',
                url:"{{url('2fa/validate')}}",
                data: "code="+code+'&_token='+token,
                success: function (responseData) {
                    console.log(responseData);
                },
                error: function (responseData) {
                    console.log(responseData);
                    return false;
                }
            });
            $('#qrModal').modal('show');
        })
    </script>
@endsection
<!-- script -->
