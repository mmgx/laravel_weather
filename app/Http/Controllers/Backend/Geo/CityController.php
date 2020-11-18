<?php

namespace App\Http\Controllers\Backend\Geo;

use App\Http\Controllers\API\Base\BaseController;
use App\Models\City;
use App\Service\WeatherInfoService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class UserController.
 */
class CityController extends BaseController
{
    /**
     * @var WeatherInfoService
     */
    protected $weatherInfoService;

    /**
     * UserController constructor.
     *
     * @param  WeatherInfoService  $weatherInfoService
     */
    public function __construct(WeatherInfoService $weatherInfoService)
    {
        $this->weatherInfoService = $weatherInfoService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        if ($this->weatherInfoService->count() === 0){
            return redirect()->back()->withFlashDanger(__('Информация о погоде еще не загружалась в базу. Обновить ее может администратор из меню, либо через artisan'));
        }
        return view('backend.geo.city.index');
    }

    /**
     * @param City $city
     * @return mixed
     */
    public function show(City $city)
    {
        return view('backend.geo.city.show')
            ->withCity($city);
    }

    /**
     * @param City $city
     * @return mixed
     */
    public function history(City $city)
    {
        return view('backend.geo.city.history')
            ->withCity($city);
    }


}
