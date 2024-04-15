<div>
    @if($ismobile)
    <div class="d-flex justify-content-end" style="position: sticky !important; top: 10px; !important; z-index: 5; margin-right:-12px">
        <button id="buttonFilter" class="btn btn-danger" onclick="setAnimation()">Filtros</button>
    </div>
    <div id="filters-mobile" style="position: fixed; top: 0px; right: 0px; background-color: #ffffff; width: 90vw; height: 100%; z-index: 4; margin-right: -350px">
        <div class="px-1 d-flex gap-2 align-items-center" style="background-color: #242B40; color: #ffffff">
            <p class="pt-3 pb-2 ps-3 h5">Filtrar por:</p>
        </div>
        <section class="section-search pt-3">
            <section class="d-flex ps-4 pe-1 rounded-pill py-1 rounded-search-mobile shadow-sm" style="border: 1px solid #000000">
                <div class="d-flex w-100 justify-content-between align-items-center search">
                    <section class="position-relative w-100 margin-bottom-mobile">
                        <span class="text-muted label-filter" style="font-size: x-small; display: none">Tipo de propiedad</span>
                        <div class="text-center border-tabs-mobile">
                            <label style="cursor: pointer" onclick="showfilter('tab1', null)" class="text-center w-100">Todas las propiedades <img class="ms-1 img-filters" width="10px" style="display: none" src="{{ asset('img/icon-down-arrow.png') }}" alt=""></label>
                        </div>
                        <div id="tab1" class="position-absolute p-2 bg-white border rounded shadow-sm d-none mt-1" style="z-index: 1; width: 200px">
                            <div class="position-absolute" style="top: -5px; right: -5px">
                                <div onclick="showfilter('tab1', 'close')" class="rounded-pill text-white d-flex justify-content-center align-items-center" style="width: 18px; height: 18px; background-color: #242B40; cursor: pointer">x</div>
                            </div>
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
                            <label style="cursor: pointer" onclick="showfilter('tab2', null)" class="w-100">Ubicación <img class="ms-1 img-filters" width="10px" style="display: none" src="{{ asset('img/icon-down-arrow.png') }}" alt=""></label>
                        </div>
                        <div id="tab2" class="position-absolute p-2 bg-white border rounded shadow-sm @if(!$showTab2) d-none @endif mt-2" style="z-index: 1; width: 200px">
                            <div class="position-absolute" style="top: -5px; right: -5px">
                                <div onclick="showfilter('tab2', 'close')" class="rounded-pill text-white d-flex justify-content-center align-items-center" style="width: 18px; height: 18px; background-color: #242B40; cursor: pointer">x</div>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="w-100 form-control border-0 border-bottom" placeholder="Ingrese una ciudad" id="inpCity">
                                {{-- @if (count($cities)>0)
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
                                <input style="display: none" type="text" id="inpCity" value=""> --}}
                            </div>
                            {{-- <hr>
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
                            </div> --}}
                        </div>
                    </section>
    
                    <div class="slash">/</div>
    
                    <section class="position-relative w-100 margin-bottom-mobile">
                        <span class="text-muted label-filter" style="font-size: x-small; display: none">Especificaciones de la propiedad</span>
                        <div class="text-center border-tabs-mobile">
                            <label style="cursor: pointer" onclick="showfilter('tab3', null)" class="w-100">Número de... <img class="ms-1 img-filters" width="10px img-filters" style="display: none" src="{{ asset('img/icon-down-arrow.png') }}" alt=""></label>
                        </div>
                        <div id="tab3" class="position-absolute p-2 bg-white border rounded shadow-sm d-none mt-2" style="z-index: 1100; width: 200px;">
                            <div class="position-absolute" style="top: -5px; right: -5px">
                                <div onclick="showfilter('tab3', 'close')" class="rounded-pill text-white d-flex justify-content-center align-items-center" style="width: 18px; height: 18px; background-color: #242B40; cursor: pointer">x</div>
                            </div>
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
    
                    <div class="slash">/</div>
    
                    <section class="position-relative w-100 margin-bottom-mobile">
                        <span class="text-muted label-filter" style="font-size: x-small; display: none">Buscar por código</span>
                        <div class="text-center border-tabs-mobile">
                            <label style="cursor: pointer" onclick="showfilter('tab6', null)" class="w-100">Código <img class="ms-1 img-filters" width="10px img-filters" style="display: none" src="{{ asset('img/icon-down-arrow.png') }}" alt=""></label>
                        </div>
                        <div id="tab6" class="position-absolute p-2 bg-white border rounded shadow-sm d-none mt-2" style="z-index: 1100; width: 200px;">
                            <div class="position-absolute" style="top: -5px; right: -5px">
                                <div onclick="showfilter('tab6', 'close')" class="rounded-pill text-white d-flex justify-content-center align-items-center" style="width: 18px; height: 18px; background-color: #242B40; cursor: pointer">x</div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between border-bottom pb-1">
                                <div class="d-flex align-items-center">
                                    <input id="code" type="text" class="form-control form-control-sm border-0" placeholder="Ej: 2214">
                                </div>
                            </div>          
                        </div>
                    </section>
    
                    <div class="slash" style="width: 5px !important">/</div>
    
                    <section class="position-relative w-100 margin-bottom-mobile">
                        <span class="text-muted label-filter" style="font-size: x-small; display: none">$ Monto de la propiedad</span>
                        <div class="text-center border-tabs-mobile">
                            <label style="cursor: pointer" onclick="showfilter('tab4', null)" class="w-100">Precio <img class="ms-1 img-filters" width="10px" style="display: none" src="{{ asset('img/icon-down-arrow.png') }}" alt=""></label>
                        </div>
                        <div id="tab4" class="position-absolute p-2 bg-white border rounded shadow-sm d-none mt-2" style="z-index: 1100; width: 230px">
                            <div class="position-absolute" style="top: -5px; right: -5px">
                                <div onclick="showfilter('tab4', 'close')" class="rounded-pill text-white d-flex justify-content-center align-items-center" style="width: 18px; height: 18px; background-color: #242B40; cursor: pointer">x</div>
                            </div>
                            <div>
                                <div class="d-flex justify-content-center">
                                    <label>Desde <span class="text-center fw-bold" id="currentValueRange"> @if($rangePrice>0) ${{ $rangePrice }} @else ${{ $minRangePrice }} @endif</span> Hasta ${{ $maxRangePrice }}</label>
                                </div>
                                <div class="border-bottom pb-2 d-flex justify-content-center gap-2">
                                    <div>
                                        <span class="text-muted fw-bold" style="font-size: x-small">Mínimo</span>
                                        <span class="text-muted fw-bold" style="font-size: small">${{ $minRangePrice }}</span>
                                    </div>
                                    <input type="range" id="rangePrice" oninput="changeValueRangePrice()" min="{{$minRangePrice}}" max="{{ $maxRangePrice }}" value="{{ $minRangePrice }}" step="20" />
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
                            <label style="cursor: pointer" onclick="showfilter('tab5', null)" class="w-100">Caracteristicas <img class="ms-1 img-filters" style="display: none" width="10px" src="{{ asset('img/icon-down-arrow.png') }}" alt=""></;>
                        </div>
                        <div id="tab5" class="position-absolute p-2 bg-white border rounded shadow-sm d-none mt-2 w-100" style="z-index: 1100;">
                            <div class="position-absolute" style="top: -5px; right: -5px">
                                <div onclick="showfilter('tab5', 'close')" class="rounded-pill text-white d-flex justify-content-center align-items-center" style="width: 18px; height: 18px; background-color: #242B40; cursor: pointer">x</div>
                            </div>
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
                        <button onclick="closeFilters()" style="font-size: small" class="btn btn-danger btn-sm fw-bold rounded-pill">Cancelar</button>
                        {{-- <button onclick="filter_properties()" class="btn btn-dark btn-sm rounded-pill px-5">Buscar</button> --}}
                        <button onclick="filter_properties()" style="background-color: #242B40;" class="btn btn-sm rounded-pill px-5 text-white">Buscar</button>
                        {{-- <button class="btn btn-danger btn-sm rounded-pill px-5">Eliminar Filtros</button> --}}
                    </section>
                </div>
            </section>
        </section>
    </div>
    @else
    <section class="section-search">
        <section class="d-flex ps-4 pe-1 rounded-pill py-1 rounded-search-mobile shadow-sm" style="border: 1px solid #000000">
            <div class="d-flex w-100 justify-content-between align-items-center search">
                <section class="position-relative w-100 margin-bottom-mobile">
                    <span class="text-muted label-filter" style="font-size: x-small; display: none">Tipo de propiedad</span>
                    <div class="text-center border-tabs-mobile">
                        <label style="cursor: pointer" onclick="showfilter('tab1', null)" class="text-center w-100">Todas las propiedades <img class="ms-1 img-filters" width="10px" style="display: none" src="{{ asset('img/icon-down-arrow.png') }}" alt=""></label>
                    </div>
                    <div id="tab1" class="position-absolute p-2 bg-white border rounded shadow-sm d-none mt-1" style="z-index: 1; width: 200px">
                        <div class="position-absolute" style="top: -5px; right: -5px">
                            <div onclick="showfilter('tab1', 'close')" class="rounded-pill text-white d-flex justify-content-center align-items-center" style="width: 18px; height: 18px; background-color: #242B40; cursor: pointer">x</div>
                        </div>
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
                        <label style="cursor: pointer" onclick="showfilter('tab2', null)" class="w-100">Ubicación <img class="ms-1 img-filters" width="10px" style="display: none" src="{{ asset('img/icon-down-arrow.png') }}" alt=""></label>
                    </div>
                    <div id="tab2" class="position-absolute p-2 bg-white border rounded shadow-sm @if(!$showTab2) d-none @endif mt-2" style="z-index: 1; width: 200px">
                        <div class="position-absolute" style="top: -5px; right: -5px">
                            <div onclick="showfilter('tab2', 'close')" class="rounded-pill text-white d-flex justify-content-center align-items-center" style="width: 18px; height: 18px; background-color: #242B40; cursor: pointer">x</div>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="w-100 form-control border-0 border-bottom" placeholder="Ingrese una ciudad" id="inpCity">
                            {{-- @if (count($cities)>0)
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
                            <input style="display: none" type="text" id="inpCity" value=""> --}}
                        </div>
                        {{-- <hr>
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
                        </div> --}}
                    </div>
                </section>

                <div class="slash">/</div>

                <section class="position-relative w-100 margin-bottom-mobile">
                    <span class="text-muted label-filter" style="font-size: x-small; display: none">Especificaciones de la propiedad</span>
                    <div class="text-center border-tabs-mobile">
                        <label style="cursor: pointer" onclick="showfilter('tab3', null)" class="w-100">Número de... <img class="ms-1 img-filters" width="10px img-filters" style="display: none" src="{{ asset('img/icon-down-arrow.png') }}" alt=""></label>
                    </div>
                    <div id="tab3" class="position-absolute p-2 bg-white border rounded shadow-sm d-none mt-2" style="z-index: 1100; width: 200px;">
                        <div class="position-absolute" style="top: -5px; right: -5px">
                            <div onclick="showfilter('tab3', 'close')" class="rounded-pill text-white d-flex justify-content-center align-items-center" style="width: 18px; height: 18px; background-color: #242B40; cursor: pointer">x</div>
                        </div>
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

                <div class="slash">/</div>

                <section class="position-relative w-100 margin-bottom-mobile">
                    <span class="text-muted label-filter" style="font-size: x-small; display: none">Buscar por código</span>
                    <div class="text-center border-tabs-mobile">
                        <label style="cursor: pointer" onclick="showfilter('tab6', null)" class="w-100">Código <img class="ms-1 img-filters" width="10px img-filters" style="display: none" src="{{ asset('img/icon-down-arrow.png') }}" alt=""></label>
                    </div>
                    <div id="tab6" class="position-absolute p-2 bg-white border rounded shadow-sm d-none mt-2" style="z-index: 1100; width: 200px;">
                        <div class="position-absolute" style="top: -5px; right: -5px">
                            <div onclick="showfilter('tab6', 'close')" class="rounded-pill text-white d-flex justify-content-center align-items-center" style="width: 18px; height: 18px; background-color: #242B40; cursor: pointer">x</div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between border-bottom pb-1">
                            <div class="d-flex align-items-center">
                                <input id="code" type="text" class="form-control form-control-sm border-0" placeholder="Ej: 2214">
                            </div>
                        </div>          
                    </div>
                </section>

                <div class="slash" style="width: 5px !important">/</div>

                <section class="position-relative w-100 margin-bottom-mobile">
                    <span class="text-muted label-filter" style="font-size: x-small; display: none">$ Monto de la propiedad</span>
                    <div class="text-center border-tabs-mobile">
                        <label style="cursor: pointer" onclick="showfilter('tab4', null)" class="w-100">Precio <img class="ms-1 img-filters" width="10px" style="display: none" src="{{ asset('img/icon-down-arrow.png') }}" alt=""></label>
                    </div>
                    <div id="tab4" class="position-absolute p-2 bg-white border rounded shadow-sm d-none mt-2" style="z-index: 1100; width: 230px">
                        <div class="position-absolute" style="top: -5px; right: -5px">
                            <div onclick="showfilter('tab4', 'close')" class="rounded-pill text-white d-flex justify-content-center align-items-center" style="width: 18px; height: 18px; background-color: #242B40; cursor: pointer">x</div>
                        </div>
                        <div>
                            <div class="d-flex justify-content-center">
                                <label>Desde <span class="text-center fw-bold" id="currentValueRange"> @if($rangePrice>0) ${{ $rangePrice }} @else ${{ $minRangePrice }} @endif</span> Hasta ${{ $maxRangePrice }}</label>
                            </div>
                            <div class="border-bottom pb-2 d-flex justify-content-center gap-2">
                                <div>
                                    <span class="text-muted fw-bold" style="font-size: x-small">Mínimo</span>
                                    <span class="text-muted fw-bold" style="font-size: small">${{ $minRangePrice }}</span>
                                </div>
                                <input type="range" id="rangePrice" oninput="changeValueRangePrice()" min="{{$minRangePrice}}" max="{{ $maxRangePrice }}" value="{{ $minRangePrice }}" step="20" />
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
                        <label style="cursor: pointer" onclick="showfilter('tab5', null)" class="w-100">Caracteristicas <img class="ms-1 img-filters" style="display: none" width="10px" src="{{ asset('img/icon-down-arrow.png') }}" alt=""></;>
                    </div>
                    <div id="tab5" class="position-absolute p-2 bg-white border rounded shadow-sm d-none mt-2 w-100" style="z-index: 1100;">
                        <div class="position-absolute" style="top: -5px; right: -5px">
                            <div onclick="showfilter('tab5', 'close')" class="rounded-pill text-white d-flex justify-content-center align-items-center" style="width: 18px; height: 18px; background-color: #242B40; cursor: pointer">x</div>
                        </div>
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
                    {{-- <button onclick="filter_properties()" class="btn btn-dark btn-sm rounded-pill px-5">Buscar</button> --}}
                    <button onclick="filter_properties()" class="btn btn-dark btn-sm rounded-pill px-5">Buscar</button>
                    {{-- <button class="btn btn-danger btn-sm rounded-pill px-5">Eliminar Filtros</button> --}}
                </section>
            </div>
        </section>
    </section>
    @endif

    <section class="container mt-5">
        <section class="row">
            <section class="col-sm-12">
                <section class="row justify-content-center">
                    @if(count($properties)>0)
                        @foreach ($properties as $propertie)
                            @php
                                if($propertie->images != null){
                                    $imgpri = explode("|", $propertie->images);
                                }
                            @endphp
                            <article class="col-12 my-1" style="padding-left: 0px !important; padding-right: 0px !important">
                                    <div class="card mb-3 rounded-0">
                                        <div class="row g-0 d-flex">
                                            <div class="col-md-4">
                                                <a href="{{ route('show.property', $propertie->slug) }}" style="text-decoration: none">
                                                    <div class="image_thumbnail" style="height: 325px; background-position: center; background-repeat: no-repeat; background-size: cover; background-image: url('https://grupohousing.com/uploads/listing/{{$imgpri[0]}}')"></div>
                                                </a>
                                            </div>
                                            <div class="col-md-8 px-5 py-3 padding-mobile-0">
                                                <div class="card-body">
                                                    <a href="{{ route('show.property', $propertie->slug) }}" class="text-dark" style="text-decoration: none">
                                                        <h2 class="card-title">{{ $propertie->listing_title }}</h2>
                                                    </a>
                                                    @if(isset($propertie->address))
                                                        <p class="h4 text-muted"> <span style="font-weight: 600">Sector:</span> {{ $propertie->address }}</p>
                                                    @else
                                                        <p class="h4 text-muted"> <span style="font-weight: 600">Sector:</span> {{ $propertie->sector}}</p>
                                                    @endif
                                                    <div class="d-flex justify-content-between">
                                                        <p class="card-text" style="font-size: 23px">${{ $propertie->property_price }}</p>
                                                        <div style="background-color: #242B40; color: #ffffff; width: 150px; height: 32px; font-size: large" class="d-flex justify-content-center align-items-center rounded-pill px-3">COD: {{ $propertie->product_code }}</div>                                                    
                                                </div>
                                                <p class="text-muted">{{ Str::limit(Str::title($propertie->listing_description), '150') }}</p>
                                                <hr>
                                                <div class="row align-items-center">
                                                    <div class="col-sm-8 d-flex justify-content-around">
                                                        @if($propertie->bedroom > 0)
                                                            <div class="d-flex align-items-center justify-content-center w-100 border-end characteristics">
                                                                <img width="50px" height="50px" src="{{ asset('img/dormitorios.png') }}" alt="">
                                                                <p class="pt-3" style="font-weight: 600; font-size: 15px">{{ $propertie->bedroom }} Hab.</p>
                                                            </div>
                                                        @endif
                                                        @if($propertie->bathroom > 0)
                                                            <div class="d-flex align-items-center justify-content-center w-100 border-end characteristics">
                                                                <img width="50px" height="50px" src="{{ asset('img/baño.png') }}" alt="">
                                                                <p class="pt-3" style="font-weight: 600; font-size: 15px">{{ $propertie->bathroom }} @if($propertie->bathroom > 1) Baños @else Baño @endif</p>
                                                            </div>
                                                        @endif
                                                        @if($propertie->garage > 0)
                                                            <div class="d-flex align-items-center justify-content-center w-100 border-end characteristics">
                                                                <img width="50px" height="50px" src="{{ asset('img/estacionamiento.png') }}" alt="">
                                                                <p class="pt-3" style="font-weight: 600; font-size: 15px">{{ $propertie->garage }} @if($propertie->garage > 1) Garajes @else Garaje @endif</p>
                                                            </div>
                                                        @endif
                                                        @if($propertie->construction_area > 0)
                                                            <div class="d-flex align-items-center justify-content-center w-100 characteristics">
                                                                <img width="50px" height="50px" src="{{ asset('img/area.png') }}" alt="">
                                                                <p class="pt-3" style="font-weight: 600; font-size: 15px">{{ $propertie->construction_area }} m<sup>2</sup> </p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-sm-4 d-flex gap-3">
                                                        <div class="w-100 d-flex align-items-center" style="height: 35px">
                                                            <a href="tel:+593987474637" class="btn rounded-pill w-100 ps-4 pe-4 d-flex align-items-center" style="font-size: smaller; border: 0.5px #242B40 solid; height: 25px">Llamar</a>
                                                            <div style="margin-left: -23px; background-color: #242B40; width: 35px; height: 30px" class="rounded-circle d-flex align-items-center justify-content-center">
                                                                <a href="tel:+593987474637"><img width="15px" style="filter: invert(1);" src="{{ asset('img/phone-icon.png') }}" alt=""></a>
                                                            </div>
                                                        </div>
                                                        <div class="w-100 d-flex align-items-center" style="height: 35px">
                                                            <a href="https://wa.me/+593987474637?text=Hola%2C%20Housing%20Rent%20estoy%20interesado%20en%20alquilar%20esta%20propiedad:%20{{ $propertie->product_code}}" class="btn rounded-pill w-100 ps-4 pe-4 d-flex align-items-center" style="font-size: smaller; border: 0.5px green solid; height: 25px; color: green">WhatsApp</a>
                                                            <div style="margin-left: -23px; padding-top: 2px; background-color: green; width: 35px; height: 30px" class="rounded-circle d-flex justify-content-center">
                                                                <a href="https://wa.me/+593987474637?text=Hola%2C%20Housing%20Rent%20estoy%20interesado%20en%20alquilar%20esta%20propiedad:%20{{ $propertie->product_code}}"><img width="20px" style="filter: invert(1)" src="{{ asset('img/whatsapp-icon.png') }}" alt=""></a>
                                                            </div>
                                                            {{-- <button class="btn rounded-pill text-white w-100" style="background-color: #242B40; font-size: smaller" onclick="setInformationModal('{{$imgpri[0]}}', '{{$propertie->listing_title}}', '{{$propertie->product_code}}')" data-bs-toggle="modal" data-bs-target="#exampleModal">CONTACTAR</button> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="card rounded-0 h-100 mx-1">
                                        <div class="card-body">
                                            <div class="position-relative">
                                                <img class="img-fluid" src="https://grupohousing.com/uploads/listing/600/{{$imgpri[0]}}" alt="">
                                                <div class="position-absolute" style="top: 5px; left: 5px">
                                                    <span class="bg-white text-dark px-2 rounded-pill" style="font-size: small; font-weight: 600">Propiedad destacada</span>
                                                </div>
                                            </div>
                                            <div>
                                                <h2 class="fw-bold mt-3" style="font-size: medium">{{ $propertie->listing_title }}</h2>
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
                                    </div> --}}
                            </article>

                            @endforeach
                            <div class="row">
                                {{ $properties->links() }}
                            </div>
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

        let types = document.getElementsByName('types');
        let zones = document.getElementsByName('zones');
        let resulttypes = [];
        let resultzones = [];

        let bedrooms = document.getElementById('num_bedrooms').value;
        let bathrooms = document.getElementById('num_bathrooms').value;
        let garage = document.getElementById('num_garage').value;

        let code = document.getElementById('code').value;

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
        @this.set('product_code', code);
        // @this.set('min_price', min_price);
        // @this.set('max_price', max_price);
        @this.set('citySearch', city);
        @this.set('rangePrice', rangePrice);
        @this.set('currentTab', '');

        @this.searchProperties();
    }

    const sum = (input) => document.getElementById(input).value++;
    const rest = (input) => document.getElementById(input).value > 1 ? document.getElementById(input).value-- : null;

    const showfilter = (tab_id, action) => {
        for (let index = 1; index < 6; index++) {
            let current_tab = document.getElementById('tab'+index);
            if(current_tab){
                "tab"+index != tab_id ? current_tab.classList.add('d-none') : null;
            }
        }
        if(document.getElementById(tab_id).classList.contains('d-none')){
            document.getElementById(tab_id).classList.remove('d-none');
        } else {
            document.getElementById(tab_id).classList.add('d-none');
        }
        //tab_id == "tab2" && action != "close" && !document.getElementById('tab2').classList.contains('d-none') ? @this.set('currentTab', tab_id) : null;
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
        document.getElementById('currentValueRange').textContent = "$"+rangePrice.value;
    }

    const setAnimation = () => {
        let div = document.getElementById('filters-mobile');
        let buttonFilter = document.getElementById('buttonFilter');

        div.style.animation = "slide-right 1s ease";
        div.style.marginRight = "0px";

        buttonFilter.style.animation = "slide-button-filter-right 1s ease";
        buttonFilter.style.marginRight = '-100px';
    }

    const closeFilters = () => {
        let div = document.getElementById('filters-mobile');
        div.style.animation = 'slide-left 1s ease';
        div.style.marginRight = "-350px";

        buttonFilter.style.animation = "slide-button-filter-left 1s ease";
        buttonFilter.style.marginRight = '0px';
    }
</script>