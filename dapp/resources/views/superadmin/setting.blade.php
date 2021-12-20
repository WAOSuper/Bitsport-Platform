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
	                <h1>Edit Setting

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
	                <span class="active">Update Setting</span>
	            </li>
	        </ul>
	        <!-- END PAGE BREADCRUMB -->
	        <!-- BEGIN PROFILE PAGE BASE CONTENT -->
	        <div class="row">
	            <div class="col-md-6 ">
	                <!-- BEGIN SAMPLE FORM PORTLET-->
	                <div class="portlet light bordered">
	                    <div class="portlet-title">
	                        <div class="caption font-blue-sunglo">
	                            <i class="icon-settings font-blue-sunglo"></i>
	                            <span class="caption-subject bold uppercase"> Update Setting</span>
	                        </div>
	                    </div>
	                    @if(session('success'))
	                    <div class="alert alert-success">
	                        {{ session('success') }}
	                    </div>
	                    @endif 
	                    @if(session('error'))
	                    <div class="alert alert-danger">
	                        {{ session('error') }}
	                    </div>
	                    @endif

	                    <div class="portlet-body form">
	                      {{ Form::model($setting, array('route' => array('setting.update', $setting->id), 'method' => 'POST','files'=>'true')) }}
	                            <input type="hidden" name="_token" value="{{csrf_token()}}">
	                            <div class="form-body">
	                                <div class="form-group {{ $errors->has('mobile_number') ? ' has-error' : '' }}">
	                                    <label>BTP Rate (in $)</label>
	                                    <input type="number" class="form-control" placeholder="Enter BTP rate" name="rate" value="{{ $setting->rate}}" min="0" value="0" step="0.0000001" title="Currency" pattern="^\d+(?:\.\d{1,2})?$">
	                                    @if ($errors->has('rate'))
    				                       <span class="help-block">
    				                           <strong>{{ $errors->first('rate') }}</strong>
    				                       </span>
    				                   @endif
	                                </div>
	                                <div class="form-group">
	                                    <label>Referral Percentage (in %)</label>
	                                    <input type="number" class="form-control" placeholder="Enter Referral Percentage" name="per" value="{{ $setting->per}}" min="0" value="0" step="0.0000001" title="Percentage" pattern="^\d+(?:\.\d{1,2})?$">
	                                    @if ($errors->has('rate'))
    				                       <span class="help-block">
    				                           <strong>{{ $errors->first('rate') }}</strong>
    				                       </span>
    				                   @endif
	                                </div>
		                            <div class="form-actions">
		                                <button type="submit" class="btn blue">Edit</button>
		                            </div>
		                        </div>
	                         {{ Form::close()}}
	              		</div>
	                </div>
	            </div>
	        </div>
	        <!-- END SETTING PAGE BASE CONTENT -->
	    </div>
	    <!-- END CONTENT BODY -->
	</div>

@endsection
<!-- content -->

@section('script')
@endsection
@section('script_bottom')
@endsection