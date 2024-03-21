@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <section class="container">
        <h1>Subir una propiedad</h1>
    </section>
@stop

@section('content')
    <section class="container">
        <form action="">
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="product_code" style="font-weight: 600">Código de la propiedad</label>
                        <input type="text" name="product_code" id="product_code" placeholder="#" class="form-control rounded-0">
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="form-group">
                        <label for="listing_type">Tipo de propiedad</label>
                        <select name="listing_type" id="listing_type" class="form-control rounded-0">
                            <option value="">Seleccione</option>
                            @foreach ($listing_types as $lt)
                                <option value="{{$lt->id}}">{{ $lt->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="property_price">Precio</label>
                        <input type="number" name="property_price" id="property_price" min="0" class="form-control rounded-0" placeholder="$">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="title" style="font-weight: 600">Titulo de la propiedad</label>
                        <input type="text" name="title" id="title" class="form-control rounded-0" placeholder="Ej: Departamento en renta en Cuenca - Sector...">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="listing_description" style="font-weight: 600">Descripcion de la propiedad</label>
                        <textarea placeholder="Escriba las características de la propiedad a rentar" name="listing_description" id="listing_description" rows="5" class="form-control rounded-0"></textarea>
                    </div>
                </div>
            </div>
            <section>
                <h5>Detalles de la propiedad</h5>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="bedrooms">Habitaciones</label>
                            <input type="number" name="bedrooms" id="bedrooms" min="0" class="form-control rounded-0">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="bathrooms">Baños</label>
                            <input type="number" name="bathrooms" id="bathrooms" min="0" class="form-control rounded-0">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="garage">Garage</label>
                            <input type="number" name="garage" id="garage" min="0" class="form-control rounded-0">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="construction_area">Metros Cuadrados</label>
                            <input type="number" name="construction_area" id="construction_area" min="0" class="form-control rounded-0">
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <h5>Ubicación de la propiedad</h5>
                <section class="row">
                    <article class="col-sm-4">
                        <div class="form-group">
                            <label for="state">Provincia</label>
                            <select name="state" id="state" class="form-control rounded-0">
                                <option value="">Seleccione</option>
                                @foreach ($states as $state)
                                    <option value="{{$state->name}}" data-id="{{ $state->id}}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </article>
                    <article class="col-sm-4">
                        <div class="form-group">
                            <label for="city">Ciudad</label>
                            <select name="city" id="city" class="form-control rounded-0">
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                    </article>
                    <article class="col-sm-4">
                        <div class="form-group">
                            <label for="city">Parroquia</label>
                            <input type="text" name="sector" id="sector" class="form-control rounded-0" placeholder="Ingrese la parroquia de la propiedad">
                        </div>
                    </article>
                    <article class="col-sm-12">
                        <div class="form-group">
                            <label for="address">Dirección</label>
                            <input type="text" name="address" id="address" class="form-control rounded-0" placeholder="Ingresa calle principal y calle secundaria de la propiedad">
                        </div>
                    </article>
                </section>
            </section>

            <section>
                <section class="d-flex">
                    <p>¿La propiedad permite tener mascotas?</p>
                    <div class="pl-2 d-flex">
                        <div>
                            <input type="radio" name="pet_friendly" id="pet_friendly_yes">
                            <label for="pet_friendly_yes">SI</label>
                        </div>
                        <div class="ml-2" style="cursor: pointer">
                            <input type="radio" name="pet_friendly" id="pet_friendly_no">
                            <label for="pet_friendly_no">NO</label>
                        </div>
                    </div>
                </section>
            </section>
        </form>
    </section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> 
        const selState = document.getElementById('state');
        const selCities= document.getElementById('city');

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
    </script>
@stop