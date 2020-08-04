@extends('layouts.header')
@section('header')
<script>
function validaNumericos(event) {
    if(event.charCode >= 46 && event.charCode <= 57){
      return true;
     }
     return false;        
}
</script>

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
         
        <!-- Addline -->
    <form method="POST" action="{{route('addstock')}}">
    @method('PUT')
        @csrf

        <div  class="col-xs-12 col-sm-8">
        <b><label class="text-info" for="exampleInput1">Identificador Pedido</label></b>
          <input type="text" class="form-control" name='id' autocomplete="off"
                 placeholder="Número de Pedido" required onkeypress="return validaNumericos(event)">
        </div>

        <div class="col-xs-12 col-sm-8">
        <b><label class="text-info" for="exampleInput1">Nombre del Producto</label></b>
          <input type="text" class="form-control" name='nombre' autocomplete="off"
                 placeholder="Nombre del Producto" required>
        </div>

        <div class="col-xs-12 col-sm-8">
        <b><label class="text-info" for="exampleInput1">Marca del Producto</label></b>
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
         <b><label class="text-info" for="exampleInput1">Tipo de Animal</label></b>
          <select name="animal" class="form-control" required>
          <option>Perro</option>
          <option>Gato</option>
          </select>
        </div>

        <div class="col-xs-12 col-sm-8">
        <b><label class="text-info" for="exampleInput1">Peso en Kilogramos</label></b>
        <input type="text" class="form-control" name='unidad' autocomplete="off" placeholder="Peso" required>
        </div>

        <div class="col-xs-12 col-sm-8">
         <b><label class="text-info" for="exampleInput1">Categoría</label></b>
          <select name="categoria" class="form-control" required>
          <option>Alimento</option>
          <option>Salud e Higiene</option>
          <option>Accesorios</option>
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

        <div class="col-xs-12 col-sm-8">
        <b><label class="text-info" for="exampleInput1">Cantidad de Productos</label></b>
          <input type="text" class="form-control" name='cantidad' autocomplete="off"
                 placeholder="Cantidad de Productos" required onkeypress="return validaNumericos(event)">
        </div>

        <div class="col-xs-12 col-sm-8">
        <b><label class="text-info" for="exampleInput1">Tienda</label></b>
          <select name="sucursal" class="form-control" required>
          <option>En Linea</option>
          <option>Acapulco</option>
          <option>Ciudad de Mexico</option>
          </select> 
        </div> <br>

        <div class="col-xs-12 col-sm-12">
            <center><input type="submit" value="Agregar Producto" class="btn btn-outline-info"></center>
            </form>

              <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
              @method('PUT')
              @csrf
              <H3>{{ __('Importar Productos') }} </H3>

              <div class="col-xs-8 col-sm-3">
              <b><label class="text-info" for="exampleInput1">Sucursal</label></b>
              <select name="sucursal" class="form-control">
                      <option>En Linea</option>
                      <option>Acapulco</option>
                      <option>Ciudad de Mexico</option></select><br>
              <input type="file" name="file"><br><br>
              </div>
             <center><button class="btn btn-outline-success"> Importar Archivo</button>
              </form>
         </div>
    </div>
</div>


@endsection