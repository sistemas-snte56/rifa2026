<?php

namespace Database\Seeders;

use App\Models\PadronBase;
use App\Models\Participante;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncidenciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $path = database_path('seeders/data/incidencias.csv');

        if (!file_exists($path)) {
            $this->command->error("Archivo no encontrado en: {$path}");
            return;
        }

        $handle = fopen($path, 'r');
        $header = true;
        $count = 0;

        DB::beginTransaction();

        try {
            while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($header) { $header = false; continue; }

                // Mapeo exacto de tu último archivo:
                $numPersonal = trim($row[0]);
                $nombre      = trim($row[1]);
                $rfc         = !empty($row[2]) ? trim($row[2]) : null;
                $delegacionId= trim($row[3]);
                $email       = trim($row[4]);
                $telefono    = trim($row[5]);
                $genero   = trim($row[6]);

                // Mapeo de Género
                // $genero = ($generoRaw === 'M') ? 'FEMENINO' : (($generoRaw === 'H') ? 'MASCULINO' : 'NO ESPECIFICADO');

                if (empty($numPersonal)) continue;

                // PASO 1: Lógica para el Padrón (Evita duplicados)
                // Si el número personal ya existe, actualiza los datos. Si no, lo crea.
                $padron = PadronBase::updateOrCreate(
                    ['numero_personal' => $numPersonal],
                    [
                        'nombre_completo' => $nombre,
                        'rfc'             => $rfc,
                    ]
                );

                // PASO 2: Crear Participante
                // Esto siempre crea un nuevo registro de participación y dispara el Folio
                Participante::firstOrCreate([
                    'padron_base_id' => $padron->id,
                    'delegacion_id'  => $delegacionId,
                    'genero'         => $genero,
                    'telefono'       => $telefono,
                    'email'          => $email,
                ]);

                $count++;
            }

            DB::commit();
            fclose($handle);
            $this->command->info("¡Éxito! Se procesaron {$count} registros correctamente.");

        } catch (\Exception $e) {
            DB::rollBack();
            if ($handle) fclose($handle);
            $this->command->error("Error: " . $e->getMessage());
        }


    }
}
