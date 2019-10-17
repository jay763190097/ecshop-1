<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/16 0016
 * Time: 22:34
 */
?>
<?php $this->beginBlock('self_css'); ?>

<?php $this->endBlock(); ?>
<body class="">
<header id="head" class='info_my'>
    <span class="last"></span>
    <h3 class="info_about">购物车</h3>
    <span class="del_googs">
       	   	  <img src="/images/dustbin.png"/>
       	   </span>
</header>
<?php if ($cart_date):?>
    <ul class="goodscont">
        <?php foreach ($cart_date as $key =>$value):?>
            <li>
                <div class="imgarea">
                    <img src="/images/comment_img.jpg"/>
                </div>
                <div class="neirong">
                    <p><?php echo $value['goods_name']?></p>
                    <a class="parameter" href="goods_details.html"><span><?php echo $value['goods_attr_id']?></span><img src="/images/down_car.png"/></a>
                    <div class="jiagearea">
                        <div class="prizes">
                            <span class="oldprize">&yen; <?php echo $value['market_price']?></span>
                            <span class="nowprize">&yen;<i class="howmuch"><?php echo $value['goods_price']?></i></span>
                        </div>
                        <ul class="cgnumare">
                            <li class="l">&#45;</li>
                            <li class="c">
                                <input type="text" name="cggoodsnum" id="cggoodsnum" value="1" readonly="readonly"/>
                            </li>
                            <li class="r">&#43;</li>
                        </ul>
                    </div>
                </div>
            </li>
        <?php endforeach;?>
    </ul>
<?php else:?>
    <div class="bitmap_content" style="display: block;">
        <img src="/images/bitmap.png" class="bitmap"/>
        <span>暂无内容</span>
    </div>
<?php endif;?>




<ul class="jiesuan">
    <li>
        <span class="allxuan">全选</span>
        <div class="tongji">
            <div>
                <span>&yen;</span>
                <span class="zongjiaqian">0</span>
            </div>
            <span>合计：</span>
        </div>
    </li>
    <li class="zhifumoney">
	    		<span class="fukuannum">
	    			结算 (<i>0</i>)
	    		</span>
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
    <li class="active">
        <a href="shop_car.html">
            <img src="/images/shopping_cart_active.png"/>
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


<?php $this->beginBlock('self_js'); ?>
<script src="/js/common.js"></script>

<script>
    layui.use(['layer'],function(){
        var layer=layui.layer;

        // 总价方法;
        function total(){
            var total = 0;
            var totalnums=0;
            $('.goodscont li').each(function(i ,obj){
                var obj = $(obj);
                var a = obj.find(".imgarea");
                if(a.hasClass("selectmoren")){
                    var text =  obj.find(".howmuch").text()*obj.find("input[name='cggoodsnum']").val();
                    total = Number(text) + Number(total);
                    var totalnum =obj.find("input[name='cggoodsnum']").val();
                    totalnums=Number(totalnum) + Number(totalnums);
                }
            });
            console.log(total);
            $('.zongjiaqian').text(total.toFixed(2));

            $(".fukuannum").children("i").text(totalnums);
        };

        /*单选*/

        $('.goodscont>li> .imgarea').on('click',function(){
            var price = ($(this).siblings(".neirong").find(".howmuch").text()*$(this).siblings(".neirong").find("input[name='cggoodsnum']").val());
            var numone=$(this).siblings(".neirong").find("input[name='cggoodsnum']").val();

            var total = $(".zongjiaqian").text();
            var totalnum =$(".fukuannum").find("i").text();

            if($(this).hasClass('selectmoren')){
                $(this).attr("type","false");
                $(this).removeClass('selectmoren');
                var new_total = Number(total) - Number(price);
                $('.zongjiaqian').text(new_total);
                $(".fukuannum").find("i").text(Number(totalnum) - Number(numone));
            }else{
                $(this).attr("type","true");
                $(this).addClass('selectmoren');
                total = Number(price) + Number(total);
                $('.zongjiaqian').text(total);
                $(".fukuannum").find("i").text(Number(totalnum) + Number(numone));
            }
            var length = $('.goodscont .imgarea').length;
            var active_length = $('.goodscont .selectmoren').length;
            if(length == active_length){
                $('.allxuan').addClass('alchecked');
            }else{
                $('.allxuan').removeClass('alchecked');
            }

        });

        /*全选*/
        $('.allxuan').on('click',function(){
            if($(this).hasClass('alchecked')){
                $('.allxuan').removeClass('alchecked');
                $('.imgarea').removeClass("selectmoren");
                $('.zongjiaqian').text(0);
                $(".fukuannum").children("i").text(0);
            }else{
                $('.allxuan').addClass('alchecked');
                $('.imgarea').addClass("selectmoren");
                total();
            }
        });

        /*点击减号*/
        $('.cgnumare').find('.l').on('click',function(){
            var num = $(this).siblings(".c").children('input').val();
            var price = $(this).parent().siblings(".jiagearea").find(".howmuch").text();
            var new_price = (Number(num)-1)*Number(price);
            if(num <= 1){
                return false;
            }else{
                $(this).siblings(".c").children('input').val(Number(num)-1);
                if($(this).parents("li").find('.imgarea').hasClass('selectmoren')){
                    total();
                }
            }
        });

        // 点击加号;

        $('.cgnumare').find('.r').on('click',function(){
            var num = $(this).siblings(".c").children('input').val();
            var price = $(this).parent().siblings(".jiagearea").find(".howmuch").text();
            var new_price = (Number(num)+1)*Number(price);
            $(this).siblings(".c").children('input').val(Number(num)+1);
            if($(this).parents("li").find('.imgarea').hasClass('selectmoren')){
                total();
            }
        });

        //点击删除;
        $(".del_googs").on("click",function(){
            var howmanynum=$(".goodscont").find(".selectmoren").length;
            if(howmanynum==0){
                layer.msg("请选中商品");
            }else{
                layer.confirm('确认删除该商品？', {
                    btn: ['取消','确定'] //按钮
                },function(){
                    layer.closeAll();
                    window.location.reload();
                },function(){
                    layer.msg("已删除");
                    window.location.reload();
                });
            }
        });
    });
</script>
<!--    <script type="text/javascript" src="/js/jquery.form-limit.min.js"></script>-->
<?php $this->endBlock(); ?>
</body>

