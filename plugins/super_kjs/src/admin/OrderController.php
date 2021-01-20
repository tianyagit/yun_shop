<?php
/**
 * Created by PhpStorm.
 * User: yunzhong
 * Date: 2018/3/19
 * Time: 11:54
 */

namespace Yunshop\SuperKjs\admin;

use app\common\components\BaseController;
use app\common\helpers\Client;
use app\common\helpers\PaginationHelper;
use app\common\services\ExportService;
use Yunshop\SuperKjs\models\BasisSetting;
use Yunshop\SuperKjs\models\PluginOrder;
use Yunshop\SuperKjs\models\Order;
use Yunshop\SuperKjs\models\IpWhiteList;
use Yunshop\SuperKjs\listeners\OrderReceiveListener;

class OrderController extends BaseController
{
    protected $orderModel;


    public function index()
    {
        if (request()->export == 1) {
            $this->export($this->orderModel);
        }
        $search = request()->search;
        $date = PluginOrder::getOrderAllDate($search);
        $list = $date->orderBy('id', 'desc')->paginate(10);
        $pager = PaginationHelper::show($list->total(), $list->currentPage(), $list->perPage());

        if(!$search['time']){
            $search['time']['start'] = date("Y-m-d H:i:s",time());
            $search['time']['end'] = date("Y-m-d H:i:s",time());
        }

        return view('Yunshop\SuperKjs::admin.orders',[
            'list' => $list->toarray(),
            'pager' => $pager,
            'total' => $list->total(),
            'search' => $search,
        ])->render();
    }

    /**
     * post超级砍价下单数据
     * @return bool
     * @throws \app\common\exceptions\AppException
     */
    public function postOrders()
    {

        $data = request()->input();
        if (!IpWhiteList::getIpWhiteListByIp(\Request::getClientIp())) {
            return [
                'result' => '0',
                'error' => '传入地址错误'
            ];
        }
//        $data = array(
//            'uniacid'     => 3,
//            'goods_total' => 1,
//            'openid'      => 1,
//            'uid'      	  => 17,
//            'mid'         => 1,
//            'order_sn'    => 'CRT'.date('YmdHis') . Client::random(4, false),
//            'price'       => 200,
//            'goods_price' => 100,
//            'status'      => 0,//订单状态：0未支,1支付，2待发货，3已发货，4已签收，5已取消，6待退款，7已退款
//            'realname'    => 'aaa',
//            'mobile'      => 12345678910,
//            'address'     => 'saaa',
//            'is_hexiao'   => 1,
//            'hexiaoma'    => 'sfsdfs',
//            'province'    => '广东省',
//            'city'        => '广州市',
//            'county'      => '白云区',
//            'detailed_address' => '测试',
//        );
        if (!empty($data)) {
            Order::insertOrder($data);
        } else {
            return false;
        }

        return true;
    }

    /**
     * 超级砍价订单完成数据
     * @return bool
     */
    public function completeOrder()
    {
        $data = request()->input();
        if (!IpWhiteList::getIpWhiteListByIp(\Request::getClientIp())) {
            return [
                'result' => '0',
                'error' => '传入地址错误'
            ];
        }
//        $data = [
//            'status' => 3,
//            'order_sn' => 'CRT20181101175014KJgV',
//        ];
        if ($data['status'] == 3) {
            Order::completeOrder($data);//触发完成订单监听
        } else {
            return false;
        }
        return true;
    }

    /**
     * 导出Excel
     */
    public function export()
    {
        $search = request()->search;
        $builder = PluginOrder::getOrderAllDate($search);
        $export_page = request()->export_page ? request()->export_page : 1;
        $export_model = new ExportService($builder, $export_page);
        $file_name = date('Ymdhis', time()) . '超级砍价导出';
        $export_data[0] = ['ID', '订单编号', '下单时间', '购买者', '推荐者', '订单状态', '订单金额', '实付金额'];
        foreach ($export_model->builder_model as $key => $item) {
            if ($item->status == 3) {
                $item->status = '已完成';
            } else {
                $item->status = '未完成';
            }
            $export_data[$key + 1] = [
                $item->id,
                $item->order_sn,
                $item->created_at,
                $item->buyer_name,
                $item->recommend_name,
                $item->status,
                $item->price,
                $item->goods_price,
            ];
        }
        $export_model->export($file_name, $export_data, 'Yunshop\SuperKjs::admin.orders');
        return true;
    }
}