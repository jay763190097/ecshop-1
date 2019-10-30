<?php

/**

 * Created by PhpStorm.

 * User: Administrator

 * Date: 2019/10/26 0026

 * Time: 21:59

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

    <h3 class="info_about">管理收货地址</h3>

</header>



    <?php if ($address_date):?>

        <ul class="address_list">

        <?php foreach ($address_date as $key=>$value):?>

            <li>

                <div class="address_top">

                    <span><?php echo $value['address_name']?></span>

                    <span><?php echo $value['mobile']?></span>

                    <p class="address_details">

                        <?php echo $value['district'].' '.$value['address']?>

                    </p>

                </div>

                <div class="address_bottom">

                    <?php if($value['is_default'] == 1):?>

                    <div class="active" data-id="<?php echo $value['address_id']?>">

                        <img src="/images/address_checked.png"/>

                    <?php else:?>

                        <div class=" " data-id="<?php echo $value['address_id']?>">

                            <img src="/images/address_nocheck.png"/>

                    <?php endif;?>

                        <span>默认地址</span>

                    </div>

                    <span class="del_address" data-id="<?php echo $value['address_id']?>">删除</span>

                    <a href="<?php echo Url::to(['/my/edit-address?id='.$value['address_id']]) ?>" class="modify_address">编辑</a>

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



<a href="<?php echo Url::to(['/my/addaddress']) ?>" class="add_address">添加新地址</a>



<?php $this->beginBlock('self_js'); ?>

<script src="/js/common.js"></script>



<script type="text/javascript">

    //点击设为默认;

    layui.use(['layer'],function(){

        var layer=layui.layer;

        $(".address_bottom>div").click(function(){

            var address_id = $(this).attr('data-id');

            var class_date = $(this).attr('class');

            if(class_date != "active"){

                $.ajax({

                    url:"/my/is-default",

                    type:"POST",

                    dataType:"json",

                    data:{address_id:address_id,},

                    success:function(res){

                        console.log(res);

                        return false

                        if(res.code == 20000){

                            layer.msg(res.message);

                            $(this).addClass("active").children("img").attr("src","/images/address_checked.png").parents("li").siblings("li").children(".address_bottom").children("div").removeClass("active").children("img").attr("src","/images/address_nocheck.png");

                            window.location.reload();

                        }else{

                            layer.msg(res.message);

                            window.location.reload();

                        }

                    },

                })

            }

        });



        //点击删除收货地址;

        $(".del_address").click(function(){

            var address_id = $(this).attr('data-id')

            if($(this).siblings("div").hasClass("active")){

                layer.msg("默认地址不能删除");

                return false;

            }else{

                layer.confirm('确认删除收货地址？', {

                    btn: ['取消','确定'] //按钮

                },function(){

                    layer.closeAll();

                },function(){

                    $.ajax({

                        url:"/index.php/my/del-address",

                        type:"POST",

                        dataType:"json",

                        data:{address_id:address_id,},

                        success:function(res){

                            if(res.code == 20000){

                                layer.msg(res.message);

                                window.location.reload();

                            }else{

                                layer.msg(res.message);

                                window.location.reload();

                            }

                        },

                    });

                });

            }

        });

    });



</script>

<?php $this->endBlock(); ?>

</body>

