<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Base\Model as BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeatherInfo extends BaseModel
{
    use HasFactory;

    protected $casts = [
        'temperature_c' => 'double',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Статусы обновления погоды у городов
     */
    public const STATUS_ACTIVE = 'ACTIVE';
    public const STATUS_INACTIVE = 'INACTIVE';
    public static $statuses = [self::STATUS_ACTIVE, self::STATUS_INACTIVE];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
