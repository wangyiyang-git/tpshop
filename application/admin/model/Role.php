<?php

namespace app\admin\model;
use think\Db;
use think\Model;

class Role extends Model
{
    protected $pk="role_id";
    public static function add_role($data){
       return self::insert($data);

    }
    //取所有的数据展示
    public static function getRole(){
        return self::select()->toArray();
    }
    //关联模型
    public function node(){
        return $this->belongsToMany("Node",'role_node',"node_id","role_id");
    }
}
