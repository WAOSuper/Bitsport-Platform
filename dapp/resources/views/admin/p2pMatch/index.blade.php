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
    <!-- END PAGE LEVEL PLUGINS -->
    <style>
        .team-modal-main-div{
            padding-right: 30em;
        }
    </style>
@endsection

@section('content')

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="min-height: 1489px;">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>{{ $heading }}

                </h1>
            </div>
            <!-- END PAGE TITLE -->

        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{url('admin-dashboard')}}">Home</a>
                <i class="fa fa-circle"></i>
            </li>

            <li>
                <span class="active">{{ $heading }}</span>
            </li>

           <!--  <span class="set-right"><a href="{{route('admin-team.create')}}" class="btn btn-primary "  >Add New</a></span> -->
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <div class="row">

        </div>
        
        @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div><br>@endif
        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div><br>@endif
        
        <div class="row">

            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">{{ $heading }}</span>
                        </div>
                        <div class="tools"></div>
                    </div>
                    <div class="portlet-body">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Username</th>
                                    <th>Stake Amount</th>
                                    <th>Expires In</th>
                                    <th>Platform</th>
                                    <th>Checkin Duration</th>
                                    <th>Trust Score</th>
                                    <th>Status</th>
                                    <th>Opponene Username</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody><?php $i = 1; ?>
                                @foreach($matches as $match)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{$match->owner->username}}</td>
                                        <td>{{$match->stake_amount}} BTP</td>
                                        <td>{{$match->end_time}}</td>
                                        <td>{{$match->platform}}</td>
                                        <td>{{$match->ckeck_in_duration}} Mins</td>
                                        <td>{{$match->owner->trust_score}}%</td>
                                        <td>{{config('match.match_status_name.'.$match->status)}}</td>
                                        <td>{{$match->opponent ? $match->opponent->username : null}}</td>
                                        <td>
                                            <a class="btn btn-danger btn-xs" href="{{route('admin.match.show', $match->id) }}">Show</a>
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
    @endsection

    @section('script')
     <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{asset('assets/pages/scripts/table-datatables-buttons.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
      
    </script>
    @endsection
   