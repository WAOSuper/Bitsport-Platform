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
                <h1>Users Bets</h1>
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
                <span class="active">Users Bets</span>
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
                            <span class="caption-subject bold uppercase">Users Bets</span>
                        </div>
                        <div class="tools"></div>
                    </div>
                    <div class="portlet-body">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <tr>
                                <th>Sr</th>
                                <th>User Name</th>
                                <th>Team Details</th>
                                <th>Type</th>
                                <th>Bet On</th>
                                <th>Odd</th>
                                <th>Stake</th>
                                <th>Date / Time</th>
                                <th>Status</th>
                                <th>Win/Loss</th>
                            </tr>
                            </thead>
                            <tbody><?php $i = 1; ?>
                            @foreach($bet as $bets)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ @$bets->user->first_name }}</td>
                                <td>{{ @$bets->team_1_name }} vs {{ @$bets->team_2_name }}</td>
                                @if($bets->bet_type == 0)
                                <td><span class="label label-sm label-success"> Single </span></td>
                                 @else
                                <td><span class="label label-sm label-info"> Multiple </span></td>
                                 @endif
                                 
                                 @if($bets->bet_on == 1)
                                <td><span class="label label-sm label-info"> Team A </span></td>
                                 @elseif($bets->bet_on == 2)
                                <td><span class="label label-sm label-warning"> Draw </span></td>
                                 @elseif($bets->bet_on == 3)
                                <td><span class="label label-sm label-success"> Team B </span></td>
                                 @endif
                                
                                <td>{{$bets->odds}}</td>
                                <td>{{$bets->bet_odds}}</td>
                                
                                <td>{{$bets->date_time}}</td>
                              
                                 @if($bets->status == 0)
                                <td><span class="label label-sm label-success"> Pending </span></td>
                                 @elseif($bets->status == 1)
                                <td><span class="label label-sm label-info"> Confirmed </span></td>
                                @else
                                    <td><span class="label label-sm label-danger"> Removed </span></td>
                                 @endif

                                @if($bets->win == 0)
                                    <td><span class="label label-sm label-warning"> Pending </span></td>
                                @elseif($bets->win == 1)
                                    <td><span class="label label-sm label-success"> Win </span></td>
                                @else
                                    <td><span class="label label-sm label-danger"> Loss </span></td>
                                @endif

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
   