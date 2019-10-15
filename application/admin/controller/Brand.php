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

class Brand extends Controller{
    //查询顶级分类的
    public function brand(){
        return view();
    }
    //添加商品品牌
    public function add_brand(){
        if(request()->isGet()){
            return view();
        }
        if(request()->isPost()){
            $data=request()->post();
            $brand_logo=$_FILES["brand_logo"];
            var_dump($data);
            var_dump($brand_logo);
            return view();
            //formData.append("photo",$("input[name='brand_face']").get(0).files[0]);
//        if(request()->isPost()){h
//        $data=request()->post();
//        $brand_face=$_FILES["brand_face"];
//        if(empty($data["name"])){
//            echo json_encode(["status"=>2,"msg"=>"没有照片上传"]);
//        }
//        require_once FRAMEWORK_CORE_PATH."vendor/autoload.php";
//        //引入鉴权类
//        // 需要填写你的 Access Key 和 Secret Key
//        $accessKey ="l-wOlHSksAD81xQD5j-mJ-dHYSeNR6dag_lE-lrq";
//        $secretKey = "FCuw240ErQwGgCBTQO_AGntCqHFIzfoVt3Z_Fc9_";
//        $bucket = "photo-wyy";
//        // 构建鉴权对象
//        $auth = new Auth($accessKey, $secretKey);
//        // 生成上传 Token
//        $token = $auth->uploadToken($bucket);
//        // 要上传文件的本地路径
//        $filePath = $face['tmp_name'];
//        // 上传到七牛后保存的文件名
//        $ext=pathinfo($face["name"],PATHINFO_EXTENSION);
//        $key = uniqid().".".$ext;
//        // 初始化 UploadManager 对象并进行文件的上传。
//        $uploadMgr = new UploadManager();
//        // 调用 UploadManager 的 putFile 方法进行文件的上传。
//        list($ret,$err) = $uploadMgr->putFile($token, $key, $filePath);
//        if ($err === null) {
//            //上传成功
//            $path="http://py0x2et08.bkt.clouddn.com/".$ret["key"];
//            $data=[
//                "user_face"=>$path
//            ];
//            Db("wenda_user")->where(["user_id"=>$user["user_id"]])->update($data);
//            echo json_encode(["status"=>1,"msg"=>"上传成功","path"=>$path]);
//        }else{
//            echo json_encode(["status"=>0,"msg"=>"上传失败"]);
//        }
        }

    }


}