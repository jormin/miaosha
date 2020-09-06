<?php


namespace App\Models;


use App\Traits\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

abstract class Base extends Model
{

    // 开启软删除
    use SoftDeletes;

    // 设置时间格式为时间戳
    protected $dateFormat = 'U';

    // 时间字段
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

}