@extends('layouts.master')
@section('title')
    Betting
@endsection
@section('head')

@endsection

@section('content')

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="min-height: 1603px;">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>Edit Category

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
                <span class="active">Edit Category</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row">
            <div class="col-md-10 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-blue-sunglo">
                            <i class="icon-settings font-blue-sunglo"></i>
                            <span class="caption-subject bold uppercase"> Edit Category</span>
                        </div>

                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li> {{ $error }}</li><br>
                        @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif


                    <div class="portlet-body form">
                    
                               {{ Form::model($event, array('route' => array('admin-eventmaster.update', $event->id), 'method' => 'PUT')) }}
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-body">
                              
                                <div class="form-group">
                                    <label>Event Name</label>
                                    <input type="text" class="form-control" value="{{$event->event_name}}" placeholder="Enter Name" name="name">
                                </div>

                                 


                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn blue">Submit</button>
                                <button type="button" class="btn default">Cancel</button>
                            </div>
                      {!! Form::close(); !!}
                    </div>
                </div>

            </div>

        </div>

        <!-- END PAGE BASE CONTENT -->
    </div>
    <!-- END CONTENT BODY -->
</div>


@endsection

@section('script')


@endsection