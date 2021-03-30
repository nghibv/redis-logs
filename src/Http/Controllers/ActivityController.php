<?php


namespace Nghibv\Redislogs\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class ActivityController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        dd($user);
        $params = [
            'title' => 'This is title of Activity Log',
            'causer_id' => '',
            'causer_name' => '',
            'method' => '',
            'route' => '',
            'model' => '',
            'description' => '',
            'properties' => [
                'attributes' => [

                ],
                'old' => [

                ],
            ],
        ];

        //Cache::put('123:'.time(), 'Hello Redis', 60*60);
        //Cache::put('GBiz:Redis:Activity:'.time(), 'Hello Redis', 60*60);

        //Cache::tags('GBiz:Redis:Activity')->put(time(), 'Hello Redis', 60*60);

        /*$connection = config('cache.stores.redis.connection');
        $memories = Redis::connection($connection)->keys('*:GBiz:Redis:Activity*');
        $prefix = config('cache.prefix');
        foreach ($memories as $value) {
            $key = str_replace($prefix.':','', $value);
            //$activity = Cache::pull($key);
            dd($value, $key);
        }
        return view('activity::activity');*/
    }
}
