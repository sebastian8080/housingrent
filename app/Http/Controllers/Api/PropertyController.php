<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PropertyController extends Controller
{
    public function getAllProperties(){
        
        $properties = Http::withHeaders([
                    'api-key' => 'Cc2022*@Notify'
                    ])->get("http://localhost/acasaweb-master/public/api/list-properties");
            
        return $properties;
    
    }

    public function storeProperty(Request $request){

        return $request;

    }

    public function test(){
        return 'test';
    }

}
