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

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
