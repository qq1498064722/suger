<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/15
 * Time: 23:21
 */

namespace app\index\controller;


use think\Db;

class News extends Base
{
    public function index(){
        $news = Db::table('news')->order('wid','asc')->select();
        $this->assign('news', $news);
        return $this->fetch();
    }
}