<?php

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';//表名
    protected $primaryKey = 'cate_id';//主键
    public $timestamps = false;//把update_at更新禁用


    public function tree()
    {
        $categorys = $this->all();
        return $this->getTree($categorys,'cate_name','cate_id','cate_pid');
    }


    //分类下的子分类排序   getTree(数组参数,name字段,id字段,父级id字段,默认顶级父级id)
    public function getTree($data,$file_name,$file_id='id',$file_pid='pid',$pid='0')
    {
        $arr = array();
        foreach ($data as $k=>$v){
            if ($v->$file_pid==$pid){
                $data[$k]['_'.$file_name] = $data[$k][$file_name];
                $arr[] = $data[$k];
                foreach ($data as $m=>$n){
                    if ($n->$file_pid == $v->$file_id){
                        $data[$m]['_'.$file_name] = "┣━ ".$data[$m][$file_name];
                        $arr[] = $data[$m];
                    }
                }
            }
        }
        return $arr;
    }
}
