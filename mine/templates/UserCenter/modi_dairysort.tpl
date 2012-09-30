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

	<p>
		<input name="new_sort_name" type="text"/>
		<select name="dry_sid">
				<option value="0">默认分类</option>
				<{foreach from=$dairy_sort item=sort}>
				<option value="<{$sort.dry_sid}>"><{$sort.dry_stitle}></option>
				<{/foreach}>
			</select>
		<input name="new_sort" type="button"/>
	</p>

</div>