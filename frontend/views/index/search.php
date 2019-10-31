<?php
?>
<?php $this->beginBlock('self_css'); ?>

<?php $this->endBlock(); ?>

    <header id="head">
       	   <span class="last" onclick="history.go(-1)">
       	   	 <img src="/images/last.png"/>
       	   </span>
        <div class="search_icon search_icon2 white radius50">
            <img src="/images/search.png"/>
            <input type="text" placeholder="商品" value="" name="goods_name" class="goods_name"/>
        </div>
        <button type="button" class="search_btn">搜索</button>
    </header>
    <div class="history">
        <div class="history_001">
            <span>历史记录</span>
            <span class="clear">清除</span>
            <ul class="history_001_ul">
                <li>
                    <span>透明片</span>
                </li>
                <li>
                    <span>粉色</span>
                </li>
                <li>
                    <span>棕色</span>
                </li>
                <li>
                    <span>粉色</span>
                </li>
                <li>
                    <span>透明片</span>
                </li>
                <li>
                    <span>透明片</span>
                </li>
                <li>
                    <span>粉色粉色</span>
                </li>
                <li>
                    <span>黄色</span>
                </li>
                <li>
                    <span>蓝色</span>
                </li>
            </ul>
        </div>
        <div class="find">
            <span>热门发现</span>
            <ul class="find_list">
                <li>
                    <span>透明片</span>
                </li>
                <li>
                    <span>粉色</span>
                </li>
                <li>
                    <span>棕色</span>
                </li>
                <li>
                    <span>粉色</span>
                </li>
                <li>
                    <span>透明片</span>
                </li>
                <li>
                    <span>透明片</span>
                </li>
                <li>
                    <span>粉色粉色</span>
                </li>
                <li>
                    <span>黄色</span>
                </li>
                <li>
                    <span>蓝色</span>
                </li>
            </ul>
        </div>
    </div>

<?php $this->beginBlock('self_js'); ?>

        <script>
        layui.use(['layer'],function(){
            var layer=layui.layer;
            $(".clear").on("click",function(){
                layer.confirm('确认删除全部历史记录？', {
                    btn: ['取消','确定'] //按钮
                },function(){
                    layer.closeAll();
                },function(){
                    layer.msg("清除成功");
                    $(".history_001").hide();
                });
            });

            //点击搜索;
            $(".search_btn").on("click",function(){

                var goods_name = $(".goods_name").val();

                window.location.href="/index/type?goods_name="+goods_name;
            });

        });
    </script>

<?php $this->endBlock(); ?>