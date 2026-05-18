<?php

namespace App\Filament\Resources\PadronBases\Pages;

use App\Filament\Resources\PadronBases\PadronBaseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPadronBases extends ListRecords
{
    protected static string $resource = PadronBaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
