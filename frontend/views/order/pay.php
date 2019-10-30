<?php

/**

 * Created by PhpStorm.

 * User: Administrator

 * Date: 2019/10/27 0027

 * Time: 18:59

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

    <h3 class="info_about">确认订单</h3>

</header>

<?php if($user_address):?>

    <div class="has_address">

        <div class="has_top">

            <div>

                <span class="has_top_name"><?php echo $user_address['address_name']?></span>

                <span class="has_top_phone"><?php echo $user_address['mobile']?></span>

                <p>

                    <?php echo $user_address['district']." ".$user_address['address']?>

                </p>

            </div>

            <img src="/images/next-333.png" class="has_top_img"/>

        </div>

        <div class="has_bottom">

            <span>身份证号</span>

            <input type="text" name="id_card" placeholder="因海关需要，请填写收货人身份证号码"/>

        </div>

    </div>

    <input type="hidden" name="address_show_hidden" value="<?php echo $user_address['district']." ".$user_address['address']?>"/> <!--根据情况修改hidden；判断是否有地址信息-->

<?php else:?>

    <div class="order_address">

        <span>地址栏为空，请添加</span>

        <img src="/images/next-333.png"/>

    </div>

    <input type="hidden" name="address_show_hidden" value="0

"/> <!--根据情况修改hidden；判断是否有地址信息-->

<?php endif;?>







<ul class="order_goods_list">

    <?php if($order):?>

        <?php foreach ($order as $key=>$value):?>

            <li>

                <div class="imgarea_80">

                    <img src="<?php echo Yii::$app->params['admin_url'].'/'.$value['goods_thumb']?>"/>

                </div>

                <div class="goods_details_80">

                    <a href="goods_details.html" class="goods_name_80">

                        <?php echo $value['goods_name']?>

                    </a>

                    <span class="color_80"><?php echo $value['goods_attr'].'分类：'.$value['goods_attr_id']?></span>

                    <div style="float:left;width: 100%;margin-top: 0.05rem;">

                        <span class="new_prize_80">&yen;<i><?php echo $value['goods_price']?></i></span>

                        <span class="old_prize_80">&yen;<i><?php echo $value['market_price']?></i></span>

                        <span class="num_80">&times; <i><?php echo $value['goods_num']?></i></span>

                    </div>

                </div>

            </li>

        <?php endforeach;?>

    <?php endif;?>



</ul>

<ul class="buy_goods_info">

    <li>

        <span>商品金额</span>

        <span>&yen;<i><?php echo $good_sum?></i></span>

    </li>

    <li>

        <span>运费</span>

        <?php if($freight != 0):?>

            <span>+ &yen;<i><?php echo $freight?></i></span>

        <?php else:?>

            <span>商家代付</span>

        <?php endif;?>





    </li>

    <li>

        <span>优惠券</span>

        <?php if($userBonus != 0):?>

            <span>- &yen;<i><?php echo $userBonus?></i></span>

        <?php else:?>

            <span> - &yen;<i>0</i> </span>

        <?php endif;?>

    </li>

</ul>



<div class="remarks">

    <span>留言 : </span>

    <input type="text" name="remarks" placeholder="选填，请先和商家协商一致"/>

</div>



<div class="foot">

    <div class="foot_prize">

        <span>实付: </span>

        <span class="foot_prize_num">&yen;<i><?php echo $sum?></i></span>

    </div>

    <button type="button" class="to_pay_goods">提交订单</button>

</div>



<?php $this->beginBlock('self_js'); ?>

<script src="/js/common.js"></script>



<script type="text/javascript">



    layui.use(['layer'],function(){

        var layer=layui.layer;

        //点击地址;

        $(".order_address").click(function(){

            window.location.href="/my/manage-address";

        });



        $(".has_top").click(function(){

            window.location.href="/my/manage-address";

        });



        //点击提交订单;

        $(".to_pay_goods").click(function(){

            var address_show_hidden=$("input[name='address_show_hidden']").val();

            var id_card=$("input[name='id_card']").val();

            var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;

            if(address_show_hidden=='0'){

                layer.msg("请添加地址");

                return false;

            }else if(id_card==""){

                layer.msg("请输入身份证号");

                return false;

            }else if(reg.test(id_card) === false){

                layer.msg("请输入正确的身份证号");

                return false;

            }else{

                layer.msg("购买成功");

            }

        });



    });

</script>

<?php $this->endBlock(); ?>

</body>

