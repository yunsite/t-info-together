<?php
	/*
	*	Description:	入口控制器,显示主界面视图(处理基本初始网站信息显示)
	*
	*
	*/

	class IndexController{
	
		//把 $_GET和$_POST数组 作为构造函数的参数,供构造函数处理
		function __construct( $arg_get = '', $arg_post = '' ){
		
			//检测包含 系统初始处理
			//一般情况下,如果直接通过URL方式访问该处理脚本,则之前不会包含 系统初始处理脚本 ,通过下面语句来包含,而通过index.php方式访问则可以包含
			@include_once("../global.php");

			//无参调用 IndexController控制器
			if( empty($arg_get) && empty($arg_post) ){
			
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
			
			//Smarty类对象在global.php实例化过
			global $tpl;
			
			$tpl->display("index.tpl");
			

		}

	}
	
	//实例化 IndexController控制器
	$SiteIndex = new IndexController( $_GET, $_POST );

?>