<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string|null $name
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentTerm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentTerm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentTerm query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentTerm whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentTerm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentTerm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentTerm whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PaymentTerm whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PaymentTerm extends ObjectiveModel
{
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

    protected $table = 'payment_term';

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
