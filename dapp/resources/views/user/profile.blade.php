<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="profileModalLabel">{{$user->username}}</h4>
        </div>
        <div class="modal-body mainsectionbg">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-3">
                        @if($user->profile)
                        <img alt="" class="img-circle" src="{{url('/')}}/assets/images/profile/{{$user->profile}}" /> </a>
                        @else
                        <img alt="" class="img-circle" src="{{url('/')}}/assets/images/profile/default.png" /> </a>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-9 profile-tabs">
                                <div class="item">
                                    <span>Overall Rating: </span>
                                    <span>{{$user->getOverAllRating()}}</span>
                                </div>
                                <div class="item">
                                    <span>Wins: </span>
                                    <span>{{$user->number_of_winnings()}}</span>
                                </div>
                                <div class="item">
                                    <span>Losses: </span>
                                    <span>{{$user->number_of_losses()}}</span>
                                </div>
                                <div class="item">
                                    <span>Amount Limit: </span>
                                    <span>{{$user->game_amount_limit.' '.config('app.currency')}}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                @if($user->id !== Sentinel::getUser()->id)
                                <a href="{{ route('challenge.createwithopponent', $user->id)}}" class="btn btn-default">Challenge</a>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                Preferred Game: {{$user->preferred_game ? $user->preferred_game->name : ''}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                Preferred Console: {{$user->preferred_console ? $user->preferred_console->name : ''}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                Console ID: {{$user->psn_username}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                Member Since: {{ date("d-m-Y", strtotime($user->created_at))}} | Last Login: {{date("d-m-Y",strtotime($user->last_login))}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($user->id !== Sentinel::getUser()->id)
            <div class="row mt-10">
                <div class="col-md-12 blocks">
                    <a href="{{ route('chat.single', $user->id)}}" class="btn btn-default">Send Message</a>
                    <a data-id="{{$user->id}}" class="btn btn-default follow">{{$user->following ? 'Unfollow' : 'Follow'}}</a>
                    <a data-id="{{$user->id}}" class="btn btn-default block">{{$user->blocked ? 'Unblock' : 'Block'}}</a>
                </div>
            </div>
            @endif
            <div class="row mt-10">
                <div class="col-md-12">
                    <div class="tab-pane" id="my-challenges" role="tabpanel" aria-labelledby="my-challenges-tab">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item active">
                                <a class="nav-link active" id="open-challenges-tab" data-toggle="tab" href="#open-challenges" role="tab" aria-controls="open-challenges-tab" aria-selected="true">Open Challenges</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="games-played-tab" data-toggle="tab" href="#games-played" role="tab" aria-controls="games-played-tab" aria-selected="false">Games Played</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="recent-feedback-tab" data-toggle="tab" href="#recent-feedback" role="tab" aria-controls="recent-feedback-tab" aria-selected="false">Recent Feedback</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="open-challenges" role="tabpanel" aria-labelledby="open-challenges-tab">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Console</th>
                                                <th>Amount</th>
                                                @if($user->id !== Sentinel::getUser()->id)
                                                <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($open_challenges as $challenge)
                                            <tr>
                                                <td>{{ $challenge->game->name }}</td>
                                                <td>{{ $challenge->console->name }}</td>
                                                <td>{{ $challenge->amount.' '.config('app.currency') }}</td>
                                                @if($user->id !== Sentinel::getUser()->id)
                                                <td>
                                                    <a class="btn btn-danger btn-xs accept" data-rules="{{ $challenge->rules_c }}" data-id="{{ $challenge->id }}">Accept</a>
                                                    <a href="<?php echo url('challenges/');?>/'.$challenge->id.'" class="btn btn-success btn-xs ml-10">Detail</a>
                                                </td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="games-played" role="tabpanel" aria-labelledby="games-played-tab">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Wins</th>
                                                <th>Losses</th>
                                                <th>Rating</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($played_games as $game)
                                            <tr>
                                                <td>{{ $game->game_name.' '.$game->console_name }}</td>
                                                <td>{{ $game->wins }}</td>
                                                <td>{{ $game->losses }}</td>
                                                <td>{{ $game->skill_rating }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="recent-feedback" role="tabpanel" aria-labelledby="recent-feedback-tab">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Amount</th>
                                                <th>Opponent</th>
                                                <th>Winner</th>
                                                <th>Rating</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($feedbacks as $feedback)
                                            <tr>
                                                <td>{{ $feedback->challenge->game->name.' '.$feedback->challenge->console->name }}</td>
                                                <td>{{ $feedback->challenge->amount.' '.config('app.currency') }}</td>
                                                <td>
                                                    @if(!$feedback->isOpponent)
                                                    <a href="#" data-id="{{$feedback->challenge->opponent->id}}" class="view-profile">
                                                        {{ $feedback->challenge->opponent->username }}</td>
                                                </a>
                                                @else
                                                <a href="#" data-id="{{$feedback->challenge->creator->id}}" class="view-profile">
                                                    {{ $feedback->challenge->creator->username }}</td>
                                                </a>
                                                @endif
                                                <td>{{ $feedback->challenge->winner ? $feedback->challenge->winner->username : 'Draw' }}</td>
                                                <td>{{ $feedback->skill_rating }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>