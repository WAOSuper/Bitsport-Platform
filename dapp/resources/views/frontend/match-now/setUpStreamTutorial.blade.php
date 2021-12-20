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
            <h5 class="headertexttop">Setup Steam</h5>
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
                    <input type="submit" style="min-width:270px;" id="stream-setup" value="Stream setup" class="btn btn-danger" /><br><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <iframe id="tutorial" src="https://www.youtube.com/watch?v=NIWHV5B6qrE" frameborder="0" allowfullscreen ></iframe>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <form action="{{route('match-twitch-screen')}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="match_id" id="matchId" value="{{ $match->id }}">
                        <div id="setup-completed" hidden> 
                            <input type="checkbox" id="setup-completed-ckeck" value="1" name="setup-completed-ckeck"> I have Completed Streaming Setup
                        </div>
                        <div id="continue" hidden> 
                            <button type="submit"  class="btn btn-danger"  >Continue</button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        <!-- second main row end here -->
        
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Stream Setup</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-primary">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label visible-ie8 visible-ie9">Twitch Username</label>
                            <input class="form-control placeholder-no-fix" type="text" placeholder="Twitch Username" name="username" value="{{ $match->username }}" required="" id="username"/>
                            <div class="text-danger" id="input-error"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="submitUsername" data-dismiss="modal">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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

$("#stream-setup").on('click', function(ev) {
    $("#exampleModalCenter").modal('show');
    // $("#setup-completed").show();
    // $("#tutorial")[0].src += "&autoplay=1";
    ev.preventDefault();    
});

$("#submitUsername").on('click', function(ev) {
    $("#input-error").html("");
    $(this).attr('disabled', true);
    var username = $("#username").val();
    var matchId = $("#matchId").val();
    if(!username && !$.trim(username)) {
        $("#input-error").html("Please enter Twitch Username!");
        $(this).attr('disabled', false);
        return false;
    }
    $.ajax({
        type:'post',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        url:"/update-twitch-username",
        data: {'username':username, 'matchId': matchId},
        success: function (responseData) {
            if(responseData == "1") {
                // to hide modal
                $("#exampleModalCenter").modal('hide');
                $("#setup-completed").show();
                $("#tutorial")[0].src += "&autoplay=1";
                // $(this).attr('disabled', false); 
            } else {
                $(this).attr('disabled', false);
                $("#input-error").html("Please enter valid Username or try again!");
            }
        }
    });
});

$('#setup-completed-ckeck').change(function() {
    if(this.checked) {
        $("#continue").show();
    } else {
        $("#continue").hide();
    }
});
</script>
@endsection