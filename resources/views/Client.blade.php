@extends('layouts.app')

@section('content')
<script>
function validaNumericos(event) {
    if(event.charCode >= 46 && event.charCode <= 57){
      return true;
     }
     return false;        
}
</script>
<div class="container">
<div class="shadow-lg p-4 mb-5 bg-white rounded">
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
                <h1>{{ __('Pedidos, En Linea') }} </h1> 
            </div>
        </div>
             <H1>{{ __('Ingresa tus Pedidos') }} </H1> 
    <form method="POST" action="{{route('Addline')}}">
    @method('PUT')
        @csrf
      <div class="form-row">

      <div  class="col-xs-12 col-sm-2">
        <b><label class="text-info" for="exampleInput1">Número de Folio</label></b>
          <input type="text" class="form-control" name='folio' autocomplete="off" placeholder="Número de Folio" required onkeypress="return validaNumericos(event)">
        </div>

        <div  class="col-xs-12 col-sm-2">
        <b><label class="text-info" for="exampleInput1">Identificador de Producto</label></b>
          <input type="text" class="form-control" name='id' autocomplete="off" placeholder="Identificador de Producto" required onkeypress="return validaNumericos(event)">
        </div>

        <div class="col-xs-12 col-sm-2">
        <b><label class="text-info" for="exampleInput1">Nombre del Producto</label></b>
          <input type="text" class="form-control" name='nombre' autocomplete="off" placeholder="Nombre del Producto" required>
        </div>

        <div class="col-xs-12 col-sm-2">
        <b><label class="text-info" for="exampleInput1">Marca del Producto</label></b> 
        <select name="marca" class="form-control" required>
          <!-- <option>Purina</option>
          <option>Eukanuba</option>
          <option>Royal Canin</option>
          <option>Hill´s</option>
          <option>Fulltrust</option>
          <option>Nupec</option>
          <option>Instict</option>
          <option>Diamond</option>
          <option>Sportmix Wholesomes</option> -->
                            @forelse ($users as $user)
                  <option>{{ $user->Codigo_Sku }}</option>
                  @empty
                    <h1>no hay datos</h1>
                  @endforelse
          </select>
         
          

           
          
          
        </div>

        <div class="col-xs-12 col-sm-2">
         <b><label class="text-info" for="exampleInput1">Tipo de Animal</label></b> <select name="animal" class="form-control" required>
          <option>Perro</option>
          <option>Gato</option>
          </select>
        </div>

        <div class="col-xs-12 col-sm-2">
        <b><label class="text-info" for="exampleInput1">Peso en Kilogramos</label></b>
        <input type="text" class="form-control" name='unidad' autocomplete="off" placeholder="Peso" required>
        </div>

        <div class="col-xs-12 col-sm-2">
         <b><label class="text-info" for="exampleInput1">Categoría</label></b> <select name="categoria" class="form-control" required>
          <option>Alimento</option>
          <option>Salud e Higiene</option>
          <option>Accesorios</option>
          </select>
        </div>

        <div class="col-xs-12 col-sm-2">
        <b><label class="text-info" for="exampleInput1">Precio Unitario</label></b>
          <input type="text" class="form-control" name='precio' autocomplete="off" placeholder="Precio Unitario" required  onkeypress="return validaNumericos(event)" >
        </div>

        <div class="col-xs-12 col-sm-2">
        <b><label class="text-info" for="exampleInput1">Código SKU</label></b>
          <input type="text" class="form-control" name='sku' autocomplete="off" placeholder="Código SKU" required>
        </div>

        <div class="col-xs-12 col-sm-2">
        <b><label class="text-info" for="exampleInput1">Número de Guía</label></b>
          <input type="text" class="form-control" name='guia' autocomplete="off" placeholder="Número de Guía" required>
        </div>

        <div class="col-xs-12 col-sm-2">
        <b><label class="text-info" for="exampleInput1">Cantidad de Productos</label></b>
          <input type="text" class="form-control" name='cantidad' autocomplete="off" placeholder="Cantidad de Productos" required onkeypress="return validaNumericos(event)">
        </div>

        <div class="col-xs-12 col-sm-2">
        <b><label class="text-info" for="exampleInput1">Sucursal</label></b> <select name="sucursal" class="form-control" required>
          <option>En Linea</option>
          <option>Ciudad de Mexico</option>
          <option>Acapulco</option>
          </select> 
        </div>

        <div class="col-xs-12 col-sm-2">
        <b><label class="text-info" for="exampleInput1">Precio Total</label></b>
          <input type="text" class="form-control" name='total' autocomplete="off" placeholder="Precio Total" required onkeypress="return validaNumericos(event)">
        </div>

        <div class="col-xs-12 col-sm-2">
        <b><label class="text-info" for="exampleInput1">Estatus del Pedido</label></b> <select name="estatus" class="form-control" required>
          <option>Entregado</option>
          <option>Pendiente</option>
          <option>Cancelado</option>
          </select>
          <br>
        </div>
        
        <div class="col-xs-12 col-sm-12">
        <center><input type="submit" value="Agregar Pedido" class="btn btn-outline-info"></center>
    </form>
  </div>
              <form action="{{ route('ConsultDato') }}" method="POST">
              @method('PUT')
              @csrf
              <center><input type="submit" value="Ver Pedidos Agregados" class="btn btn-outline-info"></center>
              </form>&nbsp;
              &nbsp;
 </div>
 
</div>


@endsection
