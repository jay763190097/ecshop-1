<?php
?>
<?php $this->beginBlock('self_css'); ?>

<?php $this->endBlock(); ?>
    <header id="head">
        <div class="search_icon white radius50">
            <img src="/images/search.png"/>
            <input type="search" placeholder="搜索商品" value="<?=empty($_GET['goods_name'])?'':$_GET['goods_name']?>" name="goods_name" class="goods_name"/>
        </div>
    </header>
    <ul class="classfi">
        <li class="<?php if (empty($_GET['action'])) {
            echo "active";
        } ?>">
            <span>全部</span>
            <i></i>
        </li>
        <li class="<?php if (!empty($_GET['action']) && $_GET['action'] == 1) {
            echo "active";
        } ?>">
            <span>自营</span>
            <i></i>
        </li>
        <li class="<?php if (!empty($_GET['action']) && $_GET['action'] == 2) {
            echo "active";
        } ?>">
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
            <span class="reset">重置筛选</span>
        </div>
        <div class="results_icon2">

            <?php foreach ($type_list as $k => $v) { ?>
                <div class="condition_1">
                    <span><?= $v['cat_name'] ?>：</span>
                    <ul class="condition_1_list">
                        <?php foreach ($v['son_list'] as $key) { ?>
                            <li data-id="<?= $key['cat_id'] ?>" data-value="<?= $key['cat_id'] ?>">
                                <span><?= $key['cat_name'] ?></span>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

        </div>
    </div>

    <div class="kinds">
        <ul class="discount_goods kinds_list">

            <?php foreach ($list as $k) { ?>
                <li class="radius5 white">
                    <a href="/list/shop?id=<?= $k['goods_id'] ?>" class="goods_img">
                        <img src="<?= $k['goods_thumb'] ?>"/>
                    </a>
                    <a href="/list/shop?id=<?= $k['goods_id'] ?>" class="goods_title">

                        <?php if ($k['suppliers_id'] == 1) {
                            echo "<span class=\"own\">自营</span>";
                        } else {
                            echo "<span class=\"haitao\">海淘</span>";
                        } ?>

                        <?= $k['goods_name'] ?></a>
                    <span class="choose_prize">&yen;<?= $k['shop_price'] ?></span>
                </li>
            <?php } ?>

        </ul>
        <i class="layui-icon layui-icon-loading layui-anim layui-anim-rotate layui-anim-loop text-center"
           style="display:none;"></i>
    </div>
    <!-- type:0:全部；1：自营；2：海淘 -->
    <input type="hidden" id="type" value="<?php echo empty($_GET['action']) ? 0 : $_GET['action']; ?>">
    <!-- 0:综合；1：销量；2：新品；  -->
    <input type="hidden" id="check_type" value="0">
    <!-- 价格 desc:倒序；asc:正序；-->
    <input type="hidden" id="price" value="0">

<?php $this->beginBlock('self_js'); ?>

    <script>


        $("#foot li").removeClass('active');

        $("#foot li:eq(1)").addClass('active');

        $("#foot li:eq(1) a img").attr('src','/images/classification_active.png');

        $("#foot li:eq(0) a img").attr('src','/images/home.png');

        $("#foot li:eq(2) a img").attr('src','/images/shopping_cart.png');
        $("#foot li:eq(3) a img").attr('src','/images/personal.png');


        $(document).ready(function () {
            var page = 1;

            var typeAttr = {};

            var count_page = 2;

            function getList() {

                var type = $("#type").val();

                var check_type = $("#check_type").val();

                var price_order = $("#price").val();

                var goods_name = $(".goods_name").val();

                if (page <= count_page) {
                    $.ajax({
                        url: '/index/type-list',
                        type: 'get',
                        dataType: 'json',
                        data: {
                            type: type,
                            check_type: check_type,
                            price_order: price_order,
                            typeAttr: typeAttr,
                            page: page,
                            goods_name: goods_name

                        }, success: function (data) {
                            console.log(data);

                            count_page = data['count_page'];

                            $(".results_icon1 span i").html(data['count']);

                            data = data['list'];

                            $(".layui-icon-loading").css("display", "none");

                            for (var x in data) {

                                var str = '<span class=\'haitao\'>海淘</span>';
                                if (data[x].suppliers_id == 1) {
                                    str = '<span class=\'own\'>自营</span>';
                                }

                                $(".kinds_list").append(
                                    "<li class='radius5 white'>" +
                                    "<a href='/list/shop?id=" + data[x].goods_id + "' class='goods_img'>" +
                                    "<img src='" + data[x].goods_thumb + "'/>" +
                                    "</a>" +
                                    "<a href='/list/shop?id=" + data[x].goods_id + "' class='goods_title'>" + str + data[x].goods_name + "</a>" +
                                    "<span class='choose_prize'>&yen;" + data[x].shop_price + "</span>" +
                                    "</li>")

                            }

                            page += 1;
                        }
                    })

                } else {
                    $(".layui-icon-loading").css("display", "none");
                }
            };

            $(".goods_name").keyup(function () {
                page = 1;
                $(".kinds_list").children().remove();
                getList();

            });

            //点击综合销量新品价格;
            $(".comprehensive>li").click(function () {
                var index = $(this).index();

                $("#check_type").val(index);

                if (index < 3) {
                    page = 1;
                    $(".kinds_list").children().remove();
                    getList();
                }


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
                    $("#price").val('asc');
                    $(this).addClass("checked");
                    $(this).attr("type", "true");
                    $(this).find("img").attr("src", "/images/prize_up.png");
                } else if (type == "true") {
                    $("#price").val('desc');
                    $(this).removeClass("checked");
                    $(this).attr("type", "false");
                    $(this).find("img").attr("src", "/images/prize_down.png");
                }
                $(".kinds_list").children().remove();
                page = 1;
                getList();
                $(".comprehensive>li").eq(0).removeClass("checked");
                $(".comprehensive>li").eq(1).removeClass("checked");
                $(".comprehensive>li").eq(2).removeClass("checked");
            });

            //点击切换全部海淘自营;
            $(".classfi>li").on("click", function () {
                var index = $(this).index();

                $("#type").val(index);
                $(".kinds_list").children().remove();
                $(this).addClass("active").siblings("li").removeClass("active");
                page = 1;
                getList();
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


                var attr_id = $(this).attr('data-id');
                var attr_value = $(this).attr('data-value');

                if ($(this).hasClass("active")) {
                    $(this).removeClass("active");

                    removeByValue(typeAttr[attr_id], attr_value);

                    if (typeAttr[attr_id].length < 1) {
                        delete typeAttr[attr_id];
                    }

                } else {
                    $(this).addClass("active");

                    if (typeAttr[attr_id] == undefined) {
                        typeAttr[attr_id] = [];
                    }
                    typeAttr[attr_id].push(attr_value);

                }

                $(".kinds_list").children().remove();

                page = 1;

                console.log(typeAttr);

                getList();

            });

            //屏幕滚动到底部加载更多;
            $(window).scroll(function (event) {
                if (($(document).scrollTop()) >= ($(document).height() - $(window).height())) {
                    console.log("到底了");
                    $(".layui-icon-loading").css("display", "block");

                    getList();

                }
            });

            function removeByValue(arr, val) {

                for (var i = 0; i < arr.length; i++) {

                    if (arr[i] == val) {

                        arr.splice(i, 1);

                        break;

                    }

                }

                return arr;

            }
        });
    </script>


<?php $this->endBlock(); ?>