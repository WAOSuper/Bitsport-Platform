@extends('frontend.layouts.master')
@section('title') BitSport &trade; | Peer to Peer competitive eSports platform @endsection
@section('head')
<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<style type="text/css">
	.badge-danger {
		color: white;
		background-color: Red;
	}

	img .live {
		width: 14%;
		height: auto;
	}
</style>

<div class="content col-md-9">
	<!-- Posts Area 1 -->
	<!-- Latest News -->
	@include('frontend.layouts.messagess')

	<div class="card card--clean mb-0 mainsectionbg">
		<div>
			<h5 class="headertexttop">Challenge</h5>
			<hr>
			<div class="row">
				<div class="col-md-8 col-md-offset-1">
					<div class="row h4">
					@if($challenge->status === 1)
						<span>Play game and report.</span>
					@elseif($challenge->status === 5)
						@if($challenge->winner_id === 0)
							<span>Challenge result is draw.</span>
						@elseif($challenge->winner_id === $user_id)
							<span>You've won this challenge.</span>
						@elseif($challenge->winner_id !== $user_id)
							<span>You've lost this challenge.</span>
						@endif
					@elseif($challenge->status === 6)
						<span>Challenge is under dispute.</span>
					@endif
					</div>

					<div class="row">
						Opponent
					</div>
					<div class="row">
						<div class="col-md-2">
							@if($challenge->user_id === $user_id)	
								@if($challenge->creator->profile)
								<img alt="" class="img-circle" src="{{url('/')}}/assets/images/profile/{{$challenge->creator->profile}}" /> </a>
								@else
								<img alt="" class="img-circle" src="{{url('/')}}/assets/images/profile/default.png" /> </a>
								@endif
							@endif
							@if($challenge->opponent_id === $user_id)	
								@if($challenge->opponent->profile)
								<img alt="" class="img-circle" src="{{url('/')}}/assets/images/profile/{{$challenge->opponent->profile}}" /> </a>
								@else
								<img alt="" class="img-circle" src="{{url('/')}}/assets/images/profile/default.png" /> </a>
								@endif
							@endif
						</div>
						<div class="col-md-10">
							@if($challenge->user_id === $user_id)
							<div class="row">
								<span>{{$challenge->opponent->username}}</span>
								<a href="#" data-id="{{$challenge->opponent->id}}" class="view-profile">View Profile</a>
							</div>
							<div class="row">
								Console ID: {{$challenge->opponent->username}}
							</div>
							@elseif($challenge->opponent_id === $user_id)
							<div class="row">
								<span>{{$challenge->creator->username}}</span>
								<a href="#" data-id="{{$challenge->creator->id}}"  class="view-profile">View Profile</a>
							</div>
							<div class="row">
								<span>
									Console ID: {{$challenge->creator->username}}
								</span>
							</div>
							@endif
						</div>
					</div>

					@if($challenge->status === 1)
						@if($challenge->user_id === $user_id)
							@if($challenge->rules_o)
							<div class="row mt-10">
								<label>Rules :</label>
								<span>{{$challenge->rules_o}}</span>
							</div>
							@endif
						@endif
						@if($challenge->user_id !== $user_id)
							@if($challenge->rules_c)
							<div class="row mt-10">
								<label>Rules :</label>
								<span>{{$challenge->rules_c}}</span>
							</div>
							@endif
						@endif
					@endif

					@if($challenge->status == 1)
					<div class="row mt-10">
						@if(!$both_submitted && !$submission_pending)
						Waiting for submission from opponent
						@endif
						@if($submission_pending)
						<button type="button" class="btn btn-success" id="report">Report Result</button>
						@endif
					</div>
					@endif
					
					@if($challenge->status == 6)
						<button type="button" class="btn btn-success" id="dispute">Dispute</button>
					@endif

					<div class="row">
						<?php echo $chat ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script src="{{ URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/jquery.form.js') }}"></script>

