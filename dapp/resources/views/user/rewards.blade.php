<style type="text/css">

#reward_success .modal-dialog,
#reward_fail .modal-dialog {
    width: 250px;
    margin: 30px auto;
}

#reward_success .modal-dialog .modal-content,
#reward_fail .modal-dialog .modal-content {
    border-radius: 6px;
}

.icon-box {
        margin: 20px auto 0 auto;
        width: 90px;
        display: block !important;
}

.rev_acg_modal h2,
.rev_acgf_modal h2 {
        text-align: center;
        font-weight: 900;
        margin-bottom: 0;
        text-transform: uppercase;
        letter-spacing: -1px;
        color:#48ca7a;
    }
.rev_acgf_modal h2{
    color:#ff6567;
    text-transform:capitalize;
}

.rev_acg_modal p,
.rev_acgf_modal p {
    margin: 7px 0;
    display: block;
    text-align: center;
    font-size: 13px;
}

.btn-red,
.btn-green {
    background: #ff6567;
    color: #fff;
    padding: 5px 8px;
    width: 100px;
    margin: 20px auto;
    display: block;
    border-radius: 27px;
    text-align: center;
    text-transform: uppercase;
}

.btn-green{
    background:#48ca7a;
}

.btn-red:hover,
.btn-green:hover{ 
    color:#fff; 
    text-decoration:none;
}

/*.rev_acg_modal .modal-header,
.rev_acgf_modal .modal-header {
    border-bottom: none;
}*/

</style>

@extends('layouts.master')
<!-- head -->
@section('title')
    Bitsport | Rewards
@endsection
<!-- title -->
@section('head')
    <style type="text/css">
        #reward_success .modal-dialog,
        #reward_fail .modal-dialog {
            width: 250px;
            margin: 30px auto;
        }

        #reward_success .modal-dialog .modal-content,
        #reward_fail .modal-dialog .modal-content {
            border-radius: 6px;
        }

        .icon-box {
                margin: 20px auto 0 auto;
                width: 90px;
                display: block !important;
        }

        .rev_acg_modal h2,
        .rev_acgf_modal h2 {
                text-align: center;
                font-weight: 900;
                margin-bottom: 0;
                text-transform: uppercase;
                letter-spacing: -1px;
                color:#48ca7a;
            }
        .rev_acgf_modal h2{
            color:#ff6567;
            text-transform:capitalize;
        }

        .rev_acg_modal p,
        .rev_acgf_modal p {
            margin: 7px 0;
            display: block;
            text-align: center;
            font-size: 13px;
        }

        .btn-red,
        .btn-green {
            background: #ff6567;
            color: #fff;
            padding: 5px 8px;
            width: 100px;
            margin: 20px auto;
            display: block;
            border-radius: 27px;
            text-align: center;
            text-transform: uppercase;
        }

        .btn-green{
            background:#48ca7a;
        }

        .btn-red:hover,
        .btn-green:hover{ 
            color:#fff; 
            text-decoration:none;
        }

    </style>
@endsection

@section('content')
<?php
   $slug = Sentinel::getUser()->roles()->first()->slug;
?>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
        <div class="page-content" style="min-height: 1603px;">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Rewards</h1>

                </div>
                <!-- END PAGE TITLE -->
                
            </div>
            <!-- END PAGE HEAD-->


            <!-- BEGIN PAGE BREADCRUMB -->
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    @if($slug=='superadmin')
                        <a href="{{url('super-admin')}}">Home</a>
                    @elseif($slug=='admin')
                        <a href="{{url('admin-dashboard')}}">Home</a>
                    @else
                        <a href="javascript:;">Home</a>
                    @endif
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">Rewards</span>
                </li>
            </ul>
            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PROFILE PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-6 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->

                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-blue-sunglo">
                                <i class="icon-18 fa fa-gift"></i>
                                <span class="caption-subject bold uppercase"> Rewards</span>
                            </div>
                        </div>

       
                        <form action="{{url('/')}}/redeem-coupon" method="post">
                            <div class="form-group ">
                            <label> Reward Code </label>
                            <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                            <input type="text" required="required" class="form-control" name="coupon" value="" />
                            </div>

                            <button class="btn blue" data-toggle="modal" data-target="#reward_fail">Redeem Now</button>
                        </form>
                      

                    </div>

                </div>
            </div>

            <!-- END PROFILE PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>

    @if(session('success'))
        <div id="reward_modal" class="rev_acg_modal modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                       <div class="icon-box">
                           <img src="assets/images/sucess_icon.png">  
                       </div>
                       <h2> Success!</h2>
                       <p> {{session('success')}} </p>
                       <a href="#" data-dismiss="modal" class="btn-green"> ok</a>
                    </div>                
                </div>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div id="reward_modal" class="rev_acgf_modal modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                       <div class="icon-box">
                           <img src="assets/images/fail_icon.png">  
                       </div>
                       <h2> Oopsie!</h2>
                       <p> {{session('error')}} </p>
                       <a href="#" data-dismiss="modal" class="btn-red"> ok </a>
                    </div>                
                </div>
            </div>
        </div>
    @endif

@endsection
<!-- content -->

<style>
.icon-18 {
    font-size: 18px !important;
}
</style>

@section('script')
    @if(session('success') || session('error'))
        <script type="text/javascript">
            $(document).ready(function(){
                $("#reward_modal").modal('show');
            });
        </script>
    @endif
@endsection
@section('script_bottom')

@endsection