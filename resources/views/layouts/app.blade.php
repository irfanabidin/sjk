<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> FullCash </title> <!--{{ config('app.name', 'FullCash') }}-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <!-- Styles -->
    @yield('css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .bg{
             background-image: url('https://dhallywoodworld.files.wordpress.com/2014/12/background-light-web-opera-blue-simple.jpg');
          }
        .footer{
            background-color: #fff;
        }
    </style>
</head>
<body class="bg">
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                       <font size="5" color="blue">FullCash</font><!-- {{ config('app.name', 'FullCash') }} -->
                    </a>
                   
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>                                            <!-- Register -->        <!--  <li><a href="{{ route('register') }}">Register</a></li> -->
                        @else
@if (Auth::user()->permission == "Operator")

                    <a class="navbar-brand" href="{{url('/home')}}">Home |</a>
                    <a class="navbar-brand" href="{{url('/pembelian')}}">Pembelian |</a>
                    <a class="navbar-brand" href="{{url('/barang')}}">Penjualan |</a>
                    <a class="navbar-brand" href="{{url('/tagihan')}}">Bayar Tagihan</a>
 
@elseif(Auth::user()->permission == "Super Admin")

                    <a class="navbar-brand" href="{{url('/home')}}">Home |</a>
                    <a class="navbar-brand" href="{{url('/pembelian')}}">Pembelian |</a>
                    <a class="navbar-brand" href="{{url('/barang')}}">Penjualan |</a>
                    <a class="navbar-brand" href="{{url('/tagihan')}}">Bayar Tagihan |</a>
                    <a class="navbar-brand" href="{{url('/user')}}">Pegawai</a>
              
@elseif(Auth::user()->permission == "Eksekuif")

                    <a class="navbar-brand" href="{{url('/home')}}">Home |</a>
                    <a class="navbar-brand" href="{{url('/pembelian')}}">Pembelian |</a>
                    <a class="navbar-brand" href="{{url('/barang')}}">Penjualan</a>
  
@endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

<div class="container" >
  <div class="row">
  <hr>
    <div class="col-lg-12">
      <div class="col-md-8">
        <a href="#">Terms of Service</a> | <a href="#">Privacy</a>    
      </div>
      <div class="col-md-4">
        <p class="muted pull-right">© 2017 Fullcash. All rights reserved</p>
      </div>
    </div>
  </div>
</div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
