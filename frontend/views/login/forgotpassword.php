<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/26 0026
 * Time: 21:53
 */
use yii\helpers\Url;
?>
<?php $this->beginBlock('self_css'); ?>
<?php $this->endBlock(); ?>
<body class="white">
<header id="head" class='info_my'>
       	   <span class="last" onclick="history.go(-1)">
       	   	 <img src="images/last.png"/>
       	   </span>
    <h3 class="info_about"></h3>
</header>
<h3 class="write_code">忘记密码</h3>

<div class="no_password_login" style="display: block;">
    <input type="text" name="num1" class="new_phone new_phone3" value="" placeholder="请输入手机号码" maxlength="11" onKeyUp="return t1(this)"/>
    <button class="getnewcode no_password_login_btn" disabled="disabled">确定</button>
</div>

<?php $this->beginBlock('self_js'); ?>
<script src="/js/common.js"></script>
<script>
    layui.use(['layer'],function(){
        var layer=layui.layer;
        $(".new_phone3").on("input",function(){
            var new_phone3=$(this).val();
            if(new_phone3.length==11){
                $(".no_password_login_btn").removeAttr("disabled").css("opacity","1");
            }else{
                $(".no_password_login_btn").attr("disabled","disabled").css("opacity","0.5");
            }
        });

        $(".no_password_login_btn").on("click",function(){
            var new_phone2=$(".new_phone3").val();
            window.location.href="new_password.html";
        });


    });

</script>
<?php $this->endBlock(); ?>
</body>
