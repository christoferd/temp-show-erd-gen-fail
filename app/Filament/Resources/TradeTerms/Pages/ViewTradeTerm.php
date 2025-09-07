<?php

namespace App\Filament\Resources\TradeTerms\Pages;

use App\Filament\Resources\TradeTerms\TradeTermResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTradeTerm extends ViewRecord
{
    protected static string $resource = TradeTermResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
