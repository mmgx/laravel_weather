<?php

namespace App\Http\Livewire;

use App\Models\City;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class CityTable.
 */
class CityTable extends TableComponent
{
    use HtmlComponents;

    /**
     * @var string
     */
    public $sortField = 'name';
    public $offlineIndicator = false;
    public $loadingIndicator = false;

    /**
     * @return Builder
     * @var string
     */
    public function query(): Builder
    {
        return City::query()->orderBy('id', 'asc');
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Id'), 'id')
                ->sortable(),
            Column::make(__('Название города'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('Текущая температура'))
                ->format(function (City $model) {
                    return $model->weatherInfo()->first()->temperature_c;
                }),
            Column::make(__('Облачность'))
                ->format(function (City $model) {
                    return $model->weatherInfo()->first()->status;
                }),
            Column::make(__('Время обновления (UTC+3)'))
                ->format(function (City $model) {
                    $time = Carbon::createFromFormat('Y-m-d H:i:s', $model->weatherInfo()->first()->updated_at)->timezone('Europe/Moscow');
                    return $time;
                }),
            Column::make(__('Действия'))
                ->format(function (City $model) {
                    return view('backend.geo.city.includes.actions', ['city' => $model]);
                }),
        ];
    }
}
