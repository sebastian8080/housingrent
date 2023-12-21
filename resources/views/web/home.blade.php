@extends('layouts.web')

@section('title', 'Housing Rent Group')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style>
        html, body{
            width: 100% !important;
            overflow-x: hidden !important;
        }
        #map { 
            width: 100%;
            height: 580px;
            box-shadow: 5px 5px 5px #888;
        }
        @media screen and (max-width: 580px){
            .redes{display: none !important}
            .text-title{position: relative !important; height: auto !important}
        }
        .card:hover{
            box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
        }
    </style>

    @livewireStyles
@endsection

@section('content')

<section class="d-flex">
    <section class="position-relative">
        <img class="img-fluid" src="{{ asset('img/home-banner.png') }}" alt="">
        <div class="position-absolute top-0 left-0 w-100 h-100 text-title">
            <div class="row h-100">
                <div class="col-sm-6"></div>
                <div class="col-sm-6 d-flex align-items-center p-5">
                    <div>
                        <h1 class="fw-bold display-5">Encuentra tu <br> hogar perfecto</h1>
                        <p>Nuestra plataforma esta diseñana para facilitar la búsqueda de las propiedades, desde aquellas que permiten mascotas hasta aquellas con características expecíficas que se adaptan a tus necesidades. <b>¡Tu hogar perfecto te espera!</b></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="width: 100px" class="redes">
        <div>
            <div style="-webkit-transform: rotate(-270deg); ">
                <p>Instagram</p>
            </div>
            <div style="-webkit-transform: rotate(-270deg); ">
                <p>Instagram</p>
            </div>
            <div style="-webkit-transform: rotate(-270deg); ">
                <p>Instagram</p>
            </div>
        </div>
    </section>
</section>

{{-- buscador --}}
<section class="container pb-5">
    <section class="p-5">
        <h2 class="text-center display-4 fw-bold">Prueba nuestro <br> buscador avanzado</h2>
    </section>
    @livewire('search-component')
</section>

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

        const showfilter = (tab_id) => {
            for (let index = 1; index < 6; index++) {
                let current_tab = document.getElementById('tab'+index);
                if(current_tab){
                    current_tab.classList.add('d-none')
                }
            }
            document.getElementById(tab_id).classList.remove('d-none');
        }

        const search = () => {
            for (let index = 1; index < 6; index++) {
                let current_tab = document.getElementById('tab'+index);
                if(current_tab){
                    current_tab.classList.add('d-none')
                }
            }
        }

    </script>
@endsection