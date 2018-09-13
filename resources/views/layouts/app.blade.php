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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('style')
</head>
<body>
    <div id="app">        
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-0" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                            <li class="nav-item @yield('products-nav')">
                                <a class="nav-link" href="/products">產品頁面</a>
                            </li>
                        @endguest
                        @auth 
                            <li class="nav-item @yield('products-nav') @yield('shopping-cart-nav') @yield('order-list-nav') dropdown ">                            
                                <a id="product-dropdown" data-toggle="dropdown" class="nav-link dropdown-toggle" href="#">產品</a>                       
                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="product-dropdown">
                                    <a class="dropdown-item" href="/products">產品頁面</a>
                                    <a class="dropdown-item" href="/products/cart">購物車</a>
                                    <a class="dropdown-item" href="/products/checkout">訂購單</a>
                                </div>                            
                            </li>
                        @endauth
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
                                <li class="nav-item @yield('user-admin-nav')"><a class="nav-link" href="/user">會員管理</a></li>
                            @endif   
                            <li class="nav-item @yield('self-info-nav')">
                                <a class="nav-link" href="">個人資料</a>
                            </li>                         
                            <li class="nav-item @yield('user-home-nav') dropdown">
                                <a id="logout-dropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="logout-dropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
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

        <main>
            @yield('content')
        </main>
    </div>    

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
</body>
</html>
