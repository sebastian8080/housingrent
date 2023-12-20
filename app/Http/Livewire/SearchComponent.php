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
        
        $properties = $properties_filter->get();

        return view('livewire.search-component', [
            'properties' => $properties
        ]);
    }
}
