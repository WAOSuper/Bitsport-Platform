@extends('layouts.master')
<!-- head -->
@section('title')
    Referral List
@endsection
<!-- title -->
@section('head')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ URL::asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
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
                <h1>Referral List

                </h1>
            </div>
            <!-- END PAGE TITLE -->
            <div class="col-lg-4" style="    float: right;">
                <div class="card">
                    <form class="form-copy theme-form">
                        <div class="form-group">
                            <div class="input-group">                                
                                <input type="text" id="copy" class="form-control" value="{{url('/')}}?r={{ sentinel::getUser()->referral_code }}" aria-label="Search for..." readonly>
                                <span class="input-group-btn">
                                <button class="btn btn-theme btn-copy" type="button" data-copytarget="#lets_copy" onclick="myFunction()">copy</button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="javascript:;">Home</a>
                <i class="fa fa-circle"></i>
            </li>

            <li>
                <span class="active">Referral List & Bonus</span>
            </li>

            
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <div class="row">

        </div>
        <div class="col-md-3">
            <div class="portlet light bordered">
                <div class="portlet-title"><b>Total Referrals</b></div>
                <span><i class="fa fa-users" aria-hidden="true"></i>  <b><?php echo count($referr_list) ?></b></span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="portlet light bordered">
                <div class="portlet-title"><b>Total Commission</b></div>
                <span><i class="fa fa-money" aria-hidden="true"></i> <b>{{ $total_ref_bonus }} </b></span>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">Referral List</span>
                        </div>
                        <div class="tools"></div>
                    </div>
                    <div class="portlet-body">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Total Commission</th>
                            </tr>
                            </thead>
                            <tbody><?php $i = 1; ?>
                            @foreach($referr_list as $referr)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $referr->first_name }}</td>
                                    <td>@if(count($referr->ref) > 0){{ $referr->ref->sum('earn_amount') }} @else 0 @endif</td>
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
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ URL::asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <!-- <script src="{{ URL::asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script> -->
    <script src="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ URL::asset('assets/pages/scripts/table-datatables-buttons.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
      function myFunction() {
        /* Get the text field */
        var copyText = document.getElementById("copy");

        /* Select the text field */
        copyText.select();

        /* Copy the text inside the text field */
        document.execCommand("copy");
      }
    </script>
    @endsection
   