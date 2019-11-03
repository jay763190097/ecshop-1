<?php?><?php $this->beginBlock('self_css'); ?><?php $this->endBlock(); ?>    <header id="head">        <div class="search_icon white radius50">            <img src="/images/search.png"/>            <input type="text" readonly="readonly" placeholder="搜索商品" value="" name="goods_name" class="goods_name"/>        </div>    </header>    <!--轮播图-->    <div class="swiper-container swiper-001">        <div class="swiper-wrapper">            <?php foreach ($banner as $k) { ?>                <div class="swiper-slide">                    <a href="">                        <img src="<?= $k['photo']['thumb'] ?>"/>                    </a>                </div>            <?php } ?>        </div>        <!-- Add Pagination -->        <div class="swiper-pagination swiper-pag1"></div>    </div>    <div class="news white radius5">        <div class="news_L pull-left">            <a href="information.html">                <img src="/images/news.png"/>            </a>        </div>        <div class="swiper-container swiper-002">            <div class="swiper-wrapper">                <?php foreach ($artcle as $k) { ?>                    <div class="swiper-slide">                        <a href="/index/detail?id=<?= $k['id'] ?>">                            <img src="/images/goods001.jpg/" class="news_img"/>                            <div class="info">                                <h3><?= $k['title'] ?></h3>                                <p><?= $k['content'] ?></p>                            </div>                        </a>                    </div>                <?php } ?>            </div>        </div>    </div><?php if (!empty($discount['list'])) { ?>    <!--优惠-->    <div class="width_set discount white radius5">        <div class="title">            <h3>限时优惠</h3>            <div class="endtime">                距结束<span><?= $discount['used_time']['day'] ?></span>天                <span><?= $discount['used_time']['hour'] ?></span>时                <span><?= $discount['used_time']['min'] ?></span>分                <span><?= $discount['used_time']['sec'] ?></span>秒                <!--                <span>09</span>-->            </div>            <a href="/list/discount" class="more">更多 &gt;</a>        </div>        <ul class="discount_goods">            <?php foreach ($discount['list'] as $k) { ?>                <li>                    <a href="/list/shop?id=<?= $k['goods_id'] ?>" class="goods_img">                        <img src="<?= $k['goods_thumb'] ?>"/>                    </a>                    <a href="/list/shop?id=<?= $k['goods_id'] ?>" class="goods_title"><span class="haitao">                        <?php if ($k['suppliers_id'] == 1) {                            echo "自营";                        } else {                            echo "海淘";                        } ?>                    </span><?= $k['goods_name'] ?></a>                    <a href="/list/shop?id=<?= $k['goods_id'] ?>"                       class="dis_prize center-block text-center">特惠价&yen;<?= $k['promote_price'] ?></a>                </li>            <?php } ?>        </ul>    </div><?php } ?><?php if (!empty($haitao)) { ?>    <div class="jingwai white radius5">        <div class="title">            <h3>境外海淘</h3>            <span class="choose">日本原装好物  保税仓发货</span>            <a href="/index/type?action=2" class="more">更多 &gt;</a>        </div>        <ul class="discount_goods">            <?php foreach ($haitao as $k) { ?>                <li>                    <a href="/list/shop?id=<?= $k['goods_id'] ?>" class="goods_img">                        <img src="<?= $k['goods_thumb'] ?>"/>                    </a>                    <a href="/list/shop?id=<?= $k['goods_id'] ?>" class="goods_title"><span                                class="haitao">海淘</span><?= $k['goods_name'] ?></a>                    <span class="choose_prize">&yen;<?= $k['shop_price'] ?></span>                </li>            <?php } ?>        </ul>    </div><?php } ?><?php if (!empty($self)) { ?>    <div class="store white radius5">        <div class="title">            <h3>境内自营</h3>            <span class="choose">中国精选标签  自营仓发货</span>            <a href="/index/type?action=1" class="more">更多 &gt;</a>        </div>        <ul class="discount_goods">            <?php foreach ($self as $k) { ?>                <li>                    <a href="/list/shop?id=<?= $k['goods_id'] ?>" class="goods_img">                        <img src="<?= $k['goods_thumb'] ?>"/>                    </a>                    <a href="/list/shop?id=<?= $k['goods_id'] ?>" class="goods_title"><span                                class="own">自营</span><?= $k['goods_name'] ?>                    </a>                    <span class="choose_prize">&yen;<?= $k['shop_price'] ?></span>                </li>            <?php } ?>        </ul>    </div><?php } ?>    <div class="kinds kinds2">        <ul class="kinds_name">            <li class="active">                <span>精选</span>            </li>            <li>                <span>日抛</span>            </li>            <li>                <span>双周抛</span>            </li>            <li>                <span>月抛</span>            </li>            <li>                <span>透明片</span>            </li>        </ul>        <ul class="discount_goods kinds_list" style="min-height: 50px;">        </ul>        <i class="layui-icon layui-icon-loading layui-anim layui-anim-rotate layui-anim-loop text-center"           style="display:none;"></i>    </div><?php $this->beginBlock('self_js'); ?>    <script src="/js/common.js"></script>    <script src="/js/index.js"></script>    <?php $this->endBlock(); ?>