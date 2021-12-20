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
            <h5 class="headertexttop">Stake BTP Coins <img src="https://i.imgur.com/1jpXmJ8.png" alt="BTP Coins"></h5>
            <hr>
            <div id="live-event-data">
                <form class="create-match-form" onsubmit="return validateForm()" action="{{ route('match.confirm') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Enter BTP Amount</label>
                        <input type="number" id="staking" class="form-control placeholder-no-fix" name="staking"
                            placeholder="Stake Amount" max="100">
                    </div>

                    <div class="form-actions">
                        <button type="button" id="submit" class="btn btn-primary"> Confirm </button>
                    </div>

                </form>
            </div>


        </div>
        <!-- secon main row end here -->

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                You do not have enough BTP balance to complete the stake​, ​click <a
                    href="https://bitsport.io/buy-btp">here</a> to fund your BTP balance.
            </div>
            <div class="modal-footer">
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
function validateForm() {
  $("#submit").trigger('click');
  return false;
}
$("#submit").on('click', function() {
    $("#staking").parent().removeClass("has-error");
    var staking = $("#staking").val();
    if(staking == "") {
      $("#staking").parent().addClass("has-error");
      return false;
    }
    if (staking) {
        $.post("{{route('match.confirm')}}", {
                "staking": staking,
                "_token": "{{ csrf_token() }}",
                "match_id": "{{$match_id}}"
            },
            function(data, status) {
                if (data && data == "1") {
                    window.location.href = "{{route('match.confirmation-success')}}";
                } else {
                    $("#exampleModalCenter").modal('show');
                }
            });
    } else {
        $("#exampleModalCenter").modal('show');
    }
});
</script>
@endsection