<?php

namespace App\Console;

use App\Service\QueryService;
use Illuminate\Console\Command;

class GetWeatherInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Запрос погоды для всех городов';

    protected $queryService;

    /**
     * Create a new command instance.
     *
     * @param QueryService $queryService
     */
    public function __construct(QueryService $queryService)
    {
        $this->queryService = $queryService;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try{
            $this->queryService->queryAll();
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
            return 1;
        }
        $this->info('Информация о погоде загружена в базу');
        return 0;
    }
}
