<?php

namespace App\Http\Controllers;

use App\Models\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function home(){

        $properties = Listing::select('id', 'product_code', 'listing_title', 'listing_description', 'bedroom', 'bathroom', 'garage', 'state', 'city', 'sector', 'property_price', 'lat', 'lng', 'images', 'slug')->where('property_by', 'Housing')->where('status', 1)->take(4)->latest()->get();

        return view('web.home', compact('properties'));
    }

    public function show($slug){

        $listing = DB::connection('mysql_grupo_housing')->table('listings')->where('slug', $slug)->first();

        return view('web.show-property', compact('listing'));

    }

    public function uploadpage(){
        return view('web.upload-property');
    }

    public function contact(){
        return view('web.contact-page');
    } 

    public function sendlead(Request $request){

        $message = "<br><strong>Nuevo Lead Housing</strong>
                    <br> Nombre: ". strip_tags($request->name). " " . strip_tags($request->lastname) ."
                    <br> Telef: ".  strip_tags($request->phone)."
                    <br> Email: ".  strip_tags($request->email);

        if($request->interest) $message .= "<br> Interes: ".strip_tags($request->interest);

        $message .= "<br> Mensaje: ".strip_tags($request->message)."
                    <br> Fuente: Website";
                
        $header='';
        $header .= 'From: <leads@housingrentgroup.com>' . "\r\n";
        $header .= "Reply-To: ".'info@housingrentgroup.com'."\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        mail('info@housingrentgroup.com','Lead Housing Rent: '.strip_tags($request->name), $message, $header);
        mail('sebas31051999@gmail.com', 'Lead Housing Rent: ' . strip_tags($request->name), $message, $header);

        return redirect()->route('web.thank');
    }

}
