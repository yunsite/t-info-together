<?php
	/*
	*	Description:	全局文件，在所有部分都会包含，做一些初始化操作
	*
	*
	*/


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