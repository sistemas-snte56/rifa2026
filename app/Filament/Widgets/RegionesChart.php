<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class RegionesChart extends ChartWidget
{
    protected ?string $heading = 'Regiones Chart';

    // Añade estas dos líneas
    protected static ?int $sort = 2; // Aparece después del Widget con sort 1

    // Esto hace que el widget use las 12 columnas (todo el ancho)
    protected int | string | array $columnSpan = 'full';   
    // Ajusta el número según qué tan alta la quieras (en píxeles)
    protected ?string $maxHeight = '300px';
    // // Hace que inicie CERRADO automáticamente
    protected bool $isCollapsible = true;


    protected function getData(): array
    {
        // Obtenemos las regiones y contamos cuántos participantes tiene cada una
        $regiones = \App\Models\Region::all();
        
        $labels = [];
        $counts = [];

        foreach ($regiones as $region) {
            $labels[] = $region->nombre;
            
            // Contamos participantes a través de la relación con delegaciones
            $counts[] = \App\Models\Participante::whereHas('delegacion', function ($query) use ($region) {
                $query->where('region_id', $region->id);
            })->count();
        }
        
        return [
            'datasets' => [
                [
                    'label' => 'Participantes por Región',
                    'data' => $counts,
                    'backgroundColor' => [
                        '#0f766e', // verde petróleo
                        '#065f46', // verde institucional oscuro
                        '#10b981', // verde moderno
                        '#0ea5e9', // azul cyan
                        '#1d4ed8', // azul SNTE
                        '#312e81', // índigo profundo
                        '#7c3aed', // morado institucional
                        '#be185d', // magenta vino
                        '#dc2626', // rojo institucional
                        '#d97706', // dorado oscuro
                        '#84cc16', // verde lima educativo
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
