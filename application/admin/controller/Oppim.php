<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/18
 * Time: 21:07
 */

namespace app\admin\controller;


use think\Db;

class Oppim extends Base
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
        $data = Db::name('appointment')->order('aid','asc')->select();
        $count = Db::name('appointment')->count();
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

        //验证请求方式
        $method = $this->request->method();
        if ($method != 'POST') {
            return json(['code' => 404, 'msg' => '请求方式错误']);
        }
        //验证规则
        $validate = validate('News');
        if (!$validate->scene('del')->check($data)) {
            return json(['code' => 404, 'msg' => $validate->getError()]);
        }
        $delete = Db::name('appointment')->where('aid',$data['aid'])->delete();
        if ($delete > 0) {
            return json([
                'code' => 200,
                'msg' => '预约删除成功'
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '预约删除失败'
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
        $validate = validate('News');
        if (!$validate->scene('update')->check($data)) {
            return json(['code' => 404, 'msg' => $validate->getError()]);
        }
        $update = Db::name('appointment')->where('aid',$data['aid'])
            ->update([$data['field']=>$data['value']]);
        if ($update > 0) {
            return json([
                'code' => 200,
                'msg' => '预约更新成功'
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '预约更新失败'
            ]);
        }
    }

    //打开添加的页面
    public function openinsert()
    {
        return view();
    }
}