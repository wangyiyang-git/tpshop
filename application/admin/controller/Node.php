<?php

namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
class Node extends Controller
{

    public function show()
    {
        $nodes = \app\admin\model\Node::getAllnodes();
        $nodeorder = \app\admin\model\Node::getNode($nodes);
        return view('show',["data"=>$nodeorder]);
    }

    public function add_node()
    {
        if(request()->isGet()){
            $nodes = \app\admin\model\Node::getAllnodes();
            $nodeorder = \app\admin\model\Node::getNode($nodes);
            return view('add_node',["data"=>$nodeorder]);
        }
        if(request()->isPost()){
            if (request()->isPost()) {
                //接值判断添加入库
                $data= request()->post();
                $result=$this->validate($data,'app\admin\validate\Node');
                if($result!==true){
                    $this->error($result);
                }
            }
//        var_dump($data);
//        exit;
            //入库
            $data = ['node_name'=>$data["node_name"], 'node_pid'=> $data["node_pid"],'node_left'=>$data["node_left"],'node_controller'=>$data["node_controller"],'node_action'=>$data["node_action"],'node_url'=>$data["node_url"]];
            if(Db::name('node')->data($data)->insert()){
                $this->success('添加权限成功',url('node/show'));
            }else{
                $this->error("添加权限失败");
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


    public function update(Request $request, $id)
    {
        //
    }

    public function delete($id)
    {
        //
    }
}
