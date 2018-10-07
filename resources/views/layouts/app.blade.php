<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Slick Slider -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('style')
    
    <style>
    
    
    </style>
</head>
<body>
    <div id="app">        
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-0" id="mainNav">
                
            <div class="container">
                
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item @yield('badminton-nav')">
                            <a class="nav-link product-nav dropdown-toggle" href="javascript:void(0);">羽球專區</a>
                            <div class="navbar-subnav @yield('badminton-subnav')">
                                <div class="container">
                                    <a href="/products/rackets" class="nav-link subnav-link @yield('badminton-rackets')">羽球拍</a>
                                    <a href="/products/footwears" class="nav-link subnav-link @yield('badminton-footwears')">羽球鞋</a>
                                    <a href="/products/apparels" class="nav-link subnav-link @yield('badminton-apparels')">羽球衣</a>                                    
                                    <a href="/products/bags" class="nav-link subnav-link @yield('badminton-bags')">拍包袋 & 背包</a>
                                    <a href="/products/accessories" class="nav-link subnav-link @yield('badminton-accessories')">羽球、配件及器材</a>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item @yield('coffee-nav')">
                            <a class="nav-link product-nav dropdown-toggle" href="/products">咖啡專區</a>
                            <div class="navbar-subnav">
                                <div class="container">
                                    <a href="/products/rackets" class="nav-link subnav-link">咖啡產品</a>
                                    <a href="/products/rackets" class="nav-link subnav-link">咖啡介紹</a>
                                    <a href="/products/rackets" class="nav-link subnav-link">咖啡地圖</a>
                                </div>
                            </div>
                        </li>


                        <li class="nav-item @yield('post-nav')">
                            <a class="nav-link" href="/posts">文章</a>
                        </li>
                        @auth                            
                            <li class="nav-item @yield('chat-room-nav')">
                                <a class="nav-link" href="/chat">聊天室</a>
                            </li>   
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item @yield('login-nav')">
                                <a class="nav-link" href="{{ route('login') }}">登入</a>
                            </li>
                            <li class="nav-item @yield('register-nav')">
                                <a class="nav-link" href="{{ route('register') }}">註冊</a>
                            </li>
                        @else                            
                            @if (Auth::user()->authority == 1)
                                <li class="nav-item @yield('products-admin-nav')"><a class="nav-link" href="/products/job">產品管理</a></li>
                                <li class="nav-item @yield('user-admin-nav')"><a class="nav-link" href="/user">會員管理</a></li>                                
                            @endif   
                            <li class="nav-item @yield('self-info-nav')">
                                <a class="nav-link" href="/user/{{ Auth::user()->id }}/edit">個人資料</a>
                            </li>                         
                            <li class="nav-item @yield('user-home-nav') dropdown">
                                <a id="logout-dropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="logout-dropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" 
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main style="min-height: 100vh; padding-top: 20vh; @yield('index')">
            @yield('content')
        </main>

        <footer class="py-5 footer-guides">
            <div class="container text-center">
                <div class="row mx-auto">
                <span class="col-md-3"><a href="/">首頁</a></span>
                <span class="col-md-3"><a href="./">咖啡專區</a></span>
                <span class="col-md-3"><a href="./">羽球專區</a></span>
                <span class="col-md-3"><a href="./">店員資料</a></span>
                </div>
                <div>
                <a target="_blank" href="https://www.facebook.com/cafe24lb/"><img class="footer-icon" src="{{ asset('/images/facebook-logo.svg') }}" alt=""></a>
                <a target="_blank" href="https://www.instagram.com/cafe24lb/"><img class="footer-icon" src="{{ asset('/images/instagram-logo.svg') }} " alt=""></a>
                </div>
                <small>© Copright 2018 - 24lb Cafe & Badminton</small>
            </div>
        </footer>
    </div>    

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>   

    <!-- Slick Slider -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <!-- Custom Scripts -->
    @yield('script')
</body>
</html>
