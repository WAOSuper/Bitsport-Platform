@extends('layouts.master')
@section('title')
   Betting
@endsection
@section('head')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
     <link href="{{ URL::asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" /> 
     <link href="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <style>
        .event-modal-main-div{
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
                <h1>Event Winner</h1>
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
                <span class="active">Event Winner</span>
            </li>

        </ul>
        <!-- END PAGE BREADCRUMB -->
        <div class="row">

        </div>
        @if(session('error'))<br><div class="alert alert-danger">{{ session('error') }}</div><br>@endif
        @if(session('success'))<br><div class="alert alert-success">{{ session('success') }}</div><br>@endif
        
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">Event Winner</span>
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
                                <th>Teams</th>
                                <th>Odds / Bet</th>
                                <th>Team A</th>
                                <th>Draw</th>
                                <th>Team B</th>
                                
                            </tr>
                            </thead>
                            <tbody><?php $i=1;$teamA = 0;$teamB = 0;$draw = 0; ?>
                            @foreach($bets as $bet)
                                <tr>
                                    <td> {{$i++}} </td>
                                    <td> {{$bet->user->first_name}} </td>
                                    <td> @if($bet->team_id == 0) {{$bet->team_1_name}} vs {{$bet->team_2_name}} @else {{@$bet->odd->name}} @endif</td>
                                    <td> {{$bet->odds}} / {{$bet->bet_odds}} </td>
                                    <td> @if($bet->bet_on == 1) {{$bet->odds}} <?php $teamA = $teamA + ($bet->odds*$bet->bet_odds); ?> @else 0 @endif </td>
                                    <td> @if($bet->bet_on == 2) {{$bet->odds}} <?php $draw = $draw + ($bet->odds*$bet->bet_odds); ?> @else 0 @endif </td>
                                    <td> @if($bet->bet_on == 3) {{$bet->odds}} <?php $teamB = $teamB + ($bet->odds*$bet->bet_odds); ?> @else 0 @endif </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4"></td>
                                    <td>{{$teamA}}</td>
                                    <td>{{$draw}}</td>
                                    <td>{{$teamB}}</td>
                                </tr>
                            </tfoot>
                        </table>
                        
                        <div class="form-group">
                            <form action="{{url('/')}}/winloss/update" method="post" accept-charset="utf-8">
                                <h3> Select Winner Team </h3>
                                <label> <input type="radio" required="" name="winner" value="1"> Team A </label>
                                <label> <input type="radio" required="" name="winner" value="2"> Draw </label>
                                <label> <input type="radio" required="" name="winner" value="3"> Team B </label>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="event_id" value="{{$id}}">
                                <br>
                                <button type="submit" class="btn btn-success" name="submit" > Submit </button>
                            </form>
                        </div>

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