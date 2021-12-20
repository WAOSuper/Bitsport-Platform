<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>You have been Matched!</title>
</head>
<body>



<!-- Section-1 -->
<table class="table_full editable-bg-color bg_color_e6e6e6 editable-bg-image" bgcolor="#e6e6e6" width="100%" align="center"  mc:repeatable="castellab" mc:variant="Header" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td>
			<!-- container -->
			<table class="table1 editable-bg-color bg_color_303f9f" bgcolor="#303f9f" width="600" align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
				<!-- padding-top -->
				<tr><td height="25"></td></tr>
				<tr>
					<td>
						<!-- Inner container -->
						<table class="table1" width="520" align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
							<tr>
								<td>
									<!-- logo -->
									<table width="50%" align="left" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="left">
												<a href="https://bitsport.io" class="editable-img">
													<img editable="true" mc:edit="image001" src="https://i.imgur.com/oJiY3i3.png" width="40" style="display:block; line-height:0; font-size:0; border:0;" border="0" alt="logo" />
												</a>
											</td>
										</tr>
										<tr><td height="22"></td></tr>
									</table><!-- END logo -->

									<!-- options -->
									<table width="50%" align="right" border="0" cellspacing="0" cellpadding="0">
										<!-- margin-top -->
										<tr><td height="3"></td></tr>
										
									</table><!-- END options -->

								</td>
							</tr>

							<!-- horizontal gap -->
							<tr><td height="60"></td></tr>

							<tr>
								<td align="center">
									<div class="editable-img">
										<img editable="true" mc:edit="image003" src="https://i.imgur.com/FseNomi.png"  style="display:block; line-height:0; font-size:0; border:0;" border="0" alt="" />
									</div>
								</td>
							</tr>

							<!-- horizontal gap -->
							<tr><td height="40"></td></tr>

							<tr>
								<td mc:edit="text001" align="center" class="text_color_ffffff" style="color: #ffffff; font-size: 30px; font-weight: 700; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;">
									<div class="editable-text">
										<span class="text_container">
											<multiline>
												You have been Matched!
											</multiline>
										</span>
									</div>
								</td>
							</tr>

							<!-- horizontal gap -->
							<tr><td height="30"></td></tr>

							<tr>
								<td mc:edit="text002" align="center" class="text_color_ffffff" style="color: #ffffff; font-size: 12px; font-weight: 300; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;">
									<div class="editable-text">
										<span class="text_container">
											
										</span>
									</div>
								</td>
							</tr>
						</table><!-- END inner container -->
					</td>
				</tr>
				<!-- padding-bottom -->
				<tr><td height="104"></td></tr>
			</table><!-- END container -->
		</td>
	</tr>

	<tr>
		<td>
			<!-- container -->
			<table class="table1 editable-bg-color bg_color_ffffff" bgcolor="#ffffff" width="600" align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
				<!-- padding-top -->
				<tr><td height="60"></td></tr>

				<tr>
					<td>
						<!-- container_400 -->
						<table class="container_400" align="center" width="400" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
							<tr>
								<td mc:edit="text003" align="left" class="text_color_282828" style="color: #282828; font-size: 13px; line-height: 2; font-weight: 500; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;">
									<div class="editable-text" style="line-height: 2;">
										<span class="text_container">
											<multiline>
												Hello {{ $user->first_name }} {{ $user->last_name }},
	Thank you for participating in the {{ $tournament->name }}, further sections of this email contains your match details, general guidelines and rules. <br><br>
<p><strong>We require you to join BitSport Discord Channel for information and help prior to your Play time. <a href="https://discord.gg/BFfQHmp">Click here to join Discord channel</a></strong></p>
										

									


												<h3>Matchmaking Details</h3>
<p>Match Type: Win and Earn</p>

<p>Opponent PSN ID/GamerTag: <strong>{{ $user2->username }}</strong></p>

<p>Platform: <strong>{{ $participant->platform }}</strong></p>

<p>Match Date: <strong>{{ explode(' ', $event->start_date)[0] }}</strong></p>

<p>Match Start Time: <strong>{{ explode(' ', $event->start_date)[1] }} GMT</strong></p>

<p>Event ID: <strong>{{ $event->id}}</strong></p>

<p>Host: <strong>{{ $participant->host_event == 1 ? 'Yes' : 'No' }}</strong></p>

<p><h4>(Hosting a game means you volunteered to stream the game to Twitch from your console, you will earn 3 BTP points after the game is ended and been streamed successfully. Also you are obligated to send Invite to your opponent and makae sure the below "Match Settings" are accurate. )</h4></p>

<h3>Game / Match Settings Rule</h3>

<p>* You are required to search and add your opponent as a friend on your console using the above “Opponent PSN / gamertag”</p>

<p>* Launch FIFA, go to the online tab, select “Friendly Seasons” and select your opponent from the list of friend list and send an invite.</p>

<h4>Match Settings</h4>
Half Lenght: 6 Mins<br>
Controls: Any<br>
Game Speed: Normal<br>
Squad Type: Custom

<p>* Ensure you are already streaming the game to Twitch before the kickoff, if you volunteered to be an host. (You can still volunteer to be a host even if you didn't select the option while registering, notify us on discord, if you'd love to).</p>

<p>In the event of any question, feel free to reach us on the check-in Discord channel.</p>

<p><b>Score Reporting:</b></p>

<p>If you did win the match, you are required to validate your scores by taking a screenshot of the score line and upload on the <a href="https://discord.gg/mW7cRfv">Score Validation Discord channel</a>.</p>


<h3>Check-In Guidelines</h3>
<p><b>IMPORTANT:</b></p>

