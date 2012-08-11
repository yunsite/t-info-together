<?php

	/*
	*	Description:	系统配置文件
	*
	*
	*/
	
	//系统版本号
	$sys_version = '';
	
	//系统编码
	$sys_charset = 'utf8';

	//数据库连接地址
	$db_server = '127.0.0.1';

	//数据库名
	$db_name = 't_info_together';

	//数据库用户名
	$db_user = 'root';


	//数据库密码
	$db_pwd = '';

	//Cookie加密密钥
	$Cookie_pwd = '';

	//Smarty模板配置变量

	//Smarty配置,暂时先不用绝对路径情况,而只针对index.php入口文件写下配置
	/*
	//模板目录
	$sys_template_dir = "/templates/";
	//模板编译目录
	$sys_compile_dir = "/data/templates_c/";
	//特殊配置文件目录
	$sys_config_dir = "";
	//缓存目录
	$sys_cache_dir = "/data/cache/";
	//是否允许缓存
	$sys_caching = 0;
	//替换变量左边界符
	$sys_left_delimiter = "<{";
	//替换变量右边界符
	$sys_right_delimiter = "}>";
	*/
	$sys_template_dir = "templates/";

	$sys_compile_dir = "data/templates_c/";

	$sys_config_dir = "";

	$sys_cache_dir = "data/cache/";

	$sys_caching = 0;

	$sys_left_delimiter = "<{";

	$sys_right_delimiter = "}>";




	//邮件服务器配置

	//邮件服务器地址
	$smtp_host = "smtp.qq.com";

	//SMTP认证用户
	$smtp_username = "";

	//SMTP认证用户密码
	$smtp_pwd = "";

	//发件人邮箱
	$mail_from = "";

	//发件人姓名
	$mail_from_name = "T_Info_Together";

	//邮件字符集
	$mail_charset = "GB2312";

	//邮件Encoding(暂为base64,至于为什么是它,我也不太清楚,稍后查一下)
	$mail_encoding = "base64";


?>