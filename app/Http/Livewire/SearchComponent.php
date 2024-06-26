<?php

namespace App\Http\Livewire;

use App\Models\Domain;
use App\Models\Models\Listing;
use App\Models\Property;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SearchComponent extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $properties = [];
    protected $properties_domain = [];

    //variables que vienen desde el buscador de la home
    public $type, $searchtxt;

    public $types = [];
    public $zones = [];
    public $bedrooms = 0, $bathrooms = 0, $garage = 0;
    public $min_price = 0, $max_price = 0, $rangePrice = 0;
    public $city = "";
    public $product_code;

    public $ismobile = false;

    public $citySearch = "";
    public $currentTab = "";
    public $showTab2 = false;

    public $checkCity = "";
    public $arrayCities = [];
    public $cityTagName = "";

    //public $minRangePrice;
    public $maxRangePrice;
    public $maxRangePriceHousingRent;

    public $minPrice, $maxPrice;

    public function hydrate(){
        // if($this->checkCity){
        //     $this->cityTagName = DB::table('info_cities')->where('id', $this->checkCity)->first();
        //     $this->cityTagName = $this->cityTagName->name;
        // }
        $this->properties = [];
        // $this->type = null;
        // $this->searchtxt = null;
    }

    public function cleanCity(){
        $this->city = "";
        $this->cityTagName = "";
        $this->citySearch = "";
    }

    public function mount($type, $searchtxt){

        $this->ismobile = $this->detectMobile();

        $this->type = $type;

        $this->citySearch = $searchtxt;

        $this->maxRangePrice = DB::connection('mysql_grupo_housing')->table('listings')->select('property_price')->where('available', 1)->where('listingtypestatus', 'alquilar')->max('property_price');
        $this->maxRangePriceHousingRent = Domain::select('max_price')->where('is_active', 1)->max('max_price');
    }

    public function detectMobile(){
        $user_agent = $_SERVER["HTTP_USER_AGENT"];

        if(preg_match("/(android|webos|avantgo|iphone|ipod|ipad|bolt|boost|cricket|docomo|fone|hiptop|opera mini|mini|kitkat|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i",$user_agent ))
        {
            return true;
        }
        else{
            return false;
        }
    }

    public function searchProperties(){

            $properties_filter = DB::connection('mysql_grupo_housing')->table('listings')->select('id', 'product_code', 'listing_title', 'listing_description', 'listingtype', 'listingtypestatus', 'bedroom', 'bathroom', 'garage', 'construction_area', 'property_price', 'state', 'city', 'sector', 'images', 'slug', 'available', 'status')->where('available', 1)->where('status', 1)->where('listingtypestatus', 'alquilar')->orderBy('product_code', 'desc');
            $properties_filter_domain = Domain::with('multimedia')->select('id', 'code as product_code', 'title as listing_title', 'description as listing_description', 'bedroom', 'bathroom', 'garage', 'construction_area', 'max_price as property_price', 'state_province as state', 'city', 'sector', 'slug', 'is_active as status')->where('is_active', 1)->orderBy('product_code', 'desc');

            if($this->product_code){
                $properties_filter->where('product_code', 'LIKE', '%'.$this->product_code.'%');
                $properties_filter_domain->where('code', 'LIKE', '%'.$this->product_code.'%');
            }
            
            if(count($this->types)>0){
                $this->type = null;
                if(count($this->types) === 1){
                    $properties_filter->where('listingtype', $this->types[0]);
                } else if(count($this->types) === 2){
                    $properties_filter->where(function ($query) {
                        $query->where('listingtype','=',$this->types[0])
                            ->orWhere('listingtype','=',$this->types[1]);
                    });
                } else if(count($this->types) === 3){
                    $properties_filter->where(function ($query) {
                        $query->where('listingtype','=',$this->types[0])
                            ->orWhere('listingtype','=',$this->types[1])
                            ->orWhere('listingtype','=',$this->types[2]);
                    });
                }
            };
    
            if(count($this->zones)>0){
                if(count($this->zones) === 1){
                    $properties_filter->where('zone', $this->zones[0]);
                } else if(count($this->zones) === 2){
                    $properties_filter->where(function ($query) {
                        $query->where('zone','=',$this->zones[0])
                            ->orWhere('zone','=',$this->zones[1]);
                    });
                } else if(count($this->zones) === 3){
                    $properties_filter->where(function ($query) {
                        $query->where('zone','=',$this->zones[0])
                            ->orWhere('zone','=',$this->zones[1])
                            ->orWhere('zone','=',$this->zones[2]);
                    });
                }
            };
    
            if($this->bedrooms){
                $properties_filter->where('bedroom', '>=', $this->bedrooms);
                $properties_filter_domain->where('bedroom', '>=', $this->bedrooms);
            }
            if($this->bathrooms){
                $properties_filter->where('bathroom', '>=', $this->bathrooms);
                $properties_filter_domain->where('bathroom', '>=', $this->bathrooms);
            }
            if($this->garage){
                $properties_filter->where('garage', '>=', $this->garage);
                $properties_filter_domain->where('garage', '>=', $this->garage);
            }
    
            if ($this->minPrice || $this->maxPrice) {

                if($this->minPrice == ""){
                    $properties_filter->whereBetween('property_price', [0 ,$this->maxPrice]);
                    $properties_filter_domain->whereBetween('max_price', [0 ,$this->maxPrice]);
                } 
                if($this->maxPrice == ""){
                    $properties_filter->whereBetween('property_price', [$this->minPrice, $this->maxRangePrice]);
                    $properties_filter_domain->whereBetween('max_price', [$this->minPrice, $this->maxRangePriceHousingRent]);
                }
                if($this->minPrice != "" && $this->maxPrice != ""){
                    $properties_filter->whereBetween('property_price', [$this->minPrice, $this->maxPrice]);
                    $properties_filter_domain->whereBetween('max_price', [$this->minPrice, $this->maxPrice]);
                }

            }
    
            if($this->city){
                $cityaux = DB::connection('mysql_grupo_housing')->table('info_cities')->where('id', $this->city)->first();
                $this->cityTagName = $cityaux->name;
                $properties_filter->where('city', 'LIKE', $cityaux->name."%");
            }

            //consultando variables que vienen por el constructor
            if($this->type != null && $this->type != "Propiedad"){
                $properties_filter->where('listingtype', $this->type);
                switch ($this->type) {
                    case '23': $type_housing = 1;break; //casas
                    case '24': $type_housing = 3;break; //departamentos
                    case '25': $type_housing = 5;break; //casas comerciales
                    case '32': $type_housing = 6;break; //locales comerciales
                    case '35': $type_housing = 7;break; //oficinas
                    default:
                        # code...
                        break;
                }
                $properties_filter_domain->where('type_property', $type_housing);
            }

            $location = $this->citySearch;

            if($location){
                if(preg_match('/^\d{4}$/', $location)){
                    $properties_filter->where('product_code', 'LIKE', '%'.$location.'%');
                    $properties_filter_domain->where('code', 'LIKE', '%'.$location.'%');
                } else {
                    // $properties_filter->where('address', 'LIKE', '%'.$location.'%')
                    //     ->orWhere('sector', 'LIKE', '%'.$location.'%')
                    //     ->orWhere('city', 'LIKE', '%'.$location.'%')
                    //     ->orWhere('state', 'LIKE', '%'.$location.'%')
                    //     ->orWhere('listing_title', 'LIKE', '%'.$location.'%');
                    $properties_filter->where(function ($query) use ($location) {
                        $query->where('listing_title', 'LIKE', '%'.$location.'%')
                            ->orWhere('address', 'LIKE', '%'.$location.'%')
                            ->orWhere('sector', 'LIKE', '%'.$location.'%')
                            ->orWhere('city', 'LIKE', '%'.$location.'%')
                            ->orWhere('state', 'LIKE', '%'.$location.'%');
                    });
                    $properties_filter_domain->where(function ($query) use ($location) {
                        $query->where('title', 'LIKE', '%'.$location.'%')
                            ->orWhere('address', 'LIKE', '%'.$location.'%')
                            ->orWhere('sector', $location)
                            ->orWhere('city', $location)
                            ->orWhere('state_province', $location);
                    });
                    //dd($properties_filter->get());
                }
            }

            $this->properties = $properties_filter->get();
            $this->properties_domain = $properties_filter_domain->get();

            $propiedades = $this->properties_domain->map(function ($propiedad) {
                // Accede a las imágenes de la propiedad
                $imagenes = $propiedad->multimedia;
                
                // Agrega el nuevo campo 'images' al array de la propiedad
                $propiedad->images = $imagenes;
                $propiedad->from = "HR";
                
                return $propiedad;
            });

            $properties_all = $this->properties->concat($propiedades);

            $resultadosPorPagina = 10;
            $paginaActual = LengthAwarePaginator::resolveCurrentPage();
            $itemsPaginados = $properties_all->slice(($paginaActual - 1) * $resultadosPorPagina, $resultadosPorPagina);
            $resultadosPaginados = new LengthAwarePaginator($itemsPaginados, $properties_all->count(), $resultadosPorPagina, $paginaActual);

            // Opcional: establecer la URL base para la paginación
            $resultadosPaginados->setPath(url()->current());

            $this->properties = $resultadosPaginados;
    }

    public function render()
    {

        $this->searchProperties();

        $this->currentTab == "tab2" ? $this->showTab2 = true : $this->showTab2 = false;

        return view('livewire.search-component', [
            'properties' => $this->properties,
            'showTab2' => $this->showTab2,
            'cityTagName' => $this->cityTagName,
        ]);
    }
}
