<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ObjectiveModel extends Model
{
    /**
     * Scope a query to only include active users.
     * Local Scopes https://laravel.com/docs/12.x/eloquent#local-scopes
     */
    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('is_active', 1);
    }
}
