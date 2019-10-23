<?php
?>
<?php $this->beginBlock('self_css'); ?>

<?php $this->endBlock(); ?>

    <span class="back"></span>
    <div class="swiper-container swiper-003">
        <div class="swiper-wrapper">

            <?php foreach ($image_list as $k){?>
            <div class="swiper-slide">
                <img src="<?=$k['img']?>"/>
            </div>
            <?php }?>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination swiper-pag3"></div>
    </div>
    <div class="prize_block">
        <div class="prize_L">
            <i>&yen;</i><span>398.08</span>
        </div>
        <div class="prize_R">
            <span>&yen;420.88</span>
            <span>限时优惠</span>
        </div>
    </div>
    <p class="details_name">
        <span>海淘</span>
        <?=trim($info['goods_name'])?>
    </p>
    <ul class="Explain">
        <li class="get_quan">
            <span>领劵</span>
            <div class="toget">
                <span>购物满减劵</span>
                <span>最高立减50元</span>
                <img src="images/next.png"/>
            </div>
        </li>
        <li>
            <span>服务</span>
            <span>保税仓直邮·不支持无理由退换</span>
        </li>
        <li>
            <span>快递</span>
            <span>邮费¥10.00·满200元包邮</span>
        </li>
    </ul>
    <ul class="Explain Explain_icon">
        <li>
            <span>选择</span>
            <span style="color: #333;">选择颜色,规格,数量</span>
            <img src="images/next.png" style="display: block;float: right;width: 0.07rem;height: 0.14rem;margin-top: 0.15rem;"/>
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
<!--            <img src="/images/details.jpg"/>-->

            <?=$info['goods_desc']?>
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
                <li>
                    <span>最新</span>
                </li>
                <li>
                    <span>有图评价</span>
                </li>
            </ul>
            <ul class="comment_content">
                <li>
                    <div class="star_block">
                        <span>王***</span>
                        <ul>
                            <li>
                                <img src="images/good_star.png"/>
                            </li>
                            <li>
                                <img src="images/good_star.png"/>
                            </li>
                            <li>
                                <img src="images/good_star.png"/>
                            </li>
                            <li>
                                <img src="images/bad_star.png"/>
                            </li>
                            <li>
                                <img src="images/bad_star.png"/>
                            </li>
                        </ul>
                    </div>
                    <p>
                        人体所需要的营养物质主要通过一日三餐获得，零食只能是一种补充，因此零食不能无节制地吃许多儿童零食不离口，走路时吃、做作业时吃、看电视时吃、聊天时还吃。当进食食物达到一定数量后，胃部就会出现饱足感。我们对食物就不会再有欲望。
                    </p>
                    <ul class="images_area">
                        <li>
                            <img src="/images/comment_img.jpg"/>
                        </li>
                        <li>
                            <img src="images/comment_img.jpg"/>
                        </li>
                        <li>
                            <img src="images/comment_img.jpg"/>
                        </li>
                    </ul>
                    <div class="dates">
                        <span>2019-06-22购买,</span>
                        <span>2019-07-10发表</span>
                    </div>
                </li>
                <li>
                    <div class="star_block">
                        <span>王***</span>
                        <ul>
                            <li>
                                <img src="/images/good_star.png"/>
                            </li>
                            <li>
                                <img src="/images/good_star.png"/>
                            </li>
                            <li>
                                <img src="/images/good_star.png"/>
                            </li>
                            <li>
                                <img src="/images/bad_star.png"/>
                            </li>
                            <li>
                                <img src="/images/bad_star.png"/>
                            </li>
                        </ul>
                    </div>
                    <p>
                        人体所需要的营养物质主要通过一日三餐获得，零食只能是一种补充，因此零食不能无节制地吃许多儿童零食不离口，走路时吃、做作业时吃、看电视时吃、聊天时还吃。当进食食物达到一定数量后，胃部就会出现饱足感。我们对食物就不会再有欲望。
                    </p>
                    <ul class="images_area">
                        <li>
                            <img src="/images/comment_img.jpg"/>
                        </li>
                        <li>
                            <img src="/images/comment_img.jpg"/>
                        </li>
                        <li>
                            <img src="/images/comment_img.jpg"/>
                        </li>
                    </ul>
                    <div class="dates">
                        <span>2019-06-22购买,</span>
                        <span>2019-07-10发表</span>
                    </div>
                </li>
            </ul>
            <i class="layui-icon layui-icon-loading layui-anim layui-anim-rotate layui-anim-loop text-center" style="display:none;"></i>
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
        <div class="shoucang" type="false">
            <img src="/images/shoucang.png"/>
            <span>收藏</span>
        </div>
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
            <li>
                <div class="add_cou">
                    <div class="cou_list_L">
                        <span>&yen;<i>100</i></span>
                        <span>满599元可用</span>
                    </div>
                    <div class="cou_list_R">
                        <p>国庆随机奖励限量优惠活动专用,平台全品类(优惠商品除外)</p>
                        <div>
                            <span>2019.09.30-2019.10.08</span>
                            <span class="quick_get">立即领取&gt; </span>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="add_cou">
                    <div class="cou_list_L">
                        <span>&yen;<i>100</i></span>
                        <span>满599元可用</span>
                    </div>
                    <div class="cou_list_R">
                        <p>国庆随机奖励限量优惠活动专用,平台全品类(优惠商品除外)</p>
                        <div>
                            <span>2019.09.30-2019.10.08</span>
                            <span class="to_use">立即使用&gt; </span>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <button type="button" class="finish">完成</button>
    </div>

    <div class="Specifications_block" type='0'>
        <div class="Specifications_block_001">
            <div class="img_areas">
                <img src="/images/goods_details.png"/>
            </div>
            <div class="goods_prizes_area">
                <span>&yen;299.99</span>
                <span>库存<i class="Stock"> 12 </i>件</span>
            </div>
        </div>
        <div style="width: 100%;overflow: auto;height: 3rem;">
            <div class="Specifications_block_002">
                <span>颜色</span>
                <ul>
                    <li class="active">
                        <span>透明片</span>
                    </li>
                    <li>
                        <span>粉色</span>
                    </li>
                    <li>
                        <span>棕色</span>
                    </li>
                    <li class="">
                        <span>粉色</span>
                    </li>
                    <li>
                        <span>棕色</span>
                    </li>
                    <li class="">
                        <span>粉色</span>
                    </li>
                    <li>
                        <span>棕色</span>
                    </li>
                    <li class="disabled">
                        <span>透明片</span>
                    </li>
                    <li>
                        <span>粉色</span>
                    </li>
                </ul>
            </div>
            <div class="Specifications_block_002">
                <span>规格</span>
                <ul>
                    <li class="active">
                        <span>10片</span>
                    </li>
                    <li class="disabled">
                        <span>20片</span>
                    </li>
                </ul>
            </div>
            <div class="Specifications_block_002">
                <span>度数</span>
                <ul>
                    <li class="active">
                        <span>0</span>
                    </li>
                    <li>
                        <span>100</span>
                    </li>
                    <li>
                        <span>200</span>
                    </li>
                    <li class="disabled">
                        <span>300</span>
                    </li>
                    <li>
                        <span>400</span>
                    </li>
                </ul>
            </div>
        </div>
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
                <a id="tel" href="tel:0913-11111111" style="font-size:0.14rem;">0913-11111111</a>
            </li>
            <li>
                <span>QQ</span>
                <span class="server_num">111111111111</span>
            </li>
            <li>
                <span>微信号</span>
                <span class="server_num">11111111111</span>
            </li>
        </ul>
        <button type="button" class="finish server_complete">完成</button>
    </div>

