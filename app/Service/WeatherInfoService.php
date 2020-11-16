<?php

namespace App\Service;

use App\Models\WeatherInfo as Model;

class WeatherInfoService extends Base\BaseService
{
    /**
     * WeatherService constructor.
     * @param  Model  $weather
     */
    public function __construct(Model $weather)
    {
        $this->model = $weather;
    }
}
