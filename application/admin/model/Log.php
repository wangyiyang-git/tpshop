<?php

namespace app\admin\model;
use think\Model;

class Log extends Model
{
    protected $pk="Log_id";
    public static function addLog($data){
        return self::insert($data);
    }
}
