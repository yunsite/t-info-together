<?php
	/*
	*	Description:	个人中心入口控制器,显示个人中心主界面视图(处理基本初始网站信息显示)
	*
	*
	*/

	class UserIndexController{
	
		//把 $_GET和$_POST数组 作为构造函数的参数,供构造函数处理
		function __construct( $arg_get = '', $arg_post = '' ){
		

			//print_r($tpl);

			//print_r($sys_charset);

			//print_r($arg_get);

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
			$tpl->display("UserCenter/index.tpl");
			

		}

	}

	//实例化 IndexController控制器
	$UserIndex = new UserIndexController( $_GET, $_POST );

?>