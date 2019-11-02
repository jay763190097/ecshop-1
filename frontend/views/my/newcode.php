<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/2 0002
 * Time: 23:48
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
<h3 class="write_code">输入验证码</h3>
<span class="reserver">短信已发送至 <?php echo $mobile_old?></span>
<input type="hidden" id="mobile" value="<?php echo $mobile?>">

<div class="inputs">
    <input type="text" name="num1" value="" maxlength="1" />
    <input type="text" name="num2" value="" maxlength="1" />
    <input type="text" name="num3" maxlength="1" />
    <input type="text" name="num4" maxlength="1" />
</div>
<span class="reget">60s后可重新获取</span>
<span class="re_get">重发短信验证码</span>

<?php $this->beginBlock('self_js'); ?>
<script src="/js/common.js"></script>

<script>
    var wait = 60;
    function time() {
        $(".re_get").hide();
        if (wait == 0) {
            $(".reget").hide();
            $(".re_get").show();
            wait = 60;
        } else {
            $(".reget").text( + wait + "s后可重新获取");
            wait--;
            setTimeout(function () {
                time();
            }, 1000)
        }
    };

    time();

    $(".re_get").click(function(){
        $(".reget").show();
        time();
    });

    layui.use(['layer'],function(){
        var layer=layui.layer;

        $("input[name='num1']").keyup(function(){
            if($(this).val()!=""){
                $("input[name='num2']").focus();
            }
        });
        $("input[name='num2']").keyup(function(){
            if($(this).val()!=""){
                $("input[name='num3']").focus();
            }
        });
        $("input[name='num3']").keyup(function(){
            if($(this).val()!=""){
                $("input[name='num4']").focus();
            }
        });
        $("input[name='num4']").keyup(function(){
            if($("input[name='num1']").val()!="" && $("input[name='num2']").val()!="" && $("input[name='num3']").val()!="" && $("input[name='num4']").val()!=""){
                var  mobile = $("#mobile").val();
                var num1 = $("input[name='num1']").val();
                var num2 = $("input[name='num2']").val();
                var num3 = $("input[name='num3']").val();
                var num4 = $("input[name='num4']").val();
                var code = num1+num2+num3+num4

                $.ajax({
                    url:"",
                    type:"POST",
                    dataType:"json",
                    data:{mobile_phone:mobile,code:code},
                    success:function(res){
                        if(res.code == 20000){
                            layer.msg(res.message);
                            setTimeout(function(){
                                window.location.href = "/my/info";
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
