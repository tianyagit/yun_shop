@extends('layouts.base')
@section('title', trans('添加商品'))
@section('content')

    <div class="right-titpos">
        <ul class="add-snav">
            <li class="active"><a href="#">添加商品</a></li>
        </ul>
    </div>

    <div class="panel panel-info">
        <div class="panel-body">
            <form action="" method="get" class="form-horizontal" role="form" id="form1">
                <input type="hidden" name="c" value="site"/>
                <input type="hidden" name="a" value="entry"/>
                <input type="hidden" name="m" value="yun_shop"/>
                <input type="hidden" name="do" value="{{ $request['do'] }}" />
                <input type="hidden" name="route" value="plugin.appletslive.admin.controllers.goods.add"/>
                <div class="form-group">
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <select name='search[brand_id]' class='form-control'>
                            <option value="">请选择品牌</option>
                            @foreach ($brand as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <input type="text" class="form-control" name="search[title]"
                               value="{{$request['search']['title']}}" placeholder="商品名称"/>
                    </div>
                    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                        <button type="submit" class="btn btn-success"><i class="fa fa-search"></i>搜索</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class='panel panel-default'>
        <div class='panel-body'>
            <div class="clearfix panel-heading" id="goodsTable">
                <a id="" class="btn btn-defaultt" style="height: 35px;margin-top: 5px;color: white;"
                   href="javascript:history.go(-1);">返回</a>
            </div>

            <table class="table table-hover" style="overflow:visible;">
                <thead>
                <tr style="">
                    <th style='width:10%;'>ID</th>
                    <th style='width:10%;'>封面</th>
                    <th style='width:10%;'>品牌</th>
                    <th style='width:35%;'>名称</th>
                    <th style='width:15%;'>价格(元)</th>
                    <th style='width:20%;'>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($goods as $row)
                    <tr style="">
                        <td>{{ $row['id'] }}</td>
                        <td style="overflow:visible;">
                            <div class="show-thumb-big" style="position:relative;width:50px;overflow:visible">
                                <img src="{!! tomedia($row['thumb']) !!}"
                                     style="width: 30px; height: 30px;border:1px solid #ccc;padding:1px;">
                                <img class="thumb-big" src="{!! tomedia($row['thumb']) !!}"
                                     style="z-index:99999;position:absolute;top:0;left:0;border:1px solid #ccc;padding:1px;display: none">
                            </div>
                        </td>
                        <td>
                            {{ $brand[$row['brand_id']] }}
                        </td>
                        <td>{{ $row['title'] }}</td>
                        <td>{{ floatval($row['price']) }}</td>
                        <td>
                            <a class="btn btn-primary add-goods" style="height: 35px;margin-top: 5px;color: white;"
                               href="javascript:;;" data-id="{{ $row['id'] }}" data-title="{{ $row['title'] }}"
                               data-price="{{ $row['price'] }}" data-thumb="{{ $row['thumb'] }}"
                               data-imgurl="{!! tomedia($row['thumb']) !!}"
                               data-toggle="modal" data-target="#modal-add-goods">添加到商品库</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $pager !!}
        </div>
    </div>

    <!-- 提交商品弹出模态框 -->
    <div id="modal-add-goods" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="width:50vw;margin:0px auto;">
        <div class="form-horizontal form">
            <div class="modal-dialog" style="width:100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                        <h3>添加到商品库</h3>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" class="form-horizontal form" onsubmit="return false;">
                            <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">商品名称</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input id="formName" name="name" type="text" class="form-control" value="" required />
                                    <span class="help-block">商品名称不得超过14个汉字</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">预览图片</label>
                                <div class="col-md-9 col-sm-9 col-xs-12 thumb-img">
                                    {!! app\common\helpers\ImageHelper::tplFormFieldImage('cover_img_url', '') !!}
                                    <span class="help-block">图片规则：图片尺寸最大300像素*300像素</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">价格类型</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <label class="radio radio-inline">
                                        <input id="priceType1" type="radio" name="price_type" value="1" checked /> 一口价
                                    </label>
                                    <label class="radio radio-inline">
                                        <input id="priceType2" type="radio" name="price_type" value="2" /> 价格区间
                                    </label>
                                    <label class="radio radio-inline">
                                        <input id="priceType3" type="radio" name="price_type" value="3" /> 折扣价
                                    </label>
                                </div>
                            </div>

                            <div class="form-group price1">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">价格</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input id="formPrice" name="price" type="number" step="0.01" class="form-control" value="" required />
                                </div>
                            </div>

                            <div class="form-group price2" style="display:none;">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">价格(左边界)</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input id="formPrice1" name="price1" type="number" step="0.01" class="form-control" value="" required />
                                </div>
                            </div>

                            <div class="form-group price2" style="display:none;">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">价格(右边界)</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input id="formPrice2" name="price2" type="number" step="0.01" class="form-control" value="" required />
                                </div>
                            </div>

                            <div class="form-group price3" style="display:none;">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">原价</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input id="formPrice3" name="price3" type="number" step="0.01" class="form-control" value="" required />
                                </div>
                            </div>

                            <div class="form-group price3" style="display:none;">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">现价</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input id="formPrice4" name="price4" type="number" step="0.01" class="form-control" value="" required />
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="submitAddGoods" class="btn btn-primary">确定</button>
                        <a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        var Page = {
            data: {
                yzgoods: {},
                postParam: {
                    name: '',
                    goodsId: 0,
                    coverImgUrl: '',
                    priceType: 1,
                    price: 0,
                    price2: 0,
                }
            },
            init: function () {
                var that = this;

                // 查看商品封面大图
                $('.show-thumb-big').on('mouseover', function () {
                    $(this).find('.thumb-big').show();
                });
                $('.show-thumb-big').on('mouseout', function () {
                    $(this).find('.thumb-big').hide();
                });

                // 监听添加到商品库按钮事件
                $(document).on('click', '.add-goods', function () {
                    var goodId = $(this).data('id');
                    that.data.postParam.goodsId = goodId;

                    $('#priceType1').prop('checked', 'checked');
                    $('#priceType2').removeProp('checked');
                    $('#priceType3').removeProp('checked');
                    $('.price1 input').attr('required', true);
                    $('.price1 input').val('');
                    $('.price1').show();
                    $('.price2 input').removeAttr('required');
                    $('.price2 input').val('');
                    $('.price2').hide();
                    $('.price3 input').removeAttr('required');
                    $('.price3 input').val('');
                    $('.price3').hide();

                    that.data.yzgoods = {
                        title: $(this).data('title'),
                        price: $(this).data('price'),
                        thumb: $(this).data('thumb')
                    };

                    $('input[name="name"]').val(that.data.yzgoods.title);
                    $('input[name="price"]').val(that.data.yzgoods.price);
                    $('input[name="cover_img_url"]').val(that.data.yzgoods.thumb);
                    $('.thumb-img img').attr('src', $(this).data('imgurl'));
                });

                // 价格类型onchange
                $(document).on('change', 'input[name="price_type"]', function () {
                    var val = $(this).val();
                    that.data.postParam.priceType = val;
                    if (val == 1) {
                        $('.price1 input').attr('required', true);
                        $('.price1 input').val('');
                        $('.price1 input:eq(0)').val(that.data.yzgoods.price);
                        $('.price1').show();
                        $('.price2 input').removeAttr('required');
                        $('.price2 input').val('');
                        $('.price2').hide();
                        $('.price3 input').removeAttr('required');
                        $('.price3 input').val('');
                        $('.price3').hide();
                    } else if (val == 2) {
                        $('.price1 input').removeAttr('required');
                        $('.price1 input').val('');
                        $('.price1').hide();
                        $('.price2 input').attr('required', true);
                        $('.price2 input').val('');
                        $('.price2 input:eq(0)').val(that.data.yzgoods.price);
                        $('.price2').show();
                        $('.price3 input').removeAttr('required');
                        $('.price3 input').val('');
                        $('.price3').hide();
                    } else {
                        $('.price1 input').removeAttr('required');
                        $('.price1 input').val('');
                        $('.price1').hide();
                        $('.price2 input').removeAttr('required');
                        $('.price2 input').val('');
                        $('.price2').hide();
                        $('.price3 input').attr('required', true);
                        $('.price3 input').val('');
                        $('.price3 input:eq(0)').val(that.data.yzgoods.price);
                        $('.price3').show();
                    }
                });

                // 点击提交表单
                $('#submitAddGoods').on('click', function () {

                    $('input[name="cover_img_url"]').attr('required', true);
                    $('input[name="cover_img"]').attr('id', 'formCoverImgUrl');

                    var check = that.checkForm();
                    if (check) {

                        var submitBtn = $(this);
                        submitBtn.button('loading');

                        $.ajax({
                            url: "",
                            type: 'POST',
                            data: that.data.postParam,
                            success: function (res) {
                                submitBtn.button('reset');
                                var jump = "{!! yzWebUrl('plugin.appletslive.admin.controllers.goods.index') !!}";
                                util.message(res.msg, res.result == 1 ? jump : '', res.result == 1 ? 'success' : 'info');
                            }
                        });
                    }
                });
            },
            checkForm: function () {
                var that = this;

                // 表单验证 - 商品名称长度
                var name = $('input[name="name"]').val().trim();
                if (name.length > 14) {
                    Tip.focus('#formName');
                    return false;
                }
                that.data.postParam.name = name;

                // 表单验证 - 价格
                if (that.data.postParam.priceType == 1) {
                    var price = $('input[name="price"]').val().trim();
                    if (price == '') {
                        Tip.focus('#formName');
                        return false;
                    }
                    that.data.postParam.price = price;
                    that.data.postParam.price2 = 0;
                } else if (that.data.postParam.priceType == 2) {
                    var price = $('input[name="price1"]').val().trim();
                    if (price == '') {
                        Tip.focus('#formPrice1');
                        return false;
                    }
                    that.data.postParam.price = price;
                    var price2 = $('input[name="price2"]').val().trim();
                    if (price2 == '') {
                        Tip.focus('#formPrice2');
                        return false;
                    }
                    that.data.postParam.price2 = price2;
                } else if (that.data.postParam.priceType == 3) {
                    var price = $('input[name="price3"]').val().trim();
                    if (price == '') {
                        Tip.focus('#formPrice3');
                        return false;
                    }
                    that.data.postParam.price = price;
                    var price2 = $('input[name="price4"]').val().trim();
                    if (price2 == '') {
                        Tip.focus('#formPrice4');
                        return false;
                    }
                    that.data.postParam.price2 = price2;
                }

                // 表单验证 - 商品图片
                var coverImgUrl = $('input[name="cover_img_url"]').val().trim();
                if (coverImgUrl.length == 0) {
                    Tip.focus('#formCoverImgUrl');
                    return false;
                }
                that.data.postParam.coverImgUrl = coverImgUrl;

                return true;
            }
        };

        Page.init();

    </script>

@endsection
