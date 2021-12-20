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
					<div class="row ">
						<h4>{{$challenge->opponent->username}} responded to your {{ $challenge->game_mode === 'open' ? 'open' : ''}} challenge.</h4>
					</div>
					<div class="row mt-10">
						{{$challenge->game->name.' '.($challenge->mode ? $challenge->mode->name : '').' - '.$challenge->console->name.' for '.$challenge->amount.' BTP' }}
					</div>
					@if($challenge->rules_o)
					<div class="row mt-10">
						<label>Rules :</label>
						<span>{{$challenge->rules_o}}</span>
					</div>
					@endif
					<div class="row mt-10">
						<button type="button" class="btn btn-default" id="reject">Reject</button>
						&nbsp;
						<button type="button" class="btn btn-primary" id="approve">Approve</button>
					</div>
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
<script type="text/javascript">
	var config = {
		csrf: "{{csrf_token()}}"
	}
	var socketUrl = "{{\config('chat.socket.url')}}";
	var chat = new ChatController(<?= $user_id ?>, <?= $to_user_id ?>, "<?= $to_user_name ?>", socketUrl);
	$("#message").keydown(chat.sendMessage);
	$('#approve').click(function() {
		swal({
				title: "Are you sure?",
				text: "You are going to approve this request.",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((accepted) => {
				if (accepted) {
					$.ajax({
						url: '/challenge/accept/' + "{{$challenge->id}}",
						method: 'patch',
						data: {
							type: 'approve'
						},
						headers: {
							'X-CSRF-TOKEN': config.csrf
						}
					}).done((response) => {
						if (response === 'approved') {
							swal("Congrats! You have successfully approved!", {
								icon: "success",
							}).then(() => {
								location.href = '/challenge/play/' + "{{$challenge->id}}";
							});
						} else {
							swal("Opps! you've already approved the challenge please refresh your page!");
						}
					}).fail((response) => {
						swal("Opps! some error occured while accepting!");
					});
				}
			});
	});
	$('#reject').click(function() {
		swal({
				title: "Are you sure?",
				text: "You are going to reject this request.",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((accepted) => {
				if (accepted) {
					$.ajax({
						url: '/challenge/reject/' + "{{$challenge->id}}",
						method: 'patch',
						data: {
							type: 'approval'
						},
						headers: {
							'X-CSRF-TOKEN': config.csrf
						}
					}).done((response) => {
						if (response === 'rejected') {
							swal("Congrats! You have successfully rejected challenge!", {
								icon: "success",
							}).then(() => {
								location.href = '/events/challenges';
							});
						} else {
							swal("Opps! you've already rejected the challenge please refresh your page!");
						}
					}).fail((response) => {
						swal("Opps! some error occured while accepting!");
					});
				}
			});
	});
</script>
@endsection