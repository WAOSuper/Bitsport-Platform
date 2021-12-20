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
            <h5 class="headertexttop">Twitch Screen</h5>
            <hr />
            <br />
            <div class="row">
                @if ($match->status === config('match.match_status.cancelled'))
                    <span>Cancelled</span>                    
                @endif
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <iframe width="100%" height="315" src="https://player.twitch.tv/?channel={{substr($match->twitch_url, strpos($match->twitch_url, 'tv/') + 3)}}" frameborder="0" allowfullscreen> </iframe>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <form action="{{route('match-reporting')}}" id="continue-form" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="match_id" value="{{ $match->id }}">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <input type="checkbox" id="finished-playing" name="finished-playing"> Tick hear if its full time and I have finished playing
                            </div>
                        </div>
                    </form> 
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div id="continue-show" hidden> 
                                <button type="button" id="continue" class="btn btn-danger">Continue</button> 
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
        <!-- second main row end here -->
    </div>
</div>

<!-- Modal 2 -->
<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="confirmTitle"
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
                Are you sure match has been completed and it’s game full time?
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-6 text-left ml-1">
                        <button id="yes" class="btn btn-danger">Yes</button> 
                    </div>
                    <div class="col-md-6 text-right mr-1">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
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
   
    $("#continue").on('click', function() {
        $("#confirm").modal('show');
    });

    $("#yes").click(function(){        
        $("#continue-form").submit();
    });

    $('#finished-playing').change(function() {
    if(this.checked) {
        $("#continue-show").show();
    } else {
        $("#continue-show").hide();
    }
});
</script>
@endsection