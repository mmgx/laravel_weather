<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\City as Model;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            ['name' => 'Москва'],
            ['name' => 'Санкт-Петербург'],
            ['name' => 'Лондон'],
            ['name' => 'Париж'],
            ['name' => 'Нью-Йорк'],
            ['name' => 'Берлин'],
            ['name' => 'Афины'],
            ['name' => 'Саранск'],
            ['name' => 'Казань'],
            ['name' => 'Сочи'],
            ['name' => 'Ульяновск'],
        ];

        foreach ($cities as $city) {
            $newCity = Model::all()
                ->where('name', $city['name'])
                ->first();
            if ($newCity === null) {
                $newCity = Model::create([
                    'name' => $city['name'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
