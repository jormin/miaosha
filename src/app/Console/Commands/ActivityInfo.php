<?php


namespace App\Console\Commands;


use App\Libs\Redis;
use App\Models\Activity;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Console\Command;

class ActivityInfo extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activity-info {activityId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '秒杀活动状态';

    /**
     * Execute the console command.
     *
     * @desc 测试代码
     * @return mixed
     */
    public function handle()
    {
        $activityId = $this->argument('activityId');

        $activityInfoKey = config('redis.prefix.activity_info') . $activityId;
        $activityAllUserIdsKey = config('redis.prefix.activity_all_user_ids') . $activityId;
        $activitySuccessUserIdsKey = config('redis.prefix.activity_success_user_ids') . $activityId;
        $redisConnection = Redis::getDefaultRedisConnection();

        $this->info('************************************* 缓存信息 *************************************');
        $activityInfoCache = $redisConnection->hgetall($activityInfoKey);
        unset($activityInfoCache['name']);
        unset($activityInfoCache['price']);
        unset($activityInfoCache['origin_price']);
        unset($activityInfoCache['updated_at']);
        $this->info('秒杀活动缓存：');
        $this->table(array_keys($activityInfoCache), [array_values($activityInfoCache)]);
        $this->info('总请求量：' . $redisConnection->get('request_num'));
        $this->info('总用户量：' . $redisConnection->scard($activityAllUserIdsKey));
        $this->info('成功用户量：' . $redisConnection->scard($activitySuccessUserIdsKey));

        $this->info('');

        $this->info('************************************* 数据库信息 *************************************');
        $activity = Activity::query()->find($activityId)->getAttributes();
        unset($activity['name']);
        unset($activity['price']);
        unset($activity['origin_price']);
        unset($activity['updated_at']);
        $product = Product::query()->find($activity['product_id'])->getAttributes();
        unset($product['cover']);
        unset($product['pics']);
        unset($product['name']);
        unset($activity['updated_at']);
        unset($activity['deleted_at']);
        $ordersNum = Order::query()->where(['activity_id' => $activityId])->count();
        $this->info('商品信息：');
        $this->table(array_keys($product), [array_values($product)]);
        $this->info('活动信息：');
        $this->table(array_keys($activity), [array_values($activity)]);
        $this->info('订单总数信息：' . $ordersNum);
        return null;
    }


}