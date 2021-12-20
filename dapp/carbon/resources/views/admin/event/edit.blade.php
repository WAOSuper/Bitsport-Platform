 @extends('layouts.master')
<!-- head -->
@section('title')
    Betting
@endsection
<!-- title -->
@section('head')
<meta name="csrf_token"  content="{{ csrf_token() }}" />
  <link href="{{ URL::asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
	
@section('content')
	<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
	    <div class="page-content" style="min-height: 1603px;">
	        <!-- BEGIN PAGE HEAD-->
	        <div class="page-head">
	            <!-- BEGIN PAGE TITLE -->
	            <div class="page-title">
	                <h1>Edit Event
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
	                <span class="active">Edit Event</span>
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
	                            <span class="caption-subject bold uppercase"> Edit Event</span>
	                        </div>
	                    </div>
	                    @if(session('success'))
	                    <div class="alert alert-success">
	                        {{ session('success') }}
	                    </div>
	                    @endif
                      <div class="portlet-body form">
                        {{ Form::model($event, array('route' => array($role == 'creator'? 'creator-event.update':'admin-event.update', $event->id), 'method' => 'PUT')) }}
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-body">
                              <!--Event Name-->

                              <div class="row">
                                 <div class="form-group {{ $errors->has('eventname') ? ' has-error' : '' }} col-md-8">
                                    <label>Event Name</label>
                                  	<select name="EventName" id="eventmaster"  class="form-control">
                                     		<option value="">Select Event</option>
                                     		@foreach($eventmaster as $ev)
                                     		<option value="{{$ev->id}}" @if($event->event_master_id == $ev->id) selected @endif>{{$ev->event_name}}</option>
                                     		@endforeach
                                   	</select>
                                      @if ($errors->has('eventname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('eventname') }}</strong>
                                        </span>
                                      @endif
                                  </div>
                              </div>
                              <!--Category Name-->
                          	  <div class="row">
                                <div class="form-group {{ $errors->has('catid') ? ' has-error' : '' }} col-md-8">
                                  <label>Category Name</label> 
                                	<select name="catid" id="category"  class="form-control ">
                                 		<option value="">Select Category</option>	
                                 		@foreach($category as $cat)
                                 	      <option value="{{$cat->id}}" 
                                          @if($event->cat_id == $cat->id) selected @endif>{{$cat->name}}</option>
                                 		@endforeach
                                 	</select>
                                    @if ($errors->has('catid'))
                                      <span class="help-block">
                                         <strong>{{ $errors->first('catid') }}</strong>
                                      </span>
                                    @endif
                                </div> 
                              </div>
                               <!--Sub Category Name-->
                          	  <div class="row">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }} col-md-8">
                                    <label>Sub Category Name</label> 
                                  	<select name="scatid" id="sub_category"  class="form-control ">
                                   		<option value="">Select SubCategory</option>	
                                      @if($event->sub_cat_id != 0)
                                   		    @foreach($subcategory as $scat)
                                                        <option value="{{$scat->id}}" @if($event->sub_cat_id == $scat->id) selected @endif>{{$scat->name}}</option>
                                          @endforeach 
                                      @endif
                                   	</select>
                                    @if ($errors->has('name'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('scatname') }}</strong>
                                       </span>
                                   @endif
                                </div> 
                              </div>
                               <!--Sub Sub Category Name-->
                               @if($role!=="creator")
                          	  <div class="row">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }} col-md-8">
                                    <label>Sub Sub Category Name</label>
                                  	<select name="sscatid" id="sub_sub_category"  class="form-control ">
                                   		<option value="">Select SubSubCategory</option>	
                                      @if($event->sub_sub_cat_id != 0)
                                   		    @foreach($subsubcategory as $sscat)
                                                        <option value="{{$sscat->id}}" @if($event->sub_sub_cat_id == $sscat->id) selected @endif>{{$sscat->name}}</option>
                                        @endforeach
                                      @endif
                                   	</select>
                                    @if ($errors->has('name'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('scatname') }}</strong>
                                       </span>
                                   @endif
                                </div>
                              </div>
                              @endif
                              <!--Video URL-->
                                <div class="row">
                                  <div class="form-group {{ $errors->has('video_url') ? ' has-error' : '' }} col-md-8">
                                      <label>Twitch Video URL (  <span  id="channel-id-msg"  ><strong style="color:#000;" > Note: Please add valid Twitch URL</strong></span> )</label>
                                      <input type="text" class="form-control" placeholder="Enter Video URL" name="video_url"  id="video_url"  value="{{ $event->twitch_url }}"  >
                                      @if ($errors->has('video_url'))
                                         <span class="help-block">
                                             <strong>{{ $errors->first('video_url') }}</strong>
                                         </span>
                                     @endif
                                  </div>
                                   
                                </div>
                              <!--Channel Id-->
                              <!-- <div class="row">
                                <div class="form-group {{ $errors->has('channel_id') ? ' has-error' : '' }} col-md-8">
                                    <label>Channel Id</label>
                                    <input type="text" class="form-control" placeholder="Enter Channel id" name="channel_id" id="channel_id" readonly value="{{ $event->channel_id }}">
                                    @if ($errors->has('channel_id'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('channel_id') }}</strong>
                                       </span>
                                   @endif
                                </div>
                              </div> -->
                               <!--Team 1-->
                              <div class="row">
                                <div class="form-group {{ $errors->has('team_1') ? ' has-error' : '' }} col-md-8">
                                    <label>Team 1</label>
                                   	<select name="team_1" id="team_1"  class="form-control team1">
                                   		<option value="">Select Team</option>
                                   		@foreach($teams as $team)
                                            <option value="{{$team->id}}" @if($event->Team1Event->id == $team->id) selected @endif>{{$team->name}}</option>
                                        @endforeach
                                   	</select>
                               		@if ($errors->has('team_1'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('team_1') }}</strong>
                                       </span>
                                   	@endif
                                </div>
                              </div>

                              <!--Odds 1-->
                              <div class="row">
                                <div class="form-group {{ $errors->has('odds_1') ? ' has-error' : '' }} col-md-8">
                                    <label>Odds 1</label>
                                    <select name="odds_1"   class="form-control">
                                        <option value="">Select Odds 1</option>
                                        @foreach($eventOdds as $odd)
                                            <option @if($event->odds == $odd->title) selected @endif value="{{ $odd->title }}">{{ $odd->title }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="number" step="0.01" class="form-control" placeholder="Enter Odds 1" name="odds_1" value="{{ $event->odds }}"> --}}
                                    @if ($errors->has('odds_1'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('odds_1') }}</strong>
                                       </span>
                                   @endif
                                </div>
                              </div>

                               <!--Team 2-->
                              <div class="row">
                                <div class="form-group {{ $errors->has('team_2') ? ' has-error' : '' }} col-md-8">
                                    <label>Team 2</label>
                                   	<select name="team_2" id="team_2"  class="form-control team2">
                                   		<option value="">Select Team</option>
                                   		@foreach($teams as $team)
                                                        <option value="{{$team->id}}" @if(isset($event->Team2Event->id) && isset($event->Team2Event->id) && $event->Team2Event->id == $team->id) selected @endif>{{$team->name}}</option>
                                        @endforeach
                                   	</select>
                               		@if ($errors->has('team_2'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('team_2') }}</strong>
                                       </span>
                                   	@endif
                                </div>
                              </div>

                               <!--Odds 2-->
                              <div class="row">
                                <div class="form-group {{ $errors->has('odds_2') ? ' has-error' : '' }} col-md-8">
                                    <label>Odds 2</label>
                                    <select name="odds_2"   class="form-control">
                                        <option value="">Select Odds 2</option>
                                        @foreach($eventOdds as $odd)
                                            <option @if($event->odds2 == $odd->title) selected @endif value="{{ $odd->title }}">{{ $odd->title }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="number" step="0.01" class="form-control" placeholder="Enter Odds 2" name="odds_2" value="{{ $event->odds2 }}"> --}}
                                    @if ($errors->has('odds_2'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('odds_2') }}</strong>
                                       </span>
                                   @endif
                                </div>
                              </div>
                              <!--Drafts-->
                              <div class="row">
                                <div class="form-group {{ $errors->has('draw') ? ' has-error' : '' }} col-md-8">
                                    <label>Draw</label>
                                    <select name="draw"   class="form-control">
                                        <option value="">Select Draw</option>
                                        @foreach($eventOdds as $odd)
                                            <option @if($event->draw == $odd->title) selected @endif value="{{ $odd->title }}">{{ $odd->title }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="number" step="0.01" class="form-control" placeholder="Enter Draw" name="draw" value="{{ $event->draw }}"> --}}
                                    @if ($errors->has('draw'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('draw') }}</strong>
                                       </span>
                                   @endif
                                </div>
                              </div>

                                <!--Scroll-->
                              <div class="row">
                                <div class="form-group {{ $errors->has('scroll') ? ' has-error' : '' }} col-md-8">
                                    <label>Scroll</label>
                                    <input type="number" step="0.01" class="form-control" placeholder="Enter Scroll" name="scroll" value="{{ $event->scroll }}">
                                    @if ($errors->has('scroll'))
                                       <span class="help-block">
                                           <strong>{{ $errors->first('scroll') }}</strong>
                                       </span>
                                   @endif
                                </div>
                              </div>

                                    <!--EVENT DATE -->
                              <div class="row">
                            	    <div class="form-group col-md-6">
                                  <label>Event Date</label>
                                    <div class="input-group input-large date-picker input-daterange" data-date="12/11/2017" data-date-format="mm/dd/yyyy">
                                            <input type="text" class="form-control  datetimepicker" autocomplete="off"  id="start_date" name="start_date" value="{{ $event->start_date }}" placeholder="Start Date">
                                            <span class="input-group-addon"> to </span>
                                            <input type="text" class="form-control datetimepicker" autocomplete="off" id="end_date" value="{{ $event->end_date }}"  name="end_date" placeholder="End Date">
                                    </div>
                                    <span class="help-block"> Select date range </span>
                                  </div>
                              </div>

                                  <!--- live event -->
                              <input type="checkbox" class="make-switch" name="live"  data-on-color="success" data-off-color="warning" @if($event->live == 1)checked @endif >
                              <span class="help-block"> If Event Is Live Please Turn ON </span>
                               @if($role!=="creator")
                                <input type="checkbox" class="make-switch" name="featured"  data-on-color="success" data-off-color="warning" @if($event->featured == 1)checked @endif >
                                <span class="help-block"> If Featured Is Live Please Turn ON </span>
                               @endif
                          </div>
                          <div class="form-actions">
                              <button type="submit" class="btn blue">Submit</button>
                                <a class="btn default" href="{{route( $role == 'creator'? 'creator-event.index' :'admin-event.index')}}">Cancel</a>
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
@endsection
@section('script_bottom')
<script>
	$('#start_date').datetimepicker({
        	use24hours: true
   });
   $('#end_date').datetimepicker({
        	use24hours: true
   });
</script>
<script src="{{ asset('js/custome.js') }}" type="text/javascript"></script>
@endsection