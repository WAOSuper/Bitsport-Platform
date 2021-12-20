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
	.challenge-detail-header {
		display: flex;
		justify-content: space-between;
		align-items: center;
	}
</style>
<div class="content col-md-9">
	<!-- Posts Area 1 -->
	<!-- Latest News -->
	@include('frontend.layouts.messagess')
	<div class="card card--clean mb-0 mainsectionbg">
		<div class="challenge-detail-header">

			<h5 class="headertexttop">Challenge - {{$id}} </h5>
			@if ($challenge->creator->id == Sentinel::getUser()->id)
			<ul class="social-links social-links--circle">
				<li class="social-links__item">
				  	<a href="" class="social-links__link" ><i class="fa fa-whatsapp"></i></a>
				</li>
				<li class="social-links__item">
					<a href="https://t.me/bitsport_finance" class="social-links__link" target="_blank"><i class="fa fa-telegram"></i></a>
				</li>
				<li class="social-links__item">
					<a class="social-links__link copy-link"><i class="fa fa-link"></i></a>
				</li>
				<li class="social-links__item">
				  	<a class="social-links__link send-ch-email"><i class="fa fa-envelope"></i></a>
				</li>
			</ul>
			@endif
		</div>
		<hr>
		<div class="challenge-tabs-detail">
				<div class="modal-content">
					
					<div class="modal-body mainsectionbg">
						<div class="row">
							<div class="col-sm-6">
								<h3>Creator Info</h3>
								<div class="row">
									<div class="col-xs-3">
										@if($challenge->creator->profile)
										<img alt="" class="img-circle" src="{{url('/')}}/assets/images/profile/{{$challenge->creator->profile}}" /> </a>
										@else
										<img alt="" class="img-circle" src="{{url('/')}}/assets/images/profile/default.png" /> </a>
										@endif
									</div>
									<div class="col-xs-9">
										<div class="row">
											<div class="col-md-12">
												<span>Console ID: </span>
												<span>{{$challenge->creator->username}}</span>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<span>Wins: </span>
												<span>{{$challenge->creator->number_of_winnings()}}</span>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<span>Losses: </span>
												<span>{{$challenge->creator->number_of_losses()}}</span>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<span>Amount Limit: </span>
												<span>{{$challenge->creator->game_amount_limit.' '.config('app.currency')}}</span>
											</div>
										</div>
											
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<h3>Challenge Info</h3>
								<div class="row">
									<div class="col-md-12">
										Game: {{$challenge->game->name}}
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										Amount: {{$challenge->amount.' '.config('app.currency') }}
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										Device: {{$challenge->console->name}}
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										Rules: {{$challenge->rules_c}}
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										Mode: {{$challenge->mode}}
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										Created at: {{ date("d-m-Y", strtotime($challenge->created_at))}}
									</div>
								</div>
							</div>
						</div>
						@if($challenge->creator->id !== Sentinel::getUser()->id)
						<div class="row mt-10">
							<div class="col-md-12 blocks">
								<a class="btn btn-default create pull-right ml-10" href="{{route('challenge.create')}}">Create Similar</a>
								<a data-id="{{$challenge->id}}" class="btn btn-default pull-right" data-action="accept" data-rules="{{$challenge->rules_c}}">Accept</a>
							</div>
						</div>
						
						@endif
					</div>
				</div>
			</div>
	</div>

	{{-- Start Buy Btp --}}
	@if ($challenge->creator->id !== Sentinel::getUser()->id)
	<br>
	<div class="card card--clean mb-0 mainsectionbg" id="challenge-buy-btp" style="display: none">
		<div class="challenge-detail-header">

			<h5 class="headertexttop">Buy BTP</h5> 
		</div>
		<hr>
		<div class="challenge-tabs-detail">
				<div class="modal-content">
					<div class="modal-body mainsectionbg">
						<div class="row">
							<div class="col-lg-12 col-xs-12 col-sm-12">
								<div class="portlet light bordered">
									<div class="portlet-title">
										
									</div>
									<div class="portlet-body">
										
										@if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
										@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
										<form  action="{{ url('challenges/buy-btp') }}" method="post" >
											<input type="hidden" name="_token" value="{{csrf_token()}}">
											
											
											<div id="alert-msg"></div>                                  
											<div class="form-group">
												<div class="row">
													<div class="col-md-8">
															<label>Amount (USD)</label>
															<input class="form-control placeholder-no-fix" type="number" required autocomplete="off" id="amount-usd" name="amount_usd" placeholder="0.00" value="" step="any" onkeypress="return isNotNumberKeyCh(event);" onkeyup="checkBalance(this.value)"> 
															<span class="text-danger">{{ $errors->first('amount_usd') }}</span>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
													<div class="col-md-8">
															<label>BTP</label>
															<input class="form-control placeholder-no-fix" type="number" required autocomplete="off" id="amount-btp" name="amount_btp" placeholder="0.00" value="" step="any" readonly=""> 
															<span class="text-danger">{{ $errors->first('amount_btp') }}</span>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="row">
														<div class="col-sm-4">
															<label class="" name="radio5">
																<input type="radio" class="buy_form" name="from_type" value="0" checked> <b class="ml-10"> <img src="{{url('/')}}/assets/images/coins/paypal.png" width="40" class="coinimg" alt="paypal">   PayPal</b>
																<span></span>
															</label>
														</div>
														{{-- <div class="col-md-8"> --}}
															<div class="col-sm-2">
																<label class="" name="coin_name">
																	<input type="radio" class="buy_form" name="from_type" value="1"><b class="ml-10"><img class="coinimg" src="{{ asset('assets/images/coins/btpcoin.png')}}">  BTP</b>
																	<span></span> 
																</label>
															</div>
															<div class="col-sm-6" id="deposit_address_part" style="display: none;">
																<label class="" name="coin_name">Deposit Address
																	<input type="text" class="form-control placeholder-no-fix" id="deposit_address" name="address" value="" readonly style="width: 330px">
																	<span>
																		<ul style="padding: 14px">
																			<li>Remember: CHECK the FIRST 4 characters and the LAST 4 characters of the Bitcoin address when you PASTE it elsewhere</li>
														 					<li>Important: This deposit address is for BitPlay Token (BTP) only. We will not refund an incorrect Deposit.</li>
																			<li>On average, the deposit takes about 5 minutes.</li>
																		</ul>
																	</span>									
																</label>
															</div>

														{{-- </div> --}}
												</div>
											</div>
										</div>
										<button class="btn btn-success" id="Withdraw-btn"><i class="fa fa-btc"></i>&nbsp;Deposit</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" id="setting_rate" value="<?php echo ($marketprice);  ?>">
	{{-- Finish Buy BTP --}}
	@endif
	<div class="posts posts--cards post-grid post-grid--2cols post-grid--fitRows row">
	</div>
