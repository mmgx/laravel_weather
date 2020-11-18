<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Base\BaseController;
use App\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CityController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $city = City::all();
        return $this->sendResponse($city->toArray(), 'Список городов получен успешно');
    }

    /**
     * Display the specified resource.
     *
     * @param City $city
     * @return JsonResponse
     */
    public function show(City $city)
    {
        $product = City::find($city);
        if (is_null($city)) {
            return $this->sendError('City not found.');
        }
        return $this->sendResponse($product->toArray(), 'Город успешно получен');
    }
}
