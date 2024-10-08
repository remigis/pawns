<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @property int $points
 * @property string|null $from
 * @property string $to
 * @property int $claimed
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereClaimed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTo($value)
 * @property string $claimed_at
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereClaimedAt($value)
 * @mixin \Eloquent
 */
class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to',
        'points',
        'claimed',
        'claimed_at',
    ];
}
