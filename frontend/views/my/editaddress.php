<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/31 0031
 * Time: 23:03
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
            <input type="text" id="expressArea" name="area" readonly="readonly" placeholder="请选择省市区" value="<?php echo $address_date['district']?>"/>
            <img src="/images/next-333.png" class="get_province"/>
            <input id="expressArea_code" type="hidden"/>
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
<script src="/js/common.js"></script>
<script src="/js/area.js"></script>
<script type="text/javascript">

    $(document).ready(function(){
        /*打开省市区选项*/
        $("#expressArea").click(function() {
            $("#areaMask").fadeIn();
            $("#areaLayer").animate({"bottom": 0});
        });
        /*关闭省市区选项*/
        $("#areaMask, #closeArea").click(function() {
            clockArea();
        });
    });

    console.log(area);
    //省市区功能;
    var expressArea,expressArea_code, areaCont, areaList = $("#areaList"), areaTop = areaList.offset().top;
    function intProvince() {
        areaCont = "";
        for (var i=0; i<area.province.length; i++) {
            areaCont += '<li onClick="selectP(' + i + ')">' + area.province[i].name + '</li>';
        };
        areaList.html(areaCont);
        $("#areaBox").scrollTop(0);
        $("#backUp").removeAttr("onClick").hide();
    };
    intProvince();

    /*选择省份*/
    function selectP(p) {
        areaCont = "";
        areaList.html("");
        for (var j=0; j<area.province[p].city.length; j++) {
            areaCont += '<li onClick="selectC(' + p + ',' + j + ');">' + area.province[p].city[j].name + '</li>';
        }
        areaList.html(areaCont);
        $("#areaBox").scrollTop(0);
        expressArea = area.province[p].name + " ";
        expressArea_code= area.province[p].code + " ";
        $("#backUp").attr("onClick", "intProvince();").show();
    };

    /*选择城市*/
    function selectC(p,c) {
        areaCont = "";
        for (var k=0; k<area.province[p].city[c].district.length; k++) {
            areaCont += '<li onClick="selectD(' + p + ',' + c + ',' + k + ');">' + area.province[p].city[c].district[k].name + '</li>';
        }
        areaList.html(areaCont);
        $("#areaBox").scrollTop(0);
        var sCity = area.province[p].city[c].name;
        var sCity_code= area.province[p].city[c].code;
        expressArea += sCity + " ";
        expressArea_code +=sCity_code + " ";
        $("#backUp").attr("onClick", "selectP(" + p + ");");
    };

    /*选择区县*/
    function selectD(p,c,d) {
        clockArea();
        expressArea += area.province[p].city[c].district[d].name;
        expressArea_code += area.province[p].city[c].district[d].code;
        $("#expressArea").val(expressArea);
        $("#expressArea_code").val(expressArea_code);
        console.log(expressArea);
        console.log(expressArea_code);
    };

    /*关闭省市区选项*/
    function clockArea() {
        $("#areaMask").fadeOut();
        $("#areaLayer").animate({"bottom": "-100%"});
        intProvince();
    };

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
            var myreg = /^(13[0-9]|14[579]|15[0-3,5-9]|16[6]|17[0135678]|18[0-9]|19[89])\d{8}$/;

            console.log(username);
            console.log(phone);
            console.log(area);
            console.log(address_details);

            if(username==""){
                layer.msg("姓名不能为空");
                return false;
            }else if(phone==""){
                layer.msg("电话不能为空");
                return false;
            }else if(!myreg.test(phone)){
                layer.msg("请输入正确的电话");
                $("input[name='phone']").val("");
                return false;
            }else if(area==""){
                layer.msg("地区不能为空");
                return false;
            }else if(address_details==""){
                layer.msg("详细地址不能为空");
                return false;
            }else{
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
            }
        });
    });
</script>
<?php $this->endBlock(); ?>
</body>
