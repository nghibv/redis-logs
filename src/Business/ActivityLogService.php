<?php


namespace Nghibv\Redislogs\Business;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Nghibv\Redislogs\Models\ActivityLog;
use Illuminate\Support\Facades\Validator;

class ActivityLogService
{

    /**
     * @var ActivityLog
     */
    private $model;

    const KEY = 'GBiz:Redis:Activity';
    const SUCCESS = 'success';
    const ERROR = 'error';
    const FAIL = 'fail';

    public function __construct()
    {
        $this->model = new ActivityLog();
    }

    /**
     * @param $params
     * @return bool
     */
    public function store($params)
    {
        $this->model->title = $params['title'];
        $this->model->causer_id = $params['causer_id'];
        $this->model->causer_name = $params['causer_name'];
        $this->model->method = $params['method'];
        $this->model->route = $params['route'];
        $this->model->model = $params['model'];
        $this->model->description = $params['description'];
        $this->model->old = $params['old'];
        $this->model->new = $params['new'];
        $this->model->save();
        return $this->model;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {

        $params = $request->all();
        $model = $this->model;
        $params['limit'] = isset($params['limit']) && $params['limit'] != '' ? $params['limit'] : 3;

        if (isset($params['causer_id']) && $params['causer_id'] != '') {
            $model = $model->where('causer_id', $params['causer_id']);
        }

        if (isset($params['causer_name']) && $params['causer_name'] != '') {
            $model = $model->where('causer_name', $params['causer_name']);
        }

        if (isset($params['model']) && $params['model'] != '') {
            $model = $model->where('model', $params['model']);
        }

        if (isset($params['sort']) && !empty($params['sort'])) {
            foreach ($params['sort'] as $orderBy => $orderDirection) {
                $model = $model->orderBy($orderBy, $orderDirection);
            }
        }

        if (isset($params['getAll']) && $params['getAll']) {
            return $model->limit($params['limit'])->get();
        }

        return $model->paginate($params['limit'], ['*'], isset($params['pageKey']) ? $params['pageKey'] : 'page');
    }

    /**
     * @param $params
     * @return array|string[]
     */
    public function redisActivity($params): array
    {
        $memoryValidator = self::validate($params);
        if ($memoryValidator->fails()) {
            return self::getErrorWithMessages($memoryValidator->messages()->toArray());
        }

        $memoryKey = self::KEY.':'.time();
        $memory = Cache::put($memoryKey, $params, 60*60);
        return $memory ? self::getSuccess(true) : self::getError('Something went wrong!');
    }

    /**
     * @param $params
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validate($params): object
    {
        $rules = [
            "title" => implode('|', [
                "required", "max:255"
            ]),
            "causer_id" => implode('|', [
                "required", "integer"
            ]),
            "causer_name" => implode('|', [
                "required", "max:100"
            ]),
            "method" => implode('|', [
                "max:10"
            ]),
            "route" => implode('|', [
                "max:225"
            ]),
            "model" => implode('|', [
                "max:100"
            ]),
            "description" => implode('|', [
                "required", "max:255"
            ]),
        ];

        return Validator::make($params, $rules);
    }

    /**
     * @param $messages
     * @return array
     */
    public static function getErrorWithMessages($messages): array
    {
        return [
            'status' => self::FAIL,
            'data' => $messages
        ];
    }

    /**
     * @param $data
     * @return array
     */
    public function getSuccess($data): array
    {
        return [
            'status' => self::SUCCESS,
            'data' => $data
        ];
    }

    /**
     * @param $message
     * @return string[]
     */
    public static function getError($message): array
    {
        return [
            'status' => self::ERROR,
            'message' => $message
        ];
    }
}
