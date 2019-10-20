<?php


namespace frontend\controllers;


use yii\web\Controller;

class LoginController extends Controller
{

    public $layout = 'layout';

    public function actionLogin()
    {


        return $this->render('login');

    }

}