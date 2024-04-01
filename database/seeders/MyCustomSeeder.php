<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MyCustomSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
            InfoTablesSeeder::class,
            RoleSeeder::class,
            AdminUserSeeder::class,
            // Agrega aquí cualquier otro seeder que necesites ejecutar.
        ]);
    }
}
