<?php
?>
<?php $this->beginBlock('self_css'); ?>

<?php $this->endBlock(); ?>
    <header id="head">
        <div class="search_icon white radius50">
            <img src="images/search.png"/>
            <input type="text" readonly="readonly" placeholder="搜索商品" value="" name="goods_name" class="goods_name"/>
        </div>
    </header>
    <!--轮播图-->
    <div class="swiper-container swiper-001">
        <div class="swiper-wrapper">

            <?php foreach ($banner as $k) { ?>
                <div class="swiper-slide">
                    <a href="">
                        <img src="<?= $k['photo']['thumb'] ?>"/>
                    </a>
                </div>
            <?php } ?>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination swiper-pag1"></div>
    </div>

    <div class="news white radius5">
        <div class="news_L pull-left">
            <img src="images/news.png"/>
        </div>
        <div class="swiper-container swiper-002">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <a href="">
                        <img src="images/goods001.jpg/" class="news_img"/>
                        <div class="info">
                            <h3>11国庆发货安排通知</h3>
                            <p>09月29日后货物延后至10月08日发货</p>
                        </div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="">
                        <img src="images/goods001.jpg/" class="news_img"/>
                        <div class="info">
                            <h3>22国庆发货安排通知</h3>
                            <p>09月29日后货物延后至10月08日发货</p>
                        </div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="">
                        <img src="images/goods001.jpg/" class="news_img"/>
                        <div class="info">
                            <h3>33国庆发货安排通知</h3>
                            <p>09月29日后货物延后至10月08日发货</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!--优惠-->
    <div class="width_set discount white radius5">
        <div class="title">
            <h3>限时优惠</h3>
            <div class="endtime">
                距结束<span>24</span>天<span>12</span>时<span>10</span>分<span>60</span>秒<span>09</span>
            </div>
            <a href="discount_list.html" class="more">更多 &gt;</a>
        </div>
        <ul class="discount_goods">
            <li>
                <a href="goods_details.html" class="goods_img">
                    <img src="images/goods001.jpg"/>
                </a>
                <a href="goods_details.html" class="goods_title"><span class="haitao">海淘</span>我是商品名称限时优惠我是商品名称限时优惠</a>
                <a href="goods_details.html" class="dis_prize center-block text-center">特惠价&yen;9.9</a>
            </li>
            <li>
                <a href="goods_details.html" class="goods_img">
                    <img src="images/goods001.jpg"/>
                </a>
                <a href="goods_details.html" class="goods_title"><span class="own">自营</span>我是商品名称限时优惠我是商品名称限时优惠</a>
                <a href="goods_details.html" class="dis_prize center-block text-center">特惠价&yen;9.9</a>
            </li>
            <li>
                <a href="goods_details.html" class="goods_img">
                    <img src="images/goods001.jpg"/>
                </a>
                <a href="goods_details.html" class="goods_title"><span class="haitao">海淘</span>我是商品名称限时优惠我是商品名称限时优惠</a>
                <a href="goods_details.html" class="dis_prize center-block text-center">特惠价&yen;9.9</a>
            </li>
        </ul>
    </div>

    <div class="jingwai white radius5">
        <div class="title">
            <h3>境外海淘</h3>
            <span class="choose">日本原装好物  保税仓发货</span>
            <a href="" class="more">更多 &gt;</a>
        </div>
        <ul class="discount_goods">


            <?php foreach ($haitao as $k) { ?>
                <li>
                    <a href="goods_details.html" class="goods_img">
                        <img src="<?= $k['goods_thumb'] ?>"/>
                    </a>
                    <a href="goods_details.html" class="goods_title"><span
                                class="haitao">海淘</span><?= $k['goods_name'] ?></a>
                    <span class="choose_prize">&yen;<?= $k['virtual_sales'] ?></span>
                </li>

            <?php } ?>
            <!--            <li>-->
            <!--                <a href="goods_details.html" class="goods_img">-->
            <!--                    <img src="images/goods001.jpg"/>-->
            <!--                </a>-->
            <!--                <a href="goods_details.html" class="goods_title"><span class="haitao">海淘</span>我是商品名称限时优惠我是商品名称限时优惠</a>-->
            <!--                <span class="choose_prize">&yen;99.9</span>-->
            <!--            </li>-->
            <!--            <li>-->
            <!--                <a href="goods_details.html" class="goods_img">-->
            <!--                    <img src="images/goods001.jpg"/>-->
            <!--                </a>-->
            <!--                <a href="goods_details.html" class="goods_title"><span class="haitao">海淘</span>我是商品名称限时优惠我是商品名称限时优惠</a>-->
            <!--                <span class="choose_prize">&yen;99.9</span>-->
            <!--            </li>-->
            <!--            <li>-->
            <!--                <a href="goods_details.html" class="goods_img">-->
            <!--                    <img src="images/goods001.jpg"/>-->
            <!--                </a>-->
            <!--                <a href="goods_details.html" class="goods_title"><span class="haitao">海淘</span>我是商品名称限时优惠我是商品名称限时优惠</a>-->
            <!--                <span class="choose_prize">&yen;99.9</span>-->
            <!--            </li>-->
        </ul>
    </div>

    <div class="store white radius5">
        <div class="title">
            <h3>境内自营</h3>
            <span class="choose">中国精选标签  自营仓发货</span>
            <a href="" class="more">更多 &gt;</a>
        </div>
        <ul class="discount_goods">

            <?php foreach ($self as $k){?>
            <li>
                <a href="goods_details.html" class="goods_img">
                    <img src="<?=$k['goods_thumb']?>"/>
                </a>
                <a href="goods_details.html" class="goods_title"><span class="own">自营</span><?=$k['goods_name']?></a>
                <span class="choose_prize">&yen;<?=$k['virtual_sales']?></span>
            </li>
            <?php }?>