<?php $this->beginBlock('self_js'); ?>
    <script src="/js/common.js"></script>
    <script>

        $(document).ready(function(){
            $(".three_icons").css("height",$(".icons_left").height());
            $(".icons_left").show();
            $(".icons_center").hide();
            $(".icons_right").hide();

            //点击弹出规格框;
            $(".Explain_icon>li").on("click",function(){
                $(".shadow").show();
                $(".Specifications_block").animate({
                    "bottom":0
                },300);
                $(".Specifications_block").attr("type",'0');
            });

            //点击弹出客服框;
            $(".kefu_peoples").on("click",function(){
                $(".shadow").show();
                $(".service_blocks").animate({
                    "bottom":0
                },300);
            });

            //点击加号;
            $(".plus").click(function(){
                var goods_number=$(".goods_number").val();
                goods_number++;
                var Stock=$(".Stock").text();
                if(goods_number>=Stock){
                    goods_number=Stock;
                }
                $(".goods_number").val(goods_number);
            });

            //点击减号;
            $(".divide").click(function(){
                var goods_number=$(".goods_number").val();
                goods_number--;
                if(goods_number<=1){
                    goods_number=1;
                }
                $(".goods_number").val(goods_number);
            });

        });

        //点击切换商品详情、评论等;
        $(".infos>li").on("click",function(){
            var index=$(this).index();
            $(this).addClass("active").siblings("li").removeClass("active");
            var width=$(".three_icons").width();

            if(index==0){
                $(".icons_left").show();
                $(".icons_center").hide();
                $(".icons_right").hide();
                $(".three_icons").css("height",$(".icons_left").height());
            }else if(index==1){
                $(".icons_left").hide();
                $(".icons_center").show();
                $(".icons_right").hide();
                $(".three_icons").css("height",$(".icons_center").height());
            }else if(index==2){
                $(".icons_left").hide();
                $(".icons_center").hide();
                $(".icons_right").show();
                $(".three_icons").css("height",$(".icons_right").height());
            }

            $(".three_icons").animate({
                left:-(index*width)
            },200);

        });

        //点击全部、高分等等;
        $(".comment>li").click(function(){
            $(this).addClass("active").siblings("li").removeClass("active");
        });

        //滚动屏幕加载评论;
        $(window).scroll(function(event){
            if($(".icons_center").css("display")=="block"){
                if(($(document).scrollTop()) >= ($(document).height() - $(window).height())) {
                    console.log("到底了");
                    $(".layui-icon-loading").css("display","block");
                    //ajax请求省略;
                    setTimeout(function(){
                        $(".layui-icon-loading").css("display","none");
                        for(var i=0;i<2;i++){

                            //模拟假数据;

                            $(".comment_content").append(
                                "<li>"+
                                "<div class='star_block'>"+
                                "<span>王***</span>"+
                                "<ul>"+
                                "<li>"+
                                "<img src='images/good_star.png'/>"+
                                "</li>"+
                                "<li>"+
                                "<img src='images/good_star.png'/>"+
                                "</li>"+
                                "<li>"+
                                "<img src='images/good_star.png'/>"+
                                "</li>"+
                                "<li>"+
                                "<img src='images/good_star.png'/>"+
                                "</li>"+
                                "<li>"+
                                "<img src='images/good_star.png'/>"+
                                "</li>"+
                                "</ul>"+
                                "</div>"+
                                "<p>人体所需要的营养物质主要通过一日三餐获得，零食只能是一种补充，因此零食不能无节制地吃许多儿童零食不离口，走路时吃、做作业时吃、看电视时吃、聊天时还吃。当进食食物达到一定数量后，胃部就会出现饱足感。我们对食物就不会再有欲望。</p>"+
                                "<ul class='images_area'>"+
                                "<li>"+
                                "<img src='images/comment_img.jpg'/>"+
                                "</li>"+
                                "<li>"+
                                "<img src='images/comment_img.jpg'/>"+
                                "</li>"+
                                "<li>"+
                                "<img src='images/comment_img.jpg'/>"+
                                "</li>"+
                                "</ul>"+
                                "<div class='dates'>"+
                                "<span>2019-06-22购买,</span>"+
                                "<span>2019-07-10发表</span>"+
                                "</div>"+
                                "</li>"
                            )
                            $(".three_icons").css("height",$(".icons_center").height());
                        }
                    },1000);
                }
            }
        });

        layui.use("layer",function(){
            var layer=layui.layer;

            //点击返回上一页;
            $(".back").click(function(){
                window.history.go(-1);
            })

            //点击领取优惠券;
            $(".get_quan").click(function(){
                $(".shadow").show();
                $('.Coupon').animate({
                    "bottom":0
                },300);
            });

            //点击阴影层;
            $(".shadow").click(function(){
                $(".shadow").hide();
                $('.Coupon').animate({
                    "bottom":"-7rem"
                },300);
                $(".Specifications_block").animate({
                    "bottom":"-7rem"
                },300);
                $(".service_blocks").animate({
                    "bottom":"-6rem"
                },300);
            });

            //点击完成;
            $(".finish").click(function(){
                $(".shadow").hide();
                $('.Coupon').animate({
                    "bottom":"-7rem"
                },300);
            });

            //点击客服框完成;
            $(".server_complete").click(function(){
                $(".shadow").hide();
                $(".service_blocks").animate({
                    "bottom":"-6rem"
                },300);
            });

            //点击收藏;
            $(".shoucang").on("click",function(){
                var type=$(this).attr("type");
                if(type=="false"){
                    layer.msg("收藏成功");
                    $(".shoucang").children("img").attr("src","images/yishoucang.png");
                    $(".shoucang").children("span").text("已收藏");
                    $(this).attr("type","true");
                }else if(type=="true"){
                    layer.msg("取消收藏成功");
                    $(".shoucang").children("img").attr("src","images/shoucang.png");
                    $(".shoucang").children("span").text("收藏");
                    $(this).attr("type","false");
                }
            });

            //点击规格框;
            $(".Specifications_block_002 li").click(function(){
                if($(this).hasClass("disabled")){
                    layer.msg("暂不可选");
                }else{
                    $(this).addClass("active").siblings("li").removeClass("active");
                }
            });

            //点击跳转购物车;
            $(".shopping_car").click(function(){
                window.location.href="shop_car.html";
            });

            //点击加入购物车;
            $(".controls>div:nth-child(1)").click(function(){
                $(".shadow").show();
                $(".Specifications_block").animate({
                    "bottom":0
                },300);
                $(".Specifications_block").attr("type",'1');
            });

            //点击立即购买;
            $(".controls>div:nth-child(2)").click(function(){
                $(".shadow").show();
                $(".Specifications_block").animate({
                    "bottom":0
                },300);
                $(".Specifications_block").attr("type",'2');
            });

            //点击确定;
            $(".queding").click(function(){
                var type=$(".Specifications_block").attr("type");
                $(".shadow").hide();
                $(".Specifications_block").animate({
                    "bottom":"-7rem"
                },300);
                if(type=='1'){
                    layer.msg("成功添加到购物车");
                }else if(type=="2"){
                    window.location.href="pay.html";
                }
            });

        });

    </script>




<?php $this->endBlock(); ?>