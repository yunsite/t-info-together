<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改会员信息</title>
</head>
<body>
<?php
if(empty($_GET['member'])){
	echo "你没有管理权限。";
	exit;
	}
$member=$_GET['member']; 
require_once ('inc.php');
$link=getDBLink();
$sql="select * from member where member_account='".$member."'";
$result=mysql_query($sql);
if(!$rs=mysql_fetch_object($result)){
echo "错误";
exit;
}
$_SESSION['admin']=$member;
?>
<div align="center"><font size="+3" color="#333333">修改会员<? echo $member; ?>的信息</font></div></p>
<form method="post" action="admin_modify_post.php"><center><table width="516" height="314" border="1">
  <tr>
    <td width="146" align="left">账号：</td>
    <td width="354"><? echo $rs->member_account;?></td>
  </tr>
  <tr>
    <td align="left">姓名:</td>
    <td><input name="new_member_name" type="text" id="new_member_name" maxlength="20" value="<? echo $rs->member_name;?>"/></td>
  </tr>
  <tr>
    <td align="left">性别：</td>
    <td><? echo $rs->sex;?></td>
  </tr>
  <tr>
    <td align="left">学号：</td>
    <td><input name="new_schoolnumber" type="text" id="new_schoolnumber" value="<? echo $rs->schoolnumber;?>" maxlength="20"/></td>
  </tr>
  <tr>
    <td align="left">手机号：</td>
    <td><input name="new_phonenumber" type="text" id="new_phonenumber" value="<? echo $rs->phonenumber;?>" maxlength="20"/></td>
  </tr>
  <tr>
    <td align="left">电子邮箱：</td>
    <td><input name="new_email" type="text" id="new_email" value="<? echo $rs->email;?>" maxlength="30"/></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="reset" name="button" id="button" value="重置" />
      <input type="submit" name="button2" id="button2" value="提交" /></td>
    </tr>
</table>
</center></form>
</body>
</html>