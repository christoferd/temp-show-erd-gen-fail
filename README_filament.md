# filament Info

## Core

Resources are static classes that are used to build CRUD interfaces for your Eloquent models. They describe how administrators should be able to interact with data from your app using tables and forms.

https://filamentphp.com/docs/4.x/resources/overview

`pa filament:make-resource CustomerResource --view --generate`

## Security

Resource Security

https://filamentphp.com/docs/4.x/resources/overview#security

For authorization, Filament will observe any model policies that are registered in your app. e.g. `App\Policies\CustomerPolicy`.

### Model Policies

https://laravel.com/docs/12.x/authorization#creating-policies

`php artisan make:policy CustomerPolicy`

