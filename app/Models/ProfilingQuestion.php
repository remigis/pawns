<?php

namespace App\Models;

use App\Repositories\ProfilingQuestionRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $text
 * @property string $type
 * @property string|null $options
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilingQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilingQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilingQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilingQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilingQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilingQuestion whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilingQuestion whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilingQuestion whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilingQuestion whereUpdatedAt($value)
 * @property string $profile_info_key
 * @method static \Illuminate\Database\Eloquent\Builder|ProfilingQuestion whereProfileInfoKey($value)
 * @mixin \Eloquent
 */
class ProfilingQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'text',
        'type',
        'options',
    ];

    protected $casts = [
        'options' => 'array'
    ];

    public function isWithChoice(): bool
    {
        return in_array($this->type, ProfilingQuestionRepository::$questionsWithChoice);
    }
}
