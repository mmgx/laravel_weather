<?php

namespace App\Service;

use App\Models\WeatherInfo;
use App\Models\WeatherInfo as Model;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

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

    /**
     * @param string $apiKey
     * @param Collection $cities
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function query(string $apiKey, Collection $cities): Collection
    {
        $uri = env('OPENWEATHER_SITE', 'https://api.openweathermap.org');
        $result = new Collection();

        $http = new Client(['base_uri' => $uri]);

        foreach ($cities as $city) {
            $response = $http->get('data/2.5/weather', [
                'query' => [
                    'APPID' => $apiKey,
                    'q' => $city->name,
                    'units' => 'metric',
                ]
            ]);
            $response = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

            $weatherInfo = new WeatherInfo();
            $weatherInfo->city()->associate($city);
            $weatherInfo->temperature_c = $response['main']['temp'];
            $weatherInfo->status = $response['weather'][0] ? $response['weather'][0]['main'] : '';
            $weatherInfo->updated_at = Carbon::createFromTimestamp($response['dt']);
            $weatherInfo->save();

            $result->push($weatherInfo);
        }

        return $result;
    }
}
