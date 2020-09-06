<?php

namespace App\Jobs;

use App\Libs\CommonFunction;
use App\Libs\Redis;
use App\Models\Activity;
use App\Models\Order;
use App\Models\Product;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GenerateOrder extends Job
{

    public $tries = 3;

    public $queue = 'generate-order';

    /**
     * @var array 参数
     */
    private $params = [];

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    /**
     * Execute the job.
     * @throws Exception
     */
    public function handle()
    {
        $activityId = $this->params['activityId'];
        DB::beginTransaction();
        // 写入订单数据
        $data = [
            'id' => CommonFunction::createOrderId(),
            'activity_id' => $activityId,
            'user_id' => $this->params['userId'],
            'product_id' => $this->params['productId'],
            'amount' => $this->params['amount'],
            'price' => $this->params['price'],
            'money' => $this->params['amount'] * $this->params['price'],
            'status' => 0
        ];
        $order = new Order();
        $result = $order->fill($data)->save();
        Log::info('生成订单信息', $data);
        if (!$result) {
            Log::error('生成订单失败', $data);
            DB::rollBack();
            throw new Exception('生成订单失败');
        }
        // 更新商品库存
        Activity::query()->where('id', $activityId)->decrement('stock');
        Product::query()->where('id', $this->params['productId'])->decrement('stock');
        // 更新商品销量
        Product::query()->where('id', $this->params['productId'])->increment('sale');
        // 更新缓存
        $activity = Activity::query()->find($activityId)->getAttributes();
        $activityInfoKey = config('redis.prefix.activity_info') . $activityId;
        Redis::getDefaultRedisConnection()->hmset($activityInfoKey, $activity);
        DB::commit();
    }

    /**
     * 失败处理
     */
    public function failed()
    {
        // 监听失败处理
        Log::error('生成订单第[' . $this->attempts() . ']次尝试失败', $this->params);
        // 如果第三次失败则需要进行报警
        if ($this->attempts() == 3) {
            // todo 预留报警部分，包括不限于记录日志、发送短信、发送语音电话、发送微信消息、发送IM报警等
        }

    }
}
