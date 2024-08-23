<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileInfo query()
 * @property int $id
 * @property int $user_id
 * @property string $key
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileInfo whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileInfo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileInfo whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileInfo whereValue($value)
 * @mixin \Eloquent
 */
class ProfileInfo extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'key', 'value'];

    protected $casts = [
        'value' => 'array',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
