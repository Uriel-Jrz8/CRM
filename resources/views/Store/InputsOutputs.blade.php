@extends('layouts.app')
@section('content')
<center>
    <h1 style="font-family: Fredoka One;">Productos</h1>
</center><br>

<div class="container-fluid">
    <form action="">
        <div class="form-group row justify-content">
            <div class="col-xs-8 col-sm-2">
            <b><label style="color: #000" for="exampleInput1">Fecha</label></b>
                <input type="date" class="form-control1" name="date1" placeholder="Año-Mes-Dia" autocomplete="off" required>
            </div><br><br>
            <div class="col-xs-8 col-sm-2">
            <b><label style="color: #000" for="exampleInput1">Fecha</label></b>
                <input type="date" class="form-control1" name="dete2" placeholder="Año-Mes-Dia" autocomplete="off" required>
            </div><br><br>  
            <div class="col-sm-center col-xs-center">
                
            </div>
            
        </div>
        <button class="btn btn-outline-pink" style="margin: 0% 0% 0% 10%">Buscar por Fecha</button>
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