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
            <h5 class="headertexttop">MatchNow Information</h5>
            <hr>
            <div id="live-event-data">
                <div class="row">
                    <div class="col-md-12">
                        <p>Description will be here! </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input type="checkbox" id="read">​ I have read the above information carefully
                    </div>
                    <div>
                        <br />
                        <br />
                        <br />

                        <table class="table">
                            <thead>
                                <th>Host's basic details/information</th>
                            </thead>
                            <tr>
                                <td>Console Id</td>
                                <td>{{ $match->psn_id }}</td>
                            </tr>
                            <tr>
                                <td>Platform</td>
                                <td>{{ $match->platform }}</td>
                            </tr>
                            <tr>
                                <td>Staked Amount</td>
                                <td>{{ $match->stake_amount }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <a href="/match-opponent-confirm-get/{{ $match->id }}" class="btn btn-primary">Continue</a>
                    </div>
                </div>
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

@endsection