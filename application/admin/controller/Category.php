<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/11
 * Time: 15:36
 */

namespace app\admin\controller;


use think\Controller;
use think\Db;

class Category extends Base
{
    public function _initialize()
    {
        parent::_initialize();
    }
    //查看导航
    public function index()
    {
        return $this->fetch();
    }

    public function query()
    {

        $data = Db::name('category')->order('id','asc')->select();
        $count = Db::name('category')->count();
        return([
            'code'=>0,
            'msg'=>'success',
            'data'=>$data,
            'count'=>$count
        ]);
    }
    public function delete()
    {
        $data = input('post.');

//        var_dump($data);
        //验证请求方式
        $method = $this->request->method();
        if ($method != 'POST') {
            return json(['code' => 404, 'msg' => '请求方式错误']);
        }
        $delete = Db::name('category')->where('id',$data['id'])->delete();
        if ($delete > 0) {
            return json([
                'code' => 200,
                'msg' => '分类删除成功'
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '分类删除失败'
            ]);
        }
    }
    public function update()
    {
        $data = input('post.');
        //验证请求方式
        $method = $this->request->method();
        if ($method != 'POST') {
            return json(['code' => 404, 'msg' => '请求方式错误']);
        }
        //验证规则
//        $validate = validate('Nav');
//        if (!$validate->scene('update')->check($data)) {
//            return json(['code' => 404, 'msg' => $validate->getError()]);
//        }
        $update = Db::name('category')->where('id',$data['id'])->update([$data['field']=>$data['value']]);
        if ($update > 0) {
            return json([
                'code' => 200,
                'msg' => '分类更新成功'
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '分类更新失败'
            ]);
        }
    }

    //打开添加的页面
    public function openinsert()
    {
        return view();
    }

    //插入逻辑
    public function insert()
    {
        //获取前台数据
        $data = input('post.');
        //验证  请求方式  参数
        $method = $this->request->method();
        if ($method != 'POST') {
            return json(['code' => 404, 'msg' => '请求方式错误']);
        }
        //验证规则
        $validate = validate('Category');
        if (!$validate->check($data)) {
            return json(['code' => 404, 'msg' => $validate->getError()]);
        }
        $result = Db::table('category')->insert($data);//返回值为int
        if ($result > 0) {
            return json([
                'code' => 200,
                'msg' => '分类插入成功'
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '分类插入失败'
            ]);
        }
    }
}