@extends('admin.template.template_dashboard')

@section('title', 'Mis Propiedades')

@section('content_header')
<section class="container-fluid mb-5">
    <div class="row">
        <div class="col">
            <h4 class="fw-bold">Bienvenido</h4>
            <p class="h1">{{ auth()->user()->name }}</p>
        </div>
    </div>
</section>
@stop

@section('content')
<div class="container-fluid">
    <p class="custom-text">Mis Propiedades</p>
    <div class="row">
        @foreach($properties as $property)
            <div class="col-12 my-1 px-0">
                <div class="card mb-3 rounded-0" style="background-color: rgba(0, 0, 0, 0);">
                    <div class="row g-0 align-items-stretch">
                        <!-- Columna de imagen, asegurando visibilidad -->
                        <div class="col-lg-4 col-md-12" style="min-height: 200px;">
                            <a href="{{ route('show.property', $property->slug) }}" class="text-decoration-none h-100">
                                <div class="bg-image rounded-start h-100" style="background-position: center; background-repeat: no-repeat; background-size: cover; background-image: url('{{ $property->multimedia->isNotEmpty() ? Storage::url($property->multimedia->first()->filename) : asset('path/to/default/image.jpg') }}');">
                                    <div class="p-2" style="background-color: rgba(36, 43, 64, 0.8); color: #ffffff; border-radius: 0px 25px 0px 0px; position: absolute; bottom: 0;">
                                        <p class="m-0 h6">Cod: {{ $property->code }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- Columna de contenido y estado -->
                        <div class="col-lg-8 col-md-12">
                            <div class="row g-0">
                                <div class="col">
                                    <div class="card-header p-3" style="overflow-x: auto; border: none;">
                                        <p class="mb-0 custom-text">{{ $property->type_property }}, {{ $property->sector }}</p>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="card-header p-3 py-2 px-3" style="border: none; box-shadow: none; display: flex; align-items: center;">
                                        <!-- Añade un círculo con estilos condicionales -->
                                        <span class="h6 mb-0" style="color: {{ $property->is_active ? 'green' : '#ccc' }};">{{ $property->is_active ? 'Activada' : 'En revisión' }}</span>
                                        <span style="height: 10px; width: 10px; background-color: {{ $property->is_active ? 'green' : '#ccc' }}; border-radius: 50%; display: inline-block; margin-left: 5px;"></span>
                                        @if(!$property->is_active && $property->annotation)
                                            <span data-toggle="tooltip" data-placement="top" title="{{ $property->annotation }}">
                                                <i class="fas fa-question-circle ml-2 text-dark"></i>
                                            </span>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3 flex-grow-1" style="overflow-y: auto;">
                                <p class="h1 my-2" style="color:#242B40">${{ number_format($property->max_price, 2) }}</p>
                                <div style="height: 100px; overflow-y: auto; border-bottom: 1px solid #ccc;">
                                    <p>{{ $property->description }}</p>
                                </div>
                            </div>
                            <div class="additional-content p-3">
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-around align-items-center mb-2 flex-wrap">
                                        @if($property->bedroom > 0)
                                            <div class="d-flex align-items-center justify-content-center characteristics mx-2">
                                                <img style="width: 5vw; min-width: 30px; max-width: 50px;" src="{{ asset('img/dormitorios.png') }}" alt="Dormitorios">
                                                <p class="pt-3" style="font-weight: 600; font-size: calc(10px + 0.5vw);">{{ $property->bedroom }} Hab.</p>
                                            </div>
                                        @endif
                                        @if($property->bathroom > 0)
                                            <div class="d-flex align-items-center justify-content-center characteristics mx-2">
                                                <img style="width: 5vw; min-width: 30px; max-width: 50px;" src="{{ asset('img/banio.png') }}" alt="Baños">
                                                <p class="pt-3" style="font-weight: 600; font-size: calc(10px + 0.5vw);">{{ $property->bathroom }} @if($property->bathroom > 1) Baños @else Baño @endif</p>
                                            </div>
                                        @endif
                                        @if($property->garage > 0)
                                            <div class="d-flex align-items-center justify-content-center characteristics mx-2">
                                                <img style="width: 5vw; min-width: 30px; max-width: 50px;" src="{{ asset('img/estacionamiento.png') }}" alt="Garaje">
                                                <p class="pt-3" style="font-weight: 600; font-size: calc(10px + 0.5vw);">{{ $property->garage }} @if($property->garage > 1) Garajes @else Garaje @endif</p>
                                            </div>
                                        @endif
                                        @if($property->construction_area > 0)
                                            <div class="d-flex align-items-center justify-content-center characteristics mx-2">
                                                <img style="width: 5vw; min-width: 30px; max-width: 50px;" src="{{ asset('img/area.png') }}" alt="Área de construcción">
                                                <p class="pt-3" style="font-weight: 600; font-size: calc(10px + 0.5vw);">{{ $property->construction_area }} m<sup>2</sup></p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-12 d-flex justify-content-end align-items-center flex-wrap">
                                        <div class="rounded-btn btn btn-primary mx-2">
                                            
                                            <a class="text-white" href="{{ route('show.preview', $property->slug) }}"><i class="fas fa-eye"></i></a>
                                            <div class="action-text">Visualizar</div>
                                        </div>
                                        <div class="rounded-btn btn btn-primary mx-2">
                                            <a href="{{ route('properties.edit', $property->id) }}" class="text-white">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <div class="action-text">Editar</div>
                                        </div>
                                        <div class="rounded-btn btn btn-primary mx-2">
                                            <a href="{{ route('properties.upload', $property->id) }}" class="text-white"><i class="fas fa-image"></i></a>
                                            <div class="action-text">Imágenes</div>
                                        </div>
                                        <button class="rounded-btn btn btn-danger mx-2" data-id="{{ $property->id }}" data-toggle="modal" data-target="#deleteConfirmationModal"> 
                                                <i class="fas fa-trash"></i>
                                            <div class="action-text">Eliminar</div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $properties->links('pagination::bootstrap-4') }}
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
<style>
    
.rounded-btn {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: visible;
    margin-left: 10px;
}

.action-text {
    display: none;
    position: absolute;
    right: calc(100% + 10px); /* Posición a la izquierda del botón, fuera del flow */
    white-space: nowrap;
    background: rgba(255, 255, 255, 0.8);
    color: #333;
    border-radius: 15px;
    padding: 5px 15px;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    line-height: 1.4;
    z-index: 1;
    border-color: #333;
}

.rounded-btn:hover .action-text {
    display: flex; /* Muestra el texto al pasar el mouse */
}
.custom-text {
    font-size: 1.5rem; /* Tamaño similar al de h4 */
    font-weight: normal; /* Eliminar la negrita */
    white-space: nowrap;
    color: #242B40;
}
</style>

@parent
@stop
@section('js')

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
      document.querySelectorAll('.rounded-btn').forEach(button => {
        button.addEventListener('mouseenter', () => {
            // Desplazar el botón a la izquierda
            let prev = button.previousElementSibling;
            while(prev) {
                prev.style.transform = 'translateX(-100px)'; // Ajusta según el tamaño del texto emergente
                prev = prev.previousElementSibling;
            }
        });

        button.addEventListener('mouseleave', () => {
            // Restablecer la posición de los otros botones
            let prev = button.previousElementSibling;
            while(prev) {
                prev.style.transform = 'translateX(0px)';
                prev = prev.previousElementSibling;
            }
        });
    });
    
     </script>
     <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@stop