@extends('layouts.admin')

@section('content')

<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{ url('admin/info') }}">首页</a> &raquo; 编辑链接
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
                <a href="#"><i class="fa fa-plus"></i>新增链接</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{ url('admin/links/'.$field->link_id) }}" method="post">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th><i class="require">*</i>链接名称：</th>
                        <td>
                            <input type="text" name="link_name" value="{{ $field->link_name }}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>链接名称必须填写</span>
                        </td>
                    </tr>
                    <tr>
                        <th>链接标题：</th>
                        <td>
                            <input type="text" class="lg" name="link_title" value="{{ $field->link_title }}">
                            <p>标题可以写30个字</p>
                        </td>
                    </tr>
                    <tr>
                        <th>链接URL：</th>
                        <td>
                            <input type="text" class="lg" name="link_url" value="{{ $field->link_url }}">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>排序：</th>
                        <td>
                            <input type="text" class="sm" name="link_order" value="{{ $field->link_order }}">
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