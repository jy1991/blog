@extends('layouts.admin')

@section('content')

<body>
    <!--面包屑配置项 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{ url('admin/info') }}">首页</a> &raquo; 编辑配置项
    </div>
    <!--面包屑配置项 结束-->

	<!--结果集标题与配置项组件 开始-->
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
                <a href="#"><i class="fa fa-plus"></i>新增配置项</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
    </div>
    <!--结果集标题与配置项组件 结束-->
    
    <div class="result_wrap">
        <form action="{{ url('admin/config/'.$field->conf_id) }}" method="post">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th><i class="require">*</i>配置项标题：</th>
                        <td>
                            <input type="text" name="conf_title" value="{{ $field->conf_title }}">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>配置项名称：</th>
                        <td>
                            <input type="text" name="conf_name" value="{{ $field->conf_name }}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>配置项名称必须填写</span>
                        </td>
                    </tr>
                    <tr>
                        <th>类型：</th>
                        <td>
                            <input type="text" class="sm" name="field_type" value="{{ $field->field_type }}">
                        </td>
                    </tr>
                    <tr>
                        <th>类型值：</th>
                        <td>
                            <input type="text" class="lg" name="field_value" value="{{ $field->field_value }}">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>排序：</th>
                        <td>
                            <input type="text" class="sm" name="conf_order" value="{{ $field->conf_order }}">
                        </td>
                    </tr>
                    <tr>
                        <th>说明：</th>
                        <td>
                            <textarea name="conf_tips" cols="30" rows="10">{{ $field->conf_tips }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>内容：</th>
                        <td>
                            <textarea name="conf_content" cols="30" rows="10">{{ $field->conf_content }}</textarea>
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

@endsection