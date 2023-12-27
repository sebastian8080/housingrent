@extends('layouts.web')

@section('title', 'Contactenos ahora')

@section('css')
    
@endsection

@section('content')
    <section class="pt-5">
        <section class="row">
            <div class="col-sm-4">
                <img class="img-fluid" src="{{ asset('img/contact-page.webp') }}" alt="">
            </div>
            <div class="col-sm-8">
                <div class="row">
                    <h1 class="display-4 fw-bold">Contáctanos</h1>
                    <p>Estamos aquí para responder a sus preguntas, proporcionar asistencia <br> personalizada y escuchar sus comentarios</p>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <h2 class="fw-bold">Proporciónenos sus datos y lo contactaremos</h2>
                        <form action="">
                            <div class="form-group mb-2">
                                <input class="w-75 form-control form-control-sm border-0 rounded-0 border-bottom border-dark" type="text" placeholder="Nombre">
                            </div>
                            <div class="form-group mb-2">
                                <input class="w-75 form-control form-control-sm border-0 rounded-0 border-bottom border-dark" type="text" placeholder="Apellido">
                            </div>
                            <div class="form-group mb-2">
                                <input class="w-75 form-control form-control-sm border-0 rounded-0 border-bottom border-dark" type="text" placeholder="Email">
                            </div>
                            <div class="form-group mb-2">
                                <textarea name="" id="" cols="30" rows="3" placeholder="Mensaje" class="w-75 form-control form-control-sm border-0 rounded-0 border-bottom border-dark"></textarea>
                            </div>
                            <div class="w-75 text-center mt-3">
                                <button type="submit" class="btn text-white rounded-pill" style="background-color: #242B40">Enviar</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <h2>Nuestros datos de contacto</h2>
                        <div class="d-flex justify-content-start align-items-center w-100">
                            <div class="border border-dark rounded-circle d-flex justify-content-center align-items-center" style="width: 30px; height: 30px;">
                                <img width="15px" src="{{ asset('img/phone-icon.png') }}" alt="">
                            </div>
                            <a href="tel:+593983849073">098-384-9073</a>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="border border-dark rounded-circle d-flex justify-content-center align-items-center" style="width: 30px; height: 30px;">
                                <img width="15px" src="{{ asset('img/phone-icon.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection

@section('js')
    
@endsection