<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->string('id', 32)->comment('id')->primary();
            $table->unsignedInteger('activity_id')->default(0)->comment('秒杀活动ID')->index();
            $table->unsignedInteger('user_id')->default(0)->comment('用户ID')->index();
            $table->unsignedInteger('product_id')->default(0)->comment('商品ID')->index();
            $table->unsignedInteger('amount')->default(0)->comment('购买数量');
            $table->unsignedInteger('price')->default(0)->comment('购买单价，单位：分');
            $table->unsignedInteger('money')->default(0)->comment('购买总价，单位：分');
            $table->tinyInteger('status')->default(0)->comment('状态，-1：已取消 0：待支付 1：已支付');
            $table->unsignedInteger('created_at')->default(0)->comment('创建时间');
            $table->unsignedInteger('updated_at')->default(0)->comment('更新时间');
            $table->unsignedInteger('deleted_at')->default(0)->comment('删除时间');
            $table->unique(['activity_id', 'user_id', 'product_id'], 'unique_index_activity_user_product')->comment('活动ID、用户ID和商品ID联合唯一索引，单活动单用户单商品只能下一单');
        });
        \Illuminate\Support\Facades\DB::statement("alter table `activity` comment '订单表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
