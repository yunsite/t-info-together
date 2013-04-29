<div class="user_main">
	
	<!-- 日志列表 -->
	<div class="list">
		<table>
			<!-- 循环遍历tr(需要考虑分页) -->
			<tr>
				<td><{$dry_title}></td>
				<td><{$dry_lmoditime}></td>
				<td><a href="index.php?u=dairy&a=modi&did=<{$did}>">修改</a></td>
				<td><a href="index.php?u=dairy&a=del&did=<{$did}>">删除</a></td>
			</tr>
			<!-- End(循环遍历tr) -->
		</table>
	</div>
	<!-- End(日志列表) -->

	<!-- 分类列表 -->
	<div class="sort">
		<ul>
			<!-- 循环遍历li -->
			<li><a href="index.php?u=dairy&s=list&sid=<{$sid}>"><{$sort_name}></li>
			<!-- End(循环遍历li) -->
		</ul>
		<span>管理分类:</span><span><a href="index.php?u=dairy&s=modi"></a><span>
	</div>
	<!-- End(分类列表) -->

</div>