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
    <div class="row justify-content-center center">
      <div class="col-md-8">

        <div>
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
        </div>

      </div>
      <H1>{{ __('Bodega Merkado Croqueta') }} </H1>
    </div>

    <button type="button" class="btn btn-outline-dark btn-lg" data-toggle="modal" data-target=".bd-example-modal-lg">Agrear Nuevo Producto <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M4 1h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H4z" />
        <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z" />
      </svg></button>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <center>
            <H1>{{ __('Nuevo Producto') }} </H1>
          </center>
          <form method="POST" action="{{route('NewAddstock')}}">
            @method('PUT')
            @csrf

            <div class="col-xs-12 col-sm-8">
              <b><label class="text-info" for="exampleInput1">Identificador Pedido</label></b>
              <input type="text" class="form-control2" name='id' autocomplete="off" placeholder="Número de Pedido" required onkeypress="return validaNumericos(event)"style="color: #6c757d; border-color:#6c757d;">
            </div>

            <div class="col-xs-12 col-sm-8">
              <b><label class="text-info" for="exampleInput1">Nombre del Producto</label></b>
              <input type="text" class="form-control2" name='nombre' autocomplete="off" placeholder="Nombre del Producto" required style="color: #6c757d; border-color:#6c757d;">
            </div>

            <div class="col-xs-12 col-sm-8">
              <b><label class="text-info" for="exampleInput1">Marca del Producto</label></b>
              <select name="marca" class="form-control2" required style="color: #6c757d; border-color:#6c757d;">
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
              <select name="categoria" class="form-control2" required  style="color: #6c757d; border-color:#6c757d;">
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
              <b><label class="text-info" for="exampleInput1"required>Tienda</label></b>
              <select name="sucursal" class="form-control" required style="color: #6c757d; border-color:#6c757d;">
                <option>En Linea</option>
                <option>Acapulco</option>
                <option>Ciudad de Mexico</option>
              </select>
            </div> <br>
            <center><button class="btn btn-outline-info">Nuevo Producto <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-basket" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M10.243 1.071a.5.5 0 0 1 .686.172l3 5a.5.5 0 1 1-.858.514l-3-5a.5.5 0 0 1 .172-.686zm-4.486 0a.5.5 0 0 0-.686.172l-3 5a.5.5 0 1 0 .858.514l3-5a.5.5 0 0 0-.172-.686z" />
                  <path fill-rule="evenodd" d="M1 7v1h14V7H1zM.5 6a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 .5.5h15a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5H.5z" />
                  <path fill-rule="evenodd" d="M14 9H2v5a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V9zM2 8a1 1 0 0 0-1 1v5a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V9a1 1 0 0 0-1-1H2z" />
                  <path fill-rule="evenodd" d="M4 10a.5.5 0 0 1 .5.5v3a.5.5 0 1 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 1 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 1 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 1 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 1 1-1 0v-3a.5.5 0 0 1 .5-.5z" />
                </svg></button></center>
          </form> <br>
        </div>
      </div>
    </div>




    <form method="POST" action="{{route('UpdateStock')}}">
      @method('PUT')
      @csrf
      <br>
      <H3 style="color: #DE2692">{{ __('Actualizar Producto') }} </H3>
      <div class="form-row">
        <div class="col-xs-8 col-sm-3"> <b><label style="color: #DE2692" for="exampleInput1">Nombre del Producto</label></b>
          <input type="text" class="form-control" name="nombre" placeholder="Nombre Producto" autocomplete="off" required> </div>

        <div class="col-xs-8 col-sm-3"> <b><label style="color: #DE2692" for="exampleInput1">Codigo Sku</label></b>
          <input type="text" class="form-control" name="sku" placeholder="Codigo SKU" autocomplete="off" required> </div>

        <div class="col-xs-8 col-sm-3"> <b><label style="color: #DE2692" for="exampleInput1">Precio Producto</label></b>
          <input type="text" class="form-control" name="precio" placeholder="Precio" required autocomplete="off" onkeypress="return validaNumericos(event)"> </div>

        <div class="col-xs-8 col-sm-3"> <b><label style="color: #DE2692" for="exampleInput1">Identificador Producto</label></b>
          <input type="text" class="form-control" name="id" placeholder="Identificador Producto" autocomplete="off" required onkeypress="return validaNumericos(event)"> </div>

        <div class="col-xs-8 col-sm-3"> <b><label style="color: #DE2692" for="exampleInput1">Cantidad de Productos</label></b>
          <input type="text" class="form-control" name="cantidad" placeholder="cantidad" autocomplete="off" required onkeypress="return validaNumericos(event)"> </div>

        <div class="col-xs-8 col-sm-3"> <b><label style="color: #DE2692" for="exampleInput1">Sucursal</label></b> <select name="sucursal" class="form-control" style="color:#6c757d;">
            <option>En Linea</option>
            <option>Acapulco</option>
            <option>Ciudad de Mexico</option>
          </select> </div>
      </div>

      <br>
      <center><button class="btn btn-outline-pink"> Actualizar Producto <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
            <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z" />
          </svg></button> </center>
      <!-- style="color: #DE2692; border-color:#DE2692;" -->
    </form>

    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data" class="was-validated">
      @method('PUT')
      @csrf
      <H3 class="text-success">{{ __('Importar Lista de Productos') }} </H3>

      <div class="col-xs-8 col-sm-3">
        <b><label class="text-success" for="exampleInput1">Sucursal</label></b>
        <select name="sucursal" class="form-control" style="color:#6c757d;">
          <option>En Linea</option>
          <option>Acapulco</option>
          <option>Ciudad de Mexico</option>
        </select><br>

        <!-- <input type="file" name="file"><br><br> -->
        <div class="custom-file">
          <input type="file" name="file" class="custom-file-input" id="validatedCustomFile" lang="es" required>
          <label class="custom-file-label" for="validatedCustomFile">Elegir Archivo ...</label>
          <div class="invalid-feedback">Ingresar Archivo Valido</div>
        </div>
      </div>
      <center><button class="btn btn-outline-success"> Importar Archivo <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cloud-upload" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z" />
            <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z" />
          </svg></button>

    </form>
  </div>
</div>
</div>
@endsection