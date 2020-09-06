<?php

namespace App\Http\Controllers;

use App\Libs\Redis;
use App\Models\Activity;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{

    /**
     * 创建活动
     * @param Request $request
     * @return array
     */
    public function create(Request $request)
    {
        $stock = $request->get('stock', 0);
        $rate = $request->get('rate', 10);
        $product = get_object_vars(DB::table('product')->first());
        if ($rate < 0 || $rate > 100) {
            return $this->failed(9001);
        }
        if ($stock <= 0 || $stock > $product['stock']) {
            return $this->failed(2001, '库存应在1-' . $product['stock'] . '之间');
        }
        DB::table('activity')->insert([
            'product_id' => $product['id'],
            'name' => $product['name'],
            'price' => 100,
            'origin_price' => $product['price'],
            'start_time' => time(),
            'end_time' => time() + 3600 * 24,
            'amount' => 1000,
            'stock' => 1000,
            'rate' => $rate,
            'created_at' => time(),
            'updated_at' => time()
        ]);
        $activity = Activity::query()->orderBy('id', 'desc')->first()->getAttributes();
        $activityInfoKey = config('redis.prefix.activity_info') . $activity['id'];
        Redis::getDefaultRedisConnection()->set($activityInfoKey, json_encode($activity));
        return $this->success('创建活动成功', $activity);
    }

    /**
     * 清理数据成功
     * @param Request $request
     * @return array
     */
    public function clear(Request $request)
    {
        Activity::query()->truncate();
        Product::query()->truncate();
        Order::query()->truncate();
        Redis::getDefaultRedisConnection()->flushall();
        Artisan::call('migrate');
        Artisan::call('db:seed --class=SeederProduct');
        return $this->success('清理数据成功');
    }

    /**
     * 获取活动信息
     * @param Request $request
     * @return array
     */
    public function activity(Request $request)
    {
        $activityId = $request->get('activityId', 0);
        if (!$activityId) {
            return $this->failed(9001);
        }
        $activity = Activity::query()->find($activityId);
        if (!$activityId) {
            return $this->failed(9001);
        }
        $activity = $activity->getAttributes();
        $product = Product::query()->find($activity['product_id'])->getAttributes();
        $ordersNum = Order::query()->where(['activity_id' => $activityId])->count();

        $activityInfoKey = config('redis.prefix.activity_info') . $activityId;
        $activityAllUserIdsKey = config('redis.prefix.activity_all_user_ids') . $activityId;
        $activitySuccessUserIdsKey = config('redis.prefix.activity_success_user_ids') . $activityId;
        $redisConnection = Redis::getDefaultRedisConnection();
        $data = [
            'redis' => [
                'info' => json_decode($redisConnection->get($activityInfoKey), true),
                'all_users_num' => $redisConnection->scard($activityAllUserIdsKey),
                'success_users_num' => $redisConnection->scard($activitySuccessUserIdsKey)
            ],
            'db' => [
                'activity' => $activity,
                'product' => $product,
                'orders_num' => $ordersNum
            ]
        ];
        return $this->success('获取活动信息成功', $data);
    }

}
