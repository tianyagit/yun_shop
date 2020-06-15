<?php
/**
 * Created by PhpStorm.
 * Author: 芸众商城 www.yunzshop.com
 * Date: 2017/4/11
 * Time: 上午10:20
 */

namespace app\frontend\modules\order\controllers;

use app\common\components\ApiController;
use app\frontend\modules\member\services\MemberCartService;
use app\frontend\modules\memberCart\MemberCartCollection;

class GoodsBuyController extends ApiController
{
    /**
     * @return MemberCartCollection
     * @throws \app\common\exceptions\AppException
     */
    protected function getMemberCarts()
    {
        $goods_params = [
            'goods_id' => request()->input('goods_id'),
            'total' => request()->input('total'),
            'option_id' => request()->input('option_id'),
        ];
        $result = new MemberCartCollection();
        $result->push(MemberCartService::newMemberCart($goods_params));
        return $result;
    }

    /**
     * @throws \app\common\exceptions\ShopException
     */

    protected function validateParam()
    {

        $this->validate([
            'goods_id' => 'required|integer',
            'option_id' => 'integer',
            'total' => 'integer|min:1',
        ]);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \app\common\exceptions\ShopException
     */
    public function index()
    {
        $this->validateParam();
        $trade = $this->getMemberCarts()->getTrade();
        $data = json_decode($trade, true);
        $da = $data['discount']['member_coupons'];
        if (!empty($da)) {
            foreach ($da as $k => $v) {
                if (strtotime($v['belongs_to_coupon']['time_end']) >= strtotime(date('Y-m-d 00:00:00'))) {
                    $da[$k]['time_start'] = $v['belongs_to_coupon']['time_start'];
                    $da[$k]['time_end'] = $v['belongs_to_coupon']['time_end'];
                } else {
                    unset($da[$k]);
                }
            }

            $data['discount']['member_coupons'] = $da;
            $trade = $data;
        }

        return $this->successJson('成功', $trade);
    }

}