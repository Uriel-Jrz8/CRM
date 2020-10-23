@extends('layouts.header')
@section('header')

<div class="container">

    <div class="row justify-content">
        <div class= "slideUp">
            <img src="/Images/PerroNegro.png" class="img-fluid" style="margin: 0% 0% 0% 6%;height: 450px;" >
        </div>

        <div class="col-md-4" style="margin: 0% 12% 0%;">
            <div class="buttonWrapper2">Ventas en Línea
                <a class="buttonInner2" href="{{ route('Dateline')}}"> <span>Ventas en Línea</span></a>
            </div><br>

            <div class="buttonWrapper2">Ventas en Ciudad de México
                <a class="buttonInner2" href="{{route('DateCdmx')}}"> <span>Ventas en Ciudad de México</span></a>
            </div><br>

            <div class="buttonWrapper2">Ventas en Acapulco
                <a class="buttonInner2" href="{{route('DateAcapulco')}}"> <span>Ventas en Acapulco</span></a>
            </div><br>

            <div class="buttonWrapper2">Productos en Linea
                <a class="buttonInner2" href="{{route('stocklinea')}}"> <span>Productos en Linea</span></a>
            </div><br>

            <div class="buttonWrapper2">Productos en Ciudad de México
                <a class="buttonInner2" href="{{route('stockcdmx')}}"> <span>Productos en Ciudad de México</span></a>
            </div><br>

            <div class="buttonWrapper2">Productos en Acapulco
                <a class="buttonInner2" href="{{route('stockacapulco')}}"> <span>Productos en Acapulco</span></a>
            </div><br>
            <div class="buttonWrapper2">Almacen General
                <a class="buttonInner2" href="{{route('storehouse')}}"> <span>Almacen General</span></a>
            </div><br>
        </div>
    </div>
</div>
@endsection