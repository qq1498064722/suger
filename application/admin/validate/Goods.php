<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/11
 * Time: 13:41
 */

namespace app\admin\validate;


use think\Validate;

class Goods extends Validate
{
    protected $rule = [
        'gid'=>'number',
        'gname'=>'require',
        'gmprice'=>'number',
        'gsale'=>'number',
        'gstock'=>'number',
        'gdetail'=>'require',
        'field'=>'require',
        'value'=>'require',
    ];

    protected $scene = [
        'insert' =>['gid','gname','gmprice','gsale','gstock','gdetail',],
        'del'=>'gid',
        'update'=>['gid','field','value'],
    ];
}