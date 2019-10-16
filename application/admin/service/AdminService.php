<?php

namespace app\admin\service;
use app\admin\model\Admin;
use app\admin\model\AdminRole;
use app\admin\model\Node;
use app\admin\model\Role;
use think\facade\Session;
class AdminService{
    public function getNodeAdminId($admin_id){
        $adminRoleModel=new AdminRole();
        //因为中交表没有id根据admin——id查询//获取某一个字段column
        $role_id=$adminRoleModel->where("admin_id",$admin_id)->column("role_id");
        //连接role查询角色
        $roleModel=new Role();
        $role=$roleModel->all($role_id);
        //定义一个空数组
        $node=[];
        //因为查询出来是是一个二维数组所以循环再查询node表查询出所有的权限
        foreach($role as $key=>$val){
            //array_merge() 函数把两个或多个数组合并为一个数组。
            $node=array_merge($node,$val->node->toArray());
        }
        //定义一个空数组
        $node_url=[];
        //将查询出来的权限二维数组循环，然后用array_push将控制器与方法名进行拼接放在空数组中
        foreach($node as $key=>$val){
            //ucfirst() 函数把字符串中的首字符转换为大写。//strtolower() 函数把字符串转换为小写。
            array_push($node_url,ucfirst(strtolower($val["node_controller"]))."/".strtolower($val["node_action"]));
        }
        $node_url=array_unique($node_url);
//        var_dump($node_url);
//        exit;
        return $node_url;
    }
    //取左侧菜单
    public function getLeft(){
        $admin_name=Session::get("admin")["admin_name"];
        //in_array() 函数搜索数组中是否存在指定的值。
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
        //dump($menu);
        return $menu;
    }
    public function getLeftTree($menu,$pid=0){
        $menuTree=[];
        foreach($menu as $key=>$val){
            if($val["node_pid"]==$pid){
                if($son=$this->getLeftTree($menu,$val['node_id'])){
                    $val["son"][]=$son;
                }
                $menuTree[]=$val;
            }

        }
        //dump($menuTree);

        return $menuTree;
    }

}