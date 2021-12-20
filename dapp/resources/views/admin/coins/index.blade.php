@extends('layouts.master')
<!-- head -->
@section('title')
    Betting
@endsection
<!-- title -->
@section('head')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="../backend/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="../backend/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
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
                <h1>Get Coins

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
                <span class="active">Get Coins</span>
            </li>

            <span class="set-right"><a href="{{route('admin-coins.create')}}" class="btn btn-primary ">Add New</a></span>
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
                            <span class="caption-subject bold uppercase">Get Coins</span>
                        </div>
                        <div class="tools"></div>
                    </div>
                    <div class="portlet-body">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Fees</th>
                                <th>Delivery</th>
                                <th>Limits</th>
                                <th>Links</th>
                                 <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody><?php $i = 1; ?>
                           @foreach($coins as $coin)
                            <tr>
                                <td>{{$i++}}</td>
                                <td><img src="assets/images/coins/{{$coin->image}}" style="width: 50px;"></td>
                                <td>{{$coin->title}}</td>
                                <td>{{$coin->fees}}</td>
                                <td>{{$coin->delivery}}</td>
                                <td>{{$coin->limits}}</td>
                                <td><a href="{{$coin->link}}" target="_blank" class="btn btn-primary ">Buy</a></td>
                                
                                <td><a href="{{route('admin-coins.edit',$coin->id)}}" class="btn btn-xs blue" ><i class="fa fa-pencil"></i>  </a>
                                   
                                    {{ Form::open(['method' => 'DELETE', 'class'=>'set-left' ,'route' => ['admin-coins.destroy',$coin->id]]) }}
                                
                                       {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs'] )  }}
                                    {{ Form::close() }}
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
    <script src="../backend/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="../backend/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="../backend/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="../backend/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="../backend/assets/pages/scripts/table-datatables-buttons.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
      
    </script>
    @endsection
   