<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/5 0005
 * Time: 22:44
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
    <h3 class="info_about">我的订单</h3>
</header>
<ul class="states">
    <li>
        <span>全部</span>
        <i></i>
    </li>
    <li>
        <span>待付款</span>
        <i></i>
    </li>
    <li >
        <span>待收货</span>
        <i></i>
    </li>
    <li>
        <span>待评价</span>
        <i></i>
    </li>
    <li>
        <span>退换货</span>
        <i></i>
    </li>
</ul>



<div class="order_state_block">
    <ul class="active">
        <!--待付款-->
        <?php if($date):?>
            <?php foreach ($date as $key=>$value):?>
                <?php if($value['pay_status'] == 0):?>
                    <li>
                        <div class="order_state_one">
                            <span>订单号：<i><?php echo $value['orderSn']?></i></span>
                            <span class="waiting">待付款</span>
                        </div>
                        <ul class="order_goods_list order_state_two">
                            <?php foreach ($value['list'] as $k =>$v):?>
                                <li>
                                    <div class="imgarea_80">
                                        <img src="<?php echo \Yii::$app->params['admin_url'].$v['goods_thumb']?>"/>
                                    </div>
                                    <div class="goods_details_80">
                                        <a href="order_details.html" class="goods_name_80">
                                            <?php echo $v['goods_name']?>
                                        </a>
                                        <span class="color_80"><?php echo $v['goods_attr']?>分类:<?php echo $v['goods_attr_id']?></span>
                                        <div style="float:left;width: 100%;margin-top: 0.05rem;">
                                            <span class="new_prize_80">&yen;<i><?php echo $v['goods_price']?></i></span>
                                            <span class="old_prize_80">&yen;<i><?php echo $v['market_price']?></i></span>
                                            <span class="num_80">&times; <i><?php echo $v['goods_number']?></i></span>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach;?>
                        </ul>
                        <div class="order_state_three">
                            <span>实付: <i num='<?php echo $value['goods_amount']?>'>&yen;<?php echo $value['goods_amount']?></i></span>
                            <span>共<i><?php echo $value['goods_count']?></i>件商品</span>
                        </div>
                        <div class="order_state_four">
                            <button type="button" class="order_pay">立即支付</button>
                            <button type="button" class="order_quit">取消订单</button>
                        </div>
                    </li>
                <?php elseif($value['shipping_status'] == 1 && $value['pay_status'] == 2 && $value['order_status'] == 1):?>
                        <!--待收货-->
                        <li>
                            <div class="order_state_one">
                                <span>订单号：<i><?php echo $value['orderSn']?></i></span>
                                <span class="waiting">待收货</span>
                            </div>
                            <ul class="order_goods_list order_state_two">
                                <?php foreach ($value['list'] as $item =>$va):?>
                                    <li>
                                        <div class="imgarea_80">
                                            <img src="<?php echo \Yii::$app->params['admin_url'].$va['goods_thumb']?>"/>
                                        </div>
                                        <div class="goods_details_80">
                                            <a href="order_details.html" class="goods_name_80">
                                                <?php echo $va['goods_name']?>
                                            </a>
                                            <span class="color_80"><?php echo $va['goods_attr']?>分类:<?php echo $va['goods_attr_id']?></span>
                                            <div style="float:left;width: 100%;margin-top: 0.05rem;">
                                                <span class="new_prize_80">&yen;<i><?php echo $va['goods_price']?></i></span>
                                                <span class="old_prize_80">&yen;<i><?php echo $va['market_price']?></i></span>
                                                <span class="num_80">&times; <i><?php echo $va['goods_number']?></i></span>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach;?>
                            </ul>
                            <div class="order_state_three">
                                <span>实付: <i num='<?php echo $value['goods_amount']?>'>&yen;<?php echo $value['goods_amount']?></i></span>
                                <span>共<i><?php echo $value['goods_count']?></i>件商品</span>
                            </div>
                            <div class="order_state_four">
                                <button type="button" class="receiving">确定收货</button>
                                <button type="button" class="logistics">查看物流</button>
                            </div>
                        </li>
                <?php elseif($value['shipping_status'] == 2 && $value['pay_status'] == 2 && $value['order_status'] == 1):?>
                    <!--待评价-->
                    <li>
                        <div class="order_state_one">
                            <span>订单号：<i><?php echo $value['orderSn']?></i></span>
                            <span class="waiting">待评价</span>
                        </div>
                        <ul class="order_goods_list order_state_two">
                            <?php foreach ($value['list'] as $t=>$val):?>
                                <li>
                                    <div class="imgarea_80">
                                        <img src="<?php echo \Yii::$app->params['admin_url'].$val['goods_thumb']?>"/>
                                    </div>
                                    <div class="goods_details_80">
                                        <a href="order_details.html" class="goods_name_80">
                                            <?php echo $val['goods_name']?>
                                        </a>
                                        <span class="color_80"><?php echo $val['goods_attr']?>分类:<?php echo $val['goods_attr_id']?></span>
                                        <div style="float:left;width: 100%;margin-top: 0.05rem;">
                                            <span class="new_prize_80">&yen;<i><?php echo $val['goods_price']?></i></span>
                                            <span class="old_prize_80">&yen;<i><?php echo $val['market_price']?></i></span>
                                            <span class="num_80">&times; <i><?php echo $val['goods_number']?></i></span>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach;?>
                        </ul>
                        <div class="order_state_three">
                            <span>实付: <i num='<?php echo $value['goods_amount']?>'><?php echo $value['goods_amount']?></i></span>
                            <span>共<i><?php echo $value['goods_count']?></i>件商品</span>
                        </div>
                        <div class="order_state_four">
                            <button type="button" class="evaluate">评价</button>
                            <button type="button" class="logistics">查看物流</button>
                        </div>
                    </li>
                <?php elseif($value['order_status'] == 1 && $value['shipping_status'] == 3   && $value['pay_status'] == 2):?>
                    <!--交易完成-->
                    <li>
                        <div class="order_state_one">
                            <span>订单号：<i><?php echo $value['orderSn']?></i></span>
                            <span class="waiting">交易完成</span>
                        </div>
                        <ul class="order_goods_list order_state_two">
                            <?php foreach ($value['list'] as $ti=>$valu):?>
                                <li>
                                    <div class="imgarea_80">
                                        <img src="<?php echo \Yii::$app->params['admin_url'].$valu['goods_thumb']?>"/>
                                    </div>
                                    <div class="goods_details_80">
                                        <a href="order_details.html" class="goods_name_80">
                                            <?php echo $valu['goods_name']?>
                                        </a>
                                        <span class="color_80"><?php echo $valu['goods_attr']?>分类:<?php echo $valu['goods_attr_id']?></span>
                                        <div style="float:left;width: 100%;margin-top: 0.05rem;">
                                            <span class="new_prize_80">&yen;<i><?php echo $valu['goods_price']?></i></span>
                                            <span class="old_prize_80">&yen;<i><?php echo $valu['market_price']?></i></span>
                                            <span class="num_80">&times; <i><?php echo $valu['goods_number']?></i></span>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach;?>
                        </ul>
                        <div class="order_state_three">
                            <span>实付: <i num='<?php echo $value['goods_amount']?>'>&yen;<?php echo $value['goods_amount']?></i></span>
                            <span>共<i><?php echo $value['goods_count']?></i>件商品</span>
                        </div>
                        <div class="order_state_four">
                            <button type="button" class="delete">删除订单</button>
                        </div>
                    </li>
                <?php elseif($value['order_status'] == 2):?>
                    <!--交易关闭-->
                    <li>
                        <div class="order_state_one">
                            <span>订单号：<i><?php echo $value['orderSn']?></i></span>
                            <span class="waiting">交易关闭</span>
                        </div>
                        <ul class="order_goods_list order_state_two">
                            <?php foreach ($value['list'] as $tim=>$i):?>
                                <li>
                                    <div class="imgarea_80">
                                        <img src="<?php echo \Yii::$app->params['admin_url'].$i['goods_thumb']?>"/>
                                    </div>
                                    <div class="goods_details_80">
                                        <a href="order_details.html" class="goods_name_80">
                                            <?php echo $i['goods_name']?>
                                        </a>
                                        <span class="color_80"><?php echo $i['goods_attr']?>分类:<?php echo $i['goods_attr_id']?></span>
                                        <div style="float:left;width: 100%;margin-top: 0.05rem;">
                                            <span class="new_prize_80">&yen;<i><?php echo $i['goods_price']?></i></span>
                                            <span class="old_prize_80">&yen;<i><?php echo $i['market_price']?></i></span>
