<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class Node extends Model
{
    protected $pk="node_id";
    public static function getAllnodes(){
        return Db("node")->select();
    }
    public static function getNode($nodes,$pid=0,$level=0){
        static $orderNode=[];
        foreach($nodes as $key=>$val){
            if($val["node_pid"]==$pid){
                $val["level"]=$level;
                $orderNode[]=$val;
                Node::getNode($nodes,$val["node_id"],$level+1);
            }
        }
        return $orderNode;
    }
   //根据id查询所有的权限



}