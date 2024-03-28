@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/font-style.css') }}">
    <style>
        body{
            font-family: 'Sharp Grotesk';
        }
    </style>
@endsection

@section('content')
<div class="container mt-4">

    <section class="row justify-content-center">
        <article class="col-sm-8">
            <div>
                <p class="h5" style="font-weight: 500">¡Bienvenido a Housing Rent Group!</p>
                <p style="font-weight: 300">Gracias por unirte a nosotros. Por favor, completa el siguiente formulario para crear tu cuenta. Los campos marcados con (*) son obligatorios.</p>
                <p style="font-weight: 300">Al registrarte, aceptas nuestros términos y condiciones, así como nuestra política de privacidad. Recuerda que tus datos personales estarán protegidos y no serán compartidos con terceros sin tu consentimiento.</p>
                <p style="font-weight: 300">Si ya tienes una cuenta, <a href="{{ route('login') }}">inicia sesión aquí</a>.</p>
            </div>
        </article>
    </section>

    <div class="row justify-content-center align-items-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center h5" style="background-color: #242B40; color: #ffffff">{{ __('Registro de Usuario') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre y Apellido*') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo Electrónico*') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña*') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Contraseña*') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0 justify-content-center">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn rounded-pill" style="background-color: #242B40; color: #ffffff">
                                    {{ __('Registrarse') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
