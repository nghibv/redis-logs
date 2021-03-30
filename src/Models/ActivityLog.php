<?php


namespace Nghibv\Redislogs\Models;


use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_logs';
    /**
     * @var mixed
     */
    private $title;
    /**
     * @var mixed
     */
    private $causer_id;
    /**
     * @var mixed
     */
    private $causer_name;
    /**
     * @var mixed
     */
    private $method;
    /**
     * @var mixed
     */
    private $route;
    /**
     * @var mixed
     */
    private $model;
    /**
     * @var mixed
     */
    private $description;
    /**
     * @var mixed
     */
    private $properties;
    /**
     * @var mixed
     */
    private $old;
    /**
     * @var mixed
     */
    private $new;

}
