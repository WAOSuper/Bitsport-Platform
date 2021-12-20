<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title> @yield('title')  </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="BitSport" name="description" />
    <meta content="BitSport" name="author" />

    @include('layouts.head')
    <link rel="shortcut icon" href="{{URL::asset('favicon.png')}}" />
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">

<div id="top"></div>


@include('layouts.top-menu')
<div class="clearfix"> </div>
<div class="page-container" >
    @include('layouts.sidebar-menu-public')

    @yield('content')

    @include('layouts.footer')
</body>
</html>
