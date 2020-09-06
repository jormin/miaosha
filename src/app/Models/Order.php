<?php


namespace App\Models;


/**
 * App\Models\Order
 *
 * @property int $id id
 * @property int $activity_id 秒杀活动ID
 * @property int $user_id 用户ID
 * @property int $product_id 商品ID
 * @property int $amount 购买数量
 * @property int $price 购买单价，单位：分
 * @property int $money 购买总价，单位：分
 * @property int $status 状态，-1：已取消 0：待支付 1：已支付
 * @property \Illuminate\Support\Carbon $created_at 创建时间
 * @property \Illuminate\Support\Carbon $updated_at 更新时间
 * @property \Illuminate\Support\Carbon $deleted_at 删除时间
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereActivityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 * @mixin \Eloquent
 */
class Order extends Base
{

    protected $table = 'order';

    protected $fillable = [
        'id', 'activity_id', 'user_id', 'product_id', 'amount', 'price', 'money', 'status', 'created_at', 'updated_at', 'deleted_at'
    ];

}