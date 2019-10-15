<?php
/**
 * Created by PhpStorm.
 * User: 王意阳
 * Date: 2019/10/12
 * Time: 13:58
 */
namespace app\admin\controller;
use think\Controller;
use think\Cookie;
use think\Session;
class Common extends Controller{
//    public  function __construct()
//    {
//        parent::__construct();
//        if(\think\facade\Cookie::has("admin") && empty(Session::get("admin"))){
//            \think\facade\Session::has("admin",Cookie::get("admin"));
//        }
//        if(empty(Session::get("admin"))|| empty(Cookie::get("admin"))){
//            $this->success("请先登录",url("login/login"));
//        }
//
//    }
}