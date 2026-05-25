<?php

namespace App\Filament\Resources\Delegacions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class DelegacionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('region.nombre')
                    ->label('Región')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nombre_completo')
                    ->label('Delegación')
                    ->searchable(query: function ($query, string $search) {
                        $query->where('delegacion', 'like', "%{$search}%")
                            ->orWhere('sede', 'like', "%{$search}%")
                            ->orWhereHas('nivel', function ($q) use ($search) {
                                $q->where('nombre', 'like', "%{$search}%");
                            });
                    })
                    ->sortable(['delegacion']),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
            ])
            ->defaultSort('delegacion', 'asc')

            ->filters([
                SelectFilter::make('region_id')
                    ->relationship('region', 'nombre')
                    ->label('Filtrar por Región')
                    ->placeholder('Selecciona una región'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Eliminar Seleccionados')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('¿Estás seguro de que deseas eliminar las delegaciones seleccionadas?')
                        ->modalSubheading('Esta acción no se puede deshacer.')
                        ->icon('heroicon-o-trash'),
                ])->label('Acciones en lote'),
            ]);
    }
}
