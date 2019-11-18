<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/9
 * Time: 11:07
 */

namespace app\admin\controller;


use think\Controller;
use think\Db;

class Nav extends Base
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
        $data = Db::name('nav')->order('nsort','asc')->select();
        $count = Db::name('nav')->count();
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
        //验证规则
        $validate = validate('Nav');
        if (!$validate->scene('del')->check($data)) {
            return json(['code' => 404, 'msg' => $validate->getError()]);
        }
        $delete = Db::name('nav')->where('id',$data['id'])->delete();
        if ($delete > 0) {
            return json([
                'code' => 200,
                'msg' => '导航删除成功'
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '导航删除失败'
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
        $validate = validate('Nav');
        if (!$validate->scene('update')->check($data)) {
            return json(['code' => 404, 'msg' => $validate->getError()]);
        }
        $update = Db::name('nav')->where('id',$data['id'])
            ->update([$data['field']=>$data['value']]);
        if ($update > 0) {
            return json([
                'code' => 200,
                'msg' => '导航更新成功'
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '导航更新失败'
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
        $validate = validate('Nav');
        if (!$validate->scene('insert')->check($data)){
            return json(['code' => 404, 'msg' => $validate->getError()]);
        }
        $result = Db::table('nav')->insert($data);//返回值为int
        if ($result > 0) {
            return json([
                'code' => 200,
                'msg' => '导航插入成功'
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '导航插入失败'
            ]);
        }
    }
}