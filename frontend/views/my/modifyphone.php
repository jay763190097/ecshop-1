<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/2 0002
 * Time: 22:59
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
    <h3 class="info_about">验证手机号</h3>
</header>
<span class="Verification">为确保账户安全,更换手机前需验证手机号</span>
<span class="phone_detail"><?php echo $mobile?></span>
<input type="hidden" id="mobile" value="<?php echo $user_date['mobile_phone']?>">
<button type="button" class="getcode">获取验证码</button>

<?php $this->beginBlock('self_js'); ?>

<script src="/js/common.js"></script>
<script>
    $(".getcode").on("click",function(){
        var mobile = $("#mobile").val();
        $.ajax({
            url:"",
            type:"POST",
            data:{mobile:mobile},
            dataType:"json",
            success:function(res){
                if(res.code == 20000){
                    layer.msg(res.message);
                    window.location.href="/my/modifyphonecode?mobile="+res.mobile;
                }else{
                    layer.msg(res.message);
                    window.location.reload();
                }
            },
        });
    });
</script>
<?php $this->endBlock(); ?>
</body>
