<?php

namespace App\Http\Controllers;

use App\Models\Models\Listing;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function home(){

        $properties = Listing::select('id', 'product_code', 'listing_title', 'listing_description', 'bedroom', 'bathroom', 'garage', 'state', 'city', 'sector', 'property_price', 'lat', 'lng', 'images', 'slug')->where('property_by', 'Housing')->where('status', 1)->get();

        return view('web.home', compact('properties'));
    }

    public function show($slug){

        $listing = Listing::where('slug', $slug)->first();

        return view('web.show-property', compact('listing'));

    }

    public function sendlead(Request $request){

        $message = "<br><strong>Nuevo Lead Housing</strong>
                    <br> Nombre: ". strip_tags($request->name). "" . strip_tags($request->lastname) ."
                    <br> Telef: ".  strip_tags($request->phone)."
                    <br> Email: ".  strip_tags($request->email)."
                    <br> Interes: ".strip_tags($request->interest)."
                    <br> Mensaje: ".strip_tags($request->message)."
                    <br> Fuente: Website";
                
        $header='';
        $header .= 'From: <leads@housingrentgroup.com>' . "\r\n";
        $header .= "Reply-To: ".'info@housingrentgroup.com'."\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        //mail('info@casacredito.com','Lead Housing Rent: '.strip_tags($req->leadName), $message, $header);
        mail('sebas31051999@gmail.com', 'Lead Housing Rent: ' . strip_tags($request->name), $message, $header);

    }

}
