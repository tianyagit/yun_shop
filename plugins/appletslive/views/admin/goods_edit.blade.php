@extends('layouts.base')
@section('title', trans('更新商品'))
@section('content')

    <div class="right-titpos">
        <ul class="add-snav">
            <li class="active"><a href="#">更新商品</a></li>
        </ul>
    </div>

    <div class='panel panel-default'>
        <div class="clearfix panel-heading">
            <a id="" class="btn btn-defaultt" style="height: 35px;margin-top: 5px;color: white;"
               href="javascript:history.go(-1);">返回</a>
        </div>
    </div>

    <div class="w1200 m0a">
        <form action="" method="post" class="form-horizontal form" onsubmit="return false;">

            <div class="form-group">
                <label class="col-md-2 col-sm-3 col-xs-12 control-label">商品</label>
                <div class="col-md-10 col-sm-9 col-xs-12">
                    <select id="sltGoodsId" name='goods_id' class='form-control goods-select2'>
                        <option value="">请选择商品</option>
                        @foreach ($goods as $item)
                            <option value="{{ $item['id'] }}" data-title="{{ $item['title'] }}"
                                    data-price="{{ $item['price'] }}" data-thumb="{{ $item['thumb'] }}"
                                    data-imgurl="{!! tomedia($item['thumb']) !!}"
                                    @if($info['goods_id']==$item['id']) selected @endif
                            >{{ $item['title'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group fg-showhide">
                <label class="col-md-2 col-sm-3 col-xs-12 control-label">商品名称</label>
                <div class="col-md-10 col-sm-9 col-xs-12">
                    <input id="formName" name="name" type="text" class="form-control" value="{{ $info['name'] }}" required />
                    <span class="help-block">商品名称不得超过14个汉字</span>
                </div>
            </div>

            <div class="form-group fg-showhide">
                <label class="col-md-2 col-sm-3 col-xs-12 control-label">预览图片</label>
                <div class="col-md-9 col-sm-9 col-xs-12 thumb-img">
                    {!! app\common\helpers\ImageHelper::tplFormFieldImage('cover_img_url', $info['cover_img_url']) !!}
                    <span class="help-block">图片规则：图片尺寸最大300像素*300像素</span>
                </div>
            </div>

            <div class="form-group fg-showhide">
                <label class="col-md-2 col-sm-3 col-xs-12 control-label">价格类型</label>
                <div class="col-md-10 col-sm-9 col-xs-12">
                    <label class="radio radio-inline">
                        <input id="priceType1" type="radio" name="price_type"
                               @if($info['price_type'] == 1) checked @endif value="1" /> 一口价
                    </label>
                    <label class="radio radio-inline">
                        <input id="priceType2" type="radio" name="price_type"
                               @if($info['price_type'] == 2) checked @endif value="2" /> 价格区间
                    </label>
                    <label class="radio radio-inline">
                        <input id="priceType3" type="radio" name="price_type"
                               @if($info['price_type'] == 3) checked @endif value="3" /> 折扣价
                    </label>
                </div>
            </div>

            @if($info['price_type'] == 1)
                <div class="form-group fg-showhide price1">
                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">价格</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                        <input id="formPrice" name="price" type="number" step="0.01" class="form-control" value="{{ $info['price'] }}" required />
                    </div>
                </div>
            @endif

            @if($info['price_type'] == 2)
                <div class="form-group fg-showhide price2">
                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">价格(左边界)</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                        <input id="formPrice1" name="price1" type="number" step="0.01" class="form-control" value="{{ $info['price'] }}" required />
                    </div>
                </div>
                <div class="form-group fg-showhide price2">
                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">价格(右边界)</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                        <input id="formPrice2" name="price2" type="number" step="0.01" class="form-control" value="{{ $info['price2'] }}" required />
                    </div>
                </div>
            @endif

            @if($info['price_type'] == 3)
                <div class="form-group fg-showhide price3">
                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">原价</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                        <input id="formPrice3" name="price3" type="number" step="0.01" class="form-control" value="{{ $info['price'] }}" required />
                    </div>
                </div>
                <div class="form-group fg-showhide price3">
                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">现价</label>
                    <div class="col-md-10 col-sm-9 col-xs-12">
                        <input id="formPrice4" name="price4" type="number" step="0.01" class="form-control" value="{{ $info['price2'] }}" required />
                    </div>
                </div>
            @endif

            <div class="form-group fg-showhide">
                <label class="col-md-2 col-sm-3 col-xs-12 control-label">小程序路径</label>
                <div class="col-md-10 col-sm-9 col-xs-12">
                    <span class="form-control wxapppagepath">{{ $info['url'] }}</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                <div class="col-sm-9 col-xs-12">
                    <input id="submitGoodsForm" type="submit" name="submit" value="提交" class="btn btn-success disabled"/>
                </div>
            </div>

        </form>
    </div>

    <script type="text/javascript">

        var Page = {
            data: {
                yzgoods: {},
                postParam: {
                    id: "{{ $info['id'] }}",
                    name: "{{ $info['name'] }}",
                    goodsId: "{{ $info['goods_id'] }}",
                    coverImgUrl: "{{ $info['cover_img_url'] }}",
                    priceType: "{{ $info['price_type'] }}",
                    price: "{{ $info['price'] }}",
                    price2: "{{ $info['price2'] }}",
                    url: "{{ $info['url'] }}",
                }
            },
            init: function () {
                var that = this;

                $('.goods-select2').select2();

                // 商品下拉菜单onchange
                $(document).on('change', '#sltGoodsId', function () {
                    var goodId = $(this).val();
                    that.data.postParam.goodsId = goodId;
                    $('.fg-showhide').hide();

                    $('#priceType1').prop('checked', 'checked');
                    $('#priceType2').removeProp('checked');
                    $('#priceType3').removeProp('checked');
                    $('.price1 input').attr('required', true);
                    $('.price1 input').val('');
                    $('.price2 input').removeAttr('required');
                    $('.price2 input').val('');
                    $('.price3 input').removeAttr('required');
                    $('.price3 input').val('');

                    $('#submitGoodsForm').addClass('disabled');

                    if (goodId !== '') {

                        var selOption = $(this).find('option:selected');
                        that.data.yzgoods = {
                            title: selOption.data('title'),
                            price: selOption.data('price'),
                            thumb: selOption.data('thumb')
                        };

                        $('input[name="name"]').val(that.data.yzgoods.title);
                        $('input[name="price"]').val(that.data.yzgoods.price);
                        $('input[name="cover_img_url"]').val(that.data.yzgoods.thumb);
                        $('.thumb-img img').attr('src', selOption.data('imgurl'));

                        var url = '/page/abc/def?id=' + goodId;
                        $('.wxapppagepath').text(url);

                        $('.fg-showhide').show();
                        $('.price2').hide();
                        $('.price3').hide();

                        $('#submitGoodsForm').removeClass('disabled');
                    }
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
                $('#submitGoodsForm').on('click', function () {

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
