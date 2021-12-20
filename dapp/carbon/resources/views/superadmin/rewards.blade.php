@extends('layouts.master')
<!-- head -->
@section('title')
    Rewards
@endsection
<!-- title -->
@section('head')
  	<link href="{{ URL::asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" /> 
    <link href="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
	    <div class="page-content" style="min-height: 1603px;">
	        <!-- BEGIN PAGE HEAD-->
	        <div class="page-head">
	            <!-- BEGIN PAGE TITLE -->
	            <div class="page-title">
	                <h1>Rewards

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
	                <span class="active">Rewards</span>
	            </li>
	        </ul>
	        <!-- END PAGE BREADCRUMB -->
	        <!-- BEGIN PROFILE PAGE BASE CONTENT -->
	        <div class="row">
	            <div class="col-md-6">
	                <!-- BEGIN SAMPLE FORM PORTLET-->
	                <div class="portlet light bordered">
	                    <div class="portlet-title">
	                        <div class="caption font-blue-sunglo">
	                            <i class="icon-18 fa fa-gift"></i>
	                            <span class="caption-subject bold uppercase"> Rewards</span>
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
	                    <form method="post" action="{{url('/')}}/add-coupon">
	                    	<input type="hidden" name="_token" value="{{csrf_token()}}">
	                    	<div class="form-group ">
	                            <label>Coupon </label>
	                            <input type="text" required="required" class="form-control" name="coupon" value="{{$coupon}}" readonly="readonly" />
	                        </div>

                            <div class="form-group ">
	                            <label> Amount </label>
	                            <input type="text" required="required" class="form-control" value="1.0" name="amount" />
	                        </div>

	                        <div class="form-group ">
	                            <label> Usage Limit </label>
	                            <input type="text" required="required" class="form-control" value="1" name="usage" />
	                        </div>
							<button class="btn blue" >Add Coupon</button>
	                    </form>
	                </div>
	            </div>
	        </div>

	        <div class="row">
	        	<div class="col-md-12">
	        		<div class="portlet light bordered">
	                    <div class="portlet-title">
	                        <div class="caption font-blue-sunglo">
	                            <i class="fa fa-history"></i>
	                            <span class="caption-subject bold uppercase"> Rewards History</span>
	                        </div>
	                    </div>
		        		<table class="table table-striped table-bordered table-hover" id="sample_1">
	                    	<thead>
		                    	<tr>
		                    		<th>Sr No</th>
		                    		<th>Coupon Code</th>
		                    		<th>Usage Limit</th>
		                    		<th>Total Usage</th>
		                    		<th>Amount</th>
		                    		<th>Status</th>
		                    		<th>Created Date</th>
		                    		<th>Updated Date</th>
		                    	</tr>
		                    </thead>
	                    	@php
	                    		$i=1;
	                    	@endphp
		                    <tbody>
	                    	@foreach($coupons as $coupon_code)
		                    	<tr>
		                    		<td>{{$i}}</td>
		                    		<td>{{ $coupon_code['coupon'] }}</td>
		                    		<td>{{ $coupon_code['usage_limit'] }}</td>
		                    		<td>
		                    			<a href="{{url('/')}}/redeem-list/{{ $coupon_code['coupon'] }}">
		                    				{{ $coupon_code['total_usage'] }}
		                    			</a>
		                    		</td>
		                    		<td>{{ $coupon_code['amount'] }}</td>
		                    		<td>
		                    			@php
		                    				if($coupon_code['total_usage'] > 0)
		                    				{
		                    					echo "<span class='label label-sm label-success'>Active</span>";
		                    				}
		                    				else
		                    				{
		                    					echo "<span class='label label-sm label-danger'>Inactive</span>";
		                    				}
		                    			@endphp
		                    		</td>
		                    		<td>{{ $coupon_code['created_at'] }}</td>
		                    		<td>{{ $coupon_code['updated_at'] }}</td>
		                    	</tr>
		                    	@php
		                    		$i++;
		                    	@endphp
	                    	@endforeach
		                    </tbody>
	                    </table>
	                </div>
	        	</div>
	        </div>
	        <!-- END SETTING PAGE BASE CONTENT -->
	    </div>
	    <!-- END CONTENT BODY -->
	</div>
<style>
.icon-18 {
    font-size: 18px !important;
}
</style>

@endsection
<!-- content -->

@section('script')
	<!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{asset('assets/pages/scripts/table-datatables-buttons.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@endsection