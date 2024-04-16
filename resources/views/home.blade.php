{{-- @extends('layouts.app') --}}
@extends('admin.template.template_dashboard')

@section('content')
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
        <a href="{{ route('property.create') }}" class="btn rounded-pill w-auto px-4" style="background-color: #242B40; color: #ffffff">COMIENZA AHORA</a>
    </section>
</section>
@endsection
