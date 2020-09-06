<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id')->comment('商品ID');
            $table->unsignedInteger('price')->default(0)->comment('单价，单位：分');
            $table->string('name', 255)->default('')->comment('商品名称');
            $table->string('cover', 255)->default('')->comment('封面图');
            $table->string('pics', 1000)->default('')->comment('图片列表');
            $table->integer('sale')->default(0)->comment('销量');
            $table->integer('stock')->default(0)->comment('库存');
            $table->unsignedInteger('created_at')->default(0)->comment('创建时间');
            $table->unsignedInteger('updated_at')->default(0)->comment('更新时间');
            $table->unsignedInteger('deleted_at')->default(0)->comment('删除时间');
        });
        \Illuminate\Support\Facades\DB::statement("alter table `product` comment '商品表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
