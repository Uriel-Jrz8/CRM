@extends('layouts.account')

@section('contenidoLogin')

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Bienvenido Accde a tu cuenta</h1>
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{route('login')}}">
                    @method('PUT')
                    @csrf
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">Email</label>
                            <input class="form-control"
                                   type="email"
                                   name="email"
                                   placeholder="Ingresa tu Email">
                            <span style="color:red"> {{ $errors->first('email')}}</span>
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                            <label for="password">Contraseña</label>
                            <input class="form-control"
                                   type="password"
                                   name="password"
                                   placeholder="Ingresa tu Contraseña">
                            <span style="color:red"> {{ $errors->first('password')}}</span>
                        </div>
                        <button class="btn btn-primary btn-block">Acceder a tu cuenta</button>
                     </form>
                </div>
            </div>
        </div>
    </div>
@endsection