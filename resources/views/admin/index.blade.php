@extends('adminlte::page')

@section('title', 'Mis Propiedades')

@section('content_header')
    <h1>Mis Propiedades</h1>
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
                        <a href="{{ url('/admin/properties/edit/' . $property->id) }}" class="btn btn-primary">Editar</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