<!--                                            <span class="refund">退款成功</span>-->
                                            <span class="num_80">&times; <i><?php echo $i['goods_number']?></i></span>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach;?>

                        </ul>
                        <div class="order_state_three">
                            <span>实付: <i num='<?php echo $value['goods_amount']?>'>&yen;<?php echo $value['goods_amount']?></i></span>
                            <span>共<i><?php echo $value['goods_count']?></i>件商品</span>
                        </div>
                        <div class="order_state_four">
                            <button type="button" class="delete">删除订单</button>
                        </div>
                    </li>
                <?php endif;?>
            <?php endforeach;?>
        <?php else:?>
            <!--暂无订单的情况-->
            <div class="bitmap_content order_bitmap_content" style="display: none;">
                <img src="/images/bitmap.png" class="bitmap"/>
                <span>暂无内容</span>
            </div>
        <?php endif;?>
    </ul>

<!--    待付款-->
    <ul>
        <?php if(!empty($not_paydate)):?>
            <?php foreach ($not_paydate as $key=>$value):?>
                <li>
                    <div class="order_state_one">
                        <span>订单号：<i><?php echo $value['orderSn']?></i></span>
                        <span class="waiting">待付款</span>
                    </div>
                    <ul class="order_goods_list order_state_two">
                        <?php foreach ($value['list'] as $k =>$v):?>
                            <li>
                                <div class="imgarea_80">
                                    <img src="<?php echo \Yii::$app->params['admin_url'].$v['goods_thumb']?>"/>
                                </div>
                                <div class="goods_details_80">
                                    <a href="order_details.html" class="goods_name_80">
                                        <?php echo $v['goods_name']?>
                                    </a>
                                    <span class="color_80"><?php echo $v['goods_attr']?>分类:<?php echo $v['goods_attr_id']?></span>
                                    <div style="float:left;width: 100%;margin-top: 0.05rem;">
                                        <span class="new_prize_80">&yen;<i><?php echo $v['goods_price']?></i></span>
                                        <span class="old_prize_80">&yen;<i><?php echo $v['market_price']?></i></span>
                                        <span class="num_80">&times; <i><?php echo $v['goods_number']?></i></span>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach;?>
                    </ul>
                    <div class="order_state_three">
                        <span>实付: <i num='<?php echo $value['goods_amount']?>'>&yen;<?php echo $value['goods_amount']?></i></span>
                        <span>共<i><?php echo $value['goods_count']?></i>件商品</span>
                    </div>
                    <div class="order_state_four">
                        <button type="button" class="order_pay">立即支付</button>
                        <button type="button" class="order_quit">取消订单</button>
                    </div>
                </li>
            <?php endforeach;?>
        <?php else:?>
            <!--暂无订单的情况-->
            <div class="bitmap_content order_bitmap_content" style="display: none;">
                <img src="/images/bitmap.png" class="bitmap"/>
                <span>暂无内容</span>
            </div>
        <?php endif;?>
    </ul>

