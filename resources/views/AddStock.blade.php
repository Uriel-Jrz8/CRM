@extends('layouts.header')
@section('header')


<div class="container">
    <div class=" shadow-lg p-4 mb-5 bg-white rounded">
        <div class="row justify-content-center center">
            <div class="col-md-8">
               
                    <div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                            </div>
                        @endif
                    </div>
                
            </div><H1>{{ __('Agregar Productos a la Bodega') }} </H1>
        </div>
         
    
    <form method="POST" action="{{route('Addline')}}">
    @method('PUT')
        @csrf

        <!-- <div  class="col-xs-12 col-sm-2">
        <b><label class="text-info" for="exampleInput1">Número de Pedido</label></b>
          <input type="text" class="form-control" name='pedido' autocomplete="off"
                 placeholder="Número de Pedido" required onkeypress="return validaNumericos(event)">
        </div> -->

        <div class="col-xs-12 col-sm-8">
        <b><label class="text-info" for="exampleInput1">Nombre del Producto</label></b>
          <input type="text" class="form-control" name='nombre' autocomplete="off"
                 placeholder="Nombre del Producto" required>
        </div>

        <div class="col-xs-12 col-sm-8">
        <b><label class="text-info" for="exampleInput1">Marca</label></b>
          <select name="marca" class="form-control" required>
          <option>Purina</option>
          <option>Eukanuba</option>
          <option>Royal Canin</option>
          <option>Hill´s</option>
          <option>Fulltrust</option>
          <option>Nupec</option>
          <option>Instict</option>
          <option>Diamond</option>
          <option>Sportmix Wholesomes</option>
          </select>
        </div>

        <div class="col-xs-12 col-sm-8">
         <b><label class="text-info" for="exampleInput1">Unidad de Medida</label></b>
          <select name="unidad" class="form-control" required>
          <option>1kg</option>
          <option>2kg</option>
          <option>3kg</option>
          </select>
        </div>

        <div class="col-xs-12 col-sm-8">
        <b><label class="text-info" for="exampleInput1">Precio Unitario</label></b>
          <input type="text" class="form-control" name='precio' autocomplete="off"
                 placeholder="Precio Unitario" required  onkeypress="return validaNumericos(event)" >
        </div>

        <div class="col-xs-12 col-sm-8">
        <b><label class="text-info" for="exampleInput1">Código SKU</label></b>
          <input type="text" class="form-control" name='sku' autocomplete="off"
                 placeholder="Código SKU" required>
        </div>

        <!-- <div class="col-xs-12 col-sm-2">
        <b><label class="text-info" for="exampleInput1">Número de Guía</label></b>
          <input type="text" class="form-control" name='guia' autocomplete="off"
                 placeholder="Número de Guía" required>
        </div> -->

        <div class="col-xs-12 col-sm-8">
        <b><label class="text-info" for="exampleInput1">Cantidad de Productos</label></b>
          <input type="text" class="form-control" name='cantidad' autocomplete="off"
                 placeholder="Cantidad de Productos" required onkeypress="return validaNumericos(event)">
        </div>

        <div class="col-xs-12 col-sm-8">
        <b><label class="text-info" for="exampleInput1">Tienda</label></b>
          <select name="sucursal" class="form-control" required>
          <option>En Línea</option>
          <option>Acapulco</option>
          <option>Ciudad de México</option>
          </select> 
        </div> <br>

        <!-- <div class="col-xs-12 col-sm-2">
        <b><label class="text-info" for="exampleInput1">Precio Total</label></b>
          <input type="text" class="form-control" name='total' autocomplete="off"
                 placeholder="Precio Total" required onkeypress="return validaNumericos(event)">
        </div> -->

        <!-- <div class="col-xs-12 col-sm-2">
        <b><label class="text-info" for="exampleInput1">Estatus del Pedido</label></b>
          <select name="estatus" class="form-control" required>
          <option>Entregado</option>
          <option>Pendiente</option>
          <option>Cancelado</option>
          </select>
          <br>
        </div> -->

        <div class="col-xs-12 col-sm-12">
        <center><input type="submit" value="Agregar Producto" class="btn btn-outline-info"></center>
         </form><br>

              <form action="{{ route('ConsultDato') }}" method="POST">
              @method('PUT')
              @csrf
              <center><input type="submit" value="Acceder a Bodega" class="btn btn-outline-info"></center>
              </form>
         </div>
    </div>
</div>


@endsection