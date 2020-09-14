@extends('layouts.app')
@section('content')
<h1>Productos Vendidos</h1>
<div class="table-responsive ">
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th><b>Cantidad</b></th>
                <th><b>Nombre de Producto</b></th>
                <th><b>Código SKU</th>
                <th><b>Precio Unitario</b></th>
                <!-- <th><b>Subtotal Sin Descuento</b></th> -->
                <th><b>Descuento Aplicado</b></th>
                <th><b>Subtotal</b></th>
            </tr>
        </thead>
        <tbody>
            @foreach($queryDetalle as $producto)
            <tr>
                <td><b>{{$producto->Cantidad}}</b></td>
                <td><b>{{$producto->Nombre_Producto}}</b></td>
                <td><b>{{$producto->Codigo_SKU}}</b></td>
                <td><b>$ {{number_format($producto->Precio,2)}} MXN</b></td>
                <!-- <td><b>$ {{number_format($producto->Subtotal,2)}} MXN</b></td> -->
                <td><b>$ {{number_format($producto->Descuento,2)}} MXN</b></td>
                <td><b>$ {{number_format($producto->Total,2)}} MXN</b></td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>

            <tr>
                @foreach($queryTotal as $value)
                <td colspan="4"></td>
                <td><strong><h4>Total de la Venta</h4></strong></td>
                <td><b><h4>$ {{number_format($value->Total,2)}} MXN</h4></b></td>
                @endforeach
            </tr>
        </tfoot>
    </table>
</div>
@endsection