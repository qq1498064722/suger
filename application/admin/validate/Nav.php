<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/10
 * Time: 16:15
 */
namespace app\admin\validate;
use think\Validate;

class Nav extends Validate
{
    protected $rule = [
        'id'=>'number',
        'nname'=>'require',
        'ename'=>'require',
        'nsort'=>'number',
        'ntpl'=>'require',
        'field'=>'require',
        'value'=>'require',
    ];

    protected $scene = [
      'insert' =>['nname','ename','nsort','ntpl'],
      'del'=>'id',
      'update'=>['id','field','value'],
    ];
}