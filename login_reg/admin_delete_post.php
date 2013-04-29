<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>删除成功</title>
</head>

<body>
<?php
require_once('inc.php');
if(empty($_SESSION['admin'])){
	echo "你没有管理权限。";
	exit;
	}
$link=getDBLink();
$sql="delete from member where member_account='".$_SESSION['admin']."'";
$result=mysql_query($sql);
if($result)
echo "删除会员".$_SESSION['admin']."信息成功<br>";
else echo "删除会员".$_SESSION['admin']."信息失败";
header("refresh:5;URL=admin.php");
echo "5秒后自动<a href=admin.php>返回管理界面</a>";
mysql_close();
session_destroy();
?>
</body>
</html>