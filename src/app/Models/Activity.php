<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Activity
 *
 * @property int $id ID
 * @property int $product_id 商品ID
 * @property string $name 秒杀活动名称
 * @property int $price 秒杀单价，单位：分
 * @property int $origin_price 商品原单价，单位：分
 * @property int $start_time 开始时间
 * @property int $end_time 结束时间
 * @property int $amount 秒杀总数
 * @property int $stock 秒杀库存
 * @property int $rate 预计秒中比例
 * @property \Illuminate\Support\Carbon $created_at 创建时间
 * @property \Illuminate\Support\Carbon $updated_at 更新时间
 * @property \Illuminate\Support\Carbon $deleted_at 删除时间
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity query()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereOriginPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Activity extends Base
{

    protected $table = 'activity';

    protected $fillable = [
        'id', 'product_id', 'name', 'price', 'origin_price', 'start_time', 'end_time', 'amount', 'stock', 'rate', 'created_at', 'updated_at', 'deleted_at'
    ];

}