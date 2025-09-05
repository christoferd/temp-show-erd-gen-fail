<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string|null $name_english
 * @property string|null $name_china
 * @property string $phone_1
 * @property string $phone_2
 * @property string $email
 * @property string $website
 * @property string $address_to
 * @property string $address_street1
 * @property string $address_street2
 * @property int|null $city_id
 * @property int|null $state_id
 * @property int|null $country_id
 * @property string $address_postcode
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\City|null $city
 * @property-read \App\Models\Country|null $country
 * @property-read \App\Models\ShippingAddress|null $shippingAddress
 * @property-read \App\Models\State|null $state
 * @method static \Database\Factories\FactoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Factory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Factory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Factory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Factory whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Factory whereAddressPostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Factory whereAddressStreet1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Factory whereAddressStreet2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Factory whereAddressTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Factory whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Factory whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Factory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Factory whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Factory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Factory whereNameChina($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Factory whereNameEnglish($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Factory wherePhone1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Factory wherePhone2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Factory whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Factory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Factory whereWebsite($value)
 * @mixin \Eloquent
 */
class Factory extends Model
{
    use HasFactory;

    protected $table = 'factory';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name_english',
        'name_china',
        'phone_1',
        'phone_2',
        'email',
        'website',
        'address_to',
        'address_street1',
        'address_street2',
        'city_id',
        'state_id',
        'country_id',
        'address_postcode',
        'active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    /**
     * Limited to one shipping address for the Factory model.
     *
     * @return HasOne
     */
    public function shippingAddress(): HasOne
    {
        return $this->hasOne(ShippingAddress::class, 'factory_id', 'id');
    }

}
