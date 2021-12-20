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
            <h5 class="headertexttop">Create New Challenge</h5>
            <hr>
            <div id="live-event-data">
                <form class="create-match-form" action="{{ route('challenge.store') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input class="form-control placeholder-no-fix" type="hidden" name="timezone" id="timezone" />

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">Challenge mode</label>
                                <div>
                                    <label class="fs-15" for="challenge">
                                        <?php echo Form::radio('game_mode', 'challenge', isset($user->id), ['id' => 'challenge']); ?>
                                        Challenge a user
                                    </label>
                                    <label class="fs-15" for="open">
                                        <?php echo Form::radio('game_mode', 'open', !isset($user->id), ['id' => 'open']); ?>
                                        Open
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="opponent_id">
                            <label class="control-label visible-ie8 visible-ie9">Select Opponent</label>
                            <div class="form-group">
                                <?php echo Form::select('opponent_id', [], null, ['class' => 'form-control user_list',  'autocomplete' => 'off',  'placeholder' => 'Search opponent']); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">Select Device</label>
                                <?php echo Form::select('console_id', $console, 1, ['class' => 'form-control placeholder-no-fix', 'id' => 'console']); ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">Select Game</label>
                                <?php echo Form::select('game_id', array(), null, ['class' => 'form-control placeholder-no-fix', 'id' => 'game']); ?>
                            </div>
                        </div>

                        <div class="col-md-6" id="mode">
                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">Specify Game Mode(optional)</label>
                                <?php echo Form::select('mode_id', array(), 3, ['class' => 'form-control placeholder-no-fix', 'id' => 'mode-field']); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">Amount</label>
                                <?php echo Form::number('amount', null, ['class' => 'form-control placeholder-no-fix', 'placeholder' => 'Enter amount', 'required' => true]); ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">Team Size</label>
                                <?php echo Form::select('team_size', array('1' => '1vs1'), 1, ['class' => 'form-control placeholder-no-fix']); ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">Rules</label>
                                <?php echo Form::text('rules_c', null, ['class' => 'form-control placeholder-no-fix', 'placeholder' => 'proposed rules and settings']); ?>
                            </div>
                        </div>

                        <div class="col-md-6" id="psn_id">
                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">PSN ID</label>
                                <?php echo Form::text('psn_id', '', ['class' => 'form-control placeholder-no-fix', 'placeholder' => 'PSN ID']) ?>
                            </div>
                        </div>

                        <div class="col-md-6" id="xbox_id">
                            <div class="form-group">
                                <label class="control-label visible-ie8 visible-ie9">Xbox GamerTag</label>
                                <?php echo Form::text('xbox_id', '', ['class' => 'form-control placeholder-no-fix', 'placeholder' => 'Xbox GamerTag']) ?>
                            </div>
                        </div>

                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary"> Submit </button>
                    </div>
                </form>
            </div>

        </div>
        <!-- secon main row end here -->

    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    var d = new Date();
    var n = d.getTimezoneOffset();
    $("#timezone").val(n / 60);
    $("#mode").hide();
    $("#psn_id").hide();
    $("#xbox_id").hide();
    $('.user_list').autoComplete({
        minLength: 0,
        resolverSettings: {
            url: "{{route('challenge.opponent-suggetions')}}"
        }
    });
    if("{{isset($user->id)}}" == false){
        $('#opponent_id').hide();
    } else {
        $('.user_list').autoComplete('set', { value: "{{isset($user->id) ? $user->id : ''}}", text: "{{isset($user->id) ? $user->username : ''}}" });
    }
    $('#challenge').on('click', function() {
        $('#opponent_id').show();
    });
    $('#open').on('click', function() {
        $('#opponent_id').hide();
    });

    var availableModes = [];
    $('#game').on('change', function() {
        if ($('#game option:selected').attr('has-mode') > 0) {
            loadModes($(this).val());
        }
    });

    function loadModes(key) {
        var options = availableModes[key];
        $("#mode").hide();
        $("#mode-field").html('');
        if (options) {
            $("#mode").show();
            $('#mode-field').append(new Option('Select', ''));
            options.forEach(function(option) {
                $('#mode-field').append(new Option(option.name, option.id));
            });
        }
    }

    $('#console').on('change', function() {
        loadGame(this.value);
        $("#psn_id").hide();
        $("#xbox_id").hide();
        $("#psn_id input").removeAttr('required');
        $("#xbox_id input").removeAttr('required');
        if (this.value == 1) {
            $("#psn_id").show();
            $("#psn_id input").attr('required', true);
        }
        if (this.value == 2) {
            $("#xbox_id").show();
            $("#xbox_id input").attr('required', true);
        }
    });
  
    loadGame($('#console').val());

    function loadGame(value) {
        $.ajax({
            type: 'get',
            dataType: 'json',
            url: "{{url('challenge/get-games')}}" + '/' + value,
            success: function(responseData) {
                $('#game').html('');
                $.each(responseData, function(i, value) {
                    if (value.mode.length) {
                        availableModes[value.id] = value.mode;
                    }
                    if (i === 0) {
                        loadModes(value.id);
                    }
                    $('#game').append($("<option></option>")
                        .attr("value", value.id)
                        .text(value.name).attr('has-mode', value.mode.length));
                });
            },
            error: function(responseData) {
                return false;
            }
        });
    }
</script>
@endsection