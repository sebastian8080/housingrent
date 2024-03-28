@extends('adminlte::page')

@section('title', 'Mis Propiedades')

@section('content_header')
<section class="container">
    <h1>Mis Propiedades</h1>
</section>

@stop

@section('content')
<div class="container">
    <div class="row">
        @foreach($properties as $property)
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card mb-4" style="width: 100%;">
                    <div class="card-img-top" style="background-image: url('{{ $property->multimedia->isNotEmpty() ? Storage::url($property->multimedia->first()->filename) : asset('path/to/default/image.jpg') }}'); background-size: cover; background-position: center; height: 200px;">
                        <!-- La imagen se muestra como fondo para mantener el tamaño uniforme -->
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $property->title }}</h5>
                        <p class="card-text">{{ Str::limit($property->description, 100) }}</p>
                        <p class="card-text">
                            <small class="text-muted">
                                <i class="fas fa-bed"></i> {{ $property->bedroom }} |
                                <i class="fas fa-bath"></i> {{ $property->bathroom }} |
                                <i class="fas fa-car"></i> {{ $property->garage }}
                            </small>
                        </p>
                        <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-primary">
                            <i class="fas fa-pencil-alt"></i> Editar
                        </a>
                        <a href="{{ route('properties.upload', $property->id) }}" class="btn btn-info"><i class="fas fa-edit"></i>Imágenes</a>
                        <button type="button" class="btn btn-danger delete-property-button" data-id="{{ $property->id }}" data-toggle="modal" data-target="#deleteConfirmationModal">
                            <i class="fas fa-trash"></i>
                        </button>                        
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
{{-- Modal de Confirmación para Eliminar --}}
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar esta propiedad?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger" id="deletePropertyBtn">Eliminar</button>
            </div>
        </div>
    </div>
</div>

<form id="deleteForm" action="" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
<script>
$(document).ready(function() {
    $('.delete-property-button').on('click', function() {
        var propertyId = $(this).data('id');
        // Asegura que la URL sea correcta según tu archivo de rutas
        $('#deleteForm').attr('action', `/admin/properties/delete/${propertyId}`);
    });

    $('#deletePropertyBtn').click(function(e) {
        e.preventDefault(); // Previene la acción por defecto del botón
        $('#deleteForm').submit(); // Envía el formulario de eliminación
    });
});
</script>
@stop