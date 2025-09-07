<?php

namespace App\Providers;

use Filament\Tables\Enums\RecordActionsPosition;
use Illuminate\Support\ServiceProvider;
use Filament\Actions\Action;
use Filament\Tables\Table;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Global record action settings
        // https://filamentphp.com/docs/4.x/tables/actions#global-record-action-settings
        Table::configureUsing(function(Table $table): void
        {
            $table
                ->selectable(false)
                ->recordActions([
                                    // ...
                                ], position: RecordActionsPosition::BeforeCells);
        });
    }
}
