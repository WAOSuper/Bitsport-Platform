@extends('frontend.layouts.master')
@section('title') BitSport &trade; | Peer to Peer competitive eSports platform @endsection
@section('head')
<meta name="csrf_token" content="{{ csrf_token() }}" />
<link href="{{ URL::asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
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

    table.dataTable tbody tr {
        background-color: #323150;
    }

    table.dataTable.no-footer,
    table.dataTable thead th,
    table.dataTable thead td {
        border-bottom: 1px solid #3c3b5b;
    }

    .dataTables_info {
        display: none;
    }
</style>

<div class="content col-md-9">
    <!-- Posts Area 1 -->
    <!-- Latest News -->
    @include('frontend.layouts.messagess')   
    <div class="card card--clean mb-0 mainsectionbg">
        <div id="data" class="mobilelivebetting">
            <h5 class="headertexttop">Matches</h5>
            <hr>
            <div id="live-event-data" class="table-responsive">
                <table class="table table-bordered mt-10" id="table">
                    <thead>
                        <tr>
                        <th>Username</th>
                        <th>Stake Amount</th>
                        <th>Expires In</th>
                        <th>Platform</th>
                        <th>Checkin Duration</th>
                        <th>Trust Score</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                     <tbody id="table-body">
                    </tbody>
                </table>
                <ul class="pagination"></ul>
            </div>

            <!-- secon main row end here -->
        </div>
    </div>
@endsection

@section('script_bottom')
<script src="{{ URL::asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
@endsection
@section('script')
<script type="text/javascript">

function getMatches(){
    $.get("{{ route('match.get_latest_matches') }}",
            function(data, status) {
                // data = data["data"];
                console.log(data);
                if (data) {
                var table_content = "";
                for (var i=0; i<data.length; i++) {
                    table_content += '<tr id="Display'+data[i]["id"]+'">'+
                                '<td>'+data[i]["username"]+'</td>'+
                                '<td>'+data[i]["stake_amount"]+' BTP</td>'+
                                '<td>'+data[i]["end_time"]+'</td>'+
                                '<td>'+data[i]["platform"]+'</td>'+
                                '<td>'+data[i]["ckeck_in_duration"]+' Mins</td>'+
                                '<td>'+data[i]["owner"]["trust_score"]+'%</td>'+
                                '<td>'+
                                    '<a class="btn btn-danger btn-xs" href="match-now/'+data[i]["id"]+'">Match Now</a>'+
                                '</td>'+
                            '</tr>';
                }
                $('#table-body').html("");
                $('#table-body').append(table_content);
            }
        });
    }

    $(document).ready(function() {
        getMatches();
    });

    var timer = setInterval(getMatches, 10000);
    
    </script>
    @endsection