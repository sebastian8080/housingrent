@extends('layouts.web')


@section('title', 'Propiedades en Renta Cuenca - Housing Rent Group')

@section('css')
    @parent
    <link rel="stylesheet" href="{{ asset('css/font-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home-style.css?v=1') }}">

    <style>
        .search-bar-container {
            position: -webkit-sticky;
            /* Soporte para Safari */
            position: sticky;
            top: 0;
            /* Se pegará a 0px del top del viewport */
            z-index: 1050;
            /* Estilo opcional */
            width: 100%;
            /* Se extiende a lo ancho del contenedor */
        }


        .search-bar {
            position: sticky;
            z-index: 1050;
            border: 1px solid #e0e0e0;
            /* Color más suave para el borde */
            border-radius: 12px;
            background-color: #ffffff;
            /* Blanco para mantener la uniformidad */
            padding: 20px;
            width: 100%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Sutil sombra para dar profundidad */
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            /* Color suave para el borde del input */
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.06);
            /* Sutil sombra interna */
        }

        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
            /* Resaltado cuando el input está en foco */
        }

        .dropdown-menu {
            border: 0;
            /* Eliminación del borde en los dropdown */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Sombra para los dropdown para consistencia */
        }

        .btn-light {
            background-color: #ffffff;
            color: #333;
            /* Añadiendo color al texto para mejor contraste */
        }

        .btn-light:hover {
            background-color: #f8f9fa;
            /* Cambio sutil al hacer hover */
        }

        @media (max-width: 768px) {

            .form-control,
            .dropdown-toggle {
                font-size: 14px;
                /* Tamaño de letra más manejable en dispositivos pequeños */
            }
        }

        .container-fluid {
            padding: 0;
            /* Eliminación del padding para más control en el diseño */
        }

        .mx-auto {
            margin-right: auto;
            margin-left: auto;
        }

        @media (max-width: 768px) {
            .btn-fixed {
                position: fixed;
                bottom: 10px;
                left: 10px;
                z-index: 1000;
                /* Mantenimiento del botón flotante en móviles */
            }
        }
    </style>
@endsection

