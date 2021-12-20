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
                <h1>Subscribers History</h1>
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
                <span class="active">Subscribers History</span>
            </li>
            <!-- <span class="set-right"><a href="#" class="btn btn-primary ">Add Newsletter</a></span> -->
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <div class="row">

        </div>
        
         @if(session('success'))<div class="alert alert-success"><strong>Success : </strong>{{ session('success') }}</div>@endif
        @if(session('error'))<div class="alert alert-danger"><strong>Error : </strong> {{ session('error') }}</div>@endif
        
        <div class="row">

            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">Subscribers History</span>
                        </div>
                        <div class="tools"></div>
                    </div>
                    <div class="portlet-body">
                        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                @foreach($subscribe as $key)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$key->email}}</td>
                                    <td><a href="#" data-toggle="modal" data-target="#myDelete{{$key->id}}" ><i class="fa fa-trash-o" style="font-size:24px;color:red"></i></a></td>
                                </tr>
                                <div class="modal fade" id="myDelete{{$key->id}}">
                                    <form id="formDelete{{$key->id}}" action="{{url('subcriber-delete',$key->id)}}" method="get">
                                    {{ csrf_field() }}
                                      <div class="modal-dialog">
                                          <div class="modal-content"> 
                                              <!-- Modal Header -->
                                              <div class="modal-header">
                                                  <h4 class="modal-title">{{$key->email}}</h4>
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              </div>
                                              <!-- Modal body -->
                                              <div class="modal-body">
                                                  <!-- HTML Form (wrapped in a .bootstrap-iso div) -->
                                                  <div class="row">
                                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <div class="form-group ">
                                                                <label class="control-label " for="name">Are You Sure to Subscriber Delete. </label>
                                                            </div>
                                                      </div>
                                                  </div>
                                              </div>
                                                    <!-- Modal footer -->
                                              <div class="modal-footer">
                                                  <button form="formDelete{{$key->id}}" type="submit" class="btn btn-success" >Delete</button>
                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                              </div>
                                          </div>
                                      </div>
                                    </form>
                                </div>
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
        $(document).ready(function() {
          $('#data-table').DataTable();
        });
  </script>
  <script>
        setTimeout(function() {
            $('.alert-success').fadeOut('fast');
        }, 9000);
        setTimeout(function() {
            $('.alert-danger').fadeOut('fast');
        }, 9000);      
    </script>
    @endsection
   