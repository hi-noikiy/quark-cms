<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->engine='innodb';
            $table->increments('id')->unsigned();            
            $table->integer('shop_id')->unsigned()->nullable()->comment('商家ID');
            $table->integer('goods_category_id')->nullable()->comment('商品主分类');
            $table->string('shop_self_category_ids')->nullable()->comment('商家商品分类');
            $table->string('tags')->nullable()->comment('标签');
            $table->tinyInteger('goods_mode')->default('1')->nullable()->comment('1实物商品（物流发货），2电子卡券（无需物流，如：团购类型需要消费码的商品），3服务商品（无需物流，如：点卡，Q币，游戏装备，激活码）');
            $table->string('goods_name')->nullable()->comment('商品名称');
            $table->string('keywords')->nullable()->comment('关键字');
            $table->string('description')->nullable()->comment('描述');
            $table->tinyInteger('pricing_mode')->default('1')->comment('计价方式1：计件，2：计重');
            $table->tinyInteger('goods_unit_id')->nullable()->comment('商品单位：件，kg');
            $table->integer('goods_brand_id')->nullable()->comment('品牌ID');
            $table->text('goods_system_spus')->nullable()->comment('平台系统属性');
            $table->text('goods_shop_spus')->nullable()->comment('商家自定义属性');
            $table->integer('goods_moq')->nullable()->comment('最小起订量');
            $table->decimal('goods_price',10,2)->nullable()->comment('店铺价:价格必须是0.01~9999999之间的数字，且不能高于市场价');
            $table->decimal('market_price',10,2)->nullable()->comment('市场价:为0则商品详情页不显示，价格必须是0.00~9999999之间的数字，此价格仅为市场参考售价，请根据该实际情况认真填写');
            $table->decimal('cost_price',10,2)->nullable()->comment('成本价:价格必须是0.00~9999999之间的数字，此价格为商户对所销售的商品实际成本价格进行备注记录');
            $table->integer('stock_num')->nullable()->comment('商品库存,店铺库存数量必须为0~999999999之间的整数，若商品存在规格，则系统自动计算商品的总数，此处无需卖家填写');
            $table->integer('warn_num')->nullable()->comment('设置最低库存预警值。当库存低于预警值时商家中心商品列表页库存列红字提醒，0为不预警');
            $table->string('goods_sn')->nullable()->comment('商品货号是指商家管理商品的编号，买家不可见');
            $table->string('goods_barcode')->nullable()->comment('支持一品多码，多个条形码之间用逗号分隔');
            $table->string('goods_stockcode')->nullable()->comment('实体仓库存储商品位置编码');
            $table->integer('cover_id')->nullable()->comment('上传商品默认主图，无规格主图时展示该图');
            $table->integer('video_id')->nullable()->comment('主图视频');
            $table->longText('pc_content')->nullable()->comment('电脑端商品详情');
            $table->longText('mobile_content')->nullable()->comment('手机端商品详情');
            $table->integer('top_layout_id')->nullable()->comment('详情页顶部模板');
            $table->integer('bottom_layout_id')->nullable()->comment('详情页底部模板');
            $table->integer('packing_layout_id')->nullable()->comment('详情页包装清单版式');
            $table->integer('service_layout_id')->nullable()->comment('详情页售后保证版式');
            $table->double('goods_weight')->nullable()->comment('物流重量，商品的重量单位为千克，如果商品的运费模板按照重量计算请填写此项，为空则默认商品重量为0Kg；');
            $table->string('goods_volume')->nullable()->comment('商品的体积单位为立方米，如果商品的运费模板按照体积计算请填写此项，为空则默认商品体积为0立方米；');
            $table->string('goods_freight_type')->nullable()->comment('运费类型 0：店铺承担运费 ，1：运费模板');
            $table->integer('freight_id')->nullable()->comment('运费模板id');
            $table->tinyInteger('invoice_type')->nullable()->comment('发票：0无，1增值税普通发票，2增值税专用发票，3 增值税普通发票 和 增值税专用发票，选择“无”则将不提供发票');
            $table->tinyInteger('user_discount')->nullable()->comment('会员打折：0 不参与会员打折，1参与会员打折，指的是统一的会员折扣是否参与，参与和不参与会员折扣不影响自定义会员价');
            $table->tinyInteger('stock_mode')->nullable()->comment('库存计数：1拍下减库存，2付款减库存，3出库减库存 拍下减库存：买家拍下商品即减少库存，存在恶拍风险。热销商品如需避免超卖可选此方式');
            $table->integer('comment')->nullable()->comment('评论数量');
            $table->integer('view')->nullable()->comment('浏览数量');
            $table->integer('sales_num')->nullable()->comment('销量');
            $table->integer('fake_sales_num')->nullable()->comment('虚拟销量');
            $table->string('comment_status')->nullable();
            $table->tinyInteger('effective_type')->default('1')->nullable()->comment('当商品为电子卡券类型商品时，兑换生效期类型：1付款完成立即生效，2付款完成N小时后生效,3付款完成次日生效');
            $table->integer('effective_hour')->nullable()->comment('当商品为电子卡券类型商品时，兑换生效期类型为付款完成N小时后生效，例如：12，为12小时候生效');
            $table->tinyInteger('valid_period_type')->default('1')->nullable()->comment('当商品为电子卡券类型商品时，使用有效期类型：1长期有效，2具有明确截止时间例如2019-01-01到2019-01-31，3自购买之日起，N小时内有效,4自购买之日起，N天内有效');
            $table->timestamp('add_time_begin')->nullable()->comment('当商品为电子卡券类型商品时，使用有效期类型为2具有明确截止时间时，开始时间');
            $table->timestamp('add_time_end')->nullable()->comment('当商品为电子卡券类型商品时，使用有效期类型为2具有明确截止时间时，结束时间');
            $table->integer('valid_period_hour')->nullable()->comment('当商品为电子卡券类型商品时，使用有效期类型为3自购买之日起，N小时内有效');
            $table->integer('valid_period_day')->nullable()->comment('当商品为电子卡券类型商品时，使用有效期类型为4自购买之日起，N天内有效');
            $table->tinyInteger('is_expired_refund')->default('1')->nullable()->comment('当商品为电子卡券类型商品时，是否支持过期退款');
            $table->tinyInteger('rate')->nullable();
            $table->tinyInteger('status')->default('1')->nullable()->comment('1出售中，2审核中，3已下架，4商品违规下架');
            $table->string('goods_reason')->nullable()->comment('违规下架原因');
            $table->tinyInteger('is_sku')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
}
