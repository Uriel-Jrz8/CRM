<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/css/perso.css" media="screen" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('Merkado', 'Merkado Croqueta') }}</title>

    <!--<title>{{ config('app.name', 'Laravel') }}</title> -->

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Times-Roman" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-black shadow-sm">
            <div class="container">
                <!-- <img src="/Images/perroBlanco.png" width =90px height = 50px> -->
                <img src="/Images/MercadoBlanco.png" width=150px height=50px>
                <a class="navbar-brand" href="{{ url('/') }}">
                    <!-- {{ config('Merkado Croqueta', 'Merkado Croqueta') }} -->
                    <!--{{ config('app.name', 'Merkado Croqueta') }}-->
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-border-width" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 3.5A.5.5 0 0 1 .5 3h15a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-2zm0 5A.5.5 0 0 1 .5 8h15a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1zm0 4a.5.5 0 0 1 .5-.5h15a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5z" />
                        </svg></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" style="color:#FFF;" href="{{ route('login') }}">{{ __('Iniciar Sesion') }}</a>
                        </li>

                        <!-- Metodo para hacer el registro
                                @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif -->
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" style="color:#FFF;" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                {{ Auth::user()->name }} <span class="caret"></span>


                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar Sesión') }}
                                </a>
                                <!-- Consultar Datos de las tablas -->

                                <!-- <a class="dropdown-item" href="{{ route('ConsultDato') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('Datos').submit();">
                                        {{ __('Cunsultar Datos') }}
                                    </a> -->

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <!-- <form id="Datos" action="{{ route('ConsultDato') }}" method="POST" style="display: none;">
                                    @method('PUT')
                                        @csrf
                                    </form> -->
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <br>
            @yield('content')
        </main>
    </div>
    <!-- <div id ="footer">
            <p class="navbar-text pull-left">&copy <?php echo date('Y'); ?>
              <a href="https://merkadocroqueta.com/" target="_blank" style="color: White">Merkado Croqueta</a>
           </p>
           </div> -->
</body>

</html>