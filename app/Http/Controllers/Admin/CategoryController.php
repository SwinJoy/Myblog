<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends CommonController
{
    //get.admin/category  全部分类列表
    public function index()
    {
        $categorys = Category::all();
        return view('admin.category.index')->with('data',$categorys);
    }

    //post.admin/category
    public function store()
    {

    }

    //get.admin/create  添加分类
    public function create()
    {

    }

    //get.admin/category/{category}   显示单个分类信息
    public function show()
    {

    }

    //delete.admin/category/{category}
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
