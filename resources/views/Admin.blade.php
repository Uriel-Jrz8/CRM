@extends('layouts.adminheader')
@section('admin')


<div class="container">

    <div class="row justify-content-center">

        <div class= "slideUp">
            <img src="/Images/perroNegro.png" class="img-fluid" style="margin: -3% 0% 10%;height: 450px;" >
            </div>
            <div class="col-md-4" style="margin: 0% 10% 0%;">
            
                
                <div class="buttonWrapper">
                    Registrar Usuario
                <a class="buttonInner  " href="{{ route('register') }}"><span>Registrar Usuario</span></a>
                </div><br>

                <div class="buttonWrapper">
                Agregar Productos
                <a class="buttonInner  " href="{{ route('AdminStock') }}"><span>Agregar Productos</span></a>
                </div><br>

                <div class="buttonWrapper">
                Ventas en Línea
                <a class="buttonInner  " href="{{ route('Dateline') }}"><span>Ventas en Línea</span></a>
                </div><br>

                <div class="buttonWrapper">
                Ventas Cd. de Mexico
                <a class="buttonInner  " href="{{ route('DateCdmx') }}"><span>Ventas Ciudad de México</span></a>
                </div><br>

                <div class="buttonWrapper">
                Ventas Acapulco
                <a class="buttonInner  " href="{{ route('DateAcapulco') }}"><span>Ventas Acapulco</span></a>
                </div>
            </div>
    </div>
</div>


@endsection