<?php

namespace App\Service;

use App\Models\City;

class QueryService
{
    protected $weatherService;

    public function __construct(WeatherInfoService $openWeatherMapService) {
        $this->weatherService = $openWeatherMapService;
    }

    public function queryAll()
    {
        $cities = City::all();
        $this->weatherService->query(env('OPENWEATHER_KEY'), $cities);
    }
}
