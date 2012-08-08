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
			
			//判断缓存是否存在,而读取缓存
			//因为不知道是直接访问控制器,还是从index.php入口文件访问,所以检测两种情况下,缓存文件是否存在
			if( file_exists("../data/cache/SiteInfo.cache") || file_exists("data/cache/SiteInfo.cache") ){
				
				//echo "缓存文件存在!";
				//echo "<br/>";

				$SiteInfo =  read_cache("data/cache/SiteInfo.cache");
				print_r($SiteInfo);

				//读取缓存文件相关信息;

				//赋值所需要的变量;

				//$sys_title = ;
				
				//$sys_keywords = ;

				//$sys_description = ;

			}else{
			
				//声明变量为全局变量
				global $db_server, $db_name, $db_user, $db_pwd, $sys_charset;

				//创建数据库对象(在需要的时候才创建,而不是系统一初始化就创建,因为系统有缓存机制,如果没特殊操作,如系统后台更新了缓存,则使用缓存)
				//似乎在后面直接声明它的子类对象就行了,不清楚的是,子类对象创建的时候会不会调用父类对象的构造函数(db_class会自动连接数据库),记得好像是会
				//$db_base = new db_class( $db_server, $db_name, $db_user, $db_pwd, $sys_charset );
				
				//print_r( $db_base );

				//包含 model,在这里检测包含处理用到的model(下面的代码暂时只针对直接访问)
				@include_once("../models/SiteInfo.php");
				@include_once("models/SiteInfo.php");
				/*if( 是直接访问 ){
				
					include_once("../models/SiteInfo.php");

				}else{//通过index.php入口文件访问
				
					include_once("models/SiteInfo.php");

				}
				*/

				$db_base = new SiteInfo( $db_server, $db_name, $db_user, $db_pwd, $sys_charset );

				//print_r( $db_base );

				//查询站点基本信息
				$siteinfo = $db_base -> si_select( '*' ,'' );

				//print_r( $siteinfo );
				
				//遍历赋值 站点信息
				foreach( $siteinfo as $key => $value ){
				
					switch( $value["conf_name"] ){
						
						//系统名
						case "site_name": $sys_title = $value["conf_value"];
						break;

						//关键字
						case "site_keywords": $sys_keywords = $value["conf_value"];
						break;

						//站点描述
						case "site_description": $sys_description = $value["conf_value"];
						break;
					
					}
				
				}

				//echo $sys_description;

				/*
				$

				//写缓存操作(如果缓存机制开启的话)
				if( 开启缓存机制 ){
				
					写缓存操作;

				}
				*/
				//这里暂未考虑缓存机制开启选项(需要修改缓存的内容——缓存指定的信息)
				write_cache( 'data/cache/SiteInfo.cache', $siteinfo );

			}
			
			/*
			$tpl->assign("title",$sys_title);
			$tpl->assign("keywords",$sys_keywords);
			$tpl->assign("description",$sys_description);
			$tpl->display("index.tpl");
			*/

		}

	}
	
	//实例化 IndexController控制器
	$SiteIndex = new IndexController( $_GET, $_POST );

?>