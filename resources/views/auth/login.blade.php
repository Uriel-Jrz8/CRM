@extends('layouts.app')

@section('content')
<br>
<!-- shadow-lg p-10 mb-1 bg-white rounded -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-1-center">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <center>
                            
                            <h2 style="color: white;">{{ __('Bienvenido') }}</h2>
                            <img src="Images/perroBlanco.png" class="img2 img-fluid">
                            </center>
                        <br>
                        <div class="form-group row ">
                            <div class="col-md-10 offset-md-1 input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <svg color="white" width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-envelope-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z" />
                                        </svg>
                                    </div>
                                </div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Correo Electrónico" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="form-group row ">
                            <div class="col-md-10 offset-md-1 input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <svg color="white" width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-lock-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.5 9a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2V9z" />
                                            <path fill-rule="evenodd" d="M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z" />
                                        </svg>
                                    </div>
                                </div>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        <b>{{ __('Recordar Cuenta') }}</b>
                                    </label>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group row">
                            <div class="col-md-8-center offset-md-2">
                                <button type="submit" class="btn btn-outline-pink2">
                                    {{ __('Accede a tu Cuenta') }}
                                </button>
                                
                                <!-- Paso para el Restablecimiento de Contraseña
                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                    -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection