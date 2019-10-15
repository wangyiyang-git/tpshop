<?php
/**
 * Created by PhpStorm.
 * User: 王意阳
 * Date: 2019/10/12
 * Time: 16:52
 */
namespace app\admin\controller;
use app\admin\model\Cate;
use think\Controller;
use think\Db;
use think\facade\Session;
class ProductCategory extends Common{
    //查询顶级分类的
    public function productcategory(){
        $cates = Cate::getAllCates();
        $cateorder = Cate::getCate($cates);
        return view('productcategory',["data"=>$cateorder]);
    }
    //添加分类
    public function add_productcategory()
    {
        //展示所有分类
        if (request()->isGet()) {
            $cates = Cate::getAllCates();
            $cateorder = Cate::getCate($cates);
            return view("", ["data" => $cateorder]);
        }
        if (request()->isPost()) {
            //接值判断添加入库
            $data= request()->post();
            $result=$this->validate($data,'app\admin\validate\Cate');
            if($result!==true){
                $this->error($result);
            }
        }
//        var_dump($data);
//        exit;

        //入库
        $data = ['cate_name'=>$data["cate_name"], 'cate_alias'=> $data["cate_alias"],'cate_kw'=>$data["cate_kw"],'cate_des'=>$data["cate_des"],'cate_order'=>$data["cate_order"],'cate_pid'=>$data["cate_pid"]];
        if(Cate::addCate($data)){
            $this->success('添加分类成功',url('productcategory/productcategory'));
        }else{
            $this->error("添加分类失败");
        }
    }
    //分类修改
    public function up_productcategory(){
        if(request()->isGet()){
            //接值展示
           $cate_id=request()->get("cate_id",0);
           if($cate_id==0){
               $this->error("非法请求");
           }
           //连库查数据
            $arr=Cate::upCate($cate_id);
           $cates = Cate::getAllCates();
           $cateorder = Cate::getCate($cates);
           return view('up_productcategory',["arr"=>$arr,"data"=>$cateorder]);
        }
        if (request()->isPost()) {
            $cates=request()->post();
            //判断
            if(empty($cates["cate_name"])){
                $this->error("添加分类名称不能为空");
            }
            if(empty($cates["cate_order"])){
                $this->error("添加分类顺序不能为空");
            }
            //修改数据库数据
            $data1=['cate_name'=>$cates["cate_name"],'cate_order'=>$cates["cate_order"],'cate_status'=>$cates["cate_status"],'cate_alias'=>$cates["cate_alias"],'cate_kw'=>$cates["cate_kw"],'cate_des'=>$cates["cate_des"],'cate_pid'=>$cates["cate_pid"]];
            $arr=Db::name('cate')->where(['cate_id'=>$cates["cate_id"]])->update($data1);
            if($arr){
                //写日志
                $data["log_content"]="成功修改【".$cates["cate_name"]."】分类";
                $data["log_time"]=time();
                $data["admin_name"]=Session::get("admin")['admin_name'];
                $data["admin_id"]=Session::get("admin")['admin_id'];
                $data["admin_ip"]=$_SERVER['REMOTE_ADDR'];
                Db::table("log")->insert($data);
                $this->success("修改成功","productcategory/productcategory");
            }else{
                $this->error("修改失败");
            }
        }
    }
    //修改状态
    public function status_productcategory(){
        //接值判断
        $data=request()->post();
        var_dump($data);
        exit;
        if($data["cate_status"]==1){
            $res=[
              "cate_status"=>0
            ];
            $arr=Db::name("cate")->where(["cate_id"=>$data["cate_id"]])->update($res);
        }else{
            $res=[
                "cate_status"=>1
            ];
            $arr=Db::name("cate")->where(["cate_id"=>$data["cate_id"]])->update($res);
        }
        if($arr){
            echo json_encode(["status"=>1,"msg"=>"OK"]);
        }else{
            echo json_encode(["status"=>0,"msg"=>"数据修改失败"]);
        }

    }

    //分类删除
    public function del_productcategory(){
        //接值判断删除
        $cate_id=request()->get("cate_id",0);
        if($cate_id==0){
            $this->error("非法请求");
        }
        //连库删除
        $res=Db::name("cate")->delete(["cate_id"=>$cate_id]);
            if($res){
                echo json_encode(["status"=>1,"msg"=>"OK"]);
            }else{
                echo json_encode(["status"=>0,"msg"=>"数据删除失败"]);
            }
     }

}