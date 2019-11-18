<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/18
 * Time: 21:52
 */

namespace app\index\controller;


class Goods extends Base
{
    public function goods(){
        return $this->fetch();
    }

}