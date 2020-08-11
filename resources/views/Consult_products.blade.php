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
        <H1>{{ __('Pedidos en Línea') }} </H1> 
      <br>
    </div>
 <br>
            <!-- Metodo para mostrar la tabla con los datos requeridos-->
            @isset($query)
                @include('partials.table', $query)
            @endisset

            <!-- Metodo para Descargar los datos en un formato excel-->
            @isset($query)
                @if(count($query) > 0 )
            
            <form method="POST" action="{{ route('export')}}">
            @method('PUT')
            @csrf
            <br>
            <input type="hidden" name="mivar" value="Select * from orders_linea;">
                <button class="btn btn-outline-success">Descargar Ecxel  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M.5 8a.5.5 0 0 1 .5.5V12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V8.5a.5.5 0 0 1 1 0V12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8.5A.5.5 0 0 1 .5 8z"/>
                <path fill-rule="evenodd" d="M5 7.5a.5.5 0 0 1 .707 0L8 9.793 10.293 7.5a.5.5 0 1 1 .707.707l-2.646 2.647a.5.5 0 0 1-.708 0L5 8.207A.5.5 0 0 1 5 7.5z"/>
                <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0v-8A.5.5 0 0 1 8 1z"/>
                </svg></button>
                <!-- <a class="btn btn-outline-danger" href="{{ route('PDF') }}">Descargar PDF</a> -->
            </form>
                    @else
                       <h1><center>¡No hay Datos!</center></h1>
                @endif
            @endisset
</div>

@endsection
