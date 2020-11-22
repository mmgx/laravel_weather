<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\WeatherInfo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class CityTable.
 */
class CurrentCityTable extends TableComponent
{
    use HtmlComponents;

    /**
     * @var string
     */
    public $city;

    public $searchEnabled = false;
    public $offlineIndicator = false;
    public $loadingIndicator = false;

    /**
     * @return Builder
     * @var string
     */
    public function query(): Builder
    {
        return WeatherInfo::query()->where('city_id', $this->city->id)->orderByDesc('updated_at');
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Время обновления (UTC+3)'))
                ->format(function (WeatherInfo $model) {
                    $time = Carbon::createFromFormat('Y-m-d H:i:s', $model->updated_at)->timezone('Europe/Moscow');
                    return $time;
                }),
            Column::make(__('Температура'))
                ->format(function (WeatherInfo $model) {
                    return $model->temperature_c;
                }),
            Column::make(__('Осадки'))
                ->format(function (WeatherInfo $model) {
                    return $model->status;
                }),
        ];
    }
}
