<?php
	/*
	*	Description:	入口控制器,显示主界面视图(处理基本初始网站信息显示)
	*
	*
	*/

	class IndexController{
	
		function __construct( $get/$post/... ){
		
			//检测包含 系统初始处理
			include_once("global.php");

			//默认视图
			$this->IndexAction();

			if( $get/$post/... ){
			
			}
		
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

			$tpl->assign("title",$sys_title);
			$tpl->assign("keywords",$sys_keywords);
			$tpl->assign("description",$sys_description);
			$tpl->display("index.tpl");

		}

	}

	
	if( $get/$post/... ){
			
	}

	$SiteIndex = new IndexController( $get/$post/... );

?>