<!--    待收货-->
    <ul>
        <?php if(!empty($pay_date)):?>
            <?php foreach ($pay_date as $key=>$value):?>
                <li>
                    <div class="order_state_one">
                        <span>订单号：<i><?php echo $value['orderSn']?></i></span>
                        <span class="waiting">待收货</span>
                    </div>
                    <ul class="order_goods_list order_state_two">
                        <?php foreach ($value['list'] as $item =>$va):?>
                            <li>
                                <div class="imgarea_80">
                                    <img src="<?php echo \Yii::$app->params['admin_url'].$va['goods_thumb']?>"/>
                                </div>
                                <div class="goods_details_80">
                                    <a href="order_details.html" class="goods_name_80">
                                        <?php echo $va['goods_name']?>
                                    </a>
                                    <span class="color_80"><?php echo $va['goods_attr']?>分类:<?php echo $va['goods_attr_id']?></span>
                                    <div style="float:left;width: 100%;margin-top: 0.05rem;">
                                        <span class="new_prize_80">&yen;<i><?php echo $va['goods_price']?></i></span>
                                        <span class="old_prize_80">&yen;<i><?php echo $va['market_price']?></i></span>
                                        <span class="num_80">&times; <i><?php echo $va['goods_number']?></i></span>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach;?>
                    </ul>
                    <div class="order_state_three">
                        <span>实付: <i num='<?php echo $value['goods_amount']?>'>&yen;<?php echo $value['goods_amount']?></i></span>
                        <span>共<i><?php echo $value['goods_count']?></i>件商品</span>
                    </div>
                    <div class="order_state_four">
                        <button type="button" class="receiving">确定收货</button>
                        <button type="button" class="logistics">查看物流</button>
                    </div>
                </li>
            <?php endforeach;?>
        <?php else:?>
            <div class="bitmap_content order_bitmap_content" style="display: none;">
                <img src="/images/bitmap.png" class="bitmap"/>
                <span>暂无内容</span>
            </div>
        <?php endif;?>
    </ul>
