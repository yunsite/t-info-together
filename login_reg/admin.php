<!--http认证-->
<meta content="text/html; charset=utf-8" />
<title>管理</title>
<?php
  if (empty($_SERVER['PHP_AUTH_USER'])) {
    header("Content-type: text/html; charset=utf8");
    header('WWW-Authenticate: Basic realm=" Authentication "');
    header('HTTP/1.0 401 Unauthorized');
    echo '请输入正确的账号及密码, 不可以取消!';
    exit;
  } else {

    $correctName="admin";
    $correctpwd="tengfei" ;
     if (($_SERVER['PHP_AUTH_USER'] != $correctName) or 
            ($_SERVER['PHP_AUTH_PW'] !=$correctpwd)){
        echo "登录失败, 请打开新的浏览器重新登录";
     }else{
	 echo "登录成功.....<br>";
	 require_once ('inc.php');
	$link=getDBLink();
	$sql="select * from member";
	$result=mysql_query($sql);
	$total=mysql_num_rows($result);
	echo "共有".$total."个会员，请对会员信息进行管理<hr>";
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
       Echo "账号：  ".HTMLSpecialChars($it['member_account'])."<br>";
	   Echo "姓名：  ".HTMLSpecialChars($it['member_name'])."<br>";
	   Echo "性别：  ".HTMLSpecialChars($it['sex'])."<br>";
	   Echo "学号：  ".HTMLSpecialChars($it['schoolnumber'])."<br>";
	   Echo "手机号码：".HTMLSpecialChars($it['phonenumber'])."<br>";
	   Echo "电子邮箱：".HTMLSpecialChars($it['email'])."<br>";
	   echo "<a href='admin_modify.php?member=".$it['member_account']."'>修改</a>&nbsp&nbsp";      
	   echo "<a href='admin_delete.php?member=".$it['member_account']."'>删除</a><hr>"; 
	}  
	if( $page > 1 )
    {
    	echo "<a href='admin.php?page=".($page-1)."'>前一页</a>&nbsp";
	}else{
   	echo "前一页&nbsp&nbsp";
	}
	for($i=1;$i<=$pagenum;$i++){                                          //数字页面
       $show=($i!=$page)?"<a href='admin.php?page=".$i."'>".$i."</a>":"$i";
       Echo $show." ";
	}
	if( $page<$pagenum)
    {
    	echo "<a href='admin.php?page=".($page+1)."'>后一页</a>";
	}else
	{
		echo "后一页";
     }
	mysql_free_result($result);
	mysql_close();
     }
  }
?>