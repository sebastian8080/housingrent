<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            BenefitType::class,
            InfoListingType::class,
            InfoLaundryTypes::class,
            InfoListingType::class,
            RoleSeeder::class,
            // Agrega aquí cualquier otro seeder que necesites ejecutar
        ]);
    }
}
