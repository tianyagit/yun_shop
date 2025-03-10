<!-- mylink start -->
<style>
    .topmenu {background: #ddd;}
    .fart-editor-content .menu, .fart-editor-menu nav, .fart-editor-content .con2 .con .itembox, .fart-preview .title ,.adddiv ,.fart-editor-menu .savebtn {moz-user-select: -moz-none; -moz-user-select: none; -o-user-select:none; -khtml-user-select:none; -webkit-user-select:none; -ms-user-select:none; user-select:none;}

    .loading {background: #ddd; border: 1px solid #ccc; color: #999;}
    .mylink-con {height: 300px; overflow-y: auto;}
    .mylink-line {height: 36px; border-bottom: 1px dashed #eee; line-height: 36px; color: #999;}
    .mylink-sub {height: 36px; width: 50px; padding-right: 15px; float: right; text-align: right;}
    .mylink-con .good {height: 70px; width:330px; padding: 5px; margin: 5px 2px 0px; background: #f5f5f5; float: left;}
    .mylink-con .good .img {height:60px; width: 60px; background: #eee; float: left;}
    .mylink-con .good .img img {height: 100%; width: 100%; border: 0px; display: block;}
    .mylink-con .good .choosebtn {height:60px; width: 80px; float: right; line-height: 30px; text-align: right;}
    .mylink-con .good .info {height: 60px; word-break:break-all;padding-left: 70px; color: #999;}
    .mylink-con .good .info-title {height:40px; line-height: 20px; overflow: hidden;}
    .mylink-con .good .info-price {height:20px; line-height: 20px; font-size: 12px;}

    .fart-main ::-webkit-scrollbar {width: 6px;}
    .fart-main ::-webkit-scrollbar-track {}
    .fart-main ::-webkit-scrollbar-thumb {background: rgba(0,0,0,0.2); }
    .fart-main ::-webkit-scrollbar-thumb:window-inactive {background: rgba(0,0,0,0.1); }
    .fart-main ::-webkit-scrollbar-thumb:vertical:hover {background-color: rgba(0,0,0,0.3);}
    .fart-main ::-webkit-scrollbar-thumb:vertical:active {background-color: rgba(0,0,0,0.5);}

    .edui-default .edui-editor-toolbarboxouter, .edui-default .edui-editor-toolbarbox {border: 0px; border-radius: 0px}
    .datetimepicker {margin: 0px;}
    section a, section a:hover {color: inherit;}


    .fart-main {height: auto; width: 1400px; overflow: hidden;}
    .fart-preview {height: 800px; width: 400px; float: left; background: #f1f1f1;}
    .fart-preview section {padding: 0px; margin: 0px;}
    .fart-preview .title {height: 50px; background: #00a8e8; color: #fff; text-align: center; line-height: 50px; font-size: 18px; cursor: default; display: none;}
    .fart-preview .top {height: 50px; background: #3366d7; background: #3e4144 url('./top_bg.png') center -3px no-repeat; overflow: hidden; cursor: default;}
    .fart-preview .top p {height: 20px; width: 260px; margin: auto; font-size: 16px; color: #fff; margin-top: 24px; text-align: center; line-height: 20px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; content:"...";}
    .fart-preview .main {height: 750px;overflow-y: auto;}
    .fart-rich-primary {min-height: 750px; padding:20px 15px 15px; background:#fff; cursor: default;}
    .fart-rich-title {margin-bottom:10px; line-height:1.4; font-weight:400; font-size:24px;}
    .fart-rich-mate {margin-bottom:18px; line-height:20px; overflow:hidden;}
    .fart-rich-mate-text {margin-right:8px; margin-bottom:10px; font-size:16px; color:#8c8c8c; float:left;}
    .fart-rich-mate .href {color:#607fa6;}
    .fart-rich-content {min-height:577px; font-size:16px;}
    .fart-rich-content img {max-width: 100%;}
    .fart-rich-tool {height:auto; padding-top:15px; line-height:32px; overflow:hidden;}
    .fart-rich-tool-text {margin-right:10px; font-size:16px; color:#8c8c8c; text-decoration:none; float:left;}
    .fart-rich-tool .link {color:#607fa6;}
    .fart-rich-tool .right {float:right;}
    .fart-rich-tool-like {height:13px; width:13px; margin-left:8px; background:url('./like.png') 0 0 no-repeat; background-size:100% auto; display:inline-block;}
    .fart-rich-sift {height: auto; background: #ddd; padding: 30px 15px 0px; display: none;}
    .fart-rich-sift-line {height: 21px; position: relative;}
    .fart-rich-sift-border {height:0px; width: 100%; border-top: 1px dashed #eee; position: absolute; top: 10px; left: 0px; z-index: 1;}
    .fart-rich-sift-text {height: 21px; width: 100%; font-size: 14px; color: #999; line-height: 21px; text-align: center; font-size: 16px; z-index: 2; position: absolute; top: 0px; left: 0px;}
    .fart-rich-sift-text a {display:inline-block; padding: 0px 5px; background: #ddd; color: #999; height: 21px; max-width: 80%; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; content:"...";}
    .fart-rich-sift-img {min-height:10px; background:#fff; margin-top:12px; padding:6px;}
    .fart-rich-sift-img img {width:100%; border: 0px; display: block;}
    .fart-rich-sift-more {line-height:60px; font-size:16px; color:#607fa6; text-align:center; height: 60px; margin: auto;  max-width: 80%; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; content:"...";}

    .fart-editor {height: 800px; width: 1000px; background: #f1f1f1; float: left; font-weight: 100;}
    .fart-editor-menu {height:50px; background: #00a8e8;}
    .fart-editor-menu nav {height: 50px; width: 30%; text-align: center; line-height: 50px; font-size: 18px; color: #fff; float: left; cursor: pointer;}
    .fart-editor-menu .navon {background: #00b3f7;}
    .fart-editor-menu .savebtn {height: 50px; width: 10%; background: #6c9; float: left; line-height: 50px; text-align: center; font-size: 18px; color: #fff; cursor: pointer;}
    .fart-editor-content {height: 750px; background: #f1f1f1; display: none; overflow: hidden;}
    .fart-editor-content .menu {height: 40px; cursor: default;}
    .fart-editor-content .nav1 {height: 40px; width: 500px; background: #ffba75; font-size: 16px; color: #fff; line-height: 40px; text-align: center; float: left; position: relative;}
    .fart-editor-content .nav1 .trash {height: 24px; width: 24px; position: absolute; top: 8px; right: 8px; font-size: 20px; line-height: 24px; text-align: center; cursor: pointer;}
    .fart-editor-content .nav2 {height: 40px; width: 500px; background: #b4b4da; font-size: 16px; color: #fff; line-height: 40px; text-align: center; float: left; position: relative;}
    .fart-editor-content .nav2 .tip {height: 20px; width: 40px; position: absolute; right: 55px; top: 10px; font-size: 12px; color: #fff; line-height: 20px; text-align: center;}
    .fart-editor-content .nav2 .color {height: 20px; width: 40px; position: absolute; right: 15px; top: 10px; cursor: pointer; border: 0px; padding: 0px; outline: none;}
    .fart-editor-content .nav2 .color::-webkit-color-swatch-wrapper {border:0px; padding:0px;}
    .fart-editor-content .content {height: 710px;}
    .fart-editor-content .con1 {height: 710px; width: 500px; background: #f4f4f4; float: left;}
    .fart-editor-content .con2 {height: 710px; width: 500px; background: #f4f4f4; float: left;}
    .fart-editor-content .con2 .tab {height: 710px; width: 74px; background: #ccc; float: left;}
    .fart-editor-content .con2 .tab .nav {height: 42px; line-height: 42px; text-align: center; font-size: 16px; color: #fff; cursor: pointer;}
    .fart-editor-content .con2 .tab .navon {background: #aaa;}
    .fart-editor-content .con2 .con {height: 710px; width: 426px; float: left; display: none; overflow-y: auto; background: #fff;}
    .fart-editor-content .con2 .con img {max-width: 100%;}
    .fart-editor-content .con2 .con .itembox {border-bottom: 1px dashed #ddd; padding: 10px; cursor: pointer;}

    .fart-form {min-height: 500px; padding:40px;}
    .fart-form input::-webkit-input-placeholder {color: #999;}
    .fart-form input {color: #333;}
    .fart-form .line {height: auto; overflow: hidden;}
    .fart-form .line2 {height: auto; width: 455px; float: left;}
    .fart-form .product {display: none;}
    .fart-form .product .advs {min-height: 10px; background: #eee; padding: 5px; margin-bottom: 15px; border: 2px dashed #ccc; border-radius: 5px; overflow: hidden;}
    .fart-form .product .advs .addbtn {height:40px; border: 2px dashed #ccc; line-height: 40px; font-size: 18px; color: #bbb; text-align: center; cursor: pointer; margin:5px; background: #fff;}
    .fart-form .product .adv {height: 100px; background: #fff; border:1px solid #ddd; margin: 5px; padding: 5px; border-radius: 5px; position: relative;}
    .fart-form .product .adv .img {height: 88px; width: auto; min-width: 88px; max-width:250px; background: #ccc; float: left; margin-right: 15px; }
    .fart-form .product .adv .img img {height:100%; width: auto;}
    .fart-form .product .adv .info {height: 90px;}
    .fart-form .product .adv .del {height: 24px; width: 24px; background: rgba(0,0,0,0.5); text-align: center; line-height: 24px; color: #fff; font-size: 18px; position: absolute; top: -10px; right: -10px; border-radius: 30px; cursor: pointer;}

    .page-header {
        height: 40px;
    }

    .mylink-nav {
        margin: 5px 0;
    }
</style>

<div id="modal-mylink" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="width: 720px;">
        <div class="modal-content">
            <div class="modal-header" style="padding: 5px;">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <ul class="nav nav-pills" role="tablist">
                    <li role="presentation" class="active" style="display: block;"><a aria-controls="link_system" role="tab" data-toggle="tab" href="#link_system" aria-expanded="true">系统页面</a></li>
                    <li role="presentation" style="display: block;"><a aria-controls="link_goods" role="tab" data-toggle="tab" href="#link_goods" aria-expanded="false">商品链接</a></li>
                    <li role="presentation" style="display: block;"><a aria-controls="link_cate" role="tab" data-toggle="tab" href="#link_cate" aria-expanded="false">商品分类</a></li>
                   {{--  {!! my_link_extra('nav') !!} --}}
                    <li role="presentation" style="display: block;"><a aria-controls="link_other" role="tab" data-toggle="tab" href="#link_other" aria-expanded="false">自定义链接</a></li>
                </ul>
            </div>
            <div class="modal-body tab-content">
                <div role="tabpanel" class="tab-pane link_system active" id="link_system">
                    <div class="mylink-con">

                        <div class="page-header">
                            <h4><i class="fa fa-folder-open-o"></i> 商城页面链接</h4>
                        </div>


                        <div id="fe-tab-link-li-11" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 11)" data-href="{{ yzAppFullUrl('home') }}">商城首页</div>
                        <div id="fe-tab-link-li-12" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 12)" data-href="{{ yzAppFullUrl('category') }}">分类导航</div>


                        <div class="page-header">
                            <h4><i class="fa fa-folder-open-o"></i> 会员中心链接</h4>
                        </div>

                        <div id="fe-tab-link-li-21" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 21)" data-href="{{ yzAppFullUrl('member') }}">会员中心</div>
                        <div id="fe-tab-link-li-22" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 22)" data-href="{{ yzAppFullUrl('member/orderList/0')}}">我的订单</div>
                        <div id="fe-tab-link-li-23" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 23)" data-href="{{ yzAppFullUrl('cart') }}">我的购物车</div>
                        <div id="fe-tab-link-li-24" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 24)" data-href="{{ yzAppFullUrl('member/collection') }}">我的收藏</div>
                        <div id="fe-tab-link-li-25" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 25)" data-href="{{ yzAppFullUrl('member/footprint') }}">我的足迹</div>
                        <div id="fe-tab-link-li-26" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 26)" data-href="{{ yzAppFullUrl('member/balance') }}">会员充值</div>
                        <div id="fe-tab-link-li-27" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 27)" data-href="{{ yzAppFullUrl('member/detailed') }}">余额明细</div>
                        <div id="fe-tab-link-li-28" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 28)" data-href="{{ yzAppFullUrl('member/balance') }}">余额提现</div>
                        <div id="fe-tab-link-li-29" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 29)" data-href="{{ yzAppFullUrl('member/address') }}">我的收货地址</div>
<!-- ======================================================================= -->
            <!-- 页面新增链接 -->
                        <div class="page-header">
                            <h4><i class="fa fa-folder-open-o"></i> webapp链接</h4>
                        </div>

                        <div id="fe-tab-link-li-32" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 32)" data-href="{{ yzAppFullUrl('member/tabs') }}">tabs</div>

                        <div id="fe-tab-link-li-33" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 33)" data-href="{{ yzAppFullUrl('member/po') }}">po</div>

                        <div id="fe-tab-link-li-34" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 34)" data-href="{{ yzAppFullUrl('member/info') }}">会员信息</div>

                        <div id="fe-tab-link-li-35" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 35)" data-href="{{ yzAppFullUrl('member/editmobile') }}">修改手机</div>

                        <div id="fe-tab-link-li-36" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 36)" data-href="{{ yzAppFullUrl('member/balance') }}">余额</div>

                        <div id="fe-tab-link-li-37" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 37)" data-href="{{ yzAppFullUrl('member/detailed') }}">余额明细</div>

                        <div id="fe-tab-link-li-38" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 38)" data-href="{{ yzAppFullUrl('member/screen') }}">余额筛选</div>

                        <div id="fe-tab-link-li-40" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 40)" data-href="{{ yzAppFullUrl('member/integral') }}">积分</div>

                        <div id="fe-tab-link-li-41" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 41)" data-href="{{ yzAppFullUrl('member/income') }}">收入</div>

                        <div id="fe-tab-link-li-44" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 44)" data-href="{{ yzAppFullUrl('member/withdrawal') }}">收入提现</div>

                        <div id="fe-tab-link-li-45" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 45)" data-href="{{ yzAppFullUrl('member/incomedetails') }}">收入明细</div>

                        <div id="fe-tab-link-li-46" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 46)" data-href="{{ yzAppFullUrl('member/member_income_incomedetails_info') }}">收入明细详情</div>

                        <div id="fe-tab-link-li-47" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 47)" data-href="{{ yzAppFullUrl('member/integraldetail') }}">积分明细</div>

                        <div id="fe-tab-link-li-48" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 48)" data-href="{{ yzAppFullUrl('member/presentationRecord') }}">提现记录</div>

                        <div id="fe-tab-link-li-49" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 49)" data-href="{{ yzAppFullUrl('member/presentationDetails') }}">提现详情</div>

                        <div id="fe-tab-link-li-50" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 50)" data-href="{{ yzAppFullUrl('member/address') }}">收货地址</div>

                        <div id="fe-tab-link-li-52" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 52)" data-href="{{ yzAppFullUrl('member/appendAddress') }}">添加收货地址</div>

                        <div id="fe-tab-link-li-53" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 53)" data-href="{{ yzAppFullUrl('member/distributionCommission') }}">未提现分销佣金</div>

                        <div id="fe-tab-link-li-54" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 54)" data-href="{{ yzAppFullUrl('member/footprint') }}">我的足记</div>

                        <div id="fe-tab-link-li-55" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 55)" data-href="{{ yzAppFullUrl('member/collection') }}">我的收藏</div>

                        <div id="fe-tab-link-li-56" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 56)" data-href="{{ yzAppFullUrl('member/myrelationship') }}">我的关系</div>

                        <div id="fe-tab-link-li-57" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 57)" data-href="{{ yzAppFullUrl('member/offlineSearch') }}">下线搜索</div>

                        <div id="fe-tab-link-li-58" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 58)" data-href="{{ yzAppFullUrl('member/myEvaluation') }}">我的评价</div>

                        <div id="fe-tab-link-li-59" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 59)" data-href="{{ yzAppFullUrl('member/comment') }}">多商品评价</div>

                        <div id="fe-tab-link-li-60" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 60)" data-href="{{ yzAppFullUrl('member/evaluationDetails') }}">评价详情</div>

                        <div id="fe-tab-link-li-61" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 61)" data-href="{{ yzAppFullUrl('member/extension') }}">我的推广</div>

                        <div id="fe-tab-link-li-62" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 62)" data-href="{{ yzAppFullUrl('extension/distribution') }}">分销商</div>

                        <div id="fe-tab-link-li-63" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 63)" data-href="{{ yzAppFullUrl('extension/commission') }}">预计佣金</div>

                        <div id="fe-tab-link-li-64" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 64)" data-href="{{ yzAppFullUrl('extension/commissionDetails') }}">预计佣金详情</div>

                        <div id="fe-tab-link-li-65" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 65)" data-href="{{ yzAppFullUrl('extension/unsettled') }}">未结算佣金</div>

                        <div id="fe-tab-link-li-66" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 66)" data-href="{{ yzAppFullUrl('extension/unsettledDetails') }}">未结算佣金详情</div>

                        <div id="fe-tab-link-li-67" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 67)" data-href="{{ yzAppFullUrl('extension/alreadySettled') }}">已结算佣金</div>

                        <div id="fe-tab-link-li-68" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 68)" data-href="{{ yzAppFullUrl('extension/alreadySettledDetails') }}">已结算佣金详情</div>

                        <div id="fe-tab-link-li-69" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 69)" data-href="{{ yzAppFullUrl('extension/notPresent') }}">未提现佣金</div>

                        <div id="fe-tab-link-li-70" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 70)" data-href="{{ yzAppFullUrl('extension/notPresentDetails') }}">未提现佣金详情</div>

                        <div id="fe-tab-link-li-71" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 71)" data-href="{{ yzAppFullUrl('extension/present') }}">已提现佣金</div>

                        <div id="fe-tab-link-li-72" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 72)" data-href="{{ yzAppFullUrl('extension/presentDetails') }}">已提现佣金详情</div>

                        <div id="fe-tab-link-li-73" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 73)" data-href="{{ yzAppFullUrl('extension/distributionOrder') }}">分销订单</div>

                        <div id="fe-tab-link-li-76" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 76)" data-href="{{ yzAppFullUrl('member/logistics') }}">物流详情</div>

                        <div id="fe-tab-link-li-77" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 77)" data-href="{{ yzAppFullUrl('member/evaluate') }}">评价</div>

                        <div id="fe-tab-link-li-78" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 78)" data-href="{{ yzAppFullUrl('member/replyEvaluate') }}">回复评价</div>

                        <div id="fe-tab-link-li-79" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 79)" data-href="{{ yzAppFullUrl('member/addevaluate') }}">追加评价</div>

                        <div id="fe-tab-link-li-80" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 80)" data-href="{{ yzAppFullUrl('member/refund') }}">申请售后</div>

                        <div id="fe-tab-link-li-81" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 81)" data-href="{{ yzAppFullUrl('member/aftersaleslist') }}">售后列表</div>

                        <div id="fe-tab-link-li-84" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 84)" data-href="{{ yzAppFullUrl('coupon/coupon_index') }}">优惠券</div>

                        <div id="fe-tab-link-li-85" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 85)" data-href="{{ yzAppFullUrl('coupon/coupon_store') }}">领券中心</div>

                        <div id="fe-tab-link-li-86" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 86)" data-href="{{ yzAppFullUrl('coupon/coupon_info') }}">详情</div>

                        <div id="fe-tab-link-li-87" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 87)" data-href="{{ yzAppFullUrl('member/marketing') }}">营销工具</div>

                        <div id="fe-tab-link-li-88" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 88)" data-href="{{ yzAppFullUrl('member/messageSettings') }}">消息提醒设置</div>

                        <div id="fe-tab-link-li-89" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 89)" data-href="{{ yzAppFullUrl('search') }}">搜索</div>

                        <div id="fe-tab-link-li-90" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 90)" data-href="{{ yzAppFullUrl('ogin') }}">登录</div>

                        <div id="fe-tab-link-li-91" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 91)" data-href="{{ yzAppFullUrl('register') }}">注册</div>

                        <div id="fe-tab-link-li-92" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 92)" data-href="{{ yzAppFullUrl('category') }}">分类</div>

                        <div id="fe-tab-link-li-94" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 94)" data-href="{{ yzAppFullUrl('brand') }}">品牌</div>

                        <div id="fe-tab-link-li-95" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 95)" data-href="{{ yzAppFullUrl('brandgoods') }}">品牌商品</div>

                        <div id="fe-tab-link-li-96" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 96)" data-href="{{ yzAppFullUrl('cart') }}">购物车</div>

                        <div id="fe-tab-link-li-97" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 97)" data-href="{{ yzAppFullUrl('cart/settlement') }}">结算</div>

                        <div id="fe-tab-link-li-99" class="btn btn-default mylink-nav" ng-click="chooseLink(1, 99)" data-href="{{ yzAppFullUrl('goodsorder') }}">填写订单</div>

            <!-- 新增链接结束 -->
