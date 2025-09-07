<?php

namespace App\Filament\Resources\TradeTerms\Pages;

use App\Filament\Resources\TradeTerms\TradeTermResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTradeTerms extends ListRecords
{
    protected static string $resource = TradeTermResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
