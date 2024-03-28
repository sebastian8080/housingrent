@if($property->multimedia->isNotEmpty())
    <div class="row">
        @foreach($property->multimedia as $image)
            <div class="col-md-4 d-flex justify-content-center">
                <div class="card mt-3" style="width: 18rem;">
                    <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 180px; overflow:hidden;">
                        <img src="{{ Storage::url($image->filename) }}" alt="Imagen Subida" style="min-width: 100%; height: auto; object-fit: cover;">
                    </div>
                    <div class="card-body text-center">
                        <button class="btn btn-danger remove-image" data-id="{{ $image->id }}">Eliminar</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p>No hay imágenes subidas para esta propiedad.</p>
@endif