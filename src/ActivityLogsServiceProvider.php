<?php

namespace Nghibv\Redislogs;

use Illuminate\Support\ServiceProvider;
use Nghibv\Redislogs\Console\Commands\ProcessRedisActivity;

class ActivityLogsServiceProvider extends ServiceProvider
{

    protected $commands = [
        ProcessRedisActivity::class,
    ];

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'activity');
        $this->loadMigrationsFrom(__DIR__.'/Database/migrations');
    }

    public function register()
    {
        $this->commands($this->commands);
    }
}
