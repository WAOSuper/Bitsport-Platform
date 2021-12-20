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
	                <h1>Edit BLOG

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
	                <span class="active">Edit BLOG</span>
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
	                            <span class="caption-subject bold uppercase"> Edit BLOG</span>
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
	                        {{ Form::model($blog, array('route' => array('admin-blog.update', $blog->id), 'method' => 'PUT', 'files' => 'true')) }}
	                            <input type="hidden" name="_token" value="{{csrf_token()}}">
	                            <div class="form-body">
	                                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
	                                    <label>Title</label>
	                                    <input type="text" class="form-control" placeholder="Enter Title" value="{{$blog->title}}" name="title">
	                                	 @if ($errors->has('title'))
    				                       <span class="help-block">
    				                           <strong>{{ $errors->first('title') }}</strong>
    				                       </span>
    				                   	@endif
	                                </div>
	                                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
	                                    <label>Description</label>
	                                    <textarea name="description" class=" form-control"  rows="10">{{$blog->description}}</textarea>
	                               	 	@if ($errors->has('description'))
    				                       <span class="help-block">
    				                           <strong>{{ $errors->first('description') }}</strong>
    				                       </span>
    				                   	@endif
	                                </div>
	                                <div class="form-group {{ $errors->has('long_description') ? ' has-error' : '' }}">
	                                    <label>Long Description</label>
	                                    <textarea name="long_description" class=" form-control ckeditor"   rows="10">{{$blog->long_description}}</textarea>
	                               		 @if ($errors->has('long_description'))
    				                       <span class="help-block">
    				                           <strong>{{ $errors->first('long_description') }}</strong>
    				                       </span>
    				                   	@endif
	                                </div>
	                                <div class="form-group">
	                                    <label>Blog Image</label>
	                                    @if(file_exists(public_path('assets/images/blog/'.$blog->image)))
                                            <img src="{{ URL::asset('assets/images/blog')}}/{{$blog->image}}" id="blog_img" width="80px" height="80px" /> 
                                        @else
                                            <img src="{{  URL::asset('images/noimage.png') }}" height="80px" id="blog_img" width="80px" />
                                        @endif
                                        <input type="hidden" name="old_blog_img" value="{{$blog->image}}" />
	                                    <input type="file" name="blog_img" class="form-control" onchange="readURL(this);" />

	                                </div>
	                            </div>
	                            <div class="form-actions">
	                                <button type="submit" class="btn blue">Submit</button>
	                               <a  class="btn default" href="{{route('admin-blog.index')}}">Cancel</a>
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
@section('script_bottom')
  <script type="text/javascript">
      function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#blog_img')
                      .attr('src', e.target.result);
              };

              reader.readAsDataURL(input.files[0]);
          }
      }
    </script>

@endsection