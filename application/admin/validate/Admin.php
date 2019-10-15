<?php
namespace app\admin\validate;
use think\Validate;

class Admin extends Validate
{
    protected $rule =   [
        'cate_name'  => 'require|max:15',
        'cate_alias'  => 'require|max:15',
    ];

    protected $message = [
        'cate_name.require' => '分类名称不能为空',
        'cate_name.length'  => '分类名称必须5-15位',
        'cate_alias.require'  => '分类别名不能为空',
        'cate_alias.length'  => '分类名称必须5-15位',
        'cate_kw.require'  => '分类关键字不能为空',
        'cate_des.require'  => '分类描述不能为空',
        'cate_order.require'  => '分类排序不能为空',

    ];
}
