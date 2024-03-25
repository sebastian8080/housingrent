<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'Admin', 'description' => 'Usuario con acceso total al sistema.'],
            ['name' => 'User', 'description' => 'Usuario con acceso a funcionalidades específicas.'],
            // Agrega aquí más roles según sea necesario.
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
