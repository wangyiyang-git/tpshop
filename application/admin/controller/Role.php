<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;
class Role extends Controller
{

    public function show()
    {
        if(request()->isGet()){
            $data=\app\admin\model\Role::getRole();
            foreach($data as $k=>$v){
                $data[$k]['node_id']=explode(",",$v["node_id"]);
            }
            foreach($data as $ke=>$val){
                foreach($val["node_id"] as $key=>$vo){
                    $data[$ke]['node_name'][]=Db::name("node")->where(["node_id"=>$vo])->field("node_name")->select();
                }
            }

        }
        return view("show",["data"=>$data]);
    }

    public function add_role()
    {
        if(request()->isGet()){
            $arr=Db::name("node")->select();
            return view("add_role",["arr"=>$arr]);
        }
        if(request()->isPost()){
           //接值判断
            $role_name=request()->post("role_name");
            $role_content=request()->post("role_content");
            $node_id=request()->post("node_id");
            $node_id=implode(",",$node_id);
            $data=[
                "role_name"=>$role_name,
                "role_content"=>$role_content,
                "node_id"=>$node_id
            ];
            $arr=\app\admin\model\Role::add_role($data);
            if($arr){
                $this->success("添加角色成功","role/show");
            }else{
                $this->error("添加角色失败");
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