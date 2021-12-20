@extends('layouts.master')
<!-- head -->
@section('title')
    Bitsport | Profile
@endsection
<!-- title -->
@section('head')
  
@endsection

@section('content')
<?php
   $slug = Sentinel::getUser()->roles()->first()->slug;
?>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
	    <div class="page-content" style="min-height: 1603px;">
	        <!-- BEGIN PAGE HEAD-->
	        <div class="page-head">
	            <!-- BEGIN PAGE TITLE -->
	            <div class="page-title">
	                <h1>Edit Sponser Profile

	                </h1>

	            </div>
	            <!-- END PAGE TITLE -->
	        </div>
	        <!-- END PAGE HEAD-->


	        <!-- BEGIN PAGE BREADCRUMB -->
	        <ul class="page-breadcrumb breadcrumb">
	            <li>
	            	@if($slug=='superadmin')
	                	<a href="{{url('super-admin')}}">Home</a>
	                @elseif($slug=='admin')
	                	<a href="{{url('admin-dashboard')}}">Home</a>
	                @else
	                	<a href="javascript:;">Home</a>
	                @endif
	                <i class="fa fa-circle"></i>
	            </li>
	            <li>
	                <span class="active">Update Profile</span>
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
	                            <span class="caption-subject bold uppercase"> Update Sponser Profile</span>
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
	                      {{ Form::model($user, array('route' => array('profile.update', $user->id), 'method' => 'POST','files'=>'true')) }}
	                            <input type="hidden" name="_token" value="{{csrf_token()}}">
	                            <div class="form-body">
	                            	 <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
	                                    <label>Username</label>
	                                    <input type="text" class="form-control" placeholder="Username" name="username" value="{{$user->username}}">
	                                    @if ($errors->has('first_name'))
    				                       <span class="help-block">
    				                           <strong>{{ $errors->first('first_name') }}</strong>
    				                       </span>
    				                   @endif
	                                </div> 
									 
									 <!--First  Name-->
	                                <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
	                                    <label>First Name</label>
	                                    <input type="text" class="form-control" placeholder="Enter first name" name="first_name" value="{{$user->first_name}}">
	                                    @if ($errors->has('first_name'))
    				                       <span class="help-block">
    				                           <strong>{{ $errors->first('first_name') }}</strong>
    				                       </span>
    				                   @endif
	                                </div> 
	                                 <!--Last  Name-->
	                                <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
	                                    <label>Last Name</label>
	                                    <input type="text" class="form-control" placeholder="Enter Last name" name="last_name" value="{{$user->last_name}}">
	                                    @if ($errors->has('last_name'))
    				                       <span class="help-block">
    				                           <strong>{{ $errors->first('last_name') }}</strong>
    				                       </span>
    				                   @endif
	                                </div> 
	                                 <!--Email-->
	                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
	                                    <label> Email Address</label>
	                                    <input type="email" class="form-control"  value="{{$user->email}}" readonly="">
	                                </div> 
	                                <!--Mobile Number-->
	                                <div class="form-group {{ $errors->has('mobile_number') ? ' has-error' : '' }}">
	                                    <label>Mobile Number</label>
	                                    <input type="number" class="form-control" placeholder="Enter Mobile Number" name="mobile_number" value="{{ $user->mobile}}">
	                                    @if ($errors->has('mobile_number'))
    				                       <span class="help-block">
    				                           <strong>{{ $errors->first('mobile_number') }}</strong>
    				                       </span>
    				                   @endif
	                                </div>
	                                <div class="form-group">
	                                    <label>Profile Image</label>
	                                    @if($user->profile)
		                                    @if(file_exists(public_path('assets/images/profile/'.$user->profile)))
	                                            <img src="{{ URL::asset('assets/images/profile')}}/{{$user->profile}}" id="profile" width="80px" height="80px" /> 
	                                        @else
	                                            <img src="{{  URL::asset('assets/images/profile/default.png') }}" height="80px" id="profile" width="80px" class="img-thumbnail" />
	                                        @endif 
                                         @else
                                            <img src="{{  URL::asset('assets/images/profile/default.png') }}" height="80px" id="profile" width="80px" class="img-thumbnail" />
                                        @endif

                                        <input type="hidden" name="old_profile" value="{{$user->profile}}" />
	                                    <input type="file" name="profile" class="form-control" onchange="readURL(this);" />

	                                </div>
	                                <div class="form-group {{ $errors->has('is_curator') ? ' has-error' : '' }}">
	                                    <label>Curator</label>
	                                	<input type="checkbox" @php if($user->is_curator==1) echo "checked='checked'" @endphp value="1" name="is_curator" />
	                                </div> 
	                                <div style="display:none" style="display:none" class="form-group {{ $errors->has('is_curator') ? ' has-error' : '' }}">
										<label>Console ID (PSN username | Xbox Gamertag etc)</label>
	                                    <input type="number" class="form-control" placeholder="Enter Console ID" name="psn_username" value="{{ $user->psn_username}}">
	                                </div>
	                                <div style="display:none" class="form-group {{ $errors->has('is_curator') ? ' has-error' : '' }}">
										<label>Game Amount Limit</label>
	                                    <input type="number" class="form-control" placeholder="Enter Game Amount Limit" name="game_amount_limit" value="{{ $user->game_amount_limit}}">
	                                </div> 
	                                <div class="form-group {{ $errors->has('is_curator') ? ' has-error' : '' }}">
										<label>Prefered Console</label>
										<?php echo Form::select('preferred_console_id', $console,  $user->prefered_console_id, ['class' => 'form-control placeholder-no-fix', 'id' => 'console']); ?>
	                                </div> 
	                                <div class="form-group {{ $errors->has('is_curator') ? ' has-error' : '' }}">
										<label>Prefered Game</label>
										<?php echo Form::select('preferred_game_id', array(), null, ['class' => 'form-control placeholder-no-fix', 'id' => 'game']); ?>
	                                </div> 
	                            </div>
	                            <div class="form-actions">
	                                <button type="button" class="btn blue" data-toggle="modal" data-target="#alertModal">Update</button>
	                                <button type="submit" class="btn default" >Cancel</button>
	                            </div>
	                            <div class="modal fade" id="alertModal" tabindex="-1" role="dialog">
					              <div class="modal-dialog" role="document">
					                <div class="modal-content">
					                  <div class="modal-header">
					                    <h5 class="modal-title" id="exampleModalLabel">Profile Update ?</h5>
					                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                      <span aria-hidden="true">&times;</span>
					                    </button>
					                  </div>
					                  <div class="modal-body">
					                    Are you sure ? you want to update your profile ? 
					                  </div>
					                  <div class="modal-footer">
					                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					                    <button type="submit" class="btn btn-primary">Save changes</button>
					                  </div>
					                </div>
					              </div>
					            </div>
	                         {{ Form::close()}}
	                    </div>
	                </div>

	            </div>

	            <div class="col-md-6 ">
	                <!-- BEGIN SAMPLE FORM PORTLET-->
	                <div class="portlet light bordered">
	                    <div class="portlet-title">
	                        <div class="caption font-blue-sunglo">
	                            <i class="icon-settings font-blue-sunglo"></i>
	                            <span class="caption-subject bold uppercase"> Change Password</span>
	                        </div>

	                    </div>

						@if(session('successpass'))
	                    <div class="alert alert-success">
	                        {{ session('successpass') }}
	                    </div>
	                    @endif 
	                    @if(session('errorpass'))
	                    <div class="alert alert-danger">
	                        {{ session('errorpass') }}
	                    </div>
	                    @endif

	                    <div class="portlet-body form">
	                      {{ Form::model($user, array('route' => array('password.update', $user->id), 'method' => 'POST')) }}
	                            <input type="hidden" name="_token" value="{{csrf_token()}}">
	                            <div class="form-body">
	                            	 <!--Old Password-->
	                                <div class="form-group {{ $errors->has('old_password') ? ' has-error' : '' }}">
	                                    <label>Old Password</label>
	                                    <input type="password" class="form-control" placeholder="Enter Old Password" name="old_password" >
	                                    @if ($errors->has('old_password'))
    				                       <span class="help-block">
    				                           <strong>{{ $errors->first('old_password') }}</strong>
    				                       </span>
    				                   @endif
	                                </div>  
	                                <!--New Password-->
	                                <div class="form-group {{ $errors->has('new_password') ? ' has-error' : '' }}">
	                                    <label>New Password</label>
	                                    <input type="password" class="form-control" placeholder="Enter New Password" name="new_password" >
	                                    @if ($errors->has('new_password'))
    				                       <span class="help-block">
    				                           <strong>{{ $errors->first('new_password') }}</strong>
    				                       </span>
    				                   @endif
	                                </div>  
	                                <!--Confirm Password-->
	                                <div class="form-group {{ $errors->has('confirm_password') ? ' has-error' : '' }}">
	                                    <label>Confirm Password</label>
	                                    <input type="password" class="form-control" placeholder="Enter Confirm Password" name="confirm_password" >
	                                    @if ($errors->has('confirm_password'))
    				                       <span class="help-block">
    				                           <strong>{{ $errors->first('confirm_password') }}</strong>
    				                       </span>
    				                   @endif
	                                </div> 
	                               
	                            </div>
	                            <div class="form-actions">
	                                <button type="submit" class="btn blue">Update</button>
	                             
	                            </div>
	                         {{ Form::close()}}
	                    </div>
	                </div>

	            </div>

	        </div>

	        <!-- END PROFILE PAGE BASE CONTENT -->
	    </div>
	    <!-- END CONTENT BODY -->
	</div>

	

