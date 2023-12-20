<div>
    <section style="padding-left: 10%; padding-right: 10%">
        <section class="d-flex ps-5 pe-1 rounded-pill py-1" style="border: 1px solid #000000">
            <div class="d-flex w-100 justify-content-between align-items-center">
                <section class="position-relative w-100">
                    <div class="text-center">
                        <span style="cursor: pointer" onclick="showfilter('tab1')" class="text-center">Todas las propiedades</span>
                    </div>
                    <div id="tab1" class="position-absolute p-2 bg-white border w-100 rounded shadow-sm d-none mt-1" style="z-index: 1">
                        <div>
                            <input value="23" type="checkbox" name="types">
                            <label for="checktype">Casas</label>
                        </div>
                        <div>
                            <input value="24" type="checkbox" name="types">
                            <label for="checktype">Departamentos</label>
                        </div>
                    </div>
                </section>

                <div>/</div>

                <section class="position-relative w-100">
                    <div class="text-center">
                        <span style="cursor: pointer" onclick="showfilter('tab2')">Ubicaciones</span>
                    </div>
                    <div id="tab2" class="position-absolute p-2 bg-white border rounded shadow-sm d-none mt-2 w-100" style="z-index: 1;">
                        <div>
                            <input id="checknorte" value="Norte" type="checkbox" name="zones">
                            <label for="checknorte">Norte</label>
                        </div>
                        <div>
                            <input id="checkSur" value="Sur" type="checkbox" name="zones">
                            <label for="checkSur">Sur</label>
                        </div>
                        <div>
                            <input id="checkcentro" value="Centro" type="checkbox" name="zones">
                            <label for="checkcentro">Centro</label>
                        </div>                       
                    </div>
                </section>

                <div>/</div>

                <section class="position-relative w-100">
                    <div class="text-center">
                        <span style="cursor: pointer" onclick="showfilter('tab3')">Número de...</span>
                    </div>
                    <div id="tab3" class="position-absolute p-2 bg-white border rounded shadow-sm d-none mt-2" style="z-index: 1100; width: 200px;">
                        <div class="d-flex align-items-center justify-content-between border-bottom pb-1">
                            <span>Habitaciones</span>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-sm rounded-pill border" onclick="sum('num_bedrooms')">+</button>
                                <input style="width: 25px" id="num_bedrooms" type="text" class="form-control form-control-sm border-0" min="1" value="" disabled>
                                <button class="btn btn-sm rounded-pill border" onclick="rest('num_bedrooms')">-</button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between border-bottom pt-1 pb-1">
                            <span>Baños</span>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-sm rounded-pill border" onclick="sum('num_bathrooms')">+</button>
                                <input style="width: 25px" id="num_bathrooms" type="text" class="form-control form-control-sm border-0" min="1" value="" readonly>
                                <button class="btn btn-sm rounded-pill border" onclick="rest('num_bathrooms')">-</button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between pt-1">
                            <span>Garage</span>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-sm rounded-pill border" onclick="sum('num_garage')">+</button>
                                <input style="width: 25px" id="num_garage" type="text" class="form-control form-control-sm border-0" min="1" value="" readonly>
                                <button class="btn btn-sm rounded-pill border" onclick="rest('num_garage')">-</button>
                            </div>
                        </div>                    
                    </div>
                </section>

                <div style="width: 5px !important">/</div>

                <section class="position-relative w-100">
                    <div class="text-center">
                        <span style="cursor: pointer" onclick="showfilter('tab4')">Precio</span>
                    </div>
                    <div id="tab4" class="position-absolute p-2 bg-white border rounded shadow-sm d-none mt-2 w-100" style="z-index: 1100;">
                        <div class="border-bottom pb-2">
                            <span>Desde</span>
                            <div>
                                <input type="text" class="form-control form-control-sm" placeholder="Precio mínimo" id="min_price">
                            </div>
                        </div>
                        <div class="pt-1">
                            <span>Hasta</span>
                            <div>
                                <input type="text" class="form-control form-control-sm" placeholder="Precio máximo" id="max_price">
                            </div>
                        </div>                
                    </div>
                </section>

                <div>/</div>

                <section class="position-relative w-100">
                    <div class="text-center">
                        <span style="cursor: pointer" onclick="showfilter('tab5')">Caracteristicas</span>
                    </div>
                    <div id="tab5" class="position-absolute p-2 bg-white border rounded shadow-sm d-none mt-2 w-100" style="z-index: 1100;">
                        <div>
                            <input type="checkbox" name="" id="">
                            <label for="checkamoblada">Amoblada</label>
                        </div>
                        <div>
                            <input type="checkbox" name="" id="">
                            <label for="checkmascota">Pet Friendly</label>
                        </div>                 
                    </div>
                </section>

                <section>
                    <button onclick="filter_properties()" class="btn btn-dark btn-sm rounded-pill px-5">Buscar</button>
                </section>
            </div>
        </section>
    </section>

    <section class="container mt-5">
        <section class="row">
            <section class="col-sm-12">
                <section class="row justify-content-center">
                    @foreach ($properties as $propertie)
    
                @php
                    //get first image
                    $imgpri = explode("|", $propertie->images);
                @endphp
    
                    <article class="col-sm-3" style="padding-left: 0px !important; padding-right: 0px !important">
                        <a href="{{ route('show.property', $propertie->slug) }}" style="text-decoration: none">
                            <div class="card rounded-0 h-100">
                                <div class="card-body">
                                    <div class="position-relative">
                                        {{-- https://casacredito.com/uploads/listing/{{$imgpri[0]}} --}}
                                        <img class="img-fluid" src="https://casacredito.com/uploads/listing/{{$imgpri[0]}}" alt="">
                                        <div class="position-absolute" style="top: 5px; left: 5px">
                                            <span class="bg-white text-dark px-2 rounded-pill" style="font-size: small; font-weight: 600">Propiedad destacada</span>
                                        </div>
                                    </div>
                                    <div>
                                        <h2 class="fw-bold mt-3" style="font-size: medium">{{ $propertie->listing_title }}</h2>
                                        <p style="font-size: small" class="text-muted">{{ $propertie->listing_description }}</p>
                                        <p>{{ $propertie->city }}, {{ $propertie->sector }}</p>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex gap-2">
                                                @if($propertie->bedroom > 0)
                                                    <div class="d-flex">
                                                        <img width="25px" src="{{ asset('img/bed-icon.png') }}" alt="">
                                                        <span>{{ $propertie->bedroom }}</span>
                                                    </div>
                                                @endif
                                                @if($propertie->bathroom > 0)
                                                    <div class="d-flex">
                                                        <img width="25px" src="{{ asset('img/bath-icon.png') }}" alt="">
                                                        <span>{{ $propertie->bathroom }}</span>
                                                    </div>
                                                @endif
                                                @if($propertie->garage > 0)
                                                    <div class="d-flex">
                                                        <img width="25px" src="{{ asset('img/garage-icon.png') }}" alt="">
                                                        <span>{{ $propertie->garage }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <span class="fw-bold">${{ $propertie->property_price }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
                </section>
            </section>
        </section>
    </section>
</div>

<script>
    
    function filter_properties(){

        search();

        let types = document.getElementsByName('types');
        let zones = document.getElementsByName('zones');
        let resulttypes = [];
        let resultzones = [];

        let bedrooms = document.getElementById('num_bedrooms').value;
        let bathrooms = document.getElementById('num_bathrooms').value;
        let garage = document.getElementById('num_garage').value;

        let min_price = document.getElementById('min_price').value;
        let max_price = document.getElementById('max_price').value;

        for (let i = 0; i < types.length; i++) {
            if(types[i].checked){
                resulttypes.push(types[i].value)
            }
        }

        for (let i = 0; i < zones.length; i++) {
            if(zones[i].checked){
                resultzones.push(zones[i].value)
            }
        }

        @this.set('types', resulttypes);
        @this.set('zones', resultzones);
        @this.set('bedrooms', bedrooms);
        @this.set('bathrooms', bathrooms);
        @this.set('garage', garage);
        @this.set('min_price', min_price);
        @this.set('max_price', max_price);
        
    }

    const sum = (input) => document.getElementById(input).value++;
    const rest = (input) => document.getElementById(input).value > 1 ? document.getElementById(input).value-- : null; 

</script>