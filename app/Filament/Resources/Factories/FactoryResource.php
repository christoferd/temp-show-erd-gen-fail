<?php

namespace App\Filament\Resources\Factories;

use App\Filament\Resources\CardFileResource;
use App\Filament\Resources\Factories\Pages\CreateFactory;
use App\Filament\Resources\Factories\Pages\EditFactory;
use App\Filament\Resources\Factories\Pages\ListFactories;
use App\Filament\Resources\Factories\Pages\ViewFactory;
use App\Filament\Resources\Factories\Schemas\FactoryForm;
use App\Filament\Resources\Factories\Schemas\FactoryInfolist;
use App\Filament\Resources\Factories\Tables\FactoriesTable;
use App\Models\Factory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FactoryResource extends CardFileResource
{
    protected static ?string $model = Factory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name_english';

    public static function form(Schema $schema): Schema
    {
        return FactoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FactoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FactoriesTable::configure($table);
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
            'index' => ListFactories::route('/'),
            'create' => CreateFactory::route('/create'),
            'view' => ViewFactory::route('/{record}'),
            'edit' => EditFactory::route('/{record}/edit'),
        ];
    }
}
