<?php


namespace App\Console\Commands;


use App\Models\Activity;
use App\Models\Order;
use App\Models\Product;
use App\Services\BuyService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class Mock extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '模拟测试';

    /**
     * Execute the console command.
     *
     * @desc 测试代码
     * @return mixed
     */
    public function handle()
    {
        $redisConnection = \App\Libs\Redis::getDefaultRedisConnection();
        $this->info('清理旧数据');
        $redisConnection->flushall();
        \Schema::dropIfExists('activity');
        \Schema::dropIfExists('product');
        \Schema::dropIfExists('order');
        \Schema::dropIfExists('migrations');
        \Schema::dropIfExists('jobs');
        \Schema::dropIfExists('failed_jobs');
        // 生成数据表
        $this->info('生成数据表');
        $this->call('migrate');
        // 添加模拟数据
        $this->info('添加模拟数据');
        $this->call('db:seed');
        // 处理缓存数据
        $this->info('清理缓存数据');
        $redisConnection->flushall();
        $this->info('写入秒杀活动缓存');
        $activity = Activity::query()->first()->getAttributes();
        $activityInfoKey = config('redis.prefix.activity_info') . $activity['id'];
        $redisConnection->set($activityInfoKey, json_encode($activity));
        $this->info('模拟测试准备完成');
    }


}