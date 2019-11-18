<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/18
 * Time: 21:20
 */

namespace app\admin\validate;


use think\Validate;

class Oppim extends Validate
{
    protected $rule = [
        'aid'=>'number',
        'aname'=>'require',
        'username'=>'require',
        'sex'=>'require',
        'telephone'=>'require',
        'supp'=>'require',
        'field'=>'require',
        'value'=>'require',
    ];

    protected $scene = [
        'del'=>'aid',
        'update'=>['aid','field','value'],
    ];
}