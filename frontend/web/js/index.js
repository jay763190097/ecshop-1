$(document).ready(function () {

    $("#foot li").removeClass('active');

    $("#foot li:eq(0)").addClass('active');

    $("#foot li:eq(0) a img").attr('src', '/images/home_active.png');

    $("#foot li:eq(1) a img").attr('src', '/images/classification.png');
    $("#foot li:eq(2) a img").attr('src', '/images/shopping_cart.png');
    $("#foot li:eq(3) a img").attr('src', '/images/personal.png');


    var type = 0;

    var page = 1;

    var count_page = 2;


    function getList(type = 0) {


        // console.log(page, count_page);

        console.log('type' + type);

        if (page <= count_page) {
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

                    count_page = data['count_page'];

                    data = data['list'];

                    for (var x in data) {


                        var str = '<span class=\'haitao\'>海淘</span>';

                        if (data[x].suppliers_id == 1) {

                            str = '<span class=\'own\'>自营</span>';

                        }


                        $(".kinds_list").append(
                            "<li class='radius5 white' style='height:2.30rem; '>" +

                            "<a href='/list/shop?id=" + data[x].goods_id + "' class='goods_img'>" +

                            "<img src='" + data[x].goods_thumb + "'/>" +

                            "</a>" +

                            "<a href='/list/shop?id=" + data[x].goods_id + "' class='goods_title'>" + str + data[x].goods_name + "</a>" +

                            "<span class='choose_prize'>&yen;" + data[x].shop_price + "</span>" +

                            "</li>"
                        )

                    }


                    page += 1;


                }

            })
        } else {
            $(".layui-icon-loading").css("display", "none");
        }


    }


    //点击切换精选等;

    $(".kinds_name>li").on("click", function () {


        console.log($(this).index());


        type = $(this).index();


        $(this).addClass("active").siblings("li").removeClass("active");


        $(".kinds_list").children().remove();


        page = 1;

        getList(type);


    });

    //点击搜索;

    $(".search_icon").click(function () {

        window.location.href = "/index/search";

    });





    //屏幕滚动到底部加载更多;

    $(window).scroll(function (event) {

        if (($(document).scrollTop()) >= ($(document).height() - $(window).height())) {

            console.log("到底了");

            $(".layui-icon-loading").css("display", "block");

            //ajax请求省略;


            getList(type);

        }

    });

});