<p>Login to your account from <a href="https://bitsport.io">here</a></p>

<p>You are required to Check-in 30 mins before your match start time (Failure to do so will result in automatic disqualification meaning you did not participate).</p>

<p>Check-in Instructions (Use one of the below check-in methods below.)</p>


<p><b>Manual Check-in:</b></p>
<p>Join BitSport Check-in channel on Discord, Enter the below check-in phrase in the "checkin-in" channel as exactly seen below<br>Check-in Phrase: <b>Check-in / {{ $user->username }} / {{ $event->id}} </b></p>


<p><b>Website Checkin:</b></p>
<p>To use website check-in, ensure you are alredy logged-in to your account, then click the Check-in button below.</p>





											

																							</multiline>
										</span>
									</div>
								</td>
							</tr>
							<!-- horizontal gap -->
							<tr><td height="50"></td></tr>

							<tr>
								<td align="center">
									<!-- button -->
									<table class="button_bg_color_303f9f bg_color_303f9f" bgcolor="#303f9f" width="225" height="50" align="center" border="0" cellpadding="0" cellspacing="0" style="background-color:#303f9f; border-radius:3px;">
										<tr>
											<td mc:edit="text004" align="center" valign="middle" style="color: #ffffff; font-size: 16px; font-weight: 600; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;" class="text_color_ffffff">
												<div class="editable-text">
													<span class="text_container">
														<multiline>
															<a href="https://www.bitsport.io/event-odds/{{$event->id}}" style="text-decoration: none; color: #ffffff;">Check-In</a>
														</multiline>
													</span>
												</div>
											</td>
										</tr>
									</table><!-- END button -->
								</td>
							</tr>

							<tr>
								<td mc:edit="text003" align="center" class="text_color_282828" style="color: #282828; font-size: 13px; line-height: 2; font-weight: 500; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;">
									<div class="editable-text" style="line-height: 2;">
										<span class="text_container">
											<multiline>
												<br><br>
												Good Luck and Happy Gaming.
												<br>
												<br><br>
												
																							</multiline>
										</span>
									</div>
								</td>
							</tr>

							<!-- horizontal gap -->
							<tr><td height="25"></td></tr>

							
						</table><!-- END container_400 -->
					</td>
				</tr>

				<!-- padding-bottom -->
				<tr><td height="60"></td></tr>
			</table><!-- END container -->
		</td>
	</tr>

	<tr>
		<td>
			<!-- container -->
			<table class="table1" width="600" align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
				<!-- padding-top -->
				<tr><td height="40"></td></tr>

				<tr>
					<td>
						<!--  column-1 -->
						<table class="table1-2" width="350" align="left" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td mc:edit="text006" align="left" class="center_content text_color_929292" style="color: #929292; font-size: 14px; line-height: 2; font-weight: 400; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;">
									<div class="editable-text" style="line-height: 2;">
										<span class="text_container">
											<multiline>
												You are receving this email because you signed up to our website :<a href="https://bitsport.io" style="color: #303f9f;text-decoration: none;"> BitSPort.io</a>
											</multiline>
										</span>
									</div>
								</td>
							</tr>

							<!-- horizontal gap -->
							<tr><td height="20"></td></tr>

							<tr>
								<td mc:edit="text007" align="left" class="center_content" style="font-size: 14px;font-weight: 400; font-family: lato, Helvetica, sans-serif; mso-line-height-rule: exactly;">
									
								</td>
							</tr>

							<!-- horizontal gap -->
							<tr><td height="10"></td></tr>

							

							<!-- margin-bottom -->
							<tr><td height="30"></td></tr>
						</table><!-- END column-1 -->

						<!-- vertical gap -->
						<table class="tablet_hide" width="130" align="left" border="0" cellspacing="0" cellpadding="0">
							<tr><td height="1"></td></tr>
						</table>

						<!-- column-2  -->
						<table class="table1-2" width="120" align="right" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td>
									<table width="120" align="center" style="margin: 0 auto;">
										<tr>
											<!-- facebook -->
											<!--<td align="center" width="30">
												<a href="#" style="border-style: none !important; display: inline-block;; border: 0 !important;" class="editable-img">
													<img editable="true" mc:edit="image004" src="images/icon-fb.png" width="30" style="display:block; line-height:0; font-size:0; border:0;" border="0" alt="" />
												</a>
											</td>-->

											<!-- vertical gap -->
											<td width="15"></td>

											<!-- twitter -->
										<!--	<td align="center" width="30">
												<a href="#" style="border-style: none !important; display: inline-block; border: 0 !important;" class="editable-img">
													<img editable="true" mc:edit="image005" src="images/icon-twitter.png" width="30" style="display:block; line-height:0; font-size:0; border:0;" border="0" alt="" />
												</a>
											</td>-->

											<!-- vertical gap -->
											<td width="15"></td>

											<!-- google+ -->
											<!--<td align="center" width="30">
												<a href="#" style="border-style: none !important; display: inline-block;; border: 0 !important;" class="editable-img">
													<img editable="true" mc:edit="image006" src="images/icon-gp.png" width="30" style="display:block; line-height:0; font-size:0; border:0;" border="0" alt="" />
												</a>
											</td>
										</tr>
									</table>
								</td>
							</tr>-->
							<!-- margin-bottom -->
							<tr><td height="30"></td></tr>
						</table><!-- END column-2 -->
					</td>
				</tr>

				<!-- padding-bottom -->
				<tr><td height="70"></td></tr>
			</table><!-- END container -->
		</td>
	</tr>
</table><!-- END wrapper -->



</body>
</html>
