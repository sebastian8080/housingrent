<div>
    <section class="section-search" style="padding-left: 10%; padding-right: 10%">
        <section class="d-flex ps-4 pe-1 rounded-pill py-1 rounded-search-mobile shadow-sm" style="border: 1px solid #000000">
            <div class="d-flex w-100 justify-content-between align-items-center search">
                <section class="position-relative w-100 margin-bottom-mobile">
                    <span class="text-muted label-filter" style="font-size: x-small; display: none">Tipo de propiedad</span>
                    <div class="text-center border-tabs-mobile">
                        <label style="cursor: pointer" onclick="showfilter('tab1')" class="text-center w-100">Todas las propiedades <img class="ms-1 img-filters" width="10px" style="display: none" src="{{ asset('img/icon-down-arrow.png') }}" alt=""></label>
                    </div>
                    <div id="tab1" class="position-absolute p-2 bg-white border rounded shadow-sm d-none mt-1" style="z-index: 1; width: 200px">
                        <div class="d-flex gap-2">
                            <input value="23" id="checkCasas" type="checkbox" name="types" style="width: 20px;" onclick="disabledCheckBoxesTypes()">
                            <label class="w-100" style="cursor: pointer" for="checkCasas">Casas</label>
                        </div>
                        <div class="d-flex gap-2 mt-1">
                            <input value="24" id="checkDepartamentos" type="checkbox" name="types" style="width: 20px" onclick="disabledCheckBoxesTypes()">
                            <label class="w-100" style="cursor: pointer" for="checkDepartamentos">Departamentos</label>
                        </div>
                        <div class="d-flex gap-2 mt-1">
                            <input value="25" id="checkCasasComerciales" type="checkbox" name="types" style="width: 20px" onclick="disabledCheckBoxesTypes()">
                            <label class="w-100" style="cursor: pointer" for="checkCasasComerciales">Casas Comerciales</label>
                        </div>
                        <div class="d-flex gap-2 mt-1">
                            <input value="32" id="checkLocalesComerciales" type="checkbox" name="types" style="width: 20px" onclick="disabledCheckBoxesTypes()">
                            <label class="w-100" style="cursor: pointer" for="checkLocalesComerciales">Locales Comerciales</label>
                        </div>
                        <div class="d-flex gap-2 mt-1">
                            <input value="35" id="checkOficinas" type="checkbox" name="types" style="width: 20px" onclick="disabledCheckBoxesTypes()">
                            <label class="w-100" style="cursor: pointer" for="checkOficinas">Oficinas</label>
                        </div>
                        <div class="d-flex gap-2 mt-1">
                            <input value="36" id="checkSuites" type="checkbox" name="types" style="width: 20px" onclick="disabledCheckBoxesTypes()">
                            <label class="w-100" style="cursor: pointer" for="checkSuites">Suites</label>
                        </div>
                        <div class="d-flex gap-2 mt-1">
                            <input value="29" id="checkQuintas" type="checkbox" name="types" style="width: 20px" onclick="disabledCheckBoxesTypes()">
                            <label class="w-100" style="cursor: pointer" for="checkQuintas">Quintas</label>
                        </div>
                        <div class="d-flex gap-2 mt-1">
                            <input value="30" id="checkHaciendas" type="checkbox" name="types" style="width: 20px" onclick="disabledCheckBoxesTypes()">
                            <label class="w-100" style="cursor: pointer" for="checkHaciendas">Haciendas</label>
                        </div>
                    </div>
                </section>

                <div class="slash">/</div>

                <section class="position-relative w-100 margin-bottom-mobile">
                    <span class="text-muted label-filter" style="font-size: x-small; display: none">¿En donde busca su propiedad?</span>
                    <div class="text-center border-tabs-mobile w-100">
                        <label style="cursor: pointer" onclick="showfilter('tab2')" class="w-100">Ubicaciones <img class="ms-1 img-filters" width="10px" style="display: none" src="{{ asset('img/icon-down-arrow.png') }}" alt=""></label>
                    </div>
                    <div id="tab2" class="position-absolute p-2 bg-white border rounded shadow-sm @if(!$showTab2) d-none @endif mt-2" style="z-index: 1; width: 200px">
                        <div class="mb-3">
                            <input type="text" class="w-100 form-control border-0 border-bottom" placeholder="Ingrese una ciudad" wire:model="citySearch">
                            @if (count($cities)>0)
                                <div class="px-1 my-3">
                                    @foreach ($cities as $city)
                                        <div class="d-flex gap-2 align-items-center">
                                            <span class="w-100" style="cursor: pointer" onclick="setValueCity('{{$city->id}}', '{{$city->name}}')"><img width="20px" src="{{ asset('img/location-icon.png') }}" alt="">{{ $city->name }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <span id="divCityValue" class="text-white rounded-pill px-2 py-1 w-auto @if($cityTagName == "") d-none @endif d-flex justify-content-between" style="background-color: #0F0F0F">
                                <span id="spanCityValue"> @if($cityTagName != "") {{ $cityTagName }} @endif </span>
                                <label wire:click="cleanCity()" style="width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; cursor: pointer" class="bg-white rounded-circle text-dark text-center">x</label>
                            </span>
                            <input style="display: none" type="text" id="inpCity" value="">
                        </div>
                        <hr>
                        <span class="fw-bold" style="font-size: large">Zona</span>
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

                <div class="slash">/</div>

                <section class="position-relative w-100 margin-bottom-mobile">
                    <span class="text-muted label-filter" style="font-size: x-small; display: none">Especificaciones de la propiedad</span>
                    <div class="text-center border-tabs-mobile">
                        <label style="cursor: pointer" onclick="showfilter('tab3')" class="w-100">Número de... <img class="ms-1 img-filters" width="10px img-filters" style="display: none" src="{{ asset('img/icon-down-arrow.png') }}" alt=""></label>
                    </div>
                    <div id="tab3" class="position-absolute p-2 bg-white border rounded shadow-sm d-none mt-2" style="z-index: 1100; width: 200px;">
                        <div class="d-flex align-items-center justify-content-between border-bottom pb-1">
                            <span>Habitaciones</span>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-sm rounded-pill border" onclick="sum('num_bedrooms')">+</button>
                                <input style="width: 25px" id="num_bedrooms" type="text" class="form-control form-control-sm border-0" min="1" value="" placeholder="0" readonly>
                                <button class="btn btn-sm rounded-pill border" onclick="rest('num_bedrooms')">-</button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between border-bottom pt-1 pb-1">
                            <span>Baños</span>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-sm rounded-pill border" onclick="sum('num_bathrooms')">+</button>
                                <input style="width: 25px" id="num_bathrooms" type="text" class="form-control form-control-sm border-0" min="1" value="" placeholder="0" readonly>
                                <button class="btn btn-sm rounded-pill border" onclick="rest('num_bathrooms')">-</button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between pt-1">
                            <span>Garage</span>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-sm rounded-pill border" onclick="sum('num_garage')">+</button>
                                <input style="width: 25px" id="num_garage" type="text" class="form-control form-control-sm border-0" min="1" value="" placeholder="0" readonly>
                                <button class="btn btn-sm rounded-pill border" onclick="rest('num_garage')">-</button>
                            </div>
                        </div>                    
                    </div>
                </section>

                <div class="slash" style="width: 5px !important">/</div>

                <section class="position-relative w-100 margin-bottom-mobile">
                    <span class="text-muted label-filter" style="font-size: x-small; display: none">$ Monto de la propiedad</span>
                    <div class="text-center border-tabs-mobile">
                        <label style="cursor: pointer" onclick="showfilter('tab4')" class="w-100">Precio <img class="ms-1 img-filters" width="10px" style="display: none" src="{{ asset('img/icon-down-arrow.png') }}" alt=""></label>
                    </div>
                    <div id="tab4" class="position-absolute p-2 bg-white border rounded shadow-sm d-none mt-2" style="z-index: 1100; width: 230px">
                        <div>
                            <div class="d-flex justify-content-center">
                                <label>Desde <span class="text-center fw-bold" id="currentValueRange"> @if($rangePrice>0) ${{ $rangePrice }} @else ${{ $minRangePrice }} @endif</span> Hasta ${{ $maxRangePrice }}</label>
                            </div>
                            <div class="border-bottom pb-2 d-flex justify-content-center gap-2">
                                <div>
                                    <span class="text-muted fw-bold" style="font-size: x-small">Mínimo</span>
                                    <span class="text-muted fw-bold" style="font-size: small">${{ $minRangePrice }}</span>
                                </div>
                                <input type="range" id="rangePrice" oninput="changeValueRangePrice()" min="{{$minRangePrice}}" max="{{ $maxRangePrice }}" value="" step="20" />
                                <div>
                                    <span class="text-muted fw-bold" style="font-size: x-small">Máximo</span>
                                    <span class="text-muted fw-bold" style="font-size: small">${{ $maxRangePrice }}</span>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="border-bottom pb-2">
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
                        </div>                 --}}
                    </div>
                </section>

                <div class="slash">/</div>

                <section class="position-relative w-100 margin-bottom-mobile">
                    <span class="text-muted label-filter" style="font-size: x-small; display: none">Características adicionales</span>
                    <div class="text-center border-tabs-mobile">
                        <label style="cursor: pointer" onclick="showfilter('tab5')" class="w-100">Caracteristicas <img class="ms-1 img-filters" style="display: none" width="10px" src="{{ asset('img/icon-down-arrow.png') }}" alt=""></;>
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

                <section class="btn-search-mobile">
                    <button onclick="filter_properties()" class="btn btn-dark btn-sm rounded-pill px-5">Buscar</button>
                </section>
            </div>
        </section>
    </section>

    <section class="container mt-5">
        <section class="row">
            <section class="col-sm-12">
                <section class="row justify-content-center">
                    @if(count($properties)>0)
                        @foreach ($properties as $propertie)
            
                            @php
                                //get first image
                                $imgpri = explode("|", $propertie->images);
                            @endphp
            
                            <article class="col-sm-3 my-1" style="padding-left: 0px !important; padding-right: 0px !important">
                                <a href="{{ route('show.property', $propertie->slug) }}" style="text-decoration: none">
                                    <div class="card rounded-0 h-100 mx-1">
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
                                                {{-- <p style="font-size: small" class="text-muted">{{ $propertie->listing_description }}</p> --}}
                                                <p><img width="20px" src="{{ asset('img/location-icon.png') }}" alt=""> {{$propertie->state}}, {{ $propertie->city }}, {{ $propertie->sector }}</p>
                                            </div>
                                        </div>
                                        <div class="card-footer border-0 bg-white">
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
                                </a>
                            </article>
                        @endforeach
                    @else
                        <section class="row">
                            <p class="text-center fw-bold">No hemos encontrado propiedades</p>
                        </section>
                    @endif
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

        // let min_price = document.getElementById('min_price').value;
        // let max_price = document.getElementById('max_price').value;

        let rangePrice = document.getElementById('rangePrice').value;

        let city = document.getElementById('inpCity').value;

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
        // @this.set('min_price', min_price);
        // @this.set('max_price', max_price);
        @this.set('city', city);
        @this.set('rangePrice', rangePrice);
        @this.set('currentTab', '');
    }

    const sum = (input) => document.getElementById(input).value++;
    const rest = (input) => document.getElementById(input).value > 1 ? document.getElementById(input).value-- : null;

    const showfilter = (tab_id) => {
        for (let index = 1; index < 6; index++) {
            let current_tab = document.getElementById('tab'+index);
            if(current_tab){
                current_tab.classList.add('d-none')
            }
        }
        document.getElementById(tab_id).classList.remove('d-none');
        tab_id == "tab2" ? @this.set('currentTab', tab_id) : null;
    }

    const setValueCity = (id, name) => {
        let inputCity = document.getElementById('inpCity');
        inputCity.value = id;
        //@this.set('checkCity', id);
        let divCityValue = document.getElementById('divCityValue');
        let spanCityValue = document.getElementById('spanCityValue');

        spanCityValue.textContent = name;
        divCityValue.classList.remove('d-none');
    }

    const disabledCheckBoxesTypes = () => {
        let checkboxes = document.getElementsByName('types');
        let checkedCheckbox = 0;
        checkboxes.forEach(element => {
            if(element.checked) checkedCheckbox++;
        });
        if(checkedCheckbox == 3){
            checkboxes.forEach(element => {
                element.checked == false ? element.disabled = true : null;
            });
        } else {
            checkboxes.forEach(element => {
                element.disabled = false;
            });
        }
    }

    const changeValueRangePrice = () => {
        let rangePrice = document.getElementById('rangePrice');
        console.log(rangePrice.value);
        document.getElementById('currentValueRange').textContent = "$"+rangePrice.value;
    }

</script>