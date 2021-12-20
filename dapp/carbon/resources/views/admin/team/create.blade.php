@extends('layouts.master')
<!-- head -->
@section('title')
    Betting
@endsection
<!-- title -->
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
	                <h1>Insert Team

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
	                <span class="active">Insert Team</span>
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
	                            <span class="caption-subject bold uppercase"> Insert Team</span>
	                        </div>

	                    </div>


	                    @if(session('success'))
	                    <div class="alert alert-success">
	                        {{ session('success') }}
	                    </div>
	                    @endif


	                    <div class="portlet-body form">
	                        <form role="form" method="post" action="{{route('admin-team.store')}}" enctype="multipart/form-data">
	                            <input type="hidden" name="_token" value="{{csrf_token()}}">
	                            <div class="form-body">
	                            	 <!--Team Name-->
	                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
	                                    <label>Team Name</label>
	                                    <input type="text" class="form-control" placeholder="Enter Title" name="name" value="{{ old('name') }}">
	                                    @if ($errors->has('name'))
    				                       <span class="help-block">
    				                           <strong>{{ $errors->first('name') }}</strong>
    				                       </span>
    				                   @endif
	                                </div>                        
	                            </div>
	                            <div class="form-actions">
	                                <button type="submit" class="btn blue">Submit</button>
	                                 <a  class="btn default" href="{{route('admin-team.index')}}">Cancel</a>
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

@endsection