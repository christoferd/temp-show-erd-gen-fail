<?php

namespace App\Filament\Resources\Addresses\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AddressForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('address_to')
                    ->required()
                    ->default(''),
                TextInput::make('street1')
                    ->required()
                    ->default(''),
                TextInput::make('street2')
                    ->required()
                    ->default(''),
                Select::make('city_id')
                    ->relationship('city', 'name')
                    ->default(null),
                Select::make('state_id')
                    ->relationship('state', 'name')
                    ->default(null),
                Select::make('country_id')
                    ->relationship('country', 'name')
                    ->default(null),
                TextInput::make('postcode')
                    ->required()
                    ->default(''),
            ]);
    }
}
