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
            @isset($query)
            @endisset

            @isset($query)
                @include('partials.table', $query)
            @endisset

    
        <button type="button" class="btn btn-outline-danger">Descargar en PDF</button>
        <button type="button" class="btn btn-outline-success">Descargar en Excel</button>
<div>

@endsection
