<?php

namespace App\Filament\Resources\Delegacions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;


// use Filament\Infolists\Components\Grid;
// use Filament\Infolists\Components\TextEntry;
use Filament\Support\Enums\FontWeight;

use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;



class DelegacionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
    ->components([
        Section::make('Información General')
            ->description('Detalles principales de la delegación y ubicación.')
            ->aside() // Esto pone el título a la izquierda y el contenido a la derecha
            ->schema([
                Grid::make(2) // Dividimos en 2 columnas para que no se vea tan vacío
                    ->schema([
                        TextEntry::make('nombre_completo')
                            ->label('Identificación')
                            ->weight(FontWeight::Bold)
                            ->color('primary')
                            ->columnSpanFull(), // Que ocupe todo el ancho de la sección

                        TextEntry::make('region.nombre')
                            ->label('Región Administrativa')
                            ->badge()
                            ->color('info')
                            ->icon('heroicon-m-map-pin'),

                        TextEntry::make('nivel.nombre') // <--- Cambiado de nivel_id a relación
                            ->label('Nivel Educativo')
                            ->badge()
                            ->color('success')
                            ->icon('heroicon-m-academic-cap'),

                        TextEntry::make('sede')
                            ->label('Sede Localizada')
                            ->placeholder('No especificada')
                            ->icon('heroicon-m-building-office'),

                        TextEntry::make('delegacion')
                            ->label('Clave Interna')
                            ->copyable() // Permite copiar la clave con un clic
                            ->icon('heroicon-m-tag'),
                    ]),
            ]),

        Section::make('Metadatos')
            ->description('Registro de cambios en el sistema.')
            ->collapsed() // La dejamos cerrada por defecto para no estorbar
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Fecha de Creación')
                            ->dateTime('d/m/Y H:i'),

                        TextEntry::make('updated_at')
                            ->label('Última Actualización')
                            ->dateTime('d/m/Y H:i'),
                    ]),
            ]),
    ]);
    }
}
