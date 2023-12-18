<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('css')
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"><img width="200px" class="img-fluid" src="{{ asset('img/logo-housing-rent.png') }}" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="d-flex justify-content-end">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav d-flex gap-4">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Buscar Propiedades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Publicar Propiedades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">Contáctenos</a>
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
                    <div>+593 99 126 1249</div>
                    <div>info@housingecuador.com</div>
                    <div>Av. Solano y Remigio Tamariz Crespo</div>
                </div>
            </div>
            <div class="d-flex justify-content-center py-5">
                <div class="d-flex gap-2">
                    <img width="60px" src="{{ asset('img/icon-facebook.png') }}" alt="">
                    <img width="60px" src="{{ asset('img/icon-instagram.png') }}" alt="">
                    <img width="60px" src="{{ asset('img/icon-whatsapp.png') }}" alt="">
                    <img width="60px" src="{{ asset('img/icon-tiktok.png') }}" alt="">
                </div>
            </div>
        </section>
    </footer>

    @yield('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>