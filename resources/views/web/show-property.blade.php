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
    <meta property="og:image" content="https://grupohousing.com/uploads/listing/{{ explode('|', $listing->images)[0] }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style>
        .images-mobile {
            display: none !important
        }

        .img-banner:hover {
            filter: brightness(80%) !important;
        }

        @media screen and (max-width: 580px) {
            .form {
                padding-left: 0px !important;
                padding-right: 0px !important;
            }

            .images-desktop {
                display: none !important
            }

            .images-mobile {
                display: block !important
            }

            .btn-modal-images {
                display: none !important
            }
        }

        .custom-text {
            font-size: 1.5rem;
            /* Tamaño similar al de h4 */
            font-style: normal;
            /* Eliminar la negrita */
            white-space: nowrap;
            color: #242B40;
        }
    </style>

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 position-relative">
                <div id="carouselImages" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach (explode('|', $listing->images) as $image)
                            <div class="carousel-item @if ($loop->index == 0) active @endif">
                                <img src="https://grupohousing.com/uploads/listing/{{ $image }}"
                                    class="d-block w-100" style="height: auto; max-height: 600px; border-radius: 15px;">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselImages"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
                <span class="position-absolute top-0 end-0 p-2 text-white bg-dark"
                    style="font-family: 'Sharp Grotesk'; border-top-right-radius: 10px;  border-bottom-left-radius: 10px; right: 0; transform: translate(-14%, 0%);">COD:
                    {{ $listing->product_code }}</span>
            </div>
        </div>

        <div class="row mt-4 justify-content-center">
            <div class="col-12">
                <div class="d-flex justify-content-center overflow-auto">
                    <div class="d-inline-flex">
                        @foreach (explode('|', $listing->images) as $index => $image)
                            <img onclick="switchImage({{ $index }})"
                                src="https://grupohousing.com/uploads/listing/{{ $image }}" class="img-thumbnail m-1"
                                style="width: 100px; cursor: pointer;">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-7">
                <h1 class="" style="font-family: 'Sharp Grotesk'; font-weight: 500;">{{ $listing->listing_title }}</h1>
                <div class="d-flex align-items-center mt-3">
                    <i class="fa-solid fa-location-dot fs-5 me-2"></i>
                    <p class="mb-0" style="font-family: 'Sharp Grotesk'">{{ $listing->sector }}, {{ $listing->city }},
                        {{ $listing->state }}</p>
                </div>
                <div class="d-flex justify-content-around flex-wrap mt-4">
                    @if ($listing->bedroom > 0)
                        <div class="d-flex align-items-center justify-content-center flex-column text-center p-2">
                            <img src="{{ asset('img/dormitorios.png') }}" alt="Habitaciones" width="50px" height="50px">
                            <p class="pt-2 fw-bold">{{ $listing->bedroom }} Hab.</p>
                        </div>
                    @endif
                    @if ($listing->bathroom > 0)
                        <div class="d-flex align-items-center justify-content-center flex-column text-center p-2">
                            <img src="{{ asset('img/banio.png') }}" alt="Baños" width="50px" height="50px">
                            <p class="pt-2 fw-bold">{{ $listing->bathroom }}
                                {{ $listing->bathroom > 1 ? 'Baños' : 'Baño' }}</p>
                        </div>
                    @endif
                    @if ($listing->garage > 0)
                        <div class="d-flex align-items-center justify-content-center flex-column text-center p-2">
                            <img src="{{ asset('img/estacionamiento.png') }}" alt="Garaje" width="50px" height="50px">
                            <p class="pt-2 fw-bold">{{ $listing->garage }}
                                {{ $listing->garage > 1 ? 'Garajes' : 'Garaje' }}</p>
                        </div>
                    @endif
                    @if (isset($listing->construction_area) && $listing->construction_area != 0)
                        <div class="d-flex align-items-center justify-content-center flex-column text-center p-2">
                            <img src="{{ asset('img/area.png') }}" alt="Área de construcción" width="50px"
                                height="50px">
                            <p class="pt-2 fw-bold">{{ $listing->construction_area }} m<sup>2</sup></p>
                        </div>
                    @endif
                </div>
                <h2 style="font-family: 'Sharp Grotesk', sans-serif;">Acerca de esta propiedad</h2>
                <p style="font-family: 'Sharp Grotesk', sans-serif;"><strong>Sector:</strong> {{ $listing->sector }}</p>
                <p style="font-family: 'Sharp Grotesk', sans-serif; text-align: justify;" id="description">
                    <strong>Descripción:</strong>
                    <span id="short-desc">{{ Str::limit($listing->listing_description, 200, '...') }}</span>
                    <span id="full-desc" style="display: none;">{{ $listing->listing_description }}</span>
                    @if (strlen($listing->listing_description) > 200)
                        <a href="#" onclick="toggleDescription(); return false;" id="desc-toggle"
                            style="color: gray; text-decoration: underline; cursor: pointer;">Ver más</a>
                    @endif
                </p>
                @if (isset($listing->land_area) && $listing->land_area != 0)
                    <p style="font-family: 'Sharp Grotesk', sans-serif;"><strong>Metros de terreno:</strong>
                        {{ $listing->land_area }} m<sup>2</sup></p>
                @endif
                @if (isset($listing->construction_area) && $listing->construction_area != 0)
                    <p style="font-family: 'Sharp Grotesk', sans-serif;"><strong>Metros de construcción:</strong>
                        {{ $listing->construction_area }} m<sup>2</sup></p>
                @endif


                <h3 class="mt-4" style="font-family: 'Sharp Grotesk'">Ubicación</h3>
                <div class="d-flex align-items-center mt-3">
                    <i class="fa-solid fa-location-dot fs-5 me-2"></i>
                    <p class="mb-0" style="font-family: 'Sharp Grotesk'">{{ $listing->sector }}, {{ $listing->city }},
                        {{ $listing->state }}</p>
                </div>
                <div id="map" style="height: 500px;" class="my-3"></div>
            </div>

            <div class="col-md-5 mb-5">
                    <div class="sticky-top px-5" style="top: 0;">
                        <div class="text-center text-white py-3 shadow"
                            style="background-color: #242B40; border-radius: 25px 25px 0 0;">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-auto">
                                    <span class="fw-bold" style="font-size: xx-large; line-height: 50px;">
                                        ${{ $listing->property_price }}</span>
                                </div>
                                @if ($listing->aliquot && $listing->aliquot > 0)
                                    <div class="col-auto" style="border-left: 2px solid white; height: 50px; margin: 0 10px;">
                                    </div>
                                    <div class="col-auto">
                                        <div class="row">
                                            <span class="fw-bold" style="font-size: 20px;">Alícuota</span>
                                        </div>
                                        <div class="row">
                                            <span class="fw-bold" style="font-size: 20px;">
                                                ${{ $listing->aliquot }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="bg-white pt-4 pb-5 shadow px-5" style="border-radius: 0 0 25px 25px;">
                            <p class="text-center" style="font-size: x-large; font-weight: 600; ">¿Te interesa esta propiedad?
                            </p>
                            <p class="text-center">Proporciónanos tus datos y te contactaremos</p>
                            <div class="d-flex justify-content-center">
                                <form action="{{ route('web.send.lead') }}" method="POST" id="demo-form">

                                    @csrf

                                    <div class="form-group">
                                        <input type="text" name="name" placeholder="Nombre" class="w-100"
                                            style="border: none; border-bottom: 1px solid #242B40" required>
                                        <input type="text" name="lastname" placeholder="Apellido" class="w-100 mt-4"
                                            style="border: none; border-bottom: 1px solid #242B40" required>
                                    </div>

                                    <div class="form-group mt-4 w-100">
                                        <input type="number" name="phone" placeholder="Teléfono" class="w-100"
                                            style="border: none; border-bottom: 1px solid #242B40" required>
                                    </div>

                                    <div class="form-group mt-4 w-100">
                                        <input type="email" name="email" placeholder="Correo electrónico" class="w-100"
                                            style="border: none; border-bottom: 1px solid #242B40" required>
                                    </div>

                                    <div class="form-group mt-4 w-100">
                                        <textarea name="message" rows="3" placeholder="Mensaje" class="w-100"
                                            style="border: none; border-bottom: 1px solid #242B40" required></textarea>
                                    </div>

                                    <input type="hidden" name="interest" value="{{ $listing->product_code }}">

                                    <div class="form-group mt-4 w-100 d-flex justify-content-center">
                                        <button type="submit" class="btn text-white rounded-pill"
                                            style="background-color: #242B40;">ENVIAR</button>
                                    </div>

                                    <p class="text-center mt-4" style="font-size: x-large; font-weight: 600">Nuestros datos de
                                        contacto</p>

                                    <div class="d-flex gap-3 ms-4">
                                        <div class="rounded-circle d-flex justify-content-center align-items-center"
                                            style="border: 1px solid #242b40a2; width: 30px; height: 30px">
                                            <i class="fa-solid fa-phone"></i>
                                        </div>
                                        <a style="text-decoration: none" href="tel:+593964034036"
                                            class="mt-1 text-dark">096-403-4036</a>
                                    </div>

                                    <div class="d-flex gap-3 ms-4 mt-2">
                                        <div class="rounded-circle d-flex justify-content-center align-items-center"
                                            style="border: 1px solid #242b40a2; width: 30px; height: 30px">
                                            <i class="fa-brands fa-whatsapp"></i>
                                        </div>
                                        <a style="text-decoration: none"
                                            onclick="return gtag_report_conversion('https://api.whatsapp.com/send?phone=593967867998&text=Hola%20*Housing%20Rent%20Group*,%20deseo%20consultar%20por%20esta%20propiedad:%20*{{ $listing->product_code }}*');"
                                            href="https://api.whatsapp.com/send?phone=593987595789&text=Hola%20*Housing%20Rent%20Group*,%20deseo%20consultar%20por%20esta%20propiedad:%20*{{ $listing->product_code }}*"
                                            class="mt-1 text-dark">098-759-5789</a>
                                    </div>
                                    <div class="d-flex gap-3 ms-4 mt-2">
                                        <div class="rounded-circle d-flex justify-content-center align-items-center"
                                            style="border: 1px solid #242b40a2; width: 30px; height: 30px">
                                            <img width="15px" src="{{ asset('img/email-icon.png') }}" alt="">
                                        </div>
                                        <a style="text-decoration: none" href="mailto:info@housingrentgroup.com"
                                            class="mt-2 text-dark">info@housingrentgroup.com</a>
                                    </div>

                                    <div class="d-flex gap-3 ms-4 mt-2">
                                        <div class="rounded-circle d-flex justify-content-center align-items-center"
                                            style="border: 1px solid #242b40a2; width: 30px; height: 30px">
                                            <img width="15px" src="{{ asset('img/location-icon.png') }}" alt="Icono de ubicacion ">
                                        </div>
                                        <a style="text-decoration: none" class="mt-1 text-dark"
                                            href="https://maps.app.goo.gl/w1S3qxfWQ5LBob9a9">
                                            Juan Iñiguez 3-87 y Gonzalo Cordero
                                        </a>
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
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        function toggleDescription() {
            const shortDesc = document.getElementById('short-desc');
            const fullDesc = document.getElementById('full-desc');
            const toggleBtn = document.getElementById('desc-toggle');

            if (shortDesc.style.display === 'none') {
                shortDesc.style.display = 'inline';
                fullDesc.style.display = 'none';
                toggleBtn.innerHTML = 'Ver más';
            } else {
                shortDesc.style.display = 'none';
                fullDesc.style.display = 'inline';
                toggleBtn.innerHTML = 'Ver menos';
            }
        }
    </script>
    <script>
        const addactive = (id) => {
            let images = document.querySelectorAll('.active');
            images.forEach(element => {
                element.classList.remove('active');
            });
            let image = document.getElementById('img_' + id);
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
            .setContent(
                `<div class="text-center"> <b>Sector donde se encuentra la propiedad:</b> <br> <br> <span> ${title} </span> <br> <br> <img class='w-100' src='https://grupohousing.com/uploads/listing/${images}' /></div>`
            )
            .addTo(map);

        //circle.bindPopup("<b>Sector donde se ubica la propiedad</b>").openPopup();

        // L.marker(['{{ $listing->lat }}', '{{ $listing->lng }}']).addTo(map)
        //     .bindPopup(`<div class="text-center"> <b> ${title} </b> <br> <br> <img class='w-100' src='https://grupohousing.com/uploads/listing/${images}' /></div>`)
        //     .openPopup();
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var carouselElement = document.querySelector('#carouselImages');
            var carouselInstance = new bootstrap.Carousel(carouselElement);

            window.switchImage = function(index) {
                carouselInstance.to(index); // Move the carousel to the image index
            };
        });
    </script>
@endsection
