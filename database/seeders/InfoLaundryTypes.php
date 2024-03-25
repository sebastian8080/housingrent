<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\laundry_types;

class InfoLaundryTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = array("No", "Lavanderia Dentro de la Propiedad", "Lavanderia Dentro del Edificio", "Lavanderia Disponible");
        foreach ($array as $i => $value) {
           $type = laundry_types::firstOrCreate(['name' => $value] );
        }
        
    }
}
