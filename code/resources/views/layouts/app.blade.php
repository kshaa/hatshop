<!DOCTYPE html>
<html class="route" id="route-{{ Route::currentRouteName() }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/dom_ready.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/105/three.min.js" defer></script>
    <script src="{{ asset('js/gltf_loader.js') }}" defer></script>
    <script src="{{ asset('js/gltf_viewer.js') }}" defer></script>
    <script src="{{ asset('js/model_widget.js') }}" defer></script>
    <script src="{{ asset('js/toggle_trade_form.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/opw_theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body id="app-body">
    <div id="app">
        <!-- Navigation -->
        @if ((isset($show_header) && ($show_header === true)) || !isset($show_header))
            <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top ">
                <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('trade_index') }}">{{ __('Trades') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('hat_index') }}">{{ __('Hats') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('charm_index') }}">{{ __('Charms') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user_index') }}">{{ __('Users') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
                </div>
            </nav>
        @endif

        @if (!empty($errors) && $errors->any())
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    </div>
                </div> 
            </div>
        @endif

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
