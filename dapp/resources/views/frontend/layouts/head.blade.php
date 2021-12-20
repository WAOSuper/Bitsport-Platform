<head>

  <!-- Basic Page Needs
  ================================================== -->
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="BitSport &trade; | Decentralized peer to peer competitive eSPorts platform | Monetize your Passion!.">
  <meta name="author" content="BitSport">
  <meta name="keywords" content="esports, blockchain usecase, bitsport, esport competition, online esports competition, bet with cryptocurrencies, esports staking, DeFi">

  <!-- Favicons
  ================================================== -->
  <link rel="shortcut icon" href="{{url('/')}}/favicon.png">
  <link rel="apple-touch-icon" sizes="120x120" href="{{URL::asset('assets/images/football/favicons/favicon-120.png')}}">
  <link rel="apple-touch-icon" sizes="152x152" href="{{URL::asset('assets/images/football/favicons/favicon-152.png')}}">
  <link href="https://fonts.googleapis.com/css?family=Amaranth" rel="stylesheet" type="text/css">
  <!-- Mobile Specific Metas
  ================================================== -->
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
  <!-- Preloader CSS -->
  <link href="{{URL::asset('assets1/css/preloader.css')}}" rel="stylesheet">
  <!-- Core JS -->
  <script src="{{ URL::asset('assets1/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{ URL::asset('assets1/js/core-min.js')}}"></script>
  <!-- Google Web Fonts
  ================================================== -->
  <link href="https://fonts.googleapis.com/css?family=Exo+2:400,700,700i|Roboto:400,400i" rel="stylesheet" >

  <!-- CSS
  ================================================== -->

  <!-- Vendor CSS -->
  <link href="{{ URL::asset('assets1/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{ URL::asset('assets1/fonts/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{ URL::asset('assets1/fonts/simple-line-icons/css/simple-line-icons.css')}}" rel="stylesheet" type="text/css">
  <link href="{{ URL::asset('assets1/vendor/magnific-popup/dist/magnific-popup.css')}}" rel="stylesheet" type="text/css">
  <link href="{{ URL::asset('assets1/vendor/slick/slick.css')}}" rel="stylesheet" type="text/css">
  <link href="{{ URL::asset('assets1/css/scoop-vertical.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{ URL::asset('assets1/css/owl.carousel.css')}}" rel="stylesheet" type="text/css">
  <link href="{{ URL::asset('assets1/css/owl.theme.default.css')}}" rel="stylesheet" type="text/css">

  <!-- Template CSS-->
  <link href="{{ URL::asset('assets1/css/style.css')}}" rel="stylesheet" type="text/css">

  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-185294841-1">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-185294841-1');
</script>

  @yield('head')
</head>
