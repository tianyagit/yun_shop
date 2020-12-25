@extends('layouts.base')
@section('title', trans('主题|作业编辑'))
@section('content')

    <div class="right-titpos">
        <ul class="add-snav">
            @if($room['type']=='1')
                <li class="active"><a href="#">日记详情</a></li>
            @else
                <li class="active"><a href="#">日记详情</a></li>
            @endif
        </ul>
    </div>
    <div class='panel panel-default'>
        <div class='panel-body'>
            <div class="clearfix panel-heading" id="goodsTable">
                <a id="" class="btn btn-defaultt" style="height: 35px;margin-top: 5px;color: white;"
                   href="javascript:history.go(-1);">返回</a>
            </div>

            <div class="w1200 m0a">
                <div class="rightlist">
                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">

                        <div class="form-group">
                            <label class="col-md-2 col-sm-3 col-xs-12 control-label">用户头像/昵称</label>
                            <div class="col-md-10 col-sm-9 col-xs-12">
                                <div class="show-cover-img-big" style="position:relative;width:50px;overflow:visible">
                                    <img src="{!! tomedia($user_clock_info['avatar']) !!}" alt=""
                                         style="width: 30px; height: 30px;border:1px solid #ccc;padding:1px;">
                                    <img class="img-big" src="{!! tomedia($user_clock_info['avatar']) !!}" alt=""
                                         style="z-index:99999;position:absolute;top:0;left:0;border:1px solid #ccc;padding:1px;display: none">
                                </div>
                                {{ $user_clock_info['nickname'] }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-3 col-xs-12 control-label">打卡时间</label>
                            <div class="col-md-10 col-sm-9 col-xs-12">
                                {{ date('Y-m-d H:i:s', $user_clock_info['created_at']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-sm-3 col-xs-12 control-label">打卡内容</label>
                            <div class="col-md-10 col-sm-9 col-xs-12">
                                {!! yz_tpl_ueditor('text_desc', $user_clock_info['text_desc']) !!}
                            </div>
                        </div>
                        @if(empty($user_clock_info['video_desc']))
                            <div class="form-group">
                                <label class="col-md-2 col-sm-3 col-xs-12 control-label">主题正文：视频</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    {!! app\common\helpers\ImageHelper::tplFormFieldVideo('video_desc',$user_clock_info['video_desc']) !!}
                                </div>
                            </div>
                        @endif
                        @if(empty($user_clock_info['image_desc']))
                            @foreach($user_clock_info['image_desc'] as $row)
                                <div class="form-group">
                                    <label class="col-md-2 col-sm-3 col-xs-12 control-label">评论图片</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <div class="show-cover-img-big"
                                             style="position:relative;width:50px;overflow:visible">
                                            <img src="{!! tomedia($row) !!}" alt=""
                                                 style="width: 30px; height: 30px;border:1px solid #ccc;padding:1px;">
                                            <img class="img-big" src="{!! tomedia($row) !!}" alt=""
                                                 style="z-index:99999;position:absolute;top:0;left:0;border:1px solid #ccc;padding:1px;display: none">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="form-group">
                            <label class="col-md-2 col-sm-3 col-xs-12 control-label">排序</label>
                            <div class="col-md-10 col-sm-9 col-xs-12">
                                <input name="sort" type="number" class="form-control" value="{{ $info['sort'] }}"
                                       placeholder="" required/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">

        var Page = {
            data: {},
            init: function () {
                var that = this;

                // 查看直播间封面大图
                $('.show-cover-img-big').on('mouseover', function () {
                    $(this).find('.img-big').show();
                });
                $('.show-cover-img-big').on('mouseout', function () {
                    $(this).find('.img-big').hide();
                });

                // 监听表格中使用直播间按钮事件
                $('.btn-use-liveroom').on('click', function () {
                    var btnSureUseThisLiveroom = document.getElementById('sureUseThisLiveroom');
                    btnSureUseThisLiveroom.dataset.id = $(this).attr('data-id');
                    btnSureUseThisLiveroom.dataset.room_id = $(this).attr('data-room_id');
                    console.log('replay id:', btnSureUseThisLiveroom.dataset.id);
                    console.log('use room room_id:', btnSureUseThisLiveroom.dataset.room_id);
                });

                // 监听模态框确定使用直播间按钮事件
                $('#sureUseThisLiveroom').on('click', function () {
                    var btnSureUseThisLiveroom = document.getElementById('sureUseThisLiveroom');
                    that.useLiveroom(btnSureUseThisLiveroom.dataset.id, btnSureUseThisLiveroom.dataset.room_id);
                });
            },
            useLiveroom: function (id, room_id) {
                var data = {
                    id: id,
                    room_id: room_id,
                    type: 0,
                    cover_img: '',
                    media_url: '',
                    doctor: '',
                    minute: 0,
                    second: 0,
                    publish_time: '',
                    sort: 0,
                };

                $('#sureUseThisLiveroom').button('loading');

                $.ajax({
                    url: "",
                    type: 'POST',
                    data: data,
                    success: function (res) {
                        $('#sureUseThisLiveroom').button('reset');
                        if (res.result == 1) {
                            $('#modal-use-liveroom').find('a').trigger('click');
                        }
                        var jump = "{!! yzWebUrl('plugin.appletslive.admin.controllers.room.replaylist',['rid'=>$info['rid']]) !!}";
                        util.message(res.msg, res.result == 1 ? jump : '', res.result == 1 ? 'success' : 'info');
                    }
                });
            }
        };

        Page.init();

    </script>

@endsection
