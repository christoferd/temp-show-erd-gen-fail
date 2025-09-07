<?php

namespace App\Libraries;

use App\Models\City;
use App\Models\User;

class SelectOptionsLib
{

    static function accountManagers(bool $includeBlank = false, mixed $blankValue = null): array
    {
        $options = User::role('account_manager')
                       ->where('is_active', true)
                       ->pluck('name', 'id')->toArray();

        if($includeBlank)
        {
            $options = [$blankValue => ''] + $options;
        }

        return $options;
    }

    static function cityOptions()
    {
        return City::all()->pluck('name', 'id')->toArray();
    }

}
