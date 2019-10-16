<?php

namespace app\admin\service;
use app\admin\model\Admin;
use app\admin\model\AdminRole;
use app\admin\model\Node;
use app\admin\model\Role;
use think\facade\Session;
class AdminService{
    public function getNodeByAdminId($admin_id){
        $adminRoleModel=new AdminRole();
        //因为中交表没有id根据admin——id查询//获取某一个字段column
        $role_id=$adminRoleModel->where("admin_id",$admin_id)->column("role_id");
        $roleModel=new Role();
        $role=$roleModel->all($role_id);
        $mynode=[];
        foreach($role as $key=>$val){
            $mynode=array_merge($mynode,$val->node->toArray());
        }
        $myaccess=[];
        foreach($mynode as $key=>$val){
            array_push($myaccess,ucfirst(strtolower($val["node_controller"]))."/".strtolower($val["node_action"]));
        }
        $myaccess=array_unique($myaccess);
        return $myaccess;
    }
    //取左侧菜单
    public function getMenu(){
        $admin_name=Session::get("admin")["admin_name"];
        if(in_array($admin_name,config("web.super_admin"))){
            //取所有的权限
            $menu=(new Node())->where("node_left",1)->all()->toArray();
        }else{
            $admin_id=Session::get("admin")["admin_id"];
            $adminModel=new Admin();
            $admin=$adminModel->get($admin_id);
            $menu=[];
            foreach($admin->role as $key=>$val){
                $menu=array_merge($menu,$val->node->where("node_left",1)->toArray());
            }
            //去重未实现

        }
        return $menu;
    }
    public function getMenuTree($menu,$pid=0){
        $menuTree=[];
        foreach($menu as $key=>$val){
            if($val["node_pid"]==$pid){
                if($son=$this->getMenuTree($menu,$val['node_id'])){
                    $val["son"][]=$son;
                }
                $menuTree[]=$val;
            }
        }
        return $menuTree;
    }

}