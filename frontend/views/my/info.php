<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/26 0026
 * Time: 16:28
 */
use yii\helpers\Url;
?>
<?php $this->beginBlock('self_css'); ?>
<?php $this->endBlock(); ?>
<body>
<header id="head" class='info_my'>
       	   <span class="last" onclick="window.location.href='/my/index' ">
       	   	 <img src="/images/last.png"/>
       	   </span>
    <h3 class="info_about">个人资料</h3>
</header>
<ul class="peoples">
    <input type="hidden" id="user_id" value="<?php echo $user_date['user_id']?>">
    <li>
        <span>头像</span>
        <img src="<?php  echo $user_date['img_url']?Yii::$app->params['imgurl'].$user_date['img_url']:'/images/head_images.jpg'?>" class="head_images" id="head_images" />
    </li>
    <li>
        <span>用户名</span>
        <img src="/images/next-333.png" class="next-333"/>
        <input type="text" name="name" class="name username" value="<?php echo $user_date['user_name']?>"/>
    </li>
    <li>
        <span>性别</span>
        <img src="/images/next-333.png" class="next-333"/>
        <?php if($user_date['sex'] == 0):?>
            <span class="name Gender_name" style="width:1rem;text-align: right;">保密</span>
        <?php elseif($user_date['sex'] == 1):?>
            <span class="name Gender_name" style="width:1rem;text-align: right;">男</span>
        <?php else:?>
            <span class="name Gender_name" style="width:1rem;text-align: right;">女</span>
        <?php endif;?>
    </li>
    <li>
        <span>手机号</span>
        <img src="/images/next-333.png" class="next-333"/>
        <a class="name modify_phone" href="modify_phone.html" style="font-size:0.15rem!important;"><?php echo $user_date['mobile_phone']?></a>
    </li>
    <li style="border-bottom:none;" onclick="window.location.href='/login/forgot-password' ">
        <span>修改密码</span>
        <img src="/images/next-333.png" class="next-333"/>
        <span class="name" style="width:1rem;text-align: right;"></span>
    </li>
    <li style="margin-top: 0.1rem;border-bottom:none;">
        <span class="exit_login">退出登录</span>
    </li>
</ul>

<div class="shadow"></div>
<!--性别框-->
<div class="Gender">
    <div class="Gender_title">选择性别</div>
    <ul class="Gender_list">
        <li>
            <span>男</span>
        </li>
        <li>
            <span>女</span>
        </li>
        <li>
            <span>保密</span>
        </li>
    </ul>
</div>

<?php $this->beginBlock('self_js'); ?>
<script src="/js/common.js"></script>
<script>
    layui.use(['layer','upload'],function(){
        var layer=layui.layer,
            upload=layui.upload;

        // 上传头像;
        var uploadInst = upload.render({
            elem: '#head_images' //绑定元素
            ,url: '/index.php/my/upload' //上传接口
            ,done: function(res){
                if(res.code == 20000){
                    layer.msg(res.message);
                    window.location.reload()
                }else{
                    layer.msg(res.message);
                }

            }
        });

        //点击性别;
        $(".Gender_name").on("click",function(){
            $(".shadow").show();
            $(".Gender").animate({
                "bottom":0
            },300);
        });

        //点击阴影层;
        $(".shadow").click(function(){
            $(".shadow").hide();
            $('.Gender').animate({
                "bottom":"-3rem"
            },300);
        });

        //点击性别男女保密;
        $(".Gender_list>li").on("click",function(){
            var title=$(this).children("span").text();
            $(".Gender_name").text(title);
            $(".shadow").hide();
            $('.Gender').animate({
                "bottom":"-3rem"
            },300);
        });

        $(".exit_login").on("click",function(){
            layer.confirm('确定退出登录吗？', {
                btn: ['取消','确定'] //按钮
            }, function(){
                layer.closeAll();
            }, function(){
                var  user_id = $("#user_id").val();
                $.ajax({
                    url:"/index.php/login/outlogin",
                    type:"POST",
                    dataType:"json",
                    data:{user_id:user_id,},
                    success:function(res){
                        if(res.code == 20000){
                            layer.msg(res.message);
                            window.location.href="/index/index";
                        }else{
                            layer.msg(res.message);
                            window.location.reload();
                        }
                    },
                });
                return false;
            });
        });
    });
</script>
<?php $this->endBlock(); ?>



</body>