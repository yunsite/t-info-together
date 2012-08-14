<?php
	/*
	*	Description:	系统入口文件
	*
	*
	*/

	//包含 系统初始化处理文件
	include_once("global.php");

	//可以在index.php,增加使用CI模式的url控制传递参数方式(通过检测get方式传递过来的参数)(该功能暂未加)


	//example.com/news/article/my_article

	//根据模型-视图-控制器模式，在此 URL 段一般以如下形式表示：
	//example.com/class/function/ID
	//第一段表示调用控制器类。
	//第二段表示调用类中的函数或方法。
	//第三及更多的段表示的是传递给控制器的参数，如 ID 或其它各种变量。

	//根据参数判断处理交由哪个控制器处理
	if( isset($_GET['logio']) || isset($_GET['reg']) ){	//登陆,退出
	
		include_once("controllers/DoorController.php");
		
		//在包含调用控制器后,结束脚本的执行
		die();
	}

	//登陆个人中心
	if( isset($_GET['u']) && $_GET['u']=='index' ){
	
		//根据Cookie检测用户是否已经登陆
		//检测Cookie: 暂时先检测有无Username,若无则表示没有登陆,否则表示已登陆
		//没登陆则跳转到登陆Controller

		/*

		//检测是否选择了某个模块
		if( isset($_GET['c']) ){
			
			//根据switch匹配模块,来包含 用户中心 下的某个模块
			switch( $_GET['c'] ){
			
				include_once("controllers/UserCenter/xxx.php");
			
			}

			die();

		
		}
		*/

		//包含个人中心显示主界面的Action
		include_once("controllers/UserCenter/UserIndexController.php");
	
	}

	//包含 入口控制器
	include_once("controllers/IndexController.php");


?>