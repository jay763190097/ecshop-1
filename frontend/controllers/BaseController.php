<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/14 0014
 * Time: 22:07
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\bootstrap\ActiveForm;
use yii\web\UploadedFile;
use yii\web\Response;

class BaseController extends Controller
{



    public function actionIndex()
    {

        phpinfo();
    }

    /**
     * 上传图片(单图)
     * @param $name
     * @return array|string
     */
    public static function Upimg($name)
    {

        $uploadedFile = UploadedFile::getInstanceByName($name);


        if ($uploadedFile === null || $uploadedFile->hasError) {
            return '文件不存在';
        }

        //图片类型后缀
        $ext = substr($uploadedFile->name,strripos($uploadedFile->name,'.')+1);

        //数据库配置的后缀
        $upload = Method::config('upload_image_ext');

        //判断数据
        if($upload){
            //转换成数组
            $upload_image_ext = explode(',',$upload);
            //判断是否存在
            if(!in_array($ext,$upload_image_ext)){
                return ['status'=>2];
            }
        }

        //图片大小
        $size = ($uploadedFile->size);

        //数据库规定的图片大小
        $upload_image_size =Method::config('upload_image_size');

        //判断数据
        if($upload_image_size && $upload_image_size != 0 && (int)($upload_image_size < $size/1024)){
            return ['status'=>3];
        }

        //创建时间
        $ymd = date("Ymd");

        //存储到本地的路径
        $save_path = Yii::$app->basePath.'/../uploads/image/'. $ymd . '/';

        //存储到数据库的地址
        $save_url = '/image/' . $ymd . '/';

        //file_exists() 函数检查文件或目录是否存在
        //mkdir() 函数创建目录

        if (!file_exists($save_path)) {
            mkdir($save_path, 0777, true);
        }
        //图片名称
        $file_name = $uploadedFile->getBaseName();

        //图片格式
        $file_ext = $uploadedFile->getExtension();

        //新文件名
        $new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;

        //图片信息
        $uploadedFile->saveAs($save_path . $new_file_name);
        //图片路径
        $imgurl = ['imgurl'=>$save_url.$new_file_name];
        //图片名称
        $imgname = ['imgname'=>$new_file_name];
        //状态
        $status = ['status'=>1];
        //合并数组
        $arr = array_merge_recursive($imgurl,$imgname,$status);

        return $arr;
    }
}