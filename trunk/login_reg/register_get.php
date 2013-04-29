<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>提示</title>
</head>
<?php
if(empty($_GET['m_acct']))
echo "账号不能为空！<a href='register.php?m_name=".$_GET['m_name']."&m_sex=".$_GET['m_sex']."&m_snum=".$_GET['m_snum']."&m_pnum=".$_GET['m_pnum']."'>返回重新注册。</a></p>";
else if(empty($_GET['m_pw']))
echo "密码不能为空！<a href='register.php?m_acct=".$_GET['m_acct']."&m_name=".$_GET['m_name']."&m_sex=".$_GET['m_sex']."&m_snum=".$_GET['m_snum']."&m_pnum=".$_GET['m_pnum']."&m_email=".$_GET['m_email']."'>返回重新注册。</a></p>";
else if($_GET['m_pw']!=$_GET['pass'])
echo "两次输入的密码不一样，<a href='register.php?m_acct=".$_GET['m_acct']."&m_name=".$_GET['m_name']."&m_sex=".$_GET['m_sex']."&m_snum=".$_GET['m_snum']."&m_pnum=".$_GET['m_pnum']."'>返回重新注册。</p>";
else if(empty($_GET['m_sex']))
echo "未输入性别，<a href='register.php?m_acct=".$_GET['m_acct']."&m_name=".$_GET['m_name']."&m_snum=".$_GET['m_snum']."&m_pnum=".$_GET['m_pnum']."'>返回重新注册。</a></p>";
else if(!empty($_GET['m_snum'])&&!is_numeric($_GET['m_snum']))
echo "学号必须全为数字，<a href='register.php?m_acct=".$_GET['m_acct']."&m_name=".$_GET['m_name']."&m_sex=".$_GET['m_sex']."&m_pnum=".$_GET['m_pnum']."'>返回重新注册。</a></p>";
else if(!empty($_GET['m_pnum'])&&!is_numeric($_GET['m_pnum']))
echo "手机号码必须全为数字，<a href='register.php?m_acct=".$_GET['m_acct']."&m_name=".$_GET['m_name']."&m_sex=".$_GET['m_sex']."&m_snum=".$_GET['m_snum']."'>返回重新注册。</a></p>";
else if(!empty($_GET['m_email'])&&!ereg("([0-9a-zA-Z]+)([@])([0-9a-zA-Z]+)(.)([0-9a-zA-Z]+)",$_GET['m_email']))
echo "邮箱输入不合法！<a href='register.php?m_acct=".$_GET['m_acct']."&m_name=".$_GET['m_name']."&m_sex=".$_GET['m_sex']."&m_snum=".$_GET['m_snum']."&m_pnum=".$_GET['m_pnum']."'>返回重新注册。</a></p>";
else
{
require_once ('inc.php');
$_SESSION['pass']="ok";
$_SESSION['member']=$_GET['m_acct'];
$link = getDBLink();
$sql="insert into member values('".$_GET['m_acct']."','".md5($_GET['m_pw'])."','".$_GET['m_name']."','".$_GET['m_sex']."','".$_GET['m_snum']."','".$_GET['m_pnum']."','".$_GET['m_email']."')";
$result=mysql_query($sql)or die(mysql_error());
if($result>0)
echo "".$_GET['m_name'].",恭喜你注册成功,<a href='member_index.php'>马上进入主页面...</p>";
else
{
	$_SESSION['pass']="no pass";
	echo "注册失败！<a href-'register.php'>重新注册。</a></p>";
	mysql_close();
}
}
?>
<body>
</body>
</html>