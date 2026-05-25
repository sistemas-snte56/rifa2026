<?php

namespace App\Filament\Resources\Delegacions\Pages;

use App\Filament\Resources\Delegacions\DelegacionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDelegacion extends ViewRecord
{
    protected static string $resource = DelegacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
