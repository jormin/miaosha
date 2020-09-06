<?php


namespace App\Libs;


use Illuminate\Redis\Connections\Connection;

class Redis
{

    const REDIS_CHANNEL_DEFAULT = 'default';

    const REDIS_CHANNEL_LONG = 'long';

    const REDIS_CHANNEL_EXCEPTION = 'exception';

    /**
     * 获取Redis连接
     * @param string $channel
     * @return Connection
     */
    public static function getRedisConnection(string $channel)
    {
        return \Illuminate\Support\Facades\Redis::connection($channel);
    }

    /**
     * 获取默认Redis连接
     * @return Connection
     */
    public static function getDefaultRedisConnection()
    {
        return \Illuminate\Support\Facades\Redis::connection(self::REDIS_CHANNEL_DEFAULT);
    }

    /**
     * 获取长期存储Redis连接
     * @return Connection
     */
    public static function getLongRedisConnection()
    {
        return \Illuminate\Support\Facades\Redis::connection(self::REDIS_CHANNEL_LONG);
    }

    /**
     * 获取异常存储Redis连接
     * @return Connection
     */
    public static function getExceptionRedisConnection()
    {
        return \Illuminate\Support\Facades\Redis::connection(self::REDIS_CHANNEL_EXCEPTION);
    }

}