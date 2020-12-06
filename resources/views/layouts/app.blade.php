<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
<div id="app">
    <div id="mySidebar" class="sidebar">
        <p class="admin-text">Admin panel</p>
        <a href="javascript:void(0)" class="closebtn">&times;</a>
        <a href="{{route('phones.index')}}">phones</a>
        <a href="{{route('categories.index')}}">categories</a>
    </div>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        @if(Auth::user())
            @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                <button class="openbtn">&#9776;</button>
            @endif
        @endif
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4" id="main-div">
        <div class="container" style="text-align: center">
            @if(session()->has('success'))
                <p class="alert alert-success">{{session()->get('success')}}</p>
            @endif
            @if(session()->has('warning'))
                <p class="alert alert-warning">{{session()->get('warning')}}</p>
            @endif
        </div>
        @yield('content')
        <div id="comparing">
            <div class="container" id="comp-cont">

                <form action="{{route('phones_info')}}">
                    <div id="compare-items" class="d-flex justify-content-between">

                        <div id="comp-item-1" class="text-center">

                        </div>
                        <div id="comp-item-2" class="text-center">

                        </div>
                        <p class="close-comp"><i class="far fa-times-circle"></i></p>
                    </div>
                    <div class="comp-buttons d-flex justify-content-around mt-2">

                        <button type="submit" class="btn btn-success compare-button" disabled>COMPARE</button>

                        <button type="button" class="btn btn-warning comp-reset">RESET</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="open-comp-items">
            <button class="btn btn-sm btn-outline-primary">open comparing items</button>
        </div>
    </main>
</div>
</body>
</html>
