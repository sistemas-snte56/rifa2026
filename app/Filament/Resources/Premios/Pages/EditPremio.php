<?php

namespace App\Filament\Resources\Premios\Pages;

use App\Filament\Resources\Premios\PremioResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPremio extends EditRecord
{
    protected static string $resource = PremioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // ViewAction::make(),
            // DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        // Esto le dice a Filament: "En cuanto guardes, mándame al index (la tabla)"
        return $this->getResource()::getUrl('index');
    }
}
