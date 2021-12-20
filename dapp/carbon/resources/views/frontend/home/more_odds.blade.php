@extends('frontend.layouts.master')
@section('content')
<div class="center-content">
        <div class="row">
            <div class="col-12  col-md-4 col-lg-3 nopadding">
                <div class="site-sidebar">

                @include('frontend.layouts.sidebar')
                </div>
            </div>
            <div class="col-12  col-md-8 col-lg-9 nopadding">
                <div class="inner-page">
                    <div class="content">

                        <div class="date-badges-container">

                            <div class="date-badge col-md-" date="2017-11-13"><span>Monday</span><br> 13 Nov 17</div>

                            <div class="date-badge" date="2017-11-14"><span>Tuesday</span><br> 14 Nov 17</div>

                            <div class="date-badge" date="2017-11-15"><span>Wednesday</span><br> 15 Nov 17</div>

                            <div class="date-badge" date="2017-11-16"><span>Thursday</span><br> 16 Nov 17</div>

                            <div class="date-badge" date="2017-11-17"><span>Friday</span><br> 17 Nov 17</div>

                            <div class="date-badge" date="2017-11-18"><span>Saturday</span><br> 18 Nov 17</div>

                            <div class="date-badge" date="2017-11-19"><span>Sunday</span><br> 19 Nov 17</div>

                            <div class="date-badge active" date="future"><span>Next</span><br>7 Days</div>
                        </div>

                            @foreach($team_data as $master)
                         
                        

                        <div class="events-header">
                            <div class="header">
                           {{ $master->odd_master->odd_title }}
                               
                            </div>
                          
                            <div class="event-container">
                                 <table class="table">
                                     <tr>
                                         <td>
                                             <b>{{ $master->team1->name }}</b>
                                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                             <span>{{ $master->odds }}</span>
                                         </td>

                                          <td>
                                             <b>{{ $master->team2->name }}</b>
                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                             <span>{{ $master->odds2 }}</span>
                                         </td>
                                     </tr>
                                 </table>
                            </div>
                        </div>
                        @endforeach


                       
                         
                        

                        <div class="events-header">
                         
                            <div class="event-container">
                                 <table class="table">
                                    @foreach($odd_data as $odd)
                                     <tr>
                                         <td>
                                             <b>{{ $odd->name }}</b>
                                         </td>
                                         <td></td>
                                         <td>{{ $odd->odds }}</td>
                                     </tr>
                                        @endforeach

                                 </table>
                            </div>
                        </div>
                     

                </div>
            </div>
                <div class="link-boxes">

                      <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                    <div class="row">
                        <div class="col-4 col-md-4">
                            <a href="#" target="_blank">
                                <div class="box">
                                    <div><img src="//cdn.coingaming.io/sportsbet/images/betting-tips-icon.svg"></div>
                                    <div>Betting Tips</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-4 col-md-4">
                            <a href="#">
                                <div class="box">
                                    <div><img src="//cdn.coingaming.io/sportsbet/images/live-betting-icon.svg"></div>
                                    <div>Live Betting</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-4 col-md-4">
                            <a href="#">
                                <div class="box">
                                    <div><img src="//cdn.coingaming.io/sportsbet/images/promotions-icon.svg"></div>
                                    <div>Promotions</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection




