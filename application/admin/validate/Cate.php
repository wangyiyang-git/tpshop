<?php
namespace app\admin\validate;
use think\Validate;

class Cate extends Validate
{
    protected $rule = [
        'cate_name'  =>  'require|unique:cate',
        'cate_order' =>  'require|integer'
    ];
    protected $message = [
        'cate_name.require' => '分类名称不能为空',
        'cate_name.length'  => '分类名称必须5-15位',
        'cate_order.require'=> '分类顺序不能为空',
        'cate_order.integer'=> '分类顺序必须为整数',
    ];
}