@endsection
<!-- content -->

@section('script')
@endsection
@section('script_bottom')
  <script type="text/javascript">
	$('#console').on('change', function() {
		loadGame(this.value);
		$("#psn_id").hide();
		$("#xbox_id").hide();
		$("#psn_id input").removeAttr('required');
		$("#xbox_id input").removeAttr('required');
		if (this.value == 1) {
			$("#psn_id").show();
			$("#psn_id input").attr('required', true);
		}
		if (this.value == 2) {
			$("#xbox_id").show();
			$("#xbox_id input").attr('required', true);
		}
	});

    loadGame($('#console').val());

	function loadGame(value) {
		$.ajax({
			type: 'get',
			dataType: 'json',
			url: "{{url('challenge/get-games')}}" + '/' + value,
			success: function(responseData) {
				$('#game').html('');
				$.each(responseData, function(i, value) {
					var option = $("<option></option>");
						option.attr("value", value.id).text(value.name).attr('has-mode', value.mode.length);
						if(value.id == "{{$user->preferred_game_id}}"){
							option.attr('selected','selected');
						}
						$('#game').append(option);
				});
			},
			error: function(responseData) {
				return false;
			}
		});
	}
  
      function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function (e) {
                  $('#profile')
                      .attr('src', e.target.result);
              };

              reader.readAsDataURL(input.files[0]);
          }
      }

      function myFunction() {
	    /* Get the text field */
	    var copyText = document.getElementById("copy");

	    /* Select the text field */
	    copyText.select();

	    /* Copy the text inside the text field */
	    document.execCommand("copy");
	  }
    </script>

@endsection  