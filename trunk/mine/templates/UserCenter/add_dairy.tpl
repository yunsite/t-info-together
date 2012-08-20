<div class="user_main">

	<!-- Ueditor相关包含文件 -->
	<script type="text/javascript" src="<{$sys_dir_base}>/includes/ueditor/editor_config.js"></script>
	<script type="text/javascript" src="<{$sys_dir_base}>/includes/ueditor/editor_all.js"></script>
	<link rel="stylesheet" href="<{$sys_dir_base}>/includes/ueditor/themes/default/ueditor.css">
	<!-- End(Ueditor相关包含文件) -->
	
	<!-- Ueditor显示 -->
	<form action="index.php?u=dairy" method="post">
		<script type="text/plain" id="myContent" name="myContent"></script>
		<input type="submit" value="发布"/>
	</form>
	<script type="text/javascript">
	    var editor = new baidu.editor.ui.Editor();
	    editor.render("myContent");
	</script>
	<!-- End(Ueditor显示) -->
</div>