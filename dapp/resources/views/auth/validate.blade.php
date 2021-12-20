@extends('layouts.login-app')
<!-- head -->
@section('title')
    Bitsport | Validation
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
        <form  role="form" method="post" action="{{ url('2fa/validate') }}">
            {!! csrf_field() !!}
            <h3>One-Time Password</h3>
            <p> Enter One-Time Password.  </p>
            @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
            @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
            <div class="form-group">
                <div class="input-icon">
                    <i class="fa fa-envelope"></i>
                    <input class="form-control placeholder-no-fix" type="number"  name="totp" />
                    @if ($errors->has('totp'))
                        <span class="help-block">
                                    <strong>{{ $errors->first('totp') }}</strong>
                                </span>
                    @endif
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn green pull-right"> Validate </button>
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
