<?php

namespace App\Http\Controllers;

use App\Models\Models\Listing;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function home(){

        $properties = Listing::select('id', 'product_code', 'listing_title', 'listing_description', 'bedroom', 'bathroom', 'garage', 'property_price', 'lat', 'lng', 'images')->where('property_by', 'Housing')->get();

        return view('web.home', compact('properties'));
    }

}
