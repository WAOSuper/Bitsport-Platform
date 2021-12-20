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
            <h5 class="headertexttop">Start Check-In</h5>
            <hr />
            <br />
            <div style="float:left">
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
            <div style="float:right">
                <input type="button" style="min-width:270px;" id="remaining_timer" value="" class="btn btn-default" />
            </div>

            <div align="center">
                <form action="{{route('match-setup')}}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="match_id" value="{{ $match->id }}">
                    <input type="submit" style="min-width:270px;" value="Start Check-In" class="btn btn-success" />
                </form>
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
                console.log('distance expired', distance);
                clearInterval(x);
                document.getElementById("remaining_timer").value = "EXPIRED";
                // send ajex call to make give match as expired
                $.post("{{ route('match-expired') }}", {
                    "match_id": "{{ $match->id  }}",
                    "_token": "{{ csrf_token() }}"
                },
                function(data, status) {
                    if (data && data == 1) {
                        document.getElementById("remaining_timer").value = "Press continue to play";
                        window.location.href = "{{route('match.index')}}";                        
                    }
                });
            }
        }, 1000);

    });



    // function cancel_btn() {
    //     if (confirm("Are you sure you want to cancel this match")) {
    //         $.post("{{ url('match-opponent-cancel') }}", {
    //                 "match_id": "{{ $match->id  }}",
    //                 "_token": "{{ csrf_token() }}"
    //             },
    //             function(data, status) {
    //                 if (data && data == "1") {
    //                     alert('Match successfully cancelled');
    //                 } else {
    //                     alert("no");
    //                     // $("#exampleModalCenter").modal('show');
    //                 }
    //             });
    //     } else {
    //         alert('No call here');
    //     }
    // }
</script>
@endsection