<script type="text/javascript">
	var config = {
		csrf: "{{csrf_token()}}"
	}
	var socketUrl = "{{\config('chat.socket.url')}}";
	var chat = new ChatController(<?= $user_id ?>, <?= $to_user_id ?>, "<?= $to_user_name ?>", socketUrl);
	$("#message").keydown(chat.sendMessage);
	var resultValidator, disputeValidator;
	$('#submit').click(function() {
		var $form = $('#result-form').serializeArray();
		if ($('#result-form').valid()) {
			var data = {};
			$form.forEach(function(field) {
				data[field.name] = field.value;
			});
			$('#submit').attr('disabled','disabled');
			$.ajax({
				url: '/challenge/submit-result/' + "{{$challenge->id}}",
				data: data,
				method: 'patch',
				headers: {
					'X-CSRF-TOKEN': config.csrf
				}
			}).done(function(res) {
				$('#reportModal').modal('hide');
				if (res === 'already_submitted') {
					swal("Opps! you've already submitted the result please refresh your page!");
				} else if (res === 'result_submitted') {
					swal("Congrats! You have successfully submitted the result!", {
						icon: "success",
					}).then(() => {
						location.href = '/events/challenges';
					});
				}
				$('#submit').removeAttr('disabled');
			}).fail(function(error) {
				$('#submit').removeAttr('disabled');
				swal("Opps! some error occured please try again later!");
			});
		}
	});

	$('#report').click(function() {
		$('#reportModal').modal('show');
		resultValidator = $("#result-form").validate({
			errorPlacement: function(error, element) {
				error.appendTo(element.closest('.form-group'));
			}
		});
	});

	$('#reportModal').on('hidden.bs.modal', function(e) {
		resultValidator.resetForm();
		$('#result-form').trigger("reset");
	});

	$('#dispute').click(function() {
		$('#disputeModal').modal('show');
		disputeValidator = $("#dispute-form").validate({
			errorClass: "error-found",
			errorElement: "span",
			rules: {
				'file[]': {
					extension: "png|jpeg|jpg"
				}
			},
			messages: {
				'file[]': "This extenstions allowed only (png|jpeg|jpg)",
			},
			errorPlacement: function(error, element) {
				error.appendTo(element.closest('.form-group'));
			}
		});
	});

	$("#dispute-form").ajaxForm({
		headers: {
			'X-CSRF-TOKEN': config.csrf
		},
		url: "/challenge/dispute/{{$challenge->id}}",
		success: function(responseText) {
				if (responseText === 'submitted') {
				$('#disputeModal').modal('hide');
				swal("Your dispute has been submitted successfully", {
					icon: "success",
				}).then(() => {
					location.href = '/events/challenges';
				});
			} else if (responseText === 'invalid_submit') {
				swal("Challenge is not eligible for dispute");
			} else if (responseText === 'invalid_submit_already') {
				swal("You have already submitted evidence for dispute");
			} else if (responseText === 'invalid_record') {				
				swal("Challenge is already in dispute");
			}
		}
	});

	$('#submit-dispute').click(function() {
		if ($("#dispute-form").valid()) {
			$("#dispute-form").submit();
		}
	});

	$('#disputeModal').on('hidden.bs.modal', function(e) {
		disputeValidator.resetForm();
		$('#dispute-form').trigger("reset");
	});
</script>
@endsection
<!-- Profile Modal -->

<div class="modal fade" style="display: none;" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<span class="modal-title h4" id="reportModalLabel">Report Challenge Results</span>
			</div>
			<div class="modal-body mainsectionbg">
				<div class="row col-md-offset-1">
					<div class="col-md-12 mt-10">
						<span class="h4">
							Challenge # {{$challenge->id}}
						</span>
					</div>
					<div class="col-md-12 mt-10">
						<span class="h4">
							{{$challenge->game->name.' '.($challenge->mode ? $challenge->mode->name : '').' - '.$challenge->console->name.' for '.$challenge->amount }} BTP
						</span>
					</div>
					<div class="col-md-12 mt-10">
						<span class="h4">
							Challenge date: {{$match_time}} GMT
						</span>
					</div>
					<div class="col-md-8  mt-10">
						<form id="result-form">
							<div class="form-group">
								<span class="h4">Match winner</span>
								<div>
									<label class="fs-15 mt-5 radio-label" for="won">
										<?php echo Form::radio('won', 1, null, ['id' => 'won', 'required' => true]); ?>
										I Won
									</label>
									<label class="fs-15 mt-5 radio-label" for="lost">
										<?php echo Form::radio('won', 0, null, ['id' => 'lost', 'required' => true]); ?>
										I Lost
									</label>
									<label class="fs-15 mt-5 radio-label" for="draw">
										<?php echo Form::radio('won', 2, null, ['id' => 'draw', 'required' => true]); ?>
										Draw
									</label>
									<div class="errorTxt"></div>
								</div>
							</div>
							</hr>
							<span class="h4"> Leave feedback for your opponent</span>
							<div class="form-group mt-10">
								<span class="h4">How was your experience?</span>
								<div>
									<label class="fs-15 mt-5 radio-label" for="good">
										<?php echo Form::radio('experience', 1, null, ['id' => 'good', 'required' => true]); ?>
										Good
									</label>
									<label class="fs-15 mt-5 radio-label" for="neutral">
										<?php echo Form::radio('experience', 2, null, ['id' => 'neutral', 'required' => true]); ?>
										Neutral
									</label>
									<label class="fs-15 mt-5 radio-label" for="bad">
										<?php echo Form::radio('experience', 3, null, ['id' => 'bad', 'required' => true]); ?>
										Bad
									</label>
									<div class="errorTxt"></div>
								</div>
							</div>
							<div class="form-group">
								<span class="h4">Skill Rating</span>
								<?php echo Form::select('skill_rating', \config('challenge.skill_rating'), null, ['class' => 'form-control  mt-10', 'required' => true]); ?>
								<div class="errorTxt"></div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="submit">Submit</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" style="display: none;" id="disputeModal" tabindex="-1" role="dialog" aria-labelledby="disputeModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<span class="modal-title h4" id="disputeModalLabel">Dispute</span>
			</div>
			<div class="modal-body mainsectionbg">
				<div class="row col-md-offset-1">
					<div class="col-md-12 mt-10">
						<span class="h4">
							Match # {{$challenge->id}}
						</span>
					</div>
					<div class="col-md-12 mt-10">
						<span class="h4">
							{{$challenge->game->name.' '.($challenge->mode ? $challenge->mode->name : '').' - '.$challenge->console->name.' for '.$challenge->amount }} BTP
						</span>
					</div>
					<div class="col-md-8  mt-10">
						<form id="dispute-form" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<span class="h4">Comments</span>
								<?php echo Form::textarea('comments', null, ['class' => 'form-control  mt-10', 'required' => true,'style'=>"height: 90px;"]); ?>
							</div>
							<div class="form-group">
								<span class="h4">Add Files (optional)</span>
								<input type="file" id="fileupload" name="file[]" multiple>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="submit-dispute">Submit</button>
			</div>
		</div>
	</div>
</div>