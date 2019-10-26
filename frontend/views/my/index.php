<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/26 0026
 * Time: 15:29
 */
use yii\helpers\Url;
?>
<?php $this->beginBlock('self_css'); ?>

<?php $this->endBlock(); ?>
<body class="my_body">
<div class="my_page">
    <?php if(empty($user_date)):?>
        <img src="/images/headimg.png" onclick="window.location.href='/login/login' "/>
        <a href="<?php echo Url::to(['/login/login']) ?>">登录／注册</a>
    <?php else:?>
        <img src="<?php  echo $user_date['img_url']?Yii::$app->params['imgurl'].$user_date['img_url']:'/images/headimg.png'?>" onclick="window.location.href='/my/info' "/>
        <a href="<?php echo Url::to(['/my/info']) ?>"><?php echo $user_date['user_name']?></a>
    <?php endif;?>
</div>
<div class="juan">
    <span>优惠券</span>
    <a href="my_coupon.html">免费领取更多优惠券 <img src="/images/nextpage.png/"></a>
</div>
<div class="orders">
    <span>我的订单</span>
    <a href="">全部订单 <img src="/images/nextpage2.png"></a>
</div>
<ul class="order_state">
    <?php if(!empty($order)):?>
        <li>
            <span><?php echo $order['obligationcount']?></span>
            <span>待付款</span>
        </li>
        <li>
            <span><?php echo $order['receivingcount']?></span>
            <span>待收货</span>
        </li>
        <li>
            <span><?php echo $order['commentcount']?></span>
            <span>待评价</span>
        </li>
        <li>
            <span><?php echo $order['replacementcount']?></span>
            <span>退换货</span>
        </li>
    <?php else:?>
        <li>
            <span>0</span>
            <span>待付款</span>
        </li>
        <li>
            <span>0</span>
            <span>待收货</span>
        </li>
        <li>
            <span>0</span>
            <span>待评价</span>
        </li>
        <li>
            <span>0</span>
            <span>退换货</span>
        </li>
    <?php endif;?>

</ul>
<ul class="my_lists">
    <li>
        <a href="<?php echo Url::to(['/my/collection']) ?>">我的收藏<img src="/images/nextpage2.png"></a>
    </li>
    <li>
        <a href="<?php echo Url::to(['/my/manage-address']) ?>">收货地址<img src="/images/nextpage2.png"></a>
    </li>
    <li>
        <a href="<?php echo Url::to(['/my/feedback']) ?>">问题反馈<img src="/images/nextpage2.png"></a>
    </li>
    <li>
        <a href="<?php echo Url::to(['/my/about-my']) ?>">关于我们<img src="/images/nextpage2.png"></a>
    </li>
</ul>

<ul id="foot">
    <li class="">
        <a href="index.html">
            <img src="/images/home.png"/>
            <span>商城首页</span>
        </a>
    </li>
    <li>
        <a href="classification.html">
            <img src="/images/classification.png"/>
            <span>全部分类</span>
        </a>
    </li>
    <li>
        <a href="<?php echo Url::to(['/cart/index']) ?>">
            <img src="/images/shopping_cart.png"/>
            <span>购物车</span>
        </a>
    </li>
    <li class="active">
        <a href="<?php echo Url::to(['/my/index']) ?>">
            <img src="/images/personal_active.png"/>
            <span>个人中心</span>
        </a>
    </li>
</ul>

<?php $this->beginBlock('self_js'); ?>
<script src="/js/common.js"></script>
<?php $this->endBlock(); ?>

</body>
