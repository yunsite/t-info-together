<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改</title>
</head>
<?
require_once('inc.php');
if(empty($_SESSION['member']))
	header("Location:login.html");
$link=getDBLink();
$sql="update member set member_name='".$_POST['new_member_name']."' where member_account='".$_SESSION['member']."'";
$result=mysql_query($sql)or die("无法储存姓名");
$sql="update member set schoolnumber='".$_POST['new_schoolnumber']."' where member_account='".$_SESSION['member']."'";
$result=mysql_query($sql)or die("无法储存学号");
$sql="update member set phonenumber='".$_POST['new_phonenumber']."' where member_account='".$_SESSION['member']."'";
$result=mysql_query($sql)or die("无法储存手机号码");
$sql="update member set email='".$_POST['new_email']."' where member_account='".$_SESSION['member']."'";
$result=mysql_query($sql)or die("无法储存电子邮件");
$sql="select * from member where member_account='".$_SESSION['member']."'";
$result=mysql_query($sql);
if(!$rs=mysql_fetch_object($result))
	echo "错误,";
?>
<body>
<p><font size="+2">修改成功！以下是你更新后的信息 </font></p>
<table width="516" height="314" border="1">
  <tr>
    <td width="146" align="left">账号：</td>
    <td width="354"><? echo $rs->member_account;?></td>
  </tr>
  <tr>
    <td align="left">姓名:</td>
    <td><? echo $rs->member_name;?></td>
  </tr>
  <tr>
    <td align="left">性别：</td>
    <td><? echo $rs->sex;?></td>
  </tr>
  <tr>
    <td align="left">学号：</td>
    <td><? echo $rs->schoolnumber;?></td>
  </tr>
  <tr>
    <td align="left">手机号：</td>
    <td><? echo $rs->phonenumber;?></td>
  </tr>
  <tr>
    <td align="left">电子邮箱：</td>
    <td><? echo $rs->email;?></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><a href="modify.php">重新修改信息</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="member_index.php"> 进入主页面</a></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>