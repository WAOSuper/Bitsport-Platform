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

            <h5 class="headertexttop">Wait for your opponent.</h5>
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
                    <input type="submit" style="min-width:270px;" id="whatch-video" value="Watch video" class="btn btn-danger" /><br><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <iframe id="tutorial" src="https://www.youtube.com/watch?v=NIWHV5B6qrE?ecver=1" allow="autoplay" frameborder="0" allowfullscreen ></iframe>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Waiting for opponent to setup stream...</h3>
                    <form action="{{route('match-twitch-screen')}}" id="continue-form-twitch" method="POST" hidden>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="match_id" value="{{ $match->id }}">
                    </form> 
                    <form action="{{route('match-setup-stream-tutorial-guest')}}" id="continue-form" method="POST" hidden>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="match_id" value="{{ $match->id }}">
                    </form>    
                </div>

            </div>
        </div>
    </div>
        <!-- second main row end here -->
        
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

$("#whatch-video").on('click', function(ev) {
    $("#tutorial")[0].src += "&autoplay=1";
    ev.preventDefault();    
});

var timer = setInterval(() => {
    $.post("{{ route('match-streamSetUpDone') }}", {
        "match_id": "{{ $match->id  }}",
        "_token": "{{ csrf_token() }}"
    },
    function(data, status) {
        console.log(data);
        if(data && data == 1 ){
            $("#continue-form-twitch").submit();
            clearInterval(timer);
        }else{
            if (data && data == 2) {
                $("#continue-form").submit();
                clearInterval(timer);
            }
        }
    });
}, 3000);

</script>
@endsection