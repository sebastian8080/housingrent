<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear roles
        $adminRole = Role::create(['name' => 'Admin', 'description' => 'Usuario con acceso total al sistema.']);
        $asesorRole = Role::create(['name' => 'Asesor', 'description' => 'Usuario con acceso extendido, incluyendo control de propiedades.']);
        $userRole = Role::create(['name' => 'User', 'description' => 'Usuario con acceso a funcionalidades específicas.']);
        
        
        // Definir permisos
        $perms = [
            ['name' => 'edit-profile', 'slug' => 'edit-profile', 'description' => 'Editar perfil'],
            ['name' => 'change-password', 'slug' => 'change-password', 'description' => 'Cambiar contraseña'],
            ['name' => 'view-properties', 'slug' => 'view-properties', 'description' => 'Ver propiedades'],
            ['name' => 'create-property', 'slug' => 'create-property', 'description' => 'Crear propiedad'],
            ['name' => 'manage-properties', 'slug' => 'manage-properties', 'description' => 'Gestionar todas las propiedades'],
            ['name' => 'manage-users', 'slug' => 'manage-users', 'description' => 'Gestionar usuarios'],
            ['name' => 'manage-permissions', 'slug' => 'manage-permissions', 'description' => 'Gestionar permisos'],
        ];

        // Crear permisos y asignar a roles
        foreach ($perms as $perm) {
            $permission = Permission::create($perm);
            
            if (in_array($perm['slug'], ['manage-users', 'manage-permissions', 'manage-properties'])) {
                $adminRole->permissions()->attach($permission);
            }

            if ($perm['slug'] == 'manage-properties') {
                $asesorRole->permissions()->attach($permission);
            }

            if (in_array($perm['slug'], ['edit-profile', 'change-password', 'view-properties', 'create-property'])) {
                $adminRole->permissions()->attach($permission);
                $userRole->permissions()->attach($permission);
                $asesorRole->permissions()->attach($permission);
            }
        }
    }
}
