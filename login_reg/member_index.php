<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员主页面</title>
</head>
<div align="center"><font face="楷书" size="+3">已注册人员信息</font></div></p>
<body>
<?php
session_start();
if(empty($_SESSION['pass'])){
	echo "你无权访问本站，你可以选择<a href='login.html'>登录</a>或<a href='register.php'>注册</a>。";
	exit;
	}
?>
<div align='center'><a href='session_destroy.php'>注销本次登录</a></div>
<?php
if($_SESSION['pass']=="ok")                 
{
echo "<div align='right'><a href='modify.php'>修改个人信息</a></div></br>";
require_once ('inc.php');
$link=getDBLink();
$sql="select * from member";
$result=mysql_query($sql);
$total=mysql_num_rows($result);
echo "<center>共有".$total."个会员</center><br>";
$page=isset($_GET['page'])?intval($_GET['page']):1;  
$info_num=3; 
$pagenum=ceil($total/$info_num); 
If($page>$pagenum || $page == 0){
       Echo "Error : Can Not Found The page .";
       Exit;
}
$offset=($page-1)*$info_num; 
$info=mysql_query("select * from member limit $offset,$info_num"); 
while($it=mysql_fetch_array($info)){
       Echo "账号：  ".HTMLSpecialChars($it['member_account'])."<br>";   //防sql注入
	   Echo "姓名：  ".HTMLSpecialChars($it['member_name'])."<br>";
	   Echo "性别：  ".HTMLSpecialChars($it['sex'])."<br>";
	   Echo "学号：  ".HTMLSpecialChars($it['schoolnumber'])."<br>";
	   Echo "手机号码：".HTMLSpecialChars($it['phonenumber'])."<br>";
	   Echo "电子邮箱：".HTMLSpecialChars($it['email'])."<hr>";
}  
if( $page > 1 )
    {
    	echo "<a href='member_index.php?page=".($page-1)."'>前一页</a>&nbsp";
	}else{
   	echo "前一页&nbsp&nbsp";
}
for($i=1;$i<=$pagenum;$i++){                                          //数字页面
       $show=($i!=$page)?"<a href='member_index.php?page=".$i."'>".$i."</a>":"$i";
       Echo $show." ";
}
if( $page<$pagenum)
    {
    	echo "<a href='member_index.php?page=".($page+1)."'>后一页</a>";
	}else
	{
		echo "后一页";
     }
mysql_free_result($result);
mysql_close();
}
?>
</body>
</html>