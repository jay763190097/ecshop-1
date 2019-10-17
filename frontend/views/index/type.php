<?php
?>
<?php $this->beginBlock('self_css'); ?>

<?php $this->endBlock(); ?>
    <header id="head">
        <div class="search_icon white radius50">
            <img src="/images/search.png"/>
            <input type="text" placeholder="搜索商品" value="" name="goods_name" class="goods_name"/>
        </div>
    </header>
    <ul class="classfi">
        <li class="active">
            <span>全部</span>
            <i></i>
        </li>
        <li>
            <span>自营</span>
            <i></i>
        </li>
        <li>
            <span>海淘</span>
            <i></i>
        </li>
    </ul>
    <ul class="comprehensive">
        <li class="checked">
            <span>综合</span>
        </li>
        <li>
            <span>销量</span>
        </li>
        <li>
            <span>新品</span>
        </li>
        <li class="prize" type="false">
	   	  	 <span>
	   	  	 	价格
	   	  	 	<img src="/images/prize_down.png"/>
	   	  	 </span>
        </li>
        <li class="screen" type="false">
	   	  	 <span>
	   	  	 	筛选
	   	  	 	<img src="/images/screen_up.png"/>
	   	  	 </span>
        </li>
    </ul>
    <div class="results_block">
        <div class="results_icon1">
            <span>符合条件共<i>300</i>件商品</span>
            <span class="reset">充值筛选</span>
        </div>
        <div class="results_icon2">
            <div class="condition_1">
                <span>抛期：</span>
                <ul class="condition_1_list">
                    <li class="active">
                        <span>日抛</span>
                    </li>
                    <li>
                        <span>双周抛</span>
                    </li>
                    <li>
                        <span>月抛</span>
                    </li>
                </ul>
            </div>
            <div class="condition_2">
                <span>颜色：</span>
                <ul class="condition_1_list">
                    <li class="active">
                        <span>透明片</span>
                    </li>
                    <li>
                        <span>黑色</span>
                    </li>
                    <li>
                        <span>棕色</span>
                    </li>
                    <li>
                        <span>粉色</span>
                    </li>
                </ul>
            </div>
            <div class="condition_3">
                <span>着色<br/>直径：</span>
                <ul class="condition_1_list">
                    <li class="active">
                        <span>12.0mm</span>
                    </li>
                    <li>
                        <span>12.5mm</span>
                    </li>
                    <li>
                        <span>13.0mm</span>
                    </li>
                    <li>
                        <span>13.5mm</span>
                    </li>
                    <li>
                        <span>14.0mm</span>
                    </li>
                    <li>
                        <span>非公表</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="kinds">
        <ul class="discount_goods kinds_list">

            <?php foreach ($list as $k) { ?>
                <li class="radius5 white">
                    <a href="goods_details.html" class="goods_img">
                        <img src="<?= $k['goods_thumb'] ?>"/>
                    </a>
                    <a href="goods_details.html" class="goods_title">

                        <?php if ($k['suppliers_id'] == 1) {
                            echo "<span class=\"own\">自营</span>";
                        } else {
                            echo "<span class=\"haitao\">海淘</span>";
                        } ?>

                        <?= $k['goods_name'] ?></a>
                    <span class="choose_prize">&yen;<?= $k['virtual_sales'] ?></span>
                </li>
            <?php } ?>

        </ul>
        <i class="layui-icon layui-icon-loading layui-anim layui-anim-rotate layui-anim-loop text-center"
           style="display:none;"></i>
    </div>
    <!-- type:0:全部；1：自营；2：海淘 -->
    <input type="hidden" id="type" value="0">
    <!-- 0:综合；1：销量；2：新品；  -->
    <input type="hidden" id="check_type" value="0">
    <!-- 价格 desc:倒序；asc:正序；-->
    <input type="hidden" id="price" value="desc">

<?php $this->beginBlock('self_js'); ?>

    <script>

        //点击综合销量新品价格;
        $(".comprehensive>li").click(function () {
            var index = $(this).index();
            if (index == 0) {
                $(this).addClass("checked");
                $(".comprehensive>li").eq(1).removeClass("checked");
                $(".comprehensive>li").eq(2).removeClass("checked");
                $(".comprehensive>li").eq(3).removeClass("checked");
            } else if (index == 1) {
                $(this).addClass("checked");
                $(".comprehensive>li").eq(0).removeClass("checked");
                $(".comprehensive>li").eq(2).removeClass("checked");
                $(".comprehensive>li").eq(3).removeClass("checked");
            } else if (index == 2) {
                $(this).addClass("checked");
                $(".comprehensive>li").eq(0).removeClass("checked");
                $(".comprehensive>li").eq(1).removeClass("checked");
                $(".comprehensive>li").eq(3).removeClass("checked");
            }
        });

        //点击价格;
        $(".prize").click(function () {
            var type = $(this).attr("type");
            if (type == "false") {
                $(this).addClass("checked");
                $(this).attr("type", "true");
                $(this).find("img").attr("src", "/images/prize_up.png");
            } else if (type == "true") {
                $(this).removeClass("checked");
                $(this).attr("type", "false");
                $(this).find("img").attr("src", "/images/prize_down.png");
            }
            $(".comprehensive>li").eq(0).removeClass("checked");
            $(".comprehensive>li").eq(1).removeClass("checked");
            $(".comprehensive>li").eq(2).removeClass("checked");
        });

        //点击切换全部海淘自营;
        $(".classfi>li").on("click", function () {
            var index = $(this).index();

            $("#type").val(index);

            $(this).addClass("active").siblings("li").removeClass("active");
        });

        //点击筛选;
        $(".screen").on("click", function () {
            var type = $(this).attr("type");
            if (type == "false") {
                $(this).attr("type", "true");
                $(".results_block").slideDown(300);
            } else if (type == "true") {
                $(this).attr("type", "false");
                $(".results_block").slideUp(300);
                if ($(".results_icon2").find("li").attr("class") == "active") {
                    $(".screen").find("img").attr("src", "/images/screen_down.png");
                    $(".screen").addClass("checked");
                } else {
                    $(".screen").removeClass("checked");
                    $(".screen").find("img").attr("src", "/images/screen_up.png");
                }
            }
        });

        //点击抛期;
        $(".condition_1_list>li").on("click", function () {
            if ($(this).hasClass("active")) {
                $(this).removeClass("active");
            } else {
                $(this).addClass("active");
            }
        });

        //屏幕滚动到底部加载更多;
        $(window).scroll(function (event) {
            if (($(document).scrollTop()) >= ($(document).height() - $(window).height())) {
                console.log("到底了");
                $(".layui-icon-loading").css("display", "block");

                $.ajax({
                    url: '',
                    type: 'get',
                    dataType: 'json',
                    data: {

                        type:$("#type").val(),

                    }, success: function (data) {
                        console.log(data);

                        $(".layui-icon-loading").css("display", "none");
                        for (var i = 0; i < 2; i++) {
                            $(".kinds_list").append(
                                "<li class='radius5 white'>" +
                                "<a href='' class='goods_img'>" +
                                "<img src='images/goods001.jpg'/>" +
                                "</a>" +
                                "<a href='' class='goods_title'><span class='haitao'>海淘</span>我是商品名称限时优惠我是商品名称限时优惠</a>" +
                                "<span class='choose_prize'>&yen;99.9</span>" +
                                "</li>"
                            )
                        }

                    }
                });

            }
        });

    </script>


<?php $this->endBlock(); ?>