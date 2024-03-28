@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <section class="container">
        <h1>Subir una propiedad</h1>
    </section>
@stop

@section('content')
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
<form id="crearPropiedad" action="{{ route('properties.store') }}" method="POST" novalidate>
    @csrf

    <!-- Tipo de propiedad -->
    <div class="form-group">
        <label for="type_property">Tipo de propiedad</label>
        <select class="form-control @error('type_property') is-invalid @enderror" id="type_property" name="type_property" >
            <option value="">Seleccione un tipo</option>
            @foreach ($listing_types as $lt)
                <option value="{{$lt->id}}" {{ old('type_property') == $lt->id ? 'selected' : '' }}>{{ $lt->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Precio Máximo y Negociable -->
    <div class="form-row">
        <div class="col">
            <div class="form-group">
                <label for="max_price">Precio Máximo</label>
                <input type="number" class="form-control @error('max_price') is-invalid @enderror" id="max_price" name="max_price" placeholder="$" value="{{old('max_price')}}" >
                @error('max_price')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col">
            <div class="form-group" id="min-price-group" style="display: none;">
                <label for="min_price">Precio Mínimo</label>
                <input type="number" class="form-control @error('min_price') is-invalid @enderror" id="min_price" name="min_price" placeholder="$" value="{{old('min_price')}}">
                @error('min_price')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col d-flex align-items-center">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="is_negotiable" name="is_negotiable">
                <label class="form-check-label" for="is_negotiable">¿Es negociable?</label>
            </div>
        </div>
    </div>

    <!-- Título y Descripción -->
    <div class="form-group">
        <label for="title">Título de la propiedad</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Ingrese el título de la propiedad" value="{{old('title')}}" >
        @error('title')
            <span class="invalid-feedback">
                <strong>{{$message}}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="description">Descripción de la propiedad</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" value="{{old('description')}}"></textarea>
        @error('description')
            <span class="invalid-feedback">
                <strong>{{$message}}</strong>
            </span>
        @enderror
    </div>

    <!-- Detalles de la propiedad -->
    <div class="form-row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="bedroom">Habitaciones</label>
                <input type="number" class="form-control @error('bedroom') is-invalid @enderror" id="bedroom" name="bedroom" value="{{old('bedroom')}}" >
                @error('bedroom')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="bathroom">Baños</label>
                <input type="number" class="form-control @error('bathroom') is-invalid @enderror" id="bathroom" name="bathroom" value="{{old('bathroom')}}">
                @error('bathroom')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="garage">Garage</label>
                <input type="number" class="form-control @error('garage') is-invalid @enderror" id="garage" name="garage" value="{{old('garage')}}">
                @error('garage')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="construction_area">Metros Cuadrados</label>
                <input type="number" class="form-control @error('construction_area') is-invalid @enderror " id="construction_area" name="construction_area" value="{{old('construction_area')}}" >
                @error('construction_area')
                    <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="laundry_type">Tipo de lavandería</label>
                <select class="form-control @error('code') is-invalid @enderror" id="laundry_type" name="laundry_type" >
                    <option value="">Seleccione un tipo</option>
                    @foreach ($laundry_types as $lt)
                        <option value="{{$lt->id}}" {{ old('laundry_type') == $lt->id ? 'selected' : '' }}>{{ $lt->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    @foreach($typeBenefits as $typeBenefit)
    <div class="row mb-4">
        <div class="col-12">
            <h4>{{ $typeBenefit->name }}</h4>
        </div>
        {{-- Iterar sobre los beneficios dentro de este tipo de beneficio --}}
        @foreach($typeBenefit->benefits as $benefit)
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="benefit_{{ $benefit->id }}" name="benefits[]" value="{{ $benefit->id }}" {{ is_array(old('benefits')) && in_array($benefit->id, old('benefits')) ? 'checked' : '' }}>
                    <label class="form-check-label" for="benefit_{{ $benefit->id }}">{{ $benefit->name }}</label>
                </div>
            </div>
            {{-- Esto asegura que cada beneficio se muestre en una columna de 4 (lo que da 3 columnas por fila) --}}
        @endforeach
    </div>
    {{-- Esto crea una nueva fila para cada tipo de beneficio --}}
@endforeach
    <div class="form-row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="state_province">Provincia/Estado</label>
                <select class="form-control @error('state_province') is-invalid @enderror " id="state_province" name="state_province" >
                    <option value="">Seleccione un Provincia</option>
                    @foreach ($states as $state)
                    <option value="{{$state->name}}" {{ old('state_province') == $state->id ? 'selected' : '' }} data-id="{{ $state->id}}">{{ $state->name }}</option>
                    @endforeach
                </select>
        
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="city">Ciudad</label>
                <select name="city" id="city" class="form-control rounded-0 @error('city') is-invalid @enderror" >
                    <option value="">Seleccione</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="sector">Parroquia</label>
                <select name="sector" id="sector" class="form-control rounded-0 @error('sector') is-invalid @enderror" >
                    <option value="">Seleccione</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="address">Dirección</label>
        <input type="text" class="form-control @error('address') is-invalid @enderror " id="address" name="address" placeholder="Ingrese la dirección completa" value="{{old('address')}}">
        @error('address')
        <span class="invalid-feedback">
            <strong>{{$message}}</strong>
        </span>
        @enderror
    </div>
    <div class="form-row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="lat">Latitud</label>
                <input type="text" class="form-control @error('lat') is-invalid @enderror" id="lat" name="lat" placeholder="" readonly value="{{old('lat')}}">
                @error('lat')
                <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="lng">Longitud</label>
                <input type="text" class="form-control @error('lng') is-invalid @enderror" id="lng" name="lng" placeholder="" readonly value="{{old('lng')}}">
                @error('lng')
                <span class="invalid-feedback">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-4">
        <div class="col-sm-10">
            <div id="mapid" style="height: 400px;"></div>
        </div>
    </div>
    <div class="row justify-content-center mb-4">
        <div class="col">
            <button type="submit" class="btn btn-primary">Subir Propiedad</button>
        </div>
    </div>
    
</form>

    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    @parent
@stop

@section('js')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script> 
        const selState = document.getElementById('state_province');
        const selCities= document.getElementById('city');
        const selParishes = document.getElementById('sector');

        selState.addEventListener("change", async function() {
            selCities.options.length = 0;
            let id = selState.options[selState.selectedIndex].dataset.id;
            const response = await fetch("{{url('admin/getcities')}}/"+id );
            const cities = await response.json(); 
            let firstopt = document.createElement('option');
            firstopt.appendChild( document.createTextNode('Seleccione') );
            firstopt.value = "";
            selCities.appendChild(firstopt);

            cities.forEach(city => {
                var opt = document.createElement('option');
                opt.appendChild( document.createTextNode(city.name) );
                opt.value = city.name;
                opt.setAttribute('data-id', city.id);
                selCities.appendChild(opt);
            });
        });
        selCities.addEventListener("change", async function() {
            selParishes.options.length = 0;
            let id = selCities.options[selCities.selectedIndex].dataset.id;
            const response = await fetch("{{url('admin/getparishes')}}/"+id );
            const parishes = await response.json();
            let firstopt = document.createElement('option');
            firstopt.appendChild( document.createTextNode('Seleccione') );
            firstopt.value = "";
            selParishes.appendChild(firstopt);

            parishes.forEach(parish => {
                var opt = document.createElement('option');
                opt.appendChild( document.createTextNode(parish.name) );
                opt.value = parish.name;
                opt.setAttribute('data-id', parish.id);
                selParishes.appendChild(opt);
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var initialLat = {{ old('lat', -2.8878629) }};
            var initialLng = {{ old('lng', -79.01781) }};
            var zoomInicial = 16;
            var map = L.map('mapid').setView([initialLat, initialLng], zoomInicial);
    
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);
    
            var geocoder = L.Control.Geocoder.nominatim();
            var marker = L.marker([initialLat, initialLng], {
                draggable: true
            }).addTo(map); // Añade un marcador inicial basado en lat/lng iniciales o anteriores
    
            // Actualiza los campos de latitud y longitud con los valores iniciales o anteriores
            document.getElementById('lat').value = initialLat;
            document.getElementById('lng').value = initialLng;
    
            // Si hay un marcador previo, actualiza la dirección inicial o anterior
            updateAddressInput(initialLat, initialLng);
    
            function updateAddressInput(lat, lng) {
                geocoder.reverse({lat: lat, lng: lng}, map.options.crs.scale(map.getZoom()), function(results) {
                    var r = results[0];
                    if (r) {
                        document.getElementById('address').value = r.name;
                    }
                });
            }
    
            map.on('click', function(e) {
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;
    
                if (marker) {
                    marker.setLatLng([lat, lng]);
                } else {
                    marker = L.marker([lat, lng], {
                        draggable: true
                    }).addTo(map);
                }
    
                updateAddressInput(lat, lng);
    
                // Actualiza los campos de latitud y longitud con nuevos valores
                document.getElementById('lat').value = lat;
                document.getElementById('lng').value = lng;
            });
        });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const isNegotiableCheckbox = document.getElementById('is_negotiable');
        const minPriceGroup = document.getElementById('min-price-group');
        const minPriceInput = document.getElementById('min_price');
        const maxPriceLabel = document.querySelector('label[for="max_price"]');
        const minPriceLabel = document.querySelector('label[for="min_price"]');

        // Función para ajustar los labels y manejar el campo de Precio Mínimo
        function handleNegotiableChange(isNegotiable) {
            if (isNegotiable) {
                maxPriceLabel.textContent = 'Precio Máximo';
                minPriceLabel.textContent = 'Precio Mínimo';
                minPriceGroup.style.display = ''; // Muestra el campo de Precio Mínimo
                minPriceInput.setAttribute('required', 'required');
                minPriceInput.disabled = false; // Asegúrate de que el campo esté habilitado
            } else {
                maxPriceLabel.textContent = 'Precio Final';
                minPriceGroup.style.display = 'none'; // Oculta el campo de Precio Mínimo
                minPriceInput.removeAttribute('required');
                minPriceInput.value = ''; // Limpia el valor del campo de Precio Mínimo
                minPriceInput.disabled = true; // Deshabilita el campo para evitar que se envíe
            }
        }

        // Establece el estado inicial al cargar la página
        handleNegotiableChange(isNegotiableCheckbox.checked);

        // Escuchar el evento de cambio en el checkbox
        isNegotiableCheckbox.addEventListener('change', function() {
            handleNegotiableChange(this.checked);
        });
    });

    </script>
    @parent
    
@stop