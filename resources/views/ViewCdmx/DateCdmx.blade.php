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
            <H1>{{ __('Ventas Ciudad de México') }} </H1>
            <br>
        </div>
        <!-- nuevo -->
        <div class="table-responsive">
            <table class="table table-hover ">
                @forelse ($query as $query)
                @if ($loop->first)
                <thead class="thead-dark">
                    <tr>
                        <th><center>Fecha de Venta</center></th>
                        <th><center>Total de la Venta (MXN)</center></th>
                        <th><center>Numero de Venta</center></th>
                        <th><center>Ticket de la Venta</center></th>
                        <th><center>Información de la Venta</center></th>
                        <!-- <th>Eliminar</th> -->
                    </tr>
                </thead>
                @endif
                <tbody>
                    <tr>@foreach ($query as $key => $value )
                        <center>
                            <td><b><center>{{$value}}</center></b></td>
                        </center>
                        @endforeach
                        <td>
                            <button class="btn btn-outline-info"> Ticket de Venta &nbsp
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 1h5v1H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V6h1v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2z" />
                                    <path d="M9 4.5V1l5 5h-3.5A1.5 1.5 0 0 1 9 4.5z" />
                                </svg>
                            </button>
                        </td>

                        <td>
                            <form action="{{route('DetalleCdmx')}}" method="POST">
                                @method("PUT")
                                @csrf
                                <button class="btn btn-outline-success"> Detalle de Venta &nbsp
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                    </svg>
                                </button>
                                <input type="text" value="{{$value}}" name="folioVenta" hidden>
                            </form>
                        </td>
                    </tr>
                </tbody>
                @empty
                <!-- No hay Resultados -->
                @endforelse

            </table>
        </div>
        <form method="POST" action="{{ route('export')}}">
            @method('PUT')
            @csrf
            <input type="hidden" name="mivar" value="Select Folio,Codigo_SKU,Descripcion,Categoria,Tipo_Alimento,Animal,Marca,Peso,Precio_Venta,Cantidad,Subtotal,Descuento,Porcentaje,Total,Created_at from orders_cdmx;">
            <button type="submit" class="btn btn-outline-success">Descargar Ventas &nbsp<svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="margin: 0% -1% 0% 0%;">
                    <path fill-rule="evenodd" d="M.5 8a.5.5 0 0 1 .5.5V12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V8.5a.5.5 0 0 1 1 0V12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8.5A.5.5 0 0 1 .5 8z" />
                    <path fill-rule="evenodd" d="M5 7.5a.5.5 0 0 1 .707 0L8 9.793 10.293 7.5a.5.5 0 1 1 .707.707l-2.646 2.647a.5.5 0 0 1-.708 0L5 8.207A.5.5 0 0 1 5 7.5z" />
                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0v-8A.5.5 0 0 1 8 1z" />
                </svg></button>
        </form>
    </div>
</div>
@endsection