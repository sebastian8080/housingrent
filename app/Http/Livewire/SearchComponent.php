<?php

namespace App\Http\Livewire;

use App\Models\Models\Listing;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SearchComponent extends Component
{

    public $properties = [];

    public $type, $searchtxt;

    public $types = [];
    public $zones = [];
    public $bedrooms = 0, $bathrooms = 0, $garage = 0;
    public $min_price = 0, $max_price = 0, $rangePrice = 0;
    public $city = "";

    public $citySearch = "";
    public $currentTab = "";
    public $showTab2 = false;

    public $checkCity = "";
    public $arrayCities = [];
    public $cityTagName = "";

    public $minRangePrice;
    public $maxRangePrice;

    public function hydrate(){
        // if($this->checkCity){
        //     $this->cityTagName = DB::table('info_cities')->where('id', $this->checkCity)->first();
        //     $this->cityTagName = $this->cityTagName->name;
        // }
        $this->properties = [];
        $this->type = null;
        $this->searchtxt = null;
    }

    public function cleanCity(){
        $this->city = "";
        $this->cityTagName = "";
        $this->citySearch = "";
    }

    public function mount($type, $searchtxt){

        $this->type = $type;

        $this->searchtxt = $searchtxt;

        $this->minRangePrice = DB::connection('mysql_grupo_housing')->table('listings')->select('property_price')->where('available', 1)->where('listingtypestatus', 'alquilar')->min('property_price');

        $this->maxRangePrice = DB::connection('mysql_grupo_housing')->table('listings')->select('property_price')->where('available', 1)->where('listingtypestatus', 'alquilar')->max('property_price');
    
    }

    public function searchProperties(){

            $properties_filter = DB::connection('mysql_grupo_housing')->table('listings')->select('id', 'product_code', 'listing_title', 'listing_description', 'listingtype', 'listingtypestatus', 'bedroom', 'bathroom', 'garage', 'property_price', 'state', 'city', 'sector', 'images', 'slug')->where('available', 1)->where('listingtypestatus', 'alquilar')->orderBy('product_code', 'desc');

            if($this->searchtxt != null || $this->searchtxt != ""){
                $properties_filter->where('city', 'LIKE', "%".$this->searchtxt."%");
            }
            
            if(count($this->types)>0){
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
    
            if($this->bedrooms) $properties_filter->where('bedroom', '>=', $this->bedrooms);
            if($this->bathrooms) $properties_filter->where('bathroom', '>=', $this->bathrooms);
            if($this->garage) $properties_filter->where('garage', '>=', $this->garage);
    
            if ($this->min_price && $this->max_price) {
                $properties_filter->whereBetween('property_price', [$this->min_price, $this->max_price]);
            }
    
            if($this->rangePrice){
                $properties_filter->whereBetween('property_price', [$this->rangePrice, $this->maxRangePrice]);
            }
    
            if($this->city){
                $cityaux = DB::connection('mysql_grupo_housing')->table('info_cities')->where('id', $this->city)->first();
                $this->cityTagName = $cityaux->name;
                $properties_filter->where('city', 'LIKE', $cityaux->name."%");
            }

            //consultando variables que vienen por el constructor
            if($this->type){
                $properties_filter->where('listingtype', $this->type);
            }

            //dd($properties_filter);
    
            $this->properties = $properties_filter->get();
    }

    public function render()
    {

        $this->searchProperties();
        // $properties_filter = Property::select('id', 'product_code', 'listing_title', 'listing_description', 'bedroom', 'bathroom', 'garage', 'property_price', 'state', 'city', 'sector', 'images', 'property_by', 'slug')->where('property_by', 'Housing')->where('status', 1)->orderBy('product_code', 'desc');

        $cities = [];
        if($this->citySearch){
            $cities = DB::connection('mysql_grupo_housing')->table('info_cities')->where('name', 'LIKE', '%'.$this->citySearch.'%')->orderBy('id', 'desc')->take(5)->get();
        }

        $this->currentTab == "tab2" ? $this->showTab2 = true : $this->showTab2 = false;

        return view('livewire.search-component', [
            'properties' => $this->properties,
            'cities' => $cities,
            'showTab2' => $this->showTab2,
            'cityTagName' => $this->cityTagName,
            'minRangePrice' => $this->minRangePrice,
            'maxRangePrice' => $this->maxRangePrice
        ]);
    }
}
