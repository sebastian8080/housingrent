@extends('layouts.web')

@section('title', "Propiedades en Renta Cuenca")

@section('css')
    <link rel="stylesheet" href="{{ asset('css/font-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home-style.css?v=1') }}">
    @livewireStyles
@endsection

@php
    !isset($type) ? $type = null : null; !isset($searchtxt) ? $searchtxt = null : null;
@endphp

@section('content')
    <section class="container pb-5">
        <section class="p-5">
            <h2 style="font-family: 'Sharp Grotesk'" class="text-center display-6 fw-bold"><span style="font-weight: 100">Prueba nuestro</span> <span style="font-weight: 500">buscador avanzado</span></h2>
        </section>
        {{-- @livewire('search-component', ['properties' => $properties]) --}}
        @livewire('search-component', ['type' => $type, 'searchtxt' => $searchtxt])
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('web.send.lead') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #242B40; color: #ffffff">
                        <h5 class="modal-title" id="exampleModalLabel">Solicitar Información</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="d-flex align-items-center gap-2">
                                <img width="200px" id="img_modal_contact" alt="">
                                <div>
                                    <p class="fw-bold">Está consultando por:</p>
                                    <p id="txt_modal_contact"></p>
                                </div>
                            </div>
                            <input type="hidden" name="interest" id="interest">
                            <div class="form-group mb-2 mt-2">
                                <label for="name">Nombre:</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="lastname">Apellido:</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="phone">Teléfono:</label>
                                <input type="number" class="form-control" name="phone" id="phone" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="message">Comentario:</label>
                                <textarea name="message" id="message" rows="3" class="form-control" placeholder="Ej: Hola, me interesa esta propiedad y deseo que me contacten" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer w-100">
                    <button type="submit" class="btn btn-block w-100" style="background-color: #242B40; color: #ffffff">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        const search = () => {
            for (let index = 1; index < 6; index++) {
                let current_tab = document.getElementById('tab'+index);
                if(current_tab){
                    current_tab.classList.add('d-none')
                }
            }
        }

        const setInformationModal = (imgUrl, title, code) => {
            let img = document.getElementById('img_modal_contact');
            let titleTxt = document.getElementById('txt_modal_contact');
            let inpCode = document.getElementById('interest');
            let path = "https://grupohousing.com/uploads/listing/";

            img.src = path+imgUrl;
            titleTxt.innerHTML = title;
            inpCode.value = code;
        }
    </script>
    @livewireScripts
@endsection