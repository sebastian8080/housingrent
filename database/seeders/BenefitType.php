<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class BenefitType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        // Define los beneficios que quieres agregar
        $benefits = [
            'Agua',
            'Luz',
            'Internet',
            // ... agrega más beneficios según sea necesario
        ];

        // Limpiar la tabla de beneficios antes de sembrar para evitar duplicados
        // si corres el seeder múltiples veces.
        // ATENCIÓN: Esto eliminará todos los datos existentes en la tabla `benefits`!
        DB::table('type_benefits')->truncate();
        DB::table('benefits')->truncate();

        // Definir tipos de beneficios
        $typeBenefits = [
            'Servicios básicos',
            'Beneficios adicionales',
            'Permisos',
        ];

        // Insertar tipos de beneficios y guardar sus IDs
        $typeBenefitIds = [];
        foreach ($typeBenefits as $typeBenefit) {
            $typeBenefitIds[] = DB::table('type_benefits')->insertGetId([
                'name' => $typeBenefit,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Definir beneficios para cada tipo
        $benefits = [
            ['name' => 'Agua', 'type_benefit_id' => $typeBenefitIds[0]],
            ['name' => 'Electricidad', 'type_benefit_id' => $typeBenefitIds[0]],
            ['name' => 'Internet', 'type_benefit_id' => $typeBenefitIds[0]],
            ['name' => 'Unidad Educativa', 'type_benefit_id' => $typeBenefitIds[1]],
            ['name' => 'Hospitales', 'type_benefit_id' => $typeBenefitIds[1]],
            ['name' => 'Se puede tener mascotas?', 'type_benefit_id' => $typeBenefitIds[2]],
        ];

        // Insertar beneficios asociados a sus tipos
        foreach ($benefits as $benefit) {
            DB::table('benefits')->insert([
                'name' => $benefit['name'],
                'type_benefit_id' => $benefit['type_benefit_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}