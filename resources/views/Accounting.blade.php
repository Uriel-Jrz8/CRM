@extends('layouts.header')
@section('header')

<div class="container">

    <div class="row justify-content">
        <div class= "slideUp">
            <img src="/Images/perroNegro.png" class="img-fluid" style="margin: 0% 0% 0% 6%;height: 450px;" >
        </div>

        <div class="col-md-4" style="margin: 0% 12% 0%;">
            <div class="buttonWrapper2">
                Ventas en Línea
                <a class="buttonInner2 " href="{{ route('ConsultDato')}}"> <span>Ventas en Línea</span></a>
            </div><br>

            <div class="buttonWrapper2">Ventas en Ciudad de México
                <a class="buttonInner2 " href=" route('ConsultCDMX')}}"> <span>Ventas en Ciudad de México</span></a>
            </div><br>

            <div class="buttonWrapper2">Ventas en Acapulco
                <a class="buttonInner2 " href=" route('ConsultAcapulco')}}"> <span>Ventas en Acapulco</span></a>
            </div><br>

            <div class="buttonWrapper2">Productos en Linea
                <a class="buttonInner2 " href=" route('ConsultAcapulco')}}"> <span>Productos en Linea</span></a>
            </div><br>

            <div class="buttonWrapper2">Productos en Ciudad de México
                <a class="buttonInner2 " href=" route('ConsultAcapulco')}}"> <span>Productos en Ciudad de México</span></a>
            </div><br>

            <div class="buttonWrapper2">Productos en Acapulco
                <a class="buttonInner2 " href=" route('ConsultAcapulco')}}"> <span>Productos en Acapulco</span></a>
            </div><br>
        </div>
    </div>
</div>
@endsection