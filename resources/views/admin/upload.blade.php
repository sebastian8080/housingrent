@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <section class="container">
        <h1>Propiedad: {{$property->title}}</h1>
    </section>
@stop

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="mb-0">Sube las imagenes para tu propiedad</h4>
                </div>
                <div class="card-body">

                    <label>Arrastra y suelta las imagenes de tu propiedad (JPG, JPEG, PNG, .webp)</label>

                    <form action="{{ url('/admin/properties/' . $property->id  . '/upload') }}" method="POST" enctype="multipart/form-data" class="dropzone" id="myDragAndDropUploader">
                        @csrf
                        <!-- No necesitas un input de archivo aquí, Dropzone lo manejará -->
                    </form>
                    <button id="submit-all" class="btn btn-primary mt-5">Subir Imágenes</button> {{-- Botón de subida --}}
                    <h5 id="message"></h5>
                    {{-- Sección para mostrar imágenes subidas --}}
                    <div class="uploaded-images mt-5">
                        <h4>Imágenes De La Propiedad Subidas</h4>
                        @include('admin.elements.property_images')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.css">
    @parent
    
@stop

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    Dropzone.autoDiscover = false;
    $(function() {
        var myDropzone = new Dropzone("#myDragAndDropUploader", {
            paramName: "file",
            url: $("#myDragAndDropUploader").attr('action'),
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 100,
            acceptedFiles: "image/jpeg,image/png,image/webp",
            addRemoveLinks: true,
        });

        document.getElementById("submit-all").addEventListener("click", function() {
            myDropzone.processQueue();
        });

        myDropzone.on("queuecomplete", function() {
            // Elimina archivos de la instancia de Dropzone
            myDropzone.removeAllFiles();
            
            // AJAX para obtener imágenes actualizadas
            axios.get('/admin/properties/{{ $property->id }}/images')
                .then(function (response) {
                    // Actualizar el contenedor de imágenes subidas
                    $('.uploaded-images').html(response.data);
                })
                .catch(function (error) {
                    console.log(error);
                });
        });

        // Esta función manejará la eliminación de las imágenes subidas que ya están mostradas
        $(document).on('click', '.remove-image', function() {
            var button = $(this); // Guarda referencia al botón que fue clickeado
            var imageId = button.data('id'); // Obtiene el ID de la imagen
            axios.post('/admin/properties/image/delete', {
                id: imageId,
                _token: "{{ csrf_token() }}"
            }).then(function(response) {
                // Aquí buscamos el ancestro más cercano con la clase .col-md-4 y lo eliminamos
                button.closest('.col-md-4').remove();
            }).catch(function(error) {
                console.error(error.response.data);
            });
        });
    });
</script>


@stop