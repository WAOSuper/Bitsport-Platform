@extends('layouts.master')
<!-- head -->
@section('title')
    Betting
@endsection
<!-- title -->
@section('head')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ URL::asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Withdrawals</span>
                    </li>
                </ul>
            </div> -->
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h1 class="page-title">
                {{--<small>managed datatable samples</small>--}}
            </h1>
            <!-- END PAGE TITLE-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase"> Withdrawal History</span>
                            </div>
                        </div>
                        @if(Session::has('error')) <div class="alert alert-danger"> {{Session::get('error')}} </div> @endif
                        @if(Session::has('success')) <div class="alert alert-success"> {{Session::get('success')}} </div> @endif
                        <div class="portlet-body">
                            <?php $i=1;?>
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                <thead>
                                <tr>
                                    <th> # </th>
                                    <th> User Name</th>
                                    <th> Coin Name</th>
                                    <th> To Address</th>
                                    <th> TX ID</th>
                                    <th> Amount</th>
                                    <th> Admin Status</th>
                                    <th> Actions </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($withdraw as $key )
                                    <tr class="odd gradeX">
                                        <td> {{ $i++ }}</td>
                                        <td> {{ $key->user->first_name }} </td>
                                        <td> {{ $key->coin }} </td>
                                        <td> {{ $key->address }} </td>
                                        <td> {{ $key->txid }} </td>
                                        <td>{{$key->amount}}</td>
                                      <td>  @if($key->admin_status == 0) <span class="badge badge-warning"> Pending </span>
                                            @elseif($key->admin_status == 1) <span class="badge badge-success"> Approved </span> 
                                            @elseif($key->admin_status == 2)  <span class="badge badge-danger"> Rejected </span> 
                                            @else 
                                            @endif </td>
                                        <td> @if($key->status == 0)<a href="{{ url('withdraw-approve/'.$key->id) }}" class="btn btn-xs green" ><i class="fa fa-check"></i> Approve </a>@endif</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div>
    </div>

    <!-- END CONTENT -->

@endsection
<!-- content -->

@section('script')
    <script src="{{ asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
@endsection

@section('script_bottom')
    <script src="{{ asset('assets/pages/scripts/table-datatables-managed.min.js') }}" type="text/javascript"></script>
@endsection
<!-- script -->
