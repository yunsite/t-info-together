<?php
	/*
	*	Description:	日志控制器
	*
	*
	*/	

	/*	()
	*	@Description:	删除日志

		@param	none
	*
	*
	*/

	/*	()
	*	@Description:	修改日志(内容,分类,隐私等)

		@param	none
	*
	*
	*/

	/*	()
	*	@Description:	查询日志

		@param	none
	*
	*
	*/

?>
<?php
	/*
	*	Description:	日志控制器
	*
	*
	*/

	class DairyController{
	
		//功能模块名(作标题用)
		private $controller_name = "日志管理";

		//功能模块模板名(模版调用时用)
		private $tpl_file = "shuoshuo_main";
		

		//把 $_GET和$_POST数组 作为构造函数的参数,供构造函数处理
		function __construct( $arg_get = '', $arg_post = '' ){
		

			if(!empty($arg_post['myDairy'])){
			
				//添加日志
				$this->AddDairyAction( $arg_post );

			}

			//添加日志
			if( @$arg_get['a'] == 'add' ){
			
				$this->AddDairyView();

			}else{	//参数里无Action(即参数为?u=dairy时),无POST参数时
				
				//显示日志列表方法
				$this->ShowListAction();
			
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

		/*
		*
		*	@Description:	添加日志视图
		*	@Param	None
		*	@Return
				string	$
				string	$
		*
		*
		*/
		private function AddDairyView(){
			
			$tpl_file = "add_dairy";
			$controller_name = "添加日志";

			//包含 日志处理模型
			include_once("models/Dairy.php");

			//Smarty类对象在global.php实例化过
			global $tpl,$sys_dir_base;
			
			//数据库配置全局参数
			global $db_server, $db_name, $db_user, $db_pwd, $sys_charset;
			
			$Dairy = new Dairy( $db_server, $db_name, $db_user, $db_pwd, $sys_charset );
			
			//print_r($_COOKIE);

			//日志分类
			$Dairy_sort = $Dairy->sele_sort("*","dry_uid = ".$_COOKIE["user_id"]);

			//print_r($Dairy_sort);

			$tpl->assign( "sys_dir_base",$sys_dir_base );
			$tpl->assign( "controller_name",$controller_name );
			$tpl->assign( "dairy_sort",$Dairy_sort );
			$tpl->assign( "tpl_file",$tpl_file );
			$tpl->display("UserCenter/frame.tpl");
			

		}

		/*
		*
		*	@Description:	添加日志动作(执行成功后,显示视图 ①再写一篇 ②查看已发布的文章)
		*	@Param	$dairy_info		POST传递进来的日志相关信息
		*	@Return
				string	$
				string	$
		*
		*
		*/
		private function AddDairyAction( $dairy_info ){
		
			echo "添加日志Action";
			echo "<br/>";

			print_r( $dairy_info );
		
		}

		/*
		*
		*	@Description:	显示日志列表
		*	@Param	None
		*	@Return
				string	$
				string	$
		*
		*
		*/
		private function ShowListAction(){
		
			$tpl_file = "dairy_list";
			$controller_name = "日志列表(日志管理)";

			//Smarty类对象在global.php实例化过
			global $tpl,$sys_dir_base;

			$tpl->assign( "sys_dir_base",$sys_dir_base );
			$tpl->assign( "controller_name",$controller_name );
			$tpl->assign( "tpl_file",$tpl_file );
			$tpl->display("UserCenter/frame.tpl");

		}

		/*
		*
		*	@Description:	显示日志内容
		*	@Param	None
		*	@Return
				string	$
				string	$
		*
		*
		*/
		private function ShowDairyContentAction(){
		
			echo "显示日志内容Action";
		
		}

	}

	//实例化 IndexController控制器
	$Dairy = new DairyController( $_GET, $_POST );

?>