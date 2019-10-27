<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <?php echo $this->blocks['self_css']; ?>
    <?php if(isset($this->blocks['formcss'])):?>
        <?=$this->blocks['formcss'];?>
    <?php endif;?>

    <link rel="stylesheet" href="/css/reset.css"/>
    <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/css/swiper.min.css"/>
    <link rel="stylesheet" href="/layui/css/layui.css"/>
    <link rel="stylesheet" href="/css/style.css"/>
    <script type="text/javascript" src="/js/jquery-1.11.3.js"></script>
    <script type="text/javascript" src="/js/main.js"></script>
    <script src="/js/swiper.min.js"></script>
    <script src="/layui/layui.all.js"></script>


</head>
<body>
<?php $this->beginBody() ?>

<?= $content ?>
<ul id="foot">
    <li class="active">
        <a href="/index/index">
            <img src="/images/home_active.png"/>
            <span>商城首页</span>
        </a>
    </li>
    <li>
        <a href="/index/type">
            <img src="/images/classification.png"/>
            <span>全部分类</span>
        </a>
    </li>
    <li>
        <a href="shop_car.html">
            <img src="/images/shopping_cart.png"/>
            <span>购物车</span>
        </a>
    </li>
    <li>
        <a href="my.html">
            <img src="/images/personal.png"/>
            <span>个人中心</span>
        </a>
    </li>
</ul>
<?php $this->endBody() ?>
</body>

<?php //$this->beginSelf?>
<?php echo $this->blocks['self_js']; ?>

<?php if(isset($this->blocks['formjs'])):?>
    <?=$this->blocks['formjs'];?>
<?php endif;?>
</html>
<?php $this->endPage() ?>
