@extends('layouts.app')

@section('content')
<div class="container">
<div class="shadow-lg p-3 mb-5 bg-white rounded">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <H1>{{ __('Ingresa tus Pedidos') }} </H1> 
      <br>
    </div>
 <br>
    <form>
      <div class="form-row">
        <div  class="col-xs-12 col-sm-2">
          <label class="text-info" for="exampleInput1">Número de Pedido</label>
          <input type="text" class="form-control" id="exampleInput1" placeholder="Número de Pedido">
        </div>

        <div class="col-xs-12 col-sm-2">
          <label class="text-info" for="exampleInput1">Nombre del Producto</label>
          <input type="text" class="form-control" id="exampleInput1" placeholder="Nombre del Producto">
        </div>

        <div class="col-xs-12 col-sm-2">
          <label class="text-info" for="exampleInput1">Precio Unitario</label>
          <input type="text" class="form-control" id="exampleInput1" placeholder="Precio Unitario">
        </div>

        <div class="col-xs-12 col-sm-2">
          <label class="text-info" for="exampleInput1">Código SKU</label>
          <input type="text" class="form-control" id="exampleInput1" placeholder="Código SKU">
        </div>

        <div class="col-xs-12 col-sm-2">
          <label class="text-info" for="exampleInput1">Número de Guía</label>
          <input type="text" class="form-control" id="exampleInput1" placeholder="Número de Guía">
        </div>

        <div class="col-xs-12 col-sm-2">
          <label class="text-info" for="exampleInput1">Cantidad de Productos</label>
          <input type="text" class="form-control" id="exampleInput1" placeholder="Cantidad de Productos">
        </div>

        <div class="col-xs-12 col-sm-2">

          <label class="text-info" for="exampleInput1">Precio Total</label>
          <input type="text" class="form-control" id="exampleInput1" placeholder="Precio Total">
        </div>

        <div class="col-xs-12 col-sm-2">
          <label class="text-info" for="exampleInput1">Status del Pedido</label>
          <input type="text" class="form-control" id="exampleInput1" placeholder="Status del Pedido">
        </div>
    </form>
</div>
<br>
        <button type="button" class="btn btn-outline-info">Agregar Pedido</button>
<div>

@endsection
