<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string|null $name
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TradeTerm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TradeTerm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TradeTerm query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TradeTerm whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TradeTerm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TradeTerm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TradeTerm whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TradeTerm whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TradeTerm extends ObjectiveModel
{
    protected $table = 'trade_term';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'ordering',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
