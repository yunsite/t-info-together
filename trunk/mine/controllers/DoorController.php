<?php
	/*
	*	Description:	登陆,登出控制器
	*
	*
	*/

	class DoorController{


		//把 $_GET和$_POST数组 作为构造函数的参数,供构造函数处理
		function __construct( $arg_get = '', $arg_post = '' ){
		
			// 登陆&登出
			if( @$arg_get["logio"] == 1 ){	//登陆系统
			
				//调用 登陆系统控制器
				$this->login_sys( $arg_post );
			
			}elseif( @$arg_get["logio"] == 0 ){	//登出系统
			
				//调用 登出系统控制器
				$this->logout_sys();

			}
			
			//注册用户
			if( $arg_get["reg"] == 1 ){	//注册用户
			
				//包含 用户基本处理模型
				include_once("models/UserBase.php");

				//调用 注册用户控制器
				$this->reg_user( $arg_post );
			
			}elseif( $arg_get["reg"] == 0 ){	//注册用户界面
			
				//调用 输出注册用户界面控制器
				$this->reg_user_view();

			}

		}

		/*	()
		*	@Description:	登陆系统

			@param	$UserInfo	$_POST方式传递过来的用户信息
		*
		*
		*/
		private function login_sys( $UserInfo ){
		
			//1.过滤函数(过滤用户输入)[安全]
			//2.根据用户名,判断用户是否存在 -> 进而判断密码是否正确
			//3.整合验证码类
			//4.观察 好乐买,人人,126,weibo,pw,dz,csdn 等网站 退出浏览器 及 保持登陆 的处理行为 -> Cookie加密后保存登陆状态?
			//5.
		
			//包含UserBase.php(model)
			include_once("models/UserBase.php");

			//print_r( $UserInfo );


		}

		/*	()
		*	@Description:	登出系统

			@param	none
		*
		*
		*/
		private function logout_sys(){
		
			
		
		}


		/*	()
		*	@Description:	注册用户(界面)

			@param $error_info	错误信息	|	空
		*
		*
		*/
		private function reg_user_view( $error_info = '' ){
		
			//Smarty类对象在global.php实例化过
			global $tpl,$siteinfo_new,$sys_charset;
			
			$tpl->assign( "title",$siteinfo_new["site_name"] );
			$tpl->assign( "keywords",$siteinfo_new["site_keywords"] );
			$tpl->assign( "description",$siteinfo_new["site_description"] );
			$tpl->assign( "charset",$sys_charset );
			$tpl->assign( "error_info",$error_info );
			$tpl->display("reg.tpl");
		
		}


		/*	()
		*	@Description:	注册用户
			//1.检查用户名是否存在 -> 如果不存在,则添加用户并发送验证邮件
			//2.Apache->邮件服务器
			//3.验证成功后,跳转到登陆界面
			//4.
			@param	$RegInfo	注册信息
		*
		*
		*/
		private function reg_user( $RegInfo ){
	
			global $db_server, $db_name, $db_user, $db_pwd, $sys_charset;
			
			$UserBase = new UserBase( $db_server, $db_name, $db_user, $db_pwd, $sys_charset );

			//需要对 $RegInfo["username"], $RegInfo["email"]， $RegInfo["password"] 作过滤安全处理
			

			//查询是否有已存在的用户
			$UserInfo = $UserBase -> seli_user( "*", "mem_name = '".$RegInfo["username"]."'" );
			//print_r( $UserInfo );
			if( !empty( $UserInfo ) ){
			
				//调用 输出注册用户界面控制器
				$this->reg_user_view("Sorrry: 亲,已经存在用户了哦!");
				//die("Sorrry: 亲,已经存在用户了哦!");
				die();
			}

			//添加用户
			$UserBase -> add_user( $RegInfo["username"], $RegInfo["password"] ,$RegInfo["email"] );

			//构造邮件信息
			$subject = "您好,".$RegInfo["username"].",用户注册成功!";
			$body = "您好,".$RegInfo["username"].",您已经注册成功!<br/>请牢记您的密码: ".$RegInfo["password"]."!<br/>";
			$user_name = $RegInfo["username"];
			//向用户发送邮件
			send_mail( $RegInfo["email"], $subject, $body, $user_name )

			//调用 输出注册用户界面控制器
			//这里应该跳转到用户中心或登陆页面
			$this->reg_user_view("亲,您成功注册了哦!");
			/*
			echo $RegInfo["username"];
			echo "<br/>";

			echo $RegInfo["email"];
			echo "<br/>";

			echo $RegInfo["password"];
			echo "<br/>";
			*/
		
		}

		/*	()
		*	@Description:	找回密码

			@param	none
		*
		*
		*/
		//1.向验证邮箱里发送密码重置链接
		//2.发送邮件类
		//3.验证电子邮件格式函数(正则表达式函数) -> 放到security.php文件里
		//4.

	}


	//实例化 LogioController控制器
	$SiteIndex = new DoorController( $_GET, $_POST );
?>