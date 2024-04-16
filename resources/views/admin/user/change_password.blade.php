@extends('admin.template.template_dashboard')

@section('title', 'Cambiar Contraseña')

@section('content_header')
<section class="container">
    <h1>Cambiar Contraseña</h1>
</section>

@stop
@section('content')
{{-- Verifica si hay un mensaje de éxito en la sesión --}}
@if(session('success'))
    {{-- Modal de Bootstrap para el mensaje de éxito --}}
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Éxito</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ session('success') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Script para mostrar el modal automáticamente --}}
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            $('#successModal').modal('show');
        });
    </script>
@endif

<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('user.password.update') }}" method="POST">
        @csrf
        {{-- Campo para la contraseña actual --}}
        <div class="form-group">
            <label for="current_password">Contraseña Actual</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required>
        </div>

        {{-- Campo para la nueva contraseña --}}
        <div class="form-group">
            <label for="new_password">Nueva Contraseña</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>

        {{-- Campo para confirmar la nueva contraseña --}}
        <div class="form-group">
            <label for="new_password_confirmation">Confirmar Nueva Contraseña</label>
            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
    </form>
</div>
@endsection
