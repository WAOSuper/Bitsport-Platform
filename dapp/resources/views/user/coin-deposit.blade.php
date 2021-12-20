@extends('layouts.master')

<!-- head -->

@section('title')

   Buy BTP with Coin - Bitsport

@endsection

<!-- title -->

@section('head')



@endsection



@section('content')

    <!-- BEGIN CONTENT -->

    <div class="page-content-wrapper">

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

                                <span class="caption-subject bold uppercase"> BUY BTP with - {{$coin}}</span>

                            </div>

                            <div>

                                <!-- <button class="btn btn-success pull-right" disabled="">m<i class="fa fa-btc"></i> :- {{Sentinel::check()->mbtc}} </button> -->

                            </div>

                        </div>



                        <div class="portlet-body">

                             <div class="caption font-blue-sunglo">        

                                <span class="caption-subject bold uppercase">Receive </span>

                             </div>

                             @foreach($add as $add)

                             <div class="row">

                                 <div class="col-lg-12 pull-left" >

                                    <?php if($coin == 'EPAY'): ?>

                                    <div class="row">

                                        <div class="col-md-12">

                                            <form id="epayForm" name="form1" method="post" action="https://api.epay.com/paymentApi/merReceive" >

                                                 <div class="row">

                                                <input name="PAYEE_ACCOUNT" type="hidden" value="epay@bitplaytoken.com" size="40" />

                                                <input name="PAYEE_NAME" type="hidden" value="bitplaytoken" size="40" />

                                                <div class="col-md-6">

                                                <div class="form-group ">

                                                <label>Amount</label>

                                                <input onkeyup="updateHash(); updateUrl()" class="form-control" id="PAYMENT_AMOUNT" name="PAYMENT_AMOUNT" type="text" size="40" />

                                                </div>

                                                </div>

                                                <div class="col-md-6">

                                                    <select onchange="updateHash(); updateUrl()" class="payment-units" id="PAYMENT_UNITS" name="PAYMENT_UNITS">

                                                    <option value="USD">USD</option>

                                                    {{-- <option value="EUR">EUR</option>

                                                    <option value="HKD">HKD</option>

                                                    <option value="GBP">GBP</option>

                                                    <option value="JPY">JPY</option>

                                                    <option value="BTC">BTC</option>

                                                    <option value="ETH">ETH</option>

                                                    <option value="EOS">EOS</option>

                                                    <option value="BCH">BCH</option>

                                                    <option value="LTC">LTC</option>

                                                    <option value="XRP">XRP</option>

                                                    <option value="USDT">USDT</option> --}}

                                                </select>



                                                </div>

                                                </div>

                                                <input id="PAYMENT_ID" name="PAYMENT_ID" type="hidden" value="" size="40" />

                                                <input name="STATUS_URL" type="hidden" value="{{url('/')}}/epay-success" size="40" />

                                                <input id="PAYMENT_URL" name="PAYMENT_URL" type="hidden" value="{{url('/')}}/wallet" size="40" />

                                                <input id="NOPAYMENT_URL" name="NOPAYMENT_URL" type="hidden" value="{{url('/')}}/wallet" size="40" />



                                                <input name="V2_HASH" id="V2_HASH" type="hidden" value="" size="40" />

                                                <input name="submit" class="btn blue"  type="submit" value="submit" />

                                            </form>

                                        </div>

                                    </div>

                                    <?php else: ?>

                                    <div style="float: left;" >

                                

                                        <img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl={{$add->address}}">

                                          

                                    </div>

                                    <div style="float: left;width: 350px;" >

                                    

                                      <br>  

                                    <span><b>{{$coin}} Deposit Address: </b><br></span> 

                                    <input type="text" value="{{$add->address}}" class="form-control" name="" style="height: 45px;" disabled> </br>
                                    <span><b>Amount (BTP): </b><br></span> 

                                    <input type="text" value="{{$usdp}}" class="form-control" name="" style="height: 45px;" disabled> </br>
                                    <span><b>Amount ({{$coin}}): </b><br></span> 


                                    <input type="text" value="{{$coin_point}}" class="form-control" name="" style="height: 45px;" disabled>

                                    </div>

                                 

                                      <br> 

                                    <?php endif; ?>

                                </div>

                            </div>

                             @endforeach

                                <br>

                                <?php if($coin != 'EPAY'): ?>

                                <span style="color: red;">

                                    <ul>

                    <li> Remember: CHECK the FIRST 4 characters and the LAST 4 characters of the {{$coin}} address when you PASTE it elsewhere</li>

                     <li>Important: This deposit address is for {{$coin}} only. We will not refund an incorrect Deposit.          </li>

                                    <li>Don't worry. If you don't receive any transaction. Please click 'Refresh' or 'Don't Receive Your Deposit' or contact support</li>

                                    <li>You can deposit {{$coin}} from anywhere. Include exchange market</li>

                            </ul>

                            </span>

                            <?php endif; ?>

                                <a href="" class="btn btn-info pull-right"><i class="fa fa-refresh"></i>refresh</a>

                                <br>

                            <br>

                            <hr>

                            <div class="panel panel-default">

                                <br>

                                <div class="panel-heading">Transactions History</div>

                                <br>

                                <div class="panel-body">

                                    <table class="table">

                                        <thead>

                                        <th>TX Date</th>

                                        <th>TXN Id</th>

                                        <th>Amount</th>

                                        <th>Confirms</th>

                                        </thead>

                                        <?php $i=1; ?>

                                        <tbody>

                                        @foreach($deposit as $dpst)

                                        <tr>

                                            <td>{{ $dpst->created_at }}</td>

                                            <td>{{ $dpst->txid }}</td>

                                            <td>{{ $dpst->amount }}</td>

                                            <td>@if($dpst->status == 0) Waiting for Confirmations... @else {{ $dpst->confirms }} @endif</td>

                                        </tr>

                                        @endforeach

                                        </tbody>

                                    </table>

                                </div>

                                @if(count($deposit) < 1)

                                    <div class="panel-footer">No Incoming {{$coin}} transactions found.</div>

                                @endif

                            </div>

                            <span>We require minimum 3 confirmations to complete transaction. On average, each confirmation takes about 15 minutes. It can take more time depending on the {{$coin}} network. Kindly wait patiently.</span>

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

                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                        <input type="text" class="form-control" id="tx_id" name="tx_id" placeholder="Tx ID">

                    </form>

                </div>

                <div class="modal-footer">

                    <button type="button" id="check-tx" class="btn btn-success" data-dismiss="modal">Submit</button>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

                </div>

            </div>



        </div>

    </div>

    <!-- END CONTENT -->

                    </div>

                </div>

            </div>

        </div>

    </div>



