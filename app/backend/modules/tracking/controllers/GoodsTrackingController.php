<?php
namespace app\backend\modules\tracking\controllers;

use app\common\components\BaseController;
use app\backend\modules\tracking\models\GoodsTrackingModel;
use app\common\helpers\PaginationHelper;
use app\backend\modules\tracking\models\ChartChartuser;

/**
 * Class GoodsTrackingController
 * @package app\backend\modules\tracking\controllers
 */
class GoodsTrackingController extends BaseController
{
    public function index(){
        $chat = new ChartChartuser();
        var_dump($chat);die;
        $pageSize = 20;
        $list = GoodsTrackingModel::with(['goods','user','resource'])->paginate($pageSize);

        $pager = PaginationHelper::show($list['total'], $list['current_page'], $list['per_page']);


        return view('tracking.goodsTracking.index', [
            'pageList' => $list,
            'pager' => $pager,
        ]);
    }
}
