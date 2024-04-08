<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function search(Request $request){

        if($request->type == null && $request->searchtxt == null){
            return redirect()->route('get.all.properties');
        }

        if($request->type == null){
            $slug = 'propiedad';
        } else {
            $slug = Str::slug($request->type);
        }

        if($request->searchtxt != null){
            return redirect()->route('web.redirect.search', [strtolower($slug), strtolower($request->searchtxt)]);
        }
        else {
            return redirect()->route('web.redirect.search', [strtolower($slug)]);
        }

    }

    public function redirectBySearch($type = null, $searchtxt = null){

        if($type != null){
            $type = Str::title(str_replace('-', ' ', $type));
            $typeFromTable = DB::connection('mysql_grupo_housing')->table('listing_types')->where('type_title', 'LIKE', '%'.$type."%")->first();
            if($typeFromTable){
                $type = $typeFromTable->id;
            }
        }


        $properties_filter = DB::connection('mysql_grupo_housing')->table('listings')
        ->select('id', 'listing_title', 'listing_description', 'listingtype', 'listingtypestatus', 'bedroom', 'bathroom', 'garage', 'product_code', 'slug', 'state', 'city', 'sector', 'address', 'property_price', 'images')
        ->where('listingtypestatus', 'alquilar')
        ->where('available', 1);
        //->where('images', '!=', "");

        
        if($searchtxt != null){
            if(is_numeric($searchtxt)){
                $properties_filter->where('product_code', 'LIKE', '%'.$searchtxt.'%');
            } else {
                $properties_filter->where('address', 'LIKE', "%".$searchtxt."%");
                if(count($properties_filter->get())<1){
                    $properties_filter->orWhere('sector', 'LIKE', "%".$searchtxt."%");
                }
                if(count($properties_filter->get())<1){
                    $properties_filter->orWhere('city', 'LIKE', '%'.$searchtxt.'%');
                }
                if(count($properties_filter->get())<1){
                    $properties_filter->orWhere('state', 'LIKE', "%".$searchtxt."%");
                }
            }
        }

        if($type != null && $type != "Propiedad"){
            $properties_filter->where('listingtype', $type);
        }

        $properties = $properties_filter->get();

        // $properties = Property::select('id', 'listing_title', 'listing_description', 'bedroom', 'bathroom', 'garage', 'product_code', 'slug', 'state', 'city', 'sector', 'property_price', 'images')
        //                         ->where('listing_type', $type)
        //                         ->where('address', 'LIKE', $searchtxt."%")
        //                         ->orWhere('sector', 'LIKE', $searchtxt."%")
        //                         ->orWhere('city', 'LIKE', $searchtxt."%")
        //                         ->orWhere('state', 'LIKE', $searchtxt."%")
        //                         ->get();

        return view('web.list-properties', compact('type', 'searchtxt'));

    }

    public function getAllProperties(){
        
        return view('web.list-properties');

    }
}
