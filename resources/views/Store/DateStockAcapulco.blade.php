@extends('layouts.Linea')

@section('content')
<!-- <div class="container"> -->
    <!-- <div class="shadow-lg p-2 mb-5 bg-white rounded"> -->
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
            <H1 style="font-family: Fredoka One;">{{ __('Productos en Almacen') }} </H1>
            <br>
        </div>
        <!-- nuevo -->
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                @forelse ($query as $query)
                @if ($loop->first)
                <thead class="thead-dark">
                    <tr>
                    <th><center>Identificador</center></th>
                        <th><center>Codigo SKU</center></th>
                        <th>Descripcion de Producto</th>
                        <th><center>Categoria</center></th>
                        <th><center>Tipo de Alimento</center></th>
                        <th><center>Animal</center></th>
                        <th><center>Marca</center></th>
                        <th><center>Peso</center></th>
                        <th><center>Precio Unitario MXN</center></th>
                        <th><center>Cantidad Existente</center></th>
                        <th><center>Descuento Aplicado MXN</center></th>
                        <th><center>Porcentaje Aplicado % </center></th>
                        <!-- <th>Eliminar</th> -->
                    </tr>
                </thead>
                @endif
                <tbody>
                    <tr>@foreach ($query as $key => $value )
                        <center>
                            <td><b>{{$value}}</b></td>
                        </center>
                        @endforeach
                    </tr>
                </tbody>
                @empty
                No hay Resultados Datos
                @endforelse
            </table>
            <form method="POST" action="{{ route('export')}}">
            @method('PUT')
            @csrf
            <input type="hidden" name="mivar" value="select Id,Codigo_SKU,Descripcion,Categoria,Tipo_Alimento,Animal,Marca,Peso,Precio_Venta,Cantidad_Existente,Descuento,Porcentaje from stock_acapulco">
            <button type="submit" class="btn btn-outline-success">Descargar Inventario &nbsp <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="margin: 0% -1% 0% 0%;">
                    <path fill-rule="evenodd" d="M.5 8a.5.5 0 0 1 .5.5V12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V8.5a.5.5 0 0 1 1 0V12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8.5A.5.5 0 0 1 .5 8z" />
                    <path fill-rule="evenodd" d="M5 7.5a.5.5 0 0 1 .707 0L8 9.793 10.293 7.5a.5.5 0 1 1 .707.707l-2.646 2.647a.5.5 0 0 1-.708 0L5 8.207A.5.5 0 0 1 5 7.5z" />
                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0v-8A.5.5 0 0 1 8 1z" />
                </svg></button>
        </form>
        </div><br><br>
        <!-- <form method="POST" action="{{ route('export')}}">
            @method('PUT')
            @csrf
            <input name="mivar" value= "">
            <button type="submit" class="btn btn-outline-success">Descargar Ventas &nbsp<svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="margin: 0% -1% 0% 0%;">
                    <path fill-rule="evenodd" d="M.5 8a.5.5 0 0 1 .5.5V12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V8.5a.5.5 0 0 1 1 0V12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8.5A.5.5 0 0 1 .5 8z" />
                    <path fill-rule="evenodd" d="M5 7.5a.5.5 0 0 1 .707 0L8 9.793 10.293 7.5a.5.5 0 1 1 .707.707l-2.646 2.647a.5.5 0 0 1-.708 0L5 8.207A.5.5 0 0 1 5 7.5z" />
                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0v-8A.5.5 0 0 1 8 1z" />
                </svg></button>
        </form> -->
    <!-- </div> -->
<!-- </div> -->
@endsection