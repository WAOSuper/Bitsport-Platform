@extends('layouts.login-app')
<!-- head -->
@section('title')
    Betting
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
        <a href="index.html">
            <img src="{{url('')}}/assets/images/coins/bitplaywide.png" alt="" style="width: 210px;" /> </a>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN LOGIN -->
    <div class="content">
        <!-- BEGIN FORGOT PASSWORD FORM -->
        <form  action="{{ url('change-password') }}/{{$user->email}}" method="post">
            {{ csrf_field() }}
            <h3>Reset Password ?</h3>
            @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
            @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
            <p> Enter your Newpassword. </p>
            <!--@if ($errors->any())-->
            <!--    <div class="alert alert-danger">-->
            <!--        <ul>-->
            <!--            @foreach ($errors->all() as $error)-->
            <!--                <li>{{ $error }}</li>-->
            <!--            @endforeach-->
            <!--        </ul>-->
            <!--    </div>-->
            <!--@endif-->

            <div class="form-group">
                <div class="input-icon">
                    <i class="fa fa-envelope"></i>
                    <input class="form-control placeholder-no-fix" type="password" placeholder="Password" name="password" /> </div>
            </div>
            <div class="form-group">
                <div class="input-icon">
                    <i class="fa fa-envelope"></i>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Confirn Password" name="password_confirmation" /> </div>
            </div>
            <input type="hidden" name="email" value="{{ $user->email  }}">
            
            <div class="form-actions">
                <!-- <a href="{{ url('login') }}" class="btn red btn-outline"> Login </a> -->
                <button type="submit" class="btn green " style="margin-left:100px"> Submit </button>
            </div>
        </form>
        <!-- END FORGOT PASSWORD FORM -->
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
