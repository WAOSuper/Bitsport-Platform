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
<h1>Insert Event</h1>
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
<span class="active">Insert Event</span>
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
            <span class="caption-subject bold uppercase"> Insert Event</span>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

<div class="portlet-body form">
    <form role="form" method="post" action="{{route( $role == 'creator'? 'creator-event.store' :'admin-event.store')}}" enctype="multipart/form-data">
       <input type="hidden" name="_token" value="{{csrf_token()}}">
         <div class="form-body">

        	 <!--Event Name-->
          	    <div class="row">
                 <div class="form-group {{ $errors->has('eventname') ? ' has-error' : '' }} col-md-8">
                    <label>Event Name</label>
                  	<select name="eventname" id="eventmaster"  class="form-control">
                   		<option value="">Select Event</option>
                   		@foreach($eventmaster as $event)
                   		<option value="{{$event->id}}" {{ (collect(old('eventname'))->contains($event->id)) ? 'selected':'' }}>{{$event->event_name}}</option>
                   		@endforeach
                   	</select>
                    @if ($errors->has('eventname'))
                       <span class="help-block">
                           <strong>{{ $errors->first('eventname') }}</strong>
                       </span>
                   @endif
                </div>
                <div class="col-md-4">
                    <span class="set-left adds"> <a class="btn blue btn-outline sbold" data-toggle="modal" href="#evtmaster"> Add</a></span> 
                </div>
                 </div>

                  <!--Category Name-->
            	  <div class="row">
                <div class="form-group {{ $errors->has('catid') ? ' has-error' : '' }} col-md-8">
                    <label>Category Name</label> 
                  	<select name="catid" id="category"  class="form-control cateid">
                   		<option value="">Select Category</option>
                   		@foreach($category as $cat)
                   		<option value="{{$cat->id}}" {{ (collect(old('catid'))->contains($cat->id)) ? 'selected':'' }}>{{$cat->name}}</option>
                   		@endforeach
                   	</select>
                    @if ($errors->has('catid'))
                       <span class="help-block">
                           <strong>{{ $errors->first('catid') }}</strong>
                       </span>
                   @endif
                </div>  
            @if($role!=='creator')
                <div class="col-md-4">
                    <span class="set-left adds"> <a class="btn blue btn-outline sbold" data-toggle="modal" href="#eventcat"> Add</a></span> 
                </div> 
            @endif
                 </div>


                 <!--Sub Category Name-->
            	  <div class="row">
                <div class="form-group {{ $errors->has('scatid') ? ' has-error' : '' }} col-md-8">
                    <label>Sub Category Name</label> 
                  	<select name="scatid" id="sub_category"  class="form-control ">
                   		<option value="0">Select SubCategory</option>	
                   		
                   	</select>
                    @if ($errors->has('scatid'))
                       <span class="help-block">
                           <strong>{{ $errors->first('sub category') }}</strong>
                       </span>
                   @endif
                </div>
                @if($role!=='creator')
                    <div class="col-md-4">
                        <span class="set-left adds"> <a class="btn blue btn-outline sbold" data-toggle="modal" href="#eventscat"> Add</a></span> 
                    </div> 
                @endif
                 </div>

                @if($role!=='creator')
                       <!--Sub Sub Category Name-->
                  	  <div class="row">
                      <div class="form-group {{ $errors->has('sscatid') ? ' has-error' : '' }} col-md-8">
                          <label>Sub Sub Category Name</label> 
                        	<select name="sscatid" id="sub_sub_category"  class="form-control ">
                         		<option value="0">Select SubSubCategory</option>	
                         		
                         	</select>
                          @if ($errors->has('name'))
                             <span class="help-block">
                                 <strong>{{ $errors->first('Sub Sub category') }}</strong>
                             </span>
                          @endif
                      </div> 
                    <div class="col-md-4">
                     <span class="set-left adds"> <a class="btn blue btn-outline sbold" data-toggle="modal" href="#eventsscat"> Add</a></span> 
                  </div> 
                 </div>
                @endif
                <!--Video URL-->
                <div class="row">
                  <div class="form-group {{ $errors->has('video_url') ? ' has-error' : '' }} col-md-8">
                      <label>Twitch Video URL (  <span  id="channel-id-msg"  ><strong style="color:#000;" > Note: Please add valid Twitch URL</strong></span> )</label>
                      <input type="text" class="form-control" placeholder="Enter Video URL" name="video_url"  id="video_url" value="{{ old('video_url') }}" >
                      @if ($errors->has('video_url'))
                         <span class="help-block">
                             <strong>{{ $errors->first('video_url') }}</strong>
                         </span>
                     @endif
                  </div>
                </div>
             
                <!--Channel Id-->
               <!--  <div class="row">
                  <div class="form-group {{ $errors->has('channel_id') ? ' has-error' : '' }} col-md-8">
                      <label>Channel Id</label>
                      <input type="text" class="form-control" placeholder="Enter Channel id" name="channel_id"  id="channel_id" readonly value="{{ old('channel_id') }}">
                      @if ($errors->has('channel_id'))
                         <span class="help-block">
                             <strong>{{ $errors->first('channel_id') }}</strong>
                         </span>
                     @endif
                  </div>
                </div>
 -->

                 <!--Team 1-->
                 <div class="row">
                <div class="form-group {{ $errors->has('team_1') ? ' has-error' : '' }} col-md-8">
                    <label>Team 1</label>
                   	<select name="team_1" id="team_1"  class="form-control team1">
                   		<option value="">Select Team</option>
                      @foreach($teams as $tt)
                        <option value="{{ $tt->id }}">{{ $tt->name }}</option> 
                      @endforeach
                   	</select>
               		@if ($errors->has('team_1'))
                       <span class="help-block">
                           <strong>{{ $errors->first('team_1') }}</strong>
                       </span>
                   	@endif
                </div>
                <div class="col-md-4">
               <span class="set-left adds"> <a class="btn blue btn-outline sbold" data-toggle="modal" href="#eventteam"> Add </a></span> 
            </div>
                </div>


                <!--Odds 1-->
                 <div class="row">
                <div class="form-group {{ $errors->has('odds_1') ? ' has-error' : '' }} col-md-8">
                    <label>Odds 1</label>
                    <select name="odds_1"   class="form-control">
                        <option value="">Select Odds 1</option>
                        @foreach($eventOdds as $odd)
                            <option value="{{ $odd->title }}">{{ $odd->title }}</option> 
                        @endforeach
                    </select>
                    {{-- <input type="number" step="0.01" class="form-control" placeholder="Enter Odds 1" name="odds_1" value="{{ old('odds_1') }}"> --}}
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
                      @foreach($teams as $tt)
                        <option value="{{ $tt->id }}">{{ $tt->name }}</option> 
                      @endforeach
                   	</select>
               		@if ($errors->has('team_2'))
                       <span class="help-block">
                           <strong>{{ $errors->first('team_2') }}</strong>
                       </span>
                   	@endif
                </div>
                <div class="col-md-4">
               <span class="set-left adds"> <a class="btn blue btn-outline sbold" data-toggle="modal" href="#eventteam"> Add  </a></span> 
            </div>
                </div>

                 <!--Odds 2-->
                  <div class="row">
                <div class="form-group {{ $errors->has('odds_2') ? ' has-error' : '' }} col-md-8">
                    <label>Odds 2</label>
                    <select name="odds_2"   class="form-control">
                        <option value="">Select Odds 2</option>
                        @foreach($eventOdds as $odd)
                            <option value="{{ $odd->title }}">{{ $odd->title }}</option> 
                        @endforeach
                    </select>
                    {{-- <input type="number" step="0.01" class="form-control" placeholder="Enter Odds 2" name="odds_2" value="{{ old('odds_2') }}"> --}}
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
                            <option value="{{ $odd->title }}">{{ $odd->title }}</option> 
                        @endforeach
                    </select>
                    {{-- <input type="number" step="0.01" class="form-control" placeholder="Enter Draw" name="draw" value="{{ old('draw') }}"> --}}
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
                <!--     <label>Scroll</label> -->
                    <input type="hidden" step="0.01" class="form-control" placeholder="Enter Scroll" name="scroll" value="{{ old('scroll') }}">
                    @if ($errors->has('scroll'))
                       <span class="help-block">
                           <strong>{{ $errors->first('scroll') }}</strong>
                       </span>
                   @endif
                </div>
               </div>
             	<!--EVENT DATE -->
                <div class="row">
              	  <div class="form-group col-md-6 {{ $errors->has('start_date') || $errors->has('end_date') ? ' has-error' : '' }}">
                   <label>Event Date</label>
                    <div class="input-group input-large date-picker input-daterange" data-date="12/11/2017" data-date-format="mm/dd/yyyy">
                        <input type="text" class="form-control datetimepicker" autocomplete="off" value="{{ old('start_date') }}" id="start_date" name="start_date" placeholder="Start Date">
                        <span class="input-group-addon"> to </span>
                        <input type="text" class="form-control datetimepicker" autocomplete="off" value="{{ old('end_date') }}" id="end_date" name="end_date" placeholder="End Date">
                    </div>
                    @if ($errors->has('start_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('start_date') }}</strong>
                        </span>
                    @endif
                    @if ($errors->has('end_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('end_date') }}</strong>
                        </span>
                    @endif
                    <span class="help-block"> Select date range </span>
                  </div>
                </div>

             <!--- live event -->
             <input type="checkbox" class="make-switch" name="live"  data-on-color="success" data-off-color="warning">
             <span class="help-block"> If Event Is Live Please Turn ON </span>
            @if($role!=="creator")
                <input type="checkbox" class="make-switch" name="featured"  data-on-color="success" data-off-color="info">
                <span class="help-block"> If Featured Is Live Please Turn ON </span>
            @endif
                   </div>

            <div class="form-actions">
                <button type="submit" class="btn blue">Submit</button>
                  <a class="btn default" href="{{route($role == 'creator' ? 'creator-event.index' :'admin-event.index')}}">Cancel</a>
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

<!-- Channel model -->
<div class="modal fade" id="eventchannel" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Select Channel</h4>
            </div>
            <div class="modal-body"> 
              <div id="channel_tab"> 

              </div>
        
          </div>
          <div class="modal-footer">
            <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
          </div>
      </div>                                 
    </div>                                       
</div>

<!-- Category model -->
<div class="modal fade" id="eventcat" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add Category</h4>
            </div>
            <div class="modal-body"> 
              <div class="alert alert-danger" style="display:none"><ul class="val_errors1" ></ul></div> 
         <form action="" method="post" id="cat">
    <div class="form-group">
	   <label>Category Name</label>
	       <input type="text" class="form-control cate" placeholder="Enter Category Name" name="cname">                       
	</div>
	<div class="form-group">
	     <label>Slug</label>
	     <input type="text" class="form-control cate" placeholder="Enter Slug Name" name="slug">
	</div>
	<div class="form-group">
	    <label>Icon</label>
	    <input type="text" class="form-control cate" placeholder="Enter Icon Name" name="icon">                                  
	</div>
	</form>
    </div>
       <div class="modal-footer">
            <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
            <button type="button" id="Submit-cat" class="btn green">Save</button>
        </div>
    </div>                                 
    </div>                                       
</div>

<!-- Sub Category model -->
<div class="modal fade" id="eventscat" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add Sub Category</h4>
            </div>
            <div class="modal-body"> 
              <div class="alert alert-danger" style="display:none"><ul class="val_errors2" ></ul></div> 
         <form action="" method="post" id="subcat">
   <div class="form-group">
	    <label>Category Name</label> 
	    <select name="CategoryName" id="category"  class="form-control cat cateid">
	        <option value="">Select Category</option>	
	        @foreach($category as $cat)
	        <option value="{{$cat->id}}">{{$cat->name}}</option>
	        @endforeach
	    </select>
    </div> 
    <div class="form-group">
	     <label>Sub Category Name</label>
	     <input type="text" id="subcatname" class="form-control subcatid" placeholder="Enter Sub Category Name" name="SubCategoryName">
	</div>
	<div class="form-group">
	     <label>Slug</label>
	     <input type="text" id="subcatname" class="form-control " placeholder="Enter Slug Name" name="slug">
	</div>
	
	</form>
    </div>
       <div class="modal-footer">
            <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
            <button type="button" id="Submit-subcat" class="btn green">Save</button>
        </div>
    </div>                                 
    </div>                                       
</div>


<!-- Sub Sub Category model -->
<div class="modal fade" id="eventsscat" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add Sub Sub Category</h4>
            </div>
            <div class="modal-body"> 
              <div class="alert alert-danger" style="display:none"><ul class="val_errors3" ></ul></div> 
               <form action="" method="post" id="subsubcat">
               <div class="form-group">
            	    <label>Category Name</label> 
            	    <select name="CategoryName" id="categoryid"  class="form-control ssc cateid">
            	        <option value="">Select Category</option>	
            	        @foreach($category as $cat)
            	        <option value="{{$cat->id}}">{{$cat->name}}</option>
            	        @endforeach
            	    </select>
                </div> 
                <div class="form-group">
            	     <label>Sub Category Name</label> 
            	     <select name="SubCategoryName" id="sub_categoryid"  class="form-control ssc subcatid">
            	        <option value="0">Select SubCategory</option>	     		
            	     </select>
            	</div> 
            	<div class="form-group">
            	     <label>Sub Sub Category</label>
            	     <input type="text" class="form-control ssc" placeholder="Enter Sub Sub Category Name" name="SubSubCategoryName">
            	</div>
            	<div class="form-group">
            	     <label>Slug</label>
            	     <input type="text" class="form-control ssc" placeholder="Enter Slug Name" name="slug">
            	</div>
            	</form>
          </div>
       <div class="modal-footer">
            <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
            <button type="button" id="Submit-subsubcat" class="btn green">Save</button>
        </div>
    </div>
    </div>
</div>


<!-- Team model -->
<div class="modal fade" id="eventteam" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add Team</h4>
            </div>
            <div class="modal-body"> 
              <div class="alert alert-danger" style="display:none"><ul class="val_errors4" ></ul></div> 
         <form action="" method="post" id="evntteam">
         <div class="form-group">
      	     <label>Team Name</label>
      	     <input type="text" class="form-control tm" placeholder="Enter Taem Name" name="TeamName">
         </div>     	
         <!-- <div class="form-group">
      	    <label>Category Name</label> 
      	    <select name="CategoryName" id=""  class="form-control tm categoryteam">
      	        <option value="">Select Category</option>	
      	        @foreach($category as $cat)
      	        <option value="{{$cat->id}}">{{$cat->name}}</option>
      	        @endforeach
      	    </select>
          </div> 
          <div class="form-group">
      	     <label>Sub Category Name</label> 
      	     <select name="SubCategoryName" id=""  class="form-control tm sub_categoryteam">
      	        <option value="0">Select SubCategory</option>	     		
      	     </select>
      	</div> 
      	<div class="form-group">
      	     <label>Sub Sub Category Name</label> 
      	     <select name="SubSubCategoryName" id=""  class="form-control  sub_sub_categoryteam">
      	        <option value="">Select SubSubCategory</option>	     		
      	     </select>
      	</div>  -->
	
	     </form>
    </div>
       <div class="modal-footer">
            <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
            <button type="button" id="Submit-evntteam" class="btn green">Save</button>
        </div>
    </div>                                 
    </div>                                       
</div>


<!-- Event Master model -->
<div class="modal fade" id="evtmaster" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add Event Master</h4>
            </div>
            <div class="modal-body">
          
            <div class="alert alert-danger" style="display:none"><ul class="val_errors5" ></ul></div> 
         
         <form action="" method="post" id="evntmaster">
   <div class="form-group">
	     <label>Event Name</label>
	     <input type="text" class="form-control eventnm" placeholder="Enter Event Name" name="EventName">
   </div>     	
  
	</form>
    </div>
       <div class="modal-footer">
            <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
            <button type="button" id="Submit-evntmaster" class="btn green">Save</button>
        </div>
    </div>
    </div>
</div>


@endsection
@section('script')
  <script src="{{asset('assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/pages/scripts/components-bootstrap-switch.min.js')}}" type="text/javascript"></script>
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
<script>
    function setChannelId(channel_id){
    $("#channel_id").val(channel_id);
}
</script>
@endsection