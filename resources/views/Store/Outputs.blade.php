@extends('layouts.app')
@section('content')
<center>
    <h1 style="font-family: Fredoka One;">Productos</h1>
</center>
<div class="container-fluid">
    <form  action="{{route('filtroSalidas')}}" method="GET">
    @method('HEAD')
          @csrf
        <div class="form-group row justify-content">
            <div class="col col-sm-2">
                <center> <b><label style="color: #000" for="exampleInput1">Fecha Inicial</label></b></center>
                <input type="text" class="form-control11" name="date1" placeholder="Año-Mes-Dia  &#xf073;" autocomplete="off" required>
            </div><br><br>
            <div class="col col-sm-2">
                <center><b><label style="color: #000" for="exampleInput1">Fecha Final</label></b> </center>
                <input type="text" class="form-control11" name="date2" placeholder="Año-Mes-Dia  &#xf073;" autocomplete="off" required>
            </div><br><br>
        </div>
        
        <div class="col col-sm-4">
            <center>
        <button class="btn btn-outline-pink" style="margin: 0% 0% 0% 0%">Buscar por Fecha</button></center>
        </div>
    </form>
</div>
<br>

<div class="table-responsive">
    <table class="table table-hover table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th><b>Código SKU</th>
                <th><b>Nombre de Producto</b></th>
                <th><b>Marca</b></th>
                <th><b>Animal</th>
                <th><b>Tipo Alimento</b></th>
                <th><b>Peso</b></th>
                <th><b>Categoría</b></th>
                <th><b>Cantidad</b></th>
                <th><b>Sucursal</b></th>
                <th><b>Fecha</b></th>
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
                <td><b>{{$producto->Cantidad}}</b></td>
                <td><b>{{$producto->Sucursal}}</b></td>
                <td><b>{{$producto->created_at}}</b></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection