<?php

namespace Database\Seeders;

use App\Models\PadronBase;
use Illuminate\Database\Seeder;

class PadronSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/padron_base.csv');

        if (!file_exists($path)) {
            $this->command->warn('El archivo padron_base.csv no fue encontrado.');
            return;
        }

        $rows = array_map('str_getcsv', file($path));

        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // saltar encabezado

            PadronBase::create([
                'numero_personal' => $row[0],
                'nombre_completo' => $row[1],
                'rfc' => $row[2],
            ]);
        }

        $this->command->info('Padrón importado correctamente.');
    }
}