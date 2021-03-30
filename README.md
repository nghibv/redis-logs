# redis-logs
Activity logs employees using redis

In config app.php add Provider:
    
    Nghibv\Redislogs\ActivityLogsServiceProvider::class

Run:
    
    php artisan migrate

Data Set:

    $params = [
        'title' => 'This is title of Activity Log '. time(),
        'causer_id' => 72,
        'causer_name' => buivannghi1991@gmail.cpm,
        'method' => 'GET',
        'route' => '/employees/activity',
        'model' => 'Employees',
        'description' => 'Get employees list',
        'old' => '',
        'new' => '',
    ]

Store Activity Logs:

    $activity = new ActivityLogService();
    $activityResponse = $activity->redisActivity($params);

Index Activity Logs:

    $memories = new ActivityLogService();
    $list = $memories->index($request);