<?php

namespace Nghibv\Redislogs;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Nghibv\Redislogs\Console\Commands\ProcessRedisActivity;

class ActivityLogsServiceProvider extends ServiceProvider
{

    public $commands = [
        ProcessRedisActivity::class,
    ];

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'activity');
        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');
        $this->commands(
            [
                ProcessRedisActivity::class,
            ]
        );
    }

    public function register()
    {
    }

    public function schedule(Schedule $schedule)
    {
        $schedule->command(ProcessRedisActivity::class)->everyMinute();
    }
}
