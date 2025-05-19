<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Intranet | Home</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('plugins/assets/img/favicon.ico') }}" type="image/x-icon">

    <!-- Font awesome -->
    <link href="{{ asset('plugins/assets/css/font-awesome.css') }}" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="{{ asset('plugins/assets/css/bootstrap.css') }}" rel="stylesheet">   
    <!-- Slick slider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/assets/css/slick.css') }}">          
    <!-- Fancybox slider -->
    <link rel="stylesheet" href="{{ asset('plugins/assets/css/jquery.fancybox.css') }}" type="text/css" media="screen" /> 
    <!-- Theme color -->
    <link id="switcher" href="{{ asset('plugins/assets/css/theme-color/default-theme.css') }}" rel="stylesheet">          

    <!-- Main style sheet -->
    <link href="{{ asset('plugins/assets/css/style.css') }}" rel="stylesheet">    

   
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,500,700' rel='stylesheet' type='text/css'>
    @yield('css')
</head>
<body>
    <!--START SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#">
      <i class="fa fa-angle-up"></i>      
    </a>
    <!-- END SCROLL TOP BUTTON -->
    @include('Layouts.header')
        @yield('content')
        
    @include('Layouts.footer')
  <!-- jQuery library -->
  <script src="{{ asset('plugins/assets/js/jquery.min.js') }}"></script>  
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="{{ asset('plugins/assets/js/bootstrap.js') }}"></script>   
  <!-- Slick slider -->
  <script type="text/javascript" src="{{ asset('plugins/assets/js/slick.js') }}"></script>
  <!-- Counter -->
  <script type="text/javascript" src="{{ asset('plugins/assets/js/waypoints.js') }}"></script>
  <script type="text/javascript" src="{{ asset('plugins/assets/js/jquery.counterup.js') }}"></script>  
  <!-- Mixit slider -->
  <script type="text/javascript" src="{{ asset('plugins/assets/js/jquery.mixitup.js') }}"></script>
  <!-- Add fancyBox -->        
  <script type="text/javascript" src="{{ asset('plugins/assets/js/jquery.fancybox.pack.js') }}"></script>
  <!-- Custom js -->
  <script src="{{ asset('plugins/assets/js/custom.js') }}"></script> 
@yield('javascript')
  </body>
</html>