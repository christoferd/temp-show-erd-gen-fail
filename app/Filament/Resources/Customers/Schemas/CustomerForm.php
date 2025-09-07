<?php

namespace App\Filament\Resources\Customers\Schemas;

use App\Filament\Resources\Addresses\Schemas\AddressForm;
use App\Libraries\SelectOptionsLib;
use App\Models\Customer;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Alignment;

class CustomerForm
{
    public static function configure(Schema $schema, ?Customer $customer = null): Schema
    {
        return $schema
            ->components(
                [
                    TextInput::make('first_name')
                             ->required()
                             ->default(''),
                    TextInput::make('last_name')
                             ->required()
                             ->default(''),
                    TextInput::make('company_name')
                             ->required()
                             ->default(''),
                    TextInput::make('abn')
                             ->default('')
                             ->required()
                             ->label('ABN'),
                    Select::make('account_manager_user_id')
                          ->label('Account Manager')
                          ->options(SelectOptionsLib::accountManagers(false))
                          ->required()
                          ->default(null),
                    TextInput::make('phone_1')
                             ->tel()
                             ->default(''),
                    TextInput::make('phone_2')
                             ->tel()
                             ->default(''),
                    TextInput::make('brand_label')
                             ->default(''),
                    Select::make('trade_term_id')
                          ->relationship('tradeTerm', 'name')
                          ->label('Trade Terms')
                          ->required()
                          ->default(null),
                    Select::make('payment_term_id')
                          ->relationship('paymentTerm', 'name')
                          ->label('Payment Terms')
                          ->required()
                          ->default(null),
                    TextInput::make('website')
                             ->columnSpan(2)
                             ->default(''),
                    Toggle::make('is_active')
                          ->label('Active')
                          ->required(),

                    // ------------
                    Fieldset::make('Business Address')->schema(
                        [
                            // Saving data to relationships https://filamentphp.com/docs/4.x/forms/overview#saving-data-to-relationships
                            Group::make()
                                 ->relationship('address')
                                 ->columnSpan(3)
                                 ->columns(2)
                                 ->schema(
                                     AddressForm::configure(Schema::make())->getComponents()
                                 )
                        ]
                    )->columnSpan(3)->columns(3),

                    // ------------
                    // https://filamentphp.com/docs/4.x/schemas/sections#introduction
                    // You can also use a section without a header, which just wraps the components in a simple card:
                    Section::make('Shipping Addresses')
                           ->description('Here you may add multiple shipping addresses. The default shipping address is the first one, at the top.')
                           ->schema(
                        [
                            // static::shippingRepeater($schema, $customer)
                            Repeater::make('shipping_addresses')
                                    // hide label
                                    ->hiddenLabel()
                                    ->schema(
                                        [
                                            TextInput::make('address_to')
                                                     ->required()
                                                     ->default('Chris De David'),
                                            TextInput::make('street1')
                                                     ->required()
                                                     ->default('1 Testing St'),
                                            TextInput::make('street2')
                                                     ->default(''),
                                            Select::make('city_id')
                                                  ->label('City')
                                                // ->relationship('shippingCities', 'name')
                                                  ->options(SelectOptionsLib::cityOptions())
                                                  ->required()
                                                  ->default(null),
                                            // Select::make('state_id')
                                            //       ->relationship('state', 'name')
                                            //       ->default(null),
                                            // Select::make('country_id')
                                            //       ->relationship('country', 'name')
                                            //       ->default(null),
                                            TextInput::make('postcode')
                                                     ->required()
                                                     ->default('9999'),
                                        ]
                                    )
                                // Button label
                                    ->addActionLabel('Add Shipping Address')
                                // Button alignment left
                                    ->addActionAlignment(Alignment::Start)
                                // Allow sorting so that the default address is at the top
                                    ->reorderable(true)
                                // Allow delete button
                                    ->deletable(true)
                                // - Confirming repeater actions with a modal https://filamentphp.com/docs/4.x/forms/repeater#confirming-repeater-actions-with-a-modal
                                    ->deleteAction(
                                    fn(Action $action) => $action->requiresConfirmation(),
                                )
                                // Layout
                                    ->columns(3)
                        ]
                    )->columnSpan(3),
                ]
            );
    }

}
