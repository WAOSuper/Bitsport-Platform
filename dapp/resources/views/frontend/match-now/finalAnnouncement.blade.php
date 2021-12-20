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
            <h5 class="headertexttop">Announce Result</h5>
            <div class="row">
                <div class="col-md-12 text-center">
                    Announce Result
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <div id="waiting">
                        <h3>Waiting......</h3>
                    </div>
                    <div id="pending" hidden>
                        <h3>Match Decision is Pending</h3>
                    </div>
                    <div id="draw" hidden>
                        <h3>Match Decision is Draw</h3>
                    </div>
                    <div id="result" hidden>
                        <h3>User-<strong><span id="winner-user" style = "text-transform:uppercase;"></span></strong> HAS WON THE MATCH</h3>
                    </div>
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
    getRestuls();
    var myInterval = setInterval(getRestuls,5000);

    function getRestuls() {
        $.post("{{route('match-announce-result')}}", {
            "match_id": "{{ $match->id  }}",
            "_token": "{{ csrf_token() }}"
        },
        function(data, status) {
            console.log(data);
            if (data && data == 0) {
                $('#waiting').hide();
                $('#result').hide();
                $('#winner-user').hide();
                $('#pending').show();
                clearInterval(myInterval);
            }

            if (data && data == 2) {
                $('#waiting').hide();
                $('#result').hide();
                $('#winner-user').hide();
                $('#draw').show();
                clearInterval(myInterval);
            }

            if (data && data != 0 && data != 1 && data != 2 ) {
                // UPDATE THE CONTENT WITH THE NEW INFORMATION
                $('#waiting').hide();
                $('#result').show();
                $('#winner-user').text(data['winner_name']);
                // ONCE THE NEW DATA HAS BEEN OBTAINED, END setInterval
                clearInterval(myInterval);
            }
        });
    }
}); 
</script>
@endsection