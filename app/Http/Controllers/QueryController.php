<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Base\BaseController;
use Carbon\Carbon;
use App\Models\City;
use InvalidArgumentException;
use App\Http\Transform\WeatherInfoTransformer;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class QueryController extends BaseController
{
    public function current($city) {
        if(!($city = City::where('name', $city)->first()))
            return $this->sendError(__('Город не найден'));

        $result = $city->weatherInfo->first();

        return $result;
    }

    public function all($city) {
        if(!($city = City::where('name', $city)->first()))
            return $this->sendError(__('Город не найден'));

        return $city->weatherInfo;
    }
}
