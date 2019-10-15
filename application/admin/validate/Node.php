<?php
namespace app\admin\validate;
use think\Validate;

class Node extends Validate
{
    protected $rule = [
        'node_name'  =>  'require|unique:node',
        'node_action'  =>  'require|unique:node',
        'node_url'  =>  'require|unique:node',
    ];
    protected $message = [
        'cate_name.require' => '权限名称不能为空',
        'cate_name.length'  => '权限名称必须5-15位',
        'node_action.require' => '权限方法不能为空',
        'node_url.require' => '权限URL不能为空',
    ];
}