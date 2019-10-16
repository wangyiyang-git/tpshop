<?php
namespace app\admin\controller;
use app\admin\service\AdminService;
use think\Controller;
use think\facade\Cookie;
use think\facade\Session;
use think\facade\View;

class Common extends Controller{
    public function __construct(){
        parent::__construct();
        if(Cookie::get('admin')&&!Session::get("admin")){
            $data=Cookie::get('admin');
            Session::set('admin',$data);
        }
        if(!Session::get("admin")){
            $this->success("非法登录","login/login");
        }
        //检查权限，有权限继续执行，
        if(!$this->checkNode()){
            if(request()->isAjax()){
                return ["status"=>-1,"msg"=>"没有权限操作"];
            }else{
                $this->success("你没有权限操作",'Index/index');
            }
        }
        $adminService=new AdminService();
        $node=$adminService->getNodeAdminId(Session::get("admin")["admin_id"]);
        $menu=$adminService->getleft();
        //dump($menu);
        $menu=$adminService->getleftTree($menu);
       // dump($menu);
//        exit;
        View::share("menu",$menu);
    }
    //false 没有权限，true 有权限
    public function checkNode(){
        //从session里边取到当前的管理员
        $userAdmin=Session::get("admin");
        //检测当前登录用户是否是超级管理员做判断
        //in_array() 函数搜索数组中是否存在指定的值。
        if(in_array($userAdmin["admin_name"],config("web.super_admin"))){
            return true;
        }
        //如果不是超级管理员检测权限，获取要访问的控制器和方法，进行拼接
        $Route=ucfirst(strtolower(request()->controller()))."/".strtolower(request()->action());
        //一些控制器和方法是所有人都可以看得，所以不需要设置权限，判断一下
        if(in_array($Route,config("web.no_check_action"))){
            return true;
        }
        //获取当前登录用户拥有的权限并进行判断
        $mynode=(new AdminService())->getNodeAdminId(Session::get("admin")["admin_id"]);
        if(in_array($Route,$mynode)){
            return true;
        }else{
            return false;
        }
    }
}
