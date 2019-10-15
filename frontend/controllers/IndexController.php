<?php


namespace frontend\controllers;


use yii\web\Controller;

class IndexController extends Controller
{

    public $layout = 'layout';

    public $url = 'http://47.111.117.79:88';

    public function actionIndex()
    {

        //首页banner
        $banner = $this->getList()['banners'];

        return $this->render('index', ['banner' => $banner]);

    }


    public function getList()
    {
        $data = [];
        $file = @file_get_contents($this->url . '/data/flash_data.xml');
        if (strlen($file) > 0) {
            $data = self::get_flash_xml($file);
        }
        return $this->formatBody(['banners' => $data]);
    }

    private static function get_flash_xml($file)
    {
        $flashdb = array();

        // 兼容v2.7.0及以前版本
        if (!preg_match_all('/item_url="([^"]+)"\slink="([^"]*)"\stext="([^"]*)"\ssort="([^"]*)"/', $file, $t, PREG_SET_ORDER)) {
            preg_match_all('/item_url="([^"]+)"\slink="([^"]*)"\stext="([^"]*)"/', $file, $t, PREG_SET_ORDER);
        }
        if (!empty($t)) {
            foreach ($t as $key => $val) {
                $val[4] = isset($val[4]) ? $val[4] : 0;
//                $flashdb[] = array('id' => $key, 'photo' => self::formatPhoto($val[1]), 'link' => $val[2], 'title' => $val[3], 'sort' => $val[4]);
                $flashdb[] = array('id' => $key, 'photo' => self::formatPhoto($val[1]), 'link' => $val[2], 'title' => $val[3]);
            }
        }
        return $flashdb;
    }

    public function formatBody(array $data = [])
    {
        $data['error_code'] = 0;
        return $data;
    }

    static function formatPhoto($img, $thumb = null, $domain = null)
    {
        if ($img == null) {
            return null;
        }
        if ($thumb == null) {
            $thumb = $img;
        }

        $domain = $domain == null ? \Yii::$app->params['admin_url'] : $domain;

        if (!preg_match('/^http/', $thumb) && !preg_match('/^https/', $thumb)) {
            $thumb = $domain . '/' . $thumb;
        }


        if (!preg_match('/^http/', $img) && !preg_match('/^https/', $img)) {
            $img = $domain . '/' . $img;
        }

        return [
            //定义图片服务器
            'thumb' => $thumb,
            'large' => $img
        ];
    }

}