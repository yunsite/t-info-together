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
	if( isset($_GET['logio']) ){	//登陆,退出
	
		include_once("controllers/LogioController.php");
	
	}

	//包含 入口控制器
	include_once("controllers/IndexController.php");


?>