@extends('layouts.master')
<!-- head -->
@section('title')
    Account Security | BitSport™
@endsection
<!-- title -->
@section('head')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <style type="text/css" >
        .green-brown{
            color: #fff !important;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.67);
            background: #89C331;
        }
        .green-brown:hover {
            background: #C45E1D;
        }
        .yellow-brown{
            color: #fff !important;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.67);
            background: #dab10d;
        }
        .yellow-brown:hover {
            background: #C45E1D;
        }
    </style>

@endsection

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->

            <div class="row">
                <div class="col-lg-12 col-xs-12 col-sm-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject bold uppercase font-dark"><i class="fa fa-lock"></i> Google Authenticator </span>

                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="portlet">

                                @if(Sentinel::getUser()->google2fa_secret)
                                    <a href="{{ url('2fa/disable') }}" class="btn yellow-brown" style="width: 200px;">Disable 2FA</a>
                                @else
                                    <button id="otpToggleButton" class="btn green-brown" style="width: 200px;">Enable 2FA</button>
                                @endif
                            </div>
                            <div class="portlet">
                                <div>
                                    <h3><i class="fa fa-book"></i> Instructions for Google authenticator</h3>
                                    <div>
                                        <p>
                                            Google Authenticator is used to further enhance the security of your account. If you wish to enable it
                                            please click on "Enable" on the left side and follow the instructions depending on your device. </p>
                                        <p>
                                            If enabled then each time you login or make a withdrawal at Sportsbet.io you will be prompted to
                                            complete the 2-Step Verification which can only be finished by having access to your smartphone. </p>
                                        <div class="alert alert-warning" role="alert">
                                            <strong>NB! Please print out the QR code or write down the manual code for account recovery should you
                                                ever lose your phone or it becomes damaged!</strong>
                                        </div>
                                        <div class="panel-group" id="accordion">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" >
                                                            Android instructions
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseOne" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <h4>Requirements</h4>
                                                        <p>
                                                            To use Google Authenticator on your Android device, it must be running Android version 2.1 or
                                                            later.
                                                        </p>
                                                        <h4>Downloading the app</h4>
                                                        <ul>
                                                            <li>
                                                                1. Visit Google Play.
                                                            </li>
                                                            <li>
                                                                2. Search for Google Authenticator.
                                                            </li>
                                                            <li>
                                                                3. Download and install the application.
                                                            </li>
                                                        </ul>
                                                        <h4>Setting up the app</h4>
                                                        <ul>
                                                            <li>
                                                                <p>
                                                                    1. On your phone, open the Google Authenticator application.
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    2. If this is the first time you have used Authenticator, click the Add an account
                                                                    button. If you are adding a new account, choose 'Add an account' from the appís
                                                                    menu.
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    3. To link your phone to your account:
                                                                </p>
                                                                <p>
                                                                    <strong>Using QR code</strong>:
                                                                    Select Scan account barcode (label 1a). If the
                                                                    Authenticator app cannot locate a barcode scanner app on
                                                                    your phone, you might be prompted to download and install
                                                                    one. If you want to install a barcode scanner app so you
                                                                    can complete the setup process, press Install (label 2a)
                                                                    then go through the installation process. Once the app is
                                                                    installed, reopen Google Authenticator, point your camera
                                                                    at the QR code on your computer screen.
                                                                </p>
                                                                <p>
                                                                    <strong>Using secret key</strong>:
                                                                    Select Manually add account (label 1b), then enter
                                                                    the name you want to use for this account in the box
                                                                    next to Enter account name (label 2b). Next, enter the
                                                                    secret key on your computer screen into the box under
                                                                    Enter key (label 2c). Make sure you've chosen to make
                                                                    the key Time based (label 2d) and press "Save."
                                                                </p>
                                                                <div>
                                                                    <img src="//cdn.coingaming.io/sportsbet/images/instructions/android-1a1b.gif">
                                                                    <img src="//cdn.coingaming.io/sportsbet/images/instructions/android-2a.gif">
                                                                    <img src="//cdn.coingaming.io/sportsbet/images/instructions/android-2b2c2d.gif">
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    4. To test that the application is working, enter the verification code on your phone
                                                                    into the box on your computer and click Submit Code.
                                                                </p>
                                                                <div>
                                                                    <img src="//cdn.coingaming.io/sportsbet/images/instructions/android-3.gif">
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    5. If the code is correct then Google Authenticator will be enabled for all Logins and
                                                                    Withdrawals on Sportsbet.io!
                                                                </p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                            iPhone instructions
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <h4>Requirements</h4>
                                                        <p>
                                                            To use Google Authenticator on your iPhone, iPod Touch, or iPad, you must have iOS 5.0 or
                                                            later. In addition, in order to set up the app on your iPhone using a QR code, you must have
                                                            a 3G model or later.
                                                        </p>
                                                        <h4>Downloading the app</h4>
                                                        <ul>
                                                            <li>
                                                                1. Visit the App Store.
                                                            </li>
                                                            <li>
                                                                2. Search for Google Authenticator.
                                                            </li>
                                                            <li>
                                                                3. Download and install the application.
                                                            </li>
                                                        </ul>
                                                        <h4>Setting up the app</h4>
                                                        <ul>
                                                            <li>
                                                                <p>1. Open the app on your phone</p>
                                                            </li>
                                                            <li>
                                                                <p>2. Tap the plus icon</p>
                                                            </li>
                                                            <li>
                                                                <p>3. To link your phone to your account:</p>
                                                                <p>
                                                                    <strong>Using Barcode</strong>:
                                                                    Tap "Scan Barcode" and then point your camera at the
                                                                    QR code on your computer screen.
                                                                </p>
                                                                <p>
                                                                    <strong>Using Manual Entry</strong>:
                                                                    Tap "Manual Entry" and enter the email address of
                                                                    your Google Account. Then, enter the secret key on
                                                                    your computer screen into the box next to Key and
                                                                    tap "Done".
                                                                </p>
                                                                <img src="//cdn.coingaming.io/sportsbet/images/instructions/iphone-gauth.png">
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    4. To test that the application is working, enter the verification code on your phone
                                                                    into the box on your computer and click Submit Code.
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    5. If the code is correct then Google Authenticator will be enabled for all Logins and
                                                                    Withdrawals on Sportsbet.io!
                                                                </p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                            Blackberry instructions
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseThree" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <h4>Requirements</h4>
                                                        <p>
                                                            To use Google Authenticator on your BlackBerry device, you must have OS 4.5-7.0. In addition,
                                                            make sure your BlackBerry device is configured for US English -- you might not be able to
                                                            download Google Authenticator if your device is operating in another language.
                                                        </p>
                                                        <h4>Downloading the app</h4>
                                                        <p>
                                                            You'll need Internet access on your BlackBerry to download Google Authenticator.
                                                        </p>
                                                        <ul>
                                                            <li>
                                                                1. Open the web browser on your BlackBerry.
                                                            </li>
                                                            <li>
                                                                2. Visit m.google.com/authenticator.
                                                            </li>
                                                            <li>
                                                                3. Download and install the application.
                                                            </li>
                                                        </ul>
                                                        <h4>Setting up the app</h4>
                                                        <ul>
                                                            <li>
                                                                1. To link your phone to your account, open the Authenticator app menu and select Manual
                                                                key entry (label 1).
                                                            </li>
                                                            <li>
                                                                2. Enter the name of your Account below "Enter account name" (label 2).
                                                            </li>
                                                            <li>
                                                                3. Enter the secret key on your computer screen next to "Enter key" (label 3), select Time
                                                                based from the drop-down menu (label 4) and press Save (label 5).
                                                                <div>
                                                                    <img src="//cdn.coingaming.io/sportsbet/images/instructions/blackberry-label1.gif">
                                                                </div>
                                                            </li>
                                                            <li>
                                                                4. To test that the application is working, enter the verification code on your phone into
                                                                the box on your computer and click Submit Code.
                                                                <div>
                                                                    <img src="//cdn.coingaming.io/sportsbet/images/instructions/blackberry-label2-3-4-5.gif">
                                                                </div>
                                                            </li>
                                                            <li>
                                                                5. If the code is correct then Google Authenticator will be enabled for all Logins and
                                                                Withdrawals on Sportsbet.io!
                                                                <div>
                                                                    <img src="//cdn.coingaming.io/sportsbet/images/instructions/blackberry-label-6.gif">
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="portlet">--}}
                                {{--<h3><i class="fa fa-check"></i> Verify your account</h3>--}}
                                {{--<hr>--}}
                                {{--<p>--}}
                                    {{--We ask you to upload your documents for our review to provide better security. It makes it easier for us to identify you in cases where you have lost access to your account. It also helps us to make sure you receive your gifts and physical rewards at the correct location!--}}
                                {{--</p>--}}
                                {{--<p>--}}
                                    {{--For identification please make a picture either of your ID Card, Drivers License or Passport. For "Proof of address" please make a picture of your utility bill which is not older than three months.--}}
                                {{--</p>--}}
                                {{--<div>--}}
                                    {{--<div class="fileupload fileupload-new" data-provides="fileupload">--}}
                                        {{--<div class="input-group">--}}
                                            {{--<div class="form-control">--}}
                                                {{--<i class="fa fa-file fileupload-exists"></i> <span class="fileupload-preview"></span>--}}
                                            {{--</div>--}}
                                            {{--<div class="input-group-btn">--}}
                                                {{--<span class="btn btn-default btn-file">--}}
											{{--<span class="fileupload-new">Select file (Identification)</span>--}}
											{{--<span class="fileupload-exists">Change file (Identification)</span>--}}
											{{--<input type="file" class="idFile">--}}
										{{--</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div>--}}
                                    {{--<div class="fileupload fileupload-new" data-provides="fileupload">--}}
                                        {{--<div class="input-group">--}}
                                            {{--<div class="form-control">--}}
                                                {{--<i class="fa fa-file fileupload-exists"></i> <span class="fileupload-preview"></span>--}}
                                            {{--</div>--}}
                                            {{--<div class="input-group-btn">--}}
                                                {{--<span class="btn btn-default btn-file">--}}
											{{--<span class="fileupload-new">Select file (Proof of address)</span>--}}
											{{--<span class="fileupload-exists">Change file (Proof of address)</span>--}}
											{{--<input type="file" class="poaFile">--}}
										{{--</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}


                                {{--<button id="sendFiles" type="button" class="btn green-brown">Send files</button>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="qrModal" class="modal modal-styled fade in">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                <form id="gauth-form" inspfaactive="true" action="{{ url('2fa/save') }}" method="post">
                <div class="modal-body">
                        <input type="hidden" id="token" name="_token" value="{{csrf_token()}}">
                        <div>
                            <p class="text-center"><strong>Scan the QR code:</strong></p>
                            <div class="qrcode text-center" >

                            </div>
                            <p class="text-center"><strong>or enter this code manually:</strong></p>
                            <h1 class="text-center secret"></h1>
                            <input type="hidden" name="secret_key" id="secret">
                        </div>
                        <div>
                            <b class="text-danger">If enabled then each time you login or make a withdrawal at Sportsbet.io you will be prompted to complete the 2-Step Verification which can only be finished by having access to your smartphone.</b>
                        </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn button-close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn green-brown" >Yes Enable Google 2FA Authenticator</button>
                </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- END CONTENT -->

@endsection
<!-- content -->

@section('script')

@endsection

@section('script_bottom')
    <script type="application/javascript" >
        $('#otpToggleButton').on('click', function () {
            $.ajax({
                type: 'get',
                url:"{{url('2fa/enable')}}",
                success: function (responseData) {
                    $('.qrcode').empty();
                    $('.secret').empty();
                    $('.qrcode').append('<img src="'+responseData['imgurl']+'">');
                    $('.secret').text(responseData['secret']);
                    $('#secret').val(responseData['secret']);
                },
                error: function (responseData) {
                    console.log(responseData);
                    return false;
                }
            });
            $('#qrModal').modal('show');
        });

        $('#submitGauth').on('click', function () {
            var code = $('#otpCode').val();
            var token = $('#token').val();

            console.log(code);
            $.ajax({
                type: 'post',
                url:"{{url('2fa/validate')}}",
                data: "code="+code+'&_token='+token,
                success: function (responseData) {
                    console.log(responseData);
                },
                error: function (responseData) {
                    console.log(responseData);
                    return false;
                }
            });
            $('#qrModal').modal('show');
        })
    </script>
@endsection
<!-- script -->
