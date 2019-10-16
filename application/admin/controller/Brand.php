<?php
/**
 * Created by PhpStorm.
 * User: 王意阳
 * Date: 2019/10/12
 * Time: 16:52
 */
namespace app\admin\controller;
use app\admin\model\Cate;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use think\Controller;
use think\Db;

class Brand extends Common{
    //查询顶级分类的
    public function brand(){
        if(request()->isGet()){
            $brand=new \app\admin\model\Brand();
            $data=$brand->all()->toarray();
            return view("brand",["data"=>$data]);
        }
    }
    //添加商品品牌
    public function add_brand(){
        if(request()->isGet()){
            return view();
        }
        if(request()->isPost()){
            $data=request()->post();
            $brand_logo=$_FILES["brand_logo"];
            //var_dump($data);
//            var_dump($brand_logo);
        if(empty($brand_logo["name"])){
            echo json_encode(["status"=>2,"msg"=>"没有照片上传"]);
        }
        //引入鉴权类
        // 需要填写你的 Access Key 和 Secret Key
        $accessKey ="l-wOlHSksAD81xQD5j-mJ-dHYSeNR6dag_lE-lrq";
        $secretKey = "FCuw240ErQwGgCBTQO_AGntCqHFIzfoVt3Z_Fc9_";
        $bucket = "photo-wyy";
        // 构建鉴权对象
        $auth = new Auth($accessKey, $secretKey);
        // 生成上传 Token
        $token = $auth->uploadToken($bucket);
        // 要上传文件的本地路径
        $filePath = $brand_logo['tmp_name'];
        // 上传到七牛后保存的文件名
        $ext=pathinfo($brand_logo["name"],PATHINFO_EXTENSION);
        $key = uniqid().".".$ext;
        // 初始化 UploadManager 对象并进行文件的上传。
        $uploadMgr = new UploadManager();
        // 调用 UploadManager 的 putFile 方法进行文件的上传。
        list($ret,$err) = $uploadMgr->putFile($token, $key, $filePath);
        if ($err === null) {
            //上传成功
            $path="http://py0x2et08.bkt.clouddn.com/".$ret["key"];
            $data['brand_logo']=$path;
            $brand=new \app\admin\model\Brand();
            $brand->save($data);
            echo json_encode(["status"=>1,"msg"=>"上传成功","path"=>$path]);
        }else{
            echo json_encode(["status"=>0,"msg"=>"上传失败"]);
        }
        }

    }


}