<?php

namespace App\Filament\Resources\TradeTerms;

use App\Filament\Resources\CardFileResource;
use App\Filament\Resources\TradeTerms\Pages\CreateTradeTerm;
use App\Filament\Resources\TradeTerms\Pages\EditTradeTerm;
use App\Filament\Resources\TradeTerms\Pages\ListTradeTerms;
use App\Filament\Resources\TradeTerms\Pages\ViewTradeTerm;
use App\Filament\Resources\TradeTerms\Schemas\TradeTermForm;
use App\Filament\Resources\TradeTerms\Schemas\TradeTermInfolist;
use App\Filament\Resources\TradeTerms\Tables\TradeTermsTable;
use App\Models\TradeTerm;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TradeTermResource extends CardFileResource
{
    protected static ?string $model = TradeTerm::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return TradeTermForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TradeTermInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TradeTermsTable::configure($table);
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
            'index' => ListTradeTerms::route('/'),
            'create' => CreateTradeTerm::route('/create'),
            'view' => ViewTradeTerm::route('/{record}'),
            'edit' => EditTradeTerm::route('/{record}/edit'),
        ];
    }
}
