@extends('layouts.web')

@section('title', $listing->listing_title)

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<style>
    .images-mobile{display: none !important}
    @media screen and (max-width: 580px){
        .form{
            padding-left: 0px !important;
            padding-right: 0px !important;
        }
        .images-desktop{display: none !important}
        .images-mobile{display: block !important}
    }
</style>
@endsection

@section('content')
    
    <section class="container">

        <section class="row text-end pt-3 pb-1 pe-3">

            <span class="fw-bold" style="font-size: medium">Cód: {{ $listing->product_code }}</span>

        </section>

        <section class="row">

            <article class="col-sm-5 d-flex align-items-center">

                <div>

                    <h1>{{ $listing->listing_title }}</h1>

                    <p>{{ $listing->listing_description }}</p>

                </div>

            </article>

            <article class="col-sm-7">

                <section class="row images-desktop">

                    <div class="col-sm-8" style="height: 484px; border-radius: 25px 0px 0px 25px ; background-position: center; background-size: cover; background-repeat: no-repeat; background-image: url('https://casacredito.com/uploads/listing/{{explode("|", $listing->images)[0]}}')"></div>

                    <div class="col-sm-4 d-grid gap-3">

                        <div style="height: 150px; border-radius: 0px 25px 0px 0px; background-position: center; background-size: cover; background-repeat: no-repeat; background-image: url('https://casacredito.com/uploads/listing/{{explode("|", $listing->images)[0]}}')"></div>
                        <div style="height: 150px; background-position: center; background-size: cover; background-repeat: no-repeat; background-image: url('https://casacredito.com/uploads/listing/{{explode("|", $listing->images)[0]}}')"></div>
                        <div style="height: 150px; border-radius: 0px 0px 25px 0px; background-position: center; background-size: cover; background-repeat: no-repeat; background-image: url('https://casacredito.com/uploads/listing/{{explode("|", $listing->images)[0]}}')"></div>

                    </div>

                </section>

                <section class="row images-mobile">

                    <div id="carouselImages" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            {{-- https://casacredito.com/uploads/listing/{{$image}} --}}
                            @foreach (explode('|', $listing->images) as $image)
                                <div class="carousel-item @if($loop->index == 0) active @endif">
                                    <img src="https://casacredito.com/uploads/listing/{{$image}}" class="d-block w-100" alt="">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                      </div>

                </section>

                <section class="row justify-content-center my-3 py-2">

                    {{-- <div class="col-sm-4 d-flex align-items-center justify-content-center">

                        <span>Guardar</span>

                    </div> --}}

                    <div class="col-sm-6 col-6 d-flex align-items-center justify-content-center">

                        <button class="btn btn-outline-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#modalImages">Ver todas las fotos</button>

                    </div>

                    <div class="col-sm-6 col-6 d-flex align-items-center justify-content-center">

                        <a href="#" style="text-decoration:none" class="text-dark"><i class="fa-solid fa-share"></i> Compartir</a>

                    </div>

                </section>

            </article>

        </section>
        
    </section>

    <hr>

    <section class="container mt-5">

        <section class="row">

            <article class="col-sm-7">

                <h2>{{ $listing->listing_title }}</h2>

                <div class="d-flex gap-2">

                    <p>{{ $listing->bedroom }} habitaciones /</p>
                    <p>{{ $listing->bathroom }} baños /</p>
                    <p>{{ $listing->garage }} garage</p>

                </div>

                <div class="d-flex gap-2">
                    <i class="fa-solid fa-location-dot mt-1"></i>
                    <p class="d-flex align-items-center">{{ $listing->sector }}, </p>
                    <p class="d-flex align-items-center">{{ $listing->city }}, </p>
                    <p class="d-flex align-items-center">{{ $listing->state }}</p>
                </div>

                <div>

                    <h3>Acerca de esta propiedad</h3>

                    <p><b>Sector: </b> {{ $listing->sector}}</p>
                    <p><b>Descripción: </b> {{ $listing->listing_description }}</p>
                    <p><b>Metros de terreno: </b> {{ $listing->land_area}} m<sup>2</sup></p>
                    <p><b>Metros de construcción: </b>{{ $listing->construction_area}} m<sup>2</sup></p>

                </div>

                <div>
                    <h3>Ubicación</h3>

                    <section class="my-4">
                        <section id="map" style="height: 500px">
                            
                        </section>
                    </section>
                </div>

            </article>

            <article class="col-sm-5 mb-5">

                <div class="px-5 sticky-top form" style="top: 0px">
                    <div class="d-flex justify-content-center text-white py-3 shadow" style="background-color: #242B40; border-radius: 25px 25px 0px 0px">
                        <div class="d-flex justify-content-between gap-4">
                            <span style="font-size: xx-large" class="border-end pe-4 fw-bold">${{ $listing->property_price }}</span>
                            <span style="font-size: medium">Incluye alícuota, <br> agua, luz e internet</span>
                        </div>
                    </div>
                    <div class="bg-white pt-4 pb-5 shadow px-5" style="border-radius: 0px 0px 25px 25px">
                        <p class="text-center" style="font-size: x-large; font-weight: 600">¿Te interesa esta propiedad?</p>
                        <p class="text-center">Proporciónanos tus datos y te contactaremos</p>
                        <div class="d-flex justify-content-center">
                            <form action="{{ route('web.send.lead') }}" method="POST">
                                
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

                                <input type="hidden" name="interest" value="{{ $listing->product_code }}">

                                <div class="form-group mt-4 w-100 d-flex justify-content-center">
                                    <button type="submit" class="btn text-white rounded-pill" style="background-color: #242B40;">ENVIAR</button>
                                </div>

                                <p class="text-center mt-4" style="font-size: x-large; font-weight: 600">Nuestros datos de contacto</p>

                                <div class="d-flex gap-3 ms-4">
                                    <div class="rounded-circle d-flex justify-content-center align-items-center" style="border: 1px solid #242b40a2; width: 30px; height: 30px">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                    <a style="text-decoration: none" href="tel:+593991261249" class="mt-1 text-dark">+593 99 126 1249</a>
                                </div>

                                <div class="d-flex gap-3 ms-4 mt-2">
                                    <div class="rounded-circle d-flex justify-content-center align-items-center" style="border: 1px solid #242b40a2; width: 30px; height: 30px">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </div>
                                    <a style="text-decoration: none" href="tel:+593991261249" class="mt-1 text-dark">+593 99 126 1249</a>
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
            <div class="modal-content bg-transparent">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-transparent">
                    <div id="carouselImagesModal" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach (explode("|", $listing->images) as $image)
                                <div class="carousel-item @if($loop->index == 0) active @endif">
                                    <img src="https://casacredito.com/uploads/listing/{{$image}}" class="d-block w-100" alt="">
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
        let map = L.map('map').setView([-2.899811789046444, -79.00568855005015], 14);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        let title = '{{ $listing->listing_title }}';
        let images = '{{ $listing->images }}'.split('|')[0];

        L.marker(['{{ $listing->lat}}', '{{ $listing->lng}}']).addTo(map)
            .bindPopup(`<div class="text-center"> <b> ${title} </b> <br> <br> <img class='w-100' src='https://casacredito.com/uploads/listing/${images}' /></div>`)
            .openPopup(); 
    </script>
@endsection