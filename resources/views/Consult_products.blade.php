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
        <H1>{{ __('Pedidos') }} </H1> 
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
                <input type="submit" value="Descargar" class="btn btn-outline-success">
            </form>
                    @else
                       <h1><center>¡No hay Datos!</center></h1>
                @endif
            @endisset

        <button type="button" class="btn btn-outline-danger">Descargar en PDF</button>
<div>

@endsection
