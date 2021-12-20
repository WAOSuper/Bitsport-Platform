  @extends('frontend.layouts.master')
@section('content')
<div class="center-content">
        <div class="row">
            <div class="col-12  col-md-4 col-lg-3 nopadding">
                <div class="site-sidebar">

                @include('frontend.layouts.sidebar')
                </div>
            </div>
            <div class="col-12  col-md-8 col-lg-9 nopadding">
                <div class="inner-page">
                    <div class="content">
                    <h1> 404 Page Not Found !!</h1>
                </div>
            </div>
        </div>
    </div>

@endsection