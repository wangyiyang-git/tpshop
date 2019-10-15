<?php
/**
 * Created by PhpStorm.
 * User: 王意阳
 * Date: 2019/10/12
 * Time: 11:20
 */namespace app\admin\controller;
use app\admin\model\Log;
use think\Controller;
use think\Db;
use think\facade\Cookie;
use think\facade\Session;
class Login extends Controller{
    public function login()
    {
        if (request()->isGet()) {
            return $this->fetch();
        }
        if (request()->isPost()){
           //接值判断
            $admin_name=request()->post("admin_name");
            $admin_pwd=request()->post("admin_pwd");
            $save=request()->post("save");
//            echo md5(md5($admin_pwd)."7103");
//            exit;
            //连接数据库判断用户名密码是否正确
            $admin=Db("admin")->where(["admin_name"=>$admin_name])->find();
            if($admin){
                if(md5(md5($admin_pwd).$admin['admin_salf'])==$admin['admin_pwd']){
                    //存session
                    if($save==1){
                        Cookie::set("admin",$admin,7*24*3600,"/");
                    }
                    Session::set('admin',["admin_id"=>$admin['admin_id'],"admin_name"=>$admin['admin_name']]);
                        //写日志
                        $data["log_content"]="【".$admin_name."】成功登录商城后台";
                        $data["log_time"]=time();
                        $data["admin_name"]=$admin_name;
                        $data["admin_id"]=Session::get("admin")['admin_id'];
                        $data["admin_ip"]=$_SERVER['REMOTE_ADDR'];
                        Log::addLog($data);
                    $this->success('登录成功',url('index/index'));
                }else
                    $this->error("密码错误");
                }
            }else{
                $this->error("用户名错误");
            }

        }


    //退出登录
    public function loginout(){
        Session::delete("admin");
        Cookie::delete("admin");
        $this->success("退出成功",url('login/login'));
    }




}