<?php

namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;

class Admin extends Common
{

    public function show()
    {
       if(request()->isGet()){
           $admin=new \app\admin\model\Admin();
           $data=$admin->all();
//           dump($data);
//           foreach($data as $kal=>$val){
//
//                   dump($val->role);
//
//           }
//           exit;
           return view("show",["admin"=>$data]);
       }
    }

    public function add_admin()
    {
       if(request()->isGet()){
           $data=\app\admin\model\Role::getRole();
           return view("add_admin",["data"=>$data]);
       }
        if(request()->isPost()){
            $adminModel=new \app\admin\model\Admin();
            $adminModel->admin_name=request()->post("admin_name");
            $adminModel->admin_salf=$admin_salf=substr(uniqid(),-4);
            $adminModel->admin_pwd=md5(md5(request()->post("admin_pwd")).$admin_salf);
            $adminModel->admin_add_time=time();
            $adminModel->save();
            $adminModel->role()->saveAll(request()->post("role_id"));
            $this->success("添加管理员成功",'admin/show');
        }
    }


    public function delAdmin()
    {
        //接值判断删除
        $id=request()->get("admin_id",0);
        var_dump($id);
        if($id==0){
            $this->error("非法请求");
        }
        //连库删除
//        $admin=new \app\admin\model\Admin();
//        $admin->get($id);
//        $admin->delete();
        $res=\app\admin\model\Admin::destroy($id);
        if($res){
            echo json_encode(["status"=>1,"msg"=>"OK"]);
        }else{
            echo json_encode(["status"=>0,"msg"=>"数据删除失败"]);
        }
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
