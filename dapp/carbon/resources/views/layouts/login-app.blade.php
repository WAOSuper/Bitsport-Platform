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
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<body class="login">


@yield('content')

@include('layouts.footer')
</body>
</html>
