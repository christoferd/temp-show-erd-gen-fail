<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int                             $id
 * @property int|null                        $customer_id
 * @property int|null                        $factory_id
 * @property string                          $address_to
 * @property string                          $address_street1
 * @property string                          $address_street2
 * @property int|null                        $city_id
 * @property int|null                        $state_id
 * @property int|null                        $country_id
 * @property string                          $postcode
 * @property bool                            $active
 * @property int                             $is_default
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Factory|null   $factory
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShippingAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShippingAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShippingAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShippingAddress whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShippingAddress whereAddressStreet1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShippingAddress whereAddressStreet2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShippingAddress whereAddressTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShippingAddress whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShippingAddress whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShippingAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShippingAddress whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShippingAddress whereFactoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShippingAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShippingAddress whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShippingAddress wherePostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShippingAddress whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShippingAddress whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ShippingAddress extends Model
{
    protected $table = 'shipping_address';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'factory_id',
        'address_to',
        'address_street1',
        'address_street2',
        'city_id',
        'state_id',
        'country_id',
        'postcode',
        'active',
        'is_default',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function factory(): BelongsTo
    {
        return $this->belongsTo(Factory::class, 'factory_id', 'id');
    }

}
