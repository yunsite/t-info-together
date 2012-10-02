<div class="user_main">

	<table>
		<{foreach from=$DairyList item=list}>
		<tr>
			<td><{$list.dry_stitle}></td>
			<td>
				<select name="sortprivate">
					<option value="0" <{$list.sortprivate0}>>所有人可见</option>
					<option value="1" <{$list.sortprivate1}>>仅好友可见</option>
					<option value="2" <{$list.sortprivate2}>>仅自己可见</option>
				</select>
			</td>
			<td>
				<select name="sortifcomm">
					<option value="0" <{$list.sortifcomm0}>>允许评论</option>
					<option value="1" <{$list.sortifcomm1}>>禁止评论</option>
				</select>
			</td>
			<td><a href="index.php?u=dairy&s=modi&sid=<{$list.dry_sid}>">修改</a></td>
			<td><a href="index.php?u=dairy&s=del&sid=<{$list.dry_sid}>">删除</a></td>
		</tr>
		<{/foreach}>
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
		<!-- 允许评论设置 -->
		<select name="new_sort_ifcomm">
			<option value="0">允许评论</option>
			<option value="1">禁止评论</option>
		</select>
		<!-- End(允许评论设置) -->
		<input name="new_sort" type="button" value="添加分类"/>
	</p>
	</form>

</div>