<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $customer_id
 * @property string|null $name
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer $customer
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomerEmail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomerEmail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomerEmail query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomerEmail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomerEmail whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomerEmail whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomerEmail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomerEmail whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CustomerEmail whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CustomerEmail extends ObjectiveModel
{
    protected $table = 'customer_email';

    protected $fillable = [
        'customer_id',
        'name',
        'email',
    ];

    /**
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
