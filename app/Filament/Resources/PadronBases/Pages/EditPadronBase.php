<?php

namespace App\Filament\Resources\PadronBases\Pages;

use App\Filament\Resources\PadronBases\PadronBaseResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPadronBase extends EditRecord
{
    protected static string $resource = PadronBaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
