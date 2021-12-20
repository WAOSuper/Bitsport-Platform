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
        .event-modal-main-div{
            padding-right: 30em;
        }
        .table-ui-rollback tbody tr td:last-child a {
            display: inline-block;
            margin-bottom: 5px;
            float: right;
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
                <h1>Event Pages</h1>
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
                <span class="active">Event Pages</span>
            </li>
            @if($route!=='admin-pending-event')
                @if($role=='creator')
                    <span class="set-right"><a href="{{route('creator-event.create')}}" class="btn btn-primary ">Add New</a></span>
                @else
                    <span class="set-right"><a href="{{route('admin-event.create')}}" class="btn btn-primary ">Add New</a></span>
                @endif
            @endif
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
                            <span class="caption-subject bold uppercase">Event Pages</span>
                        </div>
                        <div class="tools"></div>
                    </div>
                    <div class="portlet-body">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                        <table class="table table-ui-rollback table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Name</th>
                                <th>Category Name</th>
                                <th>Created Date</th>
                                <th>End Date</th>
                                <th>Live</th>
                                <th>Status </th>
                                <th>Winner selection</th>
                                <th>Event Odds</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody><?php $i = 1; ?>
                            @foreach($events as $event)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ @$event->Master->event_name }}</td>
                                <td>{{ @$event->Cat->name }}</td>
                                <td> <?php echo date('j M, Y h:i:s A', strtotime($event->start_date)); ?></td>
                                <td><?php echo date('j M, Y h:i:s A', strtotime($event->end_date)); ?></td>
                                    @if($event->live == 2 )
                                        <td><span class="label label-sm label-danger"> Ended </span> </td>
                                    @elseif($event->live == 1 )
                                        <td><span class="label label-sm label-danger"> Live </span> </td>
                                    @else
                                        <td><span class="label label-sm label-success"> Up-Coming  </span> </td> 
                                    @endif
                                <td>
                                    @if($event->status == 1)
                                        <span class="label label-sm label-danger"> Deactivated </span> &nbsp;
                                    @else
                                        <span class="label label-sm label-success"> Activated </span> &nbsp;
                                    @endif
                                </td>
                                <td>
                                    @if($event->winloss==0)
                                        <a href="{{ url('winloss/'.$event->id) }}" class="btn btn-success btn-sm"> Set winner </a>
                                    @elseif($event->winloss==1)
                                        <button class="btn btn-success btn-sm"> @if($event->winner==1) Team A @elseif($event->winner==2) Draw @else Team B @endif </button>
                                    @else
                                        <button class="btn btn-danger btn-sm" disabled=""> Loss </button>
                                    @endif
                                </td>
                                <td>
                                    <a href="#evntodd{{$event->id}}" data-toggle="modal" class="btn btn-xs red" style="margin-left: 5px;"><i class="fa fa-eye"></i>  </a>
                                    <a href="{{route($role == 'creator' ? 'creator-odd.edit' :'admin-odd.edit',$event->id)}}" data-toggle="modal" class="btn btn-xs blue" style="margin-left: 5px;"><i class="fa fa-pencil"></i>  </a>
                                </td>

                                <td width="18%">
                                    <a href="#form_moda{{$event->id}}" data-toggle="modal" class="btn btn-xs red" style="margin-left: 5px;"><i class="fa fa-eye"></i>  </a>
                                    <a href="{{ route($role == 'creator' ? 'creator-event.edit' :'admin-event.edit',$event->id)}}" data-toggle="modal" class="btn btn-xs blue" style="margin-left: 5px;"><i class="fa fa-pencil"></i>  </a>

                                    @if($event->status == 0)
                                      <a href="{{ url('changeEventStatus/'.$event->id.'/1') }}" class="btn btn-danger btn-sm"> Deactivate </a>
                                    @else
                                      <a href="{{ url('changeEventStatus/'.$event->id.'/0') }}" class="btn btn-success btn-sm"> Active </a>
                                    @endif

                                    @if($role !== "creator")
                                        @if($event->is_approve == 1)
                                            <a href="{{ url('changeEventPermission/'.$event->id.'/0') }}" class="btn btn-danger" >Reject </a>
                                        @else
                                            <a href="{{ url('changeEventPermission/'.$event->id.'/1') }}" class="btn btn-success" >Approve</a>
                                        @endif
                                    @endif

                                    {{ Form::open(['method' => 'DELETE', 'class'=>'set-right' ,'route' => [$role == 'creator' ? 'creator-event.destroy' : 'admin-event.destroy',$event->id]]) }}
                                       {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs'] )  }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @foreach($events as $event)
                        <div id="form_moda{{$event->id}}" class=" event-modal-main-div modal fade" role="dialog" aria-hidden="true" tabindex="-1" style="display: none;">
                            <div class="modal-dialog" >
                                <div class="modal-content" style="width: 180%;">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                        <h4 class="modal-title">Event  Details</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-hover table-bordered">
                                                    <tr>
                                                        <th>Name:</th><td>{{ @$event->Master->event_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Category:</th><td>{{ @$event->Cat->name }}</td>
                                                    </tr>
                                                     <tr>
                                                        <th>Sub Category:</th><td>{{ @$event->SubCat->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Sub Sub Category:</th><td>{{ @$event->SubSubCat->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Channel Id:</th><td>{{ $event->channel_id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Team 1:</th><td>{{ @$event->Team1->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Odds 1:</th><td>{{ @$event->odds }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Team 2:</th><td>{{ @$event->Team2->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Odds 2:</th><td>{{ $event->odds2 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Draw:</th><td>{{ $event->draw }}</td>
                                                    </tr> 
                                                    <tr>
                                                        <th>Start Date:</th><td>{{ $event->start_date }}</td>
                                                    </tr>
                                                     <tr>
                                                        <th>End Date:</th><td>{{ $event->end_date }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Scroll:</th><td>{{ $event->scroll }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Created by:</th><td>{{ $event->user->first_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Created at:</th><td><?php echo date('j M, Y h:i:s A', strtotime($event->created_at)); ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach    
                </div>
            </div>
        </div>
    </div>

    @foreach($events as $event)
    <div id="evntodd{{$event->id}}" class=" event-modal-main-div modal fade" role="dialog" aria-hidden="true" tabindex="-1" style="display: none;">
        <div class="modal-dialog" >
            <div class="modal-content" style="width: 180%;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Event Odd Details</h4>
                </div>
                <form action="{{ url('update-odd-winner') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                <input type="hidden" name="event_id" value="{{$event->id}}" >
                <div class="modal-body">
                    <div class="row">
                       <!--  <h3 class="text-center"> Event</h3> -->
                        <div class="col-md-12"> 
                        @php $master = $event->Odd->groupBy('odd_id'); @endphp
                        @foreach($master as $val)
                        <h4><b> ODD TITLE :</b><b>  <?php print_r($val[0]['oddMasterName']['odd_title']); ?>  </b> </h4>
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <th style="width: 320px;">Team Name</th>
                                    <th style="width: 320px;">Odd Name</th>
                                    <th>Odd</th>
                                    <th>Set ODD Winner</th>
                                </tr>
                                @foreach ($event->Odd->where('odd_id', $val[0]->odd_id) as $odds)
                                <tr>
                                    <td>{{$odds->teamName->name}}</td>
                                    <td>{{$odds->name}}</td>
                                    <td>{{$odds->odd}}</td>
                                    <td>
                                    @if($odds->oddBet)
                                        @if($odds->oddBet->win == 0)
                                            <input type="checkbox" name="odds[]" value="{{$odds->oddBet->team_id}}" class="make-switch" data-on-color="success" data-off-color="danger">
                                        @elseif($odds->oddBet->win == 1)
                                            <span class="text-success">This Odd Win</span>
                                        @else
                                            <span class="text-danger">This Odd Loss</span>
                                        @endif
                                    @else
                                        No Bets in This ODD
                                    @endif
                                </td>
                                </tr>
                                @endforeach         
                            </table>
                        @endforeach        
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn btn-success btn-outline pull-left" type="submit" >Update Bet</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
                                   
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
   