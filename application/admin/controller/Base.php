<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/14
 * Time: 11:18
 */

namespace app\admin\controller;


use think\Controller;
use think\Session;

class Base extends Controller
{
public function _initialize()
{
    parent::_initialize();
    if(!Session::has('username')){
        $this->error('请登录','admin/login/index');
        exit();

    }
}
}