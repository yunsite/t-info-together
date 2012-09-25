<div class="user_main">

	<!-- 日志页头 -->
		<h4><img align="absmiddle" src="<{$sys_dir_base}>templates/images/diary.png"><span>日志</span></h4>
	<!-- End(日志页头) -->

	<!-- Ueditor相关包含文件 -->
	<script type="text/javascript" src="<{$sys_dir_base}>/includes/ueditor/editor_config.js"></script>
	<script type="text/javascript" src="<{$sys_dir_base}>/includes/ueditor/editor_all.js"></script>
	<link rel="stylesheet" href="<{$sys_dir_base}>/includes/ueditor/themes/default/ueditor.css">
	<!-- End(Ueditor相关包含文件) -->
	
	<!-- 日志提交表单 -->
		
		<form action="index.php?u=dairy" method="post">
		
			<!-- 日志标题 -->
			<div class="dry_title">
				<input type="text" name="dry_title"><span style="font-size:12px;">&nbsp;&nbsp;限 80 字节</span>
			</div>
			<!-- End(日志标题) -->
			
			<!-- 日志内容_Ueditor显示 -->
			<script type="text/plain" id="myContent" name="myDairy"></script>
			<script type="text/javascript">
			    var editor = new baidu.editor.ui.Editor();
			    editor.render("myContent");
			</script>
			<!-- End(日志内容_Ueditor显示) -->
			
			<!-- 日志设置项 -->
			<table width="100%" cellspacing="0" cellpadding="0">
				<tbody>
					<!-- 日志分类 -->
					<tr>
						<td width="99">日志分类</td>
						<td>
							<!-- 日志分类 -->
							<span>
								<select name="dry_sid">
									<option value="0">默认分类</option>
									<{foreach from=$dairy_sort item=sort}>
										<option value="<{$sort.dry_sid}>"><{$sort.dry_stitle}></option>
									<{/foreach}>
								</select>
							</span>
							<!-- End(日志分类) -->

							<!-- 添加分类_按钮 -->
							<span><a href="#">添加分类</a></span>
							<!-- End(添加分类_按钮) -->

						</td>
					</tr>
					<!-- End(日志分类) -->

					<!-- 设置 -->
					<tr>
					    <td>隐私设置</td>
					    <td>

						<!-- 日志隐私设置 -->
						<select name="dry_private">
							<option value="0">全站可见</option>
							<option value="1">仅好友可见</option>
							<option value="2">仅自己可见</option>
						</select>
						<!-- End(日志隐私设置) -->
						
						<!-- 是否允许评论 -->
						<label for="dry_ifcomm">
							<input type="checkbox" checked="checked" value="1" name="dry_ifcomm" id="dry_ifcomm">&nbsp;允许评论
						</label>
						<!-- End(是否允许评论) -->
					       
					    </td>
					</tr>
					<!-- End(设置) -->
				</tbody>
			</table>
			<!-- End(日志设置项) -->

			<!-- 提交发布 -->
			<input type="submit" name="add_dairy" value="发布"/>
			<!-- End(提交发布) -->

		</form>
		
		
	<!-- End(日志提交表单) -->
</div>