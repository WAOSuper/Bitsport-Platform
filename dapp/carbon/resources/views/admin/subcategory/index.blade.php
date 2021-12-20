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
                <h1>Sub Category

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
                <span class="active">Sub Category</span>
            </li>

            <span class="set-right"><a href="{{route('admin-subcategory.create')}}" class="btn btn-primary ">Add Sub Category</a></span>
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
                            <span class="caption-subject bold uppercase">Sub Category</span>
                        </div>
                        <div class="tools"></div>
                    </div>
                    <div class="portlet-body">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Category Name</th>
                                <th>Sub Category Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody><?php $i = 1; ?>
                          @foreach($subcategory as $scat)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$scat->subcat->name}}</td>
                                 <td>{{$scat->name}}</td>
                                 <td>{{$scat->slug}}</td>
                                @if($scat->status == 1)
                                <td><span class="label label-sm label-danger"> Deactivated </span></td>
                                @else
                                <td><span class="label label-sm label-success"> Activated </span></td> 
                                @endif
                                  <td width="250px">


                                        <a href="{{ route('admin-subcategory.edit',$scat->id) }}" class="btn btn-xs blue" ><i class="fa fa-pencil"></i></a>

                                        @if($scat->status == 0)
                                        <a href="{{ route('admin-subcategory.deactivestatus',$scat->id) }}" class="btn btn-danger" >Deactivate</a>
                                        @endif
                                        @if($scat->status == 1)
                                        <a href="{{ route('admin-subcategory.activestatus',$scat->id) }}" class="btn btn-success" >Active</a>
                                        @endif

                                      <!--  {{ Form::open(['method' => 'DELETE', 'class'=>'set-right' ,'route' => ['admin-subcategory.destroy',$scat->id]]) }}
                                       {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs'] )  }}
                                       {{ Form::close() }} -->



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
   