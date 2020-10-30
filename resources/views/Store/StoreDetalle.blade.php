<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merkado Croqueta</title>
    <link rel="shortcut icon" href="/Images/perro.ico"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    
</head>

<body>
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
                    @else
                    <form class="form-inline" action="{{ route('search')}}">
                        @method('PUT')
                        @csrf
                        <input class="form-control mr-sm-2" name="search" placeholder="Buscar..." autocomplete="off">

                    </form>
                    <li class="nav-item dropdown">

                        <a id="navbarDropdown" style="color:#FFF;" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                            {{ Auth::user()->name }} <span class="caret"></span>


                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Cerrar Sesión') }}
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
    </nav><br>


    <!-- <div class="row"> -->
    <center>
        <div class="col-12 col-md-8">
            <h1 style="font-family: Fredoka One;">Almacen General</h1>
        </div><br>
    </center>

    <div class=".col-6 .col-md-4">
        <div class="btn-group">
            <a href="{{ route('Entradas') }}"><button class="btn btn-outline-pink"> Ver Entradas</button></a>
        </div>
        <div class="btn-group">
            <a href="{{ route('Salidas') }}"><button class="btn btn-outline-pink"> Ver Salidas</button></a>
        </div><br><br>

    </div>
    <!-- </div> -->
    <div class="table-responsive ">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th><b>Identificador</b></th>
                    <th><b>Código SKU</b></th>
                    <th><b>Descripcion de Producto</b></th>
                    <th><b>Marca</th>
                    <th><b>Peso</b></th>
                    <th><b>Animal</b></th>
                    <th><b>Tipo Alimento</b></th>
                    <th><b>Peso</b></th>
                    <th><b>Categoría</b></th>
                    <th><b>Precio de Compra</b></th>
                    <th><b>Precio de Venta</b></th>
                    <th><b>Entradas</b></th>
                    <th><b>Salidas</b></th>
                    <th><b>Cantidad Existente</b></th>
                    <th><b>Total P.Compra</b></th>
                    <th><b>Total P.Venta</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach($query as $producto)
                <tr>
                    <td><b>{{$producto->Id}}</b></td>
                    <td><b>{{$producto->Codigo_SKU}}</b></td>
                    <td><b>{{$producto->Descripcion}}</b></td>
                    <td><b>{{$producto->Marca}}</b></td>
                    <td><b>{{$producto->Peso}}</b></td>
                    <td><b>{{$producto->Animal}}</b></td>
                    <td><b>{{$producto->Tipo_Alimento}}</b></td>
                    <td><b>{{$producto->Peso}}</b></td>
                    <td><b>{{$producto->Categoria}}</b></td>
                    <td><b>${{number_format($producto->Precio_Compra,2)}}</b></td>
                    <td><b>${{number_format($producto->Precio_Venta,2)}}</b></td>
                    <td><b>{{$producto->Entradas}}</b></td>
                    <td><b>{{$producto->Salidas}}</b></td>
                    <td><b>{{$producto->Cantidad_Existente}}</b></td>
                    <td><b>${{number_format($producto->Valor_Compra,2)}}</b></td>
                    <td><b>${{number_format($producto->Valor_Venta,2)}}</b></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <form method="POST" action="{{ route('export')}}">
            @method('PUT')
            @csrf
            <input type="hidden" name="mivar" value="select Id,Codigo_SKU,Descripcion,Categoria,Tipo_Alimento,Animal,Marca,Peso,Precio_Compra,Precio_Venta,Entradas,Salidas,Cantidad_Existente,Valor_Compra,Valor_Venta from storehouse">
            <button type="submit" class="btn btn-outline-success">Descargar Inventario &nbsp <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="margin: 0% -1% 0% 0%;">
                    <path fill-rule="evenodd" d="M.5 8a.5.5 0 0 1 .5.5V12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V8.5a.5.5 0 0 1 1 0V12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8.5A.5.5 0 0 1 .5 8z" />
                    <path fill-rule="evenodd" d="M5 7.5a.5.5 0 0 1 .707 0L8 9.793 10.293 7.5a.5.5 0 1 1 .707.707l-2.646 2.647a.5.5 0 0 1-.708 0L5 8.207A.5.5 0 0 1 5 7.5z" />
                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0v-8A.5.5 0 0 1 8 1z" />
                </svg></button>
        </form>
    </div> <br><br>
</body>

</html>