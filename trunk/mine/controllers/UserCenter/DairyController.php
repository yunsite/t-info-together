<?php
	/*
	*	Description:	日志控制器
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
		

			
			//URL参数处理
			if( !empty($arg_get['a']) ){//日志主体部分
			
				switch( $arg_get['a'] ){
				
					//添加日志
					case "add":
						//检测 提交处理情况
						if(!empty($arg_post['add_dairy'])){
							//添加日志Action
							$this->AddDairyAction( $arg_post );
						}else{
							//调用 添加日志 视图
							$this->AddDairyView();
						}
						break;

					//删除日志
					case "del":
						if( !empty($arg_get['did']) ){
					
							//调用删除日志方法
							$this->DeleDairyAction( $did );

						}
						break;

					//修改日志
					case "modi":
						if( !empty($arg_get['did']) ){
					
							//
							$this->ModiDairyAction( $did );

						}else{
						
							$this->ModiDairyView();
						
						}
						break;

					//查看日志
					case "read":
						if( !empty($arg_get['did']) ){
					
							//调用查看日志方法(显示日志内容VIEW)
							$this->ShowDairyContentAction( $arg_get['did'] );
						}
						break;
				
					//查看用户指定分类下的日志列表
					case "list":
						
						//print_r($arg_get['sid']);

						//0也视为空,url中的参数为string类型
						if( !empty($arg_get['sid']) || (int)$arg_get['sid'] === 0 ){
							
							//echo "test";

							//
							$this->ShowListAction( $arg_get['sid'] );
						}else{
						
							$this->ShowListAction();

						}
						break;
				}

			}elseif( !empty($arg_get['s']) ){//日志分类部分
			
				switch( $arg_get['s'] ){
				
					//添加日志分类
					case "add":
						break;

					//删除日志分类
					case "del":
						break;

					//修改日志分类
					case "modi":
						break;
				
				}


			}elseif( !empty($arg_get['comm']) ){//日志评论部分

				switch( $arg_get['comm'] ){
				
					case "add":
						break;
					case "del":
						break;
					case "modi":
						break;
				
				}

			}else{//无参数_参数里无Action(即参数为?u=dairy时),无POST参数时
			
				//显示日志列表Action
				$this->ShowListAction();

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
		
			//echo "添加日志Action";
			//echo "<br/>";
			
			//包含 日志处理模型
			include_once("models/Dairy.php");

			//Smarty类对象在global.php实例化过
			//global $tpl,$sys_dir_base;
			
			//数据库配置全局参数
			global $db_server, $db_name, $db_user, $db_pwd, $sys_charset;
			
			$Dairy = new Dairy( $db_server, $db_name, $db_user, $db_pwd, $sys_charset );

			//插入记录,返回日志id
			$did =  $Dairy -> add_dairy( $_COOKIE["user_id"], $dairy_info['dry_sid'], $dairy_info['dry_title'], $dairy_info['myDairy'], $dairy_info['dry_ifcomm'], $dairy_info['dry_private'] );

			

			//echo "发布成功!";

			//调用ShowPostedView()方法,显示相关视图
			$this->ShowPostedView( $did );
			

			//print_r( $dairy_info );
		
		}

		/*
		*
		*	@Description:	发布/修改成功后显示的视图
		*	@Param	$did	日志id
		*	@Return
				string	$
				string	$
		*
		*
		*/
		private function ShowPostedView( $did ){
		
			$tpl_file = "posted_view";
			$controller_name = "发布成功";

			//Smarty类对象在global.php实例化过
			global $tpl,$sys_dir_base;

			$tpl->assign( "sys_dir_base",$sys_dir_base );
			$tpl->assign( "did",$did );
			$tpl->assign( "tpl_file",$tpl_file );
			$tpl->display("UserCenter/frame.tpl");

		}

		/*	()
		*	@Description:	删除日志Action

			@param	$did	日志id
		*
		*
		*/
		private function DeleDairyAction( $did ){
		
		}

		/*	()
		*	@Description:	修改日志视图VIEW(把日志内容显示在编辑器里)

			@param	none
		*
		*
		*/
		private function ModiDairyView(){
		
		}

		/*	()
		*	@Description:	修改日志Action(内容,分类,隐私等)(更新日志表,并显示"修改成功视图")

			@param	$did	日志id
		*
		*
		*/
		private function ModiDairyAction( $did ){
		
		}

		/*
		*
		*	@Description:	显示日志列表(需要修订,考虑默认日志列表和指定分类下日志列表情况)
		*	@Param	$sid	日志分类id	|	(需参考pw,默认为空以显示所有日志的列表呢,还是默认为0以显示默认分类下的日志列表呢)
		*	@Return
				string	$
				string	$
		*
		*
		*/
		private function ShowListAction( $sid = '' ){
		
			$tpl_file = "dairy_list";
			$controller_name = "日志列表(日志管理)";
			
			//包含 日志处理模型
			include_once("models/Dairy.php");
				
			//数据库配置全局参数
			global $db_server, $db_name, $db_user, $db_pwd, $sys_charset;
				
			$Dairy = new Dairy( $db_server, $db_name, $db_user, $db_pwd, $sys_charset );

			//print_r($sid);

			//相应分类下的日志列表
			if( !empty($sid) || (int)$sid === 0 ){
			
				//echo "test";
				$DairyList = $Dairy->sele_dairy( "*", "dry_sid = ".$sid );

			}else{
			
				$DairyList = $Dairy->sele_dairy( "*" );

			}

			print_r($DairyList);

			/*if( $sid === 0 ){
				echo "默认分类";
			}*/

			//Smarty类对象在global.php实例化过
			global $tpl,$sys_dir_base;
			
			//$tpl->assign( "dry_title", "这里是日志标题" );
			//$tpl->assign( "dry_lmoditime", "日志最后修改时间" );
			//$tpl->assign( "did", "123" );
			//$tpl->assign( "sid", "123" );
			//$tpl->assign( "sort_name", "测试分类" );
			$tpl->assign( "sys_dir_base",$sys_dir_base );
			$tpl->assign( "controller_name",$controller_name );
			$tpl->assign( "tpl_file",$tpl_file );
			$tpl->display("UserCenter/frame.tpl");

		}

		/*
		*
		*	@Description:	显示日志内容(视图)
		*	@Param	$did	日志id
		*	@Return
				string	$
				string	$
		*
		*
		*/
		private function ShowDairyContentAction( $did ){
		
			//echo "显示日志内容Action";
			//包含 日志处理模型
			include_once("models/Dairy.php");

			$tpl_file = "read_dairy";
			//$controller_name = "日志列表(日志管理)";

			//Smarty类对象在global.php实例化过
			global $tpl,$sys_dir_base;
			
			//数据库配置全局参数
			global $db_server, $db_name, $db_user, $db_pwd, $sys_charset;
			
			$Dairy = new Dairy( $db_server, $db_name, $db_user, $db_pwd, $sys_charset );
			

			//日志分类
			$DairyInfo = $Dairy->sele_dairy("*","dry_id = ".$did);

			$DairyInfo = $DairyInfo[0];

			//获取作者名
			//$Author = $Dairy->db_multi_select("mem_name","t_dairy","t_member", "t_member.mem_id = ".$DairyInfo['dry_uid']);
			//$Author = $Author[0];
			//print_r($Author);
			//print_r($DairyInfo);
			//包含 日志处理模型
			include_once("models/UserBase.php");
			$UserInfo = new UserBase( $db_server, $db_name, $db_user, $db_pwd, $sys_charset );
			$Author = $UserInfo->seli_user( "mem_name", "mem_id = ".$DairyInfo['dry_uid'] );
			//获取日志作者
			$Author = $Author[0]['mem_name'];
			//print_r($Author);

			//网页标题
			$controller_name = $DairyInfo["dry_title"];

			//转换日期格式
			$DairyInfo["dry_pubtime"] = date( "Y/m/d G:i:s", $DairyInfo["dry_pubtime"] );

			//转换日期格式
			$DairyInfo["dry_lmoditime"] = date( "Y/m/d G:i:s", $DairyInfo["dry_lmoditime"] );


			$tpl->assign( "sys_dir_base",$sys_dir_base );
			$tpl->assign( "controller_name",$controller_name );
			$tpl->assign( "title",$DairyInfo["dry_title"] );
			$tpl->assign( "content",$DairyInfo["dry_content"] );
			$tpl->assign( "author", $Author );
			$tpl->assign( "pub_time", $DairyInfo["dry_pubtime"]);
			$tpl->assign( "lastmodi_time", $DairyInfo["dry_lmoditime"]);
			$tpl->assign( "tpl_file",$tpl_file );
			$tpl->display("UserCenter/frame.tpl");

		}

	}

	//实例化 IndexController控制器
	$Dairy = new DairyController( $_GET, $_POST );

?>