<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/images/favicon.ico')}}"/>
    <!-- -->
    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{--<link href="{{asset('starter-template.css')}}" rel="stylesheet">--}}
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">--}}
    {{--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">--}}

</head>

<body>
<div id="app">
    @guest
        <nav class="navbar navbar-expand-md navbar-light navbar-guest">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <a class="navbar-brand" href="#">
                            <img src="{{ asset("/images/iclogo1.png") }}" width="37" height="37"
                                 class="d-inline-block align-top" alt="IC Challenge">
                        </a>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav mx-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

    @else
        @if(\Illuminate\Support\Facades\Auth::user()->userType() == 'administrator')
            @include('layouts.navbars.administrator')

        @elseif(\Illuminate\Support\Facades\Auth::user()->userType() == 'evaluator')
            @include('layouts.navbars.evaluator')

        @elseif(\Illuminate\Support\Facades\Auth::user()->userType() == 'student')
            @include('layouts.navbars.student')

        @elseif(\Illuminate\Support\Facades\Auth::user()->userType() == 'teacher')
            @include('layouts.navbars.teacher')


        @endif
    @endguest

    <main class="py-4">
        @yield('content')
    </main>
</div>

<nav class="navbar fixed-bottom navbar-light navbar-bottom py-0">
    <ul class="navbar-nav mx-auto my-0 py-0">
        <a class="nav-item nav-link" href="#"><i class="fas fa-info-circle"></i> Privacy policy</a>
    </ul>

    <ul class="navbar-nav mx-auto my-0 py-0">
        <a class="nav-item nav-link" href="#"><i class="fas fa-question-circle"></i> Contact us</a>
    </ul>
</nav>

<!-- Scripts -->
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>--}}
{{--<script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>--}}
{{--<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>--}}
<script src="{{ asset('js/app.js') }}"></script>
@yield('javascript')
</body>
</html>
