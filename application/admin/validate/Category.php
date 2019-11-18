<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/11
 * Time: 16:51
 */

namespace app\admin\validate;


use think\Validate;

class Category extends Validate
{
    protected $rule = [
        'cname'=>'require',
    ];

}