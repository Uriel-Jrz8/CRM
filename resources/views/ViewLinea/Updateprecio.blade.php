@extends('layouts.header')
@section('header')
<script>
  function validaNumericos(event) {
    if (event.charCode >= 46 && event.charCode <= 57) {
      return true;
    }
    return false;
  }
</script>

<div class="container">
  <div class=" shadow-lg p-4 mb-5 bg-white rounded">

    <center>
      <h1 style="background-color:black; color:white;">Bodega Merkado Croqueta</h1>
    </center><br>
    @if (session('message'))
    <div class="alert alert-success" role="alert">
      {{ session('message') }}
    </div>
    @endif
    @if (session('message2'))
    <div class="alert alert-danger" role="alert">
      {{ session('message2') }}
    </div>
    @endif


    <form method="POST" action="{{route('descuento2')}}">
      @method('PUT')
      @csrf
      <H3 style="color: #DE2692">{{ __('Aplicar Descuento') }} </H3>
      <div class="form-row">

        <div class="col-xs-8 col-sm-3"> <b><label style="color: #000" for="exampleInput1">Marca del Producto ó Código SKU</label></b>
          <input type="text" class="form-control1" name="desmarca" placeholder="Marca ó Código SKU" autocomplete="off" required>
        </div>
        <div class="col-xs-8 col-sm-3"> <b><label style="color: #000" for="exampleInput1">Descuento %</label></b>
          <input type="text" class="form-control1" name="des" placeholder="Descuento %" autocomplete="off" required onkeypress="return validaNumericos(event)">
        </div>

        <div class="col-xs-8 col-sm-3"> <b><label style="color: #000" for="exampleInput1">Sucursal</label></b> <select name="sucursal" class="form-control1">
            <option>Selecciona Sucursal</option>
            <option>En Linea</option>
            <option>Acapulco</option>
            <option>Ciudad de Mexico</option>
          </select> </div>
      </div><br>
      <center><button class="btn btn-outline-pink">Aplicar Descuento &nbsp <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-percent" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M13.442 2.558a.625.625 0 0 1 0 .884l-10 10a.625.625 0 1 1-.884-.884l10-10a.625.625 0 0 1 .884 0zM4.5 6a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm7 6a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
          </svg>

        </button></center>
    </form><br><br>

    <form method="POST" action="{{route('UpdatePrecio2')}}">
      @method('PUT')
      @csrf
      <br>
      <H3 style="color: #DE2692">{{ __('Modificar Precio') }} </H3>
      <div class="form-row">
        <!-- <div class="col-xs-8 col-sm-3"> <b><label style="color: #DE2692" for="exampleInput1">Nombre del Producto</label></b>
          <input type="text" class="form-control1" name="nombre" placeholder="Nombre Producto" autocomplete="off" required> </div> -->

        <div class="col-xs-8 col-sm-3"> <b><label style="color: #000" for="exampleInput1">Codigo Sku</label></b>
          <input type="text" class="form-control1" name="sku" placeholder="Codigo SKU" autocomplete="off" required> </div>

        <div class="col-xs-8 col-sm-2"> <b><label style="color: #000" for="exampleInput1">Identificador Producto</label></b>
          <input type="text" class="form-control1" name="id" placeholder="Identificador Producto" autocomplete="off" required onkeypress="return validaNumericos(event)"> </div>

        <div class="col-xs-8 col-sm-2"> <b><label style="color: #000" for="exampleInput1">Precio Producto</label></b>
          <input type="text" class="form-control1" name="precio" placeholder="$ MXN" required autocomplete="off" onkeypress="return validaNumericos(event)"> </div>

        <div class="col-xs-8 col-sm-2.5"> <b><label style="color: #000" for="exampleInput1">Precio Compra ó Precio Venta</label></b> <select name="opc" class="form-control1">
            <option>Selecciona una Opción</option>
            <option>Precio Compra</option>
            <option>Precio Venta</option>
          </select>
        </div>&nbsp &nbsp

        <div class="col-xs-8 col-sm-2.5"> <b><label style="color: #000" for="exampleInput1">Sucursal</label></b> <select name="sucursal" class="form-control1">
            <option>Selecciona Sucursal</option>
            <option>Almacen General</option>
            <option>En Linea</option>
            <option>Ciudad de Mexico</option>
            <option>Acapulco</option>
          </select>
        </div>
      </div>

      <br>
      <center><button class="btn btn-outline-pink"> Modificar Precio &nbsp <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-check-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
            <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z" />
          </svg></button> </center>
      <!-- style="color: #DE2692; border-color:#DE2692;" -->
    </form><br><br>
  </div>
</div>
@endsection