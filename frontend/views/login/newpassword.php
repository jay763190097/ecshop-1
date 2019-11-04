<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/4 0004
 * Time: 23:08
 */
use yii\helpers\Url;
?>
<?php $this->beginBlock('self_css'); ?>
<?php $this->endBlock(); ?>
<body class="white">
<header id="head" class='info_my'>
       	   <span class="last" onclick="history.go(-1)">
       	   	 <img src="/images/last.png"/>
       	   </span>
    <h3 class="info_about"></h3>
</header>
<div class="no_password_login" style="display: block;">
    <h3 class="write_code login_code" style="margin-bottom: 0.2rem;">设置新密码</h3>
    <div class="password_text">
        <input type="password" placeholder="请输入密码" class="password_val" name="password1"/>
        <span class="open_closed" type="false"><img src="/images/close.png"/></span>
    </div>
    <div class="password_text">
        <input type="password" placeholder="请输入密码" class="password_val" name="password2"/>
        <span class="open_closed" type="false"><img src="/images/close.png"/></span>
    </div>
    <button type="button" class="getnewcode no_password_login_btn" disabled="disabled" id="definite">确定</button>

</div>

<?php $this->beginBlock('self_js'); ?>

<script src="/js/common.js"></script>

<script>
    layui.use(['layer'],function(){
        var layer=layui.layer;

        //点击开关密码;
        $(".open_closed").click(function(){
            var type=$(this).attr("type");
            if(type=="false"){
                $(this).attr("type","true");
                $(this).children("img").attr("src","/images/open.png");
                $(this).siblings("input").attr("type","text");
            }else if(type=="true"){
                $(this).attr("type","false");
                $(this).children("img").attr("src","/images/close.png");
                $(this).siblings("input").attr("type","password");
            }
        });


        //监听密码;
        $("input[name='password1']").on("input",function(){
            var password1=$(this).val();
            var password2=$("input[name='password2']").val();
            if(password1!="" && password2!=""){
                $(".no_password_login_btn").removeAttr("disabled").css("opacity","1");
            }else{
                $(".no_password_login_btn").attr("disabled","disabled").css("opacity","0.5");
            }
        });

        $("input[name='password2']").on("input",function(){
            var password2=$(this).val();
            var password1=$("input[name='password1']").val();
            if(password1!="" && password2!=""){
                $(".no_password_login_btn").removeAttr("disabled").css("opacity","1");
            }else{
                $(".no_password_login_btn").attr("disabled","disabled").css("opacity","0.5");
            }
        });

        $("#definite").click(function () {
            var password1 = $("input[name='password1']").val();
            var password2 = $("input[name='password2']").val();

            if(password1 != password2){
                layer.msg("请确认两次输入的密码是否一致！");
            }
            $.ajax({
                url:"",
                type:"POST",
                dataType:"json",
                data:{password1:password1,password2:password2},
                success:function(res){
                    if(res.code == 20000){
                        layer.msg(res.message);
                        setTimeout(function(){
                            window.location.href="/my/info";
                        },2000);
                    }else{
                        layer.msg(res.message);
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                    }
                },
            });
        })

    });

</script>
<?php $this->endBlock(); ?>
</body>
