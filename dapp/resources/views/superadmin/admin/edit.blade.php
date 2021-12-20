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
	                <h1>Edit Sub-Admin

	                </h1>
	            </div>
	            <!-- END PAGE TITLE -->

	        </div>
	        <!-- END PAGE HEAD-->
	        <!-- BEGIN PAGE BREADCRUMB -->
	        <ul class="page-breadcrumb breadcrumb">
	            <li>
	                <a href="index.html">Home</a>
	                <i class="fa fa-circle"></i>
	            </li>
	            <li>
	                <span class="active">Edit Sub-Admin</span>
	            </li>
	        </ul>
	        <!-- END PAGE BREADCRUMB -->
	        <!-- BEGIN PAGE BASE CONTENT -->
	        <br>
        @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        <br>
	        <div class="row">
	            <div class="col-md-10 ">
	                <!-- BEGIN SAMPLE FORM PORTLET-->
	                <div class="portlet light bordered">
	                    <div class="portlet-title">
	                        <div class="caption font-blue-sunglo">
	                            <i class="icon-settings font-blue-sunglo"></i>
	                            <span class="caption-subject bold uppercase"> Edit Sub-Admin</span>
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
	                      {{ Form::model($user, array('route' => array('sub-admin.update', $user->id), 'method' => 'PUT', 'files' => 'true')) }}
	                            <input type="hidden" name="_token" value="{{csrf_token()}}">
	                            <div class="form-body">
	                                <div class="form-group {{ $errors->has('firstname') ? ' has-error' : '' }}">
						                <label class="control-label visible-ie8 visible-ie9">Firts Name</label>
						                <div class="input-icon">
						                    <i class="fa fa-font"></i>
						                    <input class="form-control placeholder-no-fix" type="text" placeholder="First Name" name="firstname"  value="{{ $user->first_name }}" /> 
						                </div>
						                @if ($errors->has('firstname'))
					                       <span class="help-block">
					                           <strong>{{ $errors->first('firstname') }}</strong>
					                       </span>
					                    @endif
						            </div>
						            <div class="form-group {{ $errors->has('lastname') ? ' has-error' : '' }}">
						                <label class="control-label visible-ie8 visible-ie9">Last Name</label>
						                <div class="input-icon">
						                    <i class="fa fa-font"></i>
						                    <input class="form-control placeholder-no-fix" type="text" placeholder="Last Name" name="lastname"   value="{{ $user->last_name }}" /> </div>
						                @if ($errors->has('lastname'))
					                       <span class="help-block">
					                           <strong>{{ $errors->first('lastname') }}</strong>
					                       </span>
					                    @endif
						            </div>

						            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
						                <label class="control-label visible-ie8 visible-ie9">Email</label>
						                <div class="input-icon">
						                    <i class="fa fa-envelope"></i>
						                    <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email"  value="{{ $user->email }}" /> </div>
						                 @if ($errors->has('email'))
					                       <span class="help-block">
					                           <strong>{{ $errors->first('email') }}</strong>
					                       </span>
					                    @endif
						            </div>
	                            </div>
	                            <div class="form-actions">
	                                <button type="submit" class="btn blue">Submit</button>
	                                <a  class="btn default" href="{{route('sub-admin.index')}}">Cancel</a>
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