@extends('layouts.web')

@section('title', 'Propiedades en Renta en Cuenca')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/font-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home-style.css?v=1') }}">
    @livewireStyles
@endsection

@section('content')
    <section class="container pb-5">
        <section class="p-5">
            <h2 style="font-family: 'Sharp Grotesk'" class="text-center display-6 fw-bold"><span style="font-weight: 100">Prueba nuestro</span> <span style="font-weight: 500">buscador avanzado</span></h2>
        </section>
        @livewire('search-component', ['properties' => $properties])
    </section>
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
    </script>
    @livewireScripts
@endsection