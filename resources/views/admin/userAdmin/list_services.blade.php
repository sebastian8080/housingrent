@extends('adminlte::page')

@section('title', 'Gestión de Servicios')

@section('content_header')
<section class="container">
    <h1>Servicios Registrados</h1>
</section>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <!-- Formulario para agregar un nuevo servicio -->
            <form id="createServiceForm" class="mb-5">
                @csrf
                <div class="form-row align-items-end"> <!-- Alinea verticalmente los elementos del formulario al final -->
                    <div class="form-group col-md-5"> <!-- Ajusta el tamaño de la columna según sea necesario -->
                        <label for="serviceName">Nombre del Servicio</label>
                        <input type="text" class="form-control" id="serviceName" name="name" required>
                    </div>
                    <div class="form-group col-md-5"> <!-- Ajusta el tamaño de la columna según sea necesario -->
                        <label for="typeBenefit">Tipo de Servicio</label>
                        <select id="typeBenefit" class="form-control" name="type_benefit_id" required>
                            @foreach ($typeBenefits as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2"> <!-- Ajusta para dar espacio al botón -->
                        <button type="submit" class="btn btn-primary">Agregar Servicio</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Formulario para agregar un nuevo tipo de beneficio -->
            <form id="createTypeBenefitForm" class="mb-5">
                @csrf
                <div class="form-row align-items-end">
                    <div class="form-group col-md-8">
                        <label for="typeBenefitName">Nombre del Tipo de Beneficio</label>
                        <input type="text" class="form-control" id="typeBenefitName" name="name" placeholder="Ej: Servicios básicos, Beneficios, Permisos" required>
                    </div>
                    <div class="form-group col-md-2">
                        <button type="submit" class="btn btn-primary">Agregar Tipo</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Tabla para listar los servicios existentes -->
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo de Servicio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($benefits as $benefit)
                <tr>
                    <td>{{ $benefit->name }}</td>
                    <td>{{ $benefit->typeBenefit->name }}</td>
                    <td>
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow editServiceBtn" data-id="{{ $benefit->id }}" data-toggle="modal" data-target="#editServiceModal"><i class="fa fa-lg fa-fw fa-pen"></i></button>
                        <button class="btn btn-xs btn-default text-danger mx-1 shadow deleteServiceBtn" data-id="{{ $benefit->id }}" data-toggle="modal" data-target="#deleteServiceConfirmationModal"><i class="fa fa-lg fa-fw fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">
    {{ $benefits->links('pagination::bootstrap-4') }}
</div>
{{-- Modal para Editar Servicio --}}
<div class="modal fade" id="editServiceModal" tabindex="-1" role="dialog" aria-labelledby="editServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editServiceModalLabel">Editar Servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editServiceForm">
                <div class="modal-body">
                    <input type="hidden" id="editServiceId" name="id">
                    <div class="form-group">
                        <label for="editServiceName">Nombre del Servicio</label>
                        <input type="text" class="form-control" id="editServiceName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="editTypeBenefit">Tipo de Servicio</label>
                        <select class="form-control" id="editTypeBenefit" name="type_benefit_id">
                            @foreach ($typeBenefits as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
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


{{-- Modal de Confirmación para Eliminar Servicio --}}
<div class="modal fade" id="deleteServiceConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteServiceConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteServiceConfirmationModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este servicio?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger" id="deleteServiceBtn">Eliminar</button>
            </div>
        </div>
    </div>
</div>

@section('css')
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
@stop
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        $('#createServiceForm').submit(function(e) {
            e.preventDefault();
            
            $.ajax({
                url: "{{ route('services.create') }}", // Asegúrate de que esta ruta sea correcta
                type: "POST",
                data: {
                    "_token": $("input[name=_token]").val(), // El token CSRF
                    "name": $("#serviceName").val(),
                    "type_benefit_id": $("#typeBenefit").val()
                },
                success: function(response) {
                    toastr.success('Servicio creado exitosamente.');
                    $('#createServiceForm')[0].reset(); // Resetea el formulario después de la creación exitosa
                    // Aquí puedes recargar la lista de servicios o añadir el nuevo servicio a la tabla
                },
                error: function(xhr) {
                    toastr.error('Error al crear el servicio.');
                    // Aquí puedes manejar errores de validación y mostrarlos al usuario
                }
            });
        });
    });
    </script>
