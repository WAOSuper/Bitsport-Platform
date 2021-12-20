<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="{{url('/')}}">
             <!--    <img src="{{url('/')}}/assets/layouts/layout4/img/logo-light.png" alt="logo" class="logo-default" /> --> <h2><b>BITSPORT</b></h2></a>
            <div class="menu-toggler sidebar-toggler">
            </div>
        </div>
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
         <?php
       $slug = Sentinel::getUser()->roles()->first()->slug;
      
     ?>
        <div class="page-top" data="bharat">
            <form id="form-submit" method="post" action="<?php echo url('/');?>/logout">
                {{ csrf_field() }}
            <div class="top-menu">
            @if($slug=='superadmin')
            <!--   Here here -->
                <ul class="nav navbar-nav pull-rig`ht">
                    <li class="separator hide"> </li>
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="username username-hide-on-mobile"> {{Sentinel::getUser()->first_name}} </span>
                            @if(Sentinel::getUser()->profile)
                                <img alt="" class="img-circle" src="{{url('/')}}/assets/images/profile/{{Sentinel::getUser()->profile}}" /> </a>
                            @else
                                <img alt="" class="img-circle" src="{{url('/')}}/assets/images/profile/default.png" /> </a>
                            @endif
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="{{url('superadmin-profile')}}">
                                    <i class="icon-user"></i> My Profile </a>
                            </li> 
                            <li>
                                <a href="#" onclick="document.getElementById('form-submit').submit()" >
                                    <i class="icon-key"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-quick-sidebar-toggler">
                        <a href="#" onclick="document.getElementById('form-submit').submit()"  class="dropdown-toggle">
                            <i class="icon-logout"></i>
                        </a>
                    </li>
                </ul>
            @elseif($slug=='admin')
                <ul class="nav navbar-nav pull-right">
                    <li class="separator hide"> </li>
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="username username-hide-on-mobile"> {{Sentinel::getUser()->first_name}} </span>
                            @if(Sentinel::getUser()->profile)
                                <img alt="" class="img-circle" src="{{url('/')}}/assets/images/profile/{{Sentinel::getUser()->profile}}" /> </a>
                            @else
                                <img alt="" class="img-circle" src="{{url('/')}}/assets/images/profile/default.png" /> </a>
                            @endif
                        <ul class="dropdown-menu dropdown-menu-default">
                       <li>
                                <a href="{{url('admin-profile')}}">
                                    <i class="icon-user"></i> My Profile </a>
                            </li>
                            <li>
                                <a href="#" onclick="document.getElementById('form-submit').submit()" >
                                    <i class="icon-key"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-quick-sidebar-toggler">
                        <a href="#" onclick="document.getElementById('form-submit').submit()"  class="dropdown-toggle">
                            <i class="icon-logout"></i>
                        </a>
                    </li>
                </ul>
            @elseif($slug=='sponser')
                <ul class="nav navbar-nav pull-right">
                    <li class="separator hide"> </li>
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="username username-hide-on-mobile"> {{Sentinel::getUser()->first_name}} </span>
                            @if(Sentinel::getUser()->profile)
                                <img alt="" class="img-circle" src="{{url('/')}}/assets/images/profile/{{Sentinel::getUser()->profile}}" /> </a>
                            @else
                                <img alt="" class="img-circle" src="{{url('/')}}/assets/images/profile/default.png" /> </a>
                            @endif
                        <ul class="dropdown-menu dropdown-menu-default">
                       <li>
                                <a href="{{url('sponser')}}">
                                    <i class="icon-user"></i> My Profile </a>
                            </li>
                            <li>
                                <a href="#" onclick="document.getElementById('form-submit').submit()" >
                                    <i class="icon-key"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-quick-sidebar-toggler">
                        <a href="#" onclick="document.getElementById('form-submit').submit()"  class="dropdown-toggle">
                            <i class="icon-logout"></i>
                        </a>
                    </li>
                </ul>
            @else
                <ul class="nav navbar-nav pull-right">
                    <li class="separator hide"> </li>
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="username username-hide-on-mobile">{{Sentinel::getUser()->first_name}}</span>
                            @if(Sentinel::getUser()->profile)
                                <img alt="" class="img-circle" src="{{url('/')}}/assets/images/profile/{{Sentinel::getUser()->profile}}" /> </a>
                            @else
                                <img alt="" class="img-circle" src="{{url('/')}}/assets/images/profile/default.png" /> </a>
                            @endif
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="{{url('profile')}}">
                                    <i class="icon-user"></i> My Profile </a>
                            </li>
                            <li>
                                <a href="#" onclick="document.getElementById('form-submit').submit()" >
                                    <i class="icon-key"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-quick-sidebar-toggler">
                        <a href="#" onclick="document.getElementById('form-submit').submit()"  class="dropdown-toggle">
                            <i class="icon-logout"></i>
                        </a>
                    </li>
                </ul>
            @endif

            </div>
            </form>

        </div>
        <!-- END PAGE TOP -->
    </div>

    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->