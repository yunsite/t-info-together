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
		private $tpl_file = "";
		

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
						}elseif( @!empty($arg_get['sid']) || @$arg_get['sid'] === '0' ){
						
							//调用查看日志列表方法(显示日志列表VIEW)
							$this->ShowDairyListAction( $arg_get['sid'] );

						}elseif( empty($arg_get['sid']) ){
						
							$this->ShowDairyListAction('');

						}
						break;
				
					//查看用户指定分类下的日志列表
					case "list":
						
						//print_r($arg_get['sid']);

						//0也视为空,url中的参数为string类型
						if( !empty($arg_get['sid']) || $arg_get['sid'] === '0' ){
							
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

							if( !empty($arg_post['new_sort']) ){
							
								$this->AddDairySortAction( $arg_post );

							}

						break;

					//删除日志分类
					case "del":
							
							if( !empty($arg_get['sid']) ){//分类号不为空
							
								$this->DelDairySortAction( $arg_get['sid'] );

							}

						break;

					//修改日志分类
					case "modi":

							$this->ModiDairySortView();

						break;
				
				}


			}elseif( !empty($arg_get['comm']) ){//日志评论部分

				switch( $arg_get['comm'] ){
				
					case "add":
							$this->addCommentAction( $arg_get['did'], $_COOKIE["user_id"], $arg_post['comment'] );
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
											(在编辑器里显示原日志内容)
			@param	none
		*
		*
		*/
		private function ModiDairyView(){
		
		}

		/*	()
		*	@Description:	修改日志Action(内容,分类,隐私等)(更新日志表,并显示"修改成功视图")
										  (接收修改的内容做UPDATE更新)
			@param	$did	日志id
		*
		*
		*/
		private function ModiDairyAction( $did ){
		
		}

		/*
		*
		*	@Description:	显示日志内容Action
							(1.根据用户是否有权限阅读日志来做相应的处理
							 2.如果是作者,则在显示的视图里增加("删除(文章)")链接,对于文章下评论同理)
		*	@Param	$did	日志id
		*	@Return
				string	$
				string	$
		*
		*
		*/
		private function ShowDairyContentAction( $did ){
		
			$keywords = "博客,T博客,T-sys博客,个人博客,T-blog";
			$description = "这是T-blog用户的个人博客";

			//echo "显示日志内容Action";
			//包含 日志处理模型
			include_once("models/Dairy.php");

			//$tpl_file = "read_dairy";
			//$controller_name = "日志列表(日志管理)";

			//Smarty类对象在global.php实例化过
			global $tpl,$sys_dir_base;
			
			//数据库配置全局参数
			global $db_server, $db_name, $db_user, $db_pwd, $sys_charset;
			
			$Dairy = new Dairy( $db_server, $db_name, $db_user, $db_pwd, $sys_charset );
			
			//日志分类
			$DairySort = $Dairy->sele_sort("*","dry_uid = ".$_COOKIE['user_id']);

			//日志所属分类
			$DairysSortId = $Dairy->sele_dairy("dry_sid","dry_id = ".$did);
			$DairysSortId = $DairysSortId[0];
			$DairysSort = $Dairy->sele_sort("dry_stitle","dry_sid = ".$DairysSortId['dry_sid']);
			@$DairysSort = $DairysSort[0]['dry_stitle'];
			//默认分类情况
			if( empty($DairysSort) ){
				$DairysSort = "默认分类";
			}
			//print_r($DairysSort);
			
			//print_r($DairySort);
			//print_r($_COOKIE);


			//日志信息
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

			//查询日志评论信息
			$CommentInfo = $Dairy->sele_comment( "*", "drycm_dryid = ".$did );
			//评论数
			$CommentNum = count( $CommentInfo );
			//print_r( $CommentInfo );
			//print_r( $CommentNum );

			foreach( $CommentInfo AS $key => $value ){

				$CommentInfo[$key]['drycm_pubtime'] = date( "Y/m/d G:i:s", $value['drycm_pubtime'] );

				$CommAuthor = $UserInfo->seli_user( "mem_name", "mem_id = ".$value['drycm_uid'] );

				$CommentInfo[$key]['author'] = $CommAuthor[0]["mem_name"];

			}
			
			//print_r( $CommentInfo );

			$tpl->assign( "sys_dir_base",$sys_dir_base );
			$tpl->assign( "did", $did );
			$tpl->assign( "title",$DairyInfo["dry_title"] );
			$tpl->assign( "keywords", $keywords);
			$tpl->assign( "description", $description);
			$tpl->assign( "content",$DairyInfo["dry_content"] );
			$tpl->assign( "author", $Author );
			$tpl->assign( "blogname", $Author );
			$tpl->assign( "DairySort",$DairySort );
			$tpl->assign( "DairysSort", $DairysSort);
			$tpl->assign( "DairysSortId", $DairysSortId['dry_sid']);
			$tpl->assign( "pub_time", $DairyInfo["dry_pubtime"]);
			$tpl->assign( "lastmodi_time", $DairyInfo["dry_lmoditime"]);
			$tpl->assign( "CommentNum", $CommentNum);
			$tpl->assign( "CommentInfo", $CommentInfo);
			$tpl->display("blog/article.tpl");

		}


		/*
		*
		*	@Description:	显示日志列表(博客平台下)
		*	@Param	$sid	日志分类id	|	空
		*	@Return
				string	$
				string	$
		*
		*
		*/
		private function ShowDairyListAction( $sid = '' ){
		
			
			//包含 日志处理模型
			include_once("models/Dairy.php");
			
			//Smarty类对象在global.php实例化过
			global $tpl,$sys_dir_base;

			//数据库配置全局参数
			global $db_server, $db_name, $db_user, $db_pwd, $sys_charset;
				
			$Dairy = new Dairy( $db_server, $db_name, $db_user, $db_pwd, $sys_charset );

			//print_r($sid);

			//相应分类下的日志列表
			if( !empty($sid) || $sid === '0' ){
			
				//echo "test";
				$DairyList = $Dairy->sele_dairy( "*", "dry_sid = ".$sid );

			}else{
			
				$DairyList = $Dairy->sele_dairy( "*" );

			}

			//print_r($DairyList);
			
			//日志分类
			$DairySort = $Dairy->sele_sort("*","dry_uid = ".$_COOKIE['user_id']);
			


			include_once("models/UserBase.php");
			$UserInfo = new UserBase( $db_server, $db_name, $db_user, $db_pwd, $sys_charset );

			foreach( $DairyList as $key => $value ){
			
				$Author = $UserInfo->seli_user( "mem_name", "mem_id = ".$value['dry_uid'] );
				//日志作者
				$DairyList[$key]['author'] = $Author[0]['mem_name'];

				//转换日期格式
				$DairyList[$key]["dry_pubtime"] = date( "Y/m/d G:i:s", $value["dry_pubtime"] );

				//转换日期格式
				$DairyList[$key]["dry_lmoditime"] = date( "Y/m/d G:i:s", $value["dry_lmoditime"] );
				
				//日志所属分类
				$DairysSortId = $Dairy->sele_dairy("dry_sid","dry_id = ".$value['dry_id']);
				$DairysSortId = $DairysSortId[0];
				$DairysSort = $Dairy->sele_sort("dry_stitle","dry_sid = ".$DairysSortId['dry_sid']);
				@$DairyList[$key]['DairysSort'] = $DairysSort[0]['dry_stitle'];
				//日志分类id
				$DairyList[$key]['DairysSortId'] = $DairysSortId['dry_sid'];
				//默认分类情况
				if( empty($DairysSort) ){
					$DairyList[$key]['DairysSort'] = "默认分类";
				}

				//查询日志评论信息
				$CommentInfo = $Dairy->sele_comment( "*", "drycm_dryid = ".$value['dry_id'] );
				//评论数
				$DairyList[$key]['CommentNum'] = count( $CommentInfo );


				//日志简略内容
				$DairyList[$key]['ContentBreif'] = "这是日志简略内容!";



			}

			//print_r($DairyList);


			/*if( $sid === 0 ){
				echo "默认分类";
			}*/

			$keywords = "博客,T博客,T-sys博客,个人博客,T-blog";
			$description = "这是T-blog用户的个人博客";
			$blogname = $Author[0]['mem_name'];
			//print_r($blogname);

			$tpl->assign( "sys_dir_base",$sys_dir_base );
			$tpl->assign( "keywords", $keywords);
			$tpl->assign( "description", $description);
			$tpl->assign( "blogname", $blogname);
			//日志分类目录
			$tpl->assign( "DairySort",$DairySort );
			$tpl->assign( "DairyList", $DairyList);
			$tpl->display("blog/list.tpl");
			
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
			if( !empty($sid) || $sid === '0' ){
			
				//echo "test";
				$DairyList = $Dairy->sele_dairy( "*", "dry_sid = ".$sid );

			}else{
			
				$DairyList = $Dairy->sele_dairy( "*" );

			}

			//print_r($DairyList);

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
		
		/*	()
		*	@Description:	增加日志分类Action

			@param	$SortInfo	日志分类信息数组
		*
		*
		*/
		private function AddDairySortAction( $SortInfo ){
		
			//包含 日志处理模型
			include_once("models/Dairy.php");
				
			//数据库配置全局参数
			global $db_server, $db_name, $db_user, $db_pwd, $sys_charset;
				
			$Dairy = new Dairy( $db_server, $db_name, $db_user, $db_pwd, $sys_charset );

			//print_r($_COOKIE);

			//添加分类
			$Dairy->add_sort( $_COOKIE['user_id'], $SortInfo['new_sort_name'], $SortInfo['new_sort_ifcomm'], $SortInfo['new_sort_private'] );

			$this->ModiDairySortView();

		}


		/*	()
		*	@Description:	删除日志分类Action

			@param	$sid	日志分类号
		*
		*
		*/
		private function DelDairySortAction( $sid ){
		
			//包含 日志处理模型
			include_once("models/Dairy.php");

			//数据库配置全局参数
			global $db_server, $db_name, $db_user, $db_pwd, $sys_charset;
				
			$Dairy = new Dairy( $db_server, $db_name, $db_user, $db_pwd, $sys_charset );

			$Dairy->del_sort( $sid );

			$this->ModiDairySortView();

		}

		/*	()
		*	@Description:	修改日志分类View

			@param	none
		*
		*
		*/
		private function ModiDairySortView(){
		
			$tpl_file = "modi_dairysort";
			$controller_name = "修改日志分类";
			
			//包含 日志处理模型
			include_once("models/Dairy.php");
				
			//数据库配置全局参数
			global $db_server, $db_name, $db_user, $db_pwd, $sys_charset;
				
			$Dairy = new Dairy( $db_server, $db_name, $db_user, $db_pwd, $sys_charset );

			//print_r($sid);

			//用户的分类记录
			$DairyList = $Dairy->sele_sort( "*", "dry_uid = ".$_COOKIE["user_id"] );
			
			//print_r($DairyList);

			foreach( $DairyList AS $key => $value ){
			
				switch( $value['dry_sprivate'] ){
				
					case 0:
						$DairyList[$key]['sortprivate0'] = 'selected="selected"';
						//print_r($value);
						//print_r($DairyList);
						break;
					case 1:
						$DairyList[$key]['sortprivate1'] = 'selected="selected"';
						break;
					case 2:
						$DairyList[$key]['sortprivate3'] = 'selected="selected"';
						break;
				
				}

				switch( $value['dry_sifcomm'] ){
				
					case 0:
						$DairyList[$key]['sortifcomm0'] = 'selected="selected"';
						//print_r($value);
						//print_r($DairyList);
						break;
					case 1:
						$DairyList[$key]['sortifcomm1'] = 'selected="selected"';
						break;
				
				}
			
			}
			//print_r($DairyList);

			
			//Smarty类对象在global.php实例化过
			global $tpl,$sys_dir_base;
			
			$tpl->assign( "sys_dir_base",$sys_dir_base );
			$tpl->assign( "controller_name",$controller_name );
			$tpl->assign( "DairyList",$DairyList );
			$tpl->assign( "tpl_file",$tpl_file );
			$tpl->display("UserCenter/frame.tpl");
			

		}

		/*	()
		*	@Description:	修改日志分类Action

			@param	none
		*
		*
		*/
		private function ModiDairySortAction(){
		
		}

		/*	()
		*	@Description:	添加评论Action

			@param	
					$did		评论的日志id
					$uid		评论用户id
					$content	评论内容
		*
		*
		*/
		private function addCommentAction( $did, $uid, $content ){
		
			//包含 日志处理模型
			include_once("models/Dairy.php");
			
			//数据库配置全局参数
			global $db_server, $db_name, $db_user, $db_pwd, $sys_charset;
			
			$Dairy = new Dairy( $db_server, $db_name, $db_user, $db_pwd, $sys_charset );

			//插入评论
			$Dairy -> add_comment( $did, $uid, $content );

			//echo "发布成功!";

			//重新显示原日志
			$this->ShowDairyContentAction( $did );

		}

	}

	//实例化 IndexController控制器
	$Dairy = new DairyController( $_GET, $_POST );

?>