<!--    待评价-->
    <ul>
        <?php if(!empty($comment_date)):?>
            <?php foreach ($comment_date as $key=>$value):?>
                <li>
                    <div class="order_state_one">
                        <span>订单号：<i><?php echo $value['orderSn']?></i></span>
                        <span class="waiting">待评价</span>
                    </div>
                    <ul class="order_goods_list order_state_two">
                        <?php foreach ($value['list'] as $t=>$val):?>
                            <li>
                                <div class="imgarea_80">
                                    <img src="<?php echo \Yii::$app->params['admin_url'].$val['goods_thumb']?>"/>
                                </div>
                                <div class="goods_details_80">
                                    <a href="order_details.html" class="goods_name_80">
                                        <?php echo $val['goods_name']?>
                                    </a>
                                    <span class="color_80"><?php echo $val['goods_attr']?>分类:<?php echo $val['goods_attr_id']?></span>
                                    <div style="float:left;width: 100%;margin-top: 0.05rem;">
                                        <span class="new_prize_80">&yen;<i><?php echo $val['goods_price']?></i></span>
                                        <span class="old_prize_80">&yen;<i><?php echo $val['market_price']?></i></span>
                                        <span class="num_80">&times; <i><?php echo $val['goods_number']?></i></span>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach;?>
                    </ul>
                    <div class="order_state_three">
                        <span>实付: <i num='<?php echo $value['goods_amount']?>'><?php echo $value['goods_amount']?></i></span>
                        <span>共<i><?php echo $value['goods_count']?></i>件商品</span>
                    </div>
                    <div class="order_state_four">
                        <button type="button" class="evaluate">评价</button>
                        <button type="button" class="logistics">查看物流</button>
                    </div>
                </li>
            <?php endforeach;?>
        <?php else:?>
            <div class="bitmap_content order_bitmap_content" style="display: none;">
                <img src="/images/bitmap.png" class="bitmap"/>
                <span>暂无内容</span>
            </div>
        <?php endif;?>
    </ul>


    <ul>
        <li>
            <div class="order_state_one">
                <span>订单号：<i>SH201910051444633522424</i></span>
                <span class="waiting">交易关闭</span>
            </div>
            <ul class="order_goods_list order_state_two">
                <li>
                    <div class="imgarea_80">
                        <img src="/images/comment_img.jpg"/>
                    </div>
                    <div class="goods_details_80">
                        <a href="order_details.html" class="goods_name_80">
                            我是商品名称我是商品名称我是商品名称我是商品名称我是商品名称我是商品
                        </a>
                        <span class="color_80">颜色分类:酒红色;30片;100度酒红色;30片;100</span>
                        <div style="float:left;width: 100%;margin-top: 0.05rem;">
                            <span class="new_prize_80">&yen;<i>299.99</i></span>
                            <span class="old_prize_80">&yen;<i>350.52</i></span>
                            <span class="refund">退款成功</span>
                            <span class="num_80">&times; <i>12</i></span>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="order_state_three">
                <span>实付: <i num='2999.36'>&yen;2999.36</i></span>
                <span>共<i>15</i>件商品</span>
            </div>
            <div class="order_state_four">
                <button type="button" class="delete">删除订单</button>
            </div>
        </li>
    </ul>
