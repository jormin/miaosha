<?php


namespace App\Http\Controllers\Api;


use App\Libs\Redis;
use App\Services\BuyService;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Closure;

class BuyController extends ApiController
{

    /**
     * @var BuyService
     */
    protected $buyService;

    public function __construct(BuyService $buyService)
    {
        $this->buyService = $buyService;
    }

    /**
     * 秒杀
     * @param Request $request
     * @param Closure $closure
     * @return string
     */
    public function buy(Request $request, Closure $closure)
    {
        Redis::getDefaultRedisConnection()->incr('request_num');
        $activityId = $request->get('activityId', 0);
        $userId = rand(0, 1000000);
        $code = $this->buyService->buy($activityId, $userId);
        return $code === 0000 ? '成功' : '失败';
    }

}