@section('content')
    <section class="container">
        <section class="p-5">
            <h2 style="font-family: 'Sharp Grotesk'" class="text-center display-6 fw-bold"><span
                    style="font-weight: 100">Prueba nuestro</span> <span style="font-weight: 500">buscador avanzado</span>
            </h2>
        </section>
    </section>

    <div class="container">
        <h1 style="font-family: 'Sharp Grotesk'; text-align: left;" class="h3 fw-bold">
            <span style="font-weight: 500">Total</span>
            <span style="font-weight: 100"> propiedades en renta</span>
        </h1>
    </div>

    <section class="container-fluid text-center search-bar-container">

        <!-- Contenido para desktop -->
        <div class="container d-none d-md-block mx-auto">
            <div class="card search-bar">
                <form id="searchFormDesktop" class="row g-3 align-items-end justify-content-center">
                    <form id="searchForm" class="row g-3 align-items-end">
                        <div class="col-4">
                            <input type="text" id="searchTerm" class="form-control"
                                placeholder="Buscar por ubicación, codígo, tipo...">
                        </div>
                        <div class="col-auto dropdown">
                            <select class="form-control" id="propertyType">
                                <option value="">Tipo de Propiedad</option>
                                <option data-ids="[23,1]" value="1">Casas</option>
                                <option data-ids="[24,3]" value="2">Departamentos</option>
                                <option data-ids="[25,5]" value="3">Casas Comerciales</option>
                                <option data-ids="[32,6]" value="4">Locales Comerciales</option>
                                <option data-ids="[35,7]" value="5">Oficinas</option>
                                <option data-ids="[36,8]" value="6">Suites</option>
                                <option data-ids="[29,9]" value="7">Quintas</option>
                                <option data-ids="[30,30]" value="8">Haciendas</option>
                            </select>
                        </div>
                        <div class="col-auto dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="locationInput"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Ubicación
                            </button>
                            <div class="dropdown-menu p-2" aria-labelledby="locationInput">
                                <input type="text" id="sector" class="form-control mb-2" placeholder="Sector">
                                <input type="text" id="city" class="form-control mb-2" placeholder="Ciudad">
                                <input type="text" id="state" class="form-control" placeholder="Provincia">
                            </div>
                        </div>
                        <div class="col-auto dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="priceInput"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Precio
                            </button>
                            <div class="dropdown-menu p-2" aria-labelledby="priceInput">
                                <input type="number" id="minPrice" class="form-control mb-2" placeholder="Precio mínimo">
                                <input type="number" id="maxPrice" class="form-control" placeholder="Precio máximo">
                            </div>
                        </div>
                        <div class="col-auto dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="featuresInput"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Características
                            </button>
                            <div class="dropdown-menu p-2" aria-labelledby="featuresInput">
                                <input type="number" id="bedrooms" class="form-control mb-2" placeholder="Habitaciones">
                                <input type="number" id="bathrooms" class="form-control mb-2" placeholder="Baños">
                                <input type="number" id="garage" class="form-control" placeholder="Garajes">
                            </div>
                        </div>

                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                            <button type="button" class="btn btn-secondary"
                                onclick="clearSearch(false)">Limpiar</button>
                        </div>
                    </form>
                </form>
            </div>
        </div>
    </section>


    <section class="container-fluid text-center">
        <!-- Botón para abrir modal en dispositivos móviles -->
        <div class="d-md-none mt-3">
            <button class="btn btn-primary btn-fixed" type="button" data-bs-toggle="modal"
                data-bs-target="#filtersModal">
                Abrir Filtros
            </button>
        </div>

        <!-- Modal para los filtros -->
        <div class="modal fade" id="filtersModal" tabindex="-1" aria-labelledby="filtersModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filtersModalLabel">Filtros de Búsqueda</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="searchFormModal" class="row g-3 align-items-end">
                            <div class="col-12">
                                <input type="text" id="searchTermModal" class="form-control" placeholder="Buscar...">
                            </div>
                            <div class="col-auto dropdown">
                                <select class="form-control" id="propertyTypeModal">
                                    <option value="">Tipo de Propiedad</option>
                                    <option data-ids="[23,1]" value="1">Casas</option>
                                    <option data-ids="[24,3]" value="2">Departamentos</option>
                                    <option data-ids="[25,5]" value="3">Casas Comerciales</option>
                                    <option data-ids="[32,6]" value="4">Locales Comerciales</option>
                                    <option data-ids="[35,7]" value="5">Oficinas</option>
                                    <option data-ids="[36,8]" value="6">Suites</option>
                                    <option data-ids="[29,9]" value="7">Quintas</option>
                                    <option data-ids="[30,30]" value="8">Haciendas</option>
                                </select>
                            </div>
                            <div class="col-auto dropdown">
                                <button class="btn btn-light dropdown-toggle" type="button" id="locationInputModal"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Ubicación
                                </button>
                                <div class="dropdown-menu p-2" aria-labelledby="locationInputModal">
                                    <input type="text" id="sectorModal" class="form-control" placeholder="Sector">
                                    <input type="text" id="cityModal" class="form-control mb-2" placeholder="Ciudad">
                                    <input type="text" id="stateModal" class="form-control mb-2"
                                        placeholder="Provincia">
                                </div>
                            </div>
                            <div class="col-auto dropdown">
                                <button class="btn btn-light dropdown-toggle" type="button" id="priceInputModal"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Precio
                                </button>
                                <div class="dropdown-menu p-2" aria-labelledby="priceInputModal">
                                    <input type="number" id="minPriceModal" class="form-control mb-2"
                                        placeholder="Precio mínimo">
                                    <input type="number" id="maxPriceModal" class="form-control"
                                        placeholder="Precio máximo">
                                </div>
                            </div>
                            <div class="col-auto dropdown">
                                <button class="btn btn-light dropdown-toggle" type="button" id="featuresInputModal"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Características
                                </button>
                                <div class="dropdown-menu p-2" aria-labelledby="featuresInputModal">
                                    <input type="number" id="bedroomsModal" class="form-control mb-2"
                                        placeholder="Habitaciones">
                                    <input type="number" id="bathroomsModal" class="form-control mb-2"
                                        placeholder="Baños">
                                    <input type="number" id="garageModal" class="form-control" placeholder="Garajes">
                                </div>
                            </div>

                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Buscar</button>
                                <button type="button" class="btn btn-secondary"
                                    onclick="clearSearch(true)">Limpiar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container mt-5" id="propertiesContainer">
        <section class="row">
            <section class="col-sm-12">
                <section class="row justify-content-center" id="propertiesList">
                    <!-- Los resultados de la búsqueda se insertarán aquí -->
                </section>
            </section>
        </section>
        <div class="row justify-content-center">
            <div id="pagination" class="mt-4"></div>
        </div>
    </section>