<!-- ========================================================================= -->
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane link_goods" id="link_goods">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" value="" id="select-good-kw" placeholder="请输入商品名称进行搜索 (多规格商品不支持一键下单)">
                        <span class="input-group-btn"><button type="button" class="btn btn-default" id="select-good-btn">搜索</button></span>
                    </div>
                    <div class="mylink-con" id="select-goods" style="height:266px;"></div>
                </div>





                <div role="tabpanel" class="tab-pane link_cate" id="link_cate">
                    <?php $first_category = \app\backend\modules\goods\models\Category::getCategoryFirstLevel(); ?>
                    <?php $second_category = \app\backend\modules\goods\models\Category::getCategorySecondLevel(); ?>
                    <?php $third_category = \app\backend\modules\goods\models\Category::getCategoryThirdLevel(); ?>
                    <div class="mylink-con">
                        @if (!is_null($first_category))
                            @foreach ($first_category as $goodcate_parent)
                                <div class="mylink-line">
                                    {{ $goodcate_parent['name'] }}
                                    <div class="mylink-sub">
                                        <a href="javascript:;" id="category-{{ $goodcate_parent['id'] }}" class="mylink-nav" ng-click="chooseLink(1, 'category-{{ $goodcate_parent['id'] }}')" data-href="{{ yzAppFullUrl('catelist/:id') }}">选择</a>
                                    </div>
                                </div>
                                <?php
                                $sub_level = null;
                                $parent_id = $goodcate_parent['id'];
                                if (!is_null($second_category)) {
                                    $sub_level = collect($second_category)->filter(function ($val, $key) use ($parent_id) {
                                        if ($val['parent_id'] == $parent_id) {
                                            return $val;
                                        }
                                    });
                                }
                                ?>
                                @if (!is_null($sub_level))
                                    @foreach ($sub_level as $goodcate_chlid)
                                        <div class="mylink-line">
                                            <span style='height:10px; width: 10px; margin-left: 10px; margin-right: 10px; display:inline-block; border-bottom: 1px dashed #ddd; border-left: 1px dashed #ddd;'></span>
                                            {{ $goodcate_chlid['name'] }}
                                            <div class="mylink-sub">
                                                <a href="javascript:;" class="mylink-nav" data-href="{{ yzAppFullUrl('catelist/' . $goodcate_chlid['id']) }}">选择</a>
                                            </div>
                                        </div>
                                        <?php
                                        $third_level = null;
                                        $secod_parent_id = $goodcate_chlid['id'];
                                        if (!is_null($third_category)) {
                                            $third_level = collect($third_category)->filter(function ($val, $key) use ($secod_parent_id) {
                                                if ($val['parent_id'] == $secod_parent_id) {
                                                    return $val;
                                                }
                                            });
                                        }

                                        ?>
                                        @if (!is_null($third_level))
                                            @foreach ($third_level as $goodcate_third)
                                                @if ($goodcate_third['parent_id'] == $goodcate_chlid['id'])
                                                    <div class="mylink-line">
                                                        <span style='height:10px; width: 10px; margin-left: 30px; margin-right: 10px; display:inline-block; border-bottom: 1px dashed #ddd; border-left: 1px dashed #ddd;'></span>
                                                        {{ $goodcate_third['name'] }}
                                                        <div class="mylink-sub">
                                                            <a href="javascript:;" class="mylink-nav" data-href="{{ yzAppFullUrl('catelist/' . $goodcate_third['id']) }}">选择</a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>

                {!! my_link_extra('content') !!}


                <div role="tabpanel" class="tab-pane link_cate" id="link_other">
                    <div class="mylink-con" style="height: 150px;">
                        <div class="form-group" style="overflow: hidden;">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label" style="line-height: 34px;">链接地址</label>
                            <div class="col-sm-9 col-xs-12">
                                <textarea name="mylink_href" class="form-control" style="height: 90px; resize: none;" placeholder="请以http://开头"></textarea>
                            </div>
                        </div>
                        <div class="form-group" style="overflow: hidden; margin-bottom: 0px;">
                            <label class="col-xs-12 col-sm-3 col-md-2 control-label" style="line-height: 34px;"></label>
                            <div class="col-sm-9 col-xs-12">
                                <div class="btn btn-primary col-lg-1 mylink-nav2" id="other-1" ng-click="chooseLink(1, 'other-1')" style="margin-left: 20px; width: auto; overflow: hidden; margin-left: 0px;"> 插入 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- mylink end -->
