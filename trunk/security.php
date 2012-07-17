<?php
	/*
	*
	*	Description: 安全处理文件
	*
	*
	*/

	/*
	*	Description:程序不使用魔术引号，这个函数是为了增加移植性，在程序中关闭魔术引号
	*	Advise:从系统级关闭魔术引号，不要依赖程序实现的时候关闭，这样会降低程序的效率
	*	未完成
	*/
	function close_magic_quotes(){
		
		//检测关闭 magic_quotes_gpc
		if( get_magic_quotes_gpc() ){
			//函数内函数
			function stripslashes_deep( $value ){

				$value = is_array( $value ) ? array_map('stripslashes_deep',$value) : stripslashes($value);

				return $value;
			}

			$_POST = array_map('stripslashes_map',$_POST);
			$_GET = array_map('stripslashes_map',$_GET);
			$_COOKIE = array_map('stripslashes_map',$_COOKIE);
			$_REQUEST = array_map('stripslashes_map',$_REQUEST);
		}

		//检测关闭 magic_quotes_runtime
		if( get_magic_quotes_runtime() ){
			set_magic_quotes_runtime(false);
		}

		//检测关闭

	}


	/*
	*	Description:	防止SQL注入
	*
	*
	*
	*/


	/*
	*	Description:	关闭 Register Globals
	*	Advise:从系统级关闭Register Globals
	*	Note:此函数应在脚本最开头的地方调用。如果使用了会话机制，则在session_start()之后调用
	*	Schedule:已完成，未测试
	*/
	function close_register_globals(){

		if( !ini_get('register_globals') ){
			return;
		}
		
		if( isset($_REQUEST['GLOBALS']) || isset($_FILES['GLOBALS']) ){
			die('全局变量覆盖尝试被发现!');
		}
		
		//不应被释放的变量
		$noUnset = array('GLOBALS','_GET','_POST','_COOKIE','_REQUEST','_SERVER','_ENV','_FILES');

		$input = array_merge($_GET,$_POST,$_COOKIE,$_SERVER,$_ENV,$_FILES,isset($_SESSION) && is_array($_SESSION) ? $_SESSION : array() );

		foreach( $input as $k => $v ){
			if( !in_array($k,$noUnset) && isset($GLOBALS[$k]) ){
				unset($GLOBALS[$k]);
			}else{
				die('您做的一些动作有潜在破坏网站安全性的风险，请检查您的操作，谢谢！');
			}

		/*
		//unset可以直接释放数组变量
		if( $_GET['_GET'] ){
			unset($GLOBALS['_GET']);
		}
		if( $_GET['_POST'] ){
			unset( $GLOBALS['_POST'] );
		}
		if( $_GET['_COOKIE'] ){
			unset( $GLOBALS['_COOKIE'] );
		}
		if( $_GET['_REQUEST'] ){
			unset( $GLOBALS['_REQUEST'] );
		}
		if( $_GET['_SERVER'] ){
			unset( $GLOBALS['_SERVER'] );
		}
		if( $_GET['_ENV'] ){
			unset( $GLOBALS['_ENV'] );
		}
		if( $_GET['_FILES'] ){
			unset( $GLOBALS['_FILES'] );
		}
		*/

	}

	/*
	*
	*	Description:	文件上传安全
	*
	*
	*/

	/*
	*	Description:	文件系统安全
	*
	*
	*
	*/

	/*
	*	Description:	用户提交的数据安全
	*	Schedule:	正在处理	html_entity_decode	
	*
	*
	*/
	function htmldecode( $input ){
		if( empty($input) )
			exit("您没有提交任何内容!");
        $input=str_replace("&"," ",$input);
        $input=str_replace(">"," ",$input);
        $input=str_replace("<"," ",$input);
        $input=str_replace("chr(32)"," ",$input);
        $input=str_replace("chr(9)"," ",$input);
        $input=str_replace("chr(34)"," ",$input);
        $input=str_replace("\""," ",$input);
        $input=str_replace("chr(39)"," ",$input);
        $input=str_replace(""," ",$input);
        $str=str_replace("'"," ",$input);
        $str=str_replace("select"," ",$input);
        $str=str_replace("join"," ",$str);
        $str=str_replace("union"," ",$str);
        $str=str_replace("where"," ",$str);
        $str=str_replace("insert"," ",$str);
        $str=str_replace("delete"," ",$str);
        $str=str_replace("update"," ",$str);
        $str=str_replace("like"," ",$str);
        $str=str_replace("drop"," ",$str);
        $str=str_replace("create"," ",$str);
        $str=str_replace("modify"," ",$str);
        $str=str_replace("rename"," ",$str);
        $str=str_replace("alter"," ",$str);
        $str=str_replace("cas"," ",$str);
        $str=str_replace("replace"," ",$str);
        $str=str_replace("%"," ",$str);
        $str=str_replace("or"," ",$str);
        $str=str_replace("and"," ",$str);
        $str=str_replace("!"," ",$str);
        $str=str_replace("xor"," ",$str);
        $str=str_replace("not"," ",$str);
        $str=str_replace("user"," ",$str);
        $str=str_replace("||"," ",$str);
        $str=str_replace("<"," ",$str);
        $str=str_replace(">"," ",$str);
		return $str;
	}

	/*
	*	Description:	数据库安全
	*
	*
	*
	*/

	/*
	*	Description:	
	*
	*
	*
	*/

	}
?>