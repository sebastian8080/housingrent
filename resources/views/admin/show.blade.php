@extends('admin.elements.preview')

@section('title', $domain->title)

@section('css')
<meta name="title" content="{{ $domain->title }}" />
<meta name="description" content="{{ $domain->description }}" />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ URL::current() }}" />
<meta property="og:title" content="{{ $domain->title }}" />
<meta property="og:description" content="{{ $domain->description }}" />
{{-- Asegúrate de actualizar la URL de la imagen aquí --}}
<style>
    body { padding-top: 70px; } /* Ajusta este valor según la altura de tu barra de navegación */
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endsection
@section('content_header')
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Opciones</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('properties.edit', $domain->id) }}">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('properties.upload.images', $domain->id) }}">
                            <i class="fas fa-images"></i> Editar Imágenes
                        </a>
                    </li>
                    @can('have_permissions')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('properties.manage') }}">
                                <i class="fas fa-list"></i> Mis Propiedades
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('properties.index') }}">
                                <i class="fas fa-list"></i> Propiedades
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </div>
    </nav>
@stop
@section('content')
<section class="container">
    <section class="row justify-content-end text-end pt-3 pb-1 pe-3">
        <span class="text-white w-auto rounded-pill shadow" style="font-size: medium; background-color: #242B40; font-size: large">COD: {{ $domain->code }}</span>
    </section>

    <section class="row">
        <article class="col-sm-5 d-flex align-items-center">
            <div>
                <h1>{{ $domain->title }}</h1>
                <p>{{ $domain->description }}</p>
            </div>
        </article>

        {{-- Sección de imágenes --}}
        <article class="col-sm-7">
            <section class="row images-desktop">
                @php $multimedia = $domain->multimedia->take(4); @endphp
                @if($multimedia->isNotEmpty())
                    <div onclick="addactive(0)" data-bs-toggle="modal" data-bs-target="#modalImages" class="col-sm-8 img-banner" style="cursor: pointer; height: 484px; border-radius: 25px 0px 0px 25px; background-image: url('{{ asset('storage/' . $multimedia[0]->filename) }}'); background-position: center; background-size: cover; background-repeat: no-repeat;"></div>
                    <div class="col-sm-4 d-grid gap-3">
                        @foreach($multimedia->slice(1) as $index => $media)
                            <div onclick="addactive({{ $index + 1 }})" data-bs-toggle="modal" data-bs-target="#modalImages" class="img-banner" style="cursor: pointer; height: 150px; background-image: url('{{ asset('storage/' . $media->filename) }}'); background-position: center; background-size: cover; background-repeat: no-repeat;"></div>
                        @endforeach
                    </div>
                @else
                    <div class="col-12">
                        <p>No hay imágenes disponibles para esta propiedad.</p>
                    </div>
                @endif
            </section>
        </article>
    </section>
</section>

<hr>

