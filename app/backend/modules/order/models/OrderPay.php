<?php
/**
 * Created by PhpStorm.
 * Author: 芸众商城 www.yunzshop.com
 * Date: 2017/5/8
 * Time: 下午5:06
 */

namespace app\backend\modules\order\models;

class OrderPay extends \app\common\models\OrderPay
{
    public function order(){
        return $this->morphOne('App\backend\modules\tracking\models\GoodsTrackingModel','order');
    }
}