@extends('adminlte::page')

@section('title', 'Propiedades Registradas')

@section('content_header')
<section class="container">
    <h1>Propiedades Registradas</h1>
</section>

@stop

@section('content')

<div class="container">
    <div class="row mb-4 justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('properties.manage') }}" method="GET" class="d-flex align-items-center">
                <input type="text" class="form-control form-control-lg flex-grow-1" name="search" placeholder="Buscar por Código, Titulo de Propiedad, Nombre o Email del Propietaro ..." value="{{ request()->query('search') }}">
                <button type="submit" class="btn btn-primary btn-lg ml-2">Buscar</button>
            </form>
        </div>
    </div>
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
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="card-text mb-0">
                                    <small class="text-muted">
                                        <i class="fas fa-bed"></i> {{ $property->bedroom }} |
                                        <i class="fas fa-bath"></i> {{ $property->bathroom }} |
                                        <i class="fas fa-car"></i> {{ $property->garage }}
                                    </small>
                                </p>
                                <button type="button" class="btn btn-sm btn-outline-secondary editBtn" data-id="{{ $property->user->id }}">
                                    <i class="fas fa-user"></i> Datos Propietario
                                </button>
                            </div>
                        </div>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-start">
                                <div class="form-check form-switch mr-2">
                                    <input class="form-check-input change-status" type="checkbox" id="activeSwitch{{ $property->id }}" data-id="{{ $property->id }}" {{ $property->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="activeSwitch{{ $property->id }}">Activo</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input change-availability" type="checkbox" id="availableSwitch{{ $property->id }}" data-id="{{ $property->id }}" {{ $property->available ? 'checked' : '' }}>
                                    <label class="form-check-label" for="availableSwitch{{ $property->id }}">Disponible</label>
                                </div>
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

    <div class="row">
        <div class="col-md-12">
            {{ $properties->appends(request()->input())->links('pagination::bootstrap-4') }}

        </div>
    </div>
</div>

{{-- Modal para editar la información del usuario --}}
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Editar Datos Propietario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editUserForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="userName">Nombre</label>
                        <input type="text" class="form-control" id="userName" name="name">
                    </div>
                    <div class="form-group">
                        <label for="userEmail">Email</label>
                        <input type="email" class="form-control" id="userEmail" name="email">
                    </div>
                    <div class="form-group">
                        <label for="userPhone">Teléfono</label>
                        <input type="text" class="form-control" id="userPhone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="userAddress">Dirección</label>
                        <input type="text" class="form-control" id="userAddress" name="address">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
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
{{-- Modal de Información del Usuario --}}
<div class="modal fade" id="userInfoModal" tabindex="-1" role="dialog" aria-labelledby="userInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userInfoModalLabel">Información del Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Aquí se cargarán los detalles del usuario -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>
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
    <style>
        .pagination {
    display: flex;
    justify-content: center; /* Centra la paginación */
}

.pagination li {
    margin: 0 5px;
}

.pagination li a, .pagination li span {
    color: #ffffff; /* Cambia el color del texto */
    background-color: #007bff; /* Cambia el color de fondo */
    border-radius: 5px;
    padding: 5px 10px;
    text-decoration: none;
}

.pagination li.active span {
    background-color: #17a2b8; /* Color de fondo para el ítem activo */
    border-color: #17a2b8;
}

.pagination li.disabled span {
    color: #6c757d; /* Color del texto para ítems deshabilitados */
    background-color: #fff;
}

.pagination li a:hover {
    background-color: #0056b3; /* Color de fondo al pasar el ratón */
}
    </style>
@stop
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        // Abrir modal de edición solo cuando se hace clic en el botón específico de editar
        $('.editBtn').on('click', function() {
            var userId = $(this).data('id');
            // Cargar los datos del usuario en el modal
            $.ajax({
                url: `/admin/users/${userId}/edit`, // Asegúrate de que esta ruta está configurada en tu archivo de rutas
                type: "GET",
                success: function(user) {
                    $('#userName').val(user.name);
                    $('#userEmail').val(user.email);
                    $('#userPhone').val(user.phone);
                    $('#userAddress').val(user.address);
                    // Guarda el ID del usuario en el formulario para su posterior uso
                    $('#editUserForm').data('userid', userId);
                    // Muestra el modal de edición
                    $('#editUserModal').modal('show');
                }
            });
        });
    
        // Guardar cambios del usuario
        $('#editUserForm').submit(function(e) {
            e.preventDefault(); // Previene el envío tradicional del formulario
            var userId = $(this).data('userid');
            $.ajax({
                url: `/admin/users/${userId}/update`, // La URL para actualizar el usuario
                type: "PUT",
                data: $(this).serialize() + "&_token={{ csrf_token() }}", // Serializa los datos del formulario añadiendo el token CSRF
                success: function(response) {
                    // Cierra el modal de edición y muestra un mensaje de éxito
                    $('#editUserModal').modal('hide');
                    toastr.success(response.message);
                    // Opcional: recargar la página o actualizar la vista con los nuevos datos
                    location.reload(); // Esta línea recargará la página para reflejar los cambios. Puedes optar por métodos más sutiles si lo prefieres.
                },
                error: function(error) {
                    // Muestra un mensaje de error si algo sale mal
                    toastr.error('No se pudieron guardar los cambios.');
                }
            });
        });
    });
    
    </script>
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
    <script>
        $(document).ready(function() {
            // Selector actualizado para escuchar cambios en el nuevo checkbox de 'available'
            $('.change-availability').change(function() {
                var propertyId = $(this).data('id');
                var isAvailable = $(this).is(':checked') ? 1 : 0; // Estado actualizado para 'available'
                
                $.ajax({
                    url: `/admin/properties/${propertyId}/change-availability`, // URL actualizada
                    type: 'POST',
                    data: {
                        'available': isAvailable, // Envío del estado 'available'
                        '_token': "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        toastr.success(`Disponibilidad de la propiedad ${response.code} ${isAvailable ? 'activada' : 'desactivada'}.`);
                    },
                    error: function(xhr) {
                        toastr.error('Hubo un error al cambiar la disponibilidad de la propiedad.');
                    }
                });
            });
        });
        </script>
        <script>
            $(document).ready(function() {
                function filtrarUsuarios() {
                    var query = $('#searchQuery').val().toLowerCase();
                    var role = $('#searchRole').val();
                    var status = $('#searchStatus').val();
            
                    $('tbody tr').each(function() {
                        var nombre = $(this).find('td:nth-child(1)').text().toLowerCase();
                        var email = $(this).find('td:nth-child(2)').text().toLowerCase();
                        var rol = $(this).find('td:nth-child(3) select').val();
                        var estado = $(this).find('td:nth-child(4) select').val();
                        var match = nombre.includes(query) || email.includes(query);
                        
                        if (role != '') {
                            match = match && rol === role;
                        }
                        if (status != '') {
                            match = match && estado === status;
                        }
                        
                        if (match) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                }
            
                // Eventos para realizar la búsqueda/filtrado
                $('#searchQuery').on('input', filtrarUsuarios);
                $('#searchRole').change(filtrarUsuarios);
                $('#searchStatus').change(filtrarUsuarios);
            });
            </script>
        
@stop