<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int|null $factory_id
 * @property string|null $timezone
 * @property string|null $full_name_english
 * @property string|null $full_name_china
 * @property string|null $phone
 * @property string|null $wechat
 * @property string|null $qq
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Factory|null $factory
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Staff newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Staff newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Staff query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Staff whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Staff whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Staff whereFactoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Staff whereFullNameChina($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Staff whereFullNameEnglish($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Staff whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Staff wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Staff whereQq($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Staff whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Staff whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Staff whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Staff whereWechat($value)
 * @mixin \Eloquent
 */
class Staff extends Model
{
    protected $table = 'staff';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'factory_id',
        'timezone',
        'full_name_english',
        'full_name_china',
        'phone',
        'wechat',
        'qq',
        'active',
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

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
