@extends('layouts.app')
@section('content')
<h1>Productos Vendidos</h1>
<div class="table-responsive">
    <table class="table table-hover table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Nombre de Producto</th>
                <th>Código de barras o Codigo SKU</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($queryDetalle as $producto)
            <tr>
                <td>{{$producto->Nombre_Producto}}</td>
                <td>{{$producto->Codigo_Sku}}</td>
                <td>{{$producto->Precio}}</td>
                <td>{{$producto->Cantidad}}</td>
                <td>{{$producto->Total}} MXN</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>

            <tr>
                @foreach($queryTotal as $value)
                <td colspan="3"></td>
                <td><strong>Total de la Venta</strong></td>
                <td><strong>$ {{$value->Total}} MXN</strong></td>
                @endforeach
            </tr>
        </tfoot>
    </table>
</div>
@endsection