<!--            <li>-->
<!--                <a href="goods_details.html" class="goods_img">-->
<!--                    <img src="images/goods001.jpg"/>-->
<!--                </a>-->
<!--                <a href="goods_details.html" class="goods_title"><span class="own">自营</span>我是商品名称限时优惠我是商品名称限时优惠</a>-->
<!--                <span class="choose_prize">&yen;99.9</span>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a href="goods_details.html" class="goods_img">-->
<!--                    <img src="images/goods001.jpg"/>-->
<!--                </a>-->
<!--                <a href="goods_details.html" class="goods_title"><span class="own">自营</span>我是商品名称限时优惠我是商品名称限时优惠</a>-->
<!--                <span class="choose_prize">&yen;99.9</span>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a href="goods_details.html" class="goods_img">-->
<!--                    <img src="images/goods001.jpg"/>-->
<!--                </a>-->
<!--                <a href="goods_details.html" class="goods_title"><span class="own">自营</span>我是商品名称限时优惠我是商品名称限时优惠</a>-->
<!--                <span class="choose_prize">&yen;99.9</span>-->
<!--            </li>-->
        </ul>
    </div>

    <div class="kinds kinds2">
        <ul class="kinds_name">
            <li class="active">
                <span>精选</span>
            </li>
            <li>
                <span>日抛</span>
            </li>
            <li>
                <span>双周抛</span>
            </li>
            <li>
                <span>月抛</span>
            </li>
            <li>
                <span>透明片</span>
            </li>
        </ul>

        <ul class="discount_goods kinds_list">
            <li class="radius5 white">
                <a href="goods_details.html" class="goods_img">
                    <img src="images/goods001.jpg"/>
                </a>
                <a href="goods_details.html" class="goods_title"><span class="haitao">海淘</span>我是商品名称限时优惠我是商品名称限时优惠</a>
                <span class="choose_prize">&yen;99.9</span>
            </li>
            <li class="radius5 white">
                <a href="goods_details.html" class="goods_img">
                    <img src="images/goods001.jpg"/>
                </a>
                <a href="goods_details.html" class="goods_title"><span class="own">自营</span>我是商品名称限时优惠我是商品名称限时优惠</a>
                <span class="choose_prize">&yen;99.9</span>
            </li>
            <li class="radius5 white">
                <a href="goods_details.html" class="goods_img">
                    <img src="images/goods001.jpg"/>
                </a>
                <a href="goods_details.html" class="goods_title"><span class="haitao">海淘</span>我是商品名称限时优惠我是商品名称限时优惠</a>
                <span class="choose_prize">&yen;99.9</span>
            </li>
            <li class="radius5 white">
                <a href="goods_details.html" class="goods_img">
                    <img src="images/goods001.jpg"/>
                </a>
                <a href="goods_details.html" class="goods_title"><span class="own">自营</span>我是商品名称限时优惠我是商品名称限时优惠</a>
                <span class="choose_prize">&yen;99.9</span>
            </li>
            <li class="radius5 white">
                <a href="goods_details.html" class="goods_img">
                    <img src="images/goods001.jpg"/>
                </a>
                <a href="goods_details.html" class="goods_title"><span class="own">自营</span>我是商品名称限时优惠我是商品名称限时优惠</a>
                <span class="choose_prize">&yen;99.9</span>
            </li>
            <li class="radius5 white">
                <a href="goods_details.html" class="goods_img">
                    <img src="images/goods001.jpg"/>
                </a>
                <a href="goods_details.html" class="goods_title"><span class="haitao">海淘</span>我是商品名称限时优惠我是商品名称限时优惠</a>
                <span class="choose_prize">&yen;99.9</span>
            </li>
        </ul>
        <i class="layui-icon layui-icon-loading layui-anim layui-anim-rotate layui-anim-loop text-center"
           style="display:none;"></i>
    </div>

    <ul id="foot">
        <li class="active">
            <a href="index.html">
                <img src="images/home_active.png"/>
                <span>商城首页</span>
            </a>
        </li>
        <li>
            <a href="classification.html">
                <img src="images/classification.png"/>
                <span>全部分类</span>
            </a>
        </li>
        <li>
            <a href="shop_car.html">
                <img src="images/shopping_cart.png"/>
                <span>购物车</span>
            </a>
        </li>
        <li>
            <a href="my.html">
                <img src="images/personal.png"/>
                <span>个人中心</span>
            </a>
        </li>
    </ul>
<?php $this->beginBlock('self_js'); ?>
    <!--    <script type="text/javascript" src="/js/jquery.form-limit.min.js"></script>-->
<?php $this->endBlock(); ?>