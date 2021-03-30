<?php


namespace Nghibv\Redislogs\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Nghibv\Redislogs\Business\ActivityLogService;

class ProcessRedisActivity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'biz-activity-logs:process-caching-redis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Read cache from redis and insert to database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $key = ActivityLogService::KEY;
        $connection = config('cache.stores.redis.connection');
        $memories = Redis::connection($connection)->keys('*:'.$key.'*');
        $prefix = config('cache.prefix');
        foreach ($memories as $value) {
            $key = str_replace($prefix.':','', $value);
            $activity = Cache::pull($key);
            $log = new ActivityLogService();
            $log->store($activity);
        }
    }
}