<section class="container mt-5">
    <section class="row">
        <article class="col-sm-7">
            <h2>{{ $domain->title }}</h2>
            <div class="d-flex gap-2">
                <p>{{ $domain->bedroom }} habitaciones /</p>
                <p>{{ $domain->bathroom }} baños /</p>
                <p>{{ $domain->garage }} garage</p>
            </div>

            <div class="d-flex gap-2">
                <i class="fa-solid fa-location-dot mt-1"></i>
                <p>{{ $domain->sector }}, {{ $domain->city }}, {{ $domain->state_province }}</p>
            </div>

            <div>
                <h3>Acerca de esta propiedad</h3>
                <p><b>Sector:</b> {{ $domain->sector }}</p>
                <p><b>Descripción:</b> {{ $domain->description }}</p>
                <p><b>Metros de terreno:</b> {{ $domain->land_area }} m<sup>2</sup></p>
                <p><b>Metros de construcción:</b> {{ $domain->construction_area }} m<sup>2</sup></p>
            </div>
            <div>
                <h3>Beneficios de la Propiedad</h3>
                <div class="row">
                    @php
                        $benefitsByType = $domain->benefits->groupBy('typeBenefit.name');
                    @endphp
            
                    @foreach ($benefitsByType as $type => $benefits)
                        <div class="col-md-4">
                            <h4>{{ $type }}</h4>
                            <ul class="list-unstyled">
                                @foreach ($benefits as $benefit)
                                    <li><i class="fa-solid fa-check"></i> {{ $benefit->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <h3>Ubicación</h3>
                <section class="my-4">
                    <div id="map" style="height: 500px"></div>
                </section>
            </div>
        </article>
        <article class="col-sm-5 mb-5">

            <div class="px-5 sticky-top form" style="top: 0px">
                <div class="d-flex justify-content-center text-white py-3 shadow" style="background-color: #242B40; border-radius: 25px 25px 0px 0px">
                    <div class="d-flex justify-content-between gap-4">
                        <span style="font-size: xx-large" class="border-end pe-4 fw-bold">${{ $domain->max_price }}</span>
                        <span style="font-size: medium">Incluye alícuota, <br> agua, luz e internet</span>
                    </div>
                </div>
                <div class="bg-white pt-4 pb-5 shadow px-5" style="border-radius: 0px 0px 25px 25px">
                    <p class="text-center" style="font-size: x-large; font-weight: 600">¿Te interesa esta propiedad?</p>
                    <p class="text-center">Proporciónanos tus datos y te contactaremos</p>
                    <div class="d-flex justify-content-center">
                        <form>
                            
                            @csrf

                            <div class="form-group">
                                <input type="text" name="name" placeholder="Nombre" class="w-100" style="border: none; border-bottom: 1px solid #242B40">
                                <input type="text" name="lastname" placeholder="Apellido" class="w-100 mt-4" style="border: none; border-bottom: 1px solid #242B40">
                            </div>

                            <div class="form-group mt-4 w-100">
                                <input type="number" name="phone" placeholder="Teléfono" class="w-100" style="border: none; border-bottom: 1px solid #242B40">
                            </div>

                            <div class="form-group mt-4 w-100">
                                <input type="email" name="email" placeholder="Correo electrónico" class="w-100" style="border: none; border-bottom: 1px solid #242B40">
                            </div>

                            <div class="form-group mt-4 w-100">
                                <textarea name="message" rows="3" placeholder="Mensaje" class="w-100" style="border: none; border-bottom: 1px solid #242B40"></textarea>
                            </div>

                            <input type="hidden" name="interest" value="{{ $domain->code }}">

                            <div class="form-group mt-4 w-100 d-flex justify-content-center">
                                <button type="submit" class="btn text-white rounded-pill" style="background-color: #242B40;">ENVIAR</button>
                            </div>

                            <p class="text-center mt-4" style="font-size: x-large; font-weight: 600">Nuestros datos de contacto</p>

                            <div class="d-flex gap-3 ms-4">
                                <div class="rounded-circle d-flex justify-content-center align-items-center" style="border: 1px solid #242b40a2; width: 30px; height: 30px">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <a style="text-decoration: none" href="tel:+593983849073" class="mt-1 text-dark">098-384-9073</a>
                            </div>

                            <div class="d-flex gap-3 ms-4 mt-2">
                                <div class="rounded-circle d-flex justify-content-center align-items-center" style="border: 1px solid #242b40a2; width: 30px; height: 30px">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </div>
                                <a style="text-decoration: none" href="https://api.whatsapp.com/send?phone=593983849073&text=Hola%20*Housing%20Rent%20Group*,%20deseo%20consultar%20por%20sus%20servicios" class="mt-1 text-dark">098-384-9073</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </article>
    </section>
</section>

<div class="modal fade" id="modalImages" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header bg-transparent border-0">
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-transparent">
                <div id="carouselImagesModal" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($multimedia as $index => $image)
                            <div id="img_{{ $index }}" class="carousel-item @if($index == 0) active @endif">
                                <img src="{{ asset('storage/' . $image->filename) }}" class="d-block w-100" alt="">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselImagesModal" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselImagesModal" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // No necesitas estos alertas una vez confirmado que todo funciona
        // alert("SI");

        const addactive = (id) => {
            let images = document.querySelectorAll('.carousel-item.active');
            images.forEach(element => { element.classList.remove('active'); });
            let image = document.getElementById('img_' + id);
            image.classList.add('active');
        };

        const lat = {{ $domain->lat }};
        const lng = {{ $domain->lng }};

        // Inicializa el mapa
        let map = L.map('map').setView([lat, lng], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Asegura que existe al menos una imagen en multimedia antes de intentar acceder a ella
        @if($domain->multimedia->isNotEmpty())
            const imageUrl = "{{ asset('storage/' . $domain->multimedia->first()->filename) }}";
            const popupContent = `<b>{{ $domain->title }}</b><br><img src='${imageUrl}' class='w-100' />`;

            // Agrega un marcador basado en la latitud y longitud con la imagen
            L.marker([lat, lng]).addTo(map)
                .bindPopup(popupContent).openPopup();
        @else
            // Solo texto, si no hay imagen disponible
            L.marker([lat, lng]).addTo(map)
                .bindPopup("<b>{{ $domain->title }}</b>").openPopup();
        @endif

        map.invalidateSize();
    });
</script>
@endsection
