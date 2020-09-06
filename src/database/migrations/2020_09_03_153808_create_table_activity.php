<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableActivity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->unsignedInteger('product_id')->default(0)->comment('商品ID')->index();
            $table->string('name', 255)->default('')->comment('秒杀活动名称');
            $table->unsignedInteger('price')->default(0)->comment('秒杀单价，单位：分');
            $table->unsignedInteger('origin_price')->default(0)->comment('商品原单价，单位：分');
            $table->unsignedInteger('start_time')->default(0)->comment('开始时间');
            $table->unsignedInteger('end_time')->default(0)->comment('结束时间');
            $table->unsignedInteger('amount')->default(0)->comment('秒杀总数');
            $table->unsignedInteger('stock')->default(0)->comment('秒杀库存');
            $table->unsignedTinyInteger('rate')->default(0)->comment('预计秒中比例');
            $table->unsignedInteger('created_at')->default(0)->comment('创建时间');
            $table->unsignedInteger('updated_at')->default(0)->comment('更新时间');
            $table->unsignedInteger('deleted_at')->default(0)->comment('删除时间');
        });
        \Illuminate\Support\Facades\DB::statement("alter table `activity` comment '秒杀活动表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity');
    }
}
