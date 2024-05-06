@extends('layouts.web')

@section('title', $listing->listing_title)

@section('css')
<meta name="title" content="{{ $listing->listing_title }}" />
<meta name="description" content="{{ $listing->listing_description }}" />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ URL::current() }}" />
<meta property="og:title" content="{{ $listing->listing_title }}" />
<meta property="og:description" content="{{ $listing->listing_description }}" />
<meta property="og:image" content="https://grupohousing.com/uploads/listing/{{explode("|", $listing->images)[0]}}" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<style>
    .images-mobile{display: none !important}
    .img-banner:hover{filter: brightness(80%) !important;}
    @media screen and (max-width: 580px){
        .form{
            padding-left: 0px !important;
            padding-right: 0px !important;
        }
        .images-desktop{display: none !important}
        .images-mobile{display: block !important}
        .btn-modal-images{display: none !important}
    }
</style>
@endsection

@section('content')
    
    <section class="container">

        <section class="row justify-content-end text-end pt-3 pb-1 pe-3">

            <span class="text-white w-auto rounded-pill shadow" style="font-size: medium; background-color: #242B40; font-size: large">COD: {{ $listing->product_code }}</span>

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
                    <div onclick="addactive(0)" data-bs-toggle="modal" data-bs-target="#modalImages" class="col-sm-8 img-banner" style="cursor: pointer; height: 484px; border-radius: 25px 0px 0px 25px ; background-position: center; background-size: cover; background-repeat: no-repeat; background-image: @if(is_array($listing->images)) url('{{ asset('storage/properties_images/', $listing->images[1]) }}') @else url('https://grupohousing.com/uploads/listing/{{explode("|", $listing->images)[1]}}') @endif"></div>

                    <div class="col-sm-4 d-grid gap-3">

                        @if(is_array($listing->images) && count($listing->images) > 1 || !is_array($listing->images) && count(explode("|", $listing->images)) > 1)
                            <div onclick="addactive(1)" data-bs-toggle="modal" data-bs-target="#modalImages" class="img-banner" style="cursor: pointer; height: 150px; border-radius: 0px 25px 0px 0px; background-position: center; background-size: cover; background-repeat: no-repeat; background-image: @if(is_array($listing->images)) url('{{ asset('storage/properties_images/', $listing->images[1]) }}') @else url('https://grupohousing.com/uploads/listing/{{explode("|", $listing->images)[1]}}') @endif"></div>
                        @endif
                        @if(is_array($listing->images) && count($listing->images) > 2 || !is_array($listing->images) && count(explode("|", $listing->images)) > 2)
                            <div onclick="addactive(2)" data-bs-toggle="modal" data-bs-target="#modalImages" class="img-banner" style="cursor: pointer; height: 150px; background-position: center; background-size: cover; background-repeat: no-repeat; background-image: url('https://grupohousing.com/uploads/listing/{{explode("|", $listing->images)[2]}}')"></div>
                        @endif
                        @if (count(explode("|", $listing->images))>3)
                            <div onclick="addactive(3)" data-bs-toggle="modal" data-bs-target="#modalImages" class="img-banner" style="cursor: pointer; height: 150px; border-radius: 0px 0px 25px 0px; background-position: center; background-size: cover; background-repeat: no-repeat; background-image: url('https://grupohousing.com/uploads/listing/{{explode("|", $listing->images)[3]}}')"></div>
                        @endif

                    </div>

                </section>

                <section class="row images-mobile">

                    <div id="carouselImages" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            {{-- https://casacredito.com/uploads/listing/{{$image}} --}}
                            @foreach (explode('|', $listing->images) as $image)
                                <div class="carousel-item @if($loop->index == 0) active @endif">
                                    <img src="https://grupohousing.com/uploads/listing/{{$image}}" class="d-block w-100" alt="">
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

                    <div class="col-sm-6 col-6 d-flex align-items-center justify-content-center btn-modal-images">

                        <button class="btn btn-outline-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#modalImages">Ver todas las fotos</button>

                    </div>

                    <div class="col-sm-6 col-6 d-flex align-items-center justify-content-center">

                        <a target="_blank" href="whatsapp://send?text={{URL::current()}}%0A%0A{{$listing->listing_title}} 🏠%0A%0A*_Housing Rent Group_*" style="text-decoration:none" class="text-dark"><i class="fa-solid fa-share me-1"></i> Compartir</a>

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

                    @if($listing->bedroom > 0) <p>{{ $listing->bedroom }} habitaciones </p> @endif
                    @if($listing->bathroom > 0)<p>/ {{ $listing->bathroom }} baños </p> @endif
                    @if($listing->garage > 0)<p>/ {{ $listing->garage }} garage</p> @endif

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
                    @if(isset($isting->land_area))
                        <p><b>Metros de terreno: </b> {{ $listing->land_area}} m<sup>2</sup></p>
                    @endif
                    @if(isset($listing->construction_area))
                        <p><b>Metros de construcción: </b>{{ $listing->construction_area}} m<sup>2</sup></p>
                    @endif

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
                        <div class="d-flex flex-column align-items-center w-100">
                            <span style="font-size: xx-large" class="fw-bold">Precio: ${{ $listing->property_price }}</span>
                            @if($listing->aliquot && $listing->aliquot > 0)
                                <span style="font-size: 25px">Alícuota: ${{ $listing->aliquot }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="bg-white pt-4 pb-5 shadow px-5" style="border-radius: 0px 0px 25px 25px">
                        <p class="text-center" style="font-size: x-large; font-weight: 600">¿Te interesa esta propiedad?</p>
                        <p class="text-center">Proporciónanos tus datos y te contactaremos</p>
                        <div class="d-flex justify-content-center">
                            <form action="{{ route('web.send.lead') }}" method="POST" id="demo-form">
                                
                                @csrf

                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Nombre" class="w-100" style="border: none; border-bottom: 1px solid #242B40" required>
                                    <input type="text" name="lastname" placeholder="Apellido" class="w-100 mt-4" style="border: none; border-bottom: 1px solid #242B40" required>
                                </div>
    
                                <div class="form-group mt-4 w-100">
                                    <input type="number" name="phone" placeholder="Teléfono" class="w-100" style="border: none; border-bottom: 1px solid #242B40" required>
                                </div>

                                <div class="form-group mt-4 w-100">
                                    <input type="email" name="email" placeholder="Correo electrónico" class="w-100" style="border: none; border-bottom: 1px solid #242B40" required>
                                </div>

                                <div class="form-group mt-4 w-100">
                                    <textarea name="message" rows="3" placeholder="Mensaje" class="w-100" style="border: none; border-bottom: 1px solid #242B40" required></textarea>
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
                                    <a style="text-decoration: none" href="tel:+593987474637" class="mt-1 text-dark">098-747-4637</a>
                                </div>

                                <div class="d-flex gap-3 ms-4 mt-2">
                                    <div class="rounded-circle d-flex justify-content-center align-items-center" style="border: 1px solid #242b40a2; width: 30px; height: 30px">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </div>
                                    <a style="text-decoration: none" href="https://api.whatsapp.com/send?phone=593987474637&text=Hola%20*Housing%20Rent%20Group*,%20deseo%20consultar%20por%20esta%20propiedad:%20*{{$listing->product_code}}*" class="mt-1 text-dark">098-747-4637</a>
                                </div>
                                <div class="form-group mb-2">
                                    <input type="hidden" name="g-recaptcha-response" id="recaptchaToken">
                
                                    @error('captcha')
                                            <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
                            @foreach (explode("|", $listing->images) as $image)
                                <div id="img_{{ $loop->index }}" class="carousel-item @if($loop->index == 0) active @endif">
                                    <img src="https://grupohousing.com/uploads/listing/{{$image}}" class="d-block w-100" alt="">
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

        const addactive = (id) => {
            let images = document.querySelectorAll('.active');
            images.forEach(element => { element.classList.remove('active'); });
            let image = document.getElementById('img_'+id);
            image.classList.add('active');
        }

        const lat = {{ $listing->lat }};
        const lng = {{ $listing->lng }};

        let map = L.map('map').setView([lat, lng], 15);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        let title = '{{ $listing->listing_title }}';
        let images = '{{ $listing->images }}'.split('|')[0];

        let circle = L.circle([lat, lng], {
            color: '#242B40',
            fillColor: '#242B40',
            fillOpacity: 0.5,
            radius: 500
        }).addTo(map);

        let popup = L.popup()
        .setLatLng([lat + 0.004, lng])
        .setContent(`<div class="text-center"> <b>Sector donde se encuentra la propiedad:</b> <br> <br> <span> ${title} </span> <br> <br> <img class='w-100' src='https://grupohousing.com/uploads/listing/${images}' /></div>`)
        .addTo(map);

        //circle.bindPopup("<b>Sector donde se ubica la propiedad</b>").openPopup();

        // L.marker(['{{ $listing->lat}}', '{{ $listing->lng}}']).addTo(map)
        //     .bindPopup(`<div class="text-center"> <b> ${title} </b> <br> <br> <img class='w-100' src='https://grupohousing.com/uploads/listing/${images}' /></div>`)
        //     .openPopup();
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', (event) => {
      document.getElementById('demo-form').addEventListener('submit', function(event) {
        event.preventDefault();
        grecaptcha.ready(function() {
          grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {action: 'submit'}).then(function(token) {
              document.getElementById('recaptchaToken').value = token;
              event.target.submit();
          });
        });
      });
    });

  </script>
@endsection