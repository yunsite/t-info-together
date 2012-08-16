<?php
	/*
	*	Description:	个人中心入口控制器,显示个人中心主界面视图(处理基本初始网站信息显示)
	*
	*
	*/

	class UserIndexController{
	
		//功能模块名(作标题用)
		private $controller_name = "用户中心";

		//功能模块模板名(模版调用时用)
		private $tpl_file = "shuoshuo_main";
		

		//把 $_GET和$_POST数组 作为构造函数的参数,供构造函数处理
		function __construct( $arg_get = '', $arg_post = '' ){
		

			//print_r($tpl);

			//print_r($sys_charset);

			//print_r($arg_get);

			//print_r( $_COOKIE );

			//无参调用 IndexController控制器
			if( $arg_get['u'] == 'index' ){
			
				//调用默认Action方法(初始动作)显示首页
				$this->IndexAction();

				//交给默认控制器显示模板后,就不再需要显示其他Action方法的模板了,所以结束代码
				die();

			}
			

			//下面被注释掉的if...else...语句结构是程序设计模式的一个示范
			/*
			if( $get/$post/... ){
			
				

			}else{
				
				xxx;

			}
			*/
		
		}
	
		/*
		*
		*	@Description:	初始动作,基本初始网站信息显示
		*	@Param	None
		*	@Return
				string	$
				string	$
		*
		*
		*/
		private function IndexAction(){
			
			//echo "test";
			
			//print_r($tpl);

			//Smarty类对象在global.php实例化过
			global $tpl,$sys_dir_base;
			
			//print_r($sys_charset);

			//echo "test";
			//print_r($tpl);

			$tpl->assign( "sys_dir_base",$sys_dir_base );
			$tpl->assign( "controller_name",$this->controller_name );
			$tpl->assign( "tpl_file",$this->tpl_file );
			$tpl->display("UserCenter/frame.tpl");
			

		}

	}

	//实例化 IndexController控制器
	$UserIndex = new UserIndexController( $_GET, $_POST );

?>