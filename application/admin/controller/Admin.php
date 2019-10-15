<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Admin extends Controller
{

    public function show()
    {
       if(request()->isGet()){
           $data=\app\admin\model\Admin::showAdmin();
           return view("show",["data"=>$data]);
       }
    }

    public function add_admin()
    {
       if(request()->isGet()){
           $data=\app\admin\model\Role::getRole();
           return view("add_admin",["data"=>$data]);
       }
       if(request()->isPost()){
           $data=request()->post();
           $arr=[
               "admin_name"=>$data["admin_name"],
               "admin_pwd"=>$data["admin_pwd"],
               "admin_email"=>$data["admin_email"],
               "role_id"=>$data["role_id"],
           ];
           //连接模型添加数据
           $res=\app\admin\model\Admin::addAdmin($arr);
           if($res){
               echo json_encode(["status"=>1,"msg"=>"OK"]);
           }else{
               echo json_encode(["status"=>0,"msg"=>"数据添加失败"]);
           }
       }
    }

    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
