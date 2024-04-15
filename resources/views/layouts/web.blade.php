<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" href="{{asset('favicon3.png')}}" type="image/x-icon" />
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body, html{
            max-width: 100% !important;
            overflow-x: clip !important;
        }
    </style>
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>


    @yield('css')
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('web.home') }}"><img width="200px" class="img-fluid" src="{{ asset('img/logo-housing-rent.png') }}" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="d-flex justify-content-end">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav d-flex gap-4">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('web.home') }}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('show.upload.page') }}">Publicar Propiedades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('web.contact') }}">Contáctenos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white rounded-pill px-3" style="background-color: #242b40" href="{{ route('login') }}">Iniciar Sesion</a>
                        </li>
                    </ul>
                </div>
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
                            HOME
                        </a>
                    </div>              
                    <div>
                        <a class="text-white text-decoration-none" href="{{ route('web.contact') }}">
                            CONTACTANOS
                        </a>
                    </div>
                    <div>
                        <a class="text-white text-decoration-none" href="{{ route('get.all.properties') }}">
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
                        <p><a href="tel:+593987474637" class="asindeco" style="color: #ffffff !important; text-decoration: none"> 098-747-4637</a>
                        </p>
                    </div>
                    {{-- <div>
                        <p><a href="mailto:ventas@habitarenecuador.com" class="asindeco" style="color: #ffffff !important; text-decoration: none">ventas@habitarenecuador.com</a></p>
                    </div> --}}
                    <div>
                        <p class="text-dark-50"><a target="_blank" style="color: #ffffff; text-decoration: none" href="https://maps.app.goo.gl/fxWb66XY8BrzVhaf8"> Remigio Tamariz Crespo y Av. Fray Vicente Solano</a></p> 
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center py-5">
                <div class="d-flex gap-2">
                    <a href="https://www.facebook.com/profile.php?id=61553203397168" target="_blank">
                        <img width="60px" src="{{ asset('img/icon-facebook.png') }}" alt="">
                    </a>
                    <a href="https://www.instagram.com/_housingrent_" target="_blank">
                        <img width="60px" src="{{ asset('img/icon-instagram.png') }}" alt="">
                    </a>
                    <a target="_blank" href="https://wa.me/+593987474637?text=Hola%2C%20Housing%20Rent%20estoy%20interesado%20en%20alquilar">
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
                <p class="text-white h5">&copy; 2024 Housing Rent Group. Todos los derechos reservados.</p>
            </div>
            <div>
                <div>
                    <a class="text-white text-decoration-none" href="{{ route('web.politicas') }}">Políticas de Privacidad</a>
                    <span class="text-white h5">|</span>
                    <a class="text-white text-decoration-none" href="{{ route('web.terminos') }}">Términos y Condiciones</a>
                </div>
            </div>
        </section>
    </footer>
    @yield('js')

    <script>
        window.addEventListener('scroll', function() {

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
                    elemento.classList.remove('bgimages'); // Elimina la clase para evitar cargar la imagen múltiples veces
                }
            });
        });

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