<style>

.payment-units {

    margin-top: 25px;

    width: 180px;

    height: 34px;

    border-radius: 4px;

}

</style>



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

        $('#check-tx').on('click', function(){

            var txid = $('#tx_id').val();

            var token = $('#token').val();



            console.log(txid);

            $.ajax({

                type: 'post',

                url:"{{url('tx-details')}}",

                data: "txid="+txid+'&_token='+token,

                success: function (responseData) {

                    console.log(responseData);

                },

                error: function (responseData) {

                    console.log(responseData);

                    return false;

                }

            });

        });



        var MD5 = function(d){result = M(V(Y(X(d),8*d.length)));return result.toLowerCase()};function M(d){for(var _,m="0123456789ABCDEF",f="",r=0;r<d.length;r++)_=d.charCodeAt(r),f+=m.charAt(_>>>4&15)+m.charAt(15&_);return f}function X(d){for(var _=Array(d.length>>2),m=0;m<_.length;m++)_[m]=0;for(m=0;m<8*d.length;m+=8)_[m>>5]|=(255&d.charCodeAt(m/8))<<m%32;return _}function V(d){for(var _="",m=0;m<32*d.length;m+=8)_+=String.fromCharCode(d[m>>5]>>>m%32&255);return _}function Y(d,_){d[_>>5]|=128<<_%32,d[14+(_+64>>>9<<4)]=_;for(var m=1732584193,f=-271733879,r=-1732584194,i=271733878,n=0;n<d.length;n+=16){var h=m,t=f,g=r,e=i;f=md5_ii(f=md5_ii(f=md5_ii(f=md5_ii(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_ff(f=md5_ff(f=md5_ff(f=md5_ff(f,r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+0],7,-680876936),f,r,d[n+1],12,-389564586),m,f,d[n+2],17,606105819),i,m,d[n+3],22,-1044525330),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+4],7,-176418897),f,r,d[n+5],12,1200080426),m,f,d[n+6],17,-1473231341),i,m,d[n+7],22,-45705983),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+8],7,1770035416),f,r,d[n+9],12,-1958414417),m,f,d[n+10],17,-42063),i,m,d[n+11],22,-1990404162),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+12],7,1804603682),f,r,d[n+13],12,-40341101),m,f,d[n+14],17,-1502002290),i,m,d[n+15],22,1236535329),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+1],5,-165796510),f,r,d[n+6],9,-1069501632),m,f,d[n+11],14,643717713),i,m,d[n+0],20,-373897302),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+5],5,-701558691),f,r,d[n+10],9,38016083),m,f,d[n+15],14,-660478335),i,m,d[n+4],20,-405537848),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+9],5,568446438),f,r,d[n+14],9,-1019803690),m,f,d[n+3],14,-187363961),i,m,d[n+8],20,1163531501),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+13],5,-1444681467),f,r,d[n+2],9,-51403784),m,f,d[n+7],14,1735328473),i,m,d[n+12],20,-1926607734),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+5],4,-378558),f,r,d[n+8],11,-2022574463),m,f,d[n+11],16,1839030562),i,m,d[n+14],23,-35309556),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+1],4,-1530992060),f,r,d[n+4],11,1272893353),m,f,d[n+7],16,-155497632),i,m,d[n+10],23,-1094730640),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+13],4,681279174),f,r,d[n+0],11,-358537222),m,f,d[n+3],16,-722521979),i,m,d[n+6],23,76029189),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+9],4,-640364487),f,r,d[n+12],11,-421815835),m,f,d[n+15],16,530742520),i,m,d[n+2],23,-995338651),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+0],6,-198630844),f,r,d[n+7],10,1126891415),m,f,d[n+14],15,-1416354905),i,m,d[n+5],21,-57434055),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+12],6,1700485571),f,r,d[n+3],10,-1894986606),m,f,d[n+10],15,-1051523),i,m,d[n+1],21,-2054922799),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+8],6,1873313359),f,r,d[n+15],10,-30611744),m,f,d[n+6],15,-1560198380),i,m,d[n+13],21,1309151649),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+4],6,-145523070),f,r,d[n+11],10,-1120210379),m,f,d[n+2],15,718787259),i,m,d[n+9],21,-343485551),m=safe_add(m,h),f=safe_add(f,t),r=safe_add(r,g),i=safe_add(i,e)}return Array(m,f,r,i)}function md5_cmn(d,_,m,f,r,i){return safe_add(bit_rol(safe_add(safe_add(_,d),safe_add(f,i)),r),m)}function md5_ff(d,_,m,f,r,i,n){return md5_cmn(_&m|~_&f,d,_,r,i,n)}function md5_gg(d,_,m,f,r,i,n){return md5_cmn(_&f|m&~f,d,_,r,i,n)}function md5_hh(d,_,m,f,r,i,n){return md5_cmn(_^m^f,d,_,r,i,n)}function md5_ii(d,_,m,f,r,i,n){return md5_cmn(m^(_|~f),d,_,r,i,n)}function safe_add(d,_){var m=(65535&d)+(65535&_);return(d>>16)+(_>>16)+(m>>16)<<16|65535&m}function bit_rol(d,_){return d<<_|d>>>32-_}



        function updateHash()

        {

            var API_KEY = "{{env('EPAY_API_KEY')}}"

            var api_key_1 = '50d44935ebebdcf8fcc25463da2d7c79';

            var api_key_2 = '833fd00d47db78153bbb474aa82bdde8';



            var user_name_1 =  'devanshugupta28@gmail.com';

            var user_name_2 =  'gdevanshu05@gmail.com';



            var user_name = 'epay@bitplaytoken.com';

            var api_key = '2a1fb9eb945320cef34855972704df5d';



            var hash = MD5(user_name+':'+$("#PAYMENT_AMOUNT").val()+':'+$("#PAYMENT_UNITS").val()+':'+api_key);

            $('#V2_HASH').val(hash);

        }



        function updatePaymentId()

        {

            $('#PAYMENT_ID').val("{{time().$user_id}}");

        }



        $(document).ready(function(){

            $('#epayForm').submit(function() {

                $.post("{{url('/')}}/add-transaction",{

                    payment_id:$('#PAYMENT_ID').val(),

                    hash:$('#V2_HASH').val(),

                    amount:$('#PAYMENT_AMOUNT').val(),

                    user_id:"{{$user_id}}"

                },function(response){



                });

                return true;

            });

            updateHash();

            updatePaymentId();

        });

    </script>

@endsection

