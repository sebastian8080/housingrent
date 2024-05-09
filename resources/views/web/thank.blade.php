@extends('layouts.web')

@section('title', 'Gracias por completar su información')

@section('css')
    
@endsection
@section('header')
@endsection
@section('content')
<script> window.onload = function() { gtag('event', 'conversion', {'send_to': 'AW-11250334200/OQg9CNvisa4ZEPjzyfQp'}); }; </script>
    <section class="container" style="width: 100vw; height: 90vh">
        <div class="d-flex align-items-center justify-content-center" style="width: 100%; height: 100%">
            <div>
                <h1>Gracias por completar su información</h1>
                <p class="text-muted">Su información está siendo procesada, en unos minutos un asesor se contactará con usted</p>
                <div class="text-center">
                    <a href="{{ route('web.home') }}" class="btn rounded-pill text-white" style="background-color: #242B40">Volver a la pagina de inicio</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    
@endsection