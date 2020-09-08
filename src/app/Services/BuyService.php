<?php


namespace App\Services;


use App\Jobs\GenerateOrder;
use App\Models\Activity;
use Illuminate\Support\Facades\Log;

class BuyService extends BaseService
{

    /**
     * 抢购
     * @param int $activityId 活动ID
     * @param int $userId 用户ID
     * @return int
     */
    public function buy(int $activityId, int $userId)
    {
        $activityInfoKey = config('redis.prefix.activity_info') . $activityId;
        $activityStockKey = config('redis.prefix.activity_stock') . $activityId;
        $activityAllUserIdsKey = config('redis.prefix.activity_all_user_ids') . $activityId;
        $activitySuccessUserIdsKey = config('redis.prefix.activity_success_user_ids') . $activityId;
        $activity = $this->redisConnection->hgetall($activityInfoKey);
        // 缓存中未查询到活动信息
        if (!$activity) {
            $activity = Activity::query()->find($activityId);
            if (!$activity) {
                return 9001;
            }
            $activity = $activity->getAttributes();
            $this->redisConnection->hmset($activityInfoKey, $activity);
        }
        // 活动未开启
        if ($activity['start_time'] > time()) {
            return 1001;
        }
        // 活动已结束
        if ($activity['end_time'] < time()) {
            return 1002;
        }
        // 判断当前用户是否已经参与过
        $isIn = $this->redisConnection->sismember($activityAllUserIdsKey, $userId);
        if ($isIn) {
            return 1003;
        }
        // 记录该用户已参与
        $this->redisConnection->sadd($activityAllUserIdsKey, [$userId]);
        // 读取库存
        $stock = $this->redisConnection->lpop($activityStockKey);
        if (!$stock) {
            return 1002;
        }
//        // 增加概率
//        $isSuccess = rand(0, 100) >= 100 - $activity['rate'];
//        if (!$isSuccess) {
//            return 1004;
//        }
        // 记录该用户已成功
        $this->redisConnection->sadd($activitySuccessUserIdsKey, [$userId]);
        // 增加任务队列
        $job = (new GenerateOrder([
            'activityId' => $activityId,
            'userId' => $userId,
            'productId' => $activity['product_id'],
            'amount' => 1,
            'price' => $activity['price'],
        ]))->onQueue('generate-order');
        dispatch($job);
        return 0000;
    }

}