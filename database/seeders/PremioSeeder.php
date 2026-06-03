<?php

namespace Database\Seeders;

use App\Models\Premio;
use App\Models\TipoPremio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PremioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Definición de los paquetes aprobados en la reunión
        $paquetes = [
            ['nombre' => 'iPad', 'descripcion' => 'iPad 11 pulgadas', 'cantidad' => 10, 'orden' => 1],
            ['nombre' => 'Pantalla', 'descripcion' => 'Pantalla Daweoo 70 pulgadas', 'cantidad' => 10, 'orden' => 2],
            ['nombre' => 'Laptop', 'descripcion' => 'Laptop Dell Inspiron', 'cantidad' => 10, 'orden' => 3],
            ['nombre' => 'Viaje', 'descripcion' => 'Viaje no Playa', 'cantidad' => 1, 'orden' => 4],
            ['nombre' => 'Viaje', 'descripcion' => 'Viaje Playa', 'cantidad' => 1, 'orden' => 5],
            ['nombre' => 'Moto Italika', 'descripcion' => 'Moto Italika FT 150', 'cantidad' => 1, 'orden' => 6],
            ['nombre' => 'Moto Italika', 'descripcion' => 'Moto Italika FT 200', 'cantidad' => 1, 'orden' => 7],
            ['nombre' => 'Moto Italika', 'descripcion' => 'Moto Italika DM 150', 'cantidad' => 1, 'orden' => 8],
            ['nombre' => 'Auto', 'descripcion' => 'Auto Fiat Pulse 2026', 'cantidad' => 1, 'orden' => 9],
        ]; 

        foreach ($paquetes as $paquete) {
            $tipo = TipoPremio::create([
                'nombre' => $paquete['nombre'],
                'descripcion' => $paquete['descripcion'],
                'orden_bloque' => $paquete['orden']
            ]);

            // Generar automáticamente los premios individuales para este bloque
            for ($i = 1; $i <= $paquete['cantidad']; $i++) {
                Premio::create([
                    'tipo_premio_id' => $tipo->id,
                    'numero_item' => $i,
                    'participante_id' => null, // Disponibles
                ]);
            }
        }
    }
}
