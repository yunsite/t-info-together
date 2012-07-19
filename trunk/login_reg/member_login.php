<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登陆检验</title>
</head>

<body>
<?php
require_once ('inc.php'); 
if(empty($_POST['name'])){
	echo "账号不能为空，5秒后自动返回登录界面";
	header("refresh:5; URL='login.html'");
	}

else if(empty($_POST['password'])){
	echo "密码不能为空，5秒后自动返回登录界面";
	header("refresh:5; URL='login.html'");
	}

else{
$link = getDBLink();
$name=$_POST['name'];
$pw=md5($_POST['password']);
$sql="select * from member where member_account='".$name."'"; 
$result=mysql_query($sql) or die("账号不正确");
$num=mysql_num_rows($result);
if($num==0){
	echo "账号不存在，5秒后自动返回登录界面";
	header("refresh:5; URL='login.html'");
	}
while($rs=mysql_fetch_object($result))
{
	if($rs->member_password!=$pw)
	{
		echo "密码不正确。<a href='login.html'>返回重新登录。</a>";
		mysql_close();
	}
	else 
	{
		$_SESSION['pass']="ok";
		$_SESSION['member']=$_POST['name'];
		header("Location:member_index.php");
		mysql_close();
	}
}
}
?>
</body>
</html>