@extends('layouts.web')

@section('title', 'Housing Rent Group')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link rel="stylesheet" href="{{ asset('css/home-style.css?v=1') }}">
    <link rel="stylesheet" href="{{ asset('css/font-style.css') }}">
@livewireStyles
@endsection

@section('content')

<section class="banner">
    <section style="height: 650px;" class="d-flex align-items-center justify-content-center">
        <div class="text-center" style="z-index: 1">
            <img width="800px" class="logo-housing" style="border-bottom: 1px solid #ffffff" src="{{ asset('img/logo.png') }}" alt="">
            <p class="mt-3 mb-3 text-white title" style="font-size: 40px; line-height: 40px; font-family: 'Sharp Grotesk'"><span style="font-weight: 100 !important">¡Tu alquiler está a un clic de</span> <br> <span style="font-weight: 500 !important">distancia!</span></p>
            <div class="d-flex justify-content-center mb-3">
                <button class="btn btn-light rounded-0 px-5" style="border-radius: 15px 0px 0px 15px !important; font-weight: 600">Alquilar</button>
                <a href="{{ route('show.upload.page') }}" class="btn btn-outline-light rounded-0" style="border-radius: 0px 15px 15px 0px !important;">Publica Propiedad</a>
            </div>
            <form action="{{ route('web.search') }}" method="GET">
                @csrf
                <div class="d-flex justify-content-center">
                    <div class="bg-white d-flex w-auto px-2 py-2 filters" style="border-radius: 25px">
                        <select name="type" id="type" style="border-radius: 25px 0px 0px 25px !important; cursor: pointer" class="form-select w-auto rounded-0 bg-white border-0 border-end">
                            <option value="Departamentos">Departamentos</option>
                            <option value="Casas">Casas</option>
                            <option value="Casas Comerciales">Casas Comerciales</option>
                            <option value="Locales Comerciales">Locales Comerciales</option>
                            <option value="Oficinas">Oficinas</option>
                        </select>
                        <input type="text" name="searchtxt" id="searchtxt" class="form-control w-auto rounded-0 border-0 bg-white" placeholder="Ubicacion / Codigo">
                        <button class="btn rounded-pill text-white" style="background-color: #242B40">BUSCAR</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</section>

<section class="container my-5">
    <h2 class="text-center" style="font-family: 'Sharp Grotesk'; font-weight: 100">Explora nuestras propiedades</h2>
    <section class="row mt-5 justify-content-center">
        <article class="col-sm-3 w-auto mb-3">
            <a href="{{ route('web.redirect.search', 'departamentos') }}" style="text-decoration: none">
                <div class="card">
                    <div class="rounded-top" style="width: 250px; height: 300px; background-position: center; background-repeat: no-repeat; background-size: cover; background-image: url('{{asset('img/departamentos.jpg')}}')"></div>
                    <div class="d-flex align-items-center justify-content-center pt-2 footer-card">
                        <p style="font-family: 'Sharp Grotesk'">Departamentos</p>
                    </div>
                </div>
            </a>
        </article>
        <article class="col-sm-3 w-auto mb-3">
            <a href="{{ route('web.redirect.search', 'casas') }}" style="text-decoration: none">
                <div class="card">
                    <div class="rounded-top" style="width: 250px; height: 300px; background-position: center; background-repeat: no-repeat; background-size: cover; background-image: url('{{asset('img/casas.jpg')}}')"></div>
                    <div class="d-flex align-items-center justify-content-center pt-2 footer-card">
                        <p style="font-family: 'Sharp Grotesk'">Casas</p>
                    </div>
                </div>
            </a>
        </article>
        <article class="col-sm-3 w-auto mb-3">
            <a href="{{ route('web.redirect.search', 'locales-comerciales') }}" style="text-decoration: none">
                <div class="card">
                    <div class="rounded-top" style="width: 250px; height: 300px; background-position: center; background-repeat: no-repeat; background-size: cover; background-image: url('{{asset('img/locales_comerciales.jpg')}}')"></div>
                    <div class="d-flex align-items-center justify-content-center pt-2 footer-card">
                        <p style="font-family: 'Sharp Grotesk'">Locales Comerciales</p>
                    </div>
                </div>
            </a>
        </article>
        <article class="col-sm-3 w-auto mb-3">
            <a href="{{ route('web.redirect.search', 'oficinas') }}" style="text-decoration: none">
                <div class="card">
                    <div class="rounded-top" style="width: 250px; height: 300px; background-position: center; background-repeat: no-repeat; background-size: cover; background-image: url('{{asset('img/oficinas.jpg')}}')"></div>
                    <div class="d-flex align-items-center justify-content-center pt-2 footer-card">
                        <p style="font-family: 'Sharp Grotesk'">Oficinas</p>
                    </div>
                </div>
            </a>
        </article>
    </section>
    <section class="row justify-content-center mt-4">
        <a class="btn text-white rounded-pill w-auto" style="background-color: #242B40" href="#">Ver todas las propiedades</a>
    </section>
</section>

{{-- buscador --}}

{{-- este section es momentaneo hasta subir el filtro --}}
{{-- <section class="container">
    <section class="p-5">
        <h2 class="text-center display-4 fw-bold">Las mejores propiedades <br> en renta del Ecuador</h2>
    </section>
</section> --}}

@endsection

@section('js')
    @livewireScripts
    <script>
        // var map = L.map('map').setView([-2.900669036449896, -79.00723353370014], 14);

        // L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        // }).addTo(map);

        // let coordinates = @json($properties) 

        // coordinates.forEach(element => {
        //     let images = element.images.split('|')[0];
        //     L.marker([element.lat, element.lng]).addTo(map)
        //         .bindPopup(`<div class="text-center"> <b> ${element.listing_title} </b> <br> <br> <img class='w-100' src='https://casacredito.com/uploads/listing/${images}' /> <br> <br> <a href="#">Ver propiedad</a></div>`)
        //         .openPopup(); 
        // });

    </script>
@endsection