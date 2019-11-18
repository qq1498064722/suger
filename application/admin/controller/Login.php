<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/9
 * Time: 10:45
 */

namespace app\admin\controller;

use think\Db;
use think\Session;

class Login
{
    public function index(){
        return view();
    }
    public function check(){
        if(!request()->isPost()){
            return json([
                'code' => 404,
                'msg' => '请求方式不正确'
            ]);
        }
        //finde()拿一条数据，select()拿全部数据；
        $data = input('post.');
        $code = $data['code'];
        if(!captcha_check($code)){
            return json([
                'code' => 404,
                'msg' => '验证码不正确'
            ]);
        }
        $username = $data['username'];
        $password = crypt($data['password'],md5($data['password']));
        $result = Db::table('manage')->where(['username'=>$username,'password'=>$password])->find();
        if ($result > 0) {
            Session::set('username',$result);
            return json([
                'code' => 200,
                'msg' => '登录成功'
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '登录失败'
            ]);
        }
    }
}