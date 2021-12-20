@extends('frontend.layouts.master')
@section('title') BitSport &trade; | Challenges @endsection
@section('head')
<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<style type="text/css">
	.ml-10 {
		margin-left: 10px;
	}
</style>
<div class="content col-md-9">
	<!-- Posts Area 1 -->
	<!-- Latest News -->
	@include('frontend.layouts.messagess')
	<div class="card card--clean mb-0 mainsectionbg">
		<h5 class="headertexttop">Profile</h5> 
		<hr>
		<div class="challenge-tabs">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header" style="background: powderblue;">
						<!--button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button-->
						<h4 class="modal-title" id="profileModalLabel">{{$user->first_name}} {{$user->last_name}} <a href="<?php url();?>/sponseredit" style="float: right;" class="btn btn-primary">Edit Profile</a></h4>
						
					</div>
					<div class="modal-body mainsectionbg">
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-3">
									@if($user->profile)
									<img alt="" class="img-circle" src="{{url('/')}}/assets/images/profile/{{$user->profile}}" /> </a>
									@else
									<img alt="" class="img-circle" src="{{url('/')}}/assets/images/profile/default.png" /> </a>
									@endif
								</div>
								<div class="col-md-9">
									<div class="row">
										<div class="col-md-9 profile-tabs">
											<div class="item">
												<span>Overall Rating: </span>
												<span>{{$user->getOverAllRating()}}</span>
											</div>
											<div class="item">
												<span>Wins: </span>
												<span>{{$user->number_of_winnings()}}</span>
											</div>
											<div class="item">
												<span>Losses: </span>
												<span>{{$user->number_of_losses()}}</span>
											</div>
											<div class="item">
												<span>Amount Limit: </span>
												<span>{{$user->game_amount_limit.' '.config('app.currency')}}</span>
											</div>
										</div>
										<style>
										.modal-title {
    margin: 0;
    line-height: 1.2em;
    color: #3c3b5b;
    text-shadow: 1px 1px 2px white;
    text-transform: capitalize;
    font-style: normal !important;
}
										</style>
										<div class="col-md-3">
										<a href="{{ route('challenge.createwithopponent', $user->id)}}" class="btn btn-danger">Sponser Now</a>
											<!--@if($user->id !== Sentinel::getUser()->id)
											<a href="{{ route('challenge.createwithopponent', $user->id)}}" class="btn btn-default">Sponser Now</a>
											@endif -->
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											Preferred Game: {{$user->preferred_game ? $user->preferred_game->name : ''}}
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											Preferred Console: {{$user->preferred_console ? $user->preferred_console->name : ''}}
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											Console ID: {{$user->psn_username}}
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											Member Since: {{ date("d-m-Y", strtotime($user->created_at))}} | Last Login: {{date("d-m-Y",strtotime($user->last_login))}}
										</div>
									</div>
								</div>
							</div>
						</div>
						@if($user->id !== Sentinel::getUser()->id)
						<div class="row mt-10">
							<div class="col-md-12 blocks">
								<a href="{{ route('chat.single', $user->id)}}" class="btn btn-default">Send Message</a>
								<a data-id="{{$user->id}}" class="btn btn-default follow">{{$user->following ? 'Unfollow' : 'Follow'}}</a>
								<a data-id="{{$user->id}}" class="btn btn-default block">{{$user->blocked ? 'Unblock' : 'Block'}}</a>
							</div>
						</div>
						@endif
						<div class="row mt-10">
							<div class="col-md-12">
								<div class="tab-pane" id="my-challenges" role="tabpanel" aria-labelledby="my-challenges-tab">
									<ul class="nav nav-tabs" id="myTab" role="tablist">
										<li class="nav-item active">
											<a class="nav-link active" id="open-challenges-tab" data-toggle="tab" href="#open-challenges" role="tab" aria-controls="open-challenges-tab" aria-selected="true">Open Challenges</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="games-played-tab" data-toggle="tab" href="#games-played" role="tab" aria-controls="games-played-tab" aria-selected="false">Games Played</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="recent-feedback-tab" data-toggle="tab" href="#recent-feedback" role="tab" aria-controls="recent-feedback-tab" aria-selected="false">Recent Feedback</a>
										</li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane fade active in" id="open-challenges" role="tabpanel" aria-labelledby="open-challenges-tab">
											<div class="table-responsive">
												<table class="table table-bordered">
													<thead>
														<tr>
															<th>Title</th>
															<th>Console</th>
															<th>Amount</th>
															@if($user->id !== Sentinel::getUser()->id)
															<th>Action</th>
															@endif
														</tr>
													</thead>
													<tbody>
														@foreach ($open_challenges as $challenge)
														<tr>
															<td>{{ $challenge->game->name }}</td>
															<td>{{ $challenge->console->name }}</td>
															<td>{{ $challenge->amount.' '.config('app.currency') }}</td>
															@if($user->id !== Sentinel::getUser()->id)
															<td>
																<a class="btn btn-danger btn-xs accept" data-rules="{{ $challenge->rules_c }}" data-id="{{ $challenge->id }}">Accept</a>
															</td>
															@endif
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
										<div class="tab-pane fade" id="games-played" role="tabpanel" aria-labelledby="games-played-tab">
											<div class="table-responsive">
												<table class="table table-bordered">
													<thead>
														<tr>
															<th>Title</th>
															<th>Wins</th>
															<th>Losses</th>
															<th>Rating</th>
														</tr>
													</thead>
													<tbody>
														@foreach ($played_games as $game)
														<tr>
															<td>{{ $game->game_name.' '.$game->console_name }}</td>
															<td>{{ $game->wins }}</td>
															<td>{{ $game->losses }}</td>
															<td>{{ $game->skill_rating }}</td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
										<div class="tab-pane fade" id="recent-feedback" role="tabpanel" aria-labelledby="recent-feedback-tab">
											<div class="table-responsive">
												<table class="table table-bordered">
													<thead>
														<tr>
															<th>Name</th>
															<th>Amount</th>
															<th>Opponent</th>
															<th>Winner</th>
															<th>Rating</th>
														</tr>
													</thead>
													<tbody>
														@foreach ($feedbacks as $feedback)
														<tr>
															<td>{{ $feedback->challenge->game->name.' '.$feedback->challenge->console->name }}</td>
															<td>{{ $feedback->challenge->amount.' '.config('app.currency') }}</td>
															<td>
																@if(!$feedback->isOpponent)
																<a href="#" data-id="{{$feedback->challenge->opponent->id}}" class="view-profile">
																	{{ $feedback->challenge->opponent->username }}</td>
															</a>
															@else
															<a href="#" data-id="{{$feedback->challenge->creator->id}}" class="view-profile">
																{{ $feedback->challenge->creator->username }}</td>
															</a>
															@endif
															<td>{{ $feedback->challenge->winner ? $feedback->challenge->winner->username : 'Draw' }}</td>
															<td>{{ $feedback->skill_rating }}</td>
														</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="posts posts--cards post-grid post-grid--2cols post-grid--fitRows row">
	</div>
