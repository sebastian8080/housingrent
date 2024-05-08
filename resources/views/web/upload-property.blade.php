@extends('layouts.web')
@section('published', 'active')
@section('title', 'Publique su propiedad Para Rentas - Housing Rent group')

@section('meta-description', 'Publique propiedades únicas en Ecuador para alquilar y rentar propiedades. Encuentra desde casas y departamentos hasta terrenos y diversos inmuebles. - Housing Rent Group')

@section('meta-keywords', 'alquiler, rentas, propiedades, casas, departamentos, comerciales, oficinas, Ecuador')

@section('meta-robots', 'index, follow')

@section('meta-author', 'Housing Rent Group - Ecuador')

@section('og-title', 'Propiedades en Ecuador: venta y alquiler de casas, departamentos y otros bienes raíces - Housing Rent Group')

@section('og-description', 'Publique propiedades únicas en Ecuador para alquilar y rentar propiedades. Encuentra desde casas y departamentos hasta terrenos y diversos inmuebles. - Housing Rent Group')

@section('og-image', asset('img/departamentos.jpg'))

@section('og-url', 'https://housingrentgroup.com')

@section('og-type', 'website')

@section('og-site-name', 'Housing Rent Group - Ecuador')



@section('css')
    <link rel="stylesheet" href="{{ asset('css/font-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/info-upload-property.css') }}">
    <style>
        @media screen and (max-width: 580px){
            .padding-x-mobile{
                padding-left: 0px !important;
                padding-right: 0px !important;
            }
            .display-6{
                font-size: 22px !important;
            }
        }
       @media (min-width: 768px) {
        .carousel-inner {
            display: flex;
        }
        .carousel-item {
            margin-right: 0;
            flex: 0 0 33.333333%;
            display: block;
        }
        }
        .carousel-inner{
    padding: 1em;
}
.card{
    margin: 0 .5em;
    box-shadow: 2px 6px 8px 0 rgba(22, 22, 26, 0.18);
    border: none;
}
.carousel-control-prev, .carousel-control-next{
    background-color: #e1e1e1;
    width: 6vh;
    height: 6vh;
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
}
    </style>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> --}}
    
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> --}}
@endsection

