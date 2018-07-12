<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class CategoryController extends CommonController
{
    //get.admin/category  全部分类列表
    public function index()
    {
        $categorys = (new Category)->tree();
//        dd($categorys);
//        $data = $this->getTree($categorys,'cate_name','cate_id','cate_pid');

        return view('admin.category.index')->with('data',$categorys);
    }

    //得到分类下的子分类   先通过foreach遍历category表下的$data数据，通过值$v下的cate_pid字段等于0分出大分类，把键$data[$k]放进$arr数组中
    //再通过foreach遍历遍历category表下的$data数据，通过值$n下的cate_pid字段等于大分类的值$v下的cate_id字段分出子分类，把子分类排到大分类后面
//    public function getTree($data)
//    {
//        $arr = array();
//       foreach ($data as $k=>$v){
//           if ($v->cate_pid==0){
//               $data[$k]['_cate_name'] = $data[$k]['cate_name'];
//               $arr[] = $data[$k];
//               foreach ($data as $m=>$n){
//                   if ($n->cate_pid == $v->cate_id){
//                       $data[$m]['_cate_name'] = "┣━ ".$data[$m]['cate_name'];
//                       $arr[] = $data[$m];
//                   }
//               }
//           }
//       }
//      return $arr;
//    }


    public function changeOrder()
    {
        $input = Input::all();
        $cate = Category::find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];
        $result = $cate->update();
        if ($result){
            $data = [
                'status'=>1,
                'msg'=>'分类排序更新成功！'
            ];
        }else{
            $data = [
                'status'=>0,
                'msg'=>'分类排序更新失败，请稍后重试！'
            ];
        }
        return $data;
    }

    //get.admin/create  添加分类
    public function create()
    {
        $data = Category::where('cate_pid',0)->get();
        return view('admin/category/add',compact('data'));
    }

    //post.admin/category  添加分类提交
    public function store()
    {
        $input = Input::all();
        dd($input);
    }

    //get.admin/category/{category}   显示单个分类信息
    public function show()
    {

    }

    //delete.admin/category/{category}   删除单个分类
    public function destory()
    {

    }

    //put.admin/category  更新分类
    public function update()
    {

    }

    //get.admin/category/{category}/edit  编辑分类
    public function edit()
    {

    }
}
