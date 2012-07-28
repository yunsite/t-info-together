<?php
	/*
	*	Description:	全局文件，在所有部分都会包含，做一些初始化操作
	*
	*
	*/

	//包含	数据库操作基类
	include_once("includes/db_class.php");

	//包含	系统配置文件
	include_once("config.php");

	//检测程序是否已安装,没有安装的话,则跳转到安装文件
	if( !file_exists("install.lock") )
		header("Location: ../install/index.php");


	/*
	*	Description:	设置错误报告级别(显示错误情况)
	*	Note:	在开发的时候启动严格模式，发现错误，写出更优质的代码
	*
	*
	*/
	error_reporting(E_ALL | E_STRICT);
	if( !ini_get('display_errors') ){
		ini_set('display_errors',1);
	}

	/*
	*	Description:	检测是否开启register_long_array
	*	Note:	为了性能考虑，建议关闭register_long_array
	*
	*/
	if( ini_get('register_long_arrays') ){
		$register_long_arrays = 1;
	}


	//安全处理文件
	include_once("security.php");

	//数据库处理文件类
	include_once("db_config.php");

	//检测当前脚本
?>