@section('content')

    <section class="bg-footer-home">
        <section class="row w-full h-100 align-items-center justify-content-center">
            <article class="col-sm-6 col-12 text-center d-flex align-items-center justify-content-center">
                <h1 class="display-6" style="font-family: 'Sharp Grotesk'; color: #ffffff"><span style="font-weight: 100">¡Desde tu casa con un click</span> <br> <span style="font-weight: 500">publica tu propiedad!</span></h1>
            </article>
            <article class="col-sm-6 col-12">
                <h2 style="font-family: 'Sharp Grotesk'; font-weight: 400" class="text-white px-5 h2">Registro de Usuario</h2>
                <form action="{{ route('register') }}" method="POST" class="px-5">
                    @csrf
                    <div class="form-group mb-3 mt-3">
                        <input type="text" class="form-control bg-transparent border-0 border-bottom border-white rounded-0 inputs-contact" style="color: #ffffff !important; font-family: 'Sharp Grotesk'; font-weight: 100" placeholder="Nombre y Apellido" name="name" autocomplete="off" required>
                    </div>+
                    <div class="form-group mb-3">
                        <input type="email" class="form-control bg-transparent border-0 border-bottom border-white rounded-0 inputs-contact" style="color: #ffffff !important; font-family: 'Sharp Grotesk'; font-weight: 100" placeholder="Email" name="email" autocomplete="off" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="number" class="form-control bg-transparent border-0 border-bottom border-white rounded-0 inputs-contact" style="color: #ffffff !important; font-family: 'Sharp Grotesk'; font-weight: 100" placeholder="Teléfono" name="phone" autocomplete="off" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password" id="password" class="form-control bg-transparent border-0 border-bottom border-white rounded-0 inputs-contact" style="color: #ffffff !important; font-family: 'Sharp Grotesk'; font-weight: 100" placeholder="Cree una contraseña" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password_confirmation" id="password" class="form-control bg-transparent border-0 border-bottom border-white rounded-0 inputs-contact" style="color: #ffffff !important; font-family: 'Sharp Grotesk'; font-weight: 100" placeholder="Confirmar contraseña" required>
                    </div>
                    <div class="row justify-content-center mt-4">
                        <button class="btn rounded-pill w-auto px-5" style="font-family: 'Sharp Grotesk'; font-weight: 400; background-color: #ffffff">REGISTRARSE</button>
                    </div>
                </form>
            </article>
        </section>
    </section>

    <section class="container mt-5">
        <h2 style="font-family: 'Sharp Grotesk'; color: #242B40" class="text-center display-6 pb-5"><span style="font-weight: 500">Pasos para subir</span> <span style="font-weight: 100">una propiedad</span></h2>
        <section class="row mt-5">
            <article class="col-sm-3 w-full mb-3">
                <div class="card text-dark h-auto mb-3 position-relative">
                    <div class="card-body text-center pt-5">
                        <img width="50px" height="50px" src="{{ asset('img/1icono.webp') }}" alt="">
                        <p class="card-text pt-3" style="font-family: 'Sharp Grotesk';"><span style="font-weight: 100">Escoger la opción</span> <br> <span style="font-weight: 500">Subir Propiedad</span></p>
                    </div>
                    <div class="position-absolute rounded-circle border border-2 d-flex align-items-center justify-content-center" style="background-color: #242B40; color: #ffffff; top: -10px; left: 0; right: 0; margin: auto; height: 50px; width: 50px; font-size: 20px">1</div>
                </div>
            </article>
            <article class="col-sm-3 w-full mb-3">
                <div class="card text-dark h-auto mb-3 position-relative">
                    <div class="card-body text-center pt-5">
                        <img width="50px" height="50px" src="{{ asset('img/2icono.webp') }}" alt="">
                        <p class="card-text pt-3" style="font-family: 'Sharp Grotesk'; font-weight: 300"><span style="font-weight: 100">Completar información</span> <br> <span style="font-weight: 500">de su propiedad</span></p>
                    </div>
                    <div class="position-absolute rounded-circle border border-2 d-flex align-items-center justify-content-center" style="background-color: #242B40; color: #ffffff; top: -10px; left: 0; right: 0; margin: auto; height: 50px; width: 50px; font-size: 20px">2</div>
                </div>
            </article>
            <article class="col-sm-3 w-full mb-3">
                <div class="card text-dark h-auto mb-3 position-relative">
                    <div class="card-body text-center pt-5">
                        <img width="50px" height="50px" src="{{ asset('img/3icono.webp') }}" alt="">
                        <p class="card-text pt-3" style="font-family: 'Sharp Grotesk'; font-weight: 300"><span style="font-weight: 100">Subir imágenes</span> <br> <span style="font-weight: 500">y guardar</span></p>
                    </div>
                    <div class="position-absolute rounded-circle border border-2 d-flex align-items-center justify-content-center" style="background-color: #242B40; color: #ffffff; top: -10px; left: 0; right: 0; margin: auto; height: 50px; width: 50px; font-size: 20px">3</div>
                </div>
            </article>
            <article class="col-sm-3 w-full mb-3">
                <div class="card text-dark h-auto mb-3 position-relative">
                    <div class="card-body text-center pt-5">
                        <img width="50px" height="50px" src="{{ asset('img/4icono.webp') }}" alt="">
                        <p class="card-text pt-3" style="font-family: 'Sharp Grotesk'; font-weight: 300"><span style="font-weight: 100">Su propiedad será</span> <br> <span style="font-weight: 500">activada</span></p>
                    </div>
                    <div class="position-absolute rounded-circle border border-2 d-flex align-items-center justify-content-center" style="background-color: #242B40; color: #ffffff; top: -10px; left: 0; right: 0; margin: auto; height: 50px; width: 50px; font-size: 20px">4</div>
                </div>
            </article>
        </section>
        <section class="row justify-content-center mt-5">
            <a href="{{ route('register') }}" class="btn rounded-pill w-auto px-4" style="background-color: #242B40; color: #ffffff">COMIENZA AHORA</a>
        </section>
    </section>

    <section class="container py-5">
        <hr>
    </section>

    <section class="container">
        <h2 class="text-center mb-5" style="font-family: 'Sharp Grotesk'; color: #242B40"><span style="font-weight: 100">Nuestros</span> <span style="font-weight: 500">Beneficios</span></h2>
        <section class="row">
            <article class="col-sm-4">
                <div class="position-relative w-auto">
                    <img class="img-fluid" src="{{ asset('img/cuadro1.webp') }}" alt="">
                    <div class="position-absolute px-5" style="top: 45px; left: 25px;">
                        <p class="h2" style="color: #242B40; font-family: 'Sharp Grotesk'; font-weight: 500">Facilidad de Gestión</p>
                        <p class="pe-4" style="font-family: 'Sharp Grotesk'; font-weight: 300">Administrar fácilmente tus propiedades permitiéndole actualizar la información rápidamente</p>
                    </div>
                </div>
            </article>
            <article class="col-sm-4">
                <div class="position-relative">
                    <img class="img-fluid" src="{{ asset('img/cuadro2.webp') }}" alt="">
                    <div class="position-absolute px-5" style="top: 45px; left: 25px;">
                        <p class="h2" style="color: #242B40; font-family: 'Sharp Grotesk'; font-weight: 500">Acceso las 24 horas</p>
                        <p class="pe-4" style="font-family: 'Sharp Grotesk'; font-weight: 300">Disponible para ser vista por posibles inquilinos las 24 horas del día, los 7 días de la semana</p>
                    </div>
                </div>
            </article>
            <article class="col-sm-4">
                <div class="position-relative">
                    <img class="img-fluid" src="{{ asset('img/cuadro3.webp') }}" alt="">
                    <div class="position-absolute px-5" style="top: 45px; left: 25px;">
                        <p class="h2" style="color: #242B40; font-family: 'Sharp Grotesk'; font-weight: 500">Alcance Geográfico</p>
                        <p class="pe-4" style="font-family: 'Sharp Grotesk'; font-weight: 300">Puedes llegar a inquilinos potenciales no solo localmente, sino tambien a nivel nacional</p>
                    </div>
                </div>
            </article>
        </section>
        <section class="row justify-content-center mt-5">
            <a class="btn rounded-pill px-3 w-auto" style="font-family: 'Sharp Grotesk'; font-weight: 300; background-color: #242B40; color: #ffffff" href="{{ route('web.contact') }}">Más Información</a>
        </section>
    </section>

    <section>
        <img class="img-fluid w-100" src="{{ asset('img/footer-bg-publique-con-nosotros.webp') }}" alt="">
    </section>

@endsection

@section('js')
    <script>
        var carouselWidth = $(".carousel-inner")[0].scrollWidth;
        var cardWidth = $(".carousel-item").width();
        var scrollPosition = 0;

        $(".carousel-control-next").on("click", function () {
            if (scrollPosition < (carouselWidth - cardWidth * 4)) { //check if you can go any further
                scrollPosition += cardWidth;  //update scroll position
                $(".carousel-inner").animate({ scrollLeft: scrollPosition },600); //scroll left
            }
        });

        $(".carousel-control-prev").on("click", function () {
            if (scrollPosition > 0) {
                scrollPosition -= cardWidth;
                $(".carousel-inner").animate(
                { scrollLeft: scrollPosition },
                600
                );
            }
        });
        var multipleCardCarousel = document.querySelector(
  "#carouselExampleControls"
);
// if (window.matchMedia("(min-width: 768px)").matches) {
//   //rest of the code
//   var carousel = new bootstrap.Carousel(multipleCardCarousel, {
//     interval: false
//   });
// } else {
//   $(multipleCardCarousel).addClass("slide");
// }
    </script>
@endsection