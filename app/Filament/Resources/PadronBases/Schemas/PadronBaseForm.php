<?php

namespace App\Filament\Resources\PadronBases\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PadronBaseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre_completo')
                    ->required(),
                TextInput::make('rfc'),
                TextInput::make('numero_personal')
                    ->required(),
            ]);
    }
}
