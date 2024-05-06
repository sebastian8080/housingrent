@extends('layouts.web')

@section('title', 'Propiedades en Renta Cuenca - Housing Rent Group')

@section('meta-description',
    'Explora propiedades únicas en Ecuador para alquilar y rentar. Encuentra desde casas y
    departamentos hasta terrenos y diversos inmuebles - Housing Rent Group')

@section('meta-keywords',
    'alquiler en Ecuador, propiedades Ecuador, alquiler en Cuenca, propiedades en Cuenca , renta
    de propiedades Cuenca, renta de casas cuenca, casas de arriendo cuenca, casa de arriendo cuenca baratas')

@section('meta-robots', 'index, follow')

@section('meta-author', 'Housing Rent Group - Ecuador')



@section('og-title',
    'Propiedades en Ecuador: venta y alquiler de casas, departamentos y otros bienes raíces - Housing
    Rent Group')

@section('og-description',
    'Explora propiedades únicas en Ecuador para alquilar y rentar. Encuentra desde casas y
    departamentos hasta terrenos y diversos inmuebles - Housing Rent Group')

@section('og-image', asset('img/departamentos.jpg'))

@section('og-url', 'https://housingrentgroup.com')

@section('og-type', 'website')

@section('og-site-name', 'Housing Rent Group - Ecuador')



@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script defer src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link rel="stylesheet" href="{{ asset('css/home-style.css?v=3') }}">
    <link rel="stylesheet" href="{{ asset('css/font-style.css') }}">
@endsection

@section('content')

    <section class="banner">
        <section style="height: 650px;" class="d-flex align-items-center justify-content-center">
            <div class="text-center" style="z-index: 1">
                <h1 class="mt-3 mb-3 text-white title"
                    style="font-size: 60px; line-height: 80px; font-family: 'Sharp Grotesk'">
                    <span style="font-weight: 100 !important">Catálogo de propiedades</span><br>
                    <span style="font-weight: 500 !important">exclusivas desde $400</span>
                </h1>
                <div class="d-flex justify-content-center mb-3">
                    <button class="btn btn-light rounded-0 px-5 btn-lg"
                        style="border-radius: 15px 0px 0px 15px !important; font-weight: 300; font-family: 'Sharp Grotesk'">Alquilar</button>
                    <a href="{{ route('show.upload.page') }}" class="btn btn-outline-light btn-lg rounded-0"
                        style="border-radius: 0px 15px 15px 0px !important;; font-family: 'Sharp Grotesk'">Publica
                        Propiedad</a>
                </div>
                <form id="searchForm" method="GET">
                    @csrf
                    <div class="d-flex justify-content-center">
                        <div class="bg-white d-flex justify-content-between w-100 px-2 py-2 filters w-100"
                            style="border-radius: 15px">
                            <select name="type" id="type"
                                style="border-radius: 25px 0px 0px 25px !important; cursor: pointer; font-family: 'Sharp Grotesk'; font-weight: 300; width: 30%"
                                class="form-select rounded-0 bg-white border-0 border-end">
                                <option value="">Tipo de Propiedad</option>
                                <option data-ids="[23,1]" value="1">Casas</option>
                                <option data-ids="[24,3]" value="2">Departamentos</option>
                                <option data-ids="[25,5]" value="3">Casas Comerciales</option>
                                <option data-ids="[32,6]" value="4">Locales Comerciales</option>
                                <option data-ids="[35,7]" value="5">Oficinas</option>
                                <option data-ids="[36,8]" value="6">Suites</option>
                                <option data-ids="[29,9]" value="7">Quintas</option>
                                <option data-ids="[30,30]" value="8">Haciendas</option>
                            </select>
                            <input type="text" name="searchtxt" id="searchtxt"
                                style="font-family: 'Sharp Grotesk'; font-weight: 300; width: 45%"
                                class="form-control rounded-0 border-0 bg-white" placeholder="Ubicacion / Codigo / Tipo">
                            <button class="btn rounded-pill text-white"
                                style="background-color: #242B40; font-family: 'Sharp Grotesk'; width: 25%">BUSCAR</button>
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
                <a href="/departamentos-en-renta" style="text-decoration: none">
                    <div class="card">
                        <div class="rounded-top bgimages"
                            style="width: 250px; height: 300px; background-position: center; background-repeat: no-repeat; background-size: cover;}}')"
                            data-src="{{ asset('img/departamentos.webp') }}"></div>
                        <div class="d-flex align-items-center justify-content-center pt-2 footer-card">
                            <p style="font-family: 'Sharp Grotesk'">Departamentos</p>
                        </div>
                    </div>
                </a>
            </article>
            <article class="col-sm-3 w-auto mb-3">
                <a href="/casas-en-renta" style="text-decoration: none">
                    <div class="card">
                        <div class="rounded-top bgimages"
                            style="width: 250px; height: 300px; background-position: center; background-repeat: no-repeat; background-size: cover;"
                            data-src="{{ asset('img/casas.webp') }}"></div>
                        <div class="d-flex align-items-center justify-content-center pt-2 footer-card">
                            <p style="font-family: 'Sharp Grotesk'">Casas</p>
                        </div>
                    </div>
                </a>
            </article>
            <article class="col-sm-3 w-auto mb-3">
                <a href="/locales-comerciales-en-renta" style="text-decoration: none">
                    <div class="card">
                        <div class="rounded-top bgimages"
                            style="width: 250px; height: 300px; background-position: left center; background-repeat: no-repeat; background-size: cover;"
                            data-src="{{ asset('img/locales-comerciales.webp') }}"></div>
                        <div class="d-flex align-items-center justify-content-center pt-2 footer-card">
                            <p style="font-family: 'Sharp Grotesk'">Locales Comerciales</p>
                        </div>
                    </div>
                </a>
            </article>
            <article class="col-sm-3 w-auto mb-3">
                <a href="/oficinas-en-renta" style="text-decoration: none">
                    <div class="card">
                        <div class="rounded-top bgimages"
                            style="width: 250px; height: 300px; background-position: center; background-repeat: no-repeat; background-size: cover;"
                            data-src="{{ asset('img/oficinas.webp') }}"></div>
                        <div class="d-flex align-items-center justify-content-center pt-2 footer-card">
                            <p style="font-family: 'Sharp Grotesk'">Oficinas</p>
                        </div>
                    </div>
                </a>
            </article>
        </section>
        <section class="row justify-content-center mt-4">
            <a class="btn text-white rounded-pill w-auto" href="/propiedades-en-renta" style="background-color: #242B40" href="">Ver todas las
                propiedades</a>
        </section>
    </section>

    <section class="mt-5 pt-5 pb-5" style="background-color: #F2F2F2">
        <section class="container">
            <h2 class="text-center" style="font-family: 'Sharp Grotesk'; color: #242B40"><span
                    style="font-weight: 100">¡Publica tu propiedad desde</span> <br> <span style="font-weight: 500">la
                    comodidad de tu hogar!</span></h2>
            <p class="text-center py-2" style="font-family: 'Sharp Grotesk'; font-weight: 400; color: #242B40">Puedes
                subir tu propiedad a nuestra página web y comenzar a recibir consultas</p>
            <div class="row justify-content-center">
                <a href="{{ route('show.upload.page') }}" class="btn rounded-pill w-auto px-3"
                    style="background-color: #242B40; color: #ffffff; font-family: 'Sharp Grotesk'">Comenzar ahora</a>
            </div>
        </section>
        <section class="d-flex justify-content-center px-5">
            <img class="img-fluid" loading="lazy" data-src="{{ asset('img/muebles.png') }}"
                alt="¿Donde puedo rentar una propiedad?">
        </section>
    </section>

    <section class="bg-footer-home bgimages" data-src="{{ asset('img/footer-contact-home.webp') }}">
        <section class="row w-100 h-100 align-items-center justify-content-center">
            <article class="col-sm-6 text-center">
                <h2 class="display-6" style="font-family: 'Sharp Grotesk'; color: #ffffff"><span
                        style="font-weight: 100">¿Necesitas más</span> <br> <span
                        style="font-weight: 500">información?</span></h2>
            </article>
            <article class="col-sm-6">
                <h3 style="font-family: 'Sharp Grotesk'; font-weight: 400" class="text-white px-5 h2">Proporciónanos tus
                    datos y te contactaremos</h3>
                <form id="demo-form" action="{{ route('web.send.lead') }}" method="POST" class="px-5">
                    @csrf
                    <div class="form-group mb-2 mt-3">
                        <input type="text"
                            class="form-control bg-transparent border-0 border-bottom border-white rounded-0 inputs-contact"
                            style="color: #ffffff !important; font-family: 'Sharp Grotesk'; font-weight: 100"
                            placeholder="Nombre y Apellido" name="name" autocomplete="off" required>
                    </div>
                    <div class="form-group mb-2">
                        <input type="email"
                            class="form-control bg-transparent border-0 border-bottom border-white rounded-0 inputs-contact"
                            style="color: #ffffff !important; font-family: 'Sharp Grotesk'; font-weight: 100"
                            placeholder="Email" name="email" autocomplete="off" required>
                    </div>
                    <div class="form-group mb-2">
                        <input type="number"
                            class="form-control bg-transparent border-0 border-bottom border-white rounded-0 inputs-contact"
                            style="color: #ffffff !important; font-family: 'Sharp Grotesk'; font-weight: 100"
                            placeholder="Teléfono" name="phone" autocomplete="off" required>
                    </div>
                    <div class="form-group mb-2">
                        <textarea name="message" style="color: #ffffff !important; font-family: 'Sharp Grotesk'; font-weight: 100"
                            class="form-control bg-transparent border-0 border-bottom border-white rounded-0 inputs-contact" rows="3"
                            placeholder="Mensaje" name="message" autocomplete="off" required></textarea>
                    </div>
                    <div class="form-group mb-2">
                        <input type="hidden" name="g-recaptcha-response" id="recaptchaToken">

                        @error('captcha')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row justify-content-center mt-4">
                        <button class="btn rounded-pill w-auto px-5"
                            style="font-family: 'Sharp Grotesk'; font-weight: 400; background-color: #ffffff">ENVIAR</button>
                    </div>
                </form>
            </article>
        </section>
    </section>

@endsection

@section('js')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.getElementById('searchForm');
            if (searchForm) {
                searchForm.addEventListener('submit', function(event) {
                    event.preventDefault();

                    const typeSelect = document.getElementById('type');
                    const searchInput = document.getElementById('searchtxt');
                    let typeName = typeSelect.options[typeSelect.selectedIndex].text.toLowerCase().replace(
                        /\s+/g, '-');
                    const searchTerm = searchInput.value.trim();

                    if (!typeName || typeName === 'tipo-de-propiedad') {
                        typeName =
                        'propiedades'; // Valor predeterminado si no se selecciona ningún tipo específico
                    }
                    // Construir la URL con los parámetros de consulta
                    let queryParams = `?searchTerm=${encodeURIComponent(searchTerm)}`;
                    const propertyTypeIds = typeSelect.options[typeSelect.selectedIndex].getAttribute(
                        'data-ids');

                    // Redireccionar a la URL del listado con los filtros aplicados
                    window.location.href = `/${typeName}-en-renta${queryParams}`;
                });
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            document.getElementById('demo-form').addEventListener('submit', function(event) {
                event.preventDefault();
                grecaptcha.ready(function() {
                    grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {
                        action: 'submit'
                    }).then(function(token) {
                        document.getElementById('recaptchaToken').value = token;
                        event.target.submit();
                    });
                });
            });
        });
    </script>
@endsection
