<?php


namespace frontend\controllers;


use yii\web\Controller;

class IndexController extends Controller
{

    public $layout = 'layout';

    public function actionIndex(){

        //首页banner




        return $this->render('index');

    }

}