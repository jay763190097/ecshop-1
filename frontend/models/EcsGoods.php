<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%ecs_goods}}".
 *
 * @property string $goods_id 	商品id
 * @property int $cat_id 商品所属商品分类id，取值category的cat_id
 * @property string $goods_sn 	商品的唯一货号
 * @property string $goods_name 商品的名称
 * @property string $goods_name_style 	商品名称显示的样式；包括颜色和字体样式；格式如#ff00ff+strong
 * @property string $click_count 商品点击数
 * @property int $brand_id 	品牌id，取值于brand 的brand_id
 * @property string $provider_name 供货人的名称，程序还没实现该功能
 * @property string $goods_number 	商品库存数量
 * @property string $goods_weight 商品的重量，以千克为单位
 * @property string $market_price 市场售价
 * @property int $virtual_sales 本店售价
 * @property string $shop_price 促销价格
 * @property string $promote_price 促销价格开始日期
 * @property string $promote_start_date 	促销价格结束日期
 * @property string $promote_end_date 	促销价格结束日期
 * @property int $warn_number 	商品报警数量
 * @property string $keywords 商品关键字，放在商品页的关键字中，为搜索引擎收录用
 * @property string $goods_brief 	商品的简短描述
 * @property string $goods_desc 商品的详细描述
 * @property string $goods_thumb 商品在前台显示的微缩图片，如在分类筛选时显示的小图片
 * @property string $goods_img 	商品的实际大小图片，如进入该商品页时介绍商品属性所显示的大图片
 * @property string $original_img 	应该是上传的商品的原始图片
 * @property int $is_real 	是否是实物，1，是；0，否；比如虚拟卡就为0，不是实物
 * @property string $extension_code 商品的扩展属性，比如像虚拟卡
 * @property int $is_on_sale 该商品是否开放销售，1，是；0，否
 * @property int $is_alone_sale 	是否能单独销售，1，是；0，否；如果不能单独销售，则只能作为某商品的配件或者赠品销售
 * @property int $is_shipping
 * @property string $integral 	购买该商品可以使用的积分数量，估计应该是用积分代替金额消费；但程序好像还没有实现该功能
 * @property string $add_time 	商品的添加时间
 * @property int $sort_order 应该是商品的显示顺序，不过该版程序中没实现该功能
 * @property int $is_delete 商品是否已经删除，0，否；1，已删除
 * @property int $is_best 	是否是精品；0，否；1，是
 * @property int $is_new 	是否是新品
 * @property int $is_hot 	是否热销，0，否；1，是
 * @property int $is_promote 	是否特价促销；0，否；1，是
 * @property int $bonus_type_id 	购买该商品所能领到的红包类型
 * @property string $last_update 	最近一次更新商品配置的时间
 * @property int $goods_type 	商品所属类型id，取值表goods_type的cat_id
 * @property string $seller_note 	商品的商家备注，仅商家可见
 * @property int $give_integral 购买该商品时每笔成功交易赠送的积分数量
 * @property int $rank_integral
 * @property int $suppliers_id
 * @property int $is_check
 */
class EcsGoods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ecs_goods}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cat_id', 'click_count', 'brand_id', 'goods_number', 'virtual_sales', 'promote_start_date', 'promote_end_date', 'warn_number', 'is_real', 'is_on_sale', 'is_alone_sale', 'is_shipping', 'integral', 'add_time', 'sort_order', 'is_delete', 'is_best', 'is_new', 'is_hot', 'is_promote', 'bonus_type_id', 'last_update', 'goods_type', 'give_integral', 'rank_integral', 'suppliers_id', 'is_check'], 'integer'],
            [['goods_weight', 'market_price', 'shop_price', 'promote_price'], 'number'],
            [['goods_desc'], 'required'],
            [['goods_desc'], 'string'],
            [['goods_sn', 'goods_name_style'], 'string', 'max' => 60],
            [['goods_name'], 'string', 'max' => 120],
            [['provider_name'], 'string', 'max' => 100],
            [['keywords', 'goods_brief', 'goods_thumb', 'goods_img', 'original_img', 'seller_note'], 'string', 'max' => 255],
            [['extension_code'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'goods_id' => 'Goods ID',
            'cat_id' => 'Cat ID',
            'goods_sn' => 'Goods Sn',
            'goods_name' => 'Goods Name',
            'goods_name_style' => 'Goods Name Style',
            'click_count' => 'Click Count',
            'brand_id' => 'Brand ID',
            'provider_name' => 'Provider Name',
            'goods_number' => 'Goods Number',
            'goods_weight' => 'Goods Weight',
            'market_price' => 'Market Price',
            'virtual_sales' => 'Virtual Sales',
            'shop_price' => 'Shop Price',
            'promote_price' => 'Promote Price',
            'promote_start_date' => 'Promote Start Date',
            'promote_end_date' => 'Promote End Date',
            'warn_number' => 'Warn Number',
            'keywords' => 'Keywords',
            'goods_brief' => 'Goods Brief',
            'goods_desc' => 'Goods Desc',
            'goods_thumb' => 'Goods Thumb',
            'goods_img' => 'Goods Img',
            'original_img' => 'Original Img',
            'is_real' => 'Is Real',
            'extension_code' => 'Extension Code',
            'is_on_sale' => 'Is On Sale',
            'is_alone_sale' => 'Is Alone Sale',
            'is_shipping' => 'Is Shipping',
            'integral' => 'Integral',
            'add_time' => 'Add Time',
            'sort_order' => 'Sort Order',
            'is_delete' => 'Is Delete',
            'is_best' => 'Is Best',
            'is_new' => 'Is New',
            'is_hot' => 'Is Hot',
            'is_promote' => 'Is Promote',
            'bonus_type_id' => 'Bonus Type ID',
            'last_update' => 'Last Update',
            'goods_type' => 'Goods Type',
            'seller_note' => 'Seller Note',
            'give_integral' => 'Give Integral',
            'rank_integral' => 'Rank Integral',
            'suppliers_id' => 'Suppliers ID',
            'is_check' => 'Is Check',
        ];
    }
}
