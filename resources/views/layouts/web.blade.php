<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('favicon3.png') }}" type="image/x-icon" />
    <!-- Meta Descriptions -->
    <meta name="description" content="@yield('meta-description', 'Alquiler, compra y venta de propiedades en Ecuador: casas, apartamentos, terrenos y otros bienes raíces. ¡La propiedad de tus sueños está en Housing Rent Group!')">
    <meta name="keywords" content="@yield('meta-keywords', 'alquiler, arriendo, renta, propiedades, bienes raíces, inmuebles, casas, departamentos, apartamentos, condominios, villas, suites, habitaciones, locales comerciales, oficinas, terrenos, espacios comerciales, residenciales, urbanizaciones, barrios, áreas comerciales, zonas residenciales, áreas industriales, sector inmobiliario, mercado inmobiliario, agencias inmobiliarias')">
    <meta name="robots" content="@yield('meta-robots', 'index, follow')">
    <meta name="author" content="@yield('meta-author', 'Housing Rent Group - Ecuador')">

    <!-- Social Media Meta Tags -->
    <meta property="og:title" content="@yield('og-title', 'Propiedades en Ecuador: venta y alquiler de casas, departamentos y otros bienes raíces - Housing Rent Group')">
    <meta property="og:description" content="@yield('og-description', 'Explora oportunidades únicas en Ecuador para alquilar, adquirir o vender propiedades. Encuentra desde casas y apartamentos hasta terrenos y diversos inmuebles. Tu propiedad ideal te espera en Housing Rent')">
    <meta property="og:image" content="@yield('og-image', 'link-to-default-image.png')">
    <meta property="og:url" content="@yield('og-url', 'https://housingrentgroup.com')">
    <meta property="og:type" content="@yield('og-type', 'website')">
    <meta property="og:site_name" content="@yield('og-site-name', 'Housing Rent Group - Ecuador')">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- Iconos de bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body,
        html {
            max-width: 100% !important;
            overflow-x: clip !important;
            background: url('{{ asset('img/fondo-dashboard.jpg') }}');
            background-size: cover;
        }

        .navbar {
            background: transparent;
            padding: 10px 0;
        }

        .navbar-light .navbar-nav .nav-link {
            color: #242B40;
            font-size: 18px;
            padding: 10px 15px;
            border-bottom: 3px solid transparent;
            transition: border-color 0.3s ease;
        }

        .navbar-light .navbar-nav .nav-link.active,
        .navbar-light .navbar-nav .nav-link:hover {
            border-bottom-color: #242B40;
            color: #242b40;
        }

        .navbar-light .navbar-nav .dropdown-menu {
            min-width: 10rem;
        }

        .navbar-light .navbar-nav .dropdown-item {
            color: #242B40;
            transition: background-color 0.3s;
        }

        .navbar-light .navbar-nav .dropdown-item:hover,
        .navbar-light .navbar-nav .dropdown-item:focus {
            background-color: #1d2233;
            color: #ffffff;
        }
        .call-btn{
            background-color: #242b40;
            color: #ffffff !important;
            border-radius: 15px;
            font-weight: 700;
        }
        /*Estilos generales del boton whatsapp*/
        .whatsapp-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #25D366;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            animation: breathe 2s ease-in-out infinite;
        }

        /*Estilos solo al icono whatsapp*/
        .whatsapp-btn i {
            color: #fff;
            font-size: 24px;
            animation: beat 2s ease-in-out infinite;
            text-decoration: none;
        }

        /*Estilos con animation contorno respirando*/
        @keyframes breathe {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.5);
            }
            70% {
                box-shadow: 0 0 0 15px rgba(37, 211, 102, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
            }
        }

        /*Estilos de animacion del icono latiendo*/
        @keyframes beat {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
    <script defer src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>

    @if (request()->getHost() === 'housingrentgroup.com')
        <!-- Google tag (gtag.js) -->
        {{-- <script defer src="https://www.googletagmanager.com/gtag/js?id=G-B53KCMR7P6"></script> --}}
        <script>
            setTimeout(() => {
                window.dataLayer = window.dataLayer || [];

                function gtag() {
                    dataLayer.push(arguments);
                }
                gtag('js', new Date());

                gtag('config', 'G-B53KCMR7P6');
            }, 3000);
        </script>
    @endif
    <script>
        function gtag_report_conversion(url) {
            var callback = function() {
                if (typeof(url) != 'undefined') {
                    window.location = url;
                }
            };
            gtag('event', 'conversion', {
                'send_to': 'AW-11250334200/hHHyCNmbrq4ZEPjzyfQp',
                'event_callback': callback
            });
            return false;
        }
    </script>
    @yield('css')

    @yield('header')
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11250334200"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'AW-11250334200');
</script>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('web.home') }}">
                <img width="200px" class="img-fluid" src="{{ asset('img/logo-housing-rent.png') }}"
                    alt="Logo Housing Rent">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link @yield('home')" href="{{ route('web.home') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('published')" href="{{ route('show.upload.page') }}">Publicar
                            Propiedades</a>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link @yield('contact')" href="{{ route('web.contact') }}">Contáctenos</a>
                    </li>
                    <li class="nav-item dropdown d-flex align-items-center">
                        <a class="dropdown-toggle btn" href="#" id="navbarDropdownMenuLink"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-circle-user"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('login') }}">Iniciar Sesión</a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}">Registrarse</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link call-btn" href="tel:+593964034037">096-403-4037</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    @yield('content')


    <footer style="background-color: #242b40">
        <section class="container">
            <div class="row p-5 border-bottom border-white border-3">
                <div class="col-sm-6">
                    <img width="250px" src="{{ asset('img/logo-footer.png') }}" alt="">
                </div>
                <div class="col-sm-2 text-white">
                    <div>
                        <a class="text-white text-decoration-none" href="{{ route('web.home') }}">
                            INICIO
                        </a>
                    </div>
                    <div>
                        <a class="text-white text-decoration-none" href="{{ route('web.contact') }}">
                            CONTACTANOS
                        </a>
                    </div>
                    <div>
                        <a class="text-white text-decoration-none" href="/propiedades-en-renta">
                            PROPIEDADES
                        </a>
                    </div>
                </div>

                <div class="col-sm-2 text-white">
                    <div>SERVICIOS</div>
                    <div>
                        <a class="text-white text-decoration-none" href="{{ route('show.upload.page') }}">
                            PUBLICAR PROPIEDAD
                        </a>
                    </div>
                </div>
                <div class="col-sm-2 text-white">
                    <div>CONTACTOS</div>
                    <div>
                        <p class="m-0">
                            <a href="tel:+593964034037" class="asindeco" style="color: #ffffff !important; text-decoration: none"><i class="fa-solid fa-phone text-white"></i> 
                                096-403-4037
                            </a>
                        </p>
                        <p class="m-0">
                            <a class="text-white" style="text-decoration: none" href="https://api.whatsapp.com/send?phone=593987595789&text=Hola,%20estoy%20interesado%20en%20una%20propiedad%20en%renta">
                                <i class="fa-brands fa-whatsapp text-white"></i> 098-759-5789
                            </a>
                        </p>
                    </div>
                    {{-- <div>
                        <p><a href="mailto:ventas@habitarenecuador.com" class="asindeco" style="color: #ffffff !important; text-decoration: none">ventas@habitarenecuador.com</a></p>
                    </div> --}}
                    <div>
                        <p class="text-dark-50">
                            <a target="_blank" style="color: #ffffff; text-decoration: none"
                                href="https://maps.app.goo.gl/w1S3qxfWQ5LBob9a9"> 
                                Juan Iñiguez 3-87 y Gonzalo Cordero
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center py-5">
                <div class="d-flex gap-2">
                    <a href="https://www.facebook.com/profile.php?id=61558563860180" target="_blank">
                        <img width="60px" src="{{ asset('img/icon-facebook.png') }}" alt="">
                    </a>
                    <a href="https://www.instagram.com/_housingrent_" target="_blank">
                        <img width="60px" src="{{ asset('img/icon-instagram.png') }}" alt="">
                    </a>
                    <a target="_blank"
                        href="https://api.whatsapp.com/send?phone=593987595789&text=Hola,%20estoy%20interesado%20en%20una%20propiedad%20en%renta"
                        onclick="return gtag_report_conversion('https://api.whatsapp.com/send?phone=593987595789&text=Hola,%20estoy%20interesado%20en%20una%20propiedad%20en%renta');">
                        <img width="60px" src="{{ asset('img/icon-whatsapp.png') }}" alt="">
                    </a>

                    <a href="https://www.tiktok.com/@housingrent" target="_blank">
                        <img width="60px" src="{{ asset('img/icon-tiktok.png') }}" alt="">
                    </a>
                </div>
            </div>
        </section>
        <section class="row text-center pb-5">
            <div>
                <p class="text-white h5">&copy; 2025 Housing Rent Group. Todos los derechos reservados.</p>
            </div>
            <div>
                <div>
                    <a class="text-white text-decoration-none" href="{{ route('web.politicas') }}">Políticas de
                        Privacidad</a>
                    <span class="text-white h5">|</span>
                    <a class="text-white text-decoration-none" href="{{ route('web.terminos') }}">Términos y
                        Condiciones</a>
                </div>
            </div>
        </section>
    </footer>

    <a href="https://api.whatsapp.com/send?phone=593987595789&text=Hola,%20estoy%20interesado%20en%20una%20propiedad%20en%renta" target=”_blank” class="whatsapp-btn">
        <i class="bi bi-whatsapp"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    @yield('js')

    <script>
        setTimeout(() => {
            let script = document.createElement('script');
            script.src = "https://www.googletagmanager.com/gtag/js?id=G-B53KCMR7P6";
            document.head.appendChild(script);
        }, 3000);

        window.addEventListener('scroll', function() {
            loadImages();
        });

        window.addEventListener('load', function() {
            loadImages();
        });

        const loadImages = () => {
            let images = document.querySelectorAll('img[loading="lazy"]');
            let BGImages = document.querySelectorAll('.bgimages');

            images.forEach(function(image) {
                if (elementInViewport(image)) {
                    image.setAttribute('src', image.getAttribute('data-src'));
                    image.removeAttribute('loading');
                }
            });

            BGImages.forEach(function(elemento) {
                if (elementInViewport(elemento)) {
                    var urlImagen = elemento.getAttribute('data-src');
                    elemento.style.backgroundImage = 'url(' + urlImagen + ')';
                    elemento.classList.remove(
                        'bgimages'); // Elimina la clase para evitar cargar la imagen múltiples veces
                }
            });
        }

        function elementInViewport(el) {
            var rect = el.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        }
    </script>
</body>

</html>
