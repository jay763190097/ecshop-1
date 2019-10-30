<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/26 0026
 * Time: 20:58
 */

namespace frontend\controllers;

use frontend\models\SxAdminConfig;
use Yii;
class Method
{
    /**
     * 配置管理
     */
    static public function config($name){
        //查类型是数组的数据
        $type = SxAdminConfig::find()->where(['is_del'=>1,'name'=>$name])->asArray()->one();
        if($type['type'] == 'array'){
            $res = explode("\n", $type['value']);
            $arr = [];
            if($name == 'config_group'){
                foreach ($res as $k => $v){
                    $res[$k] = substr($v,0, stripos($v,':'));
                    $arr[$k] = substr($v,stripos($v,":")+1);
                }

                //配置分组合并
                $group = array_combine($res, $arr);
                return $group;
            }

            if($name == 'form_item_type'){
                foreach ($res as $k => $v){
                    $arr[$k]['id'] = substr($v,0, stripos($v,':'));
                    $arr[$k]['text'] = substr($v,stripos($v,":")+1);
                }
                return $arr;
            }
        }else{
            $val = $type['value'];
            return $val;
        }
    }

    /**
     * 列出目录
     * @param $dir  目录名
     * @return 目录数组。列出文件夹下内容，返回数组 $dirArray['dir']:存文件夹；$dirArray['file']：存文件
     */
    public static function get_dirs($dir) {
        $dir = rtrim($dir,'/').'/';

        $dirArray = [];
        if (false != ($handle = opendir ( $dir )))
        {
            $i = 0;
            $j = 0;
            while ( false !== ($file = readdir ( $handle )) )
            {
                if (is_dir ( $dir . $file ))
                { //判断是否文件夹
                    $dirArray ['dir'] [$i] = $file;
                    $i ++;
                }
                else
                {
                    $dirArray ['file'] [$j] = $file;
                    $j ++;
                }
            }
            closedir ($handle);
        }
        return $dirArray;
    }

    /**
     * 从文件获取模块信息
     * @param string $name 模块名称
     * @return array|mixed
     */
    public static function getInfoFromFile($name = '')
    {
        $info = [];
        if ($name != '') {
            // 从配置文件获取
            if (is_file(Yii::$app->basePath.'/../backend/controllers/'. $name . '/info.php')) {
                $info = include Yii::$app->basePath.'/../backend/controllers/'. $name . '/info.php';
            }
        }
        return $info;
    }

    /**
     * 解析配置
     * @param string $value 配置值
     * @return array|string
     */
    public function parse_attr($value = '') {
        $array = preg_split('/[,;\r\n]+/', trim($value, ",;\r\n"));
        if (strpos($value, ':')) {
            $value  = array();
            foreach ($array as $val) {
                list($k, $v) = explode(':', $val);
                $value[$k]   = $v;
            }
        } else {
            $value = $array;
        }
        return $value;
    }

    /**
     * 强制跳转
     * @param string $url
     */
    public static function moveurl($url){
        Yii::$app->getResponse()->redirect($url)->send();
    }
    //
    public function up($name){
        $img=$_FILES[$name];
        if($img['name']!=''){
            //数据库配置的后缀
            $upload = Method::config('upload_image_ext');
            $arr_up=explode(',',$upload);
            //图片类型后缀
            $ext = substr($img['name'],strripos($img['name'],'.')+1);
            if(!in_array($ext,$arr_up)){
                return json_encode(['code'=>3000,'message'=>'上传文件格式错误']);
            }
            //存储到本地的路径
            //创建时间
            $ymd = date("Ymd");
            $save_path = Yii::$app->basePath.'/../uploads/image/'. $ymd . '/';
            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }

            //新文件名
            $new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $ext;
            //var_dump($save_path.$new_file_name);die;
            $save=move_uploaded_file($img['tmp_name'],$save_path.$new_file_name);
            //存储到数据库的地址
            return $save_url = '/image/' . $ymd . '/'.$new_file_name;
        }else{
            return $save_url='';
        }
    }
}