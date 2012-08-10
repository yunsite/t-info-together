<?php
	/*
	*	Description:	登陆,登出控制器
	*
	*
	*/

	class LogioController{


		//把 $_GET和$_POST数组 作为构造函数的参数,供构造函数处理
		function __construct( $arg_get = '', $arg_post = '' ){
		
			if( $arg_get["logio"] == 1 ){	//登陆系统
			
				//调用 登陆系统控制器
				$this->login_sys( $arg_post );
			
			}elseif( $arg_get["logio"] == 0 ){	//登出系统
			
				//调用 登出系统控制器
				$this->logout_sys();

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
		*	@Description:	注册用户

			@param	$RegInfo	注册信息
		*
		*
		*/
		private function reg_user( $RegInfo ){
		
			//获取当前时间戳
			$regtime = time();

			//最后一次登陆IP,因为是注册,所以取当前IP
			$llogip = getIp();
			
			//需要对 $RegInfo["username"], $RegInfo["email"]， $RegInfo["password"] 作过滤安全处理

			$RegInfo["username"];
			$RegInfo["email"];
			$RegInfo["password"];
		
		}

		//1.检查用户名是否存在 -> 如果不存在,则添加用户并发送验证邮件
		//2.Apache->邮件服务器
		//3.验证成功后,跳转到登陆界面
		//4.

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
	$SiteIndex = new LogioController( $_GET, $_POST );
?>