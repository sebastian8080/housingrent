@extends('adminlte::page')

@section('title', 'Propiedades Registradas')

@section('content_header')
<section class="container">
    <h1>Usuarios Registrados</h1>
</section>

@stop

@section('content')
<div class="container">
    <!-- Formulario de Búsqueda y Filtros Simplificado -->
    <div class="mb-3">
        <input type="text" id="searchQuery" placeholder="Nombre, Email o Teléfono" class="form-control mb-2">

        <!-- Selector de Roles -->
        <select id="searchRole" class="form-control mb-2">
            <option value="">Todos los Roles</option>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>

        <!-- Selector de Estado -->
        <select id="searchStatus" class="form-control mb-2">
            <option value="">Cualquier Estado</option>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>

        <button id="searchBtn" class="btn btn-primary">Buscar</button>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            @include('admin.userAdmin.partials_users_table')
        </tbody>
    </table>
</div>
<div class="mt-3">
    {{ $users->links('pagination::bootstrap-4') }}
</div>
    
</div>
{{-- Modal para Editar Usuario --}}
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editUserForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="userName">Nombre</label>
                        <input type="text" class="form-control" id="userName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="userEmail">Email</label>
                        <input type="email" class="form-control" id="userEmail" name="email" required>
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
                ¿Estás seguro de que deseas eliminar este usuario?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger" id="deletePropertyBtn">Eliminar</button>
            </div>
        </div>
    </div>
</div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
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
    $('.delete-property-button').on('click', function() {
        var propertyId = $(this).data('id');
        // Asegura que la URL sea correcta según tu archivo de rutas
       // $('#deleteForm').attr('action', `/admin/properties/delete/${propertyId}`);
    });

    $('#deletePropertyBtn').click(function(e) {
        e.preventDefault(); // Previene la acción por defecto del botón
        $('#deleteForm').submit(); // Envía el formulario de eliminación
    });
});
</script>
<script>
    $(document).ready(function() {
        $('.role-selector').change(function() {
            var userId = $(this).data('user');
            var roleId = $(this).val();
            $.ajax({
                url: `/admin/users/${userId}/role`,
                type: "PUT",
                data: {
                    "role_id": roleId,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                    } else {
                        toastr.error("Operación no completada correctamente.");
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    toastr.error('Error - ' + errorMessage);
                }
            });
        });
    
        $('.active-selector').change(function() {
            var userId = $(this).data('user');
            var isActive = $(this).val();
            $.ajax({
                url: `/admin/users/${userId}/isActive`,
                type: "PUT",
                data: {
                    "is_active": isActive,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                    } else {
                        toastr.error("Operación no completada correctamente.");
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    toastr.error('Error - ' + errorMessage);
                }
            });
        });
    });
    </script>


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
    // Configura el modal de confirmación para eliminar
    $('.deleteBtn').click(function(event) {
        event.stopPropagation(); // Evita que el evento se propague
        var userId = $(this).data('id');
        // Asigna el ID al botón de confirmación dentro del modal
        $('#deleteConfirmationModal').find('#deletePropertyBtn').data('id', userId);
        $('#deleteConfirmationModal').modal('show'); // Muestra el modal de confirmación
    });

    // Ejecuta la eliminación cuando se confirma
    $('#deletePropertyBtn').click(function() {
        var userId = $(this).data('id');
        $.ajax({
            url: `/admin/users/${userId}/delete`, // Asegúrate de que la URL sea correcta
            type: "DELETE",
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    $('button.deleteBtn[data-id="' + userId + '"]').closest('tr').remove(); // Elimina la fila
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(error) {
                toastr.error('No se pudo eliminar el usuario.');
            },
            complete: function() {
                $('#deleteConfirmationModal').modal('hide');
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