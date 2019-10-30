<?php
?>
<?php $this->beginBlock('self_css'); ?>

<?php $this->endBlock(); ?>
    <input type="hidden" id="goods_id" value="<?= $info['goods_id'] ?>">
    <input type="hidden" id="image_url" value="<?= $image_url ?>">
    <span class="back"></span>
    <div class="swiper-container swiper-003">
        <div class="swiper-wrapper">
            <?php foreach ($image_list as $k) { ?>
                <div class="swiper-slide">
                    <img src="<?= $k['img'] ?>"/>
                </div>
            <?php } ?>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination swiper-pag3"></div>
    </div>
    <div class="prize_block">

        <?php if ($info['is_promote'] == 1) { ?>

            <div class="prize_L">
                <i>&yen;</i><span><?= $info['promote_price'] ?></span>
            </div>

            <div class="prize_R">
                <span>&yen;<?= $info['shop_price'] ?></span>
                <span>限时优惠</span>
            </div>

        <?php } else { ?>

            <div class="prize_L">
                <i>&yen;</i><span><?= $info['shop_price'] ?></span>
            </div>

        <?php } ?>

    </div>
    <p class="details_name">
        <span>海淘</span>
        <?= trim($info['goods_name']) ?>
    </p>
    <ul class="Explain">
        <li class="get_quan">
            <span>领劵</span>
            <div class="toget">
                <span>购物满减劵</span>
                <span>最高立减50元</span>
                <img src="/images/next.png">
            </div>
        </li>
        <li>
            <span>服务</span>
            <span>保税仓直邮·不支持无理由退换</span>
        </li>
        <li>
            <span>税率</span>
            <span>跨境电商综合税率为9.1%,已由商家代付</span>
        </li>
        <li>
            <span style="display: block;
    float: left;
    margin-right: 0.12rem;
    color: #999999;
    font-size: 0.13rem;
    letter-spacing: 1px;">快递</span>
            <span>邮费¥10.00·满200元包邮</span>
        </li>
    </ul>
    <ul class="Explain Explain_icon">
        <li>
            <span>选择</span>
            <span style="color: #333;">选择<?= $attr_list ?></span>
            <img src="images/next.png"
                 style="display: block;float: right;width: 0.07rem;height: 0.14rem;margin-top: 0.15rem;"/>
        </li>
    </ul>

    <ul class="infos white">
        <li class="active">
            <span>商品详情</span>
            <i></i>
        </li>
        <li>
            <span>用户评价</span>
            <i></i>
        </li>
        <li>
            <span>用户须知</span>
            <i></i>
        </li>
    </ul>
    <div class="three_icons">
        <div class="icons_left">
            <?= $info['goods_desc'] ?>
        </div>
        <div class="icons_center">
            <ul class="comment">
                <li class="active">
                    <span>全部评价</span>
                </li>
                <li>
                    <span>高分</span>
                </li>
                <li>
                    <span>低分</span>
                </li>
                <!--                <li>-->
                <!--                    <span>最新</span>-->
                <!--                </li>-->
                <li>
                    <span>有图评价</span>
                </li>
            </ul>
            <ul class="comment_content">

                <?php foreach ($comment as $k) { ?>

                    <li>
                        <div class="star_block">
                            <span><?= $k['user_name'] ?></span>
                            <ul>
                                <?php for ($i = 0; $i < $k['comment_rank']; $i++) { ?>
                                    <li>
                                        <img src="/images/good_star.png"/>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <p>
                            <?= $k['content'] ?>
                        </p>

                        <?php if (!empty($k['image'])) { ?>
                            <ul class="images_area">
                                <?php foreach ($k['image'] as $item) { ?>
                                    <li>
                                        <img src="<?= Yii::$app->params['admin_url'] . '/' . $item ?>"/>
                                    </li>
                                <?php } ?>

                            </ul>

                        <?php } ?>
                        <div class="dates">
                            <!--                            <span>2019-06-22购买,</span>-->
                            <span><?= $k['add_time'] ?>发表</span>
                        </div>
                    </li>

                <?php } ?>

            </ul>
            <i class="layui-icon layui-icon-loading layui-anim layui-anim-rotate layui-anim-loop text-center"
               style="display:none;"></i>
        </div>
        <div class="icons_right">
            <img src="/images/user.jpg"/>
        </div>
    </div>
    <div class="buy_block">
        <div class="shopping_car">
            <img src="/images/car.png"/>
            <span>购物车</span>
        </div>
        <div class="kefu_peoples">
            <img src="/images/kefu.png"/>
            <span>客服</span>
        </div>

        <?php if ($is_collect == 0) { ?>
            <div class="shoucang" type="false">
                <img src="/images/shoucang.png"/>
                <span>收藏</span>
            </div>
        <?php } else { ?>
            <div class="shoucang" type="true">
                <img src="/images/yishoucang.png"/>
                <span>取消收藏</span>
            </div>
        <?php } ?>
        <div class="controls">
            <div>加入购物车</div>
            <div>立即购买</div>
        </div>
    </div>

    <div class="shadow"></div>

    <!--优惠券-->
    <div class="Coupon">
        <div class="Coupon_title">
            优惠券
        </div>
        <ul class="Coupon_lists">

        </ul>
        <button type="button" class="finish">完成</button>
    </div>

    <div class="Specifications_block" type='0'>
    <div class="Specifications_block_001">
        <div class="img_areas">
            <img src="<?=$info['goods_img']?>"/>
        </div>
        <div class="goods_prizes_area">
            <span>&yen;<?= $info['price'] ?></span>
            <span>库存<i class="Stock"> <?= $info['goods_number'] ?> </i>件</span>
        </div>
    </div>
    <div style="width: 100%;overflow: auto;height: 3rem;">


        <?php foreach ($attr as $k) { ?>

            <div class="Specifications_block_002">
                <span><?= $k['attr_name'] ?></span>
                <ul>
                    <?php foreach ($k['value'] as $value) { ?>
                        <li data-id="<?= $value['goods_attr_id'] ?>">
                            <span><?= $value['attr_value'] ?></span>
                        </li>
                    <?php } ?>
                </ul>
            </div>

        <?php } ?>

        <div class="Specifications_block_003">
            <span>购买数量</span>
            <ul class="numbers numbers_calc">
                <li class="divide"><span> - </span></li>
                <li><input type="text" value="1" class="goods_number"/></li>
                <li class="plus"><span> + </span></li>
            </ul>
        </div>
        <button type="button" class="finish queding">确定</button>
    </div>

    <div class="service_blocks">
        <div class="service_title">联系客服</div>
        <ul class="service_list">
            <li>
                <span>联系电话</span>
                <img src="/images/next-333.png"/>
                <a id="tel" href="tel:0913-11111111" style="font-size:0.14rem;">17693017762 </a>
            </li>
            <li>
                <span>QQ</span>
                <span class="server_num">111111111111</span>
            </li>
            <li>
                <span>微信号</span>
                <span class="server_num">jealook1</span>
            </li>
        </ul>
        <button type="button" class="finish server_complete">完成</button>
    </div>

    <?php $this->beginBlock('self_js'); ?>
    <script src="/js/common.js"></script>
    <script>

        $(document).ready(function () {
            $(".three_icons").css("height", $(".icons_left").height());
            $(".icons_left").show();
            $(".icons_center").hide();
            $(".icons_right").hide();

            //点击弹出规格框;
            $(".Explain_icon>li").on("click", function () {
                $(".shadow").show();
                $(".Specifications_block").animate({
                    "bottom": 0
                }, 300);
                $(".Specifications_block").attr("type", '0');
            });

            //点击弹出客服框;
            $(".kefu_peoples").on("click", function () {
                $(".shadow").show();
                $(".service_blocks").animate({
                    "bottom": 0
                }, 300);
            });

            //点击加号;
            $(".plus").click(function () {
                var goods_number = $(".goods_number").val();
                goods_number++;
                var Stock = $(".Stock").text();
                if (goods_number >= Stock) {
                    goods_number = Stock;
                }
                $(".goods_number").val(goods_number);
            });

            //点击减号;
            $(".divide").click(function () {
                var goods_number = $(".goods_number").val();
                goods_number--;
                if (goods_number <= 1) {
                    goods_number = 1;
                }
                $(".goods_number").val(goods_number);
            });

        });


        //点击切换商品详情、评论等;
        $(".infos>li").on("click", function () {
            var index = $(this).index();
            $(this).addClass("active").siblings("li").removeClass("active");
            var width = $(".three_icons").width();

            if (index == 0) {
                $(".icons_left").show();
                $(".icons_center").hide();
                $(".icons_right").hide();
                $(".three_icons").css("height", $(".icons_left").height());
            } else if (index == 1) {
                $(".icons_left").hide();
                $(".icons_center").show();
                $(".icons_right").hide();
                $(".three_icons").css("height", $(".icons_center").height());
            } else if (index == 2) {
                $(".icons_left").hide();
                $(".icons_center").hide();
                $(".icons_right").show();
                $(".three_icons").css("height", $(".icons_right").height());
            }

            $(".three_icons").animate({
                left: -(index * width)
            }, 200);

        });


        var page = 1;
        var eva = 0;
        //点击全部、高分等等;
        $(".comment>li").click(function () {

            eva = $(this).index();
            page = 1;
            $(this).addClass("active").siblings("li").removeClass("active");
            getEvaluate();
        });


        function getEvaluate() {

            $.ajax({
                url: '/list/evaluate-list',
                type: 'get',
                dataType: 'json',
                data: {
                    goods_id: $("#goods_id").val(),
                    page: page,
                    type: eva
                },
                success: function (data) {
                    console.log(data);
                    page += 1;


                    html = '';
                    for (var x in data) {

                        html += "<li>" +
                            "<div class='star_block'>" +
                            "<span>" + data[x].user_name + "</span>" +
                            "<ul>";


                        var image = '';

                        for (var i = 0; i < data[x].comment_rank; i++) {

                            image += "<li>" +
                                "<img src='/images/good_star.png'/>" +
                                "</li>";

                        }

                        html += image;

                        html += "</ul>" +
                            "</div>" +
                            "<p>" + data[x].content + "</p>";


                        image = '';

                        if (data[x].image != 0) {
                            var url = $("#image_url").val();
                            image += "<ul class='images_area'>";

                            for (var y in data[x].image) {

                                var str = url + '/' + data[x].image[y].replace(/\\/g, "");

                                image += "<li>" +
                                    "<img src='" + str + "'/>" +
                                    "</li>";

                            }

                            image += "</ul>";


                        }

                        html += image;

                        html += "<div class='dates'>" +
                            // "<span>2019-06-22购买,</span>" +
                            "<span>" + data[x].add_time + "发表</span>" +
                            "</div>" +
                            "</li>"


                    }

                    $(".comment_content").children().remove();
                    $(".comment_content").append(html);

                }
            })


        }

        //滚动屏幕加载评论;
        $(window).scroll(function (event) {
            if ($(".icons_center").css("display") == "block") {
                if (($(document).scrollTop()) >= ($(document).height() - $(window).height())) {
                    console.log("到底了");
                    $(".layui-icon-loading").css("display", "block");
                    //ajax请求省略;
                    getEvaluate();

                }
            }
        });

        layui.use("layer", function () {
            var layer = layui.layer;

            //点击返回上一页;
            $(".back").click(function () {
                window.history.go(-1);
            })

            //点击领取优惠券;
            $(".get_quan").click(function () {
                $(".shadow").show();
                $('.Coupon').animate({
                    "bottom": 0
                }, 300);

                $.ajax({
                    url: '/list/red-list',
                    type: 'get',
                    dataType: 'json',
                    data: {
                        goods_id: $("#goods_id").val()
                    }, success(data) {
                        console.log(data);

                        if (data.code == 1) {
                            var html = '';
                            var data = data.data;
                            for (var x in data) {

                                html += '<li>\n' +
                                    '                <div class="add_cou">\n' +
                                    '                    <div class="cou_list_L">\n' +
                                    '                        <span>&yen;<i>' + data[x].type_money + '</i></span>\n' +
                                    '                        <span>满' + data[x].min_amount + '元可用</span>\n' +
                                    '                    </div>\n' +
                                    '                    <div class="cou_list_R">\n' +
                                    '                        <p>国庆随机奖励限量优惠活动专用,平台全品类(优惠商品除外)</p>\n' +
                                    '                        <div>\n' +
                                    '                            <span>' + data[x].use_start_date + '-' + data[x].use_end_date + '</span>\n';

                                if (data[x].is_has == 0) {
                                    html += '                            <span class="quick_get" data-id="' + data[x].type_id + '">立即领取&gt; </span>\n';

                                } else {
                                    html += '                            <span class="used" style="color: #919191;" data-id="' + data[x].type_id + '">立即使用&gt; </span>\n';

                                }
                                html += '                        </div>\n' +
                                    '                    </div>\n' +
                                    '                </div>\n' +
                                    '            </li>';


                            }
                            $(".Coupon_lists").children().remove();
                            $(".Coupon_lists").append(html);
                        } else {
                            layer.msg(data.msg);

                            location.href='/login/login';
                        }

                    }
                })


            });

            //领取优惠券
            $(document).on('click', '.quick_get', function () {

                var type_id = $(this).attr('data-id');

                var div = $(this);

                $.ajax({
                    url: '/list/get-red',
                    type: 'get',
                    dataType: 'json',
                    data: {
                        type_id: type_id
                    }, success: function (data) {
                        layer.msg(data.msg);
                        if (data.code == 1) {
                            div.css('color', '#919191');
                            div.html('立即使用');
                            div.addClass('used').removeClass('quick_get');
                        } else {
                            location.href = '/login/login';
                        }
                    }
                })


            });

            //点击阴影层;
            $(".shadow").click(function () {
                $(".shadow").hide();
                $('.Coupon').animate({
                    "bottom": "-7rem"
                }, 300);
                $(".Specifications_block").animate({
                    "bottom": "-7rem"
                }, 300);
                $(".service_blocks").animate({
                    "bottom": "-6rem"
                }, 300);
            });

            //点击完成;
            $(".finish").click(function () {
                $(".shadow").hide();
                $('.Coupon').animate({
                    "bottom": "-7rem"
                }, 300);
            });

            //点击客服框完成;
            $(".server_complete").click(function () {
                $(".shadow").hide();
                $(".service_blocks").animate({
                    "bottom": "-6rem"
                }, 300);
            });


            function collect(type) {
                $.ajax({
                    url: '/list/collect',
                    type: 'get',
                    dataType: 'json',
                    data: {
                        type: type,
                        goods_id: $("#goods_id").val()
                    }, success: function (data) {
                        layer.msg(data.msg);

                    }
                })
            }

            //点击收藏;
            $(".shoucang").on("click", function () {
                var type = $(this).attr("type");
                if (type == "false") {
                    // collect(1);
                    // layer.msg("收藏成功");


                    $.ajax({
                        url: '/list/collect',
                        type: 'get',
                        dataType: 'json',
                        data: {
                            type: 1,
                            goods_id: $("#goods_id").val()
                        }, success: function (data) {
                            layer.msg(data.msg);
                            if (data.code == 1) {
                                $(".shoucang").children("img").attr("src", "/images/yishoucang.png");
                                $(".shoucang").children("span").text("已收藏");
                                $(".shoucang").attr("type", "true");
                            }else{
                                location.href = '/login/login';
                            }
                        }
                    })

                } else if (type == "true") {
                    // collect(0);
                    // layer.msg("取消收藏成功");


                    $.ajax({
                        url: '/list/collect',
                        type: 'get',
                        dataType: 'json',
                        data: {
                            type: 0,
                            goods_id: $("#goods_id").val()
                        }, success: function (data) {
                            layer.msg(data.msg);
                            if (data.code == 1) {
                                $(".shoucang").children("img").attr("src", "/images/shoucang.png");
                                $(".shoucang").children("span").text("收藏");
                                $(".shoucang").attr("type", "false");
                            }

                        }
                    })
                }
            });


            //点击规格框;
            $(".Specifications_block_002 li").click(function () {
                if ($(this).hasClass("disabled")) {
                    layer.msg("暂不可选");
                } else {
                    $(this).addClass("active").siblings("li").removeClass("active");
                }
            });

            //点击跳转购物车;
            $(".shopping_car").click(function () {
                window.location.href = "/cart/index";
            });

            //点击加入购物车;
            $(".controls>div:nth-child(1)").click(function () {
                $(".shadow").show();
                $(".Specifications_block").animate({
                    "bottom": 0
                }, 300);

                $(".Specifications_block").attr("type", '1');
            });

            //点击立即购买;
            $(".controls>div:nth-child(2)").click(function () {
                $(".shadow").show();
                $(".Specifications_block").animate({
                    "bottom": 0
                }, 300);
                $(".Specifications_block").attr("type", '2');
            });

            //点击确定;
            $(".queding").click(function () {
                var type = $(".Specifications_block").attr("type");
                $(".shadow").hide();
                $(".Specifications_block").animate({
                    "bottom": "-7rem"
                }, 300);


                var attr_ids = '';
                $(".Specifications_block_002").each(function () {

                    var attr_id = $(this).children('ul').children('.active').attr('data-id');

                    attr_ids += ',' + attr_id;
                });

                if (type == '1') {

                    $.ajax({
                        url: '/list/add-car',
                        type: 'get',
                        dataType: 'json',
                        data: {
                            goods_id: $("#goods_id").val(),
                            attr_id: attr_ids,
                            num: $(".goods_number").val()
                        }, success: function (data) {
                            if (data.code == 0) {
                                layer.msg(data.msg);
                                location.href = '/login/login';
                            } else {
                                layer.msg("成功添加到购物车");
                            }
                        }
                    });

                } else if (type == "2") {


                    var goods_id = $("#goods_id").val();

                    var good_num = $(".goods_number").val();

                    var good_attr = '211';


                    var url = '/order/pay?type=good&goods_id=' + goods_id + '&good_num=' + good_num + '&good_attr=' + good_attr + "&good_attr_id=" + attr_ids;
                    // ?type=good&goods_id&good_num&good_attr&good_attr_id

                    window.location.href = url;

                }
            });

        });

    </script>




<?php $this->endBlock(); ?>