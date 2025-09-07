<?php

namespace App\Filament\Resources\Factories\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FactoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name_english'),
                TextEntry::make('name_china'),
                TextEntry::make('phone_1'),
                TextEntry::make('phone_2'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('website'),
                TextEntry::make('address.id'),
                IconEntry::make('is_active')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
