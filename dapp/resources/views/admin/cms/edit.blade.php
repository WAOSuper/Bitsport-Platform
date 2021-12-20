@extends('layouts.master')
<!-- head -->
@section('title')
    Betting
@endsection
<!-- title -->
@section('head')
    <!-- <link href="{{ URL::asset('backend/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" href="{{ URL::asset('assets/global/plugins/ckeditor/css/samples.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/global/plugins/ckeditor/toolbarconfigurator/lib/codemirror/neo.css') }}">
@endsection
    
@section('content')
    <div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
        <div class="page-content" style="min-height: 1603px;">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Edit CMS

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
                    <span class="active">Edit CMS</span>
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
                                <span class="caption-subject bold uppercase"> Edit CMS</span>
                            </div>

                        </div>

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="class="alert alert-danger">
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
                           {{ Form::model($cms, array('route' => array('admin-cms.update', $cms->id), 'method' => 'PUT')) }}
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-body">
                                    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                        <label>Sidebar Title</label>
                                        <input type="text" class="form-control" placeholder="Enter Title" name="title" value="{{$cms->title}}">
                                        @if ($errors->has('title'))
                                           <span class="help-block">
                                               <strong>{{ $errors->first('title') }}</strong>
                                           </span>
                                       @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('slug') ? ' has-error' : '' }}">
                                        <label>Slug</label>
                                        <input type="text" class="form-control" placeholder="Enter Slug" name="slug" value="{{$cms->slug}}">
                                        @if ($errors->has('slug'))
                                           <span class="help-block">
                                               <strong>{{ $errors->first('slug') }}</strong>
                                           </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
                                        <label>Description</label>
                                        <textarea name="content" class="form-control ckeditor" id="ckeditor"  rows="10">{{ $cms->content }}</textarea>
                                        @if ($errors->has('content'))
                                           <span class="help-block">
                                               <strong>{{ $errors->first('content') }}</strong>
                                           </span>
                                        @endif
                                    </div>
                                  
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn blue">Submit</button>
                                    <a  class="btn default" href="{{route('admin-cms.index')}}">Cancel</a>
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
<script src="{{ URL::asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('assets/global/plugins/ckeditor/js/sample.js')}}"></script>
    <script>
        initSample();
    </script>
@endsection