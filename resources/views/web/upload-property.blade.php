@extends('layouts.web')

@section('title', 'Publique su propiedad en Housing Rent')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/font-style.css') }}">
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

    <section style="background-position: center; background-repeat: no-repeat; background-size: cover; background-image: url('{{ asset('img/bg-publique-con-nosotros.jpg') }}')">
        <section class="container pt-4">
            <section  class="row justify-content-center text-center pt-4 pb-4">
                <h1 class="display-6 fw-bold" style="font-family: 'Sharp Grotesk'"><span style="font-weight: 100">¡No necesitas moverte para</span> <br> <span style="font-weight: 500">darle visibilidad a tu propiedad!</span> </h1>
                <p class="mb-3 mt-4 padding-x-mobile pb-5" style="padding-left: 30%; padding-right: 30%; font-family: 'Sharp Grotesk'; font-weight: 300">Desde casa, con un click, puedes subirla a nuestra página web y comenzar a recibir consultas</p>
                {{-- <h2 style="font-family: 'Sharp Grotesk'; font-weight: 100" class="py-4">Nuestros Beneficios</h2> --}}
            </section>
        </section>
    </section>

    <section class="container mt-5">
        <h2 style="font-family: 'Sharp Grotesk'; font-weight: 500;" class="text-center display-6">¿Cómo publicar una propiedad <br> en Housing Rent Group?</h2>
        <p style="font-family: 'Sharp Grotesk'; font-weight: 100" class="text-center py-3">Para garantizar la seguridad y la calidad en cada experiencia de arrendamiento, hemos implementado un proceso exclusivo para publicar propiedades</p>
        <p style="font-family: 'Sharp Grotesk'; font-weight: 500;" class="text-center">Se debe cumplir todos los pasos para poder publicar la propiedad</p>
        <section class="row mt-5">
            <article class="col-sm-6 d-flex justify-content-center justify-content-md-end">
                <div class="card text-dark bg-light mb-3 position-relative" style="max-width: 18rem;">
                    <div class="card-header text-center h4" style="background-color: #242B40; color: #ffffff">Registro</div>
                    <div class="card-body text-center">
                        <img src="{{ asset('img/register-icon.png') }}" alt="">
                        <p class="card-text pt-3" style="font-family: 'Sharp Grotesk'; font-weight: 300">Llenar el formulario de registro</p>
                        <a href="" class="btn rounded-pill" style="background-color: #242B40; color: #ffffff; font-family: 'Sharp Grotesk'">REGISTRARSE</a>
                    </div>
                    <div class="position-absolute rounded-circle border border-2 d-flex align-items-center justify-content-center" style="background-color: #242B40; color: #ffffff; top: -10px; left: -10px; height: 30px; width: 30px">1</div>
                  </div>
            </article>
            <article class="col-sm-6 d-flex justify-content-center justify-content-md-start">
                <div class="card text-dark bg-light mb-3 position-relative" style="max-width: 18rem;">
                    <div class="card-header text-center h4" style="background-color: #242B40; color: #ffffff">Subir Propiedad</div>
                    <div class="card-body text-center">
                        <img src="{{ asset('img/upload-property-icon.png') }}" alt="">
                        <p class="card-text pt-3 px-4" style="font-family: 'Sharp Grotesk'; font-weight: 300">Información y fotografías</p>
                        <a href="" class="btn rounded-pill" style="background-color: #242B40; color: #ffffff; font-family: 'Sharp Grotesk'">PUBLICAR</a>
                    </div>
                    <div class="position-absolute rounded-circle border border-2 d-flex align-items-center justify-content-center" style="background-color: #242B40; color: #ffffff; top: -10px; left: -10px; height: 30px; width: 30px">2</div>
                  </div>
            </article>
        </section>
        <section class="row justify-content-center mt-5">
            <a href="#" class="btn rounded-pill w-auto px-4" style="background-color: #242B40; color: #ffffff">MÁS INFORMACIÓN</a>
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