<script>
    $('.editServiceBtn').on('click', function() {
    var serviceId = $(this).data('id');
    $.ajax({
        url: `/admin/services/${serviceId}/edit`,
        type: "GET",
        success: function(service) {
            $('#editServiceId').val(service.id);
            $('#editServiceName').val(service.name);
            $('#editTypeBenefit').val(service.type_benefit_id);
            $('#editServiceModal').modal('show');
        },
        error: function(error) {
            toastr.error('No se pudo cargar la información del servicio.');
        }
    });
});
$('#editServiceForm').submit(function(e) {
    e.preventDefault();
    var serviceId = $('#editServiceId').val();
    $.ajax({
        url: `/admin/services/${serviceId}/update`,
        type: "PUT",
        data: $(this).serialize()+ "&_token={{ csrf_token() }}", // Incluye el token CSRF en tu formulario como un campo oculto
        success: function(response) {
            toastr.success('Servicio actualizado exitosamente.');
            $('#editServiceModal').modal('hide');
            // Aquí puedes recargar la lista de servicios o actualizar la tabla directamente con los nuevos datos
        },
        error: function(response) {
            toastr.error('Error al actualizar el servicio.');
        }
    });
});

</script>

<script>
    $(document).ready(function() {
        var serviceIdToDelete = 0; // Variable para almacenar el ID del servicio a eliminar
    
        // Abre el modal de confirmación y guarda el ID del servicio a eliminar
        $('.deleteServiceBtn').click(function() {
            serviceIdToDelete = $(this).data('id'); // Guarda el ID del servicio
        });
    
        // Maneja la confirmación de eliminación
        $('#deleteServiceBtn').click(function() {
            // Verifica que tenemos un ID válido para eliminar
            if (serviceIdToDelete === 0) {
                toastr.error('Error al obtener el ID del servicio para eliminar.');
                return;
            }
    
            $.ajax({
                url: `/admin/services/${serviceIdToDelete}/delete`, // La URL correcta para tu ruta de eliminación
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}", // Asegúrate de incluir el token CSRF
                },
                success: function(response) {
                    // Muestra un mensaje de éxito y oculta el modal de confirmación
                    toastr.success(response.message);
                    $(`button.deleteServiceBtn[data-id="${serviceIdToDelete}"]`).closest('tr').remove(); // Elimina la fila del servicio
                    $('#deleteServiceConfirmationModal').modal('hide');
                    serviceIdToDelete = 0; // Restablece el ID a 0 para la próxima operación
                },
                error: function(xhr, status, error) {
                    // Maneja errores potenciales, como problemas de red o errores del servidor
                    toastr.error('No se pudo eliminar el servicio. Por favor, intente de nuevo.');
                }
            });
        });
    });
    </script>
    <script>
        $(document).ready(function() {
            $('#createTypeBenefitForm').submit(function(e) {
                e.preventDefault();
                
                $.ajax({
                    url: "{{ route('type_services.create') }}", 
                    type: "POST",
                    data: {
                        "_token": $("input[name=_token]").val(),
                        "name": $("#typeBenefitName").val()
                    },
                    success: function(response) {
                        toastr.success('Tipo de beneficio creado exitosamente.');
                        $('#createTypeBenefitForm')[0].reset(); 
                    },
                    error: function(xhr) {
                        toastr.error('Error al crear el tipo de beneficio.');
                        
                    }
                });
            });
        });
        </script>
@stop