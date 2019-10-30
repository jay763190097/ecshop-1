<?php
?>
<?php $this->beginBlock('self_css'); ?>

<?php $this->endBlock(); ?>
    <header id="head">
        <div class="search_icon white radius50">
            <img src="/images/search.png"/>
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
            <a href="information.html">
                <img src="/images/news.png"/>
            </a>
        </div>
        <div class="swiper-container swiper-002">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <a href="information_details.html">
                        <img src="/images/goods001.jpg/" class="news_img"/>
                        <div class="info">
                            <h3>11国庆发货安排通知</h3>
                            <p>09月29日后货物延后至10月08日发货</p>
                        </div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="information_details.html">
                        <img src="/images/goods001.jpg/" class="news_img"/>
                        <div class="info">
                            <h3>22国庆发货安排通知</h3>
                            <p>09月29日后货物延后至10月08日发货</p>
                        </div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="information_details.html">
                        <img src="/images/goods001.jpg/" class="news_img"/>
                        <div class="info">
                            <h3>33国庆发货安排通知</h3>
                            <p>09月29日后货物延后至10月08日发货</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>


<?php if (!empty($discount)) { ?>
    <!--优惠-->
    <div class="width_set discount white radius5">
        <div class="title">
            <h3>限时优惠</h3>
            <div class="endtime">
                距结束<span><?= $discount['used_time']['day'] ?></span>天
                <span><?= $discount['used_time']['hour'] ?></span>时
                <span><?= $discount['used_time']['min'] ?></span>分
                <span><?= $discount['used_time']['sec'] ?></span>秒
                <!--                <span>09</span>-->
            </div>
            <a href="/list/discount" class="more">更多 &gt;</a>
        </div>
        <ul class="discount_goods">


            <?php foreach ($discount['list'] as $k) { ?>
                <li>
                    <a href="/list/shop?id=<?=$k['goods_id']?>" class="goods_img">
                        <img src="<?= $k['goods_thumb'] ?>"/>
                    </a>
                    <a href="/list/shop?id=<?=$k['goods_id']?>" class="goods_title"><span class="haitao">

                        <?php if ($k['suppliers_id'] == 1) {

                            echo "自营";

                        } else {

                            echo "海淘";

                        } ?>

                    </span><?= $k['goods_name'] ?></a>
                    <a href="/list/shop?id=<?=$k['goods_id']?>"
                       class="dis_prize center-block text-center">特惠价&yen;<?= $k['shop_price'] ?></a>
                </li>
            <?php } ?>


            <!--            <li>-->
            <!--                <a href="goods_details.html" class="goods_img">-->
            <!--                    <img src="images/goods001.jpg"/>-->
            <!--                </a>-->
            <!--                <a href="goods_details.html" class="goods_title"><span class="haitao">海淘</span>我是商品名称限时优惠我是商品名称限时优惠</a>-->
            <!--                <a href="goods_details.html" class="dis_prize center-block text-center">特惠价&yen;9.9</a>-->
            <!--            </li>-->
            <!--            <li>-->
            <!--                <a href="goods_details.html" class="goods_img">-->
            <!--                    <img src="images/goods001.jpg"/>-->
            <!--                </a>-->
            <!--                <a href="goods_details.html" class="goods_title"><span class="own">自营</span>我是商品名称限时优惠我是商品名称限时优惠</a>-->
            <!--                <a href="goods_details.html" class="dis_prize center-block text-center">特惠价&yen;9.9</a>-->
            <!--            </li>-->
            <!--            <li>-->
            <!--                <a href="goods_details.html" class="goods_img">-->
            <!--                    <img src="images/goods001.jpg"/>-->
            <!--                </a>-->
            <!--                <a href="goods_details.html" class="goods_title"><span class="haitao">海淘</span>我是商品名称限时优惠我是商品名称限时优惠</a>-->
            <!--                <a href="goods_details.html" class="dis_prize center-block text-center">特惠价&yen;9.9</a>-->
            <!--            </li>-->
        </ul>
    </div>
<?php } ?>
    <div class="jingwai white radius5">
        <div class="title">
            <h3>境外海淘</h3>
            <span class="choose">日本原装好物  保税仓发货</span>
            <a href="" class="more">更多 &gt;</a>
        </div>
        <ul class="discount_goods">


            <?php foreach ($haitao as $k) { ?>
                <li>
                    <a href="/list/shop?id=<?=$k['goods_id']?>" class="goods_img">
                        <img src="<?= $k['goods_thumb'] ?>"/>
                    </a>
                    <a href="/list/shop?id=<?=$k['goods_id']?>" class="goods_title"><span
                                class="haitao">海淘</span><?= $k['goods_name'] ?></a>
                    <span class="choose_prize">&yen;<?= $k['shop_price'] ?></span>
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

            <?php foreach ($self as $k) { ?>
                <li>
                    <a href="/list/shop?id=<?=$k['goods_id']?>" class="goods_img">
                        <img src="<?= $k['goods_thumb'] ?>"/>
                    </a>
                    <a href="/list/shop?id=<?=$k['goods_id']?>" class="goods_title"><span class="own">自营</span><?= $k['goods_name'] ?>
                    </a>
                    <span class="choose_prize">&yen;<?= $k['shop_price'] ?></span>
                </li>
            <?php } ?>

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

        </ul>
        <i class="layui-icon layui-icon-loading layui-anim layui-anim-rotate layui-anim-loop text-center"
           style="display:none;"></i>
    </div>


<?php $this->beginBlock('self_js'); ?>
    <script src="/js/common.js"></script>
    <script>
        $(document).ready(function () {

            var type = 0;
            var page = 0;

            function getList(type = 0) {

                $.ajax({
                    url: '/index/list',
                    type: 'get',
                    dataType: 'json',
                    data: {
                        type: type,
                        page: page
                    },
                    success: function (data) {
                        console.log(data);
                        $(".layui-icon-loading").css("display", "none");
                        data = data['list'];
                        for (var x in data) {

                            var str = '<span class=\'haitao\'>海淘</span>';
                            if (data[x].suppliers_id == 1){
                                str = '<span class=\'own\'>自营</span>';
                            }

                            $(".kinds_list").append(
                                "<li class='radius5 white'>" +
                                "<a href='/list/shop?id="+data[x].goods_id+"' class='goods_img'>" +
                                "<img src='"+ data[x].goods_thumb +"'/>" +
                                "</a>" +
                                "<a href='/list/shop?id="+data[x].goods_id+"' class='goods_title'>"+ str +data[x].goods_name+"</a>" +
                                "<span class='choose_prize'>&yen;"+ data[x].shop_price+"</span>" +
                                "</li>"
                            )
                        }

                        page += 1;

                    }
                })

            }

            // getList();

            //点击搜索;
            $(".search_icon").click(function () {
                window.location.href = "/index/search";
            });

            //点击切换精选等;
            $(".kinds_name>li").on("click", function () {

                console.log($(this).index());

                type = $(this).index();

                $(this).addClass("active").siblings("li").removeClass("active");

                $(".kinds_list").children().remove();

                page = 0;
                // getList(type);

            });

            //屏幕滚动到底部加载更多;
            $(window).scroll(function (event) {

                if (($(document).scrollTop()) >= ($(document).height() - $(window).height())) {
                    console.log("到底了");
                    $(".layui-icon-loading").css("display", "block");
                    //ajax请求省略;
                    // alert(111);
                    getList(type);

                    // setTimeout(function () {
                    //
                    //     for (var i = 0; i < 2; i++) {
                    //         $(".kinds_list").append(
                    //             "<li class='radius5 white'>" +
                    //             "<a href='' class='goods_img'>" +
                    //             "<img src='images/goods001.jpg'/>" +
                    //             "</a>" +
                    //             "<a href='' class='goods_title'><span class='haitao'>海淘</span>我是商品名称限时优惠我是商品名称限时优惠</a>" +
                    //             "<span class='choose_prize'>&yen;99.9</span>" +
                    //             "</li>"
                    //         )
                    //     }
                    // }, 500);
                }
            });
        });
    </script>
    </<?php $this->endBlock(); ?>