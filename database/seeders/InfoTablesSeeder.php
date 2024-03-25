<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\info_state;
use App\Models\info_city;
use App\Models\info_parishes;
use Illuminate\Support\Facades\Storage;

class InfoTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonPath = storage_path('app/public/provincias.json');
        
        if (!file_exists($jsonPath)) {
            dump('El archivo JSON no existe en la ruta especificada.');
            return;
        }

        $jsonContent = file_get_contents($jsonPath);
        $allData = json_decode($jsonContent, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            dump("Error en la decodificación del JSON: " . json_last_error_msg());
            return;
        }

        foreach ($allData as $key => $value) {
            $stateId = null;
            if (isset($value['provincia'])) {
                $state = info_state::firstOrCreate(['name' => $value['provincia']]);
                $stateId = $state->id;
            }

            // Ajustado para permitir cantones sin un estado
            $this->processCantones($value['cantones'] ?? [], $stateId);
        }
    }

    private function processCantones($cantones, $stateId = null)
    {
        foreach ($cantones as $cantonId => $cantonValue) {
            $city = info_city::firstOrCreate([
                'name' => $cantonValue['canton'] ?? 'Cantón no definido',
                'state_id' => $stateId // Asegúrate de que la columna se llama 'info_state_id'
            ]);

            // Ajustado para permitir parroquias sin un cantón
            $this->processParroquias($cantonValue['parroquias'] ?? [], $city->id);
        }
    }

    private function processParroquias($parroquias, $cityId)
    {
        foreach ($parroquias as $parroquiaId => $parroquiaName) {
            info_parishes::firstOrCreate([
                'name' => $parroquiaName,
                'city_id' => $cityId // Asegúrate de que la columna se llama 'info_city_id'
            ]);
        }
    }
}