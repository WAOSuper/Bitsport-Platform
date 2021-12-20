@extends('layouts.master')
<!-- head -->
@section('title')
Payment
@endsection
<!-- title -->
@section('head')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style type="text/css">
    .panel-title {
        display: inline;
        font-weight: bold;
    }

    .display-table {
        display: table;
    }

    .display-tr {
        display: table-row;
    }

    .display-td {
        display: table-cell;
        vertical-align: middle;
        width: 61%;
    }

    .active_div {
        background: #eef1f5;
        font-size: 15px;
        color: #5ba1a9;
        padding: 7px;
        border-left: 3px solid #5ba1a9;
    }
    #box {
        background-color: #3B3F51;
        color: #f2f2f2;
        padding: 30px;
        font-size: 18px;
        margin: 15px;
        border-radius: 8px;
    }
</style>
@endsection

@section('content')
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="min-height: 1489px;">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>Payment </h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="javascript:;">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">Payment </span>
            </li>
        </ul>

        <div class="">
            <br>
<br>

            <?php
            $startTime = $buysell_data->created_at;
            $pending_hour = 30;
            $cenvertedTime = date('Y-m-d H:i:s', strtotime('+' . $pending_hour . ' minutes', strtotime($startTime)));

            ?>

            @if (Session::has('success'))
            <div class="alert alert-success text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p>{{ Session::get('success') }}</p>
            </div>
            @endif
            @if (Session::has('error'))
            <div class="alert alert-success text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p>{{ Session::get('error') }}</p>
            </div>
            @endif




            @if($buysell_data->status == 1)
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-success text-center">
                        Your placed transaction for buying 
                        <b><?php echo $buysell_data->usd; ?> BTP </b> 
                        with amount of <b><?php echo $buysell_data->btp; ?> BTP </b>
                        through credit card is successfully done.
                        <br /> Go to <a href="/buy-btp">Buy</a> pages for trying again.
                        </p>
                    </div>
                </div>
            </div>
            @elseif($buysell_data->status == 2)
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-danger text-center">
                        <p>
                            Your placed transaction for buying <b><?php echo $buysell_data->btp; ?> BTP </b> with amount of <b><?php echo $buysell_data->usd; ?> USD </b> through credit card is already cancelled.
                            <br /> Go to <a href="/buy-btp">Buy</a> pages for trying again.
                        </p>
                    </div>
                </div>
            </div>

            @elseif($buysell_data->status == 0)

            <div class="row">
                <div class="col-md-6 col-md-offset-3">

                    <div class="credit-card-box" style="margin-bottom: 30px;">
                     <!---   <span id="demo"></span> -->
                    </div>
                    <br>

                    <div class="panel panel-default credit-card-box">
                        <div class="panel-heading display-table">
                            <div class="row display-tr">
                                <h3 class="panel-title display-td">Payment Details</h3>
                                <div class="display-td">
                                    <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 style="text-align:center">User Details</h4>
                                            <table class="table">
                                                <tr>
                                                    <td><b>Name</b></td>
                                                    <td><?php echo $userdata->first_name . ' ' . $userdata->last_name; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Email</b></td>
                                                    <td><?php echo $userdata->email; ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <h4 style="text-align:center">Payment Details</h4>
                                            <table class="table">
                                                <tr>
                                                        <td><b>BTP</b></td>
                                                        <td><?php echo $buysell_data->btp; ?> BTP</td>
                                                </tr>
                                                <tr>
                                                    <td><b>USD</b></td>
                                                    <td><?php echo $buysell_data->usd; ?> USD</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <p class="active_div">Card Premium: <b> <?php echo $final_insert_usd = $buysell_data->usd ?> USD </b></p>
                                </div>
                            </div>


                            <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="pk_live_DXCCeuMPRLXK21KJGMVcmYa200B8fAAE20" id="payment-form">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" value="<?php echo $buysell_data->usd; ?>" name="payment_amount" />
                                <input type="hidden" value="<?php echo $buysell_data->btp; ?>" name="btp_amount" />
                                <input type="hidden" value="<?php echo $buysell_data->id; ?>" name="transaction_id" />
                                <input type="hidden" value="<?php echo $buysell_data->user_id; ?>" name="user_id" />
                                <input type="hidden" value="0" name="from_type" />
                                <input type="hidden" value="<?php echo $final_insert_usd; ?>" name="final_insert_usd" />


                                <div class='form-row row'>
                                    <div class='col-xs-12 form-group required'>
                                        <label class='control-label'>Name on Card</label> <input class='form-control' size='4' type='text'>
                                    </div>
                                </div>

                                <div class='form-row row'>
                                    <div class='col-xs-12 form-group card required'>
                                        <label class='control-label'>Card Number</label> <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                                    </div>
                                </div>

                                <div class='form-row row'>
                                    <div class='col-xs-12 col-md-4 form-group cvc required'>
                                        <label class='control-label'>CVC</label> <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                                    </div>
                                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                                        <label class='control-label'>Expiration Month</label> <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                    </div>
                                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                                        <label class='control-label'>Expiration Year</label> <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                                    </div>
                                </div>

                                <div class='form-row row'>
                                    <div class='col-md-12 error form-group hide'>
                                        <div class='alert-danger alert'>Please correct the errors and try
                                            again.</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now ($ <?php echo $final_insert_usd; ?>)</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @else
            @endif


        </div>

        @endsection
        @section('script')
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

        <script type="text/javascript">
            $(function() {

                var now_date = "<?php echo date('M d, Y h:i:s', strtotime($cenvertedTime)); ?>";
                var countDownDate = new Date(now_date).getTime();
 <?php if($buysell_data->status == 0){ ?>
                var x = setInterval(function() {
                    $.ajax({
                        type: 'get',
                        url: "{{url('get-current-date')}}",
                        success: function(responseData) {

                            var start_date = responseData;
                            var now = new Date(start_date).getTime();

                            var distance = countDownDate - now

                            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                            document.getElementById("demo").innerHTML = "<span id='box'>" + hours + " Hr </span><span id='box'>" +
                                minutes + " Min </span><span id='box'>" + seconds + " Sec </span>";

                            if (distance < 0) {
                                clearInterval(x);
                                document.getElementById("demo").innerHTML = "EXPIRED";
                                window.location.href = "/buy-btp";
                            }
                        },
                    });
                }, 1000);
<?php }?>
                var $form = $(".require-validation");
                $('form.require-validation').bind('submit', function(e) {
                    var $form = $(".require-validation"),
                        inputSelector = ['input[type=email]', 'input[type=password]',
                            'input[type=text]', 'input[type=file]',
                            'textarea'
                        ].join(', '),
                        $inputs = $form.find('.required').find(inputSelector),
                        $errorMessage = $form.find('div.error'),
                        valid = true;
                    $errorMessage.addClass('hide');

                    $('.has-error').removeClass('has-error');
                    $inputs.each(function(i, el) {
                        var $input = $(el);
                        if ($input.val() === '') {
                            $input.parent().addClass('has-error');
                            $errorMessage.removeClass('hide');
                            e.preventDefault();
                        }
                    });

                    if (!$form.data('cc-on-file')) {
                        e.preventDefault();
                        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                        Stripe.createToken({
                            number: $('.card-number').val(),
                            cvc: $('.card-cvc').val(),
                            exp_month: $('.card-expiry-month').val(),
                            exp_year: $('.card-expiry-year').val()
                        }, stripeResponseHandler);
                    }

                });

                function stripeResponseHandler(status, response) {
                    if (response.error) {
                        $('.error')
                            .removeClass('hide')
                            .find('.alert')
                            .text(response.error.message);
                    } else {
                        // token contains id, last4, and card type
                        var token = response['id'];
                        // insert the token into the form so it gets submitted to the server
                        $form.find('input[type=text]').empty();
                        $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                        $form.get(0).submit();
                    }
                }

            });
        </script>

        @endsection