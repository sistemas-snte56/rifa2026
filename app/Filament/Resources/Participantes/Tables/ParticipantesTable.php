<?php

namespace App\Filament\Resources\Participantes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
// Exportación (Asegúrate de que el paquete soporte v4)
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;

use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;

class ParticipantesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('folio')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('padronBase.nombre_completo')
                    ->label('Nombre Completo')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('padronBase.numero_personal')
                    ->label('Número Personal')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('delegacion.nombre_completo')
                    ->label('Delegación / Sede')
                    ->sortable()
                    ->searchable(query: function ($query, string $search) {
                        $query->whereHas('delegacion', function ($q) use ($search) {
                            $q->where('delegacion', 'like', "%{$search}%")
                              ->orWhere('sede', 'like', "%{$search}%");
                        });
                    }),

                TextColumn::make('delegacion.region.nombre')
                    ->label('Región')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Correo')
                    ->searchable(),

                TextColumn::make('telefono')
                    ->label('Teléfono')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Fecha Registro')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filtros...
                Filter::make('region_delegacion')
                    ->form([
                        Select::make('region_id')
                            ->label('Región')
                            ->options(\App\Models\Region::pluck('nombre', 'id'))
                            ->live()
                            ->afterStateUpdated(fn(callable $set) => $set('delegacion_id', null)),

                        Select::make('delegacion_id')
                            ->label('Delegación')
                            ->options(function (callable $get) {
                                $regionId = $get('region_id');
                                
                                if (!$regionId) {
                                    return \App\Models\Delegacion::pluck('delegacion', 'id');
                                }

                                return \App\Models\Delegacion::where('region_id', $regionId)
                                    ->orderBy('delegacion', 'asc')    
                                    ->pluck('delegacion', 'id');
                            })
                            ->live(),
                    ])
                    ->query(function (Builder $query, array $data) {
                        $query
                            ->when(
                                $data['delegacion_id'],
                                fn(Builder $q) => $q->where('delegacion_id', $data['delegacion_id'])
                            )
                            ->when(
                                $data['region_id'] && !$data['delegacion_id'],
                                fn(Builder $q) => $q->whereHas('delegacion', function (Builder $q) use ($data) {
                                    $q->where('region_id', $data['region_id']);
                                })
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['region_id'] ?? null) {
                            // Usamos un query simple. En v4 esto es lo más seguro si no quieres líos
                            $region = \App\Models\Region::find($data['region_id']);
                            $indicators[] = 'Región: ' . ($region?->nombre ?? 'N/A');
                        }

                        if ($data['delegacion_id'] ?? null) {
                            $delegacion = \App\Models\Delegacion::find($data['delegacion_id']);
                            $indicators[] = 'Delegación: ' . ($delegacion?->delegacion ?? 'N/A');
                        }

                        return $indicators;
                    }),


            ])
            ->headerActions([
                ExportAction::make()
                    ->label('Exportar Excel')
                    ->color('success')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->exports([
                        ExcelExport::make()
                            ->fromTable()
                            ->withColumns([
                                Column::make('id')->heading('ID'),
                                Column::make('folio')->heading('Folio'),
                                Column::make('padronBase.numero_personal')->heading('No. Personal'),
                                Column::make('padronBase.nombre_completo')->heading('Nombre del Trabajador'),
                                Column::make('delegacion.region.nombre')->heading('Región'),
                                Column::make('delegacion.nombre_completo')->heading('Delegación/Sede'),
                                Column::make('padronBase.genero')->heading('Género'),
                                Column::make('email')->heading('Correo Electrónico'),
                                Column::make('telefono')->heading('Teléfono'),
                                Column::make('created_at')->heading('Fecha de Registro'),
                            ]),
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                    BulkActionGroup::make([
                        DeleteBulkAction::make()->label('Eliminar Seleccionados')
                            ->color('danger')
                            ->icon('heroicon-o-trash'),
                    ])
                    ->label('Acciones en Lote'),
                ]);
            
    }
}