</div>

@endsection

@section('script_bottom')
<script src="{{ URL::asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		var config = {
			challengeUrl: "{{ route('challenge.latest') }}",
			onlineUrl: "{{ route('chat.online') }}",
			gameMode: ['#open-challenges', '#my-challenges', '#online-users', '#past-challenges', '#sent-challenges', '#received-challenges'],
			csrf: "{{csrf_token()}}",
			status: JSON.parse("{{ json_encode($status) }}".replace(/&quot;/g, '"')),
			user_id: "{{Sentinel::check() ? Sentinel::check()->id : ''}}"
		};

		getChallenges('open');
		$('.nav-item a').click(tabClick);
		$('.challenge-tabs').on('click', '[data-action]', actionClick);

		$('#accept-confirm').click(function() {
			$.ajax({
				url: '/challenge/accept/' + $('#acceptModal').data('id'),
				method: 'patch',
				data: {
					rules: $('#rules').val(),
					type: 'accept'
				},
				headers: {
					'X-CSRF-TOKEN': config.csrf
				}
			}).done((response) => {
				if (response === 'approval_pending') {
					swal("Congrats! You have accepted the challenge, creator will approve the challenge than you can start the challenge!", {
						icon: "success",
					});
					getChallenges('open');
					getChallenges('received-challenges');
				} else if (response === 'accepted') {
					swal("Congrats! You have successfully accepted challenge!", {
						icon: "success",
					});
					getChallenges('received-challenges');
				} else if (response === 'low_balance') {
					swal("Opps! Can't accept challenge you don't have enough balance");
				} else {
					swal("Opps! you've already accepted the challenge please refresh your page!");
				}
				$('#acceptModal').modal('hide');
			}).fail((response) => {
				swal("Opps! some error occured while accepting!");
			});
		});

		function actionClick() {
			var data = $(this).data();
			switch (data.action) {
				case 'confirm':
					location.href = '/challenge/confirm/' + data.id;
					break;
				case 'play':
					location.href = '/challenge/play/' + data.id;
					break;
				case 'dispute':
					location.href = '/challenge/play/' + data.id;
					break;
				case 'accept':
					$('#acceptModal').modal('show');
					$('#acceptModal').data('id', data.id).data('rules', data.rules);
					$('#rules-c').html('');
					$('.rules-container').hide();
					if (data.rules) {
						$('.rules-container').show();
						$('#rules-c').html(data.rules);
					}
					$('#rules').val('');
					break;
				case 'cancel':
					swal({
							title: "Are you sure?",
							text: "You are going to cancel this challenge",
							icon: "warning",
							buttons: true,
							dangerMode: true,
						})
						.then((accepted) => {
							if (accepted) {
								$.ajax({
									url: '/challenge/cancel/' + data.id,
									method: 'patch',
									headers: {
										'X-CSRF-TOKEN': config.csrf
									}
								}).done((response) => {
									if (response === 'cancelled') {
										swal("Congrats! You have successfully cancelled challenge!", {
											icon: "success",
										});
										getChallenges('received-challenges');
										getChallenges('sent-challenges');
									} else {
										swal("Opps! you've already cancelled the challenge please refresh your page!");
									}
								}).fail((response) => {
									swal("Opps! some error occured while accepting!");
								});
							}
						});
					break;
				case 'reject':
					swal({
							title: "Are you sure?",
							text: "You are going to reject this challenge",
							icon: "warning",
							buttons: true,
							dangerMode: true,
						})
						.then((accepted) => {
							if (accepted) {
								$.ajax({
									url: '/challenge/reject/' + data.id,
									method: 'patch',
									headers: {
										'X-CSRF-TOKEN': config.csrf
									}
								}).done((response) => {
									if (response === 'rejected') {
										swal("Congrats! You have successfully rejected challenge!", {
											icon: "success",
										});
										getChallenges('received-challenges');
									} else {
										swal("Opps! you've already rejected the challenge please refresh your page!");
									}
								}).fail((response) => {
									swal("Opps! some error occured while accepting!");
								});
							}
						});
					break;
				case 'delete':
					swal({
							title: "Are you sure?",
							text: "You are going to delete this challenge",
							icon: "warning",
							buttons: true,
							dangerMode: true,
						})
						.then((accepted) => {
							if (accepted) {
								$.ajax({
									url: '/challenge/destroy/' + data.id,
									method: 'delete',
									headers: {
										'X-CSRF-TOKEN': config.csrf
									}
								}).done((response) => {
									if (response === 'deleted') {
										swal("Congrats! You have successfully deleted challenge!", {
											icon: "success",
										});
										getChallenges('sent-challenges');
									} else {
										swal("Opps! you've already deleted the challenge please refresh your page!");
									}
								}).fail((response) => {
									swal("Opps! some error occured while accepting!");
								});
							}
						});
					break;
				default:
					break;
			}
		}

		function tabClick() {
			var activeTab = $(this).attr('href');
			var index = config.gameMode.indexOf(activeTab);
			switch (index) {
				case 0:
					getChallenges('open');
					break;
				case 1:
					getChallenges('received-challenges');
					break;
				case 2:
					getOnlineUsers();
					break;
				case 3:
					getChallenges('past-challenges');
					break;
				case 4:
					getChallenges('sent-challenges');
					break;
				case 5:
					getChallenges('received-challenges');
					break;
				default:
					break;
			}
		}

		function getActionUrl(game_mode, data, submission) {
			var html = '',
				id = data.id,
				status = data.status,
				rules = data.rules_c;
			switch (game_mode) {
				case 'open':
					html = '<a class="btn btn-danger btn-xs" data-action="accept" data-rules="' + rules + '" data-id="' + id + '">Accept</a>'+
							'<a class="btn btn-success btn-xs ml-10" href="<?php echo url('challenges/');?>/'+ id +'">Detail</a>';
					break;
				case 'received-challenges':
					html = '<li class="dropdown">' +
						'<a class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown"> Action <b class="caret"></b></a>' +
						'<ul class="dropdown-menu">';
					if (status === 0) {
						html += '<li><a class="dropdown-item" data-action="accept" data-rules="' + rules + '" data-id="' + id + '">Accept</a></li>';
						html += '<li><a class="dropdown-item" data-action="reject" data-id="' + id + '">Reject</a></li>';
					}
					if (status === 1) {
						if (submission == 'submitted') {
							html += '<li><a class="dropdown-item" data-action="dispute" data-id="' + id + '">Dispute</a></li>';
						} else if (submission == 'submission_pending') {
							html += '<li><a class="dropdown-item" data-action="play" data-id="' + id + '">View</a></li>';
						} else {
							html += '<li><a class="dropdown-item" data-action="play" data-id="' + id + '">Play</a></li>';
						}
					}
					if (status === 6) {
						html += '<li><a class="dropdown-item" data-action="play" data-id="' + id + '">View</a></li>';
					}
					html += '</ul></li>';
					if (status === 4) {
						html = '';
					}
					break;
				case 'sent-challenges':
					html = '<li class="dropdown">' +
						'<a class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown"> Action <b class="caret"></b></a>' +
						'<ul class="dropdown-menu">';
					if (status === 1) {
						if (submission == 'submitted') {
							html += '<li><a class="dropdown-item" data-action="dispute" data-id="' + id + '">Dispute</a></li>';
						} else if (submission == 'submission_pending' || submission == 'result_submitted') {
							html += '<li><a class="dropdown-item" data-action="play" data-id="' + id + '">View</a></li>';
						} else {
							html += '<li><a class="dropdown-item" data-action="play" data-id="' + id + '">Play</a></li>';
						}
					}
					if (status === 4) {
						html += '<li><a class="dropdown-item" data-action="confirm" data-id="' + id + '">Approve</a></li>';
					}
					if (status === 0) {
						html += '<li><a class="dropdown-item" data-action="cancel" data-id="' + id + '">Cancel</a></li>';
					}
					if (status === 0 || status === 2 || status === 3) {
						html += '<li><a class="dropdown-item" data-action="delete" data-id="' + id + '">Delete</a></li>';
					}
					if (status === 6) {
						html += '<li><a class="dropdown-item" data-action="play" data-id="' + id + '">View</a></li>';
					}
					html += '</ul></li>';
					break;
				case 'past-challenges':
					html += '<a class="btn btn-danger btn-xs" data-action="play" data-id="' + id + '">View</a>';
					break;
				default:
					break;
			}
			return html;
		}

		var interval;
		function getChallenges(game_mode) {
			var element, nav;
			if (game_mode == 'open') {
				element = $('#open-challenges tbody');
				nav = $('#open-challenges .pagination');
			} else if (game_mode == 'received-challenges') {
				element = $('#received-challenges tbody');
				nav = $('#received-challenges .pagination');
			} else if (game_mode == 'sent-challenges') {
				element = $('#sent-challenges tbody');
				nav = $('#sent-challenges .pagination');
			} else if (game_mode == 'past-challenges') {
				element = $('#past-challenges tbody');
				nav = $('#past-challenges .pagination');
			}
			$(nav).pagination({
				current: 1,
				length: 10,
				size: 2,
				ajax: function(options, refresh, $target) {
					reloadTable(element, nav, options, refresh, game_mode);
					if(interval){
						clearInterval(interval);                        
					}
					interval = setInterval(function() {
						if(options.current == 1){
							reloadTable(element, nav, options, refresh, game_mode);
						}
					}, 10000);
				}
			});
		}

		function reloadTable(element, nav, options, refresh, game_mode) {
			$.ajax({
				url: config.challengeUrl + '?game_mode=' + game_mode,
				data: {
					current: options.current,
					length: options.length
				},
				dataType: 'json'
			}).done(function(res) {
				if (res.data && res.data.length) {
					element.html("");
					$.each(res.data, function(k, data) {
						var tr = $('<tr/>');
						if (game_mode == 'sent-challenges') {
							if (data.opponent) {
								tr.append($('<td/>').text(data.opponent.username));
							} else {
								tr.append($('<td/>').text('NA'));
							}
						} else {
							tr.append($('<td/>').text(data.creator.username));
						}
						tr.append($('<td/>').text(data.amount + ' ' + "{{config('app.currency')}}"));
						tr.append($('<td/>').text(data.game.name));
						if (game_mode == 'sent-challenges') {
							tr.append($('<td/>').html(data.game_mode));
							var submission = checkSubmissionStatus(data);
							if (!submission) {
								tr.append($('<td/>').html(config.status[data.status]));
							} else {
								tr.append($('<td/>').html(submission));
							}
							tr.append($('<td/>').html(getActionUrl(game_mode, data, submission)));
						} else if (game_mode == 'received-challenges') {
							tr.append($('<td/>').html(data.game_mode));
							var submission = checkSubmissionStatus(data);
							if (!submission) {
								tr.append($('<td/>').html(config.status[data.status]));
							} else {
								tr.append($('<td/>').html(submission));
							}
							tr.append($('<td/>').html(getActionUrl(game_mode, data, submission)));
						} else if (game_mode == 'past-challenges') {
							tr.append($('<td/>').html(config.status[data.status]));
							tr.append($('<td/>').html(getWinner(data)));
							tr.append($('<td/>').html(getActionUrl(game_mode, data)));
						} else {
							tr.append($('<td/>').html(getActionUrl(game_mode, data)));
						}
						element.append(tr);
					});
				} else {
					element.html("");
					if (game_mode == 'open') {
						element.append("<tr><td colspan='4' style='text-align:center;'>No results found.</td></tr>");
					} else {
						element.append("<tr><td colspan='" + $("#" + game_mode + ' th').length + "' style='text-align:center;'>No results found.</td></tr>");
					}
				}
				refresh({
					total: res.total
				});
			});
		}

		function getWinner(data) {
			var text = '-';
			if (data.status == 5) {
				if (data.winner_id == config.user_id) {
					text = 'You';
				}
				if (data.winner_id == config.opponent_id) {
					text = 'Opponent';
				}
				if (data.winner_id == 0) {
					text = 'Draw';
				}
			}
			return text;
		}

		function checkSubmissionStatus(data) {
			var result = '';
			if (data.status == 6) {
				return result;
			}
			if (data.challenge_results.length) {
				var found = data.challenge_results.find(function(result) {
					return result.user_id == config.user_id;
				});
				if (found) {
					result = "result_submitted";
				} else {
					result = "submission_pending";
				}
				if (data.challenge_results.length == 2) {
					result = 'submitted';
				}
			}
			return result;
		}

		function getOnlineUsers() {
			$('#online-users .pagination').pagination({
				current: 1,
				length: 10,
				size: 2,
				ajax: function(options, refresh, $target) {
					$.ajax({
						url: config.onlineUrl,
						data: {
							current: options.current,
							length: options.length
						},
						dataType: 'json'
					}).done(function(res) {
						var element = $('#online-users tbody');
						if (res.data && res.data.length) {
							element.html("");
							$.each(res.data, function(k, data) {
								var tr = $('<tr/>');
								tr.append($('<td/>').text(data.username));
								tr.append($('<td/>').text(data.trust_score));
								tr.append($('<td/>').html('<a class="btn btn-danger btn-xs" href="/challenge/create/' + data.id + '">Challenge</a>'));
								element.append(tr);
							});
						} else {
							element.html("");
							element.append("<tr><td colspan='3' style='text-align:center;'>No results found.</td></tr>");
						}
						refresh({
							total: res.total
						});
					});
				}
			});
		}
	});
</script>
@endsection
<div class="modal fade" style="display: none;" id="acceptModal" tabindex="-1" role="dialog" aria-labelledby="acceptModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="acceptModalLabel">Accept Challenge</h4>
			</div>
			<div class="modal-body mainsectionbg">
				<div class="row">
					<div class="col-md-12 rules-container">
						<div class="col-md-4">Rules Proposed by Creator :</div>
						<div class="col-md-8" id="rules-c"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12"> 
						<div class="form-group col-md-12">
							<label for="rules" class="control-label">Proposed rules and settings (optional):</label>
							<textarea id="rules" class="form-control" placeholder="Write rules here..."></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="accept-confirm">Accept</button>
			</div>
		</div>
	</div>
</div>