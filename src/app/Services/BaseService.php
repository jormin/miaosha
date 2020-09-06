<?php


namespace App\Services;


use App\Libs\Redis;
use Illuminate\Redis\Connections\Connection;

class BaseService
{

    /**
     * @var Connection $redisConnection
     */
    protected $redisConnection;

    public function __construct()
    {
        $this->redisConnection = Redis::getDefaultRedisConnection();
    }

}