<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\WeatherInfo as Model;

class AddStatusToWeatherInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weather_infos', function (Blueprint $table) {
            $table->enum('status', Model::$statuses)->after('temperature_c')->default(Model::STATUS_ACTIVE)->comment('Update Status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weather_infos', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
