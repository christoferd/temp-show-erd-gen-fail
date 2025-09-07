<?php

namespace App\Filament\Resources\Factories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FactoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name_english')
                    ->default(''),
                TextInput::make('name_china')
                    ->default(''),
                TextInput::make('phone_1')
                    ->tel()
                    ->required()
                    ->default(''),
                TextInput::make('phone_2')
                    ->tel()
                    ->required()
                    ->default(''),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required()
                    ->default(''),
                TextInput::make('website')
                    ->required()
                    ->default(''),
                Select::make('address_id')
                    ->relationship('address', 'id')
                    ->default(null),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
