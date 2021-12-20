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
	                <h1>Insert BLOG

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
	                <span class="active">Insert BLOG</span>
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
	                            <span class="caption-subject bold uppercase"> Insert BLOG</span>
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
	                        <form role="form" method="post" action="{{route('admin-blog.store')}}" enctype="multipart/form-data">
	                            <input type="hidden" name="_token" value="{{csrf_token()}}">
	                            <div class="form-body">
	                                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
	                                    <label>Title</label>
	                                    <input type="text" class="form-control" placeholder="Enter Title" name="title" value="{{ old('title') }}">
	                                    @if ($errors->has('title'))
    				                       <span class="help-block">
    				                           <strong>{{ $errors->first('title') }}</strong>
    				                       </span>
    				                    @endif
	                                </div>
	                                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
	                                    <label>Short Description</label>
	                                    <textarea name="description" class=" form-control"  rows="5" >{{ old('description') }}</textarea>
	                                    @if ($errors->has('description'))
    				                       <span class="help-block">
    				                           <strong>{{ $errors->first('description') }}</strong>
    				                       </span>
    				                   	@endif
	                                </div> 
	                                <div class="form-group {{ $errors->has('long_description') ? ' has-error' : '' }}">
	                                    <label>Long Description</label>
	                                    <textarea name="long_description" class=" form-control ckeditor"   rows="10">{{ old('long_description') }}</textarea>
	                               		 @if ($errors->has('long_description'))
    				                       <span class="help-block">
    				                           <strong>{{ $errors->first('long_description') }}</strong>
    				                       </span>
    				                   	@endif
	                                </div>
	                                <div class="form-group {{ $errors->has('blog_img') ? ' has-error' : '' }}">
	                                    <label>Blog Image</label>
	                                    <input type="file" name="blog_img" class="form-control" />
	                                     @if ($errors->has('blog_img'))
    				                       <span class="help-block">
    				                           <strong>{{ $errors->first('blog_img') }}</strong>
    				                       </span>
    				                   	@endif
	                                </div>
	                            </div>
	                            <div class="form-actions">
	                                <button type="submit" class="btn blue">Submit</button>
	                                <a  class="btn default" href="{{route('admin-blog.index')}}">Cancel</a>
	                            </div>
	                        </form>
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