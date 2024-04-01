<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\info_state;
use App\Models\info_city;
use App\Models\info_parishes;
use App\Models\Domain;
use App\Models\Benefit;
use App\Models\Multimedia;
use App\Models\laundry_types;
use App\Models\Type_Benefit;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class AsesorController extends Controller
{
    public function list_properties() {
        // Obtener las propiedades del usuario actual y luego cargar la relación 'multimedia'
        $properties = Domain::All()->load('multimedia');
        
        return view('admin.userAsesor.control_properties', compact('properties'));
    }
}
