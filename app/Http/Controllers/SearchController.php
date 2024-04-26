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
            return redirect()->route('web.redirect.search', [strtolower($slug), Str::slug(strtolower($request->searchtxt))]);
        }
        else {
            return redirect()->route('web.redirect.search', [strtolower($slug)]);
        }

    }

    public function redirectBySearch($type = null, $searchtxt = null){

        if($type != null){
            $type = Str::title(str_replace('-', ' ', $type));
            $typeFromTable = DB::connection('mysql_grupo_housing')->table('listing_types')->where('type_title', 'LIKE', '%'.$type."%")->first();
            $typeFromTable ? $type = $typeFromTable->id : null;
        }

        if($searchtxt != null){
            $searchtxt = Str::title(str_replace('-', ' ', $searchtxt));
            $searchtxt = strtolower($searchtxt);
        }


        return view('web.list-properties', compact('type', 'searchtxt'));

    }

    public function getAllProperties(){
        
        return view('web.list-properties');

    }
}
