@extends('layouts.base')
@section('title', trans('添加录播课程'))
@section('content')

    <div class="right-titpos">
        <ul class="add-snav">
            <li class="active"><a href="#">添加录播课程</a></li>
        </ul>
    </div>

    <div class='panel panel-default'>
        <div class="clearfix panel-heading">
            <a id="" class="btn btn-defaultt" style="height: 35px;margin-top: 5px;color: white;"
               href="javascript:history.go(-1);">返回</a>
        </div>
    </div>

    <div class="w1200 m0a">
        <div class="rightlist">
            <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">

                @if($type=='1')
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-1 control-label">课程名称</label>
                        <div class="col-sm-9 col-xs-12 col-md-11">
                            <input name="name" type="text" class="form-control" value="" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-1 control-label">课程封面</label>
                        <div class="col-sm-9 col-xs-12 col-md-10">
                            {!! app\common\helpers\ImageHelper::tplFormFieldImage('cover_img', '') !!}
                            <span class="help-block">图片比例 5:4，请按照规定尺寸上传</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-1 control-label">课程介绍</label>
                        <div class="col-sm-9 col-xs-12 col-md-11">
                            {!! yz_tpl_ueditor('desc', $info['desc']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-1 control-label">课程状态</label>
                        <div class="col-sm-9 col-xs-12 col-md-11">
                            <select name="live_status" class="form-control">
                                <option value="">请选择课程状态</option>
                                <option value="0" selected>筹备中</option>
                                <option value='1'>更新中</option>
                                <option value='2'>已完结</option>
                            </select>
                        </div>
                    </div>
                    {{--fixby-wk-课程设置精选 20201019--}}
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-1 control-label">是否精选</label>
                        <div class="col-sm-9 col-xs-12 col-md-11">
                            <label class="radio-inline">
                                <input type="radio" name="is_selected" value="1"/>
                                是
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="is_selected" value="0" checked="checked" />
                                否
                            </label>
                        </div>
                    </div>
                @endif

                @if($type=='2')
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-1 control-label">专辑名称</label>
                        <div class="col-sm-9 col-xs-12 col-md-11">
                            <input name="name" type="text" class="form-control" value="" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-1 control-label">专辑封面</label>
                        <div class="col-sm-9 col-xs-12 col-md-10">
                            {!! app\common\helpers\ImageHelper::tplFormFieldImage('cover_img', '') !!}
                            <span class="help-block">图片比例 5:4，请按照规定尺寸上传</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 col-md-1 control-label">专辑介绍</label>
                        <div class="col-sm-9 col-xs-12 col-md-11">
                            {!! yz_tpl_ueditor('desc', $info['desc']) !!}
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-1 control-label">排序</label>
                    <div class="col-sm-9 col-xs-12 col-md-11">
                        <input name="sort" type="number" class="form-control" value="0" required/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="hidden" name="type" value="{{ $type }}"/>
                        <input type="submit" name="submit" value="提交" class="btn btn-success"/>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <script type="text/javascript">
        var ueditoroption = {
            'toolbars': [['source', 'preview', '|', 'bold', 'italic', 'underline', 'strikethrough', 'forecolor', 'backcolor', '|',
                'justifyleft', 'justifycenter', 'justifyright', '|', 'insertorderedlist', 'insertunorderedlist', 'blockquote', 'emotion',
                'link', 'removeformat', '|', 'rowspacingtop', 'rowspacingbottom', 'lineheight', 'indent', 'paragraph', 'fontsize', '|',
                'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol',
                'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', '|', 'anchor', 'map', 'print', 'drafts']],
        };
    </script>

@endsection
