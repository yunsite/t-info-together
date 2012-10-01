<div class="user_main">

	<table>
		<tr>
			<td><{$sortname}></td>
			<td><{$sortprivate}>
			<select name="dry_sid">
				<option value="0">默认分类</option>
				<{foreach from=$dairy_sort item=sort}>
				<option value="<{$sort.dry_sid}>"><{$sort.dry_stitle}></option>
				<{/foreach}>
			</select>
			</td>
			<td><a href="index.php?u=dairy&s=modi&sid=<{$sid}>">修改</a></td>
			<td><a href="index.php?u=dairy&s=del&sid=<{$sid}>">删除</a></td>
		</tr>
	</table>

	<hr/>
	
	<form action="index.php?u=dairy&s=add" method="POST">
	<p>
		<input name="new_sort_name" type="text"/>
		<!-- 日志分类隐私设置 -->
		<select name="new_sort_private">
			<option value="0">全站可见</option>
			<option value="1">仅好友可见</option>
			<option value="2">仅自己可见</option>
			</select>
		<!-- End(日志分类隐私设置) -->
		<input name="new_sort" type="button"/>
	</p>
	</form>

</div>