</div>

@endsection

@section('script_bottom')

@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		$('.challenge-tabs-detail').on('click', '[data-action]', actionClick);
		$('.copy-link').on('click', copyUrlClipboard);
		function copyUrlClipboard() 
		{
			var dummy = document.createElement('input');
			text = window.location.href;

			document.body.appendChild(dummy);
			dummy.value = text;
			dummy.select();
			document.execCommand('copy');
			document.body.removeChild(dummy);
		}
		$('.send-ch-email').on('click', function(){
			$('#sendEmailAddress').modal('show');
			$('#EmailAddress').val('');
		})
		$('#accept-send-email').on('click', function(){
			$.ajax({
				url: '/challenges/sendEmail',
				method: 'POST',
				data: {
					email: $('#EmailAddress').val(),
					game: '{{$challenge->game->name}}',
					amount: '{{$challenge->amount." ".config("app.currency") }}',
					id: '{{$id}}'
				},
				headers: {
					'X-CSRF-TOKEN': "{{csrf_token()}}"
				}
			}).done((response) => {
				$('#sendEmailAddress').modal('hide');
				if(response.result == 'success')
				swal("Email is sent successfully!", {
					icon: "success",
				});
			})
		})
		function actionClick() {
			var data = $(this).data();
			if(data.action == "accept"){
				$('#acceptModalDetail').modal('show');
				$('#acceptModalDetail').data('id', data.id).data('rules', data.rules);
				$('#rules-c').html('');
				$('.rules-container').hide();
				if (data.rules) {
					$('.rules-container').show();
					$('#rules-c').html(data.rules);
				}
				$('#rules').val('');
			}
		}
		$('#accept-confirm-detail').click(function() {
			$.ajax({
				url: '/challenge/accept/' + $('#acceptModalDetail').data('id'),
				method: 'patch',
				data: {
					rules: $('#rules').val(),
					type: 'accept'
				},
				headers: {
					'X-CSRF-TOKEN': "{{csrf_token()}}"
				}
			}).done((response) => {
				if (response === 'approval_pending') {
					swal("Congrats! You have accepted the challenge, creator will approve the challenge than you can start the challenge!", {
						icon: "success",
					});
					window.location.href = "{{url('events/challenges')}}";
				} else if (response === 'accepted') {
					swal("Congrats! You have successfully accepted challenge!", {
						icon: "success",
					});
					window.location.href = "{{url('events/challenges')}}";
				} else if (response === 'low_balance') {
					swal({
						title: "Accept Failed!",
						text: "You don't have enough balance to accept this challenge. \nIf you want to buy BTP, then click 'OK'",
						icon: "warning",
						buttons: true,
						dangerMode: true,
					})
					.then((accepted) => {
						if (accepted) {
							$("#challenge-buy-btp").show();
						}
					});
				} else {
					console.log("asdf",response);
					swal("Opps! you've already accepted the challenge please refresh your page!");
				}
				$('#acceptModalDetail').modal('hide');
			}).fail((response) => {
				swal("Opps! some error occured while accepting!");
			});
		});
	});
	function isNotNumberKeyCh(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
			return false;
		return true;
	}
	var rate = $("#setting_rate").val();
	function checkBalance(id)
	{
		if(id) {
			var balance = (id / rate).toFixed(2);
			$("#amount-btp").val(balance);
		} else {
			$("#amount-usd").val("");
			$("#amount-btp").val('');
		}
	}
	$('.buy_form').on("click",function(){
		var radioValue = $(this).val();
		if(radioValue == 1){
			$("#deposit_address_part").show();
			$("#Withdraw-btn").hide();
			if($('#deposit_address').val() == '') {
				$.ajax({
					url: '/challenges/getDepositAddress',
					method: 'GET',
					headers: {
						'X-CSRF-TOKEN': "{{csrf_token()}}"
					}
				}).done((response) => {
					if(response.result == 'success') 
					$('#deposit_address').val(response.address);
				})
			}
		} else {
			$("#deposit_address_part").hide();
			$("#Withdraw-btn").show();
    	}
	});
</script>
@endsection
<div class="modal fade" style="display: none;" id="acceptModalDetail" tabindex="-1" role="dialog" aria-labelledby="acceptModalLabel">
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
				<button type="button" class="btn btn-primary" id="accept-confirm-detail">Accept</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" style="display: none;" id="sendEmailAddress" tabindex="-1" role="dialog" aria-labelledby="acceptModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="acceptModalLabel">Send Email</h4>
			</div>
			<div class="modal-body mainsectionbg">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group col-md-12">
							<label for="rules" class="control-label">Please insert your friend's email:</label>
							<input type="email" id="EmailAddress" class="form-control" placeholder="Email..." />
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="accept-send-email">Accept</button>
			</div>
		</div>
	</div>
</div>
