<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/14
 * Time: 16:58
 */

namespace app\index\controller;


use think\Db;

class Category extends Base
{
    public function index(){
        $nid = $this->request->get('nid');
        $currnav = Db::table('nav')->where('id',$nid)->find();
        $tpl = $currnav['ntpl'];
        $this->assign('nid',$nid);
        $this->assign('title',$currnav['nname']);
        $this->assign('currnav',$currnav);
        //新闻列表查询
        $news = Db::table('news')->order('wid','asc')->select();
        $this->assign('news', $news);
        //产品中心
        $category = Db::table('category')->select();
        //添加一个新的数据‘全部’
        $cate1=[["id"=>'0',"cname"=>"全部",'cid'=>'-1']];
        //连接两个，形成新的关联数组。
        $cate=array_merge($cate1,$category);
        $this->assign('cate', $cate);

        $goods = Db::table('goods')->select();
        //$data数据库goods表数据
        $count=count($cate);
        //分类的数量
        for($i=0;$i<$count;$i++){
            if($i==0){
        //如果是$i=0,即为分类中的全部，则显示全部的数据
                $datas[$i]=$goods;
                continue;
            }
            $keys=$cate[$i];
            $id=$keys['id'];
            $all=array_filter($goods,function($v) use($id){
                return $v['cid']==$id;
            });
            $datas[$i]=$all;
        }
        $this->assign('datas', $datas);
        return $this->fetch($tpl);
    }
    public function goods(){
        $this->assign('nid',31);
        $this->assign('title','产品');
        $gid = $this->request->get('gid');
        $goods = Db::table('goods')->where('gid',$gid)->find();
        $banner = explode(',',$goods['gbanner']);
        $this->assign('goods',$goods);
        $this->assign('banner',$banner);
        return $this->fetch();
    }
    public function news(){
        $this->assign('nid',6);
        $this->assign('title','新闻');
        $wid = $this->request->get('wid');
        $news = Db::table('news')->where('wid',$wid)->find();
        $this->assign('news',$news);
        $jumpt = Db::table('news')->where('wid','<',$wid)->order('wid','desc')->limit(0,1)->find();
        $this->assign('jumpt',$jumpt);
        $jumpb = Db::table('news')->where('wid','>',$wid)->order('wid','asc')->limit(0,1)->find();
        $this->assign('jumpb',$jumpb);
        return $this->fetch();
    }

}