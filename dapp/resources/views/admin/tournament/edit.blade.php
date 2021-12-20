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
<h1>Edit Tournament</h1>
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
<span class="active">Edit Tournament</span>
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
            <span class="caption-subject bold uppercase"> Edit Tournament</span>
        </div>

    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

<div class="portlet-body form">
    <form role="form" method="post" action="{{url('update-tournament').'/'.$id}}" enctype="multipart/form-data">
       <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="form-body">
        	    <div class="row">
                <div class="form-group {{ $errors->has('tournamentname') ? ' has-error' : '' }} col-md-8">
                  <label>Tournament Name</label> 
                	<input type="text" class="form-control" placeholder="Tournament Name" name="tournamentname"  id="tournamentname" value="{{ $tournament->name }}" >
                  @if ($errors->has('tournamentname'))
                    <span class="help-block">
                      <strong>{{ $errors->first('tournamentname') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group {{ $errors->has('startdatetime') ? ' has-error' : '' }} col-md-8">
                  <label>Start Date & Time</label> 
                  <input type="text" class="form-control" placeholder="Start Date" name="startdatetime"  id="startdatetime" value="{{ $tournament->start_date_time }}" >
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
                  <input type="text" class="form-control" placeholder="End Date" name="enddatetime"  id="enddatetime" value="{{ $tournament->end_date_time }}" >
                  @if ($errors->has('enddatetime'))
                    <span class="help-block">
                      <strong>{{ $errors->first('enddatetime') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group {{ $errors->has('platform') ? ' has-error' : '' }} col-md-8">
                  <label>Platform</label> 
                  <input type="text" class="form-control" placeholder="Platform" name="platform"  id="platform" value="{{ $tournament->platform }}" >
                  @if ($errors->has('platform'))
                    <span class="help-block">
                      <strong>{{ $errors->first('platform') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group {{ $errors->has('headerbanner') ? ' has-error' : '' }} col-md-8">
                  <label>Header Banner</label> 
                  <input type="file" class="form-control" placeholder="Header Banner" name="headerbanner"  id="headerbanner" >
                  @if ($errors->has('headerbanner'))
                    <span class="help-block">
                      <strong>{{ $errors->first('headerbanner') }}</strong>
                    </span>
                  @endif
                  @if($tournament->header_banner)
                  <label>Old Header</label> <img width="40px" height="40px" src="{{url('storage/galeryImages').'/'.$tournament->header_banner}}" />
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group {{ $errors->has('header_banner_thumbnail') ? ' has-error' : '' }} col-md-8">
                  <label>Header Banner Thumbnail</label> 
                  <input type="file" class="form-control" placeholder="Header Banner" name="header_banner_thumbnail"  id="header_banner_thumbnail" >
                  @if ($errors->has('header_banner_thumbnail'))
                    <span class="help-block">
                      <strong>{{ $errors->first('header_banner_thumbnail') }}</strong>
                    </span>
                  @endif
                  @if($tournament->header_banner_thumbnail)
                  <label>Old Header Thumbnail</label> <img width="40px" height="40px" src="{{url('storage/galeryImages/thumbnail').'/'.$tournament->header_banner_thumbnail}}" />
                  @endif
                </div>
              </div>


              <!--Category Name-->
              <div class="row">
                <div class="form-group {{ $errors->has('region_id') ? ' has-error' : '' }} col-md-8">
                  <label>Regions</label> 
                  <select name="region_id" id="region_id"  class="form-control ">
                    <option value="">Select Region</option> 
                    @foreach($regions as $region)
                        <option value="{{$region->id}}" 
                          @if($tournament->region_id == $region->id) selected @endif>{{$region->name}}</option>
                    @endforeach
                  </select>
                    @if ($errors->has('region_id'))
                      <span class="help-block">
                         <strong>{{ $errors->first('region_id') }}</strong>
                      </span>
                    @endif
                </div> 
              </div>


              <div class="row">
                <div class="form-group {{ $errors->has('catid') ? ' has-error' : '' }} col-md-8">
                  <label>Category Name</label> 
                  <select name="catid" id="category"  class="form-control ">
                    <option value="">Select Category</option> 
                    @foreach($category as $cat)
                        <option value="{{$cat->id}}" 
                          @if($tournament->cat_id == $cat->id) selected @endif>{{$cat->name}}</option>
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
                <div class="form-group {{ $errors->has('scatname') ? ' has-error' : '' }} col-md-8">
                    <label>Sub Category Name</label> 
                    <select name="scatid" id="sub_category"  class="form-control ">
                      <option value="">Select SubCategory</option>  
                      @if($tournament->sub_cat_id != 0)
                          @foreach($subcategory as $scat)
                                        <option value="{{$scat->id}}" @if($tournament->sub_cat_id == $scat->id) selected @endif>{{$scat->name}}</option>
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

              <div class="row">
                <div class="form-group {{ $errors->has('about') ? ' has-error' : '' }} col-md-8">
                  <label>About</label> 
                  <textarea type="text" class="form-control" placeholder="About" name="about"  id="about" >{{ $tournament->about }}</textarea>
                  @if ($errors->has('about'))
                    <span class="help-block">
                      <strong>{{ $errors->first('about') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

               <div class="row">
                <div class="form-group {{ $errors->has('stats') ? ' has-error' : '' }} col-md-8">
                  <label>Stats</label> 
                  <textarea type="text" class="form-control" placeholder="Stats" name="stats"  id="stats" >{{ $tournament->stats }}</textarea>
                  @if ($errors->has('stats'))
                    <span class="help-block">
                      <strong>{{ $errors->first('stats') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group {{ $errors->has('contactdetails') ? ' has-error' : '' }} col-md-8">
                  <label>Contact Details</label> 
                  <textarea type="text" class="form-control" placeholder="Contact Details" name="contactdetails"  id="contactdetails" >{{ $tournament->contact_details }}</textarea>
                  @if ($errors->has('contactdetails'))
                    <span class="help-block">
                      <strong>{{ $errors->first('contactdetails') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group {{ $errors->has('criticalrules') ? ' has-error' : '' }} col-md-8">
                  <label>Critical Rules</label> 
                  <textarea type="text" class="form-control" placeholder="Critical Rules" name="criticalrules"  id="criticalrules" >{{ $tournament->critical_rules }}</textarea>
                  @if ($errors->has('criticalrules'))
                    <span class="help-block">
                      <strong>{{ $errors->first('criticalrules') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group {{ $errors->has('rules') ? ' has-error' : '' }} col-md-8">
                  <label>Rules</label> 
                  <textarea type="text" class="form-control" placeholder="Rules" name="rules"  id="rules" >{{ $tournament->rules }}</textarea>
                  @if ($errors->has('rules'))
                    <span class="help-block">
                      <strong>{{ $errors->first('rules') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group {{ $errors->has('prizes') ? ' has-error' : '' }} col-md-8">
                  <label>Prizes</label> 
                  <textarea type="text" class="form-control" placeholder="Prizes" name="prizes"  id="prizes" >{{ $tournament->prizes }}</textarea>
                  @if ($errors->has('prizes'))
                    <span class="help-block">
                      <strong>{{ $errors->first('prizes') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group {{ $errors->has('schedule') ? ' has-error' : '' }} col-md-8">
                  <label>Schedule</label> 
                  <textarea type="text" class="form-control" placeholder="Schedule" name="schedule"  id="schedule" >{{ $tournament->schedule }}</textarea>
                  @if ($errors->has('schedule'))
                    <span class="help-block">
                      <strong>{{ $errors->first('schedule') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group {{ $errors->has('curatorreward') ? ' has-error' : '' }} col-md-8">
                  <label>Reward to Curator</label> 
                  <input type="number" class="form-control" name="curatorreward"  id="curatorreward" value="{{ $tournament->curator_rewards }}" >
                  @if ($errors->has('curatorreward'))
                    <span class="help-block">
                      <strong>{{ $errors->first('curatorreward') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group {{ $errors->has('betpercent') ? ' has-error' : '' }} col-md-8">
                  <label>Percentage of bet to participant</label> 
                  <input type="number" class="form-control" name="betpercent"  id="betpercent" value="{{ $tournament->bet_percentage }}" >
                  @if ($errors->has('betpercent'))
                    <span class="help-block">
                      <strong>{{ $errors->first('betpercent') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group {{ $errors->has('playerlimit') ? ' has-error' : '' }} col-md-8">
                  <label>Player Limit</label> 
                  <input type="number" class="form-control" name="playerlimit"  id="playerlimit" value="{{ $tournament->player_limit }}" >
                  @if ($errors->has('playerlimit'))
                    <span class="help-block">
                      <strong>{{ $errors->first('playerlimit') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group {{ $errors->has('validators') ? ' has-error' : '' }} col-md-8">
                  <label>Validators</label> 
                  <input type="number" class="form-control" name="validators"  id="validators" value="{{ $tournament->validators }}" >
                  @if ($errors->has('validators'))
                    <span class="help-block">
                      <strong>{{ $errors->first('validators') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group {{ $errors->has('fees') ? ' has-error' : '' }} col-md-8">
                  <label>Fees</label> 
                  <input type="text" class="form-control" name="fees"  id="fees" value="{{ $tournament->fees }}" >
                  @if ($errors->has('fees'))
                    <span class="help-block">
                      <strong>{{ $errors->first('fees') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

          </div>

            <div class="form-actions">
                <button type="submit" class="btn blue">Submit</button>
                  <a class="btn default" href="javascript:void(0);" onclick="this.window.reload()">Cancel</a>
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
    CKEDITOR.replace( 'stats' );
    CKEDITOR.replace( 'contactdetails' );
    CKEDITOR.replace( 'schedule' );
    CKEDITOR.replace( 'prizes' );
    function setChannelId(channel_id){
    $("#channel_id").val(channel_id);
}
</script>
@endsection