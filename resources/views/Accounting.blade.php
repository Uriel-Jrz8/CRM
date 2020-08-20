@extends('layouts.header')
@section('header')

<div class="container">
    <div class="shadow-lg p-3 mb-5 bg-white rounded">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <H1>{{ __('Datos por Sucursal') }} </H1>


                <div class="container">
                    <form method="POST" action="{{ route('ConsultDato')}}">
                        @method('PUT')
                        @csrf
                        <br>
                        <input type="submit" value="Pedidos Realizados en Línea" class="btn btn-outline-success btn-lg btn-block">
                    </form>

                    <form method="POST" action="{{ route('ConsultCDMX')}}">
                        @method('PUT')
                        @csrf
                        <br>
                        <input type="submit" value="Pedidos Realizados en Ciudad de México" class="btn btn-outline-success btn-lg btn-block">
                    </form>

                    <form method="POST" action="{{ route('ConsultAcapulco')}}">
                        @method('PUT')
                        @csrf
                        <br>
                        <input type="submit" value="Pedidos Realizados en Acapulco" class="btn btn-outline-success btn-lg btn-block">
                    </form>

                    <form method="POST">
                        @method('PUT')
                        @csrf
                        <br>
                        <input type="submit" value="Productos en Linea" class="btn btn-outline-success btn-lg btn-block">
                    </form>

                    <form method="POST">
                        @method('PUT')
                        @csrf
                        <br>
                        <input type="submit" value="Productos en Ciudad de México" class="btn btn-outline-success btn-lg btn-block">
                    </form>

                    <form method="POST">
                        @method('PUT')
                        @csrf
                        <br>
                        <input type="submit" value="Productos en Acapulco" class="btn btn-outline-success btn-lg btn-block">
                    </form>
                    <br>
                    <!-- Metodo para mostrar la tabla con los datos requeridos-->
                    @isset($query)
                    @include('partials.table', $query)
                    @endisset

                    <!-- Metodo para Descargar los datos en un formato excel-->
                    @isset($query)
                    @if(count($query) > 0 )

                    <form method="POST" action="{{ route('export')}}">
                        @method('PUT')
                        @csrf
                        <br>
                        <input type="submit" value="Descargar Excel" class="btn btn-outline-success">
                        <!-- <a class="btn btn-outline-danger" href="{{ route('PDF') }}">Descargar PDF</a>-->
                    </form>
                    @else
                    <h1>
                        <center>¡No hay Pedidos!</center>
                    </h1>
                    @endif
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@endsection