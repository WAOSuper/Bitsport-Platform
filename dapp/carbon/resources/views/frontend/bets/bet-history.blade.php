  @extends('frontend.layouts.master')
@section('title') BitSport &trade; | Betting History @endsection
@section('content')
<link href="{{ URL::asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" /> 
<link href="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<div class="content col-md-9">
  <div class="card card--clean mb-0 mainsectionbg">
    <div class="inner-page">
        <div class="content page-content">
        	<div class="title-container ">
                 <h1>BETTING HISTORY</h1>
            </div>
            <div class="row">
            </div>
            
            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
            <table class="table table-striped table-bordered table-hover" id="sample_1">
                <thead>
                  <tr>
                    <th>Type</th>
                    <th>Date / Time</th>
                    <th>Team</th>
                    <th>Bet On</th>
                    <th>Odds</th>
                    <th>Stake</th>
                    <th>Win/Loss</th>        

                  </tr>
                </thead>
                <tbody>
                @foreach($bet as $b)
                    <tr>
                    @if($b->bet_type == 0)
                    <td style="color:green;"> <b>Single</b> </td>
                     @else
                        <td style="color:#ad3158;"> <b>Multiple</b></td>
                     @endif

                    <td>{{$b->date_time}}</td>
                    <!-- <td>{{$b->team_1_name}} vs {{$b->team_2_name}}  @if($b->team_id > 0) // {{$b->odd_name}} @endif</td> -->
                    <td>{{ @$b->team_1_name }} vs {{ @$b->team_2_name }}</td>

                     @if($b->bet_on == 1)
                    <td style="color:green;"> {{ @$b->team_1_name }}</td>
                     @elseif($b->bet_on == 2)
                    <td style="color:brown;"> Draw </td>
                     @else
                    <td style="color:blue;"> {{ @$b->team_2_name }}</td>
                     @endif

                    <td>{{$b->odds}}</td>
                    <td>{{$b->bet_odds}}</td>
                    @if($b->win == 0)
                        <td style="color:orange;"> Pending </td>
                    @elseif($b->win == 1)
                        <td style="color:green;"> Win </td>
                    @else
                        <td style="color:red;"> Loss </td>
                    @endif
                    </tr>
                @endforeach   
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>


@endsection		
@section('script')
     <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{asset('assets/pages/scripts/table-datatables-buttons.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
      
    </script>
@endsection	