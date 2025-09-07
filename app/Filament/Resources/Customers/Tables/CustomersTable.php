<?php

namespace App\Filament\Resources\Customers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CustomersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                          TextColumn::make('user.name')
                                    ->searchable(),
                          TextColumn::make('account_manager_user_id')
                                    ->numeric()
                                    ->sortable(),
                          TextColumn::make('abn')
                                    ->searchable(),
                          TextColumn::make('company_name')
                                    ->searchable(),
                          TextColumn::make('contact_name')
                                    ->searchable(),
                          TextColumn::make('phone_1')
                                    ->searchable(),
                          TextColumn::make('phone_2')
                                    ->searchable(),
                          TextColumn::make('website')
                                    ->searchable(),
                          TextColumn::make('brand_label')
                                    ->searchable(),
                          TextColumn::make('tradeTerm.name')
                                    ->searchable(),
                          TextColumn::make('paymentTerm.name')
                                    ->searchable(),
                          TextColumn::make('address.id')
                                    ->searchable(),
                          IconColumn::make('is_active')
                                    ->boolean(),
                          TextColumn::make('created_at')
                                    ->dateTime()
                                    ->sortable()
                                    ->toggleable(isToggledHiddenByDefault: true),
                          TextColumn::make('updated_at')
                                    ->dateTime()
                                    ->sortable()
                                    ->toggleable(isToggledHiddenByDefault: true),
                      ])
            ->filters([
                          //
                      ])
            ->recordActions([
                                ViewAction::make(),
                                EditAction::make(),
                            ])
            ->toolbarActions([
                                 BulkActionGroup::make([
                                                           DeleteBulkAction::make(),
                                                       ]),
                             ])
            ->defaultSort('id', 'desc');
    }
}
