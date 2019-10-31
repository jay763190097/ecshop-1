<?php
?>
<?php $this->beginBlock('self_css'); ?>

<?php $this->endBlock(); ?>

    <header id="head" class='info_my'>
       	   <span class="last" onclick="history.go(-1)">
       	   	 <img src="/images/last.png"/>
       	   </span>
        <h3 class="info_about">限时优惠</h3>
    </header>
    <div class="dis_dates">
        <span><?= $info['start_month'] ?>月<?= $info['start_day'] ?>日至<?= $info['end_month'] ?>月<?= $info['end_day'] ?>日</span>
        <div class="endtime endtime2">
            距结束<span><?= $info['day'] ?></span>天<span><?= $info['hour'] ?></span>时<span><?= $info['min'] ?></span>分<span><?= $info['sec'] ?></span>秒
        </div>
    </div>
    <ul class="discount_lists">
        <!--        <li>-->
        <!--            <div class="discount_lists_img">-->
        <!--                <a href="goods_details.html">-->
        <!--                    <img src="images/comment_img.jpg"/>-->
        <!--                </a>-->
        <!--            </div>-->
        <!--            <div class="discount_lists_info">-->
        <!--                <a href="goods_details.html" class="goods_title"><span class="haitao">海淘</span>我是商品我是商品我是商品名称限时优惠我是商品名称限时优惠</a>-->
        <!--                <div class="discount_bottom">-->
        <!--                    <span>&yen;<i>290.99</i></span>-->
        <!--                    <span>&yen;<i>350.99</i></span>-->
        <!--                    <a href="goods_details.html">-->
        <!--                        立即抢购 &gt;-->
        <!--                    </a>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </li>-->
        <!--        <li>-->
        <!--            <div class="discount_lists_img">-->
        <!--                <a href="goods_details.html">-->
        <!--                    <img src="images/comment_img.jpg"/>-->
        <!--                </a>-->
        <!--            </div>-->
        <!--            <div class="discount_lists_info">-->
        <!--                <a href="goods_details.html" class="goods_title"><span class="own">自营</span>我是商品我是商品我是商品名称限时优惠我是商品名称限时优惠</a>-->
        <!--                <div class="discount_bottom">-->
        <!--                    <span>&yen;<i>290.99</i></span>-->
        <!--                    <span>&yen;<i>350.99</i></span>-->
        <!--                    <a href="goods_details.html">-->
        <!--                        立即抢购 &gt;-->
        <!--                    </a>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </li>-->
        <!--        <li>-->
        <!--            <div class="discount_lists_img">-->
        <!--                <a href="goods_details.html">-->
        <!--                    <img src="images/comment_img.jpg"/>-->
        <!--                </a>-->
        <!--            </div>-->
        <!--            <div class="discount_lists_info">-->
        <!--                <a href="goods_details.html" class="goods_title"><span class="haitao">海淘</span>我是商品我是商品我是商品名称限时优惠我是商品名称限时优惠</a>-->
        <!--                <div class="discount_bottom">-->
        <!--                    <span>&yen;<i>290.99</i></span>-->
        <!--                    <span>&yen;<i>350.99</i></span>-->
        <!--                    <a href="goods_details.html">-->
        <!--                        立即抢购 &gt;-->
        <!--                    </a>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </li>-->
    </ul>

<?php $this->beginBlock('self_js'); ?>
    <script src="/js/common.js"></script>


    <script>

getList();
        var type = 0;
        var page = 0;

        function getList(type = 0) {

            $.ajax({
                url: '/index/list',
                type: 'get',
                dataType: 'json',
                data: {
                    type: type,
                    page: page
                },
                success: function (data) {
                    console.log(data);
                    $(".layui-icon-loading").css("display", "none");
                    data = data['list'];
                    for (var x in data) {

                        var str = '<span class=\'haitao\'>海淘</span>';
                        if (data[x].suppliers_id == 1) {
                            str = '<span class=\'own\'>自营</span>';
                        }

                        $(".discount_lists").append('<li>\n' +
                            '            <div class="discount_lists_img">\n' +
                            '                <a href="/list/shop?id=' + data[x].goods_id + '">' +
                            '                    <img src="' + data[x].goods_thumb + '"/>\n' +
                            '                </a>\n' +
                            '            </div>\n' +
                            '            <div class="discount_lists_info">\n' +
                            '                <a href="/list/shop?id=' + data[x].goods_id + '" class="goods_title">' +
                            str +
                            data[x].goods_name + '</a>\n' +
                            '                <div class="discount_bottom">\n' +
                            '                    <span>&yen;<i>290.99</i></span>\n' +
                            '                    <span>&yen;<i>350.99</i></span>\n' +
                            '                    <a href="/list/shop?id=' + data[x].goods_id + '">\n' +
                            '                        立即抢购 &gt;\n' +
                            '                    </a>\n' +
                            '                </div>\n' +
                            '            </div>\n' +
                            '        </li>');

                    }

                    page += 1;

                }
            })

        }

        //屏幕滚动到底部加载更多;
        $(window).scroll(function (event) {
            if (($(document).scrollTop()) >= ($(document).height() - $(window).height())) {
                console.log("到底了");
                $(".layui-icon-loading").css("display", "block");
                //ajax请求省略;

                getList(type);

                // setTimeout(function () {
                //
                //     for (var i = 0; i < 2; i++) {
                //         $(".kinds_list").append(
                //             "<li class='radius5 white'>" +
                //             "<a href='' class='goods_img'>" +
                //             "<img src='images/goods001.jpg'/>" +
                //             "</a>" +
                //             "<a href='' class='goods_title'><span class='haitao'>海淘</span>我是商品名称限时优惠我是商品名称限时优惠</a>" +
                //             "<span class='choose_prize'>&yen;99.9</span>" +
                //             "</li>"
                //         )
                //     }
                // }, 500);
            }
        });

    </script>

<?php $this->endBlock(); ?>