@endsection

@section('js')
    @parent
    <script>
        var typeIdsArray = [];
        var typeIdsArrayModal = [];
        document.addEventListener('DOMContentLoaded', function() {
            // Valores iniciales recibidos del servidor
            const initialState = '{{ $state ?? '' }}';
            const initialCity = '{{ $city ?? '' }}';
            const initialParish = '{{ $parish ?? '' }}';
            const initialTypeIds = JSON.parse('{{ json_encode($typeId) }}' || '[]');
            console.log(initialTypeIds);
            const searchTerm = new URLSearchParams(window.location.search).get('searchTerm') || '';

            // Configuración inicial para el formulario de desktop
            if (initialState) document.getElementById('state').value = initialState;
            if (initialCity) document.getElementById('city').value = initialCity;
            if (initialParish) document.getElementById('sector').value = initialParish;
            if (searchTerm) document.getElementById('searchTerm').value = searchTerm;
            setInitialPropertyType(initialTypeIds, 'propertyType');

            // Configuración inicial para el formulario modal
            if (initialState) document.getElementById('stateModal').value = initialState;
            if (initialCity) document.getElementById('cityModal').value = initialCity;
            if (initialParish) document.getElementById('sectorModal').value = initialParish;
            if (searchTerm) document.getElementById('searchTermModal').value = searchTerm;
            setInitialPropertyType(initialTypeIds, 'propertyTypeModal');

            // Simular el clic en el botón de búsqueda en ambos formularios
            document.querySelector('#searchFormDesktop button[type="submit"]').click();
            document.querySelector('#searchFormModal button[type="submit"]').click();
        });

        function setInitialPropertyType(typeIds, propertyTypeId) {
            const selectElement = document.getElementById(propertyTypeId);
            const options = selectElement.options;
            for (let i = 0; i < options.length; i++) {
                if (options[i].getAttribute('data-ids') === JSON.stringify(typeIds)) {
                    options[i].selected = true;

                    // Actualiza el array de IDs basado en si es modal o no
                    if (propertyTypeId === 'propertyType') {
                        typeIdsArray = typeIds; // Actualiza para desktop
                    } else if (propertyTypeId === 'propertyTypeModal') {
                        typeIdsArrayModal = typeIds; // Actualiza para modal
                    }

                    // Disparar manualmente el evento de cambio para asegurar que cualquier lógica adicional se ejecute
                    const event = new Event('change');
                    selectElement.dispatchEvent(event);
                    break;
                }
            }
        }
        // Evento para capturar los IDs del formulario desktop
        document.getElementById('propertyType').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var typeIds = selectedOption.getAttribute('data-ids');
            typeIdsArray = JSON.parse(typeIds);
        });

        // Evento para capturar los IDs del formulario modal
        document.getElementById('propertyTypeModal').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var typeIds = selectedOption.getAttribute('data-ids');
            typeIdsArrayModal = JSON.parse(typeIds);
        });
        window.searchProperties = function(page = 1, isModal = false) {
            console.log(isModal);
            page = parseInt(page);
            var currentTypeIds = isModal ? typeIdsArrayModal : typeIdsArray;
            var selectElement = isModal ? document.getElementById('propertyTypeModal') : document.getElementById(
                'propertyType');
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var typeName = selectedOption.text;
            var typeValue = selectedOption.value;

            // Asegúrate de que el tipo tiene un valor significativo, y no es simplemente el marcador de posición
            if (!typeValue) {
                typeName = 'propiedades';
            } else {
                typeName = typeName.toLowerCase().replace(/\s+/g, '-');
            }

            const searchParams = new URLSearchParams({
                searchTerm: document.getElementById(isModal ? 'searchTermModal' : 'searchTerm') ? document
                    .getElementById(isModal ? 'searchTermModal' : 'searchTerm').value : '',
                bedrooms: document.getElementById(isModal ? 'bedroomsModal' : 'bedrooms') ? document
                    .getElementById(isModal ? 'bedroomsModal' : 'bedrooms').value : '',
                bathrooms: document.getElementById(isModal ? 'bathroomsModal' : 'bathrooms') ? document
                    .getElementById(isModal ? 'bathroomsModal' : 'bathrooms').value : '',
                garage: document.getElementById(isModal ? 'garageModal' : 'garage') ? document.getElementById(
                    isModal ? 'garageModal' : 'garage').value : '',
                min_price: document.getElementById(isModal ? 'minPriceModal' : 'minPrice') ? document
                    .getElementById(isModal ? 'minPriceModal' : 'minPrice').value : '',
                max_price: document.getElementById(isModal ? 'maxPriceModal' : 'maxPrice') ? document
                    .getElementById(isModal ? 'maxPriceModal' : 'maxPrice').value : '',
                city: document.getElementById(isModal ? 'cityModal' : 'city') ? document.getElementById(
                    isModal ? 'cityModal' : 'city').value : '',
                state: document.getElementById(isModal ? 'stateModal' : 'state') ? document.getElementById(
                    isModal ? 'stateModal' : 'state').value : '',
                sector: document.getElementById(isModal ? 'sectorModal' : 'sector') ? document.getElementById(
                    isModal ? 'sectorModal' : 'sector').value : '',
                page: page
            });


            let urlSlug = `/${typeName}-en-renta`;
            let titleComponents = [typeName.charAt(0).toUpperCase() + typeName.slice(
                1)]; // Capitalizar el nombre del tipo
            if (searchParams.get('sector')) {
                urlSlug += `-o-${searchParams.get('sector').toLowerCase().replace(/\s+/g, '-')}`;
                titleComponents.push(searchParams.get('sector'));
            }
            if (searchParams.get('state')) {
                urlSlug += `-en-${searchParams.get('state').toLowerCase().replace(/\s+/g, '-')}`;
                titleComponents.push(searchParams.get('state'));
            }
            if (searchParams.get('city')) {
                urlSlug += `-o-${searchParams.get('city').toLowerCase().replace(/\s+/g, '-')}`;
                titleComponents.push(searchParams.get('city'));
            }
            document.title = `${titleComponents.join(' en ')} - Ecuador`;

            // Agregar manualmente los `type_ids[]` asegurando el formato correcto
            let queryString = searchParams.toString();
            currentTypeIds.forEach(id => {
                queryString += `&type_ids[]=${encodeURIComponent(id)}`;
            });

            /* let title = `${typeName} en renta`;
             if (searchParams.get('sector')) title +=
                 ` en ${searchParams.get('sector').toLowerCase()}`;
             if (searchParams.get('city')) title +=
                 ` o ${searchParams.get('city').toLowerCase()}`;
             if (searchParams.get('state')) title +=
                 ` o ${searchParams.get('state').toLowerCase()}`;

             document.title = title 'E';*/

            // Actualiza la URL en el navegador sin recargar la página
            window.history.pushState({
                path: urlSlug
            }, '', urlSlug);

            console.log("Current Type IDs:", currentTypeIds);
            console.log("Query String:", queryString);
            axios.get('/propertys/list?' + queryString)
                .then(function(response) {
                    const properties = response.data.properties;
                    let html = '';
                    if (properties.length > 0) {
                        properties.forEach(property => {
                            let imageUrl = getImageUrl(property);
                            html += buildPropertyHTML(property, imageUrl);
                        });
                        updateDynamicTitle(response.data.pagination.total, searchParams, isModal);
                    } else {
                        html =
                            '<section class="row"><p class="text-center fw-bold">No hemos encontrado propiedades</p></section>';
                        updateDynamicTitle(response.data.pagination.total, searchParams, isModal);
                    }
                    document.getElementById('propertiesList').innerHTML = html;
                    updatePagination(response.data.pagination, isModal);
                })
                .catch(function(error) {
                    console.error('Error en la búsqueda:', error.response ? error.response.data :
                        'Error desconocido');
                    document.getElementById('propertiesList').innerHTML =
                        '<section class="row"><p class="text-center fw-bold">Error al cargar propiedades.</p></section>';
                });
        };

        function updateDynamicTitle(total, searchParams, isModal) {
            const typeElement = document.getElementById(isModal ? 'propertyTypeModal' : 'propertyType');
            const selectedTypeIndex = typeElement.selectedIndex;
            const typeName = typeElement.options[selectedTypeIndex].text;
            const state = searchParams.get('state');
            const city = searchParams.get('city');
            const sector = searchParams.get('sector');

            let titleSuffix = `propiedades en renta`; // Texto por defecto

            // Determinar el prefijo basado en el tipo de propiedad, si es específico y no simplemente "Tipo de Propiedad"
            if (selectedTypeIndex !== 0 && typeName.toLowerCase() !== "tipo de propiedad") {
                titleSuffix = `${typeName.toLowerCase()} en renta`;
            }

            // Agregar detalles de ubicación si están disponibles
            if (sector || city || state) {
                let locationDetails = [];
                if (sector) locationDetails.push(sector);
                if (city) locationDetails.push(city);
                if (state) locationDetails.push(state);
                titleSuffix += ` en ${locationDetails.join(", ")}`;
            }

            // Construir y actualizar el título H1 con el nuevo texto
            document.querySelector('h1').innerHTML =
                `<span style="font-weight: 500">${total}</span><span style="font-weight: 100"> ${titleSuffix}</span>`;
        }

        function getImageUrl(property) {
            if (property.product_code.startsWith('HR-') && property.multimedia && property.multimedia.length > 0) {
                return '{{ asset('storage') }}' + '/' + property.multimedia[0].filename;
            } else if (property.images && typeof property.images === 'string' && property.images.trim() !== '') {
                const imageList = property.images.split('|');
                if (imageList.length > 0 && imageList[0]) {
                    return `https://grupohousing.com/uploads/listing/${imageList[0]}`;
                }
            }
            return '{{ asset('img/casas.jpg') }}'; // Asegúrate de que esta ruta por defecto es válida y accesible
        }

        function updatePagination(pagination, isModal) {
            let paginationHtml =
                '<nav aria-label="Page navigation" class="pagination-nav"><ul class="pagination justify-content-center">';
            // Botón anterior con icono
            if (pagination.prev_page_url) {
                paginationHtml +=
                    `<li class="page-item"><button class="page-link" style="border: 1px solid #242B40; border-radius: 50%; color: #242B40; width: 36px; height: 36px; padding: 0 12px; display: flex; align-items: center; justify-content: center;" onclick="searchProperties(${pagination.current_page - 1}, ${isModal})"><i class="fas fa-angle-left"></i></button></li>`;
            } else {
                paginationHtml +=
                    '<li class="page-item disabled"><span class="page-link" style="border: 1px solid #242B40; border-radius: 50%; color: #242B40; width: 36px; height: 36px; padding: 0 12px; display: flex; align-items: center; justify-content: center;"><i class="fas fa-angle-left"></i></span></li>';
            }

            // Calcular rangos de páginas para paginación deslizante
            let startPage = Math.max(1, pagination.current_page - 2);
            let endPage = Math.min(pagination.current_page + 2, pagination.last_page);
            for (let i = startPage; i <= endPage; i++) {
                const activeClass = pagination.current_page === i ? 'active' : '';
                const activeStyle = activeClass ?
                    'background-color: #242B40; color: white; border: 1px solid #242B40; border-radius: 50%; width: 36px; height: 36px; padding: 0 12px; display: flex; align-items: center; justify-content: center;' :
                    'border: 1px solid #242B40; color: #242B40; border-radius: 50%; width: 36px; height: 36px; padding: 0 12px; display: flex; align-items: center; justify-content: center;';
                paginationHtml +=
                    `<li class="page-item ${activeClass}"><button class="page-link" style="${activeStyle}" onclick="searchProperties(${i}, ${isModal})">${i}</button></li>`;
            }

            // Botón siguiente con icono
            if (pagination.next_page_url) {
                paginationHtml +=
                    `<li class="page-item"><button class="page-link" style="border: 1px solid #242B40; border-radius: 50%; color: #242B40; width: 36px; height: 36px; padding: 0 12px; display: flex; align-items: center; justify-content: center;" onclick="searchProperties(${pagination.current_page + 1}, ${isModal})"><i class="fas fa-angle-right"></i></button></li>`;
            } else {
                paginationHtml +=
                    '<li class="page-item disabled"><span class="page-link" style="border: 1px solid #242B40; border-radius: 50%; color: #242B40; width: 36px; height: 36px; padding: 0 12px; display: flex; align-items: center; justify-content: center;"><i class="fas fa-angle-right"></i></span></li>';
            }
            paginationHtml += '</ul></nav>';
            document.getElementById('pagination').innerHTML = paginationHtml;
        }


        function buildPropertyHTML(property, imageUrl) {
            let aliquotInfo = property.aliquot > 0 ?
                `<p class="card-text" style="font-family: 'Sharp Grotesk', sans-serif;"><strong>Alícuota:</strong> $${property.aliquot}</p>` : '';
            return `<article class="col-12 my-1" style="padding-left: 0px !important; padding-right: 0px !important;">
        <div class="card mb-3 rounded-0">
            <div class="row g-0 d-flex">
                <div class="col-md-4">
                    <a href="/propiedades/${property.slug}" style="text-decoration: none;">
                        <div class="image_thumbnail" style="height: 325px; background-image: url('${imageUrl}'); background-position: center; background-repeat: no-repeat; background-size: cover;"></div>
                    </a>
                </div>
                <div class="col-md-8 px-5 py-3 padding-mobile-0 position-relative">
                    <div class="position-absolute" style="font-family: 'Sharp Grotesk', sans-serif;top: 0px; right: 0px; background-color: #242B40; color: #ffffff; border-radius: 0px 0px 0px 25px !important;">
                        <p class="m-0 py-3 px-3 h5">Cod: ${property.product_code}</p>
                    </div>
                    <div class="card-body">
                        <a href="/propiedades/${property.slug}" class="text-dark" style="text-decoration: none;">
                            <h2 class="card-title" style="font-family: 'Sharp Grotesk', sans-serif; font-size: 1.4rem; padding-right: 60px; font-weight: 500;">${property.listing_title}</h2>
                        </a>
                        <h3 class="h5 text-muted" style="font-family: 'Sharp Grotesk', sans-serif; font-weight: 300;">${property.sector ? `<span>Sector:</span> ${property.sector},` : ''} ${property.city}, ${property.state}</h3>
                        <p class="card-text" style="font-size: 23px; font-family: 'Sharp Grotesk', sans-serif;">$${property.property_price}</p>
                        ${aliquotInfo}
                        <h4 class="h6" style="font-family: 'Sharp Grotesk', sans-serif; font-weight: 100;">${property.listing_description.substring(0, 150)}.....</h4>
                        <hr>
                        <div class="row align-items-center">
                            <div class="col-sm-8 d-flex justify-content-around">
                                ${property.bedroom > 0 ? `<div class="d-flex align-items-center justify-content-center w-100 border-end characteristics">
                                                                                                                                                                                                                            <img width="50px" height="50px" src="{{ asset('img/dormitorios.png') }}" alt="">
                                                                                                                                                                                                                            <p class="pt-3" style="font-weight: 600; font-size: 15px">${property.bedroom} Hab.</p>
                                                                                                                                                                                                                        </div>` : ''}
                                ${property.bathroom > 0 ? `<div class="d-flex align-items-center justify-content-center w-100 border-end characteristics">
                                                                                                                                                                                                                            <img width="50px" height="50px" src="{{ asset('img/banio.png') }}" alt="">
                                                                                                                                                                                                                            <p class="pt-3" style="font-weight: 600; font-size: 15px">${property.bathroom} ${property.bathroom > 1 ? 'Baños' : 'Baño'}</p>
                                                                                                                                                                                                                        </div>` : ''}
                                ${property.garage > 0 ? `<div class="d-flex align-items-center justify-content-center w-100 border-end characteristics">
                                                                                                                                                                                                                            <img width="50px" height="50px" src="{{ asset('img/estacionamiento.png') }}" alt="">
                                                                                                                                                                                                                            <p class="pt-3" style="font-weight: 600; font-size: 15px">${property.garage} ${property.garage > 1 ? 'Garajes' : 'Garaje'}</p>
                                                                                                                                                                                                                        </div>` : ''}
                                ${property.construction_area > 0 ? `<div class="d-flex align-items-center justify-content-center w-100 characteristics">
                                                                                                                                                                                                                            <img width="50px" height="50px" src="{{ asset('img/area.png') }}" alt="">
                                                                                                                                                                                                                            <p class="pt-3" style="font-weight: 600; font-size: 15px">${property.construction_area} m<sup>2</sup> </p>
                                                                                                                                                                                                                        </div>` : ''}
                            </div>
                            <div class="col-sm-4 d-flex gap-3">
                                <div class="w-100 d-flex align-items-center" style="height: 35px">
                                    <a href="tel:+593987595789" class="btn rounded-pill w-100 ps-4 pe-4 d-flex align-items-center" style="font-size: smaller; border: 0.5px #242B40 solid; height: 25px">Llamar</a>
                                    <div style="margin-left: -23px; background-color: #242B40; width: 35px; height: 30px" class="rounded-circle d-flex align-items-center justify-content-center">
                                        <a href="tel:+593987595789"><img width="15px" style="filter: invert(1);" src="{{ asset('img/phone-icon.png') }}" alt=""></a>
                                    </div>
                                </div>
                                <div class="w-100 d-flex align-items-center" style="height: 35px">
                                    <a onclick="return gtag_report_conversion('https://wa.me/+593987595789?text=Hola%2C%20Housing%20Rent%20estoy%20interesado%20en%20alquilar%20esta%20propiedad:%20${property.product_code}');" class="btn rounded-pill w-100 ps-4 pe-4 d-flex align-items-center" style="font-size: smaller; border: 0.5px green solid; height: 25px; color: green">WhatsApp</a>
                                    <div style="margin-left: -23px; padding-top: 2px; background-color: green; width: 35px; height: 30px" class="rounded-circle d-flex justify-content-center">
                                        <a href="https://wa.me/+593987595789?text=Hola%2C%20Housing%20Rent%20estoy%20interesado%20en%20alquilar%20esta%20propiedad:%20${property.product_code}"><img width="20px" style="filter: invert(1)" src="{{ asset('img/whatsapp-icon.png') }}" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>`;
        }


        function clearSearch(isModal) {
            // Determine whether to clear the modal or desktop forms
            const searchTermId = isModal ? 'searchTermModal' : 'searchTerm';
            const bedroomsId = isModal ? 'bedroomsModal' : 'bedrooms';
            const bathroomsId = isModal ? 'bathroomsModal' : 'bathrooms';
            const garageId = isModal ? 'garageModal' : 'garage';
            const minPriceId = isModal ? 'minPriceModal' : 'minPrice';
            const maxPriceId = isModal ? 'maxPriceModal' : 'maxPrice';
            const cityId = isModal ? 'cityModal' : 'city';
            const stateId = isModal ? 'stateModal' : 'state';
            const sectorId = isModal ? 'sectorModal' : 'sector';
            const propertyTypeId = isModal ? 'propertyTypeModal' : 'propertyType';

            // Clear all the fields
            document.getElementById(searchTermId).value = '';
            document.getElementById(bedroomsId).value = '';
            document.getElementById(bathroomsId).value = '';
            document.getElementById(garageId).value = '';
            document.getElementById(minPriceId).value = '';
            document.getElementById(maxPriceId).value = '';
            document.getElementById(cityId).value = '';
            document.getElementById(stateId).value = '';
            document.getElementById(sectorId).value = '';
            document.getElementById(propertyTypeId).selectedIndex = 0;

            // Reset the typeIdsArray based on whether it is modal or desktop
            if (isModal) {
                typeIdsArrayModal = [];
            } else {
                typeIdsArray = [];
            }

            // Trigger a new search with reset parameters
            searchProperties(1, isModal);
        }
        document.getElementById('searchFormDesktop').addEventListener('submit', function(event) {
            event.preventDefault();
            searchProperties(1, false);
        });

        document.getElementById('searchFormModal').addEventListener('submit', function(event) {
            event.preventDefault();
            searchProperties(1, true);
        });

        document.addEventListener('DOMContentLoaded', function() {
            searchProperties(1, false);
        });
    </script>
@endsection
