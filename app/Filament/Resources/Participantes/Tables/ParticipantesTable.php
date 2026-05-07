<?php

namespace App\Filament\Resources\Participantes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ParticipantesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('folio')
                    ->searchable(),
                TextColumn::make('padron_base_id', 'nombre_completo')
                     ->getStateUsing(function ($record) {
                        return $record->padronBase ? $record->padronBase->nombre_completo : 'N/A';
                    }   )
                    ->numeric()
                    ->sortable(),
                TextColumn::make('delegacion_id', 'Delegación')
                    ->getStateUsing(function ($record) {
                        return $record->delegacion ? $record->delegacion->delegacion : 'N/A';
                    })
                    ->numeric()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('telefono')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
