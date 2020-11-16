<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Base\Model as BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends BaseModel
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function weatherInfo(): HasMany
    {
        return $this->hasMany(WeatherInfo::class)->orderByDesc('updated_at');
    }
}
