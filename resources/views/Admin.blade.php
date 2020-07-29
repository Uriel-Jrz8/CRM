@extends('layouts.adminheader')
@section('admin')


<div class="container">
    <div class="shadow-lg p-3 mb-5 bg-white rounded">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>
                    <div>
                        <!-- @if (session('status')) -->
                            <div class="alert alert-success" role="alert">
                            <!-- {{ session('status') }} -->
                            </div>
                        <!-- @endif -->
                    </div>
                </div>
            </div>
        </div>
        <form method="GET" action="{{ route('register') }}">
                @method('HEAD')
                @csrf
                <br>
                <input type="submit" value="Registrar un Nuevo Usuario" class="btn btn-outline-success btn-lg btn-block">
            </form>

            <form method="GET" action="{{ route('AdminStock') }}">
                @method('HEAD')
                @csrf
                <br>
                <input type="submit" value="Agregar Stock en Sucursal" class="btn btn-outline-success btn-lg btn-block">
            </form>
 
            <form method="POST" action="{{ route('ConsultDato') }}">
                @method('PUT')
                @csrf
                <br>
                <input type="submit" value="Tienda en Línea" class="btn btn-outline-success btn-lg btn-block">
            </form>

            <form method="POST" action="{{ route('ConsultCDMX') }}">
                @method('PUT')
                @csrf
                <br>
                <input type="submit" value="Tienda en Ciudad de México" class="btn btn-outline-success btn-lg btn-block">
            </form>

            <form method="POST" action="{{ route('ConsultAcapulco') }}">
                @method('PUT')
                @csrf
                <br>
                <input type="submit" value="Tienda en Acapulco" class="btn btn-outline-success btn-lg btn-block">
            </form>

    </div>
</div>


@endsection