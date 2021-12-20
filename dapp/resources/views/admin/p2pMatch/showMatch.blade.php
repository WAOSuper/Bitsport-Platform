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
                        {{-- <div class="tools"></div> --}}
                    </div>
                    <div class="portlet-body">
                        <table class="table table-bordered">
                            {{-- <thead>
                                <th></th>
                                <th></th>
                            </thead> --}}
                            <tbody>
                                <tr>
                                    <th>Username</th>
                                    <td>{{$match->owner->username}}</td>
                                </tr>
                                <tr>
                                    <th>Stake Amount</th>
                                    <td>{{$match->stake_amount}} BTP</td>
                                </tr>
                                <tr>
                                    <th>Expires In</th>
                                    <td>{{$match->end_time}}</td>
                                </tr>
                                <tr>
                                    <th>Platform</th>
                                    <td>{{$match->platform}}</td>
                                </tr>
                                <tr>
                                    <th>Checkin Duration</th>
                                    <td>{{$match->ckeck_in_duration}} Mins</td>
                                </tr>
                                <tr>
                                    <th>Trust Score</th>
                                    <td>{{$match->owner->trust_score}}%</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{config('match.match_status_name.'.$match->status)}}</td>
                                </tr>
                                <tr>
                                    <th>Score Of Opponent By Opponent</th>
                                    <td>{{$match->score_of_opp_by_opp}}</td>
                                </tr>
                                <tr>
                                    <th>Score Of Opponent By Owner</th>
                                    <td>{{$match->score_of_opp_by_own}}</td>
                                </tr>
                                <tr>
                                    <th>Score Of Owner By Opponent</th>
                                    <td>{{$match->score_of_own_by_opp}}</td>
                                </tr>
                                <tr>
                                    <th>Score Of Owner By Owner</th>
                                    <td>{{$match->score_of_own_by_own}}</td>
                                </tr>
                                @if ($match->winner)
                                <tr>
                                    <th>Winner User</th>
                                    <td>{{$match->winnerUser->username}}</td>
                                </tr>    
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        @if ($match->status == config('match.match_status.pending'))                            
                            <div class="col-md-3">
                                <form action="{{route('admin.match.setWinner')}}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="match_id" value="{{$match->id}}">
                                    <input type="hidden" name="winner_user_id" value="{{$match->owner->id}}">
                                    <input type="submit" value="Owner as winner" class="btn btn-primary btn-xs">
                                </form>
                            </div>
                            <div class="col-md-3">
                                <form action="{{route('admin.match.setWinner')}}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="match_id" value="{{$match->id}}">
                                    <input type="hidden" name="winner_user_id" value="{{$match->opponent->id}}">
                                    <input type="submit" value="Opponent as winner" class="btn btn-primary btn-xs">
                                </form>
                            </div>
                        @endif
                        <div class="col-md-3"></div>
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
   