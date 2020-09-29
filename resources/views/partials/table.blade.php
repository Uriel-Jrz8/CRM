@extends('layouts.app')
@section('content')
<!-- <div class="table-responsive ">
<table class="table table-hover">
    @forelse ($query as $query)
        @if ($loop->first)
            <thead class="thead-dark">
                <tr>
                    @foreach ($query as $key => $value )
                        <th>{{$key}}</th>
                    @endforeach
                    <th><b>Código SKU</b></th>
                    <th><b>Descripcion de Producto</b></th>
                    <th><b>Marca</th>
                    <th><b>Animal</b></th>
                    <th><b>Tipo Alimento</b></th>
                    <th><b>Peso</b></th>
                    <th><b>Categoría</b></th>
                    <th><b>Precio de Compra</b></th>
                    <th><b>Precio de Venta</b></th>
                    <th><b>Existencias Iniciales</th>
                    <th><b>Entradas</b></th>
                    <th><b>Salidas</b></th>
                    <th><b>Cantidad Existente</b></th>
                    <th><b>Total P.Compra</b></th>
                    <th><b>Total P.Venta</b></th>
                </tr>
            </thead>
        @endif
        <tbody>
            <tr>@foreach ($query as $key => $value )
                    <th>{{$value}}</th>
                @endforeach
            </tr>
        </tbody>
    @empty
        <center> <h1>No hay Resultados </h1> </center>
    @endforelse
</table>
</div> -->
<div class="table-responsive ">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th><b>Código SKU</b></th>
                    <th><b>Descripcion de Producto</b></th>
                    <th><b>Marca</th>
                    <th><b>Animal</b></th>
                    <th><b>Tipo Alimento</b></th>
                    <th><b>Peso</b></th>
                    <th><b>Categoría</b></th>
                    <th><b>Precio de Compra</b></th>
                    <th><b>Precio de Venta</b></th>
                    <th><b>Existencias Iniciales</th>
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
                    <td><b>{{$producto->Codigo_SKU}}</b></td>
                    <td><b>{{$producto->Descripcion}}</b></td>
                    <td><b>{{$producto->Marca}}</b></td>
                    <td><b>{{$producto->Animal}}</b></td>
                    <td><b>{{$producto->Tipo_Alimento}}</b></td>
                    <td><b>{{$producto->Peso}}</b></td>
                    <td><b>{{$producto->Categoria}}</b></td>
                    <td><b>${{number_format($producto->Precio_Compra,2)}}</b></td>
                    <td><b>${{number_format($producto->Precio_Venta,2)}}</b></td>
                    <td><b>{{$producto->Existencias_Iniciales}}</b></td>
                    <td><b>{{$producto->Entradas}}</b></td>
                    <td><b>{{$producto->Salidas}}</b></td>
                    <td><b>{{$producto->Cantidad_Existente}}</b></td>
                    <td><b>${{number_format($producto->Valor_Compra,2)}}</b></td>
                    <td><b>${{number_format($producto->Valor_Venta,2)}}</b></td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>
@endsection