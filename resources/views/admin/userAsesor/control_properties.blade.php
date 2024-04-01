@extends('adminlte::page')

@section('title', 'Propiedades Registradas')

@section('content_header')
<section class="container">
    <h1>Propiedades Registradas</h1>
</section>

@stop

@section('content')

<div class="container">
    <div class="row">
        @foreach($properties as $property)
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card mb-4 d-flex flex-column" style="width: 100%;">
                    <div class="position-relative">
                        <div class="card-img-top" style="background-image: url('{{ $property->multimedia->isNotEmpty() ? Storage::url($property->multimedia->first()->filename) : asset('path/to/default/image.jpg') }}'); background-size: cover; background-position: center; height: 200px;">
                            <!-- La imagen se muestra como fondo para mantener el tamaño uniforme -->
                        </div>
                        <span class="property-code">{{ $property->code }}</span>
                    </div>

                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title">{{ $property->title }}</h5>
                            <p class="card-text">{{ Str::limit($property->description, 100) }}</p>
                            <p class="card-text">
                                <small class="text-muted">
                                    <i class="fas fa-bed"></i> {{ $property->bedroom }} |
                                    <i class="fas fa-bath"></i> {{ $property->bathroom }} |
                                    <i class="fas fa-car"></i> {{ $property->garage }}
                                </small>
                            </p>
                        </div>
                        <div class="mt-auto">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input change-status" type="checkbox" id="activeSwitch{{ $property->id }}" data-id="{{ $property->id }}" {{ $property->is_active ? 'checked' : '' }}>
                                <label class="form-check-label" for="activeSwitch{{ $property->id }}">Activo</label>
                            </div>
                            <a href="{{ route('show.preview', $property->slug) }}" class="btn btn-success">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-primary">
                                <i class="fas fa-pencil-alt"></i> Editar
                            </a>
                            
                            <a href="{{ route('properties.upload', $property->id) }}" class="btn btn-info"><i class="fas fa-edit"></i> Imágenes</a>
                            <button type="button" class="btn btn-danger delete-property-button" data-id="{{ $property->id }}" data-toggle="modal" data-target="#deleteConfirmationModal">
                                <i class="fas fa-trash"></i>
                            </button>
                            
                        </div>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <style>
        .property-code {
            position: absolute;
            top: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.5);
            color: #ffffff;
            padding: 5px 10px;
            font-size: 14px;
            border-bottom-left-radius: 10px;
        }
        .position-relative {
            position: relative;
        }
    </style>
@stop
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
$(document).ready(function() {
    @if(session('success'))
            toastr.success('{{ session("success") }}');
        @endif
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
<script>
    $(document).ready(function() {
        $('.change-status').change(function() {
            var propertyId = $(this).data('id');
            var isActive = $(this).is(':checked') ? 1 : 0;
            
            $.ajax({
                url: `/admin/properties/${propertyId}/change-status`,
                type: 'POST',
                data: {
                    'is_active': isActive,
                    '_token': "{{ csrf_token() }}",
                },
                success: function(response) {
                    toastr.success(`Estado de la propiedad ${response.code} ${isActive ? 'activada' : 'desactivada'}.`);
                },
                error: function(xhr) {
                    toastr.error('Hubo un error al cambiar el estado de la propiedad.');
                }
            });
        });
    });
    </script>
@stop