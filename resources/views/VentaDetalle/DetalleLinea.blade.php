@extends('layouts.app')
@section('content')
<h1>Productos Vendidos</h1>
<div class="table-responsive">
    <table class="table table-hover table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th><b>Cantidad</b></th>
                <th><b>Nombre de Producto</b></th>
                <th><b>Código SKU</th>
                <th><b>Precio por Artículo</b></th>
                <th><b>Subtotal</b></th>
            </tr>
        </thead>
        <tbody>
            @foreach($queryDetalle as $producto)
            <tr>
                <td><b>{{$producto->Cantidad}}</b></td>
                <td><b>{{$producto->Nombre_Producto}}</b></td>
                <td><b>{{$producto->Codigo_Sku}}</b></td>
                <td><b>{{$producto->Precio}}</b></td>
                <td><b>{{$producto->Total}} MXN</b></td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>

            <tr>
                @foreach($queryTotal as $value)
                <td colspan="3"></td>
                <td><strong><h4>Total de la Venta</h4></strong></td>
                <td><b><h4>$ {{$value->Total}} MXN</h4></b></td>
                @endforeach
            </tr>
        </tfoot>
    </table>
</div>
@endsection