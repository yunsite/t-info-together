<?php
	/*
	*	Description:	全局文件，在所有部分都会包含，做一些初始化操作
	*
	*
	*/

	//包含	系统配置文件
	@include_once( "config.php" );
	//针对 controllers/UserCenter/UserIndexController.php 做的包含处理
	@include_once( "../../config.php" );

	//包含	函数库
	include_once( $sys_dir."includes/function.php" );

	//脚本开始执行时间
	//Description:用于计算每次请求页面,所消耗的时间——需要在输出模板前在Action里再调用一次,设置$End_time,然后把 ($Used_time = $End_time - $Start_time) 输出到模板
	$Start_time = microtime_float();

	

	//包含	数据库操作基类
	include_once( $sys_dir."includes/db_class.php" );

	//包含	安全处理文件
	include_once( $sys_dir."includes/security.php" );

	
	
	//包含	Smarty类文件
	include_once( $sys_dir."includes/Smarty/libs/Smarty.class.php" );
	
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
	if( !file_exists($sys_dir."install/install.lock") )
		header("Location: ".$sys_dir."install/index.php");


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



	//获取系统基本信息

	//判断缓存是否存在,而读取缓存
	if( file_exists($sys_dir."data/cache/SiteInfo.cache") ){
				
		//echo "缓存文件存在!";
		//echo "<br/>";

		$siteinfo_new =  read_cache($sys_dir."data/cache/SiteInfo.cache");
		//print_r($siteinfo_new);

		//读取缓存文件相关信息;

		//赋值所需要的变量;

		//$sys_title = ;

		//$sys_keywords = ;

		//$sys_description = ;

	}else{
			
		//声明变量为全局变量
		//global $db_server, $db_name, $db_user, $db_pwd, $sys_charset;

		//创建数据库对象(在需要的时候才创建,而不是系统一初始化就创建,因为系统有缓存机制,如果没特殊操作,如系统后台更新了缓存,则使用缓存)
		//似乎在后面直接声明它的子类对象就行了,不清楚的是,子类对象创建的时候会不会调用父类对象的构造函数(db_class会自动连接数据库),记得好像是会
		//$db_base = new db_class( $db_server, $db_name, $db_user, $db_pwd, $sys_charset );
				
		//print_r( $db_base );

		//包含 model,在这里检测包含处理用到的model
		//@include_once("../models/SiteInfo.php");
		include_once($sys_dir."models/SiteInfo.php");

		/*if( 是直接访问 ){
				
			include_once("../models/SiteInfo.php");

		}else{//通过index.php入口文件访问
				
			include_once("models/SiteInfo.php");

		}
		*/

		$db_base = new SiteInfo( $db_server, $db_name, $db_user, $db_pwd, $sys_charset );

		//print_r( $db_base );

		//查询站点基本信息
		$siteinfo = $db_base -> si_select( '*' ,'' );

		//print_r( $siteinfo );
				
		//遍历赋值 站点信息
		foreach( $siteinfo as $key => $value ){
				
			switch( $value["conf_name"] ){
						
				//系统名
				case "site_name": $siteinfo_new["site_name"] = $value["conf_value"];
				break;

				//关键字
				case "site_keywords": $siteinfo_new["site_keywords"] = $value["conf_value"];
				break;

				//站点描述
				case "site_description": $siteinfo_new["site_description"] = $value["conf_value"];
				break;
				
				//站点是否关闭
				case "if_close": $siteinfo_new["if_close"] = $value["conf_value"];
				break;
				
				//关闭原因
				case "close_reason": $siteinfo_new["close_reason"] = $value["conf_value"];
				break;
					
			}
				
		}
				
		//echo $sys_description;

		/*
		//整合站点信息为数组,便于缓存和模板输出
		$siteinfo_new["site_name"] = $sys_title;
		$siteinfo_new["site_keywords"] = $sys_keywords;
		$siteinfo_new["site_description"] = $sys_description;
		*/

				

		/*
		$

		//写缓存操作(如果缓存机制开启的话)
		if( 开启缓存机制 ){
				
			写缓存操作;

		}
		*/
		//这里暂未考虑缓存机制开启选项(需要修改缓存的内容——缓存指定的信息)
		write_cache( $sys_dir.'data/cache/SiteInfo.cache', $siteinfo_new );
	}

	
	//输出 系统基本模板变量
	$tpl->assign( "title",$siteinfo_new["site_name"] );
	$tpl->assign( "keywords",$siteinfo_new["site_keywords"] );
	$tpl->assign( "description",$siteinfo_new["site_description"] );
	$tpl->assign( "charset",$sys_charset );

	//检测系统是否关闭

	//判断 如果站点设置为:关闭,则关闭系统,只允许管理员进入系统
	if( $siteinfo_new["if_close"] == 1 ){
	
		//跳转到相应的控制器 —— 显示关闭原因 + 登陆框
	
	}

?>