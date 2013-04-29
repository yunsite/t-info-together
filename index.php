<?php
	/*
	*	Description:	系统入口文件
	*
	*
	*/

	//包含 系统初始化 处理文件
	include_once("global.php");

	//print_r($_COOKIE);	//有AJSTAT_ok_times的Cookie字段
	
	/*
	echo date( "Y/m/d G:i:s", "1352264717" );	//2012/11/07 5:05:17(现在时间为2012年11月7日 23:03:24)
	echo "<br/>";
	echo date( "Y/m/d G:i:s", "1352300488" );	//2012/11/07 15:01:28 (现在时间为2012年11月7日 23:03:33)
	*/
	
	//包含 框架访问请求路由器 处理文件
	include_once($sys_dir."RequestRouter.php");

?>