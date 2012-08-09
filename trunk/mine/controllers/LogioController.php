<?php
	/*
	*	Description:	登陆,登出控制器
	*
	*
	*/

	class LogioController{

	//包含UserBase.php(model)
	include_once("../models/UserBase.php");

		//把 $_GET和$_POST数组 作为构造函数的参数,供构造函数处理
		function __construct( $arg_get = '', $arg_post = '' ){
		
			

		}

	/*	()
	*	@Description:	登陆系统

		@param	none
	*
	*
	*/
	private function login_sys(){
	
		//1.过滤函数(过滤用户输入)[安全]
		//2.根据用户名,判断用户是否存在 -> 进而判断密码是否正确
		//3.整合验证码类
		//4.观察 好乐买,人人,126,weibo,pw,dz,csdn 等网站 退出浏览器 及 保持登陆 的处理行为 -> Cookie加密后保存登陆状态?     
		//5.
	
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

		@param	none
	*
	*
	*/
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


?>