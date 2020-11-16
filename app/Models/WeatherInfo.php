<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Base\Model as BaseModel;

class WeatherInfo extends BaseModel
{
    use HasFactory;

    /**
     * Статусы обновления погоды у городов
     */
    public const STATUS_ACTIVE = 'ACTIVE';
    public const STATUS_INACTIVE = 'INACTIVE';
    public static $statuses = [self::STATUS_ACTIVE, self::STATUS_INACTIVE];

}
