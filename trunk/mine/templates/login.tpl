<html>
	<head>
		<title>��½��<{$title}></title>
		<meta name="keywords" content="<{$keywords}>" />
		<meta name="description" content="<{$description}>" />
		<meta http-equiv="Content-Type" content="text/html; charset=<{$charset}>"/>
	</head>



	<body>

		<!-- ��½�� -->
		<form action="index.php?logio=1" method="post">
		<table>
			<tr></tr>
			<tr>
				<td>�û���:</td>
				<td><input type="text" name="username"/></td>
			</tr>
			<tr>
				<td>����:</td>
				<td><input type="password" name="password"/></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="rem_me" value="1"/>��ס��</td>
				<td><a href="#">��������</a></td>
			</tr>
			<tr>
				<td><input type="submit" value="��½"/></td>
				<td><a href="index.php?reg=0">ע��</a></td>
			</tr>
		</table>
		</form>
		<!-- End(��½��) -->

		<div class="footer">
			<span><a href="#">ICP:<{$icp_num}></a></span>
			<span><a href="#">��ͷ���</a></span>
			<span><a href="#">������ʵϰ��</a></span>
			<span><a href="#">��������</a></span>
		</div>
	</body>

</html>