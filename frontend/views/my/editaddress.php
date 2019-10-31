<?php

/**

 * Created by PhpStorm.

 * User: Administrator

 * Date: 2019/10/27 0027

 * Time: 0:37

 */

use yii\helpers\Url;

?>

<?php $this->beginBlock('self_css'); ?>

<?php $this->endBlock(); ?>

<body class="">

<header id="head" class='info_my'>

       	   <span class="last" onclick="history.go(-1)">

       	   	 <img src="images/last.png"/>

       	   </span>

    <h3 class="info_about" style="width:calc(100% - 0.85rem);">修改地址</h3>

    <span class="tosave">保存</span>

</header>



    <?php if($address_date):?>

        <input type="hidden" id="address_id" value="<?php echo $address_date['address_id']?>">

        <ul class="add_address_lists">

            <li>

                <span>收货人</span>

                <input type="text" name="username" placeholder="请输入收货人姓名" value="<?php echo $address_date['address_name']?>"/>

            </li>

            <li>

                <span>联系电话</span>

                <input type="nmber" name="phone" placeholder="请输入收货人电话" value="<?php echo $address_date['mobile']?>"/>

            </li>

            <li>

                <span>所在地区</span>

                <input type="text" id="expressArea" name="area" readonly="readonly" placeholder="请选择省市区"/>

                <img src="/images/next-333.png" class="get_province"/>

            </li>

            <li style="height: auto;">

                <textarea placeholder="请输入详细地址" name="address_details"><?php echo $address_date['address']?></textarea>

            </li>

            <li>

                <span>设为默认地址</span>

                <?php if($address_date['is_default'] == 1):?>

                    <div class="moren" type="1">  <!--0为非默认,1默认-->

                        <img src="/images/address_checked.png"/>

                    </div>

                <?php else:?>

                    <div class="moren" type="0">  <!--0为非默认,1默认-->

                        <img src="/images/address_nocheck.png"/>

                    </div>

                <?php endif;?>

            </li>

        </ul>

    <?php else:?>

        <div class="bitmap_content" style="display: block;">

            <img src="/images/bitmap.png" class="bitmap"/>

            <span>暂无内容</span>

        </div>

    <?php endif;?>

<!--选择地区弹层-->

<section id="areaLayer" class="express-area-box">

    <header>

        <h3>选择地区</h3>

        <a id="backUp" class="back" href="javascript:void(0)" title="返回"></a>

        <a id="closeArea" class="close" href="javascript:void(0)" title="关闭"></a>

    </header>

    <article id="areaBox">

        <ul id="areaList" class="area-list"></ul>

    </article>

</section>

<!--遮罩层-->

<div id="areaMask" class="mask"></div>



<?php $this->beginBlock('self_js'); ?>

<script src="/js/jquery.area.js"></script>



<script src="/js/common.js"></script>



<script type="text/javascript">



    layui.use(['layer'],function(){

        var layer=layui.layer;

        //点击设为默认;

        $(".moren").click(function(){

            var type=$(this).attr("type");

            if(type=='0'){

                $(".moren").children("img").attr("src","/images/address_checked.png");

                $(this).attr("type",'1');

            }else if(type=='1'){

                $(".moren").children("img").attr("src","/images/address_nocheck.png");

                $(this).attr("type",'0');

            }

        });



        //点击保存;

        $(".tosave").click(function(){

            var  address_id = $("#address_id").val();

            var username=$("input[name='username']").val();

            var phone=$("input[name='phone']").val();

            var area=$("input[name='area']").val();

            var address_details=$("textarea").val();

            var type=$(".moren").attr("type");

            if(username==""){

                layer.msg("姓名不能为空");

                return false;

            }else if(phone==""){

                layer.msg("电话不能为空");

                return false;

            }

            // else if(area==""){

            //     layer.msg("地区不能为空");

            //     return false;

            // }

            else if(address_details==""){

                layer.msg("详细地址不能为空");

                return false;

            }else{

                //请求;

                $.ajax({

                    url:"",

                    type:"POST",

                    dataType:"json",

                    data:{address_id:address_id,address_name:username,mobile:phone,district:area,address:address_details,is_default:type},

                    success:function(res){

                        if(res.code == 20000){

                            layer.msg(res.message);

                            window.location.href="/my/manage-address";

                        }else{

                            layer.msg(res.message);

                            window.location.reload();

                        }

                    },

                });

                layer.msg("修改成功");

            }

        });

    });

</script>

<?php $this->endBlock(); ?>

</body>

