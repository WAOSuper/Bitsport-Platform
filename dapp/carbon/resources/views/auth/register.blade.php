@extends('layouts.login-app')
<!-- head -->
@section('title')
    Bitsport | Register
@endsection
<!-- title -->
@section('head')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ URL::asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ URL::asset('assets/pages/css/login-4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
@endsection

@section('content')
    <!-- BEGIN CONTENT -->
    <!-- BEGIN LOGO -->
    <div class="logo">
         <a href="{{url('/')}}">
            <img src="{{url('')}}/assets/images/coins/bitplaywide.png" alt="" style="width: 210px;" /> </a>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN LOGIN -->
    <div class="content">
        <!-- BEGIN REGISTRATION FORM -->
        <form class="register-form" action="{{ url('register') }}" method="post">
            <input type="hidden" name="role" value="{{ $role }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="referral_code" value="<?php echo (isset($_GET['r'])) ? $_GET['r'] : '' ?>" >
            <input type="hidden" name="invite_code" value="<?php echo (isset($_GET['code'])) ? $_GET['code'] : '' ?> ">
            <input type="hidden" name="tournament_id" value="<?php echo (isset($_GET['tournament_id'])) ? $_GET['tournament_id'] : '' ?>">
            <h3>Sign Up</h3>
            <p> Enter your personal details below: </p>
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li> {{ $error }} </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
            @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Firts Name</label>
                <div class="input-icon">
                    <i class="fa fa-font"></i>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="First Name" name="firstname" /> </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Last Name</label>
                <div class="input-icon">
                    <i class="fa fa-font"></i>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="Last Name" name="lastname" /> </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Username</label>
                <div class="input-icon">
                    <i class="fa fa-font"></i>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="Username" name="username" /> </div>
            </div>

            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <div class="input-icon">
                    <i class="fa fa-envelope"></i>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email" /> </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <div class="input-icon">
                    <i class="fa fa-lock"></i>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password" /> </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
                <div class="controls">
                    <div class="input-icon">
                        <i class="fa fa-check"></i>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword" /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" name="tnc" /> I confirm and accept the
                    <a href="https://www.bitsport.io/content/terms_condition">Terms of Service </a> &
                    <a href="https://www.bitsport.io/content/privacy_policy">Privacy Policy </a>
                    <span></span>
                </label>
                <div id="register_tnc_error"> </div>
            </div>
            <div class="form-actions">
                <!-- <a href="{{ url('login') }}" class="btn red btn-outline"> Login </a> -->
                <button type="submit" id="register-submit-btn" class="btn green" style="margin-left:100px"> Sign Up </button>
            </div>
        </form>
        <!-- END REGISTRATION FORM -->
    </div>
    <!-- END LOGIN -->
    <!-- END CONTENT -->
    
@endsection
<!-- content -->

@section('script')
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/backstretch/jquery.backstretch.min.js') }}" type="text/javascript"></script>

@endsection

@section('script_bottom')
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('assets/pages/scripts/login-4.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@endsection
<!-- script -->
