<?php


namespace App\Console\Commands;


use App\Models\Activity;
use App\Services\BuyService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class Test extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '测试';

    /**
     * Execute the console command.
     *
     * @desc 测试代码
     * @return mixed
     */
    public function handle()
    {
        for ($i = 0; $i < 10000; $i++) {
            $userId = rand(0, 1000000);
            $buyService = new BuyService();
            $response = $buyService->buy(1, $userId);
            var_dump($response);
        }
    }


}