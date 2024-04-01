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
            <div class="col-sm-8 ps-5">
                <div class="row">
                    <h1 class="display-4 fw-bold">Contáctanos</h1>
                    <p>Estamos aquí para responder a sus preguntas, proporcionar asistencia <br> personalizada y escuchar sus comentarios</p>
                </div>
                <div class="row">
                    <div class="col-sm-6 py-3">
                        <h2 class="fw-bold">Proporciónenos sus datos y lo contactaremos</h2>
                        <form id="demo-form" action="{{ route('web.send.lead') }}" method="POST">
                            @csrf
                            <div class="form-group mb-2">
                                <input class="w-75 form-control form-control-sm border-0 rounded-0 border-bottom border-dark" type="text" placeholder="Nombre" name="name" required>
                            </div>
                            <div class="form-group mb-2">
                                <input class="w-75 form-control form-control-sm border-0 rounded-0 border-bottom border-dark" type="text" placeholder="Apellido" name="lastname" required>
                            </div>
                            <div class="form-group mb-2">
                                <input class="w-75 form-control form-control-sm border-0 rounded-0 border-bottom border-dark" type="text" placeholder="Email" name="email" required>
                            </div>
                            <div class="form-group mb-2">
                                <input class="w-75 form-control form-control-sm border-0 rounded-0 border-bottom border-dark" type="number" placeholder="Teléfono" name="phone" required>
                            </div>
                            <div class="form-group mb-2">
                                <textarea name="message" cols="30" rows="3" placeholder="Mensaje" class="w-75 form-control form-control-sm border-0 rounded-0 border-bottom border-dark" required></textarea>
                            </div>
                            <div class="w-75 text-center mt-3">
                                <button type="submit" class="btn text-white rounded-pill" style="background-color: #242B40">Enviar</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6 py-3">
                        <h2>Nuestros datos de contacto</h2>
                        <div class="d-flex justify-content-start gap-2 align-items-center w-100 mb-2">
                            <div class="border border-dark rounded-circle d-flex justify-content-center align-items-center" style="width: 30px; height: 30px;">
                                <img width="15px" src="{{ asset('img/phone-icon.png') }}" alt="">
                            </div>
                            <a style="text-decoration: none; color: #000000" href="tel:+593983849073">098-384-9073</a>
                        </div>
                        <div class="d-flex justify-content-start gap-2 align-items-center mb-2">
                            <div class="border border-dark rounded-circle d-flex justify-content-center align-items-center" style="width: 30px; height: 30px;">
                                <img width="15px" src="{{ asset('img/whatsapp-icon.png') }}" alt="">
                            </div>
                            <a style="text-decoration: none; color: #000000" href="tel:+593983849073">098-384-9073</a>
                        </div>
                        <div class="d-flex justify-content-start gap-2 align-items-center mb-2">
                            <div class="border border-dark rounded-circle d-flex justify-content-center align-items-center" style="width: 30px; height: 30px;">
                                <img width="15px" src="{{ asset('img/email-icon.png') }}" alt="">
                            </div>
                            <a style="text-decoration: none; color: #000000" href="mailto:info@housingrentgroup.com">info@housingrentgroup.com</a>
                        </div>
                        <div class="d-flex justify-content-start gap-2 align-items-center mb-2">
                            <div class="border border-dark rounded-circle d-flex justify-content-center align-items-center" style="width: 30px; height: 30px;">
                                <img width="15px" src="{{ asset('img/location-icon.png') }}" alt="">
                            </div>
                            <span>Remigio Tamariz Crespo y Av. Solano</span>
                        </div>
                        <div class="d-flex justify-content-start gap-2 align-items-center mb-2">
                            <div class="border border-dark rounded-circle d-flex justify-content-center align-items-center" style="width: 30px; height: 30px;">
                                <img width="15px" src="{{ asset('img/facebook-icon.png') }}" alt="">
                            </div>
                            <a style="text-decoration: none; color: #000000" target="_blank" href="https://www.facebook.com/profile.php?id=61553203397168">Housing Rent Group</a>
                        </div>
                        <div class="d-flex justify-content-start gap-2 align-items-center mb-2">
                            <div class="border border-dark rounded-circle d-flex justify-content-center align-items-center" style="width: 30px; height: 30px;">
                                <img width="15px" src="{{ asset('img/instagram-icon.png') }}" alt="">
                            </div>
                            <a style="text-decoration: none; color: #000000" target="_blank" href="https://www.instagram.com/housingrentgroup">housingrentgroup</a>
                        </div>
                        <div class="d-flex justify-content-start gap-2 align-items-center mb-2">
                            <div class="border border-dark rounded-circle d-flex justify-content-center align-items-center" style="width: 30px; height: 30px;">
                                <img width="15px" src="{{ asset('img/tiktok-icon.png') }}" alt="">
                            </div>
                            <a style="text-decoration: none; color: #000000" target="_blank" href="https://www.tiktok.com/@housingrent">housingrentgroup</a>
                        </div>
                        <div class="d-flex justify-content-start gap-2 align-items-center mb-2">
                            <input type="hidden" name="g-recaptcha-response" id="recaptchaToken">
        
                            @error('captcha')
                                    <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
      document.getElementById('demo-form').addEventListener('submit', function(event) {
        event.preventDefault();
        grecaptcha.ready(function() {
          grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {action: 'submit'}).then(function(token) {
              document.getElementById('recaptchaToken').value = token;
              event.target.submit();
          });
        });
      });
    });
  </script>
@endsection