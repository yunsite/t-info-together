<?php
	/*
	*	Description:	入口控制器,显示主界面视图(处理基本初始网站信息显示)
	*
	*
	*/

	class IndexController{
	
		function __construct( $get/$post/... ){
		
			//检测包含 系统初始处理
			//一般情况下,如果直接通过URL方式访问该处理脚本,则之前不会包含 系统初始处理脚本 ,通过下面语句来包含,而通过index.php方式访问则可以包含
			include_once("../global.php");

			//调用默认Action方法(初始动作)显示首页
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

			//包含 model,在这里检测包含处理用到的model
			if( 是直接访问 ){
			
				include_once("../models/SiteInfo.php");

			}else{//通过index.php入口文件访问
			
				include_once("models/SiteInfo.php");

			}

			$tpl->assign("title",$sys_title);
			$tpl->assign("keywords",$sys_keywords);
			$tpl->assign("description",$sys_description);
			$tpl->display("index.tpl");

		}

	}

	//下面被注释掉的if...语句结构是程序设计模式的一个示范
	/*
	if( $get/$post/... ){
			
	}
	*/

	$SiteIndex = new IndexController( $get/$post/... );

?>