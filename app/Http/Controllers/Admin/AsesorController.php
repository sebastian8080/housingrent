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
    public function list_properties(Request $request) {
        // Iniciar la consulta
        $query = Domain::query();
    
        // Verificar si el término de búsqueda está presente
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%$search%")
                  ->orWhere('code', 'LIKE', "%$search%")
                  ->orWhereHas('user', function($qr) use ($search) {
                      $qr->where('name', 'LIKE', "%$search%")
                        ->orWhere('email', 'LIKE', "%$search%");
                  });
            });
        }
    

        $properties = $query->with(['multimedia','user'])->paginate(20);
    
        return view('admin.userAsesor.control_properties', compact('properties'));
    }
}
