<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function create(){
        $listing_types = DB::table('listing_type')->get();
        $states = DB::table('info_states')->get();
        return view('admin.create', compact('listing_types', 'states'));
    }

    public function getcities($state_id){

        $cities = DB::table('info_cities')->where('state_id', $state_id)->get();

        return response()->json($cities);

    }
}
