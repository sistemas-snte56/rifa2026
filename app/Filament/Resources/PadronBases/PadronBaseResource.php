<?php

namespace App\Filament\Resources\PadronBases;

use App\Filament\Resources\PadronBases\Pages\CreatePadronBase;
use App\Filament\Resources\PadronBases\Pages\EditPadronBase;
use App\Filament\Resources\PadronBases\Pages\ListPadronBases;
use App\Filament\Resources\PadronBases\Pages\ViewPadronBase;
use App\Filament\Resources\PadronBases\Schemas\PadronBaseForm;
use App\Filament\Resources\PadronBases\Schemas\PadronBaseInfolist;
use App\Filament\Resources\PadronBases\Tables\PadronBasesTable;
use App\Models\PadronBase;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PadronBaseResource extends Resource
{
    protected static ?string $model = PadronBase::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nombre_completo';

    public static function form(Schema $schema): Schema
    {
        return PadronBaseForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PadronBaseInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PadronBasesTable::configure($table);
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
            'index' => ListPadronBases::route('/'),
            'create' => CreatePadronBase::route('/create'),
            'view' => ViewPadronBase::route('/{record}'),
            'edit' => EditPadronBase::route('/{record}/edit'),
        ];
    }
}
