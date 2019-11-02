<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/2 0002
 * Time: 23:33
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
<h3 class="write_code">新手机号码</h3>
<input type="number" name="new_phone" class="new_phone" maxlength="11" placeholder="请输入新手机号码"/>
<button type="button" class="getnewcode">获取验证码</button>

<?php $this->beginBlock('self_js'); ?>

<script src="/js/common.js"></script>
<script>
    layui.use(['layer'],function(){
        var layer=layui.layer;

        $(".getnewcode").on("click",function(){
            var new_phone=$(".new_phone").val();
            if(new_phone==""){
                layer.msg("请输入手机号");
                return false;
            }else{
                $.ajax({
                    url:"",
                    type:"POST",
                    dataType:"json",
                    data:{mobile:new_phone},
                    success:function(res){
                        if(res.code == 20000){
                            layer.msg(res.message);
                            setTimeout(function(){
                                window.location.href="/my/newcode?mobile="+res.mobile;
                            },2000);
                        }else{
                            layer.msg(res.message);
                            setTimeout(function(){
                                window.location.reload();
                            },2000);
                        }
                    },
                });
            }
        });

    });
</script>
<?php $this->endBlock(); ?>
</body>
