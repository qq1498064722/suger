<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/15
 * Time: 16:00
 */

namespace app\admin\controller;


use think\Db;

class News extends Base
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
        $data = Db::name('news')->order('wid','asc')->select();
        $count = Db::name('news')->count();
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
        $delete = Db::name('news')->where('wid',$data['wid'])->delete();
        if ($delete > 0) {
            return json([
                'code' => 200,
                'msg' => '新闻删除成功'
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '新闻删除失败'
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
        $update = Db::name('news')->where('wid',$data['wid'])
            ->update([$data['field']=>$data['value']]);
        if ($update > 0) {
            return json([
                'code' => 200,
                'msg' => '新闻更新成功'
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '新闻更新失败'
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
        $data['wtime'] = date('Y-m-d h:m:s');
        //验证  请求方式  参数
        $method = $this->request->method();
        if ($method != 'POST') {
            return json(['code' => 404, 'msg' => '请求方式错误']);
        }
        //验证规则
        $validate = validate('News');
        if (!$validate->scene('insert')->check($data)){
            return json(['code' => 404, 'msg' => $validate->getError()]);
        }
        $result = Db::table('news')->insert($data);//返回值为int
        if ($result > 0) {
            return json([
                'code' => 200,
                'msg' => '新闻插入成功'
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '新闻插入失败'
            ]);
        }
    }
}