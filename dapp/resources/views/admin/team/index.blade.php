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


@section('content')

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="min-height: 1489px;">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>Team Pages

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
                <span class="active">Team Pages</span>
            </li>

            <span class="set-right"><a href="{{route('admin-team.create')}}" class="btn btn-primary "  >Add New</a></span>
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
                            <span class="caption-subject bold uppercase">Team Pages</span>
                        </div>
                        <div class="tools"></div>
                    </div>
                    <div class="portlet-body">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Name</th>
                                <!-- th>Category</th>
                                <th>Sub Category</th>
                                <th>Sub Sub Category</th> -->
                                <th>Status</th>
                                <th>Created Date</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody><?php $i = 1; ?>
                            @foreach($teams as $team)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ @$team->name }}</td>
                               <!--  <td>{{ @$team->category->name }}</td>
                                <td>{{ @$team->subcategory->name }}</td>
                                <td>{{ @$team->subsubcategory->name }}</td> -->
                               @if($team->status == 1)
                                <td><span class="label label-sm label-danger"> Deactivated </span></td>
                                @else
                                <td><span class="label label-sm label-success"> Activated </span></td> 
                                @endif
                                <td> <?php echo date('j M, Y h:i:s A', strtotime($team->created_at)); ?></td>
                                <td width="18%">
                                    <a href="#form_moda{{$team->id}}" data-toggle="modal" class="btn btn-xs blue" style="margin-left: 5px;"><i class="fa fa-eye"></i>  </a>
                                    <a href="{{route('admin-team.edit',$team->id)}}" data-toggle="modal" class="btn btn-xs blue" style="margin-left: 5px;"><i class="fa fa-pencil"></i>  </a>
                                    @if($team->status == 0)
                                     <a href="{{ url('changeTeamStatus/'.$team->id.'/1') }}" class="btn btn-danger" >Deactivate</a>
                                    @else
                                      <a href="{{ url('changeTeamStatus/'.$team->id.'/0') }}" class="btn btn-success" >Active</a>
                                    @endif

                                    {{ Form::open(['method' => 'DELETE', 'class'=>'set-right' ,'route' => ['admin-team.destroy',$team->id]]) }}
                                       {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs'] )  }}
                                    {{ Form::close() }}
                                    <div id="form_moda{{$team->id}}" class="modal fade" role="dialog" aria-hidden="true" tabindex="-1" style="display: none;">
                                        <div class="modal-dialog" >
                                            <div class="modal-content" style="width: 180%;">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Blog  Details</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <h3 class="text-center">TEAM - {{ $team->name }}</h3>
                                                        <div class="col-md-12">
                                                            <table class="table table-hover table-bordered">
                                                                <tr>
                                                                    <th>Title:</th><td>{{ @$team->name }}</td>
                                                                </tr>
                                                                <!-- <tr>
                                                                    <th>Category:</th><td>{{ @$team->category->name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Sub Category:</th><td>{{ @$team->subcategory->name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Sub Sub Category:</th><td>{{ @$team->subsubcategory->name }}</td>
                                                                </tr> -->
                                                                <tr>
                                                                    <th>Created by:</th><td>{{ $team->user->first_name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Created at:</th><td><?php echo date('j M, Y h:i:s A', strtotime($team->created_at)); ?></td>
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
                                </td>
                                <td></td>
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
   