<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/30 0030
 * Time: 0:36
 */
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
<h3 class="write_code">输入验证码</h3>
<span class="reserver">短信已发送至 <?php echo $mobile_old?></span>
<input type="hidden" id="mobile" value="<?php echo $mobile?>">

<div class="inputs login_inputs">
    <input type="text" name="num1" value="" maxlength="1" onKeyUp="return t1(this)"/>
    <input type="text" name="num2" value="" maxlength="1" onKeyUp="return t2(this)"/>
    <input type="text" name="num3" maxlength="1" onKeyUp="return t3(this)"/>
    <input type="text" name="num4" maxlength="1" onKeyUp="return t4(this)"/>
</div>
<span class="reget"><i>60</i>s后可重新获取</span>
<span class="re_get">重发短信验证码</span>

<?php $this->beginBlock('self_js'); ?>
<script src="/js/common.js"></script>


<script>

    function t1(obj){
        if($(obj).val()!=""){
            $(obj).css("border-bottom","2px solid #ff8e87");
            $("input[name='num2']").focus();
        }
    };

    function t2(obj){
        if($(obj).val()!=""){
            $(obj).css("border-bottom","2px solid #ff8e87");
            $("input[name='num3']").focus();
        }
    };

    function t3(obj){
        if($(obj).val()!=""){
            $(obj).css("border-bottom","2px solid #ff8e87");
            $("input[name='num4']").focus();
        }
    };

    function t4(obj){
        if($("input[name='num2']").val()!="" && $("input[name='num2']").val()!="" && $("input[name='num3']").val()!="" && $("input[name='num4']").val()!=""){
            $(obj).css("border-bottom","2px solid #ff8e87");
            var  mobile = $("#mobile").val();
            var num1 = $("input[name='num1']").val();
            var num2 = $("input[name='num2']").val();
            var num3 = $("input[name='num3']").val();
            var num4 = $("input[name='num4']").val();
            var code = num1+num2+num3+num4

            $.ajax({
                url:"/index.php/login/verification",
                type:"POST",
                dataType:"json",
                data:{mobile:mobile,code:code},
                success:function(res){
                    if(res.code == 20000){
                        layer.msg(res.message);
                        window.location.href = "/index/index";
                    }else{
                        layer.msg(res.message);
                        window.location.href = "/login/login";
                    }
                },
            });
        }
    };

</script>
<?php $this->endBlock(); ?>
</body>
