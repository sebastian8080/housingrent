@extends('layouts.web')

@section('title', 'Publique su propiedad en Housing Rent')

@section('css')
    <style>
        @media screen and (max-width: 580px){
            .padding-x-mobile{
                padding-left: 0px !important;
                padding-right: 0px !important;
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

    <section class="container">

        <section class="row justify-content-center text-center pt-4">
            <h1 class="display-6 fw-bold">¿Cómo publicar una propiedad <br> en Housing Rent Group?</h1>
            <p class="my-3 padding-x-mobile" style="padding-left: 25%; padding-right: 25%">Para garantizar la seguridad y la calidad en cada experiencia de arrendamiento, hemos implementado un proceso exclusivo para publicar propiedades</p>
            <p class="my-3 padding-x-mobile" style="padding-left: 25%; padding-right: 25%;"><b>Invitamos a los propietarios interesados ponerse en contacto con nuestro equipo para iniciar el proceso de publicación de su propiedad,</b> garantizamos una experiencia sin complicaciones y una representación precisa de cada espacio.</p>
            <button class="btn rounded-pill text-white w-auto mt-2 mb-5" style="background-color: #242B40">Contactarme con Housing</button>
        </section>

    </section>

    <section class="container">
        <h2>Nuestros beneficios</h2>
        
        <div id="carouselExampleControls" class="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="card">
    <img src="..." class="d-block w-100" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title 2</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
            card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
              </div>
              <div class="carousel-item">
                <div class="card">
    <img src="..." class="d-block w-100" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title 2</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
            card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
              </div>
              <div class="carousel-item">
                <div class="card">
    <img src="..." class="d-block w-100" alt="...">
    <div class="card-body">
        <h5 class="card-title">Card title 2</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
            card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </section>

    <section>
        <img class="img-fluid w-100" src="{{ asset('img/upload-property-page.webp') }}" alt="">
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