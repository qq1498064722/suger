<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/11
 * Time: 11:07
 */

namespace app\admin\controller;


use think\Controller;
use think\Db;

class Goods extends Base
{
    public function _initialize()
    {
        parent::_initialize();
    }

    public function openinsert()
    {
        $cate = Db::table('category')->order('id', 'asc')->select();
        $this->assign('cates', $cate);
        return $this->fetch();
    }

    public function insert()
    {
        $data = input('post.');
        //验证  请求方式  参数
        $method = $this->request->method();
        if ($method != 'POST') {
            return json(['code' => 404, 'msg' => '请求方式错误']);
        }
//        //验证规则
//        $validate = validate('Nav');
//        var_dump($validate->check($data));
//        if (!$validate->check($data)) {
//            return json(['code' => 404, 'msg' => $validate->getError()]);
//        }
        $data['create_time'] = date('Y-m-d h:m:s');
        $result = Db::table('goods')->insert($data);//返回值为int
        if ($result > 0) {
            return json([
                'code' => 200,
                'msg' => '商品插入成功'
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '商品插入失败'
            ]);
        }
    }

    public function index()
    {

        $cate = Db::table('category')->order('id', 'asc')->select();
        $this->assign('cates', $cate);
        return $this->fetch();
    }

    public function query()
    {
        //要返回两个数据1.总数
        //2.当前页的数据 select * from goods order by gid asc limit

        //搜索条件可能有也可能没有：默认没有；点击搜索条按钮有条件；
        $qs = $this->request->get();

        $where = [];
        if (isset($qs['cid']) && !empty($qs['cid'])) {
            $where['cid '] = [$qs['cid']];
        }
        if (isset($qs['gname']) && !empty($qs['gname'])) {
            $words = $qs['gname'];
            $where['gname'] = ['like', '%' . $words . '%'];
        }
//        if (isset($qs['price_min']) && isset($qs['price_max']) && ($qs['price_min'] < $qs['price_max'])) {
//            $where['gsale'] = array('egt', $qs['price_min']);
//            $where['gsale'] = array('elt', $qs['price_max']);
//        }
        if(isset($qs['price_min'])&&(!empty($qs['price_min']))&&isset($qs['price_max'])&&(!empty($qs['price_max']))&&($qs['price_min']<$qs['price_max'])){
//            $where['sale']=array('egt',$qs['price_min']);
//            $where['sale']=array('elt',$qs['price_max']);
            $where['gsale' ]=array('between' , [$qs['price_min' ], $qs['price_max']]) ;
        }
        $page = $qs['page'];
        $limit = $qs['limit'];
        $offset = ($page - 1) * $limit;
        $count = Db::table('goods')->where($where)->count();
        $data = Db::table('goods')->where($where)->limit($offset, $limit)->select();
//        $data = Db::table('goods')->select();
//        $count = Db::name('goods')->count();
        return ([
            'code' => 0,
            'msg' => '商品查询成功',
            'data' => $data,
            'count' => $count
        ]);
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
        $validate = validate('Goods');
        if (!$validate->scene('update')->check($data)) {
            return json(['code' => 404, 'msg' => $validate->getError()]);
        }
        $update = Db::name('goods')->where('gid', $data['gid'])
            ->update([$data['field'] => $data['value']]);
        if ($update > 0) {
            return json([
                'code' => 200,
                'msg' => '商品更新成功'
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '商品更新失败'
            ]);
        }
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
        $validate = validate('Goods');
        if (!$validate->scene('del')->check($data)) {
            return json(['code' => 404, 'msg' => $validate->getError()]);
        }
        $delete = Db::name('goods')->where('gid', $data['gid'])->delete();
        if ($delete > 0) {
            return json([
                'code' => 200,
                'msg' => '商品删除成功'
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '商品删除失败'
            ]);
        }
    }
}