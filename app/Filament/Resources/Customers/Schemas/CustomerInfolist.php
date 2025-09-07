<?php

namespace App\Filament\Resources\Customers\Schemas;

use App\Models\Customer;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

class CustomerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        /** @var Customer $customer */
        $customer = $schema->getRecord();

        return $schema
            ->components([
                             Section::make('Customer Information')
                                    ->columns(3)
                                    ->schema([
                                                 TextEntry::make('user.name'),
                                                 TextEntry::make('Account Manager')
                                                          ->state($customer?->accountManager?->name ?: ''),
                                                 TextEntry::make('abn'),

                                                 TextEntry::make('company_name')->columnSpan(2),
                                                 TextEntry::make('brand_label'),

                                                 TextEntry::make('first_name'),
                                                 TextEntry::make('last_name'),

                                                 TextEntry::make('phone_1'),

                                                 TextEntry::make('tradeTerm.name')->label('Trade Terms'),
                                                 TextEntry::make('paymentTerm.name')->label('Payment Terms'),
                                                 TextEntry::make('phone_2'),

                                                 TextEntry::make('AddressSingleLine')
                                                          ->label('Company Address') // Sets the label
                                                          ->columnSpan(3),

                                                 TextEntry::make('website')->columnSpan(3),
                                                 IconEntry::make('is_active')
                                                          ->boolean(),
                                                 TextEntry::make('created_at')
                                                          ->dateTime(),
                                                 TextEntry::make('updated_at')
                                                          ->dateTime(),
                                             ])
                         ]);
    }
}
