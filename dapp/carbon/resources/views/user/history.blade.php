@extends('layouts.master')
<!-- head -->
@section('title')
    Deposit History
@endsection
<!-- title -->
@section('head')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ URL::asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" /> 
     <link href="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <style>
        .cms-modal-main-div{
            padding-right: 30em;
        }
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
                <h1>Transaction History

                </h1>
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
                <span class="active">Transaction History</span>
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
                            <span class="caption-subject bold uppercase">History</span>
                        </div>
                        <div class="tools"></div>
                    </div>
                    <div class="portlet-body">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>                                
                                <th>Coin</th>
                                <th>Address</th>
                                <th>Amount</th>
                                <th>Transaction Id</th>                                 
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                                @foreach($deposit as $dep)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $dep->coin_type }}</td>
                                        <td>{{ $dep->address }}</td>
                                        <td>{{ $dep->amount }}</td>
                                        <td>{{ $dep->txid }}</td>
                                    </tr>
                                @endforeach                           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('script')
    <script type="text/javascript">
        $(document).ready( function () {
            $('.table').DataTable();
        } );
    </script>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ URL::asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ URL::asset('assets/pages/scripts/table-datatables-buttons.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
      
    </script>
    @endsection
   