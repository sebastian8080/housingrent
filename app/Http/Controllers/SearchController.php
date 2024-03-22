<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function search(Request $request){

        $slug = Str::slug($request->type);

        if($request->searchtxt != null){
            return redirect()->route('web.redirect.search', [strtolower($slug), strtolower($request->searchtxt)]);
        }
        else {
            return redirect()->route('web.redirect.search', [strtolower($slug)]);
        }

    }

    public function redirectBySearch($type, $searchtxt = null){
        
        $properties = Property::select('id', 'listing_title', 'listing_description', 'bedroom', 'bathroom', 'garage', 'product_code', 'slug', 'state', 'city', 'sector', 'property_price', 'images')
                                ->where('listing_type', $type)
                                ->where('address', 'LIKE', $searchtxt."%")
                                ->orWhere('sector', 'LIKE', $searchtxt."%")
                                ->orWhere('city', 'LIKE', $searchtxt."%")
                                ->orWhere('state', 'LIKE', $searchtxt."%")
                                ->get();

        return view('web.list-properties', compact('properties'));

    }
}
