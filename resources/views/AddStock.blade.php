@extends('layouts.header')
@section('header')
<script>
  function validaNumericos(event) {
    if (event.charCode >= 46 && event.charCode <= 57) {
      return true;
    }
    return false;
  }
</script>

<div class="container">
  <div class=" shadow-lg p-4 mb-5 bg-white rounded">

    <center>
      <h1 style="background-color:black; color:white;">Bodega Merkado Croqueta</h1>
    </center><br>
    @if (session('mensaje'))
    <div class="alert alert-success" role="alert">
      {{ session('mensaje') }}
    </div>
    @endif
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <center>
            <H1 style="background-color: black; color:white;">{{ __('Nuevo Producto') }} </H1>
          </center>
          <form method="POST" action="{{route('NewAddstock')}}">
            @method('PUT')
            @csrf

            <div class="col-md-8">
              <b><label class="text-info" for="exampleInput1">Identificador Pedido</label></b>
              <input type="text" class="form-control2" name='id' autocomplete="off" placeholder="Número de Pedido" required onkeypress="return validaNumericos(event)" style="color: #6c757d; border-color:#6c757d;">
            </div>

            <div class="col-xs-12 col-sm-8">
              <b><label class="text-info" for="exampleInput1">Nombre del Producto</label></b>
              <input type="text" class="form-control2" name='nombre' autocomplete="off" placeholder="Nombre del Producto" required style="color: #6c757d; border-color:#6c757d;">
            </div>

            <div class="col-xs-12 col-sm-8">
              <b><label class="text-info" for="exampleInput1">Marca del Producto</label></b>
              <input type="text" class="form-control2" name='marca' autocomplete="off" placeholder="Marca" required style="color: #6c757d; border-color:#6c757d;">
              <!-- <select name="marca" class="form-control2" required style="color: #6c757d; border-color:#6c757d;">
                <option>Purina</option>
                <option>Eukanuba</option>
                <option>Royal Canin</option>
                <option>Hill´s</option>
                <option>Fulltrust</option>
                <option>Nupec</option>
                <option>Instict</option>
                <option>Diamond</option>
                <option>Sportmix Wholesomes</option>
              </select> -->
            </div>

            <div class="col-xs-12 col-sm-8">
              <b><label class="text-info" for="exampleInput1">Tipo de Animal</label></b>
              <select name="animal" class="form-control2" required style="color: #6c757d; border-color:#6c757d;">
                <option>Perro</option>
                <option>Gato</option>
              </select>
            </div>

            <div class="col-xs-12 col-sm-8">
              <b><label class="text-info" for="exampleInput1">Peso en Kilogramos</label></b>
              <input type="text" class="form-control2" name='unidad' autocomplete="off" placeholder="Peso" required style="color: #6c757d; border-color:#6c757d;">
            </div>

            <div class="col-xs-12 col-sm-8">
              <b><label class="text-info" for="exampleInput1">Categoría</label></b>
              <select name="categoria" class="form-control2" required style="color: #6c757d; border-color:#6c757d;">
                <option>Alimento</option>
                <option>Salud e Higiene</option>
                <option>Accesorios</option>
              </select>
            </div>

            <div class="col-xs-12 col-sm-8">
              <b><label class="text-info" for="exampleInput1">Precio Unitario</label></b>
              <input type="text" class="form-control2" name='precio' autocomplete="off" placeholder="Precio Unitario" required onkeypress="return validaNumericos(event)" required style="color: #6c757d; border-color:#6c757d;">
            </div>

            <div class="col-xs-12 col-sm-8">
              <b><label class="text-info" for="exampleInput1">Código SKU</label></b>
              <input type="text" class="form-control2" name='sku' autocomplete="off" placeholder="Código SKU" required required style="color: #6c757d; border-color:#6c757d;">
            </div>

            <div class="col-xs-12 col-sm-8">
              <b><label class="text-info" for="exampleInput1">Cantidad de Productos</label></b>
              <input type="text" class="form-control2" name='cantidad' autocomplete="off" placeholder="Cantidad de Productos" required onkeypress="return validaNumericos(event)" style="color: #6c757d; border-color:#6c757d;">
            </div>

            <div class="col-xs-12 col-sm-8">
              <b><label class="text-info" for="exampleInput1" required>Tienda</label></b>
              <select name="sucursal" class="form-control" required style="color: #6c757d; border-color:#6c757d;">
                <option>En Linea</option>
                <option>Acapulco</option>
                <option>Ciudad de Mexico</option>
              </select>
            </div> <br>
            <center><button class="btn btn-outline-info">Nuevo Producto &nbsp <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-cart-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M11.354 5.646a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708 0z" />
                  <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                </svg></button></center>
          </form> <br>
        </div>
      </div>
    </div>
    <form method="POST" action="{{route('descuento')}}">
      @method('PUT')
      @csrf
      <H3 style="color: #F5a623">{{ __('Aplicar Descuento') }} </H3>
      <div class="form-row">
        <div class="col-xs-8 col-sm-3"> <b><label style="color: #F5a623" for="exampleInput1">Descuento %</label></b>
          <input type="text" class="form-control3" name="des" placeholder="Descuento %" autocomplete="off" required onkeypress="return validaNumericos(event)">
        </div>

        <div class="col-xs-8 col-sm-3"> <b><label style="color: #F5a623" for="exampleInput1">Marca del Producto ó Código SKU</label></b>
          <input type="text" class="form-control3" name="desmarca" placeholder="Marca" autocomplete="off" required>
        </div>

        <div class="col-xs-8 col-sm-3"> <b><label style="color: #F5a623" for="exampleInput1">Sucursal</label></b> <select name="sucursal" class="form-control3">
            <option>Selecciona Sucursal</option>
            <option>En Linea</option>
            <option>Acapulco</option>
            <option>Ciudad de Mexico</option>
          </select> </div>
      </div><br>
      <center><button class="btn btn-outline-orange">Aplicar Descuento &nbsp <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-percent" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M13.442 2.558a.625.625 0 0 1 0 .884l-10 10a.625.625 0 1 1-.884-.884l10-10a.625.625 0 0 1 .884 0zM4.5 6a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm7 6a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
          </svg>

        </button></center>
    </form>



    <form method="POST" action="{{route('UpdateStock')}}">
      @method('PUT')
      @csrf
      <br>
      <H3 style="color: #DE2692">{{ __('Actualizar Producto') }} </H3>
      <div class="form-row">
        <div class="col-xs-8 col-sm-3"> <b><label style="color: #DE2692" for="exampleInput1">Nombre del Producto</label></b>
          <input type="text" class="form-control1" name="nombre" placeholder="Nombre Producto" autocomplete="off" required> </div>

        <div class="col-xs-8 col-sm-3"> <b><label style="color: #DE2692" for="exampleInput1">Codigo Sku</label></b>
          <input type="text" class="form-control1" name="sku" placeholder="Codigo SKU" autocomplete="off" required> </div>

        <div class="col-xs-8 col-sm-3"> <b><label style="color: #DE2692" for="exampleInput1">Precio Producto</label></b>
          <input type="text" class="form-control1" name="precio" placeholder="Precio" required autocomplete="off" onkeypress="return validaNumericos(event)"> </div>

        <div class="col-xs-8 col-sm-3"> <b><label style="color: #DE2692" for="exampleInput1">Identificador Producto</label></b>
          <input type="text" class="form-control1" name="id" placeholder="Identificador Producto" autocomplete="off" required onkeypress="return validaNumericos(event)"> </div>

        <div class="col-xs-8 col-sm-3"> <b><label style="color: #DE2692" for="exampleInput1">Cantidad de Productos</label></b>
          <input type="text" class="form-control1" name="cantidad" placeholder="Cantidad" autocomplete="off" required onkeypress="return validaNumericos(event)"> </div>

        <div class="col-xs-8 col-sm-3"> <b><label style="color: #DE2692" for="exampleInput1">Sucursal</label></b> <select name="sucursal" class="form-control1">
            <option>En Linea</option>
            <option>Acapulco</option>
            <option>Ciudad de Mexico</option>
          </select> </div>
      </div>

      <br>
      <center><button class="btn btn-outline-pink"> Actualizar Producto &nbsp <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-check-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
            <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z" />
          </svg></button> </center>
      <!-- style="color: #DE2692; border-color:#DE2692;" -->
    </form>

    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data" class="was-validated">
      @method('PUT')
      @csrf
      <H3 class="text-success">{{ __('Importar Lista de Productos') }} </H3>
      <div class="form-row">
        <div class="col-xs-8 col-sm-3">
          <b><label class="text-success" for="exampleInput1">Sucursal</label></b>
          <select name="sucursal" class="form-control" style="color:#6c757d;">
            <option>En Linea</option>
            <option>Acapulco</option>
            <option>Ciudad de Mexico</option>
          </select><br>

          <div class="custom-file">
            <input type="file" name="file" class="custom-file-input" id="validatedCustomFile" lang="es" required>
            <label class="custom-file-label" for="validatedCustomFile">Elegir Archivo ...</label>
            <div class="invalid-feedback">Ingresar Archivo Valido</div>
          </div>
        </div>
      </div>
      <center><button class="btn btn-outline-success"> Importar Archivo &nbsp <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-cloud-upload" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z" />
            <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z" /></svg>
        </button>
      </center>
    </form><br>
    <H3 style="color: #e3342f">{{ __('Agragar Nuevo Producto') }} </H3><br>
    <button type="button" class="btn btn-outline-danger btn-lg" data-toggle="modal" data-target=".bd-example-modal-lg">Agrear Nuevo Producto &nbsp<svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
      </svg>
    </button>
  </div>
</div>
@endsection