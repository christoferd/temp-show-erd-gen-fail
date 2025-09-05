<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int|null $user_id
 * @property int|null $account_manager_user_id
 * @property string|null $abn
 * @property string|null $company_name
 * @property string|null $contact_name
 * @property string|null $phone_1
 * @property string|null $phone_2
 * @property string|null $website
 * @property string|null $brand_label
 * @property int|null $trade_term_id
 * @property int|null $payment_term_id
 * @property string|null $address_to
 * @property string|null $address_street1
 * @property string|null $address_street2
 * @property int|null $city_id
 * @property int|null $state_id
 * @property int|null $country_id
 * @property string|null $address_postcode
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $accountManager
 * @property-read \App\Models\City|null $city
 * @property-read \App\Models\Country|null $country
 * @property-read \App\Models\PaymentTerm|null $paymentTerm
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ShippingAddress> $shippingAddresses
 * @property-read int|null $shipping_addresses_count
 * @property-read \App\Models\State|null $state
 * @property-read \App\Models\TradeTerm|null $tradeTerm
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\CustomerFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereAbn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereAccountManagerUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereAddressPostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereAddressStreet1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereAddressStreet2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereAddressTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereBrandLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer wherePaymentTermId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer wherePhone1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer wherePhone2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereTradeTermId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereWebsite($value)
 * @mixin \Eloquent
 */
class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;

    protected $table = 'customer';

    protected $fillable = [
        'user_id',
        'account_manager_user_id',
        'abn',
        'company_name',
        'contact_name',
        'phone_1',
        'phone_2',
        'website',
        'brand_label',
        'trade_term_id',
        'payment_term_id',
        'address_to',
        'address_street1',
        'address_street2',
        'city_id',
        'state_id',
        'country_id',
        'address_postcode',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Account Manager relationship to the `users` table.
     *
     * @return BelongsTo
     */
    public function accountManager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'account_manager_user_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function tradeTerm(): BelongsTo
    {
        return $this->belongsTo(TradeTerm::class, 'trade_term_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function paymentTerm(): BelongsTo
    {
        return $this->belongsTo(PaymentTerm::class, 'payment_term_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function shippingAddresses(): HasMany
    {
        return $this->hasMany(ShippingAddress::class, 'customer_id', 'id');
    }

    public function customerEmails(): HasMany
    {
        return $this->hasMany(CustomerEmail::class, 'customer_id', 'id');
    }

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
     * Assigns an account manager to the current model instance.
     *
     * @param User $user The user to be assigned as the account manager.
     * @param bool $save Whether to save the changes to the database immediately (default: true).
     *
     * @return void
     */
    public function assignAccountManager(User $user, bool $save = true): void
    {
        $this->account_manager_user_id = $user->id;
        if($save)
        {
            $this->save();
        }
    }

}
