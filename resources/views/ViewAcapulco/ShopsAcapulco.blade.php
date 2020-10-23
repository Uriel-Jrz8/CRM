@extends('layouts.app')
@section('content')
<script>
  function validaNumericos(event) {
    if (event.charCode >= 46 && event.charCode <= 57) {
      return true;
    }
    return false;
  }
</script>
<br><br>

<div class="container">
  <div class="shadow-lg p-4 mb-5 bg-white rounded">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <!-- @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
        @endif -->
        @if (session('message'))
        <div class="alert alert-info" role="alert">
          {{ session('message') }}
        </div>
        @endif
        
        <center>
          <h1>{{ __('Ventas Acapulco') }} </h1>
        </center>
      </div>
      <nav class="navbar navbar-expand navbar-light ">
          <div class="" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Productos en Almacén
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{route('stocklinea')}}">En Línea</a>
                  <a class="dropdown-item" href="{{route('stockcdmx')}}">Ciudad de México</a>
                  <a class="dropdown-item" href="{{route('stockacapulco')}}">Acapulco</a>
                </div>
              </li>
            </ul>
          </div>
        </nav>

      <div class="col-12 col-md-6">
        <form action="{{route('agregarProductoVentaAcapulco')}}" method="POST">
          @method('PUT')
          @csrf
          <div class="form-group">
            <label class="" for="codigo" style="color: black;">Código de barras o Código SKU</label>
            <input id="codigo" autocomplete="off" required autofocus name="codigo" type="text" class="form-control" placeholder="Código de barras o Código SKU" style="color: black;">
          </div>

      <div class="col-12 col-md-6">
        <form action="{{route('terminarOCancelarVentaAcapulco')}}" method="POST">
          @method('PUT')
          @csrf
          <div class="form-group">
            <label class="" for="id_cliente" style="color: black;">Número de folio</label>
            <input type="text" class="form-control" name='folio' autocomplete="off" placeholder="Número de Folio" required onkeypress="return validaNumericos(event)" style="color:black;">
          </div>
          @if(session("productos") !== null)

          <div class="btn-group" role="group" aria-label="Basic example">
            <div class="btn-group mr-2" role="group" aria-label="First group">
              <button name="accion" value="terminar" type="submit" class="btn btn-outline-success">Realizar Venta </button></div>
            <div class="btn-group mr-2" role="group" aria-label="First group">
              <button name="accion" value="cancelar" type="submit" class="btn btn-outline-danger">Cancelar Ventaa </button></div>
          </div>
          @endif
        </form>
      </div>

        </form>
      </div>
      @if(session("productos") !== null)
      <br>
    </div><br>
    <div class="container">
      @if(session("mensaje"))
      <div class="alert alert-{{session('tipo') ? session('tipo') : 'info'}}">
        {{session('mensaje')}}
        @endif
      </div>
      <div class="table-responsive">
        <h1 align="right">Total: ${{number_format($total, 2)}} MXN</h1>
        <table class="table table-hover">
          <thead class="thead-dark ">
            <tr>
              <th><center>Cantidad</center></th>
              <th><center>Descripción de Producto</center></th>
              <th><center>Código SKU</center></th>
              <th><center>Precio Unitario</center></th>
              <!-- <th><center>Subtotal Sin Descuento</center></th> -->
              <th><center>Descuento</center></th>
              <th><center>Subtotal</center></th>
              <th><center>Eliminar</center></th>
            </tr>
          </thead>
          <tbody>
            @foreach(session("productos") as $producto)
            <tr>
              <td><center>{{$producto->cantidad}}</center></td>
              <td><center>{{$producto->Descripcion}}</center></td>
              <td><center>{{$producto->Codigo_SKU}}</center></td>
              <td><center>$ {{number_format($producto->Precio_Venta, 2)}} MXN</center></td>
              <!-- <td><center>$ {{number_format($producto->Precio * $producto->cantidad, 2)}} MXN</center></td> -->
              <td><center>$ {{number_format($producto->Descuento * $producto->cantidad ,2 )}} MXN</center></td>
              <td><center>$ {{number_format(($producto->Precio_Venta * $producto->cantidad) - ($producto->Descuento * $producto->cantidad ) ,2 )}} MXN</center></td>
              <td><center>
                <form action="{{route('quitarProductoDeVentaAcapulco')}}" method="post">
                  @method("delete")
                  @csrf
                  <input type="hidden" name="indice" value="{{$loop->index}}">
                  <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"><svg width="20" height="20" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                      </svg></i>
                  </button>
                </form></center>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @else
      <!-- <h2>Aquí aparecerán los productos de la venta
                    <br>
                    Escanea el código de barras o escribe y presiona Enter</h2> -->
      @endif

      <form action="{{ route('ConsultAcapulco') }}" method="POST">
        @method('PUT')
        @csrf
        <center><input type="submit" value="Ventas Realizadas " class="btn btn-outline-pink"></center>
      </form>
    </div>

  </div>
</div>
@endsection