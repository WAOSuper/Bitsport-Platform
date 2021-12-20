@extends('layouts.master')
<!-- head -->
@section('title')
    My Wallet | BitSport™
@endsection
<!-- title -->
@section('head')
    <style>
        .cms-modal-main-div{
            padding-right: 30em;
        }
        #soflow-color{
            -webkit-appearance: button;
   -webkit-border-radius: 2px;
   -webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
   -webkit-padding-end: 20px;
   -webkit-padding-start: 2px;
   -webkit-user-select: none;
    background-image: url(../assets/images/coins/select.png), -webkit-linear-gradient(#FAFAFA, #F4F4F4 40%, #E5E5E5);
     background-position: 97% center;
   background-repeat: no-repeat;
   border: 1px solid #AAA;
   color: #555;
   font-size: inherit;
   margin: 20px;
   overflow: hidden;
   padding: 5px 10px;
   text-overflow: ellipsis;
   white-space: nowrap;
   width: 300px;
    </style>
@endsection
    
@section('content')


@section('content')

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="min-height: 1489px;">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>Wallet </h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="javascript:;">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">Wallet</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <div class="row">

        </div>
        
        <div class="row">

            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">Deposits</span>
                        </div>
                        <div class="tools"></div>
                    </div>
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if(session('error'))
                        <div class="alert alert-error">
                            {{ session('error') }}
                        </div>
                        @endif
                    <div class="portlet-body">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <tr>
                                <th>Coin</th>
                                <th>Coin Name</th>
                                <th>Total Balance</th>
                                <th>Action</th>
                                <th>Convert To BTP Balance</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>    
                                <td><img src="{{url('/')}}/assets/images/coins/bitcoin.png" width="25px" alt="btc"></td>
                                <td>BTC</td>
                                <td>{{number_format(Sentinel::getUser()->total_btc_bal,8)}} BTC</td>
                                <td>
                                    <a href="{{url('/')}}/deposit/BTC" class="btn btn-primary ">Deposit</a>
                                    <a  class="btn btn-danger" @if($withdrawal->withdrawal == 1) href="{{ url('withdraw/BTC') }}@endif " @if($withdrawal->withdrawal == 0) disabled="" @endif>Withdraw</a>
                                </td>
                                @if(Sentinel::getUser()->total_btc_bal > 0)
                                <td><a href="{{url('/')}}/btp-convert/BTC" class="btn btn-success" onclick="return confirm('Are you sure You want to Convert BTC Balance to BTP Balance ?')">Swap All to BTP</a>
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#ConvertBTC{{$user->id}}">Custom Amount Swap</a></td>
                                @else
                                    <td><span class="text-danger"> Insufficient BTC Balance</span></td>
                                @endif
                            </tr>
                            <tr>    
                                <td><img src="{{url('/')}}/assets/images/coins/eth.png" width="28px" alt="eth"></td>
                                <td>ETH</td>
                                <td>{{number_format(Sentinel::getUser()->total_eth_bal,8)}} ETH</td>
                                <td><a href="{{url('/')}}/deposit/ETH" class="btn btn-primary ">Deposit</a>
                                    <a class="btn btn-danger" @if($withdrawal->withdrawal == 1) href="{{ url('withdraw/ETH') }}@endif" @if($withdrawal->withdrawal == 0) disabled="" @endif >Withdraw</button></a>
                                </td>
                                @if(Sentinel::getUser()->total_eth_bal > 0)
                                <td><a href="{{url('/')}}/btp-convert/ETH" class="btn btn-success" onclick="return confirm('Are you sure You want to Convert ETH Balance to BTP Balance ?')">Swap All To BTP</a>
                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#ConvertETH{{$user->id}}">Custom Amount Swap</a>
                                </td>
                                @else
                                    <td><span class="text-danger"> Insufficient ETH Balance</span></td>
                                @endif
                            </tr>
                            <tr>
                                <td><img src="{{url('/')}}/assets/images/coins/ltc.png" width="28px" height="30px" alt="ltc"></td>
                                <td>LTC</td>
                                <td>{{number_format(Sentinel::getUser()->total_ltc_bal,8)}} LTC</td>
                                <td><a href="{{url('/')}}/deposit/LTC" class="btn btn-primary ">Deposit</a>
                                    <a class="btn btn-danger" @if($withdrawal->withdrawal == 1) href="{{ url('withdraw/LTC') }}@endif " @if($withdrawal->withdrawal == 0) disabled="" @endif>Withdraw</button></a>
                                </td>
                                @if(Sentinel::getUser()->total_ltc_bal > 0)
                                <td><a href="{{url('/')}}/btp-convert/LTC" class="btn btn-success" onclick="return confirm('Are you sure You want to Convert LTC Balance to BTP Balance ?')">Swap All to BTP</a>
                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#ConvertLTC{{$user->id}}">Custom Amount Swap</a>  
                                </td>
                                @else
                                    <td><span class="text-danger"> Insufficient LTC Balance</span></td>
                                @endif
                            </tr> 
                            <tr>        
                                <td><img src="{{url('/')}}/assets/images/coins/dash.png" width="40px" alt="dash"></td>
                                <td>Dash</td>
                                <td>{{number_format(Sentinel::getUser()->total_dash_bal,8)}} DASH</td>
                                <td><a href="{{url('/')}}/deposit/DASH" class="btn btn-primary ">Deposit</a>
                                    <a class="btn btn-danger" @if($withdrawal->withdrawal == 1) href="{{ url('withdraw/DASH') }}@endif " @if($withdrawal->withdrawal == 0) disabled="" @endif  >Withdraw</button></a>
                                </td>
                                @if(Sentinel::getUser()->total_dash_bal > 0)
                                <td><a href="{{url('/')}}/btp-convert/DASH" class="btn btn-success" onclick="return confirm('Are you sure You want to Convert DASH Balance to BTP Balance ?')">Swap All to BTP</a>
                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#ConvertDASH{{$user->id}}">Custom Amount Swap</a>
                                </td>
                                @else
                                    <td><span class="text-danger"> Insufficient DASH Balance</span></td>
                                @endif
                            </tr>
                            <tr>        
                                <td><img src="{{url('/')}}/assets/images/coins/epay.png" width="40px" alt="epay"></td>
                                <td>Epay</td>
                                <td>{{number_format(Sentinel::getUser()->total_epay_bal,2)}} USD</td>
                                <td><a href="{{url('/')}}/deposit/EPAY" class="btn btn-primary ">Deposit</a>
                                    <a class="btn btn-danger" @if($withdrawal->withdrawal == 1) href="{{ url('withdraw/EPAY') }}@endif " @if($withdrawal->withdrawal == 0) disabled="" @endif  >Withdraw</button></a>
                                </td>
                                @if(Sentinel::getUser()->total_epay_bal > 0)
                                <td><a href="{{url('/')}}/btp-convert/EPAY" class="btn btn-success" onclick="return confirm('Are you sure You want to Convert EPAY Balance to BTP Balance ?')">Swap All To BTP</a>
                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#ConvertEPAY{{$user->id}}">Custom Amount Swap</a>
                                </td>
                                @else
                                    <td><span class="text-danger"> Insufficient Epay Balance</span></td>
                                @endif
                            </tr>
                            <tr>        
                                <td><img src="{{url('/')}}/assets/images/coins/btpcoin.png" width="40px" alt="dash"></td>
                                <td>BTP</td>
                                <td>{{number_format(Sentinel::getUser()->mbtc,8)}} BTP</td>
                                <td>
                                    <!-- <a class="btn btn-danger" @if($withdrawal->withdrawal == 1) href="{{ url('withdraw/BTP') }}@endif " @if($withdrawal->withdrawal == 0) disabled="" @endif  >Withdraw</button></a> -->
                                </td>
                                @if(Sentinel::getUser()->mbtc > 0) 
                                <td><label><b>Send BTP Balance to  </b></label>
                                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#ToConvertBTC">BTC</a>
                                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#ToConvertETH">ETH</a>
                                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#ToConvertLTC">LTC</a>
                                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#ToConvertDASH">DASH</a>
                                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#ToConvertEPAY">EPAY</a>
                                </td>    
                                @else    
                                <td><label><b>Send BTP Balance to -</b></label>
                                    <button class="btn btn-warning" disabled="">BTC</button>
                                    <button class="btn btn-warning" disabled="">ETH</button>
                                    <button class="btn btn-warning" disabled="">LTC</button>
                                    <button class="btn btn-warning" disabled="">DASH</button>
                                    <button class="btn btn-warning" disabled="">EPAY</button>
                                @endif    
                                </td>
                            </tr>                           
                            </tbody>
                        </table>
                        <!-- Button Modals  -->
                        <div class="modal fade" id="ConvertBTC{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body"><h3>Convert BTC Balance to BTP Balance?</h3>
                                        {{Form::open([ 'id'=>'formsubmitBTC'.$user->id, 'url' => url("addbal/$user->id"), 'method' => 'POST'])}}
                                        <input type="hidden" name="coin_name" value="BTC">
                                            <tr id="btcTR" class="ccConvert">  
                                                <td><label>Enter BTC Balance</label><span class="BtctoBtp text-danger"></span>   
                                                    <input type="number" step="0.000000000000001" min="0" name="bal" class="form-control text" autocomplete="off" id="btcbtp" oninput="btpbtcConverter(this.value)" onchange="btpbtcConverter(this.value)" class="btpText" placeholder="Enter BTC Amount">
                                                </td>
                                                <td><label>BTP Balance</label><span class="BtctoBtp2 text-danger"></span> 
                                                  <input type="number" class="form-control text" placeholder="BTP Amount" name="BTP" id="btpbtc" value="" class="ccText" oninput="btcConverter(this.value)" onchange="btcConverter(this.value)" step="0.00000001" min="0">
                                                </td>
                                            </tr>
                                        {{ Form::close() }}
                                        <div class="modal-footer">
                                            <button form="formsubmitBTC{{$user->id}}" id="BtctoBtp" type="submit" class="btn btn-success" >Submit</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="ConvertETH{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body"><h3>Convert ETH Balance to BTP Balcance?</h3>
                                        {{Form::open([ 'id'=>'formsubmitETH'.$user->id, 'url' => url("addbal/$user->id"), 'method' => 'POST'])}}
                                        <input type="hidden" name="coin_name" value="ETH">
                                            <tr id="ethTR" class="ccConvert">  
                                                <td><label>Enter ETH Balance</label> <span class="EthtoBtp text-danger"></span>   
                                                    <input type="number" step="0.000000000000001" min="0" name="bal" class="form-control text" id="ethbtp" oninput="btpethConverter(this.value)" onchange="btpethConverter(this.value)" autocomplete="off" class="btpText" placeholder="Enter ETH Amount">
                                                </td>
                                                <td><label>BTP Balance</label>
                                                  <input type="text" class="form-control text" placeholder="BTP Amount" name="BTP" id="btpeth" value="" class="ccText" oninput="ethConverter(this.value)" onchange="ethConverter(this.value)" step="0.00000001" min="0">
                                                </td>
                                            </tr>
                                        {{ Form::close() }}
                                        <div class="modal-footer">
                                            <button form="formsubmitETH{{$user->id}}" id="EthtoBtp" type="submit" class="btn btn-success" >Submit</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="ConvertLTC{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body"><h3>Convert LTC Balance to BTP Balcance?</h3>
                                        {{Form::open([ 'id'=>'formsubmitLTC'.$user->id, 'url' => url("addbal/$user->id"), 'method' => 'POST'])}}
                                        <input type="hidden" name="coin_name" value="LTC">
                                            <tr id="ltcTR" class="ccConvert">  
                                                <td><label>Enter LTC Balance</label><span class="LtctoBtp text-danger"></span>   
                                                    <input type="number" step="0.000000000000001" min="0" name="bal" class="form-control text" id="ltcbtp" oninput="btpltcConverter(this.value)" onchange="btpltcConverter(this.value)" autocomplete="off" class="btpText" placeholder="Enter LTC Amount">
                                                </td>
                                                <td><label>BTP Balance</label>
                                                  <input type="number" class="form-control text" placeholder="BTP Amount" name="BTP" id="btpltc" value="" class="ccText" oninput="ltcConverter(this.value)" onchange="ltcConverter(this.value)" step="0.00000001" min="0">
                                                </td>
                                            </tr>
                                        {{ Form::close() }}
                                        <div class="modal-footer">
                                            <button form="formsubmitLTC{{$user->id}}" id="LtctoBtp" type="submit" class="btn btn-success" >Submit</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="ConvertDASH{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body"><h3>Convert DASH Balance to BTP Balcance?</h3>
                                        {{Form::open([ 'id'=>'formsubmitDASH'.$user->id, 'url' => url("addbal/$user->id"), 'method' => 'POST'])}}
                                        <input type="hidden" name="coin_name" value="DASH">
                                            <tr id="dashTR" class="ccConvert">  
                                                <td><label>Enter DASH Balance</label><span class="DashtoBtp text-danger"></span>    
                                                    <input type="number" step="0.000000000000001" min="0" name="bal" class="form-control text" id="dashbtp" oninput="btpdashConverter(this.value)" onchange="btpdashConverter(this.value)" autocomplete="off" class="btpText" placeholder="Enter DASH Amount">
                                                </td>
                                                <td><label>BTP Balance</label>
                                                  <input type="number" class="form-control text" placeholder="BTP Amount" name="BTP" id="btpdash" value=""class="ccText" oninput="dashConverter(this.value)" onchange="dashConverter(this.value)" step="0.00000001" min="0">
                                                </td>
                                            </tr>
                                        {{ Form::close() }}
                                        <div class="modal-footer">
                                            <button form="formsubmitDASH{{$user->id}}" id="DashtoBtp" type="submit" class="btn btn-success" >Submit</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="ConvertEPAY{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body"><h3>Convert EPAY Balance to BTP Balcance?</h3>
                                        {{Form::open([ 'id'=>'formsubmitEPAY'.$user->id, 'url' => url("addbal/$user->id"), 'method' => 'POST'])}}
                                        <input type="hidden" name="coin_name" value="EPAY">
                                            <tr id="epayTR" class="ccConvert">  
                                                <td><label>Enter EPAY Balance</label><span class="DashtoBtp text-danger"></span>    
                                                    <input type="number" step="0.000000000000001" min="0" name="bal" class="form-control text" id="epaybtp" oninput="btpepayConverter(this.value)" onchange="btpepayConverter(this.value)" autocomplete="off" class="btpText" placeholder="Enter EPAY Amount">
                                                </td>
                                                <td><label>BTP Balance</label>
                                                  <input type="number" class="form-control text" placeholder="BTP Amount" name="BTP" id="btpepay" value=""class="ccText" oninput="epayConverter(this.value)" onchange="epayConverter(this.value)" step="0.00000001" min="0">
                                                </td>
                                            </tr>
                                        {{ Form::close() }}
                                        <div class="modal-footer">
                                            <button form="formsubmitEPAY{{$user->id}}" id="EpaytoBtp" type="submit" class="btn btn-success" >Submit</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Select Option -->  
                        <div class="modal fade" id="ToConvertBTC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body"><h3>Convert BTP Balance to BTC Balance?</h3>
                                        {{Form::open([ 'id'=>'formBTC'.$user->id, 'url' => url("baladd/$user->id"), 'method' => 'POST'])}}
                                        <input type="hidden" name="coin_name" value="btc">
                                            <tr id="btcTR" class="ccConvert">  
                                                <td><label>Enter BTP Balance</label><span class="BtptoBtc text-danger"></span>
                                                  <input type="number" step="0.000000000000001" min="0" class="form-control text" autocomplete="off" placeholder="Enter BTP Amount" name="BTP" oninput="btc(this.value)" onchange="btc(this.value)" class="ccText" id="btc1">
                                                </td>
                                                <td><label>BTC Balance</label>
                                                    <input type="number" name="add_bal" class="form-control text" id="btcbtpto" class="btpText" placeholder="BTC Amount" oninput="btc2(this.value)" onchange="btc2(this.value)" step="0.00000001" min="0">
                                                </td>
                                            </tr>
                                        {{ Form::close() }}
                                        <div class="modal-footer">
                                            <button form="formBTC{{$user->id}}" id="BtptoBtc" type="submit" class="btn btn-success" >Submit</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="ToConvertETH" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body"><h3>Convert BTP Balance to ETH Balance?</h3>
                                        {{Form::open([ 'id'=>'formETH'.$user->id, 'url' => url("baladd/$user->id"), 'method' => 'POST'])}}
                                        <input type="hidden" name="coin_name" value="eth">
                                            <tr id="ethTR" class="ccConvert">  
                                                <td><label>Enter BTP Balance</label><span class="BtptoEth text-danger"></span>
                                                  <input type="number" step="0.000000000000001" min="0" class="form-control text" autocomplete="off" placeholder="Enter BTP Amount" name="BTP" value="" oninput="eth(this.value)" onchange="eth(this.value)" class="ccText" id="eth1">
                                                </td>
                                                <td><label>ETH Balance</label>
                                                    <input type="number" name="add_bal" class="form-control text" id="ethbtpto" class="ethText" placeholder="eth Amount" oninput="eth2(this.value)" onchange="eth2(this.value)" step="0.00000001" min="0">
                                                </td>
                                            </tr>
                                        {{ Form::close() }}
                                        <div class="modal-footer">
                                            <button form="formETH{{$user->id}}" id="BtptoEth" type="submit" class="btn btn-success" >Submit</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="ToConvertLTC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body"><h3>Convert Balance to LTC Balance?</h3>
                                        {{Form::open([ 'id'=>'formLTC'.$user->id, 'url' => url("baladd/$user->id"), 'method' => 'POST'])}}
                                        <input type="hidden" name="coin_name" value="ltc">
                                            <tr id="ltcTR" class="ccConvert">  
                                                <td><label>Enter BTP Balance</label><span class="BtptoLtc text-danger"></span>
                                                  <input type="number" step="0.000000000000001" min="0" class="form-control text" autocomplete="off" placeholder="Enter BTP Amount" name="BTP" value="" oninput="ltc(this.value)" onchange="ltc(this.value)" class="ccText" id="ltc1">
                                                </td>
                                                <td><label>LTC Balance</label>
                                                    <input type="number" name="add_bal" class="form-control text" id="ltcbtpto" class="btpText" placeholder="LTC Amount" oninput="ltc2(this.value)" onchange="ltc2(this.value)" step="0.00000001" min="0">
                                                </td>
                                            </tr>
                                        {{ Form::close() }}
                                        <div class="modal-footer">
                                            <button form="formLTC{{$user->id}}" id="BtptoLtc" type="submit" class="btn btn-success" >Submit</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="ToConvertDASH" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body"><h3>Convert BTP Balance to DASH Balance?</h3>
                                        {{Form::open([ 'id'=>'formDASH'.$user->id, 'url' => url("baladd/$user->id"), 'method' => 'POST'])}}
                                        <input type="hidden" name="coin_name" value="dash">
                                            <tr id="dashTR" class="ccConvert">  
                                                <td><label>Enter BTP Balance</label> <span class="BtptoDash text-danger"></span>
                                                  <input type="number" step="0.000000000000001" min="0" class="form-control text" autocomplete="off" placeholder="Enter BTP Amount" name="BTP" value="" oninput="dash(this.value)" onchange="dash(this.value)" class="ccText" id="dash1">
                                                </td>
                                                <td><label>DASH Balance</label>
                                                    <input type="number" name="add_bal" autocomplete="off" class="form-control text" id="dashbtpto" class="btpText" placeholder="DASH Amount" oninput="dash2(this.value)" onchange="dash2(this.value)" step="0.00000001" min="0">
                                                </td>
                                            </tr>
                                        {{ Form::close() }}
                                    <div class="modal-footer">
                                        <button form="formDASH{{$user->id}}" id="BtptoDash" type="submit" class="btn btn-success">Submit</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="ToConvertEPAY" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body"><h3>Convert BTP Balance to EPAY Balance?</h3>
                                        {{Form::open([ 'id'=>'formEPAY'.$user->id, 'url' => url("baladd/$user->id"), 'method' => 'POST'])}}
                                        <input type="hidden" name="coin_name" value="epay">
                                            <tr id="epayTR" class="ccConvert">  
                                                <td><label>Enter BTP Balance</label> <span class="BtptoEpay text-danger"></span>
                                                  <input type="number" step="0.01" min="0" class="form-control text" autocomplete="off" placeholder="Enter BTP Amount" name="BTP" value="" oninput="epay(this.value)" onchange="epay(this.value)" class="ccText" id="epay1">
                                                </td>
                                                <td><label>EPAY Balance</label>
                                                    <input type="number" name="add_bal" autocomplete="off" class="form-control text" id="epaybtpto" class="btpText" placeholder="EPAY Amount" oninput="epay2(this.value)" onchange="epay2(this.value)" step="0.01" min="0">
                                                </td>
                                            </tr>
                                        {{ Form::close() }}
                                    <div class="modal-footer">
                                        <button form="formEPAY{{$user->id}}" id="BtptoEpay" type="submit" class="btn btn-success">Submit</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                           
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection

    @section('script')

    <script>
        function btpbtcConverter(valNum){
            var bal = parseFloat("{{Sentinel::getUser()->total_btc_bal}}", 10);
            var value = parseFloat(valNum,10);

            if(bal > value){
                var dd = valNum*{{$setting->btc_price}};
                var data = dd/{{$setting->rate}};
                $('#btpbtc').val(data.toFixed(8));
                $('#BtctoBtp').attr("disabled", false);
                $('.BtctoBtp').html('');
            }else{
                $('.BtctoBtp').html(' Insufficient balance');  
                $('#BtctoBtp').attr("disabled", true);
            }
        }
    </script>
    <script>
        function btpethConverter(valNum){
            var bal = parseFloat("{{Sentinel::getUser()->total_eth_bal}}", 10);
            var value = parseFloat(valNum,10);
            
            if(bal > value){
                var dd = valNum*{{$setting->eth_price}};
                var data = dd/{{$setting->rate}};

                $('#btpeth').val(data.toFixed(8));
                $('#EthtoBtp').attr("disabled", false);
                $('.EthtoBtp').html('');
            } else{
                $('.EthtoBtp').html(' Insufficient balance');  
                $('#EthtoBtp').attr("disabled", true);
            }
        }
    </script>
    <script>
        function btpltcConverter(valNum){
            var bal = parseFloat("{{Sentinel::getUser()->total_ltc_bal}}", 10);
            var value = parseFloat(valNum,10);
            if(bal > value){
                var dd = valNum*{{$setting->ltc_price}};
                var data = dd/{{$setting->rate}};     
                $('#btpltc').val(data.toFixed(8));
                $('#LtctoBtp').attr("disabled", false);
                $('.LtctoBtp').html('');
            }else{
                $('.LtctoBtp').html(' Insufficient balance');  
                $('#LtctoBtp').attr("disabled", true);
            }
        }
    </script>
    <script>
        function btpdashConverter(valNum){
            var bal = parseFloat("{{Sentinel::getUser()->total_dash_bal}}", 10);
            var value = parseFloat(valNum,10);
            if(bal > value){
                var dd = valNum*{{$setting->dash_price}};
                var data = dd/{{$setting->rate}};
                $('#btpdash').val(data.toFixed(8));
                $('#DashtoBtp').attr("disabled", false);
                $('.DashtoBtp').html('');
            }else{
                $('.DashtoBtp').html(' Insufficient balance');  
                $('#DashtoBtp').attr("disabled", true);
            }
        }
    </script>
    <script>
        function btpepayConverter(valNum){
            var bal = parseFloat("{{Sentinel::getUser()->total_epay_bal}}", 10);
            var value = parseFloat(valNum,10);
            if(bal > value){
                var dd = valNum*{{$setting->epay_price}};
                var data = dd/{{$setting->rate}};
                $('#btpepay').val(data.toFixed(8));
                $('#EpaytoBtp').attr("disabled", false);
                $('.EpaytoBtp').html('');
            }else{
                $('.EpaytoBtp').html(' Insufficient balance');  
                $('#EpaytoBtp').attr("disabled", true);
            }
        }
    </script>



    <!---1 other to BTP --->
    <script>
        function btcConverter(valNum){
            var data = valNum*{{$setting->rate}}/{{$setting->btc_price}};
            $('#btcbtp').val(data.toFixed(8));
            
            var bal = parseFloat("{{Sentinel::getUser()->total_btc_bal}}", 10);
            var value = parseFloat(data,10);
            if(bal > value){
                $('#BtctoBtp').attr("disabled", false);
                $('.BtctoBtp').html('');
            }else{
                $('.BtctoBtp').html(' Insufficient balance');  
                $('#BtctoBtp').attr("disabled", true);
            }
        }
    </script>
    <script>
        function ethConverter(valNum){
              var data = valNum*{{$setting->rate}}/{{$setting->eth_price}};
              $('#ethbtp').val(data.toFixed(8));

              var bal = parseFloat("{{Sentinel::getUser()->total_eth_bal}}", 10);
            var value = parseFloat(data,10);
            if(bal > value){
                $('#EthtoBtp').attr("disabled", false);
                $('.EthtoBtp').html('');
            }else{
                $('.EthtoBtp').html(' Insufficient balance');  
                $('#EthtoBtp').attr("disabled", true);
            }
        }
    </script>
    <script>
        function ltcConverter(valNum){
              var data = valNum*{{$setting->rate}}/{{$setting->ltc_price}};
              $('#ltcbtp').val(data.toFixed(8));

              var bal = parseFloat("{{Sentinel::getUser()->total_ltc_bal}}", 10);
            var value = parseFloat(data,10);
            if(bal > value){
                $('#LtctoBtp').attr("disabled", false);
                $('.LtctoBtp').html('');
            }else{
                $('.LtctoBtp').html(' Insufficient balance');  
                $('#LtctoBtp').attr("disabled", true);
            }
        }
    </script>
    <script>
        function dashConverter(valNum){
              var data = valNum*{{$setting->rate}}/{{$setting->dash_price}};
              $('#dashbtp').val(data.toFixed(8));

              var bal = parseFloat("{{Sentinel::getUser()->total_dash_bal}}", 10);
            var value = parseFloat(data,10);
            if(bal > value){
                $('#DashtoBtp').attr("disabled", false);
                $('.DashtoBtp').html('');
            }else{
                $('.DashtoBtp').html(' Insufficient balance');  
                $('#DashtoBtp').attr("disabled", true);
            }
        }
    </script>
    <script>
        function epayConverter(valNum){
              var data = valNum*{{$setting->rate}}/{{$setting->epay_price}};
              $('#epaybtp').val(data.toFixed(8));

              var bal = parseFloat("{{Sentinel::getUser()->total_epay_bal}}", 10);
            var value = parseFloat(data,10);
            if(bal > value){
                $('#EpaytoBtp').attr("disabled", false);
                $('.EpaytoBtp').html('');
            }else{
                $('.EpaytoBtp').html(' Insufficient balance');  
                $('#EpaytoBtp').attr("disabled", true);
            }
        }
    </script>


 
    <!---  BTP To other coin --->
    <script>
        function btc(valNum){
            var bal = parseFloat("{{Sentinel::getUser()->mbtc}}", 10);
            var value = parseFloat(valNum,10);
            if(bal > value){
                var data = value*{{$setting->rate}}/{{$setting->btc_price}};
                $('#btcbtpto').val(data.toFixed(8));
                $('#BtptoBtc').attr("disabled", false);
                $('.BtptoBtc').html('');
            }else{
                $('.BtptoBtc').html(' Insufficient balance');  
                $('#BtptoBtc').attr("disabled", true);
            }
        }
    </script>
    <script>
        function eth(valNum){
            var bal = parseFloat("{{Sentinel::getUser()->mbtc}}", 10);
            var value = parseFloat(valNum,10);
            if(bal > value){
                var data = valNum*{{$setting->rate}}/{{$setting->eth_price}};
                $('#ethbtpto').val(data.toFixed(8));
                $('#BtptoEth').attr("disabled", false);
                $('.BtptoEth').html('');
            }else{
                $('.BtptoEth').html(' Insufficient balance');  
                $('#BtptoEth').attr("disabled", true);
            }
        }
    </script>
    <script>
        function ltc(valNum){
            var bal = parseFloat("{{Sentinel::getUser()->mbtc}}", 10);
            var value = parseFloat(valNum,10);
            if(bal > value){
                var data = valNum*{{$setting->rate}}/{{$setting->ltc_price}};
                $('#ltcbtpto').val(data.toFixed(8));
                $('#BtptoLtc').attr("disabled", false);
                $('.BtptoLtc').html('');
            }else{
                $('.BtptoLtc').html(' Insufficient balance');  
                $('#BtptoLtc').attr("disabled", true);
            }
        }
    </script>
    </script>
    <script>
        function dash(valNum){
            var bal = parseFloat("{{Sentinel::getUser()->mbtc}}", 10);
            var value = parseFloat(valNum,10);
            if(bal > value){
                var data = valNum*{{$setting->rate}}/{{$setting->dash_price}};
                $('#dashbtpto').val(data.toFixed(8));
                $('#BtptoDash').attr("disabled", false);
                $('.BtptoDash').html('');
            }else{
                $('.BtptoDash').html(' Insufficient balance');  
                $('#BtptoDash').attr("disabled", true);
            }
        }
    </script>
    <script>
        function epay(valNum){
            var bal = parseFloat("{{Sentinel::getUser()->mbtc}}", 10);
            var value = parseFloat(valNum,10);
            if(bal > value){
                var data = valNum*{{$setting->rate}}/{{$setting->epay_price}};
                $('#epaybtpto').val(data.toFixed(8));
                $('#BtptoEpay').attr("disabled", false);
                $('.BtptoEpay').html('');
            }else{
                $('.BtptoEpay').html(' Insufficient balance');  
                $('#BtptoEpay').attr("disabled", true);
            }
        }
    </script>
    <!---   start--->

    <script>
        function btc2(valNum){
            var data = valNum*{{$setting->btc_price}}/{{$setting->rate}};      
            $('#btc1').val(data.toFixed(8));

            var bal = parseFloat("{{Sentinel::getUser()->mbtc}}", 10);
            var value = parseFloat(data,10);
            if(bal > value){
                $('#BtptoBtc').attr("disabled", false);
                $('.BtptoBtc').html('');
                console.log('high');
            }else{
                $('.BtptoBtc').html(' Insufficient balance');  
                $('#BtptoBtc').attr("disabled", true);
                console.log('low');
            }
        }
    </script>
     <script>
        function eth2(valNum){
            var data = valNum*{{$setting->eth_price}}/{{$setting->rate}};      
            $('#eth1').val(data.toFixed(8));

            var bal = parseFloat("{{Sentinel::getUser()->mbtc}}", 10);
            var value = parseFloat(data,10);
            if(bal > value){
                $('#BtptoEth').attr("disabled", false);
                $('.BtptoEth').html('');
            }else{
                $('.BtptoEth').html(' Insufficient balance');  
                $('#BtptoEth').attr("disabled", true);
            }
        }
    </script>
      <script>
        function ltc2(valNum){
            var data = valNum*{{$setting->ltc_price}}/{{$setting->rate}};      
            $('#ltc1').val(data.toFixed(8));

            var bal = parseFloat("{{Sentinel::getUser()->mbtc}}", 10);
            var value = parseFloat(data,10);
            if(bal > value){
                $('#BtptoLtc').attr("disabled", false);
                $('.BtptoLtc').html('');
            }else{
                $('.BtptoLtc').html(' Insufficient balance');  
                $('#BtptoLtc').attr("disabled", true);
            }
        }
    </script>
      <script>
        function dash2(valNum){
            var data = valNum*{{$setting->dash_price}}/{{$setting->rate}};      
            $('#dash1').val(data.toFixed(8));

            var bal = parseFloat("{{Sentinel::getUser()->mbtc}}", 10);
            var value = parseFloat(data,10);
            if(bal > value){
                $('#BtptoDash').attr("disabled", false);
                $('.BtptoDash').html('');
            }else{
                $('.BtptoDash').html(' Insufficient balance');  
                $('#BtptoDash').attr("disabled", true);
            }
        }
    </script>
    <script>
        function epay2(valNum){
            var data = valNum*{{$setting->epay_price}}/{{$setting->rate}};      
            $('#epay1').val(data.toFixed(8));

            var bal = parseFloat("{{Sentinel::getUser()->mbtc}}", 10);
            var value = parseFloat(data,10);
            if(bal > value){
                $('#BtptoEpay').attr("disabled", false);
                $('.BtptoEpay').html('');
            }else{
                $('.BtptoEpay').html(' Insufficient balance');  
                $('#BtptoEpay').attr("disabled", true);
            }
        }
    </script>
    <!----- End --->
  



  <script>
    setTimeout(function() {
        $('.alert-success').fadeOut('fast');
    }, 9000);
    setTimeout(function() {
        $('.alert-danger').fadeOut('fast');
    }, 9000); 
</script>
    @endsection
   