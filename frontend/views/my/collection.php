<?php

/**

 * Created by PhpStorm.

 * User: Administrator

 * Date: 2019/10/20 0020

 * Time: 23:51

 */

use yii\helpers\Url;

?>

<?php $this->beginBlock('self_css'); ?>



<?php $this->endBlock(); ?>

<body class="">

<header id="head" class='info_my'>

       	   <span class="last" onclick="history.go(-1)">

       	   	 <img src="/images/last.png"/>

       	   </span>

    <h3 class="info_about">我的收藏</h3>

</header>

<div class="bitmap_content">

    <img src="/images/bitmap.png" class="bitmap"/>

    <span>暂无内容</span>

</div>



<div class="kinds collect_kinds">

    <ul class="discount_goods kinds_list">

        <?php if($collection_date):?>

            <?php foreach ($collection_date as $key=>$value):?>

                <li class="radius5 white">

                    <a href="<?php echo Url::to(['list/shop?id='.$value['goods_id']]) ?>" class="goods_img">

                        <img src="<?php echo $value['goods_thumb']?>"/>

                    </a>

                    <a href="<?php echo Url::to(['list/shop?id='.$value['goods_id']]) ?>" class="goods_title">

                        <?php if($value['suppliers_id'] == 1):?>

                            <span class="own">自营</span>

                        <?php else:?>

                            <span class="haitao">海淘</span>

                        <?php endif;?>

                        <?php echo $value['goods_name']?></a>

                    <span class="choose_prize">&yen;<?php echo $value['shop_price']?></span>

                </li>

            <?php endforeach;?>

        <?php else:?>

            <div class="bitmap_content" style="display: block;">

                <img src="/images/bitmap.png" class="bitmap"/>

                <span>暂无内容</span>

            </div>

        <?php endif;?>

    </ul>

</div>



<?php $this->beginBlock('self_js'); ?>

<script src="/js/common.js"></script>

<?php $this->endBlock(); ?>

</body>

