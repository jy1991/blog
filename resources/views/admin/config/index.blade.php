@extends('layouts.admin')

@section('content')

	<body>
	<!--面包屑配置 开始-->
	<div class="crumb_warp">
		<!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
		<i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">配置管理</a> &raquo; 添加配置
	</div>
	<!--面包屑配置 结束-->

	<!--结果页快捷搜索框 开始-->
	<div class="search_wrap">
		<form action="" method="post">
			{{ csrf_field() }}
			<table class="search_tab">
				<tr>
					<th width="120">选择分类:</th>
					<td>
						<select onchange="javascript:location.href=this.value;">
							<option value="">全部</option>
							<option value="http://www.baidu.com">百度</option>
							<option value="http://www.sina.com">新浪</option>
						</select>
					</td>
					<th width="70">关键字:</th>
					<td><input type="text" name="keywords" placeholder="关键字"></td>
					<td><input type="submit" name="sub" value="查询"></td>
				</tr>
			</table>
		</form>
	</div>
	<!--结果页快捷搜索框 结束-->

	<!--搜索结果页面 列表 开始-->
	<form action="#" method="post">
		<div class="result_wrap">
			<div class="result_title">
				<h3>
					配置管理
				</h3>
			</div>
			<!--快捷配置 开始-->
			<div class="result_content">
				<div class="short_wrap">
					<a href="{{ url('admin/config/create') }}"><i class="fa fa-plus"></i>添加配置</a>
					<a href="{{ url('admin/config') }}"><i class="fa fa-recycle"></i>全部配置</a>
				</div>
			</div>
			<!--快捷配置 结束-->
		</div>

		<div class="result_wrap">
			<div class="result_content">
				<table class="list_tab">
					<tr>
						<th class="tc" width="5%">排序</th>
						<th class="tc" width="5%">ID</th>
						<th>配置标题</th>
						<th>配置名称</th>
						<th>类型</th>
                        <th>类型值</th>
						<th>操作</th>
					</tr>
					@foreach($data as $v)
						<tr>
							<td class="tc">
								<input type="text" onchange="changeOrder(this, '{{ $v->conf_id }}')" value="{{ $v->conf_order }}">
							</td>
							<td class="tc">{{ $v->conf_id }}</td>
							<td class="tc">{{ $v->conf_title }}</td>
							<td>
								<a href="#">{{ $v->conf_name }}</a>
							</td>
							<td>{{ $v->field_type }}</td>
							<td>{{ $v->field_value }}</td>
							<td>
								<a href="{{ url('admin/config/'.$v->conf_id.'/edit') }}">修改</a>
								<a onclick="delConf({{ $v->conf_id }})">删除</a>
							</td>
						</tr>
					@endforeach
				</table>


				<div class="page_nav">
					<div>
						<a class="first" href="/wysls/index.php/Admin/Tag/index/p/1.html">第一页</a>
						<a class="prev" href="/wysls/index.php/Admin/Tag/index/p/7.html">上一页</a>
						<a class="num" href="/wysls/index.php/Admin/Tag/index/p/6.html">6</a>
						<a class="num" href="/wysls/index.php/Admin/Tag/index/p/7.html">7</a>
						<span class="current">8</span>
						<a class="num" href="/wysls/index.php/Admin/Tag/index/p/9.html">9</a>
						<a class="num" href="/wysls/index.php/Admin/Tag/index/p/10.html">10</a>
						<a class="next" href="/wysls/index.php/Admin/Tag/index/p/9.html">下一页</a>
						<a class="end" href="/wysls/index.php/Admin/Tag/index/p/11.html">最后一页</a>
						<span class="rows">11 条记录</span>
					</div>
				</div>



				<div class="page_list">
					<ul>
						<li class="disabled"><a href="#">&laquo;</a></li>
						<li class="active"><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li><a href="#">&raquo;</a></li>
					</ul>
				</div>
			</div>
		</div>
	</form>
	<!--搜索结果页面 列表 结束-->

	<script>

		function changeOrder(obj, conf_id)
		{
			var conf_order = $(obj).val();
			$.post("{{ url('admin/config/changeOrder') }}", {'_token':'{{ csrf_token() }}','conf_id':conf_id,'conf_order':conf_order}, function(data){

				if(data.status == 1)
				{
					layer.msg(data.msg, {'icon': '6'});
				}
				else
				{
					layer.msg(data.msg, {'icon': '8'});
				}

			})
		}

		function delConf(conf_id)
		{
			layer.confirm('确定删除吗',{
				btn:['确定','取消']
			}, function(){
				$.post("{{ url('admin/config/') }}/"+conf_id,{'_method':'delete','_token':"{{ csrf_token() }}"}, function(data){
					if(data.status == 1)
					{
						location.href = location.href;
						layer.msg(data.msg, {'icon': '6'});
					}
					else
					{
						layer.msg(data.msg, {'icon': '8'});
					}
				});
			})
		}
	</script>

@endsection