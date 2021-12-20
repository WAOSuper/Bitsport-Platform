@extends('frontend.layouts.master')
@section('title') BitSport &trade; | Peer to Peer competitive eSports platform @endsection
@section('head')
  <meta name="csrf_token"  content="{{ csrf_token() }}" />
  @endsection
@section('content')
<style type="text/css">
    .badge-danger
    {
      color: white;
      background-color: Red;
    }
    img .live{
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
                  <h5 class="headertexttop">Match Reporting</h5>
              <hr>
              <div id="live-event-data">
                  <div class="row">
                        <div class="col-md-12">
                            <p>
                                Make sure you are reporting the correct and actual score, reporting incorrect score will reduce your trust score and risk your account been banned.
                            </p>
                        </div>
                  </div>
                <form class="create-match-form" id="report-form" action="{{route('match-check-reporting')}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="match_id" value="{{ $match->id }}">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">Total Number Of Golas you scored</label>
                                <input class="form-control placeholder-no-fix" type="number" name="score_of_my" required=""/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">Total Number Of Golas your opponent scored</label>
                                <input class="form-control placeholder-no-fix" type="number" name="score_of_my_opp" required=""/>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="form-actions">
                    <button id="submit" class="btn btn-primary"> Submit </button>
                </div>
              </div>
              

            </div>
              <!-- secon main row end here -->
             
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
            Are you sure you have entered an accurate score line?
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
<script type="text/javascript" charset="utf-8" >
  
</script>
@endsection
@section('script')
<script type="text/javascript">
    $("#submit").on('click', function() {
        $("#confirm").modal('show');
    });

    $("#yes").click(function(){        
        $("#report-form").submit();
    });
</script>
@endsection