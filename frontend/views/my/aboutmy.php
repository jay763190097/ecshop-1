<?php

/**

 * Created by PhpStorm.

 * User: Administrator

 * Date: 2019/10/23 0023

 * Time: 1:00

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

    <h3 class="info_about">关于我们</h3>

</header>



<ul class="about_lists">

    <li>

        <span>联系电话</span>

        <a id="tel" href="tel:15099999999">15099999999</a> <!--支持打电话-->

    </li>

    <li>

        <span>客服QQ</span>

        <span>124098766655</span>

    </li>

    <li>

        <span>客服微信号</span>

        <span>jdkidold(可复制)</span>

    </li>

    <li>

        <span>微信公众号</span>

        <span>公众号名称</span>

    </li>

</ul>



<?php $this->beginBlock('self_js'); ?>

<script src="/js/common.js"></script>

<?php $this->endBlock(); ?>

</body>

