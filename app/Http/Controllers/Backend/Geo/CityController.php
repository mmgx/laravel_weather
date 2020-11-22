<?php

namespace App\Http\Controllers\Backend\Geo;

use App\Http\Controllers\API\Base\BaseController;
use App\Models\City;
use App\Service\QueryService;
use App\Service\WeatherInfoService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

/**
 * Class UserController.
 */
class CityController extends BaseController
{
    /**
     * @var WeatherInfoService
     */
    protected $weatherInfoService;
    protected $queryService;

    /**
     * UserController constructor.
     *
     * @param WeatherInfoService $weatherInfoService
     * @param QueryService $queryService
     */
    public function __construct(WeatherInfoService $weatherInfoService, QueryService $queryService)
    {
        $this->weatherInfoService = $weatherInfoService;
        $this->queryService = $queryService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        if ($this->weatherInfoService->count() === 0){
            return redirect()->route('dashboard')->withFlashDanger(__('Информация о погоде еще не загружалась в базу. Обновить ее может администратор из меню, либо через artisan'));
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

    public function arbitrary(Request $request)
    {
        if ($request['name']){
            $city = $request['name'];
            $weather = $this->queryService->queryCity($city);

            $info = [];
            $info['city'] = Str::ucfirst($city);
            $info['temp'] = $weather[0]['main']['temp'];
            $info['status'] = $weather[0]['weather'][0]['main'];

            $request->session()->flash('weather', json_encode($info));
            return redirect()->route('admin.geo.cities.arbitrary');
        }

        return view('backend.geo.city.arbitrary');
    }
}
