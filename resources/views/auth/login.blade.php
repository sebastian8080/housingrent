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
            <p style="font-weight: 300">Ingresa tus datos de inicio de sesión a continuación para acceder a tu cuenta. Si aún no tienes una cuenta, puedes <a href="{{ route('register') }}">registrarte aquí</a>.</p>
            <p style="font-weight: 300">Recuerda que <span style="font-weight: 500">tu privacidad es importante para nosotros</span>. Tus datos personales están protegidos y solo se utilizarán de acuerdo con nuestra política de privacidad.</p>
            <p style="font-weight: 300">¡Gracias por confiar en nosotros para publicar tus propiedades en renta!</p>
        </article>
    </section>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center h5" style="background-color: #242B40; color: #ffffff">{{ __('Iniciar Sesión') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo Electrónico') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordar mi sesión') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn rounded-pill" style="background-color: #242B40; color: #ffffff">
                                    {{ __('Iniciar Sesión') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('¿Olvido su contraseña?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
