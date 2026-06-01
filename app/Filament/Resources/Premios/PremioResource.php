<?php

namespace App\Filament\Resources\Premios;

use App\Filament\Resources\Premios\Pages\CreatePremio;
use App\Filament\Resources\Premios\Pages\EditPremio;
use App\Filament\Resources\Premios\Pages\ListPremios;
use App\Filament\Resources\Premios\Pages\ViewPremio;
use App\Filament\Resources\Premios\Schemas\PremioForm;
use App\Filament\Resources\Premios\Schemas\PremioInfolist;
use App\Filament\Resources\Premios\Tables\PremiosTable;
use App\Models\Premio;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PremioResource extends Resource
{
    protected static ?string $model = Premio::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'premio';

    public static function form(Schema $schema): Schema
    {
        return PremioForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PremioInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PremiosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPremios::route('/'),
            'create' => CreatePremio::route('/create'),
            'view' => ViewPremio::route('/{record}'),
            'edit' => EditPremio::route('/{record}/edit'),
        ];
    }
}
