<?php

namespace App\Http\Livewire;

use App\Models\Models\Listing;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SearchComponent extends Component
{

    public $types = [];
    public $zones = [];
    public $bedrooms = 0, $bathrooms = 0, $garage = 0;
    public $min_price = 0, $max_price = 0;
    public $city = "";

    public $citySearch = "";
    public $currentTab = "";
    public $showTab2 = false;

    public $checkCity = "";
    public $arrayCities = [];
    public $cityTagName = "";

    public function updated(){
        // if($this->checkCity){
        //     $this->cityTagName = DB::table('info_cities')->where('id', $this->checkCity)->first();
        //     $this->cityTagName = $this->cityTagName->name;
        // }
    }

    public function cleanCity(){
        $this->city = "";
        $this->cityTagName = "";
        $this->citySearch = "";
    }

    public function render()
    {

        $properties_filter = Listing::select('id', 'product_code', 'listing_title', 'listing_description', 'bedroom', 'bathroom', 'garage', 'property_price', 'state', 'city', 'sector', 'images', 'property_by', 'slug')->where('property_by', 'Housing')->where('status', 1)->orderBy('product_code', 'desc');

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

        if($this->bedrooms) $properties_filter->where('bedroom', $this->bedrooms);
        if($this->bathrooms) $properties_filter->where('bathroom', $this->bathrooms);
        if($this->garage) $properties_filter->where('garage', $this->garage);

        if ($this->min_price && $this->max_price) {
            $properties_filter->whereBetween('property_price', [$this->min_price, $this->max_price]);
        }

        if($this->city){
            $cityaux = DB::table('info_cities')->where('id', $this->city)->first();
            $this->cityTagName = $cityaux->name;
            $properties_filter->where('city', 'LIKE', "%".$cityaux->name."%");
        }
        
        $properties = $properties_filter->get();

        $cities = [];
        if($this->citySearch){
            $cities = DB::table('info_cities')->where('name', 'LIKE', '%'.$this->citySearch.'%')->orderBy('id', 'desc')->take(5)->get();
        }

        $this->currentTab == "tab2" ? $this->showTab2 = true : $this->showTab2 = false;

        return view('livewire.search-component', [
            'properties' => $properties,
            'cities' => $cities,
            'showTab2' => $this->showTab2,
            'cityTagName' => $this->cityTagName
        ]);
    }
}
