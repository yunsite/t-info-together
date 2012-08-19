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
		

	}elseif( isset($_GET['c']) ){	//访问单独耦合性小的模块
	

			//
			switch( $_GET['c'] ){
			
				//包含,调用相应的用户中心下的相应控制器
				
				//控制器模块列表
				case "controllerlist":
					include_once("controllers/controlistController.php");
				break;

				//关于我们
				case "aboutus":
					include_once("controllers/UserCenter/DairyController.php");
				break;

				//加入我们
				case "joinus":
					include_once("controllers/UserCenter/DairyController.php");
				break;

				//实习生
				case "trainee":
					include_once("controllers/UserCenter/DairyController.php");
				break;

				//招聘
				case "inviteus":
					include_once("controllers/UserCenter/DairyController.php");
				break;

				//您的建议
				case "advise":
					include_once("controllers/UserCenter/DairyController.php");
				break;

				//您的想法
				case "idea":
					include_once("controllers/UserCenter/DairyController.php");
				break;


				
			}

		}elseif( isset($_GET['u']) ){	//登陆个人中心
	
		//根据Cookie检测用户是否已经登陆
		//检测Cookie: 暂时先检测有无Username,若无则表示没有登陆,否则表示已登陆

		//没登陆则跳转到 登陆Controller视图
		if( !isset( $_COOKIE['user_id'] ) ){
		
			//跳转到首页(暂时先为跳转到首页,因为登陆单独界面的Action之前的想法没有放出来使用)
			header("Location: index.php");

		}

		
		//检测是否选择了某个模块
		if( $_GET['u'] ){
				
			//根据switch匹配模块,来包含 用户中心 下的某个模块
			switch( $_GET['u'] ){
			
				//包含,调用相应的用户中心下的相应控制器
				
				//包含个人中心显示主界面的Action
				case "index":
					include_once("controllers/UserCenter/UserIndexController.php");
				break;

				//包含日志控制器
				case "dairy":
					include_once("controllers/UserCenter/DairyController.php");
				break;
				
			}
			
		}

		//echo "test";
		//echo "test";
	
	}else{	//其他情况
	
		//如果已登陆,则跳转到个人中心模块选择页
		if( isset( $_COOKIE['user_id'] ) ){
		
			//跳转到模块选择页面
			header("Location: index.php?u=index");

		}else{
		
			//包含 入口控制器
			include_once("controllers/IndexController.php");
		
		}
		

	}

	


?>