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
                                <span class="caption-subject bold uppercase"> Withdraw Bitcoin</span>
                            </div>
                          
                        </div>

                        <div class="portlet-body">
                            <div class="caption font-blue-sunglo">
                        
                                <span class="caption-subject bold uppercase"> Send Bitcoin (BTC)</span>
                            </div>

                           <br>
                            <span>Your Bitcoin wallet balance: <b> 0.00000000 BTC</b></span><br>
                            <br>
                            @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
                            @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
                            <form  action="{{ url('withdraw') }}" method="post" >
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="input-icon">
                                                <i class="fa fa-chain"></i>
                                                <input class="form-control placeholder-no-fix" type="text" required autocomplete="off" placeholder="Bitcoin Address" name="btc_address" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="input-icon">
                                                <i class="fa fa-btc"></i>
                                                <input class="form-control placeholder-no-fix" type="number" required autocomplete="off" placeholder="mBTC Amount" name="mbtc_amt" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-success" ><i class="fa fa-btc"></i>&nbsp;WithDraw From BTC Wallet</button>
                            </form>
                            <hr>

                            <div class="panel panel-default">
                                <div class="panel-heading">Pending Withdraw Bitcoin Transactions</div>
                                <div class="panel-body">
                                    <table class="table">
                                        <thead>
                                        <th>DateTime</th>
                                        <th>ToAddress</th>
                                        <th>Transaction ID</th>
                                        <th>BTC Amount</th>
                                        <th>Admin Status</th>
                                        </thead>
                                        <tbody>
                                        @foreach($withdrawal as $withdraw)
                                        <tr>
                                            <td>{{ $withdraw->created_at }}</td>
                                            <td>{{ $withdraw->to_address }}</td>
                                            <td>{{ $withdraw->txid }}</td>
                                            <td>{{ $withdraw->btc }}</td>
                                            <td>@if($withdraw->status == 0) <span class="label label-sm label-danger">Admin Response Pending</span> @else <span class="label label-sm label-success" >Success</span> @endif </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="panel-footer">No Pending Withdraw Bitcoin transactions found.</div>
                            </div>
                            <span>After request, we will send your transaction to our fraud detection AI system. Your transaction will be processed quickly</span>
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
        });


    </script>
@endsection
<!-- script -->
