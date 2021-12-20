 @extends('layouts.master')
<!-- head -->
@section('title')
    Betting
@endsection
<!-- title -->
@section('head')
<meta name="csrf_token"  content="{{ csrf_token() }}" />
 <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
<link href="{{ URL::asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />@endsection
	<style>
  .adds {
  padding-top: 22px;
}
.bootstrap-switch {
    height: 34px;
}

.channel-ul {
    background: #3399ff;
    padding: 20px;
}

ul .channel-li {
    background: #cce5ff;
    margin: 5px;
}
.channel-li:hover {
    background-color: #330066;
   color : #fff;
}
  </style>
@section('content')
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
<div class="page-content" style="min-height: 1603px;">
<!-- BEGIN PAGE HEAD-->
<div class="page-head">
<!-- BEGIN PAGE TITLE -->
<div class="page-title">
<h1>Participant Match</h1>
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
<span class="active">Participant Match</span>
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
            <span class="caption-subject bold uppercase"> Participant Match</span>
        </div>

    </div>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

<div class="portlet-body form">
    <form role="form" method="post" action="{{url('/participant/match/'.$participantId)}}" enctype="multipart/form-data">
       <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="form-body">

              <div class="row">
                <div class="form-group {{ $errors->has('startdatetime') ? ' has-error' : '' }} col-md-8">
                  <label>Start Date & Time</label>
                  <input type="text" class="form-control" placeholder="Start Date" autocomplete="no" name="startdatetime"  id="startdatetime" value="{{ old('startdatetime') }}" >
                  @if ($errors->has('startdatetime'))
                    <span class="help-block">
                      <strong>{{ $errors->first('startdatetime') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group {{ $errors->has('enddatetime') ? ' has-error' : '' }} col-md-8">
                  <label>End Date & Time</label>
                  <input type="text" class="form-control" placeholder="End Date" name="enddatetime" autocomplete="no" id="enddatetime" value="{{ old('enddatetime') }}" >
                  @if ($errors->has('enddatetime'))
                    <span class="help-block">
                      <strong>{{ $errors->first('enddatetime') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="row">
                  <div class="form-group {{ $errors->has('participant_id') ? ' has-error' : '' }} col-md-8">
                    <label>Participants</label>
                    <select name="participant_id" id="participant_id"  class="form-control cateid">
                      <option value="">Select Participant</option>
                      @foreach($participants as $participant)
                        <option value="{{$participant->id}}" >{{$participant->user->username}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('participant_id'))
                      <span class="help-block">
                        <strong>{{ $errors->first('participant_id') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn blue">Submit</button>
                  <a class="btn default" href="{{url('/participants')}}" >Cancel</a>
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
  <script src="{{asset('assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/pages/scripts/components-bootstrap-switch.min.js')}}" type="text/javascript"></script>
@endsection
@section('script_bottom')
<script>
	$('#startdatetime,#enddatetime').datetimepicker({
        	use24hours: true,
          format: 'yyyy-mm-dd hh:ii:ss'
   });
</script>
<script src="{{ asset('js/custome.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
  CKEDITOR.replace( 'criticalrules' );
  CKEDITOR.replace( 'rules' );
  CKEDITOR.replace( 'about' );
  CKEDITOR.replace( 'contactdetails' );
  CKEDITOR.replace( 'schedule' );
  CKEDITOR.replace( 'prizes' );
    function setChannelId(channel_id){
    $("#channel_id").val(channel_id);
}

</script>
@endsection