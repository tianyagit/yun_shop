@extends('layouts.base')
@section('title', trans('回看列表'))
@section('content')

    <div class="right-titpos">
        <ul class="add-snav">
            @if($room_type=='1')
                <li class="active"><a href="#">主题列表</a></li>
            @endif
            @if($room_type=='2')
                <li class="active"><a href="#">作业列表</a></li>
            @endif
        </ul>
    </div>

    @if($room_type=='1')
        <div class="panel panel-info">
            <div class="panel-body">
                <form action="" method="get" class="form-horizontal" role="form" id="form2">
                    <input type="hidden" name="c" value="site"/>
                    <input type="hidden" name="a" value="entry"/>
                    <input type="hidden" name="m" value="yun_shop"/>
                    <input type="hidden" name="do" value="{{ $request['do'] }}"/>
                    <input type="hidden" name="route" value="plugin.appletslive.admin.controllers.room.replaylist"/>
                    <input type="hidden" name="rid" value="{{ $request['rid'] }}"/>
                    <div class="form-group">
                        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                            <input type="number" placeholder="视频ID" class="form-control" name="search[id]"
                                   value="{{$request['search']['id']}}"/>
                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                            <input type="text" class="form-control" name="search[title]"
                                   value="{{$request['search']['title']}}" placeholder="视频标题"/>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                            <select name="search[type]" class="form-control">
                                <option value="">请选择视频类型</option>
                                <option value="1" @if($request['search']['type']=='1') selected @endif>本地上传</option>
                                <option value='2' @if($request['search']['type']=='2') selected @endif>腾讯视频</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                            <select name="search[status]" class="form-control">
                                <option value="">请选择显示/隐藏</option>
                                <option value="1" @if($request['search']['status']=='1') selected @endif>显示</option>
                                <option value='0' @if($request['search']['status']=='0') selected @endif>隐藏</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                            <button type="submit" class="btn btn-success"><i class="fa fa-search"></i>搜索</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class='panel panel-default'>
            <div class="clearfix panel-heading">
                <a id="" class="btn btn-defaultt" style="height: 35px;margin-top: 5px;color: white;"
                   href="javascript:history.go(-1);">返回</a>
                <a id="btn-add-replay" class="btn btn-defaultt" style="height: 35px;margin-top: 5px;color: white;"
                   href="{{yzWebUrl('plugin.xiaoe-clock.admin.clock.clock_task_add', ['rid' => $rid])}}">创建主题</a>
            </div>
            <div class='panel-body'>
                <table class="table table-hover" style="overflow:visible;">
                    <thead>
                    <tr>
                        <th style='width:5%;'>ID</th>
                        <th style='width:8%;'>主题名称</th>
                        <th style='width:11%;'>主题日期</th>
                        <th style='width:11%;'>打卡人数</th>
                        <th style='width:15%;'>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($replay_list as $row)
                        <tr>
                            <td>{{ $row['id'] }}</td>
                            <td style="overflow:visible;">
                                <div class="show-cover-img-big" style="position:relative;width:50px;overflow:visible">
                                    <img src="{!! tomedia($row['cover_img']) !!}" alt=""
                                         style="width: 30px; height: 30px;border:1px solid #ccc;padding:1px;">
                                    <img class="img-big" src="{!! tomedia($row['cover_img']) !!}" alt=""
                                         style="z-index:99999;position:absolute;top:0;left:0;border:1px solid #ccc;padding:1px;display: none">
                                </div>
                                {{ $row['name'] }}
                            </td>
                            <td>{{ date('Y-m-d', $row['theme_time']) }}</td>
                            <td>{{ $row['join_num'] }}</td>
                            <td style="overflow:visible;">
                                <a class='btn btn-default'
                                   href="{{yzWebUrl('plugin.xiaoe-clock.admin.clock.clock_task_edit', ['id' => $row['id']])}}"
                                   title='主题编辑'><i class='fa fa-edit'></i>编辑
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $pager !!}
            </div>
        </div>
    @endif

    @if($room_type=='2')
        <div class="panel panel-info">
            <div class="panel-body">
                <form action="" method="get" class="form-horizontal" role="form" id="form2">
                    <input type="hidden" name="c" value="site"/>
                    <input type="hidden" name="a" value="entry"/>
                    <input type="hidden" name="m" value="yun_shop"/>
                    <input type="hidden" name="do" value="{{ $request['do'] }}"/>
                    <input type="hidden" name="route" value="plugin.appletslive.admin.controllers.room.replaylist"/>
                    <input type="hidden" name="rid" value="{{ $request['rid'] }}"/>
                    <div class="form-group">
                        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                            <input type="number" placeholder="房间号" class="form-control" name="search[roomid]"
                                   value="{{$request['search']['roomid']}}"/>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                            <input type="text" class="form-control" name="search[name]"
                                   value="{{$request['search']['name']}}" placeholder="名称"/>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                            <select name="search[live_status]" class="form-control">
                                <option value="">直播状态</option>
                                <option value="101" @if($request['search']['live_status']=='101') selected @endif>直播中</option>
                                <option value='102' @if($request['search']['live_status']=='102') selected @endif>待开播</option>
                                <option value='103' @if($request['search']['live_status']=='103') selected @endif>已结束</option>
                                <option value='107' @if($request['search']['live_status']=='107') selected @endif>已过期</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                            <select name="search[status]" class="form-control">
                                <option value="">请选择显示/隐藏</option>
                                <option value="1" @if($request['search']['status']=='1') selected @endif>显示</option>
                                <option value='0' @if($request['search']['status']=='0') selected @endif>隐藏</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                            <button type="submit" class="btn btn-success"><i class="fa fa-search"></i>搜索</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class='panel panel-default'>
            <div class="clearfix panel-heading">
                <a id="" class="btn btn-defaultt" style="height: 35px;margin-top: 5px;color: white;"
                   href="javascript:history.go(-1);">返回</a>
                <a id="btn-add-replay" class="btn btn-defaultt" style="height: 35px;margin-top: 5px;color: white;"
                   href="{{yzWebUrl('plugin.xiaoe-clock.admin.clock.clock_task_add', ['rid' => $rid])}}">添加作业</a>
            </div>
            <div class='panel-body'>
                <table class="table table-hover" style="overflow:visible;">
                    <thead>
                    <tr>
                        <th style='width:5%;'>ID</th>
                        <th style='width:5%;'>作业名称</th>
                        <th style='width:10%;'>作业有效期</th>
                        <th style='width:15%;'>打卡次数</th>
                        <th style='width:10%;'>点赞数</th>
                        <th style='width:5%;'>评论数</th>
                        <th style='width:15%;'>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($replay_list as $row)
                        <tr>
                            <td>{{ $row['id'] }}</td>
                            <td>{{ $row['name'] }}</td>
                            <td>{{ date('Y-m-d',$row['start_time'])}} 致 {{ date('Y-m-d',$row['end_time'])}}</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td style="overflow:visible;">
                                <a class='btn btn-default'
                                   href="{{yzWebUrl('plugin.xiaoe-clock.admin.clock.clock_task_edit', ['id' => $row['id']])}}"
                                   title='设置'><i class='fa fa-edit'></i>设置
                                </a>
                                @if ($row['delete_time'] > 0)
                                    <a class='btn btn-default btn-success'
                                       href="{{yzWebUrl('plugin.appletslive.admin.controllers.room.replayshowhide', ['id' => $row['id']])}}"
                                       title='显示'>显示
                                    </a>
                                @else
                                    <a class='btn btn-default btn-danger'
                                       href="{{yzWebUrl('plugin.appletslive.admin.controllers.room.replayshowhide', ['id' => $row['id']])}}"
                                       title='隐藏'>隐藏
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $pager !!}
            </div>
        </div>
    @endif

    <div style="width:100%;height:150px;"></div>
    <script type="text/javascript">
        // 查看商品封面大图
        $('.show-cover-img-big').on('mouseover', function () {
            $(this).find('.img-big').show();
        });
        $('.show-cover-img-big').on('mouseout', function () {
            $(this).find('.img-big').hide();
        });
    </script>
@endsection