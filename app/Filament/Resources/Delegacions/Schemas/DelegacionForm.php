<?php

namespace App\Filament\Resources\Delegacions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DelegacionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('region_id')
                    ->relationship('region', 'nombre')
                    ->placeholder('Selecciona una región')
                    ->searchable()
                    ->required(),

                TextInput::make('delegacion')
                    ->label('Delegación')
                    ->unique(ignoreRecord: true)                   
                    ->required(),

                TextInput::make('sede')
                    ->label('Sede')
                    ->required(),
                    
                Select::make('nivel_id')
                    ->relationship('nivel', 'nombre')
                    ->placeholder('Selecciona un nivel')
                    ->searchable()
                    ->required(),
            ]);
    }
}
