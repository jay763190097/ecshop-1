<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/23 0023
 * Time: 1:05
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
    <h3 class="info_about">意见反馈</h3>
</header>
<div class="Opinion">
    <span>问题和意见</span>
    <textarea id="customerMessage" placeholder="请输入您的问题和建议" maxlength="300"></textarea>
    <span class="numbers"><i>0</i>/300</span>
</div>
<button type="button" class="submit">提交</button>

<?php $this->beginBlock('self_js'); ?>
<script src="/js/common.js"></script>
<script>

    window.onload = function () {
        var el = document.getElementById('customerMessage');
        el.addEventListener('input',function () {
            var len = el.value.length;
            $(".numbers i").text(len);
        });
    };

    layui.use(['form'],function(){
        var form=layui.form;
        $(".submit").on("click",function(){
            var customerMessage=$("#customerMessage").val();
            if(customerMessage==""){
                layer.msg("请输入您的问题和建议");
                return false;
            }else{
                $.ajax({
                    url:"/index.php/my/feedback",
                    type:"POST",
                    dataType:"json",
                    data:{'customerMessage':customerMessage,},
                    success:function(res){
                        if(res.code == 20000){
                            layer.msg(res.message);
                            history.go(-1);
                        }else{
                            layer.msg(res.message);
                            window.location.reload();
                        }
                    },
                });
                $("#customerMessage").val("");
            }
        });
    });

</script>
<?php $this->endBlock(); ?>


</body>
