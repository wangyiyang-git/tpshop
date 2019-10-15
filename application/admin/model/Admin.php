<?php

namespace app\admin\model;

use think\Model;

class Admin extends Model
{
    protected $pk="admin_id";
    public static function addAdmin($data){
        return self::insert($data);
    }
    public static function showAdmin(){
        return self::select();
    }
}
