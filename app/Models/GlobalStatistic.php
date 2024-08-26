<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $date
 * @property int $created_transactions
 * @property int $claimed_transactions
 * @property string $claimed_usd
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|GlobalStatistic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GlobalStatistic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GlobalStatistic query()
 * @method static \Illuminate\Database\Eloquent\Builder|GlobalStatistic whereClaimedTransactions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GlobalStatistic whereClaimedUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GlobalStatistic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GlobalStatistic whereCreatedTransactions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GlobalStatistic whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GlobalStatistic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GlobalStatistic whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GlobalStatistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'created_transactions',
        'claimed_transactions',
        'claimed_usd',
    ];
}
