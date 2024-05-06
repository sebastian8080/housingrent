<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\info_city;
use App\Models\info_parishes;
use App\Models\info_state;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class PropertyController extends Controller
{

    /*public function search2(Request $request)
    {
        $searchTerm = $request->input('search_term', '');
        $productCode = $request->input('product_code');
        $bedrooms = $request->input('bedrooms');
        $bathrooms = $request->input('bathrooms');
        $garage = $request->input('garage');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);
        $type = $request->input('type');
        $city = $request->input('city');
        $state = $request->input('state');
        $sector = $request->input('sector');




        $housingTypeMapping = [
            'Casas' => 23, 'Departamentos' => 24, 'Casas Comerciales' => 25,
            'Terrenos' => 25, 'Locales Comerciales' => 32, 'Oficinas' => 35, 'Suites' => 36,
        ];
        $domainTypeMapping = [
            'Casas' => 1, 'Departamentos' => 2, 'Departamento o Piso' => 3, 'Solo Habitación' => 4,
            'Casa Comercial' => 5, 'Local Comerciales' => 6, 'Oficinas' => 7, 'Suites' => 8,
        ];



        $properties_filter = DB::connection('mysql_grupo_housing')->table('listings')->select('id', 'product_code', 'listing_title', 'listing_description', 'listingtype', 'listingtypestatus', 'bedroom', 'bathroom', 'garage', 'construction_area', 'property_price', 'state', 'city', 'sector', 'images', 'slug', 'available', 'status')->where('available', 1)->where('status', 1)->where('listingtypestatus', 'alquilar')->orderBy('product_code', 'desc');
        $properties_filter_domain = Domain::with('multimedia')->select('id', 'code as product_code', 'title as listing_title', 'description as listing_description', 'bedroom', 'bathroom', 'garage', 'construction_area', 'max_price as property_price', 'state_province as state', 'city', 'sector', 'slug', 'is_active as status')->where('is_active', 1)->orderBy('product_code', 'desc');

        if (!empty($productCode)) {
            $properties_filter->where('product_code', 'LIKE', "%{$productCode}%");
            $properties_filter_domain->where('code', 'LIKE', "%{$productCode}%");
        }

        if ($bedrooms) {
            $properties_filter->where('bedroom', '>=', $bedrooms);
            $properties_filter_domain->where('bedroom', '>=', $bedrooms);
        }

        if ($bathrooms) {
            $properties_filter->where('bathroom', '>=', $bathrooms);
            $properties_filter_domain->where('bathroom', '>=', $bathrooms);
        }

        if ($garage) {
            $properties_filter->where('garage', '>=', $garage);
            $properties_filter_domain->where('garage', '>=', $garage);
        }

        if ($minPrice) {
            $properties_filter->where('property_price', '>=', $minPrice);
            $properties_filter_domain->where('max_price', '>=', $minPrice);
        }

        if ($maxPrice) {
            $properties_filter->where('property_price', '<=', $maxPrice);
            $properties_filter_domain->where('max_price', '<=', $maxPrice);
        }

        if (!empty($type)) {
            if (isset($housingTypeMapping[$type])) {
                $properties_filter->where('listingtype', $housingTypeMapping[$type]);
            }
            if (isset($domainTypeMapping[$type])) {
                $properties_filter_domain->where('type_property', $domainTypeMapping[$type]);
            }
        }
        if ($searchTerm) {
            $housingTypeIds = array_filter($housingTypeMapping, function ($key) use ($searchTerm) {
                return stripos($key, $searchTerm) !== false;
            }, ARRAY_FILTER_USE_KEY);

            $domainTypeIds = array_filter($domainTypeMapping, function ($key) use ($searchTerm) {
                return stripos($key, $searchTerm) !== false;
            }, ARRAY_FILTER_USE_KEY);

            $properties_filter->where(function ($query) use ($searchTerm, $housingTypeIds) {
                $query->where('listing_title', 'like', "%{$searchTerm}%")
                    ->orWhere('listing_description', 'like', "%{$searchTerm}%")
                    ->orWhere('city', 'like', "%{$searchTerm}%")
                    ->orWhere('state', 'like', "%{$searchTerm}%");
                if (!empty($housingTypeIds)) {
                    $query->orWhereIn('listingtype', array_values($housingTypeIds));
                }
            });

            $properties_filter_domain->where(function ($query) use ($searchTerm, $domainTypeIds) {
                $query->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%")
                    ->orWhere('city', 'like', "%{$searchTerm}%")
                    ->orWhere('state_province', 'like', "%{$searchTerm}%");
                if (!empty($domainTypeIds)) {
                    $query->orWhereIn('type_property', array_values($domainTypeIds));
                }
            });
        }

        $properties = $properties_filter->get();
        $properties_domain = $properties_filter_domain->get();
        $combinedProperties = $properties->concat($properties_domain);

        $paginatedResults = new LengthAwarePaginator(
            $combinedProperties->forPage($page, $perPage)->all(),
            $combinedProperties->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return response()->json($paginatedResults);
    }*/

    public function view($type, $details = null)
    {
        $typeIds = [
            'CASAS' => [23, 1],
            'DEPARTAMENTOS' => [24, 3],
            'CASAS COMERCIALES' => [25, 5],
            'LOCALES COMERCIALES' => [32, 6],
            'OFICINAS' => [35, 7],
            'SUITES' => [36, 8],
            'QUINTAS' => [29, 9],
            'HACIENDAS' => [30, 30]
        ];

        $type = strtoupper(str_replace('-', ' ', $type));
        $typeId = isset($typeIds[$type]) ? $typeIds[$type] : null;

        // Normalizar la cadena de detalles eliminando los prefijos y dividiendo los elementos correctamente
        $details = strtolower($details);
        $details = str_replace('-en-', '-o-', $details);  // Reemplazar '-en-' por '-o-' para unificar el split
        $elements = explode('-o-', $details);
        array_shift($elements); // Remover el primer elemento vacío si existe

        $uppercaseElements = array_map('strtoupper', $elements);

        // Obtener posibles coincidencias para estados, ciudades y parroquias
        $states = info_state::whereIn('name', $uppercaseElements)->get()->keyBy('name');
        $cities = info_city::whereIn('name', $uppercaseElements)->get()->keyBy('name');
        $parishes = info_parishes::whereIn('name', $uppercaseElements)->get()->keyBy('name');

        $state = $city = $parish = null;

        foreach ($uppercaseElements as $element) {
            if (isset($states[$element])) {
                $state = $states[$element]->name;
            } elseif (isset($cities[$element])) {
                $city = $cities[$element]->name;
            } elseif (isset($parishes[$element])) {
                $parish = $parishes[$element]->name;
            }
        }

        return view('web.list-properties2', compact('type', 'typeId', 'state', 'city', 'parish'));
    }

    public function search(Request $request)
    {
        // Recolección de parámetros
        $searchTerm = $request->input('searchTerm', '');
        $productCode = $request->input('product_code');
        $bedrooms = $request->input('bedrooms');
        $bathrooms = $request->input('bathrooms');
        $garage = $request->input('garage');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $typeIds = $request->input('type_ids', []);
        $city = $request->input('city');
        $state = $request->input('state');
        $sector = $request->input('sector');
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);

        $searchWords = explode(' ', $searchTerm);

        $properties_filter = DB::connection('mysql_grupo_housing')->table('listings')
            ->join('listing_types', 'listings.listingtype', '=', 'listing_types.id')
            ->select(
                'listings.id as id',
                'listings.product_code',
                'listings.listing_title',
                'listings.listing_description',
                'listings.listingtype',
                'listings.listingtypestatus',
                'listings.bedroom',
                'listings.bathroom',
                'listings.garage',
                'listings.construction_area',
                'listings.property_price',
                'listings.state',
                'listings.city',
                'listings.sector',
                'listings.images',
                'listings.slug',
                'listings.available',
                'listings.status',
                'listing_types.type_title as type_name',
                'listings.aliquot'
            )
            ->where('listings.available', 1)
            ->where('listings.status', 1)
            ->where('listings.listingtypestatus', 'alquilar')
            ->orderBy('listings.product_code', 'desc');

        $properties_filter_domain = Domain::with('multimedia')
            ->join('listing_type', 'domains.type_property', '=', 'listing_type.id')
            ->select(
                'domains.id as id',
                'domains.code as product_code',
                'domains.title as listing_title',
                'domains.description as listing_description',
                'domains.bedroom',
                'domains.bathroom',
                'domains.garage',
                'domains.construction_area',
                'domains.max_price as property_price',
                'domains.state_province as state',
                'domains.city',
                'domains.sector',
                'domains.slug',
                'domains.is_active as status',
                'listing_type.name as type_name'
            )
            ->where('domains.is_active', 1)
            ->orderBy('domains.code', 'desc');


        // Aplicación de filtros básicos
        if (!empty($productCode)) {
            $properties_filter->where('product_code', 'LIKE', "%{$productCode}%");
            $properties_filter_domain->where('code', 'LIKE', "%{$productCode}%");
        }

        // Filtros por detalles específicos de la propiedad
        if (!empty($productCode)) {
            $properties_filter->where('product_code', 'LIKE', "%{$productCode}%");
            $properties_filter_domain->where('code', 'LIKE', "%{$productCode}%");
        }

        if ($bedrooms) {
            $properties_filter->where('bedroom', '>=', $bedrooms);
            $properties_filter_domain->where('bedroom', '>=', $bedrooms);
        }

        if ($bathrooms) {
            $properties_filter->where('bathroom', '>=', $bathrooms);
            $properties_filter_domain->where('bathroom', '>=', $bathrooms);
        }

        if ($garage) {
            $properties_filter->where('garage', '>=', $garage);
            $properties_filter_domain->where('garage', '>=', $garage);
        }

        if ($city) {
            $properties_filter->where('city', 'LIKE', "%{$city}%");
            $properties_filter_domain->where('city', 'LIKE', "%{$city}%");
        }

        if ($state) {
            $properties_filter->where('state', 'LIKE', "%{$state}%");
            $properties_filter_domain->where('state_province', 'LIKE', "%{$state}%");
        }

        if ($sector) {
            $properties_filter->where('sector', 'LIKE', "%{$sector}%");
            $properties_filter_domain->where('sector', 'LIKE', "%{$sector}%");
        }
        if (count($typeIds) >= 2) {
            $listingTypeId = $typeIds[0];
            $typePropertyId = $typeIds[1];

            if (!empty($listingTypeId)) {
                $properties_filter->where('listingtype', $listingTypeId);
            }

            if (!empty($typePropertyId)) {
                $properties_filter_domain->where('type_property', $typePropertyId);
            }
        }

        if ($minPrice || $maxPrice) {
            if ($minPrice) {
                $properties_filter->where('property_price', '>=', $minPrice);
                $properties_filter_domain->where('max_price', '>=', $minPrice);
            }
            if ($maxPrice) {
                $properties_filter->where('property_price', '<=', $maxPrice);
                $properties_filter_domain->where('max_price', '<=', $maxPrice);
            }

            // Aplicar el ordenamiento por precio solo si se está filtrando por precio
            $properties_filter->orderBy('property_price', 'asc');
            $properties_filter_domain->orderBy('max_price', 'asc');
        }


        foreach ($searchWords as $word) {
            $properties_filter->where(function ($query) use ($word) {
                $query->where('listing_title', 'LIKE', "%{$word}%")
                    ->orWhere('listing_description', 'LIKE', "%{$word}%")
                    ->orWhere('city', 'LIKE', "%{$word}%")
                    ->orWhere('state', 'LIKE', "%{$word}%")
                    ->orWhere('sector', 'LIKE', "%{$word}%")
                    ->orWhere('product_code', 'LIKE', "%{$word}%")
                    ->orWhere('type_title', 'LIKE', "%{$word}%");
            });

            $properties_filter_domain->where(function ($query) use ($word) {
                $query->where('title', 'LIKE', "%{$word}%")
                    ->orWhere('description', 'LIKE', "%{$word}%")
                    ->orWhere('city', 'LIKE', "%{$word}%")
                    ->orWhere('state_province', 'LIKE', "%{$word}%")
                    ->orWhere('sector', 'LIKE', "%{$word}%")
                    ->orWhere('code', 'LIKE', "%{$word}%")
                    ->orWhere('name', 'LIKE', "%{$word}%");
            });
        }

        $properties = $properties_filter->get();
        $properties_domain = $properties_filter_domain->get();
        $combinedProperties = $properties->merge($properties_domain);

        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1);

        // Calcular el índice de inicio
        $start = ($page - 1) * $perPage;

        // Obtener los datos para la página actual
        $currentPageData = $combinedProperties->slice($start, $perPage);

        // Crear una instancia de LengthAwarePaginator
        $paginatedResults = new LengthAwarePaginator(
            $currentPageData,
            $combinedProperties->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // Obtener solo los items de la página actual sin índices numéricos
        $itemsWithoutIndexes = collect($paginatedResults->items())->values();

        // Crear un array que contenga tanto los datos paginados como la información de paginación
        $responseData = [
            'properties' => $itemsWithoutIndexes,
            'pagination' => [
                'current_page' => $paginatedResults->currentPage(),
                'from' => $paginatedResults->firstItem(),
                'to' => $paginatedResults->lastItem(),
                'per_page' => $paginatedResults->perPage(),
                'total' => $paginatedResults->total(),
                'last_page' => $paginatedResults->lastPage(),
                'first_page_url' => $paginatedResults->url(1),
                'last_page_url' => $paginatedResults->url($paginatedResults->lastPage()),
                'next_page_url' => $paginatedResults->nextPageUrl(),
                'prev_page_url' => $paginatedResults->previousPageUrl(),
            ],
        ];

        return response()->json($responseData);
    }
}
