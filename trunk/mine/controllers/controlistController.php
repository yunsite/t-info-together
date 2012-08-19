<?php
	/*
	*	Description:	功能模块列表控制器
	*
	*
	*/

	class controlistController{
	
		//功能模块名(作标题用)
		private $controller_name = "产品列表";

		//功能模块模板名(模版调用时用)
		private $tpl_file = "";
		

		//把 $_GET和$_POST数组 作为构造函数的参数,供构造函数处理
		function __construct( $arg_get = '', $arg_post = '' ){
			
			//调用默认Action方法(初始动作)显示功能模块列表
			$this->IndexAction();
			

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
			global $tpl,$sys_dir_base;

			//模块相关信息,这里暂时先为手工输入的信息,需要再在此方法里查询出所有的模块信息
			$controller_info = array( 1 => array( "controller_desc" => "网络日志-您可以在这里记录每天的生活和点点滴滴", "controller_url" => "index.php?u=dairy", "controller_img" => "2011021900125043.jpg", "controllername" => "网络日志") );

			$tpl->assign( "sys_dir_base",$sys_dir_base );
			$tpl->assign( "controller_name",$this->controller_name );
			$tpl->assign( "controller_info",$controller_info );
			$tpl->display("controller_list.tpl");
			

		}

	}

	//实例化 IndexController控制器
	$controlistController = new controlistController( $_GET, $_POST );

?>