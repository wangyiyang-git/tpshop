<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class Cate extends Model
{
    protected $pk="cate_id";
    public static function getAllCates(){
        return Db("cate")->select();
    }
    public static function getCate($cates,$pid=0,$level=0){
        static $orderCate=[];
        foreach($cates as $key=>$val){
            if($val["cate_pid"]==$pid){
                $val["level"]=$level;
                $orderCate[]=$val;
                Cate::getCate($cates,$val["cate_id"],$level+1);
            }
        }
        return $orderCate;
    }
    //添加数据
    public static function addCate($data){
        return self::insert($data);
    }
    //修改查数据数据
    public static function upCate($data){
        return self::find($data);
    }
    //修改整条数据
    public static function updateCate($data){
        return self::update($data);
    }

}