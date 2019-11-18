<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/9
 * Time: 16:21
 */

namespace app\admin\controller;


use think\Session;

class Main extends Base
{
    public function _initialize()
    {
        parent::_initialize();
    }
    public  function index(){
        $username = Session::get('username');
        return view('index',['username'=>$username]);
    }
}