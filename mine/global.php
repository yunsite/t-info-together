<?php
	/*
	*	Description:	全局文件，在所有部分都会包含，做一些初始化操作
	*
	*
	*/

	//包含	函数库
	include_once("includes/function.php");

	//脚本开始执行时间
	//Description:用于计算每次请求页面,所消耗的时间——需要在输出模板前在Action里再调用一次,设置$End_time,然后把 ($Used_time = $End_time - $Start_time) 输出到模板
	$Start_time = microtime_float();

	//包含	系统配置文件
	include_once("config.php");

	//包含	数据库操作基类
	include_once("includes/db_class.php");

	//包含	安全处理文件
	include_once("includes/security.php");

	
	
	//包含	Smarty类文件
	include_once("includes/Smarty/libs/Smarty.class.php");
	
	//Smarty模板配置
	$tpl = new Smarty();
	$tpl->template_dir = $sys_template_dir;
	$tpl->compile_dir = $sys_compile_dir;
	$tpl->config_dir = $sys_config_dir;
	$tpl->cache_dir = $sys_cache_dir;
	$tpl->caching = $sys_caching;
	$tpl->left_delimiter = $sys_left_delimiter;
	$tpl->right_delimiter = $sys_right_delimiter;

	//echo "test";
	//print_r( $tpl );
	

	//检测程序是否已安装,没有安装的话,则跳转到安装文件
	//这里为使项目跑起来,暂时假定从index.php文件包含global.php,把文件路劲暂时指定为"install/install.lock",但这里存在缺陷,需要更改
	if( !file_exists("install/install.lock") )
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


	//检测当前脚本
?>