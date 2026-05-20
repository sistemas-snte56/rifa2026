<?php

namespace App\Filament\Widgets;

use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    // Añade esta línea al principio de la clase
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Registrados', number_format(\App\Models\Participante::count()))
                ->description('Participantes activos')
                ->descriptionIcon('heroicon-s-users', IconPosition::Before)
                ->color('primary'),
 
            Stat::make('Meta de Registro', function() {
                $total = \App\Models\PadronBase::count();
                $reg = \App\Models\Participante::count();
                return $total > 0 ? number_format(($reg / $total) * 100, 1) . '%' : '0%';
            })  ->description('Avance del padrón')
                ->descriptionIcon('heroicon-s-chart-bar', IconPosition::Before)
                ->color('success'),

            Stat::make('Registros de Hoy', number_format(\App\Models\Participante::whereDate('created_at', \Carbon\Carbon::today())->count()))
                ->description('Nuevos hoy')
                ->descriptionIcon('heroicon-s-calendar', IconPosition::Before)
                ->color('info'),
        ];
    }
}
