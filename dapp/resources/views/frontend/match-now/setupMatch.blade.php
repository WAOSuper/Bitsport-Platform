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
            <h5 class="headertexttop">Setup Match</h5>
            <hr />
            <br />
            <div class="row">
                <div class="col-md-6 text-left">
                    @if ($match->status === config('match.match_status.cancelled'))
                        <span>Cancelled</span>                    
                    @else
                    <form action="{{route('match-opponent-cancel')}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="match_id" value="{{ $match->id }}">
                        <input type="submit" style="min-width:270px;" value="Cancel Match" class="btn btn-danger" />
                    </form>
                    @endif
                </div>
                <div class="col-md-6 text-right">
                    <input type="button" style="min-width:270px;" id="remaining_timer" value="" class="btn btn-default" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>description</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <iframe src="https://www.youtube.com/watch?v=NIWHV5B6qrE" allow="autoplay" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-12 text-center">
                    <h3>Your Opponent is {{ucfirst($match->opponent->username)}}</h3> 
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div>
                        Before you Stream, Let's Check your internet speed
                    </div>
                    <br>
                    <button class="btn btn-default" id="checkInternetSpeed" value="Check internet speed">Check internet speed</button>
                    <div id="progress"></div>
                </div>
            </div>
        </div>
    </div>
        <!-- second main row end here -->
        
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="testpass" tabindex="-1" role="dialog" aria-labelledby="testpassTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Warning</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-primary">
                Your Internet speed is upto the task, let’s get your stream setup.
            </div>
            <div class="modal-footer">
                <form action="{{route('match-setup-stream-tutorial')}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="match_id" value="{{ $match->id }}">
                    <input type="hidden" name="strema_setup_by" value="host">
                    <button type="submit"  class="btn btn-danger">Continue</button> 
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal 2 -->
<div class="modal fade" id="testfail" tabindex="-1" role="dialog" aria-labelledby="testfailTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Warning</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-primary">
                Seems you are on a slow network and streaming might affect
                your gameplay, do you want to continue? Note if you continue and your stream
                disconnects or results in a game-lag, you might loose automatically to your opponent
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-6 text-left ml-1">
                        <form action="{{route('match-setup-stream-tutorial')}}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="match_id" value="{{ $match->id }}">
                            <input type="hidden" name="strema_setup_by" value="host">
                            <button type="submit"  class="btn btn-danger">Continue</button> 
                        </form>                   
                    </div>
                    <div class="col-md-6 text-right mr-1">
                        <form action="{{route('match-setup-stream-tutorial')}}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="match_id" value="{{ $match->id }}">
                            <input type="hidden" name="strema_setup_by" value="guest">
                            <button type="submit"  class="btn btn-danger">Pass Streaming request to Opponent</button> 
                        </form> 
                    </div>
                </div>
            </div>
        </div>
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

// Set the date we're counting down to
var countDownDate = new Date("{{$match->end_checking_time}}").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get today's date and time
    var DateNow = new Date();
    var now = (new Date(DateNow.getTime() + DateNow.getTimezoneOffset() * 60000)).getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="demo"
    document.getElementById("remaining_timer").value = hours + " Hr " +
        minutes + " Min " + seconds + " Sec";

    // If the count down is finished, write some text
    if (distance < 0) {
        console.log('distance', distance);
        clearInterval(x);
        document.getElementById("remaining_timer").value = "EXPIRED";
                // send ajex call to make give match as expired
                $.post("{{ route('match-expired') }}", {
                    "match_id": "{{ $match->id  }}",
                    "_token": "{{ csrf_token() }}"
                },
                function(data, status) {
                    if (data && data == 1) {
                        window.location.href = "{{route('match.index')}}";                        
                    }
                });
    }
}, 1000);

});

//calculate internet speed
var imageAddr = "{{asset('/assets1/images/football/frontbanner.png')}}"; 
var downloadSize = 1179964; //bytes

function ShowProgressMessage(msg) {
    var oProgress = document.getElementById("progress");
    if (oProgress) {
        oProgress.innerHTML = msg;
    }
}

function InitiateSpeedDetection() {
    ShowProgressMessage("Checking your internet speed, please wait...");
    window.setTimeout(MeasureConnectionSpeed, 1);
};    

function MeasureConnectionSpeed() {
    var startTime, endTime;
    var download = new Image();
    download.onload = function () {
        endTime = (new Date()).getTime();
        showResults();
    }
    
    download.onerror = function (err, msg) {
        ShowProgressMessage("Invalid image, or error downloading");
    }
    
    startTime = (new Date()).getTime();
    var cacheBuster = "?nnn=" + startTime;
    download.src = imageAddr + cacheBuster;
    
    function showResults() {
        var duration = (endTime - startTime) / 1000;
        var bitsLoaded = downloadSize * 8;
        var speedBps = (bitsLoaded / duration).toFixed(2);
        var speedKbps = (speedBps / 1024).toFixed(2);
        var speedMbps = (speedKbps / 1024).toFixed(2);
        console.log('speed', duration, downloadSize, bitsLoaded, speedBps, speedKbps, speedMbps);
        if (speedMbps && speedMbps >= 6) {
            $("#testpass").modal('show');
        } else {
            $("#testfail").modal('show');
        }
        var oProgress = document.getElementById("progress");
        if (oProgress) {
            oProgress.innerHTML = '';
        }
    }
}

$("#checkInternetSpeed").on('click', function() {
    InitiateSpeedDetection();
});

</script>
@endsection