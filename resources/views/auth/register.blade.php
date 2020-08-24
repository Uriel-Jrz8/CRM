@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- <div class="card-header"></div> -->

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <center>
                            <h3 style="color: white;">{{ __('Registrar Cuenta Nueva') }}</h3>
                        </center><br>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right" style="color: white;">{{ __('Nombre Usuario') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nombre Usuario">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right" style="color: white;">{{ __('Correo Electrónico') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right" style="color: white;">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Contraseña">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right" style="color: white;">{{ __('Confirmar Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar Contraseña">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <center> <button type="submit" class="btn btn-outline-pink2 center" style="margin: 0% 0% 0% -8%;">
                                        {{ __('Crear Cuenta Nueva') }}
                                    </button></center>
                                <br>
                            </div>
                        </div>
                    </form>
                    <br>
                    <center>
                        <img src="/Images/perroBlanco.png" class="img2 img-fluid" style="margin: 0% 0% 0% 0%;">
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection