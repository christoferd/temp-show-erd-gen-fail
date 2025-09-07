<?php

namespace App\Filament\Resources\PaymentTerms\Pages;

use App\Filament\Resources\PaymentTerms\PaymentTermResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPaymentTerm extends EditRecord
{
    protected static string $resource = PaymentTermResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
