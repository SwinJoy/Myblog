<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';//表名
    protected $primaryKey = 'user_id';//主键
    public $timestamps = false;//把update_at更新禁用
}
