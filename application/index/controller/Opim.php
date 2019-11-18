<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/15
 * Time: 22:01
 */

namespace app\index\controller;


use think\Db;

class Opim extends Base
{
    public function insert(){
        //获取前台数据
        $data = input('post.');
        $code = $data['code'];
        if(!captcha_check($code)){
            return json([
                'code' => 404,
                'msg' => '验证码不正确'
            ]);
        }
        //截取code
        unset($data['code']);
        //验证  请求方式  参数
        $method = $this->request->method();
        if ($method != 'POST') {
            return json(['code' => 404, 'msg' => '请求方式错误']);
        }
        $result = Db::table('appointment')->insert($data);//返回值为int
        if ($result > 0) {
            return json([
                'code' => 200,
                'msg' => '恭喜您！预约成功'
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '预约失败'
            ]);
        }
    }

}