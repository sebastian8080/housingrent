<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body, html{
            width: 100%;
            overflow-x: hidden;
        }
    </style>

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
                        <a class="nav-link" href="#">Buscar Propiedades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('show.upload.page') }}">Publicar Propiedades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('web.contact') }}">Contáctenos</a>
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
                    <div>HOME</div>
                    <div>BENEFICIOS</div>
                    <div>BUSCADOR</div>
                    <div>DESTACADAS</div>
                    <div>CATÁLOGO</div>
                    <div>SOCIOS</div>
                </div>
                <div class="col-sm-2 text-white">
                    <div>SERVICIOS</div>
                    <div>BUSCAR PROPIEDAD</div>
                    <div>PUBLICAR PROPIEDAD</div>
                </div>
                <div class="col-sm-2 text-white">
                    <div>CONTACTOS</div>
                    <div>
                        <p><a href="tel:+593999944247" class="asindeco" style="color: #ffffff !important; text-decoration: none"> 099-994-4247</a> <br>
                            <a href="tel:+593999944590" class="asindeco" style="color: #ffffff !important; text-decoration: none"> 099-994-4590</a> <br>
                            <a href="tel:+593987746833" class="asindeco" style="color: #ffffff !important; text-decoration: none"> 098-774-6833</a>
                        </p>
                    </div>
                    {{-- <div>
                        <p><a href="mailto:ventas@habitarenecuador.com" class="asindeco" style="color: #ffffff !important; text-decoration: none">ventas@habitarenecuador.com</a></p>
                    </div> --}}
                    <div>
                        <p class="text-dark-50"><a target="_blank" style="color: #ffffff; text-decoration: none" href="https://g.page/r/CV7pH0E3AVo_EBA"> Av. Juan Iñiguez 3-87 y D. Gonzalo Cordero - Edificio Santa Lucia</a></p> 
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center py-5">
                <div class="d-flex gap-2">
                    <a href="https://www.facebook.com/profile.php?id=61553203397168" target="_blank">
                        <img width="60px" src="{{ asset('img/icon-facebook.png') }}" alt="">
                    </a>
                    <a href="https://www.instagram.com/housingrentgroup" target="_blank">
                        <img width="60px" src="{{ asset('img/icon-instagram.png') }}" alt="">
                    </a>
                    <a target="_blank" href="https://api.whatsapp.com/send?phone=593983849073&text=Hola%20*Housing%20Rent%20Group*,%20deseo%20consultar%20por%20sus%20servicios">
                        <img width="60px" src="{{ asset('img/icon-whatsapp.png') }}" alt="">
                    </a>
                    <a href="https://www.tiktok.com/@housingrent" target="_blank">
                        <img width="60px" src="{{ asset('img/icon-tiktok.png') }}" alt="">
                    </a>
                </div>
            </div>
        </section>
    </footer>

    @yield('js')
</body>
</html>