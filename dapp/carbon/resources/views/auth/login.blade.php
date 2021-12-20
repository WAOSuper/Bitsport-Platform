@extends('layouts.login-app')
<!-- head -->
@section('title')
    Bitsport | Login
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
            <img src="{{url('')}}/assets/images/coins/bitplaywide.png" alt="" style="width: 210px;" /> 
        </a>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN LOGIN -->
    <div class="content">
        <!-- BEGIN LOGIN FORM -->
        <form  class="login-form" action="{{ url('login-post') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h3 class="form-title">Login to your account</h3>
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span> Enter any username and password. </span>
            </div>
             @if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li> {{ $error }} </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('error'))<div class="alert alert-danger"><!-- <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> --><strong>Error : </strong>{{ session('error') }}</div>@endif
            @if(session('success'))<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success : </strong>{{ session('success') }}</div>@endif
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <div class="input-icon">
                    <i class="fa fa-user"></i>
                    <input class="form-control placeholder-no-fix" type="email" placeholder="Email" name="email" /> </div>
                </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <div class="input-icon">
                    <i class="fa fa-lock"></i>
                    <input class="form-control placeholder-no-fix" type="password" placeholder="Password" name="password" /> </div>
                    <input type="hidden" name="timezone_offset" id="timezone_offset" value="0" />
            </div>
            <div class="form-actions">
                <label class="rememberme mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" name="remember_me" value="1" /> Remember me
                    <span></span>
                </label>
            <input type="hidden" name="redirect" value="{{$redirect}}" />
                <button type="submit" class="btn green pull-right"> Login </button>
            </div>
            <div class="forget-password">
                <h4>Forgot your password ?</h4>
                <p> no worries, click
                    <a href="{{ url('forgot-password') }}" id="forget-password"> here </a> to reset your password. </p>
            </div>
            <div class="create-account">
                <p> Don't have an account yet ?&nbsp;
                    <a href="{{ url('register') }}" id="register-btn"> Create an account </a>
                </p>
            </div>
            <input type="hidden" name="old" id="old" value="">
        </form>
        <!-- END LOGIN FORM -->
    </div>
    <!-- END LOGIN -->
    <!-- END CONTENT -->

@endsection
<!-- content -->

@section('script')
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/script.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/backstretch/jquery.backstretch.min.js') }}" type="text/javascript"></script>

@endsection

@section('script_bottom')
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('assets/pages/scripts/login-4.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script type="text/javascript">
        var olddstore_bet = JSON.parse(localStorage.getItem("betting"));
        var store_bet=[];
        $.each(olddstore_bet, function (i) {
            store_bet.push({bet_id:olddstore_bet[i].bet_id,odd_select:olddstore_bet[i].odd_select,odd_id:olddstore_bet[i].odd_id,more_id:olddstore_bet[i].more_id});
        });
        $("#old").val(JSON.stringify(store_bet));

        $(document).ready(function(){
            var tzo=(new Date().getTimezoneOffset()/60)*(-1);
            $('#timezone_offset').val(tzo);
        });
    </script>
@endsection
<!-- script -->
