<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/21 0021
 * Time: 0:39
 */
?>
<?php $this->beginBlock('self_css'); ?>

<?php $this->endBlock(); ?>
<body class="white">
<span class="password">密码登录</span>
<span class="no_password">免密码登录</span>
<div class="password_login">
    <h3 class="write_code login_code">手机号码登录</h3>
    <input type="number" name="new_phone" class="new_phone new_phone2" maxlength="11" placeholder="请输入手机号码"/>
    <button type="button" class="getnewcode disab_get" disabled="disabled">获取验证码</button>
    <p class="read">点击按钮表示您已阅读并同意<a href=""> 《用户协议》</a></p>
</div>

<div class="no_password_login">
    <h3 class="write_code login_code">密码登录</h3>
    <input type="number" name="new_phone2" class="new_phone new_phone3" maxlength="11" placeholder="请输入手机号码"/>
    <div class="password_text">
        <input type="password" placeholder="请输入密码" class="password_val"/>
        <span class="open_closed" type="false"><img src="/images/close.png"/></span>
    </div>
    <button type="button" class="getnewcode no_password_login_btn" disabled="disabled">获取验证码</button>

</div>
<?php $this->beginBlock('self_js'); ?>
<script src="/js/common.js"></script>
<script>
    layui.use(['layer'],function(){
        var layer=layui.layer;
        //监听手机输入框;
        $(".new_phone2").on("input",function(){
            var new_phone2=$(this).val();
            if(new_phone2.length==11){
                $(".disab_get").removeAttr("disabled").css("opacity","1");
            }else{
                $(".disab_get").attr("disabled","disabled").css("opacity","0.5");
            }
        });

        //点击获取验证码;
        $(".disab_get").on("click",function(){
            var new_phone2=$(".new_phone2").val();
            $.ajax({
                url:"/index.php/login/login",
                type:"POST",
                dataType:"json",
                data:{'new_phone2':new_phone2,},
                success:function(res){
                    console.log(res);
                    return false;
                    if(res.code == 20000){
                        layer.msg(res.message);
                        window.location.reload();
                    }else{
                        layer.msg(res.message);
                        window.location.reload();
                    }
                },
            });
            // window.location.href="code_login.html";
        });

        //点击密码登录;
        $(".password").click(function(){
            $(this).hide();
            $(".password_login").hide();
            $(".no_password").show();
            $(".no_password_login").show();
        });

        //点击免密码登录;
        $(".no_password").click(function(){
            $(this).hide();
            $(".password").show();
            $(".no_password_login").hide();
            $(".password_login").show();
        });

        //点击开关密码;
        $(".open_closed").click(function(){
            var type=$(this).attr("type");
            if(type=="false"){
                $(this).attr("type","true");
                $(this).children("img").attr("src","/images/open.png");
                $(".password_text>input").attr("type","text");
            }else if(type=="true"){
                $(this).attr("type","false");
                $(this).children("img").attr("src","/images/close.png");
                $(".password_text>input").attr("type","password");
            }
        });

        //监听手机号密码;
        $(".new_phone3").on("input",function(){
            var new_phone3=$(this).val();
            var password_val=$(".password_val").val();
            if(new_phone3.length==11 && password_val!=""){
                $(".no_password_login_btn").removeAttr("disabled").css("opacity","1");
            }else{
                $(".no_password_login_btn").attr("disabled","disabled").css("opacity","0.5");
            }
        });

        //监听密码;
        $(".password_val").on("input",function(){
            var password_val=$(this).val();
            var new_phone3=$(".new_phone3").val();
            if(new_phone3.length==11 && password_val!=""){
                $(".no_password_login_btn").removeAttr("disabled").css("opacity","1");
            }else{
                $(".no_password_login_btn").attr("disabled","disabled").css("opacity","0.5");
            }
        });

    });
</script>
<?php $this->endBlock(); ?>
</body>
