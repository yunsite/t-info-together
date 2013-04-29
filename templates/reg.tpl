<html>
	<head>
		<title>注册—<{$title}></title>
		<meta name="keywords" content="<{$keywords}>" />
		<meta name="description" content="<{$description}>" />
		<meta http-equiv="Content-Type" content="text/html; charset=<{$charset}>"/>
	</head>
	<body>

		<!-- 注册框 -->
		<form action="index.php?reg=1" method="post">
		<table>
			<tr></tr>
			<tr>
				<td>用户名:</td>
				<td><input type="text" name="username"/></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><input type="text" name="email"/></td>
			</tr>
			<tr>
				<td>密码:</td>
				<td><input type="password" name="password"/></td>
			</tr>
			<tr>
				<td>重复密码:</td>
				<td><input type="password" name="re_password"/></td>
			</tr>
			<tr>
				<td><input type="submit" value="提交"/></td>
			</tr>
		</table>
		</form>
		<!-- End(注册框) -->
		
		<!-- 错误信息 -->
		<div class="error_info">
			<span style="color:red;"><{$error_info}></span>
		</div>
		<!-- End(错误信息) -->
	</body>
</html>