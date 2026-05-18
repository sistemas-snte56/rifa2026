<?php

namespace App\Filament\Resources\PadronBases\Pages;

use App\Filament\Resources\PadronBases\PadronBaseResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPadronBase extends ViewRecord
{
    protected static string $resource = PadronBaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
