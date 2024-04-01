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

        $benefits = [
            ['name' => 'Agua', 'type_benefit_id' => $typeBenefitIds[0]],
            ['name' => 'Electricidad', 'type_benefit_id' => $typeBenefitIds[0]],
            ['name' => 'Internet', 'type_benefit_id' => $typeBenefitIds[0]],
            ['name' => 'Unidades Educativas', 'type_benefit_id' => $typeBenefitIds[1]],
            ['name' => 'Hospitales', 'type_benefit_id' => $typeBenefitIds[1]],
            ['name' => 'Se puede tener mascotas?', 'type_benefit_id' => $typeBenefitIds[2]],
            ['name' => 'Línea Telefónica', 'type_benefit_id' => $typeBenefitIds[0]],
            ['name' => 'Cable', 'type_benefit_id' => $typeBenefitIds[0]],
            ['name' => 'Aire Acondicionado', 'type_benefit_id' => $typeBenefitIds[0]],
            ['name' => 'Alarma', 'type_benefit_id' => $typeBenefitIds[0]],
            ['name' => 'Servicio de Vigilancia', 'type_benefit_id' => $typeBenefitIds[0]],
            ['name' => 'Alcantarillado', 'type_benefit_id' => $typeBenefitIds[0]],
            ['name' => 'Gas Centralizado', 'type_benefit_id' => $typeBenefitIds[0]],
            ['name' => 'Guardiania', 'type_benefit_id' => $typeBenefitIds[0]],
            ['name' => 'Parqueo Visitantes', 'type_benefit_id' => $typeBenefitIds[0]],
            ['name' => 'Calefón', 'type_benefit_id' => $typeBenefitIds[0]],
            ['name' => 'Áreas Verdes', 'type_benefit_id' => $typeBenefitIds[0]],
            ['name' => 'Canchas Deportivas', 'type_benefit_id' => $typeBenefitIds[0]],
            ['name' => 'Extractor de olores', 'type_benefit_id' => $typeBenefitIds[0]],
            ['name' => 'Cisterna', 'type_benefit_id' => $typeBenefitIds[0]],
            ['name' => 'Linea de Buses', 'type_benefit_id' => $typeBenefitIds[1]],
            ['name' => 'Parada de Taxis', 'type_benefit_id' => $typeBenefitIds[1]],
            ['name' => 'Gasolineras', 'type_benefit_id' => $typeBenefitIds[1]],
            ['name' => 'Universidades', 'type_benefit_id' => $typeBenefitIds[1]],
            ['name' => 'Supermercados', 'type_benefit_id' => $typeBenefitIds[1]],
            ['name' => 'Policia', 'type_benefit_id' => $typeBenefitIds[1]],
            ['name' => 'Entidades Financieras', 'type_benefit_id' => $typeBenefitIds[1]],
            ['name' => 'Centros Comerciales', 'type_benefit_id' => $typeBenefitIds[1]],
            ['name' => 'Parqueo', 'type_benefit_id' => $typeBenefitIds[1]],
            ['name' => 'Parques Infantiles', 'type_benefit_id' => $typeBenefitIds[1]],
            ['name' => 'Farmacias', 'type_benefit_id' => $typeBenefitIds[1]],
            ['name' => 'Restaurante', 'type_benefit_id' => $typeBenefitIds[1]],
            ['name' => 'Hosteria', 'type_benefit_id' => $typeBenefitIds[1]],
            ['name' => 'Gimnasio', 'type_benefit_id' => $typeBenefitIds[1]],
            ['name' => 'Peluqueria', 'type_benefit_id' => $typeBenefitIds[1]],
            ['name' => 'Iglesia', 'type_benefit_id' => $typeBenefitIds[1]],
            ['name' => 'Piscina Comunitaria', 'type_benefit_id' => $typeBenefitIds[1]],
            ['name' => 'Salón de Eventos', 'type_benefit_id' => $typeBenefitIds[1]],
            ['name' => 'Tranvia', 'type_benefit_id' => $typeBenefitIds[1]],
            ['name' => 'Mini Mercado', 'type_benefit_id' => $typeBenefitIds[1]],
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