<script language="javascript">
    var parentObj = null;
    require(['jquery'],function(){


    $(function() {
        $("#chkoption").click(function() {
            var obj = $(this);
            if (obj.get(0).checked) {
                $("#tboption").show();
                $(".trp").hide();
            }
            else {
                $("#tboption").hide();
                $(".trp").show();
            }
        });
    })

    $(document).on("click",".nav-link",function(){
        parentObj = $(this).parent("span").prev();//this是button按鈕，獲取到它前面的input
        var id = $(this).data("id");
        if(id){
            $("#modal-mylink").attr({"data-id":id});
            $("#modal-mylink").modal();
        }
    });
    $(document).on("click",".mylink-nav",function(){
        var href = $(this).data("href");
        var id = $("#modal-mylink").attr("data-id");
        if(id){
            parentObj.val(href);
            parentObj = null;
            //$("input[data-id="+id+"]").val(href);
            $("#modal-mylink").attr("data-id","");
        }else{
            ue.execCommand('link', {href:href});
        }

        $("#modal-mylink .close").click();
    });
    $(".mylink-nav2").click(function(){
        var href = $("textarea[name=mylink_href]").val();
        if(href){
            var id = $("#modal-mylink").attr("data-id");
            if(id){
                parentObj.val(href);
                parentObj = null;
                //$("input[data-id="+id+"]").val(href);
                $("#modal-mylink").attr("data-id","");
            }else{
                ue.execCommand('link', {href:href});
            }
            $("#modal-mylink .close").click();
            $("textarea[name=mylink_href]").val("");
        }else{
            $("textarea[name=mylink_href]").focus();
            alert("链接不能为空!");
        }
    });
    // ajax 选择商品
    $("#select-good-btn").click(function(){
        var kw = $("#select-good-kw").val();
        $.ajax({
            type: 'POST',
            url: "{!! yzWebUrl('goods.goods.getMyLinkGoods') !!}",
            data: {kw:kw},
            dataType:'json',
            success: function(data){

                $("#select-goods").html("");
                if(data){
                    $.each(data,function(n,value){
                        var html = '<div class="good">';
                        html+='<div class="img"><img src="'+value.thumb+'"/></div>'
                        html+='<div class="choosebtn">';
                        html+='<a href="javascript:;" class="mylink-nav" data-href="'+value.url+'">详情链接</a><br>';
                        /*if(value.hasoption==0){
                            html+='<a href="javascript:;" class="mylink-nav" data-href="">下单链接</a>';
                        }*/
                        //id="other-1" ng-click="chooseLink(1, 'other-1')"
                        html+='</div>';
                        html+='<div class="info">';
                        html+='<div class="info-title">'+value.title+'</div>';
                        html+='<div class="info-price">原价:￥'+value.market_price+' 现价￥'+value.price+'</div>';
                        html+='</div>'
                        html+='</div>';
                        $("#select-goods").append(html);
                    });
                }
            }
        });
    });

    })
</script>