<?php

namespace App\Filament\Resources\Premios\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class PremioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('premio_completo')
                ->label('Premio')
                ->afterStateHydrated(function ($component, $record) {
                    $component->state($record ? "{$record->tipoPremio->nombre} #{$record->numero_item}" : '');
                })
                ->disabled(), // Bloqueado para que no se altere el nombre del premio por error

                Select::make('participante_id')
                    ->label('Asignar Ganador')
                    ->placeholder('Escribe folio o nombre...')
                    ->relationship(
                        name: 'participante', 
                        titleAttribute: 'folio', 
                        modifyQueryUsing: fn (Builder $query) => $query->whereDoesntHave('premios')
                    )
                    ->getOptionLabelFromRecordUsing(fn ($record) => "Folio: {$record->folio} - {$record->padronBase->nombre_completo}")
                    ->searchable()
                    // Quitamos ->preload() para evitar que el navegador explote
                    ->getSearchResultsUsing(function (string $search) {
                        return \App\Models\Participante::query()
                            ->with('padronBase') 
                            ->whereDoesntHave('premios')
                            ->where(function ($query) use ($search) {
                                $query->where('folio', 'like', "%{$search}%")
                                    ->orWhereHas('padronBase', function ($q) use ($search) {
                                        $q->where('nombre_completo', 'like', "%{$search}%");
                                    });
                            })
                            ->limit(15) 
                            ->get()
                            ->mapWithKeys(fn ($item) => [
                                $item->id => "Folio: {$item->folio} - {$item->padronBase->nombre_completo}"
                            ]);
                    })
                    
            ]);
    }
}
