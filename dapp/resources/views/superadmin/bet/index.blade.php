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
                <h1>Betting History

                </h1>
            </div>
            <!-- END PAGE TITLE -->

        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="{{url('admin/dashboard')}}">Home</a>
                <i class="fa fa-circle"></i>
            </li>

            <li>
                <span class="active">Betting History</span>
            </li>

            <!-- <span class="set-right"><a href="{{route('sub-admin.create')}}" class="btn btn-primary "  >Add New</a></span> -->
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <div class="row">

        </div>
        <br>
        @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        <br>
        <div class="row">

            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">Betting History</span>
                        </div>
                        <div class="tools"></div>
                    </div>
                    <div class="portlet-body">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>

                            <tr>
                                <th>Sr No</th>
                                <th>User Name</th>
                                <th>Event Name</th>
                                <th>Team</th>
                                <th>Odds</th>
                                <th>Date</th>
                                <th>Bet Type</th>
                                <th>Bet On</th>
                                <th>Win</th>
                                <th>Status</th>
                                <th>Created At</th>
                               <!--  <th>Action</th> -->
                            </tr>
                            </thead>
                            <tbody><?php $i = 1; ?>
                            @foreach($bet as $user)
                            @if(@$user->user)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ @$user->user->first_name }} {{ @$user->user->last_name }}</td>
                                <td>{{ @$user->event->master->event_name }}</td>
                                <td>{{ @$user->team->name }}</td>
                                <td>{{ @$user->odds }}</td>
                                <td>{{ @$user->date_time }}</td>
                                @if($user->bet_type == 0)
                                <td><span class="label label-sm label-success"> Single </span></td>
                                 @else
                                <td><span class="label label-sm label-success"> Multiple </span></td>
                                 @endif
                                 @if($user->bet_on == 0)
                                    <td><span class="label label-sm label-primary"> Team A </span></td>
                                 @elseif($user->bet_on == 1)
                                    <td><span class="label label-sm label-warning"> Draw </span></td>
                                 @else
                                    <td><span class="label label-sm label-info"> Team B </span></td>
                                 @endif
                                <!-- <td>@if($user->team_id == 0) 
                                        @if($user->bet_on == 1 || $user->bet_on == 2) 
                                            {{$user->team_1_name}} 
                                        @else 
                                            {{$user->team_1_name}} 
                                        @endif 
                                    @else 
                                        {{$user->odd_name}} 
                                    @endif </td> -->
                                 @if($user->win == 0)
                                    <td><span class="label label-sm label-warning"> Pending </span></td>
                                 @elseif($user->win == 1)
                                    <td><span class="label label-sm label-success"> Win </span></td>
                                @else
                                    <td><span class="label label-sm label-danger"> Loss </span></td>
                                 @endif
                                @if($user->user->status == 2)
                                <td><span class="label label-sm label-danger"> Deactivated </span></td>
                                @elseif($user->user->status == 1)
                                <td><span class="label label-sm label-success"> Confirmed </span></td> 
                                @endif
                                <td> <?php echo date('j M, Y h:i:s A', strtotime($user->user->created_at)); ?></td>
                                <!-- <td width="18%">
                                    @if($user->user->status == 0)
                                     <a href="{{ url('changeAdminStatus/'.$user->user->id.'/1') }}" class="btn btn-success" >Active</a>
                                    @else
                                      <a href="{{ url('changeAdminStatus/'.$user->user->id.'/0') }}" class="btn btn-danger" >Block</a>
                                    @endif
                                    <a href="{{route('sub-admin.edit',$user->user->id)}}" class="btn btn-primary">Edit</a> 
                                </td> -->
                            </tr>
                            @endif
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
   