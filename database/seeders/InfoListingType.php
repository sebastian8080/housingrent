<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\listing_type;

class InfoListingType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = array("Casa", "Casa Adosada", "Departamento o Piso", "Solo Habitación");
        foreach ($array as $i => $value) {
           $type = listing_type::firstOrCreate(['name' => $value] );
        }
        
        
    }
}
