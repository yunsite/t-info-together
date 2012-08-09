<html>
	<head>
		<title><{$title}></title>
		<meta name="keywords" content="<{$keywords}>" />
		<meta name="description" content="<{$description}>" />
		<meta http-equiv="Content-Type" content="text/html; charset=<{$charset}>"/>
	</head>



	<body>

		<!-- 登陆框 -->
		<form action="index.php?logio=1" method="post">
		<table>
			<tr></tr>
			<tr>
				<td>用户名:</td>
				<td><input type="text" name="username"/></td>
			</tr>
			<tr>
				<td>密码:</td>
				<td><input type="password" name="password"/></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="rem_me" value="1"/>记住我</td>
				<td><a href="#">忘记密码</a></td>
			</tr>
			<tr>
				<td><input type="submit" value="登陆"/></td>
				<td><a href="#">注册</a></td>
			</tr>
		</table>
		</form>
		<!-- End(登陆框) -->

		<div class="footer">
			<span>ICP:</span><{$icp_num}>
		</div>
	</body>

</html>