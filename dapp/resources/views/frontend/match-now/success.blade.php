@extends('frontend.layouts.master')
@section('title') BitSport &trade; | Peer to Peer competitive eSports platform @endsection
@section('head')
<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<style type="text/css">
    .badge-danger {
        color: white;
        background-color: Red;
    }

    img .live {
        width: 14%;
        height: auto;
    }
</style>

<div class="content col-md-9">
    <!-- Posts Area 1 -->
    <!-- Latest News -->
    @include('frontend.layouts.messagess')    

    <div class="card card--clean mb-0 mainsectionbg">

        <div id="data" class="mobilelivebetting">
            <h5 class="headertexttop">Match confirmed</h5>
            <hr>
            <div id="live-event-data">
                <h3>You have been sucessfully matched with Opponent</h3>
                <p>You will be redirected to check-in page shortly</p>
            </div>
        </div>
        <!-- secon main row end here -->
    </div>

    <div class="posts posts--cards post-grid post-grid--2cols post-grid--fitRows row">
    </div>
</div>
@endsection

@section('script_bottom')
<script type="text/javascript" charset="utf-8">

</script>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(() => {
            window.location.href = "{{ url('match-start-check-in/'.$url_hash) }}";
        }, 5000);
    });
</script>
@endsection