<?php

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';//表名
    protected $primaryKey = 'cate_id';//主键
    public $timestamps = false;//把update_at更新禁用
}