</div>

<?php $this->beginBlock('self_js'); ?>
<script src="/js/common.js"></script>
<script type="text/javascript">

    layui.use(['layer'],function(){
        var layer=layui.layer;
        //点击订单状态;
        $(".states>li").click(function(){
            var index=$(this).index();
            $(this).addClass("active").siblings("li").removeClass("active");
            $(".order_state_block").children("ul").eq(index).addClass("active").siblings("ul").removeClass("active");
        });

        //点击取消订单;
        $(document).on("click",'.order_quit',function(){
            layer.confirm('确认取消该订单吗？', {
                btn: ['取消','确定'] //按钮
            },function(){
                layer.closeAll();
            },function(){
                layer.msg("取消成功");
            });
        });

        //点击查看物流;
        $(document).on("click",".logistics",function(){
            window.location.href="express.html";
        });

        //点击立即支付;
        $(document).on("click",'.order_pay',function(){

        });

        //点击确认收货;
        $(document).on("click",'.receiving',function(){
            layer.confirm('是否确认收货？', {
                btn: ['取消','确定'] //按钮
            },function(){
                layer.closeAll();
            },function(){
                layer.msg("确认成功");
            });
        });

        //点击删除订单;
        $(document).on("click",'.delete',function(){
            layer.confirm('是否删除订单？', {
                btn: ['取消','确定'] //按钮
            },function(){
                layer.closeAll();
            },function(){
                layer.msg("删除成功");
            });
        });

        //点击评价;
        $(document).on("click",".evaluate",function(){
            window.location.href="evaluate.html";
        });

    });


    //获取上个页面传递来的参数判断默认显示哪个部分;
    $(document).ready(function(){
        var type=getUrlParaanes("type");
        console.log(type)
        if(type==1){
            $(".states>li").eq(1).addClass("active").siblings("li").removeClass("active");
            $(".order_state_block>ul").eq(1).addClass("active").siblings("ul").removeClass("active");
        }else if(type==2){
            $(".states>li").eq(2).addClass("active").siblings("li").removeClass("active");
            $(".order_state_block>ul").eq(2).addClass("active").siblings("ul").removeClass("active");
        }else if(type==3){
            $(".states>li").eq(3).addClass("active").siblings("li").removeClass("active");
            $(".order_state_block>ul").eq(3).addClass("active").siblings("ul").removeClass("active");
        }else if(type==4){
            $(".states>li").eq(4).addClass("active").siblings("li").removeClass("active");
            $(".order_state_block>ul").eq(4).addClass("active").siblings("ul").removeClass("active");
        }else{
            $(".states>li").eq(0).addClass("active").siblings("li").removeClass("active");
            $(".order_state_block>ul").eq(0).addClass("active").siblings("ul").removeClass("active");
        }
    });

</script>
<?php $this->endBlock(); ?>
</body>
