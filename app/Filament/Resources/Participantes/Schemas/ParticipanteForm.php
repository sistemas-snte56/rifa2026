<?php

namespace App\Filament\Resources\Participantes\Schemas;

use App\Models\Delegacion;
use App\Models\Region;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class ParticipanteForm
{

    /**
     * Generando mayusculas a campos de nombre
     */
    protected static function upperCase(): \Closure
    {
        return fn ($state) => mb_strtoupper($state, 'UTF-8');
    }


    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // 1. Buscador en el Padrón (Los 30,000)

                Select::make('padron_base_id')
                    ->relationship('padronBase', 'numero_personal')
                    ->getOptionLabelFromRecordUsing(
                        fn ($record) => "{$record->numero_personal} - {$record->nombre_completo}"
                    )
                    ->getSearchResultsUsing(
                        fn (string $search) => \App\Models\PadronBase::query()
                            ->where('numero_personal', 'like', "%{$search}%")
                            ->orWhere('nombre_completo', 'like', "%{$search}%")
                            ->limit(50)
                            ->get()
                            ->mapWithKeys(
                                fn ($record) => [$record->id => "{$record->numero_personal} - {$record->nombre_completo}"]
                            )
                    )
                    ->searchable()
                    ->required()
                    ->label('Número Personal / Nombre')
                    ->columnSpanFull(),




                Select::make('region_id')
                    ->required()
                    ->label('Región')
                    ->placeholder('Selecciona una región')
                    ->options( fn() => Region::orderBy('id')->pluck('nombre', 'id')->toArray())
                    ->searchable()
                    ->dehydrated(false) // No se guarda directamente en el modelo, es solo para filtrar las delegaciones
                    ->live()
                    // ->afterStateUpdated( fn (callable $set, ?int $state) => $set('delegacion_id', null) )
                    ->afterStateUpdated( fn (Set $set) => $set('delegacion_id', null) )
                    ,

                // 2. Selección de Delegación
                Select::make('delegacion_id')
                    ->label('Delegación Correspondiente')
                    ->options( function (callable $get) {
                        $regionId = $get('region_id');
                        if (!$regionId) {
                            return [];
                        }
                        return Delegacion::where('region_id', $regionId)->orderBy('delegacion')->pluck('delegacion', 'id')->toArray();
                    })
                    ->searchable()
                    ->preload()
                    ->required()
                    ->live()
                    ->disabled( fn (callable $get) => !$get('region_id') ),


                // 3. Género (El dato estadístico que agregamos)
                Select::make('genero')
                    ->options(['H' => 'HOMBRE', 'M' => 'MUJER', 'O' => 'OTRO'])
                    ->required()
                    ->native(false)
                    ->label('Género'),

                // 4. Datos de Contacto
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->placeholder('ejemplo@correo.com')
                    ->label('Correo Electrónico'),

                TextInput::make('telefono')
                    ->label('Teléfono')
                    ->tel()
                    ->rule('regex:/^\d{10}$/')
                    ->validationMessages(['regex' => 'El número de teléfono debe tener 10 dígitos.'])
                    ->required(),
                        
            ]);
    }
}
