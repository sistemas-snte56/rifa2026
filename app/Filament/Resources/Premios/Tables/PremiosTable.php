<?php

namespace App\Filament\Resources\Premios\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;


use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;





class PremiosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tipoPremio.id')
                    ->label('Premio')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('tipoPremio.nombre')
                    ->label('Premio')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('tipoPremio.descripcion')
                    ->label('Descripción')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('participante.folio')
                    ->label('Folio')
                    ->badge()
                    ->color('success')
                    ->placeholder('-'),                    

                TextColumn::make('participante.padronBase.nombre_completo')
                    ->label('Nombre del Ganador')
                    ->placeholder('Sin asignar')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('delegacion_region')
                    ->label('Delegación / Región')
                    ->placeholder('Sin asignar')
                    ->getStateUsing(function ($record) {
                        $delegacion = $record->participante?->delegacion?->delegacion;
                        $region = $record->participante?->delegacion?->region?->nombre;

                        return collect([$delegacion, $region])
                            ->filter()
                            ->implode(' / ');
                    })
                    ->searchable()
                    ->sortable(),


            ])
            ->modifyQueryUsing(fn (Builder $query) => $query->with([
                'tipoPremio', 
                'participante.padronBase', 
                'participante.delegacion.region'
            ]))
            ->filters([
                //
            ])
            ->recordAction('edit')

            ->recordActions([
                // ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                ExportAction::make()
                    ->label('Exportar Ganadores')
                    ->color('success')                        
                    ->icon('heroicon-o-document-arrow-down')
                    ->exports([
                        ExcelExport::make()
                            ->fromTable()
                            ->withFilename('Lista_Ganadores_' . date('d-m-Y'))
                            ->withWriterType(\Maatwebsite\Excel\Excel::XLSX)
                            // ->withColumns([
                            //     Column::make('tipoPremio.nombre')->heading('Premio'),
                            //     Column::make('numero_item')->heading('No. Item'),
                            //     Column::make('participante.folio')->heading('Folio'),
                            //     Column::make('participante.padronBase.nombre_completo')->heading('Nombre Completo'),
                            //     // Para la delegación, como es calculada, usamos una función:
                            //     Column::make('delegacion')
                            //         ->heading('Delegación/Región')
                            //         ->getStateUsing(fn ($record) => 
                            //             collect([
                            //                 $record->participante?->delegacion?->delegacion,
                            //                 $record->participante?->delegacion?->region?->nombre
                            //             ])->filter()->implode(' / ')
                            //         ),
                            // ]),

                    ])
                
            ])
            ->paginated([50]);           
            
    }
}
