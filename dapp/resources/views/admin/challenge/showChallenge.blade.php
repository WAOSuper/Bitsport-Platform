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
    .team-modal-main-div {
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
                                    <td>{{$challenge->creator->username}}</td>
                                </tr>
                                <tr>
                                    <th>Amount</th>
                                    <td>{{$challenge->amount}} BTP</td>
                                </tr>
                                <tr>
                                    <th>Console</th>
                                    <td>{{$challenge->console->name}}</td>
                                </tr>
                                @if($challenge->game)
                                <tr>
                                    <th>Game</th>
                                    <td>{{$challenge->game->name}}</td>
                                </tr>
                                @endif
                                @if($challenge->mode)
                                <tr>
                                    <th>Mode</th>
                                    <td>{{$challenge->mode->name}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th>Trust Score</th>
                                    <td>{{$challenge->creator->trust_score}}%</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{config('challenge.status_name.'.$challenge->status)}}</td>
                                </tr>
                                @if($challenge->status == 6)
                                @if($challenge->dispute_by)
                                <tr>
                                    <th>Dispute by</th>
                                    <td>{{$challenge->dispute_by == $challenge->creator->id ? $challenge->creator->username : $challenge->opponent->username}}</td>
                                </tr>
                                @endif
                                @if(count($challenge->dispute_evidences))
                                <tr>
                                    <th>Dispute </th>
                                <tr>
                                @foreach ($challenge->dispute_evidences as $evidence)    
                                <tr>
                                    <th>Comments {{ $evidence->user_id == $challenge->creator->id ? 'by creator' : 'by opponent'}}</th>
                                    <td>
                                        {{ $evidence->comments }}                                        
                                    </td>
                                </tr>
                                <tr>
                                    <th>Evidences</th>
                                    <td>
                                        @foreach (explode( ',',$evidence->files) as $file)    
                                            <img src="{{ url('storage/disputeEvidence').'/'.$file }}"/>
                                        @endforeach
                                        
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                @if($challenge->dispute_timestamp)
                                <tr>
                                    <th>Dispute Time</th>
                                    <td>{{$challenge->dispute_timestamp}}
                                    
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <th>Result Of Opponent By Creator</th>
                                    <td>{{$result->ResultOfOpponentByCreator}}</td>
                                </tr>
                                <tr>
                                    <th>Result Of Creator By Opponent</th>
                                    <td>{{$result->ResultOfCreatorByOpponent}}</td>
                                </tr>
                                <tr>
                                    <th>Experience Of Opponent By Creator</th>
                                    <td>{{$result->ExperienceOfOpponentByCreator}}</td>
                                </tr>
                                <tr>
                                    <th>Experience Of Creator By Opponent</th>
                                    <td>{{$result->ExperienceOfCreatorByOpponent}}</td>
                                </tr>
                                <tr>
                                    <th>Skill Rating Of Opponent By Creator</th>
                                    <td>{{$result->SkillOfOpponentByCreator}}</td>
                                </tr>
                                <tr>
                                    <th>Skill Rating Of Creator By Opponent</th>
                                    <td>{{$result->SkillOfCreatorByOpponent}}</td>
                                </tr>
                                @endif
                                @if ($challenge->winner_id)
                                <tr>
                                    <th>Winner User</th>
                                    <td>{{$challenge->winner->username}}</td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        @if ($challenge->status == config('challenge.status.dispute'))
                        <div class="col-md-3">
                            <form action="{{route('admin.challenge.setWinner')}}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="challenge_id" value="{{$challenge->id}}">
                                <input type="hidden" name="winner_user_id" value="{{$challenge->creator->id}}">
                                <input type="submit" value="creator as winner" class="btn btn-primary btn-xs">
                            </form>
                        </div>
                        <div class="col-md-3">
                            <form action="{{route('admin.challenge.setWinner')}}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="challenge_id" value="{{$challenge->id}}">
                                <input type="hidden" name="winner_user_id" value="{{$challenge->opponent->id}}">
                                <input type="submit" value="Opponent as winner" class="btn btn-primary btn-xs">
                            </form>
                        </div>
                        <div class="col-md-3">
                            <form action="{{route('admin.challenge.setWinner')}}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="challenge_id" value="{{$challenge->id}}">
                                <input type="hidden" name="winner_user_id" value="">
                                <input type="submit" value="Set as Draw" class="btn btn-primary btn-xs">
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