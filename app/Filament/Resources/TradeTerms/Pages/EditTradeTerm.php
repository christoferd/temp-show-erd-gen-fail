<?php

namespace App\Filament\Resources\TradeTerms\Pages;

use App\Filament\Resources\TradeTerms\TradeTermResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditTradeTerm extends EditRecord
{
    protected static string $resource = TradeTermResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
