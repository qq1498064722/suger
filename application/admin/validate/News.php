<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 2019/10/10
 * Time: 16:15
 */
namespace app\admin\validate;
use think\Validate;

class News extends Validate
{
    protected $rule = [
        'wid'=>'number',
        'wname'=>'require',
        'wdetail'=>'require',
        'field'=>'require',
        'value'=>'require',
    ];

    protected $scene = [
      'insert' =>['wname','wdetail'],
      'del'=>'wid',
      'update'=>['wid','field','value'],
    ];
}