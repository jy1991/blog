@extends('layouts.admin')

@section('content')

<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{ url('admin/info') }}">首页</a> &raquo; 添加文章
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>快捷操作</h3>
            @if(is_string($errors))
                <div class="mark">
                    <p> {{ $errors }} </p>
                </div>
            @elseif(count($errors) > 0)
                <div class="mark">
                    @foreach($errors->all() as $error)
                        <p> {{ $error }} </p>
                    @endforeach
                </div>
            @endif

        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="#"><i class="fa fa-plus"></i>新增文章</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{ url('admin/article') }}" method="post">
            {{ csrf_field() }}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>分类：</th>
                        <td>
                            <select name="cate_id">
                                @foreach($data as $v)
                                    <option value="{{ $v->cate_id  }}">{{ $v->cate_name  }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>文章标题：</th>
                        <td>
                            <input type="text" class="lg" name="art_title">
                            <p>标题可以写30个字</p>
                        </td>
                    </tr>
                    <tr>
                        <th>编辑：</th>
                        <td>
                            <input type="text" class="lg" name="art_order">
                        </td>
                    </tr>
                    <tr>
                        <th>缩略图：</th>
                        <td>
                        <input type="text" size="50" name="art_thumb">
                        <input id="file_upload" name="file_upload" type="file" multiple="true">
                        <script src="{{ asset('resources/org/uploadify/jquery.uploadify.min.js') }}" type="text/javascript"></script>
                        <link rel="stylesheet" type="text/css" href="{{ asset('resources/org/uploadify/uploadify.css') }}">
                            <script type="text/javascript">
                                //Uploadify Demo
                                <?php $timestamp = time();?>
                                $(function() {
                                    $("#file_upload").uploadify({
                                        'buttonText': '图片上传',
                                        'formData'     : {
                                            'timestamp' : '<?php echo $timestamp;?>',
                                            'token'     : "{{ csrf_token() }}"
                                        },
                                        'swf'      : "{{ asset('resources/org/uploadify/uploadify.swf') }}",
                                        'uploader' : "{{ url('admin/upload') }}",
                                        'onUploadSuccess' : function(file,data,response)
                                        {
                                           $("input[name='art_thumb']").val(data);
                                            $('#art_thumb_img').attr('src','/'+data);
                                        }
                                    });
                                });
                            </script>
                            <style>
                                .uploadify{display:inline-block;}
                                .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
                                table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
                            </style>
                        </td>
                    </tr>
                    <tr>
                        <th>关键词：</th>
                        <td>
                            <input type="text" class="lg" name="art_tag">
                        </td>
                    </tr>
                    <tr>
                        <th>描述：</th>
                        <td>
                            <textarea name="art_description"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>文章内容：</th>
                        <script type="text/javascript" charset="utf-8" src="{{ asset('resources/org/ueditor/ueditor.config.js') }}"></script>
                        <script type="text/javascript" charset="utf-8" src="{{ asset('resources/org/ueditor/ueditor.all.min.js') }}"> </script>
                        <script type="text/javascript" charset="utf-8" src="{{ asset('resources/org/ueditor/lang/zh-cn/zh-cn.js') }}"></script>
                        <td>
                            <script name="art_content" id="editor" type="text/plain" style="width:1024px;height:500px;"></script>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <script>

        //实例化编辑器
        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
        var ue = UE.getEditor('editor');

    </script>

@endsection